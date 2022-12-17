<?php

namespace GateGem\Core\Support\Config;

use GateGem\Core\Support\Core\GateData;

class ConfigManager  extends GateData
{
    public const TITLE = "TITLE";
    public const DISABLE_MODULE = "DISABLE_MODULE";
    public const FUNC_QUERY = "FUNC_QUERY";
    public const FUNC_DATA = "FUNC_DATA";
    public const FUNC_FILTER = "FUNC_FILTER";
    public const FUNC_ROW = "FUNC_ROW";
    public const MODEL_KEY = "MODEL_KEY";
    public const MODEL = "MODEL";
    public const FORM = "FORM";
    public const CLASS_TABLE = "CLASS_TABLE";
    public const FIELDS = "FIELDS";
    public const ACTION = "ACTION";
    public const BUTTON_APPEND = "BUTTON_APPEND";
    public const PAGE_SIZE = "PAGE_SIZE";
    public const ADD = "ADD";
    public const EDIT = "EDIT";
    public const REMOVE = "REMOVE";
    public const FILTER = "FILTER";
    public const SORT = "SORT";
    public const INPORT_EXCEL = "INPORT_EXCEL";
    public const EXPORT_EXCEL = "EXPORT_EXCEL";
    public const POLL = "POLL";

    public const INCLUDE_BEFORE = "INCLUDE_BEFORE";

    public const INCLUDE_AFTER = "INCLUDE_AFTER";

    public function setIncludeAfter($value): self
    {
        return $this->setKeyData(self::INCLUDE_AFTER, $value);
    }
    public function setIncludeBefore($value): self
    {
        return $this->setKeyData(self::INCLUDE_BEFORE, $value);
    }
    public function setPoll($value): self
    {
        return $this->setKeyData(self::POLL, $value);
    }
    public function setButtonAppend(array $value = [])
    {
        if (!isset($this[self::ACTION])) $this[self::ACTION] = [];
        $this[self::ACTION][self::BUTTON_APPEND] = $value;
        return $this;
    }
    public function hideRemove()
    {
        if (!isset($this[self::ACTION])) $this[self::ACTION] = [];
        $this[self::ACTION][self::REMOVE] = false;
        return $this;
    }
    public function hideEdit()
    {
        if (!isset($this[self::ACTION])) $this[self::ACTION] = [];
        $this[self::ACTION][self::EDIT] = false;
        return $this;
    }
    public function hideAdd()
    {
        if (!isset($this[self::ACTION])) $this[self::ACTION] = [];
        $this[self::ACTION][self::ADD] = false;
        return $this;
    }
    public function disableFilter(): self
    {
        if (!isset($this[self::ACTION])) $this[self::ACTION] = [];
        $this[self::ACTION][self::FILTER] = false;
        return $this;
    }
    public function disableSort(): self
    {
        if (!isset($this[self::ACTION])) $this[self::ACTION] = [];
        $this[self::ACTION][self::SORT] = false;
        return $this;
    }
    public function setPageSize($value): self
    {
        return $this->setKeyData(self::PAGE_SIZE, $value);
    }
    public function setAction($value): self
    {
        return $this->setKeyData(self::ACTION, $value);
    }
    public function setFields(array $value = []): self
    {
        return $this->setKeyData(self::FIELDS, $value);
    }
    public function setForm($value): self
    {
        return $this->setKeyData(self::FORM, $value);
    }
    public function setModel($value): self
    {
        return $this->setKeyData(self::MODEL, $value);
    }
    public function setModelKey($value = "id"): self
    {
        return $this->setKeyData(self::MODEL_KEY, $value);
    }
    public function setTitle($value): self
    {
        return $this->setKeyData(self::TITLE, $value);
    }
    public function disableModule($value = true): self
    {
        return $this->setKeyData(self::DISABLE_MODULE, $value);
    }
    public function setFuncFilter(callable $value): self
    {
        return $this->setKeyData(self::FUNC_FILTER, $value);
    }
    public function setFuncQuery(callable $value): self
    {
        return $this->setKeyData(self::FUNC_QUERY, $value);
    }
    public function setFuncData(callable| array $value): self
    {
        return $this->setKeyData(self::FUNC_DATA, $value);
    }
    public function Field($field = ''): FieldConfig
    {
        return (new FieldConfig())->setField($field);
    }
    public function Form(): FormConfig
    {
        return new FormConfig();
    }
    public function Button($title = ''): ButtonConfig
    {
        return (new ButtonConfig())->setTitle($title);
    }
    public function NewItem($title = ''): self
    {
        return (new self)->setTitle($title);
    }
}
