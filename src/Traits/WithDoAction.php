<?php

namespace GateGem\Core\Traits;

use GateGem\Core\Facades\Core;
use GateGem\Core\Facades\Theme;
use Illuminate\Support\Facades\Log;

trait WithDoAction
{
    public $__Params=[];
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
        return  $this->JsonParam(Core::base64Decode($param));
    }
    public function DoAction($action, $param)
    {
       $_param = Core::jsonDecode(Core::base64Decode($param));
       $this->__Params=  Core::mereArr($this->__Params,$_param);
        $action = Core::base64Decode($action);
        return  app($action)->SetComponent($this)->SetParam($this->__Params)->DoAction();
    }
}
