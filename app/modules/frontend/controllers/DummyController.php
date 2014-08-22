<?php

namespace App\Frontend\Controllers;

use Phalcon\Mvc\View;
use App\Common\Utils\Security;
use App\Frontend\Models\T\Dummy;
use App\Frontend\Models\T\User;

class DummyController extends ControllerBase
{

    public function indexAction()
    {
        $url = new \Phalcon\Mvc\Url();
        $secureUrl = Security::buildSecureUrl($url->get('api/test/hello/Phalcon'), $this->config->secretKey);
        $this->view->setVar('secureUrl', $secureUrl);
    }

    public function jsonAction()
    {
        $data = array(
            'hi' => $this->_translator->_('hi'),
            'nums' => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
        );
        return $this->_jsonResponse($data);
    }

    public function cacheAction()
    {
        $cache = $this->di->get('cache');
        $savedTime = $cache->get('savedTime');
        if(empty($savedTime)) {
            $savedTime = date('Y-m-d H:i:s');
            $cache->save('savedTime', $savedTime);
        }
        $this->view->setVar('savedTime', $savedTime);
    }

    public function sessionAction()
    {
        if ($this->session->has('savedTime')) {
            $savedTime = $this->session->get('savedTime');
        } else {
            $savedTime = date('Y-m-d H:i:s');
            $this->session->set('savedTime', $savedTime);
        }
        $this->view->setVar('savedTime', $savedTime);
    }

    public function uploadAction()
    {
        $result = '';
        if ($this->request->hasFiles()) {
            foreach ($this->request->getUploadedFiles() as $file) {
                $result .= $file->getName() . ' ' . $file->getSize() . '<br>' . PHP_EOL;
                //$file->moveTo('files/' . $file->getName());
                $file->moveTo(UPLOAD_PATH . '/' . $file->getName());
            }
        }
        if($this->_isAppRequest()) {
            error_log('_isAppRequest');
            $data = array(
                'result' => $result,
            );
            return $this->_jsonResponse($data);
        } else {
            $this->view->setVar('result', $result);
        }
    }

    public function findAction()
    {
        $dummies = Dummy::find(array(
            '',
            'order' => 'id',
            'limit' => 10
        ));
        $this->view->setVar('dummies', $dummies);
    }
    
    public function updateAction()
    {
        $dummy = Dummy::findFirst(3);
        $dummy->inf1 = 'update test';
        if($dummy->save()) {
            $this->flash->success("Updated: Dummy id={$dummy->id} inf1={$dummy->inf1} inf2={$dummy->inf2}");
        } else {
            $this->flash->error("Update failed!");
        }
    }

    public function logAction()
    {
        $this->logger->log('log test');
        $this->logger->error('error log test');
        $this->flash->success('The logs was successfully saved!');
    }

    public function mailAction()
    {
        $mail = new \Zend\Mail\Message();
        $mail->setBody('日本語メール内容.');
        $mail->setFrom('otaq@earsea.com', 'Appサーバ');
        $mail->addTo('ozw@adore.bz', '欧');
        $mail->setSubject('テストです');
        $this->flash->success('The mail was successfully send out!');

       $this->mailer->send($mail);
    }

    public function signupAction()
    {
        if ($this->request->isPost()) {
            $this->view->disableLevel(array(
                View::LEVEL_ACTION_VIEW => true,
            ));

            $user = new User();
            $user->user_name = $this->request->getPost('user_name');
            $user->user_email = $this->request->getPost('user_name');
            $user->password = $this->request->getPost('password');
            if($user->save()) {
                $this->flash->success("User Registed: user_id={$user->user_id} user_name={$user->user_name} user_email={$user->user_email}");
            } else {
                foreach ($robot->getMessages() as $message) {
                    $this->logger->log($message);
                }
                $this->flash->error("User signup failed!");
            }
        }
    }
}

