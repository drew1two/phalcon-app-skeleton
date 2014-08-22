<?php

namespace App\Admin\Controllers;

class DummyController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function jsonAction() {
        $data = array(
            'hi' => $this->_translator->_('hi'),
            'nums' => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
        );
        return $this->_jsonResponse($data);
    }

    public function cacheAction() {
        $cache = $this->di->get('cache');
        $savedTime = $cache->get('savedTime');
        if(empty($savedTime)) {
            $savedTime = date('Y-m-d H:i:s');
            $cache->save('savedTime', $savedTime);
        }
        $this->view->setVar('savedTime', $savedTime);
    }

    public function sessionAction() {
        if ($this->session->has('savedTime')) {
            $savedTime = $this->session->get('savedTime');
        } else {
            $savedTime = date('Y-m-d H:i:s');
            $this->session->set('savedTime', $savedTime);
        }
        $this->view->setVar('savedTime', $savedTime);
    }

    public function uploadAction() {
        $result = '';
        if ($this->request->hasFiles()) {
            foreach ($this->request->getUploadedFiles() as $file) {
                $result .= $file->getName() . ' ' . $file->getSize() . '<br>' . PHP_EOL;
                $file->moveTo('upload/' . $file->getName());
            }
        }
        $this->view->setVar('result', $result);
    }

}

