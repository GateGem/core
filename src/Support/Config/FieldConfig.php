<?php

namespace GateGem\Core\Support\Config;

use GateGem\Core\Support\Core\GateData;

class FieldConfig  extends GateData
{
    public const FIELD = "FIELD";
    public const FIELD_COLUMN = "FIELD_COLUMN";
    public const FIELD_TYPE = "FIELD_TYPE";
    public const ACTION = "ACTION";
    public const DISABLE = "DISABLE";
    public const TITLE = "TITLE";
    public const CLASS_HEADER = "CLASS_HEADER";
    public const CLASS_DATA = "CLASS_DATA";
    public const CLASS_FIELD = "CLASS_FIELD";
    public const KEY_LAYOUT = "KEY_LAYOUT";
    public const FUNC_DATA = "FUNC_DATA";
    public const FUNC_CELL = "FUNC_CELL";
    public const DATA_CACHE = "DATA_CACHE";
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
    public const CHECK_SHOW = "CHECK_SHOW";
    public const DEFER = "DEFER";
    public const PREX = "PREX";

    public function setDisable($value): self
    {
        return $this->setKeyData(self::DISABLE, $value);
    }
    public function setPrex($value): self
    {
        return $this->setKeyData(self::PREX, $value);
    }

    public function setCheckShow($value): self
    {
        return $this->setKeyData(self::CHECK_SHOW, $value);
    }

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
    public function setClassField($value): self
    {
        return $this->setKeyData(self::CLASS_FIELD, $value);
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

    public function getPrex($value = '')
    {
        return $this->getDataValue(self::PREX, $value);
    }

    public function getCheckShow($value = '')
    {
        return $this->getDataValue(self::CHECK_SHOW, $value);
    }

    public function getFieldColumn($value = '')
    {
        return $this->getDataValue(self::FIELD_COLUMN, $value);
    }
    public function getFolder($value = '')
    {
        return $this->getDataValue(self::FOLDER, $value);
    }
    public function getInclude($value = '')
    {
        return $this->getDataValue(self::INCLUDE, $value);
    }
    public function getAction($value = '')
    {
        return $this->getDataValue(self::ACTION, $value);
    }
    public function getDataCache($value = [])
    {
        return $this->getDataValue(self::DATA_CACHE, $value);
    }
    public function getDataKey($value = 'id')
    {
        return $this->getDataValue(self::DATA_KEY, $value);
    }
    public function getDataText($value = 'name')
    {
        return $this->getDataValue(self::DATA_TEXT, $value);
    }
    public function getDataDefault($value = '')
    {
        return $this->getDataValue(self::DATA_DEFAULT, $value);
    }
    public function getDataFormat($value = '')
    {
        return $this->getDataValue(self::DATA_FORMAT, $value);
    }
    public function getDataFormatJs($value = '')
    {
        return $this->getDataValue(self::DATA_FORMAT_JS, $value);
    }
    public function getClassHeader($value = '')
    {
        return $this->getDataValue(self::CLASS_HEADER, $value);
    }
    public function getClassData($value = '')
    {
        return $this->getDataValue(self::CLASS_DATA, $value);
    }
    public function getClassField($value = '')
    {
        return $this->getDataValue(self::CLASS_FIELD, $value);
    }
    public function getFuncData($value = null)
    {
        return $this->getDataValue(self::FUNC_DATA, $value);
    }
    public function getFuncCell($value = null)
    {
        return $this->getDataValue(self::FUNC_CELL, $value);
    }
    public function getAttr($value = '')
    {
        return $this->getDataValue(self::ATTR, $value);
    }
    public function getKeyLayout($value = '')
    {
        return $this->getDataValue(self::KEY_LAYOUT, $value);
    }
    public function getFieldType($value = '')
    {
        return $this->getDataValue(self::FIELD_TYPE, $value);
    }
    public function getTitle($value = '')
    {
        return $this->getDataValue(self::TITLE, $value);
    }
    public function getField($value = '')
    {
        return $this->getDataValue(self::FIELD, $value);
    }
    public function getDisable($value = null)
    {
        return $this->getDataValue(self::DISABLE, $value);
    }
    public function getDefer($value = null)
    {
        return $this->getDataValue(self::DEFER, $value);
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
    public function disableDefer(): self
    {
        return $this->setKeyData(self::DEFER, false);
    }
    public function disableSort(): self
    {
        return $this->setKeyData(self::SORT, false);
    }
    public function disableEdit(): self
    {
        return $this->setKeyData(self::DISABLE, function ($isNew) {
            if ($isNew)
                return false;
            return true;
        });
    }
    public function disableAdd(): self
    {
        return $this->setKeyData(self::DISABLE, function ($isNew) {
            if ($isNew)
                return true;
            return false;
        });
    }
    public function DoFuncData($request, $component)
    {
        $funcData = $this->getFuncData(null);
        if ($funcData && is_callable($funcData)) {
            $funcData = $funcData($request, $component);
        }
        if (!$funcData) $funcData = [];
        return $this->setKeyData(self::DATA_CACHE, $funcData);
    }
    public static function DoFuncDatas($fields, $request, $component)
    {
        if ($fields) {
            foreach ($fields as $item) {
                $item->DoFuncData($component, $request);
            }
        }
        return $fields;
    }
}
