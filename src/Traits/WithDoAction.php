<?php

namespace GateGem\Core\Traits;

use Illuminate\Support\Facades\Log;

trait WithDoAction
{
    public function JsonParam($param)
    {
        return  json_decode(str_replace("'", '"', urldecode(base64_decode($param))), true);
    }
    public function DoAction($action, $param)
    {
        app(urldecode(base64_decode($action)))->SetComponent($this)->SetParam($this->JsonParam($param))->DoAction();
    }
}
