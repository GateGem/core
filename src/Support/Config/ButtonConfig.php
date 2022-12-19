<?php

namespace GateGem\Core\Support\Config;

use GateGem\Core\Http\Action\ChangeFieldValue;
use GateGem\Core\Support\Core\GateData;

class ButtonConfig  extends GateData
{
    public const TYPE_ADD = "TYPE_ADD";
    public const TYPE_UPDATE = "TYPE_UPDATE";
    public const BUTTON_TITLE = "BUTTON_TITLE";
    public const BUTTON_CLASS = "BUTTON_CLASS";
    public const BUTTON_TYPE = "BUTTON_TYPE";
    public const BUTTON_PERMISSION = "BUTTON_PERMISSION";
    public const BUTTON_ACTION = "BUTTON_ACTION";
    public const BUTTON_DO_ACTION = "BUTTON_DO_ACTION";
    public const BUTTON_DO_COMPONENT = "BUTTON_DO_COMPONENT";
    public const BUTTON_DO_CONFIRM = "BUTTON_DO_CONFIRM";
    public const BUTTON_ATTR = "BUTTON_ATTR";
    public const BUTTON_ICON = "BUTTON_ICON";

    public function setIcon($value): self
    {
        return $this->setKeyData(self::BUTTON_ICON, $value);
    }
    public function setConfirm($value, $param = '{}'): self
    {
        if (is_string($param)) $param = function () use ($param) {
            return $param;
        };
        if (!is_array($value)) $value = ['action' => $value];
        $value['param'] = $param;
        return $this->setKeyData(self::BUTTON_DO_CONFIRM, $value);
    }
    public function setAction($value, $param = '{}'): self
    {
        if (is_string($param)) $param = function () use ($param) {
            return $param;
        };
        if (!is_array($value)) $value = ['action' => $value];
        $value['param'] = $param;
        return $this->setKeyData(self::BUTTON_ACTION, $value);
    }
    public function setDoAction($value, $param = '{}'): self
    {
        if (is_string($param)) $param = function () use ($param) {
            return $param;
        };
        if (!is_array($value)) $value = ['action' => $value];
        $value['param'] = $param;
        return $this->setKeyData(self::BUTTON_DO_ACTION, $value);
    }
    public function setDoChangeField($param = '{}'): self
    {
        return $this->setDoAction(ChangeFieldValue::class, $param);
    }
    public function setDoComponent($value, $param = '{}'): self
    {
        if (is_string($param)) $param = function () use ($param) {
            return $param;
        };
        if (!is_array($value)) $value = ['action' => $value];
        $value['param'] = $param;
        return $this->setKeyData(self::BUTTON_DO_COMPONENT, $value);
    }
    public function setAttr($value): self
    {
        return $this->setKeyData(self::BUTTON_ATTR, $value);
    }
    public function setPermission($value): self
    {
        return $this->setKeyData(self::BUTTON_PERMISSION, $value);
    }
    public function setType($value): self
    {
        return $this->setKeyData(self::BUTTON_TYPE, $value);
    }
    public function setClass($value): self
    {
        return $this->setKeyData(self::BUTTON_CLASS, $value);
    }
    public function setTitle($value): self
    {
        return $this->setKeyData(self::BUTTON_TITLE, $value);
    }
    public function checkType($type = '')
    {
        if (!(!isset($this[ButtonConfig::BUTTON_PERMISSION]) ||  \GateGem\Core\Facades\Core::checkPermission($this[ButtonConfig::BUTTON_PERMISSION]))) return false;
        if (!$this->CheckKey(ButtonConfig::BUTTON_TYPE)) return $type == '';
        return $this[ButtonConfig::BUTTON_TYPE] == $type;
    }
    private function getActionAndParam($type, $param)
    {
        $action = $this[$type];
        $_action = $action['action'];
        $_param = $action['param'];
        if (is_callable($_action)) $_action = count($param) > 0 ? call_user_func_array($_action, $param) : $_action();
        if (is_callable($_param)) $_param =  count($param) > 0 ? call_user_func_array($_param, $param) : $_param();
        return ['_action' => $_action, '_param' => $_param];
    }
    public function toHtml()
    {
        $attr = '';
        if ($this->CheckKey(self::BUTTON_ACTION)) {
            ['_action' => $_action, '_param' => $_param] = $this->getActionAndParam(self::BUTTON_ACTION, func_get_args());
            $attr = "wire:click=\"{$_action}($_param)\"";
        }
        if ($this->CheckKey(self::BUTTON_DO_ACTION)) {
            ['_action' => $_action, '_param' => $_param] = $this->getActionAndParam(self::BUTTON_DO_ACTION, func_get_args());
            $attr = "wire:click=\"DoAction('" . base64_encode(urlencode($_action)) . "','" . base64_encode(urlencode($_param))  . "')\"";
        }
        if ($this->CheckKey(self::BUTTON_DO_COMPONENT)) {
            ['_action' => $_action, '_param' => $_param] = $this->getActionAndParam(self::BUTTON_DO_COMPONENT, func_get_args());
            $attr = "wire:component=\"{$_action}($_param)\"";
        }
        if ($this->CheckKey(self::BUTTON_DO_CONFIRM)) {
            ['_action' => $_action, '_param' => $_param] = $this->getActionAndParam(self::BUTTON_DO_CONFIRM, func_get_args());
            $attr = "wire:confirm=\"{$_action}($_param)\"";
        }
        if ($this->CheckKey(self::BUTTON_ATTR))
            $attr = $attr . ' ' . $this[self::BUTTON_ATTR];
        $title = __($this[self::BUTTON_TITLE]);
        $icon = '';
        if ($this->CheckKey(self::BUTTON_ICON))
            $icon = $this[self::BUTTON_ICON];
            $class = 'btn btn-sm btn-default';
            if ($this->CheckKey(self::BUTTON_CLASS))
                $class = $this[self::BUTTON_CLASS];
        return <<<EOT
        <button class="{$class}" {$attr} title="{$title}">
        {$icon}
        <span>
        {$title}
        </span>
        </button>
        EOT;
    }
}
