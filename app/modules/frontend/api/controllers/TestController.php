<?php

namespace App\Frontend\Api\Controllers;

class TestController extends ApiControllerBase
{
    public function indexAction($name = 'from index')
    {
        $this->dispatcher->forward(array(
            'controller' => 'test',
            'action' => 'hello',
            'params' => array($name)
        ));
    }

    public function helloAction($name = 'world')
    {
        $this->logger->log('warForwarded:' . $this->dispatcher->wasForwarded());
        return array(
            'msg' => $this->_translator->_('hi') . ' ' . $name,
        );
    }

    public function secretAction($msg)
    {
        $msg = str_replace(' ', '+', $msg);
        return array(
            'msg' => $this->decrypt($msg),
        );
    }

    public function uploadAction()
    {
        $url = new \Phalcon\Mvc\Url();
        $imagePath = '';
        if ($this->request->hasFiles()) {
            foreach ($this->request->getUploadedFiles() as $file) {
                $imagePath = 'files/' . $file->getName();
                $file->moveTo($imagePath);
                // 画像1枚の場合
                break;
            }
        }
        return array(
            'imagePath' => $imagePath,
        );
    }

    public function helloWorldAction($msg = 'MMM...')
    {
        return array(
            'msg' => "hello World, $msg",
        );
    }
}

