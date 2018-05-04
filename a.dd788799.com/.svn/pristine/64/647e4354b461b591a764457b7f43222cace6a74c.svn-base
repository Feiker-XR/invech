<?php

namespace bong\service;
use think\Request;
use think\Response;
use bong\service\OriginMatcher;

class Cors
{
    private $options;

    public function __construct(array $options = array())
    {
        $this->options = $this->normalizeOptions($options);
    }

    private function normalizeOptions(array $options = array())
    {
        $options += array(
            'allowedOrigins' => array(),
            'supportsCredentials' => false,
            'allowedHeaders' => array(),
            'exposedHeaders' => array(),
            'allowedMethods' => array(),
            'maxAge' => 0,
        );

        if ($options['allowedOrigins'] === true || in_array('*', $options['allowedOrigins'])) {
            $options['allowedOrigins'] = true;
        }

        if ($options['allowedHeaders'] === true || in_array('*', $options['allowedHeaders'])) {
            $options['allowedHeaders'] = true;
        }

        if ($options['allowedMethods'] === true || in_array('*', $options['allowedMethods'])) {
            $options['allowedMethods'] = true;
        } else {
            $options['allowedMethods'] = array_map('strtoupper', $options['allowedMethods']);
        }

        return $options;
    }

    public function isCorsRequest(Request $request)
    {
        $Origin = $request->header('Origin');

        return  $Origin && ( $Origin !== $request->scheme().'://'.$request->host() ) ;
    }

    public function isPreflightRequest(Request $request)
    {
        return $this->isCorsRequest($request)
            && $request->method() === 'OPTIONS'
            && $request->header('Access-Control-Request-Method');
    }


    public function isActualRequestAllowed(Request $request)
    {
        return $this->checkOrigin($request);
    }

    public function addActualRequestHeaders(Response $response, Request $request)
    {
        if (!$this->checkOrigin($request)) {
            return $response;
        }

        $allowOrigin = $this->options['allowedOrigins'] === true && !$this->options['supportsCredentials']
            ? '*'
            : $request->header('Origin');
        $response->header('Access-Control-Allow-Origin', $allowOrigin);

        if (!$response->getHeader('Vary')) {
            $response->header('Vary', 'Origin');
        } else {
            $response->header('Vary', $response->getHeader('Vary') . ', Origin');
        }

        if ($this->options['supportsCredentials']) {
            $response->header('Access-Control-Allow-Credentials', 'true');
        }

        if ($this->options['exposedHeaders']) {
            $response->header('Access-Control-Expose-Headers', implode(', ', $this->options['exposedHeaders']));
        }

        return $response;
    }

    public function handlePreflightRequest(Request $request)
    {
        $response = new Response();

        return $this->addPreflightRequestHeaders($response, $request);
    }

    public function addPreflightRequestHeaders(Response $response, Request $request)
    {
        if (true !== $check = $this->checkPreflightRequestConditions($request)) {
            return $check;
        }

        if ($this->options['supportsCredentials']) {
            $response->header('Access-Control-Allow-Credentials', 'true');
        }

        $allowOrigin = $this->options['allowedOrigins'] === true && !$this->options['supportsCredentials']
            ? '*'
            : $request->header('Origin');
        $response->header('Access-Control-Allow-Origin', $allowOrigin);

        if ($this->options['maxAge']) {
            $response->header('Access-Control-Max-Age', $this->options['maxAge']);
        }

        $allowMethods = $this->options['allowedMethods'] === true
            ? strtoupper($request->header('Access-Control-Request-Method'))
            : implode(', ', $this->options['allowedMethods']);
        $response->header('Access-Control-Allow-Methods', $allowMethods);

        $allowHeaders = $this->options['allowedHeaders'] === true
            ? $request->header('Access-Control-Request-Headers')
            : implode(', ', $this->options['allowedHeaders']);
        $response->header('Access-Control-Allow-Headers', $allowHeaders);

        return $response;
    }

    private function checkPreflightRequestConditions(Request $request)
    {
        if (!$this->checkOrigin($request)) {
            return $this->createBadRequestResponse(403, 'Origin not allowed');
        }

        if (!$this->checkMethod($request)) {
            return $this->createBadRequestResponse(405, 'Method not allowed');
        }

        if ($this->options['allowedHeaders'] !== true && $request->header('Access-Control-Request-Headers')) {
            $allowedHeaders = array_map('strtolower', $this->options['allowedHeaders']);
            $headers = strtolower($request->header('Access-Control-Request-Headers'));
            $requestHeaders = explode(',', $headers);

            foreach ($requestHeaders as $header) {
                if (!in_array(trim($header), $allowedHeaders)) {
                    return $this->createBadRequestResponse(403, 'Header not allowed');
                }
            }
        }

        return true;
    }

    private function createBadRequestResponse($code, $reason = '')
    {
        return new Response($reason, $code);
    }

    private function checkOrigin(Request $request)
    {
        if ($this->options['allowedOrigins'] === true) {        
            return true;
        }
        $origin = $request->header('Origin');

        foreach ($this->options['allowedOrigins'] as $allowedOrigin) {
            if (OriginMatcher::matches($allowedOrigin, $origin)) {
                return true;
            }
        }
        return false;
    }

    private function checkMethod(Request $request)
    {
        if ($this->options['allowedMethods'] === true) {
            return true;
        }

        $requestMethod = strtoupper($request->header('Access-Control-Request-Method'));
        return in_array($requestMethod, $this->options['allowedMethods']);
    }
}
