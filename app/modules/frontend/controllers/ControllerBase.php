<?php

namespace App\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected $_language;
    protected $_translator;
    
    protected function initialize()
    {
        $this->_language = $this->request->getBestLanguage();
        $messageFile =  $this->config->messageDir.'/'.$this->_language.'.php';
        if (!file_exists($messageFile)) {
            $this->_language = $this->config->defaultLanguage;
            $messageFile =  $this->config->messageDir.'/'.$this->_language.'.php';
        }

        $messages = include $messageFile;
        $this->_translator = new \Phalcon\Translate\Adapter\NativeArray(array(
            "content" => $messages
        ));
        
        $this->tag->setTitle($this->_translator->_('appName'));
        $this->view->setVar('t', $this->_translator);
    }
    
    protected function _jsonResponse($data)
    {
        $this->view->disable();

        $response = new \Phalcon\Http\Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setContent(json_encode($data));
        return $response;
    }
    
    protected function _isAppRequest() {
        $userAgent = $this->request->getUserAgent();
        error_log($userAgent);
        if(preg_match('#\s(CFNetwork|Scale)\/#', $userAgent)) {
            return true;
        }
        return false;
    }
}
