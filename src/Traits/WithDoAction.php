<?php

namespace GateGem\Core\Traits;

trait WithDoAction
{
    public function DoAction($action, $param)
    {
        app(urldecode(base64_decode($action)))->SetComponent($this)->SetParam(json_decode(urldecode(base64_decode($param)), true))->DoAction();
    }
}
