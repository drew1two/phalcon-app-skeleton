<?php

namespace App\Common\Base;

class ModelBase extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->useDynamicUpdate(true);
    }
    
    public function beforeValidationOnCreate()
    {
        $this->is_deleted = $this->_rawValue('default');
        $this->created_at = $this->_rawValue('now()');
        $this->updated_at = $this->_rawValue('now()');
    }

    public function beforeValidationOnUpdate()
    {
        $this->updated_at = $this->_rawValue('now()');
    }
    
    public function _rawValue($value) {
        return new \Phalcon\Db\RawValue($value);
    }
}
