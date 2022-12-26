<?php

namespace GateGem\Core\Support\Config;

use GateGem\Core\Builder\Form\FieldBuilder;

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
    public const TYPE_WIDGET_DEFAULT="index";
    public const TYPE_WIDGET_CHARTJS="chartjs";
    public const TYPE_WIDGET_INCLUDE="include";
    public const TYPE_WIDGET_TABLE="table";
    public const TYPE_WIDGET_FORM="form";

    public const WIDGET_FUNC_DATA = "WIDGET_FUNC_DATA";
    public const WIDGET_ACTION_NAME = "WIDGET_ACTION_NAME";
    public const WIDGET_ACTION_PARAM = "WIDGET_ACTION_PARAM";
    public const WIDGET_POLL = "WIDGET_POLL";
    public const WIDGET_FIELDS = "WIDGET_FIELDS";
    public const WIDGET_FORM = "WIDGET_FORM";
    public const WIDGET_INCLUDE = "WIDGET_INCLUDE";
    public const WIDGET_COLUMN = "WIDGET_COLUMN";
    public const WIDGET_NAME = "WIDGET_NAME";
    public const WIDGET_POSITION = "WIDGET_POSITION";
    public function setFields($value = []): self
    {
        return $this->setKeyData(self::WIDGET_FIELDS, $value);
    }
    public function setForm($value): self
    {
        return $this->setKeyData(self::WIDGET_FORM, $value);
    }
    public function setInclude($value): self
    {
        return $this->setKeyData(self::WIDGET_INCLUDE, $value);
    }
    public function setFuncData($value): self
    {
        return $this->setKeyData(self::WIDGET_FUNC_DATA, $value);
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
    public function setPosition($value): self
    {
        return $this->setKeyData(self::WIDGET_POSITION, $value);
    }
    public function setWidgetName($value): self
    {
        return $this->setKeyData(self::WIDGET_NAME, $value);
    }
    public function getFields($value = []): self
    {
        return $this->getKeyData(self::WIDGET_FIELDS, $value);
    }
    public function getForm($value = ''): self
    {
        return $this->getKeyData(self::WIDGET_FORM, $value);
    }
    public function getInclude($value = '')
    {
        return $this->getKeyData(self::WIDGET_INCLUDE, $value);
    }
    public function getFuncData($value = '')
    {
        return $this->getKeyData(self::WIDGET_FUNC_DATA, $value);
    }
    public function getActionName($value = '')
    {
        return $this->getKeyData(self::WIDGET_ACTION_NAME, $value);
    }
    public function getActionParam($value = '')
    {
        return $this->getKeyData(self::WIDGET_ACTION_PARAM, $value);
    }
    public function getColumn($value = FieldBuilder::Col6)
    {
        return $this->getKeyData(self::WIDGET_COLUMN, $value);
    }
    public function getPoll($value = '')
    {
        return $this->getKeyData(self::WIDGET_POLL, $value);
    }
    public function getPosition($value = 'header')
    {
        return $this->getKeyData(self::WIDGET_POSITION, $value);
    }
    public function getWidgetName($value = 'core::dashboard')
    {
        return $this->getKeyData(self::WIDGET_NAME, $value);
    }
}
