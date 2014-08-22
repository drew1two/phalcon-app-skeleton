<?php

namespace App\Frontend\Models\M;

class Category extends ModelBase
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource("m_categories");
    }
}