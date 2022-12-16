<?php

namespace GateGem\Core\Support\Config;

use GateGem\Core\Support\Core\GateData;

class FormConfig  extends GateData
{
    public const FORM_SIZE = "FORM_SIZE";
    public const FORM_CLASS = "FORM_CLASS";
    public const FORM_INCLUDE = "FORM_INCLUDE";
    public const FORM_LAYOUT = "FORM_LAYOUT";
    public function setSize($Size): self
    {
        $this[self::FORM_SIZE] = $Size;
        return $this;
    }
    public function setClass($Size): self
    {
        $this[self::FORM_CLASS] = $Size;
        return $this;
    }
    public function setInclude($include): self
    {
        $this[self::FORM_INCLUDE] = $include;
        return $this;
    }
    public function setLayout($layout): self
    {
        $this[self::FORM_LAYOUT] = $layout;
        return $this;
    }
}
