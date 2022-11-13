<?php

namespace LaraIO\Core\Traits;

use Illuminate\Support\Facades\Log;

trait WithDoAction
{
    public function DoAction($action, $param)
    {
        $varParam = json_decode(json_decode(urldecode(base64_decode($param))));
        // Log::info('DoAction');
        // Log::info(gettype($varParam));
        // Log::info('/DoAction');
        app(urldecode(base64_decode($action)))->SetComponent($this)->SetParam($varParam)->DoAction();
    }
}
