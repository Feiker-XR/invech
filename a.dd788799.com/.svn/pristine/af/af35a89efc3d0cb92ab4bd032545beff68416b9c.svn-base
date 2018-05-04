<?php

namespace bong\service;

use InvalidArgumentException;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\SyslogHandler;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Formatter\LineFormatter;

class Logger
{

    protected $monolog;

    protected $path;    

    protected $levels = [
        'debug'     => MonologLogger::DEBUG,
        'info'      => MonologLogger::INFO,
        'notice'    => MonologLogger::NOTICE,
        'warning'   => MonologLogger::WARNING,
        'error'     => MonologLogger::ERROR,
        'critical'  => MonologLogger::CRITICAL,
        'alert'     => MonologLogger::ALERT,
        'emergency' => MonologLogger::EMERGENCY,
    ];

    public function __construct(array $options = array())
    {
        $this->monolog = new MonologLogger(config('logger.log_channel')??'local');
        $this->path = RUNTIME_PATH.'log/monolog.log';

        $handler = config('logger.log')??'single';
        
        $this->{'configure'.ucfirst($handler).'Handler'}();
    }


    protected function logLevel()
    {
        return config('logger.log_level')??'debug';
    }

    protected function maxFiles()
    {
        return config('logger.log_max_files')??5;
    }
    

    protected function configureSingleHandler()
    {
        $this->useFiles(
            $this->path,
            $this->logLevel()
        );
    }

    protected function configureDailyHandler()
    {
        $this->useDailyFiles(
            $this->path, $this->maxFiles(),
            $this->logLevel()
        );
    }

    protected function configureSyslogHandler()
    {
        $this->useSyslog('monolog', $this->logLevel());
    }

    protected function configureErrorlogHandler()
    {
        $this->useErrorLog($this->logLevel());
    }            

    //---------------运行时配置--------------------
    public function useFiles($path, $level = 'debug')
    {
        $this->monolog->pushHandler($handler = new StreamHandler($path, $this->parseLevel($level)));

        $handler->setFormatter($this->getDefaultFormatter());
    }

    public function useDailyFiles($path, $days = 0, $level = 'debug')
    {
        $this->monolog->pushHandler(
            $handler = new RotatingFileHandler($path, $days, $this->parseLevel($level))
        );

        $handler->setFormatter($this->getDefaultFormatter());
    }

    public function useSyslog($name = 'laravel', $level = 'debug', $facility = LOG_USER)
    {
        return $this->monolog->pushHandler(new SyslogHandler($name, $facility, $level));
    }

    public function useErrorLog($level = 'debug', $messageType = ErrorLogHandler::OPERATING_SYSTEM)
    {
        $this->monolog->pushHandler(
            new ErrorLogHandler($messageType, $this->parseLevel($level))
        );
    }

    protected function getDefaultFormatter()
    {
        $formatter = new LineFormatter(null, null, true, true);
        $formatter->includeStacktraces();
        return $formatter;
    }

    protected function parseLevel($level)
    {
        if (isset($this->levels[$level])) {
            return $this->levels[$level];
        }

        throw new InvalidArgumentException('Invalid log level.');
    }

    //-------------基本功能-------------------
    public function emergency($message, array $context = [])
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function alert($message, array $context = [])
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function notice($message, array $context = [])
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function debug($message, array $context = [])
    {
        $this->writeLog(__FUNCTION__, $message, $context);
    }

    public function log($level, $message, array $context = [])
    {
        $this->writeLog($level, $message, $context);
    }

    public function write($level, $message, array $context = [])
    {
        $this->writeLog($level, $message, $context);
    }

    protected function writeLog($level, $message, $context)
    {
        $this->monolog->{$level}($message, $context);
    }

}
