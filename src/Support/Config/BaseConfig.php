<?php

namespace GateGem\Core\Support\Config;

use GateGem\Core\Support\Core\GateData;

class BaseConfig extends GateData
{
    public const Type_SHOW = 1;
    public const Type_HIDE = -1;
    public const Type_DISABLE = 0;
    public const DATA_TITLE = "DATA_TITLE";
    public const DATA_ICON = "DATA_ICON";
    public const DATA_CLASS = "DATA_CLASS";
    public const DATA_PERMISSION = "DATA_PERMISSION";
    public const DATA_ENABLE = "DATA_ENABLE";
    public const DATA_SORT = "DATA_SORT";
    public const DATA_ATTR = "DATA_ATTR";
    public const DATA_TYPE = "DATA_TYPE";
    public function Disable(): self
    {
        return $this->setEnable(BaseConfig::Type_DISABLE);
    }
    public function Enable(): self
    {
        return $this->setEnable(BaseConfig::Type_SHOW);
    }
    public function Hide(): self
    {
        return $this->setEnable(BaseConfig::Type_HIDE);
    }
    public function setClass($value): self
    {
        return $this->setKeyData(BaseConfig::DATA_CLASS, $value);
    }
    public function setTitle($value): self
    {
        return $this->setKeyData(BaseConfig::DATA_TITLE, $value);
    }
    public function setType($value): self
    {
        return $this->setKeyData(BaseConfig::DATA_TYPE, $value);
    }
    public function setIcon($value): self
    {
        return $this->setKeyData(BaseConfig::DATA_ICON, $value);
    }
    public function setEnable($value): self
    {
        return $this->setKeyData(BaseConfig::DATA_ENABLE, $value);
    }
    public function setPermission($value): self
    {
        return $this->setKeyData(BaseConfig::DATA_PERMISSION, $value);
    }
    public function setSort($value): self
    {
        return $this->setKeyData(BaseConfig::DATA_SORT, $value);
    }
    public function setAttr($value): mixed
    {
        return $this->setKeyData(BaseConfig::DATA_ATTR, $value);
    }
    public function getClass($value = '')
    {
        return $this->getKeyData(BaseConfig::DATA_CLASS, $value);
    }
    public function getTitle($value = '')
    {
        return $this->getKeyData(BaseConfig::DATA_TITLE, $value);
    }
    public function getType($value = '')
    {
        return $this->getKeyData(BaseConfig::DATA_TYPE, $value);
    }
    public function getIcon($value = '')
    {
        return $this->getKeyData(BaseConfig::DATA_ICON, $value);
    }
    public function getEnable($value = true)
    {
        return $this->getKeyData(BaseConfig::DATA_ENABLE, $value);
    }
    public function getPermission($value = '')
    {
        return $this->getKeyData(BaseConfig::DATA_PERMISSION, $value);
    }
    public function getSort($value = 0)
    {
        return $this->getKeyData(BaseConfig::DATA_SORT, $value);
    }
    public function getAttr($value = '')
    {
        return $this->getKeyData(BaseConfig::DATA_ATTR, $value);
    }
}
