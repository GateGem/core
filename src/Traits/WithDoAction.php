<?php

namespace LaraPlatform\Core\Traits;


trait WithDoAction
{
    public function DoAction($action, $param)
    {
        app(urldecode($action))->SetComponent($this)->SetParam(json_decode(urldecode($param)) )->DoAction();
    }
}
