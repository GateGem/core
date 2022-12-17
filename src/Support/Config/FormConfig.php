<?php

namespace GateGem\Core\Support\Config;

use GateGem\Core\Support\Core\GateData;

class FormConfig  extends GateData
{
    public const FORM_SIZE = "FORM_SIZE";
    public const FORM_CLASS = "FORM_CLASS";
    public const FORM_INCLUDE = "FORM_INCLUDE";
    public const FORM_LAYOUT = "FORM_LAYOUT";
    public const FORM_EDIT = "FORM_EDIT";
    public const FORM_RULE = "FORM_RULE";
    public const FORM_MESSAGE = "FORM_MESSAGE";
    public function setMessage($value): self
    {
        return $this->setKeyData(self::FORM_MESSAGE, $value);
    }
    public function setRule($value): self
    {
        return $this->setKeyData(self::FORM_RULE, $value);
    }
    public function setEdit($value): self
    {
        return $this->setKeyData(self::FORM_EDIT, $value);
    }
    public function setSize($value): self
    {
        return $this->setKeyData(self::FORM_SIZE, $value);
    }
    public function setClass($value): self
    {
        return $this->setKeyData(self::FORM_CLASS, $value);
    }
    public function setInclude($value): self
    {
        return $this->setKeyData(self::FORM_INCLUDE, $value);
    }
    public function setLayout($value): self
    {
        return $this->setKeyData(self::FORM_LAYOUT, $value);
    }
}
