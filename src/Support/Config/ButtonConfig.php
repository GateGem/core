<?php

namespace GateGem\Core\Support\Config;

use GateGem\Core\Facades\Core;
use GateGem\Core\Http\Action\ChangeFieldValue;

/**
 * 
 * @method  \GateGem\Core\Support\Config\ButtonConfig Disable()
 * @method  \GateGem\Core\Support\Config\ButtonConfig Enable()
 * @method  \GateGem\Core\Support\Config\ButtonConfig Hide()
 * @method  \GateGem\Core\Support\Config\ButtonConfig setClass(string $value)
 * @method  \GateGem\Core\Support\Config\ButtonConfig setTitle(string $value)
 * @method  \GateGem\Core\Support\Config\ButtonConfig setType($value)
 * @method  \GateGem\Core\Support\Config\ButtonConfig setIcon($value)
 * @method  \GateGem\Core\Support\Config\ButtonConfig setPermission($value)
 * @method  \GateGem\Core\Support\Config\ButtonConfig setSort($value)
 * @method  \GateGem\Core\Support\Config\ButtonConfig setAttr($value)
 * 
 * @see  \GateGem\Core\Support\Config\ButtonConfig
 */
class ButtonConfig  extends BaseConfig
{
    public const TYPE_ADD = "TYPE_ADD";
    public const TYPE_UPDATE = "TYPE_UPDATE";
    public const BUTTON_ACTION = "BUTTON_ACTION";
    public const BUTTON_DO_ACTION = "BUTTON_DO_ACTION";
    public const BUTTON_DO_COMPONENT = "BUTTON_DO_COMPONENT";
    public const BUTTON_DO_CONFIRM = "BUTTON_DO_CONFIRM";

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
    public function checkType($type = '')
    {
        if (!\GateGem\Core\Facades\Core::checkPermission($this->getPermission())) return false;
        if ($type == '') return true;
        return $this->getType() == $type;
    }
    private function getActionAndParam($type, $param)
    {
        $action = $this[$type];
        $_action = $action['action'];
        $_param = $action['param'];
        if (is_callable($_action)) $_action = count($param) > 0 ? call_user_func_array($_action, $param) : $_action();
        if (is_callable($_param)) $_param =  count($param) > 0 ? call_user_func_array($_param, $param) : $_param();
        return ['_action' => $_action, '_param' => $_param, '_type' => $type];
    }
    public function getActionButton($param)
    {
        if ($this->CheckKey(self::BUTTON_ACTION)) {
            return $this->getActionAndParam(self::BUTTON_ACTION, $param);
        }
        if ($this->CheckKey(self::BUTTON_DO_ACTION)) {
            return $this->getActionAndParam(self::BUTTON_DO_ACTION, $param);
        }
        if ($this->CheckKey(self::BUTTON_DO_COMPONENT)) {
            return  $this->getActionAndParam(self::BUTTON_DO_COMPONENT, $param);
        }
        if ($this->CheckKey(self::BUTTON_DO_CONFIRM)) {
            return  $this->getActionAndParam(self::BUTTON_DO_CONFIRM, $param);
        }
        return null;
    }
    public function toHtml()
    {
        $attr = '';
        if (['_action' => $_action, '_param' => $_param, '_type' => $_type] = $this->getActionButton(func_get_args())) {
            switch ($_type) {
                case self::BUTTON_ACTION:
                    $attr = "wire:click=\"{$_action}($_param)\"";
                    break;
                case self::BUTTON_DO_ACTION:
                    $attr = "wire:click=\"DoAction('" . (Core::base64Encode($_action)) . "','" . (Core::base64Encode($_param))  . "')\"";
                    break;
                case self::BUTTON_DO_COMPONENT:
                    $attr = "wire:component=\"{$_action}($_param)\"";
                    break;
                case self::BUTTON_DO_CONFIRM:
                    $attr = "wire:confirm=\"{$_action}($_param)\"";
                    break;
            }
        }
        $attr = $attr . ' ' . $this->getAttr();
        $title = __($this->getTitle());
        $icon = $this->getIcon();
        $class =  $this->getClass('btn btn-sm btn-danger');
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
