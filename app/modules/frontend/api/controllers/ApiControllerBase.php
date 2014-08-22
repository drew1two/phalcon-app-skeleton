<?php

namespace App\Frontend\Api\Controllers;

use App\Frontend\Controllers\ControllerBase;
use App\Common\Utils\Security;

class ApiControllerBase extends ControllerBase
{
    protected function initialize()
    {
        //error_log('initialize');
        parent::initialize();
        
        $this->view->disable();
        $this->response->setContentType('application/json', 'UTF-8');
    }
    
    // before route executed event
    /*
    public function beforeExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher)
    {
        //error_log('beforeExecuteRoute');
        $config = $this->di->get('config');
        if(!Security::isValidUrl($config->secretKey)) {
            $data = array(
                'error' => 'Invalid URL'
            );
            $this->response->setJsonContent($data);
            $this->response->send();
            return false;
        }
    }
    */
    
    // After route executed event
    public function afterExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher)
    {
        //error_log('afterExecuteRoute');
        $data = $dispatcher->getReturnedValue();
        if (!is_array($data)) {
            $data = array(
                'data' => $data
            );
        }
        $this->response->setJsonContent($data);
        $this->response->send();
        return false;
    }

    // 暗号化された文字列の復号
    protected function decrypt($str)
    {
        return Security::AES256Decrypt($str, $this->config->secretKey);
    }
}

