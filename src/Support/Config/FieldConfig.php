<?php

namespace GateGem\Core\Support\Config;

use GateGem\Core\Support\Core\GateData;

class FieldConfig  extends GateData
{
    public const FIELD = "FIELD";
    public const FIELD_COLUMN = "FIELD_COLUMN";
    public const FIELD_TYPE = "FIELD_TYPE";
    public const ACTION = "ACTION";
    public const TITLE = "TITLE";
    public const CLASS_HEADER = "CLASS_HEADER";
    public const CLASS_DATA = "CLASS_DATA";
    public const KEY_LAYOUT = "KEY_LAYOUT";
    public const FUNC_DATA = "FUNC_DATA";
    public const FUNC_CELL = "FUNC_CELL";
    public const DATA_KEY = "DATA_KEY";
    public const DATA_TEXT = "DATA_TEXT";
    public const DATA_DEFAULT = "DATA_DEFAULT";
    public const DATA_FORMAT = "DATA_FORMAT";
    public const DATA_FORMAT_JS = "DATA_FORMAT_JS";
    public const INCLUDE = "INCLUDE";
    public const FOLDER = "FOLDER";
    public const VIEW = "VIEW";
    public const EDIT = "EDIT";
    public const ADD = "ADD";
    public const FILTER = "FILTER";
    public const SORT = "SORT";
    public const ATTR = "ATTR";


    public function setFieldColumn($value): self
    {
        return $this->setKeyData(self::FIELD_COLUMN, $value);
    }
    public function setFolder($value): self
    {
        return $this->setKeyData(self::FOLDER, $value);
    }
    public function setInclude($value): self
    {
        return $this->setKeyData(self::INCLUDE, $value);
    }
    public function setAction($value): self
    {
        return $this->setKeyData(self::ACTION, $value);
    }
    public function setDataKey($value): self
    {
        return $this->setKeyData(self::DATA_KEY, $value);
    }
    public function setDataText($value): self
    {
        return $this->setKeyData(self::DATA_TEXT, $value);
    }
    public function setDataDefault($value): self
    {
        return $this->setKeyData(self::DATA_DEFAULT, $value);
    }
    public function setDataFormat($value): self
    {
        return $this->setKeyData(self::DATA_FORMAT, $value);
    }
    public function setDataFormatJs($value): self
    {
        return $this->setKeyData(self::DATA_FORMAT_JS, $value);
    }
    public function setClassHeader($value): self
    {
        return $this->setKeyData(self::CLASS_HEADER, $value);
    }
    public function setClassData($value): self
    {
        return $this->setKeyData(self::CLASS_DATA, $value);
    }
    public function setFuncData(callable| array $value): self
    {
        return $this->setKeyData(self::FUNC_DATA, $value);
    }
    public function setFuncCell(callable $value): self
    {
        return $this->setKeyData(self::FUNC_CELL, $value);
    }
    public function setAttr($value): self
    {
        return $this->setKeyData(self::ATTR, $value);
    }
    public function setKeyLayout($value): self
    {
        return $this->setKeyData(self::KEY_LAYOUT, $value);
    }
    public function setFieldType($value): self
    {
        return $this->setKeyData(self::FIELD_TYPE, $value);
    }
    public function setTitle($value): self
    {
        return $this->setKeyData(self::TITLE, $value);
    }
    public function setField($value): self
    {
        return $this->setKeyData(self::FIELD, $value);
    }
    public function hideView(): self
    {
        return $this->setKeyData(self::VIEW, false);
    }
    public function hideAdd(): self
    {
        return $this->setKeyData(self::ADD, false);
    }
    public function hideEdit(): self
    {
        return $this->setKeyData(self::EDIT, false);
    }
    public function disableFilter(): self
    {
        return $this->setKeyData(self::FILTER, false);
    }
    public function disableSort(): self
    {
        return $this->setKeyData(self::SORT, false);
    }
}
