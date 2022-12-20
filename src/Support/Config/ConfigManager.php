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
    public const ACTION_TITLE = "ACTION_TITLE";
    public const BUTTON_APPEND = "ACTION_BUTTON_APPEND";
    public const PAGE_SIZE = "PAGE_SIZE";
    public const ADD = "ACTION_ADD";
    public const EDIT = "ACTION_EDIT";
    public const REMOVE = "ACTION_REMOVE";
    public const FILTER = "ACTION_FILTER";
    public const SORT = "ACTION_SORT";
    public const INPORT_EXCEL = "INPORT_EXCEL";
    public const EXPORT_EXCEL = "EXPORT_EXCEL";
    public const POLL = "POLL";

    public const INCLUDE_BEFORE = "INCLUDE_BEFORE";

    public const INCLUDE_AFTER = "INCLUDE_AFTER";

    public function hideRemove()
    {
        $this[self::REMOVE] = false;
        return $this;
    }
    public function hideEdit()
    {
        $this[self::EDIT] = false;
        return $this;
    }
    public function hideAdd()
    {
        $this[self::ADD] = false;
        return $this;
    }
    public function disableFilter(): self
    {
        $this[self::FILTER] = false;
        return $this;
    }
    public function disableSort(): self
    {
        $this[self::SORT] = false;
        return $this;
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
    public function setPageSize($value): self
    {
        return $this->setKeyData(self::PAGE_SIZE, $value);
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
        $this[self::BUTTON_APPEND] = $value;
        return $this;
    }

    public function getFuncFilter($value = null)
    {
        return $this->getDataValue(self::FUNC_FILTER, $value);
    }
    public function getFuncQuery($value = null)
    {
        return $this->getDataValue(self::FUNC_QUERY, $value);
    }
    public function getFuncData($value = null)
    {
        return $this->getDataValue(self::FUNC_DATA, $value);
    }
    public function getPageSize($value = null)
    {
        return $this->getDataValue(self::PAGE_SIZE, $value);
    }
    public function getFields(array $value = [])
    {
        return $this->getDataValue(self::FIELDS, $value);
    }
    public function getForm($value = null)
    {
        return $this->getDataValue(self::FORM, $value);
    }
    public function getModel($value = null)
    {
        return $this->getDataValue(self::MODEL, $value);
    }
    public function getModelKey($value = "id")
    {
        return $this->getDataValue(self::MODEL_KEY, $value);
    }
    public function getTitle($value = null)
    {
        return $this->getDataValue(self::TITLE, $value);
    }
    public function getIncludeAfter($value = null)
    {
        return $this->getDataValue(self::INCLUDE_AFTER, $value);
    }
    public function getIncludeBefore($value = null)
    {
        return $this->getDataValue(self::INCLUDE_BEFORE, $value);
    }
    public function getPoll($value = null)
    {
        return $this->getDataValue(self::POLL, $value);
    }
    public function getButtonAppend(array $value = [])
    {
        return $this->getDataValue(self::BUTTON_APPEND, $value);
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
    public function Option($title = ''): OptionConfig
    {
        return (new OptionConfig())->setTitle($title);
    }
    public function NewItem($title = ''): self
    {
        return (new self)->setTitle($title);
    }
}
