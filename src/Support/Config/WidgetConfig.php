<?php

namespace GateGem\Core\Support\Config;

/**
 * 
 * @method  \GateGem\Core\Support\Config\WidgetConfig Disable()
 * @method  \GateGem\Core\Support\Config\WidgetConfig Enable()
 * @method  \GateGem\Core\Support\Config\WidgetConfig Hide()
 * @method  \GateGem\Core\Support\Config\WidgetConfig setClass(string $value)
 * @method  \GateGem\Core\Support\Config\WidgetConfig setTitle(string $value)
 * @method  \GateGem\Core\Support\Config\WidgetConfig setType($value)
 * @method  \GateGem\Core\Support\Config\WidgetConfig setIcon($value)
 * @method  \GateGem\Core\Support\Config\WidgetConfig setPermission($value)
 * @method  \GateGem\Core\Support\Config\WidgetConfig setSort($value)
 * @method  \GateGem\Core\Support\Config\WidgetConfig setAttr($value)
 * 
 * @see  \GateGem\Core\Support\Config\WidgetConfig
 */

class WidgetConfig  extends BaseConfig
{
    public const WIDGET_DATA_DEFAULT = "WIDGET_DATA_DEFAULT";
    public const WIDGET_ACTION_NAME = "WIDGET_ACTION_NAME";
    public const WIDGET_ACTION_PARAM = "WIDGET_ACTION_PARAM";
    public const WIDGET_POLL = "WIDGET_POLL";
    public const WIDGET_COLUMN = "WIDGET_COLUMN";
    public function setDataDefault($value): self
    {
        return $this->setKeyData(self::WIDGET_DATA_DEFAULT, $value);
    }
    public function setActionName($value): self
    {
        return $this->setKeyData(self::WIDGET_ACTION_NAME, $value);
    }
    public function setActionParam($value): self
    {
        return $this->setKeyData(self::WIDGET_ACTION_PARAM, $value);
    }
    public function setColumn($value): self
    {
        return $this->setKeyData(self::WIDGET_COLUMN, $value);
    }
    public function setPoll($value): self
    {
        return $this->setKeyData(self::WIDGET_POLL, $value);
    }
    public function getDataDefault($value)
    {
        return $this->getKeyData(self::WIDGET_DATA_DEFAULT, $value);
    }
    public function getActionName($value = '')
    {
        return $this->getKeyData(self::WIDGET_ACTION_NAME, $value);
    }
    public function getActionParam($value = '')
    {
        return $this->getKeyData(self::WIDGET_ACTION_PARAM, $value);
    }
    public function getColumn($value)
    {
        return $this->getKeyData(self::WIDGET_COLUMN, $value);
    } 
    public function getPoll($value)
    {
        return $this->getKeyData(self::WIDGET_POLL, $value);
    }
}
