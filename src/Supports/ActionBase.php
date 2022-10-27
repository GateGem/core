<?php

namespace LaraPlatform\Core\Supports;

class ActionBase implements IAction
{
    protected $component;
    public function SetComponent($component)
    {
        $this->component = $component;
        return $this;
    }
    protected $param;
    public function SetParam($param)
    {
        $this->param = $param;
        return $this;
    }
    public function CallAction($action)
    {
        app($action)->SetComponent($this->component)->SetParam($this->param)->DoAction();
    }
    public function DoAction()
    {
    }
}
