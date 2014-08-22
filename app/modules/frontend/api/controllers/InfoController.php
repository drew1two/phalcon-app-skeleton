<?php

namespace App\Frontend\Api\Controllers;

class InfoController extends ApiControllerBase
{
    public function versionAction()
    {
        return array(
            'version' => $this->config->apiVersion
        );
    }

}
