<?php

namespace GateGem\Core\Traits;

use GateGem\Core\Facades\Theme;
use Illuminate\Support\Facades\Log;

trait WithDoAction
{
    public $__Params;
    protected $__request;
    public function bootWithDoAction()
    {
        Theme::Layout();
        $this->__request = request();
        if ($this->__request->get('param'))
            $this->__Params = $this->JsonParam($this->__request->get('param'));
    }
    public function getValueBy($key, $default = null)
    {
        if (isset($this->__Params) && $this->__Params && isset($this->__Params[$key])) {
            return $this->__Params[$key];
        }
        return request($key, $default);
    }
    public function JsonParam($param)
    {
        return  json_decode(str_replace("'", '"', urldecode($param)), true);
    }
    public function JsonParam64($param)
    {
        return  $this->JsonParam(base64_decode($param));
    }
    public function DoAction($action, $param)
    {
        $this->__Params = $this->JsonParam64($param);
        return  app(urldecode(base64_decode($action)))->SetComponent($this)->SetParam($this->__Params)->DoAction();
    }
}
