<?php

namespace bong\service\auth\traits;

use bong\foundation\Str;

trait UserProvider
{
    protected $model;
    protected $scope;
    
    public function setModel($model)
    {
        $this->model = new $model();
    }

    public function setScope($scope)
    {
        $this->scope = $scope;
    }
    
    private function getQuery(){        
        if($this->scope){
            //$query->{$this->scope}();//模型对象支持查询作用域,查询构造器不支持查询作用域
            $model = $this->model->{$this->scope}();
            $query = $model->getQuery();
        }else{
            $query = $this->model->getQuery();
        }
        return $query;
    }
    
    public function retrieveById($identifier)
    {
        //return $user = $this->model->find($identifier);
        return $user = $this->getQuery()->find($identifier);
    }


    public function retrieveByToken($identifier, $token)
    {
        //$user = $this->model->find($identifier);
        $user = $this->getQuery()->find($identifier);
     
        if (! $user) {
            return null;
        }

        $rememberToken = $user->getRememberToken();

        //return $rememberToken && hash_equals($rememberToken, $token) ? $user : null;

        return $rememberToken && ($token == $rememberToken) ? $user : null;
    }


    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials)) {
            return;
        }
        
        $query = $this->getQuery();

        foreach ($credentials as $key => $value) {
            if (! Str::contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        return $query->find();
    }


    public function validateCredentials($user, array $credentials)
    {
        //$ret = bcrypt_verify($credentials['password'],$user->getAuthPassword());
        //return md5($credentials['password']) == $user->getAuthPassword();
        return bcrypt_verify($credentials['password'],$user->getAuthPassword());
    }
}
