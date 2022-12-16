<?php

namespace GateGem\Core\Support\Config;

use GateGem\Core\Support\Core\GateData;

class FieldConfig  extends GateData
{
    public const FIELD = "field";
    public const TITLE = "title";
    public const FIELD_TYPE = "fieldType";
    public const KEY_LAYOUT = "keyColumn";
    public const FUNC_DATA = "funcData";
    public const FUNC_CELL = "funcCell";
    public const VIEW = "view";
    public const EDIT = "edit";
    public const ADD = "add";
    public const ATTR = "attr";
    public function setFuncData(callable| array $callback): self
    {
        $this[self::FUNC_DATA] = $callback;
        return $this;
    }
    public function setFuncCell(callable| array $callback): self
    {
        $this[self::FUNC_DATA] = $callback;
        return $this;
    }
    public function setAttr($attr): self
    {
        $this[self::ATTR] = $attr;
        return $this;
    }
    public function setKeyLayout($keyLayout): self
    {
        $this[self::KEY_LAYOUT] = $keyLayout;
        return $this;
    }
    public function setFieldType($fieldType): self
    {
        $this[self::FIELD_TYPE] = $fieldType;
        return $this;
    }
    public function setTitle($title): self
    {
        $this[self::TITLE] = $title;
        return $this;
    }
    public function setField($field): self
    {
        $this[self::FIELD] = $field;
        return $this;
    }
    public function hideView(): self
    {
        $this[self::VIEW] = false;
        return $this;
    }
    public function hideAdd(): self
    {
        $this[self::ADD] = false;
        return $this;
    }
    public function hideEdit(): self
    {
        $this[self::EDIT] = false;
        return $this;
    }
}
