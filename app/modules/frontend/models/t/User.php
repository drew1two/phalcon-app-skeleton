<?php

namespace App\Frontend\Models\T;

use App\Common\Base\ModelBase as ModelBase;
//use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class User extends ModelBase
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource("t_users");
    }
    
    public function beforeValidationOnCreate()
    {
        parent::beforeValidationOnCreate();
        if(empty($this->is_deleted)) $this->is_deleted = $this->_rawValue('is_deleted');
    }
}
