<?php

namespace GateGem\Core\Support\Config;

use GateGem\Core\Support\Core\GateData;

class OptionConfig  extends GateData
{
    public const TITLE = "BUTTON_TITLE";
    public const CLASS_NAME = "CLASS_NAME";
    public const SORT = "SORT";
    public const ICON = "BUTTON_ICON";
    public const FIELDS = "FIELDS";
    public const ENABLE = "ENABLE";

    public function setIcon($value): self
    {
        return $this->setKeyData(self::ICON, $value);
    }
    public function setClass($value): self
    {
        return $this->setKeyData(self::CLASS_NAME, $value);
    }
    public function setTitle($value): self
    {
        return $this->setKeyData(self::TITLE, $value);
    }
    public function setSort($value): self
    {
        return $this->setKeyData(self::SORT, $value);
    }
    public function setFields(array $value = []): self
    {
        return $this->setKeyData(self::FIELDS, $value);
    }
    public function Disable($value = false):self
    {
        return $this->setKeyData(self::ENABLE, $value);
    }
    public function getIcon($value = '')
    {
        return $this->getDataValue(self::ICON, $value);
    }
    public function getClass($value = '')
    {
        return $this->getDataValue(self::CLASS_NAME, $value);
    }
    public function getTitle($value = '')
    {
        return $this->getDataValue(self::TITLE, $value);
    }
    public function getSort($value = '')
    {
        return $this->getDataValue(self::SORT, $value);
    }
    public function getFields($value = [])
    {
        return $this->getDataValue(self::FIELDS, $value);
    }
    public function getEnable($value = true)
    {
        return $this->getDataValue(self::ENABLE, $value);
    }
}
