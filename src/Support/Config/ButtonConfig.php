<?php

namespace GateGem\Core\Support\Config;

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
    public const BUTTON_ICON = "BUTTON_ICON";

    public function setIcon($value): self
    {
        return $this->setKeyData(self::BUTTON_ICON, $value);
    }
    public function setAction($value): self
    {
        return $this->setKeyData(self::BUTTON_ACTION, $value);
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
}
