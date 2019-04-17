<?php

namespace app\components;

use yii\base\Component;

class TestService extends Component
{
    public $prop = 'my component. This text is located in TestService component';

    public function run()
    {
        return $this->prop;
    }
}