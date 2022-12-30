<?php

namespace GateGem\Core\Support\Config;

use GateGem\Core\Builder\Form\FieldBuilder;

/**
 * 
 * @method  \GateGem\Core\Support\Config\FieldConfig Disable()
 * @method  \GateGem\Core\Support\Config\FieldConfig Enable()
 * @method  \GateGem\Core\Support\Config\FieldConfig Hide()
 * @method  \GateGem\Core\Support\Config\FieldConfig setClass(string $value)
 * @method  \GateGem\Core\Support\Config\FieldConfig setTitle(string $value)
 * @method  \GateGem\Core\Support\Config\FieldConfig setType($value)
 * @method  \GateGem\Core\Support\Config\FieldConfig setIcon($value)
 * @method  \GateGem\Core\Support\Config\FieldConfig setPermission($value)
 * @method  \GateGem\Core\Support\Config\FieldConfig setSort($value)
 * @method  \GateGem\Core\Support\Config\FieldConfig setAttr($value)
 * 
 * @see  \GateGem\Core\Support\Config\FieldConfig
 */
class FieldConfig  extends BaseConfig
{

    public const FIELD = "FIELD";
    public const FIELD_COLUMN = "FIELD_COLUMN";
    public const ACTION = "ACTION";
    public const CLASS_HEADER = "CLASS_HEADER";
    public const CLASS_DATA = "CLASS_DATA";
    public const CLASS_FIELD = "CLASS_FIELD";
    public const KEY_LAYOUT = "KEY_LAYOUT";
    public const FUNC_DATA = "FUNC_DATA";
    public const FUNC_CELL = "FUNC_CELL";
    public const FUNC_DATA_BIND = "FUNC_DATA_BIND";
    public const DATA_CACHE = "DATA_CACHE";
    public const DATA_KEY = "DATA_KEY";
    public const DATA_TEXT = "DATA_TEXT";
    public const DATA_DEFAULT = "DATA_DEFAULT";
    public const DATA_LIST_KEY = "DATA_LIST_KEY";
    public const DATA_DEFAULT_TEXT = "DATA_DEFAULT_TEXT";
    public const DATA_FORMAT = "DATA_FORMAT";
    public const DATA_FORMAT_JS = "DATA_FORMAT_JS";
    public const INCLUDE = "INCLUDE";
    public const FOLDER = "FOLDER";
    public const ON_VIEW = "ON_VIEW";
    public const ON_EDIT = "ON_EDIT";
    public const ON_ADD = "ON_ADD";
    public const FILTER = "FILTER";
    public const CHECK_SHOW = "CHECK_SHOW";
    public const DEFER = "DEFER";
    public const PREX = "PREX";
    public function setListKey($value): self
    {
        return $this->setType(FieldBuilder::Dropdown)
            ->setDataKey('value')
            ->setDataText('title')
            ->setKeyData(self::DATA_LIST_KEY, $value);
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
    public function setDataTextDefault($value): self
    {
        return $this->setKeyData(self::DATA_DEFAULT_TEXT, $value);
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
    public function setFuncDataBind($funcDataBing)
    {
        return $this->hideAll()->setKeyData(self::FUNC_DATA_BIND, $funcDataBing);
    }
    public function setKeyLayout($value): self
    {
        return $this->setKeyData(self::KEY_LAYOUT, $value);
    }
    public function setField($value): self
    {
        return $this->setKeyData(self::FIELD, $value);
    }
    public function getListKey($value = '')
    {
        return $this->getKeyData(self::DATA_LIST_KEY, $value);
    }
    public function getPrex($value = '')
    {
        return $this->getKeyData(self::PREX, $value);
    }

    public function getCheckShow($value = '')
    {
        return $this->getKeyData(self::CHECK_SHOW, $value);
    }

    public function getFieldColumn($value = '')
    {
        return $this->getKeyData(self::FIELD_COLUMN, $value);
    }
    public function getFolder($value = '')
    {
        return $this->getKeyData(self::FOLDER, $value);
    }
    public function getInclude($value = '')
    {
        return $this->getKeyData(self::INCLUDE, $value);
    }
    public function getAction($value = '')
    {
        return $this->getKeyData(self::ACTION, $value);
    }
    public function getDataCache($value = [])
    {
        return $this->getKeyData(self::DATA_CACHE, $value);
    }
    public function getDataKey($value = 'id')
    {
        return $this->getKeyData(self::DATA_KEY, $value);
    }
    public function getDataText($value = 'name')
    {
        return $this->getKeyData(self::DATA_TEXT, $value);
    }
    public function getDataTextDefault($value = '')
    {
        return $this->getKeyData(self::DATA_DEFAULT_TEXT, $value);
    }
    public function getDataDefault($value = '')
    {
        return $this->getKeyData(self::DATA_DEFAULT, $value);
    }
    public function getDataFormat($value = '')
    {
        return $this->getKeyData(self::DATA_FORMAT, $value);
    }
    public function getDataFormatJs($value = '')
    {
        return $this->getKeyData(self::DATA_FORMAT_JS, $value);
    }
    public function getFuncDataBing($value = null)
    {
        return $this->getKeyData(self::FUNC_DATA_BIND, $value);
    }
    public function getClassHeader($value = '')
    {
        return $this->getKeyData(self::CLASS_HEADER, $value);
    }
    public function getClassData($value = '')
    {
        return $this->getKeyData(self::CLASS_DATA, $value);
    }
    public function getClassField($value = '')
    {
        return $this->getKeyData(self::CLASS_FIELD, $value);
    }
    public function getFuncData($value = null)
    {
        return $this->getKeyData(self::FUNC_DATA, $value);
    }
    public function getFuncCell($value = null)
    {
        return $this->getKeyData(self::FUNC_CELL, $value);
    }
    public function getKeyLayout($value = '')
    {
        return $this->getKeyData(self::KEY_LAYOUT, $value);
    }
    public function getField($value = '')
    {
        return $this->getKeyData(self::FIELD, $value);
    }
    public function getDefer($value = null)
    {
        return $this->getKeyData(self::DEFER, $value);
    }

    public function checkHideView()
    {
        return $this->getKeyData(self::ON_VIEW, self::Type_SHOW) === self::Type_HIDE;
    }
    public function checkHideEdit()
    {
        return $this->getKeyData(self::ON_EDIT, self::Type_SHOW) === self::Type_HIDE;
    }
    public function checkHideAdd()
    {
        return $this->getKeyData(self::ON_ADD, self::Type_SHOW) === self::Type_HIDE;
    }
    public function checkDisableAdd()
    {
        return $this->getKeyData(self::ON_ADD, self::Type_SHOW) === self::Type_DISABLE;
    }
    public function checkDisableEdit()
    {
        return $this->getKeyData(self::ON_EDIT, self::Type_SHOW) === self::Type_DISABLE;
    }
    public function checkSort()
    {
        return $this->getSort(true) === true;
    }
    public function checkFilter()
    {
        return $this->getKeyData(self::FILTER, true);
    }
    public function checkDefer()
    {
        return $this->getKeyData(self::DEFER, true);
    }
    public function hideAll()
    {
        return $this->hideAdd()->hideEdit()->hideView();
    }
    public function hideView(): self
    {
        return $this->setKeyData(self::ON_VIEW, self::Type_HIDE);
    }
    public function hideEdit(): self
    {
        return $this->setKeyData(self::ON_EDIT, self::Type_HIDE);
    }
    public function hideAdd(): self
    {
        return $this->setKeyData(self::ON_ADD, self::Type_HIDE);
    }
    public function disableAdd(): self
    {
        return $this->setKeyData(self::ON_ADD, self::Type_DISABLE);
    }
    public function disableEdit(): self
    {
        return $this->setKeyData(self::ON_EDIT, self::Type_DISABLE);
    }
    public function disableFilter(): self
    {
        return $this->setKeyData(self::FILTER, false);
    }
    public function disableDefer(): self
    {
        return $this->setKeyData(self::DEFER, false);
    }

    public function DoFuncData($request, $component)
    {
        $funcData = $this->getFuncData(null);
        if ($funcData && is_callable($funcData)) {
            $funcData = $funcData($request, $component);
        }
        if (!$funcData) $funcData = [];

        if (count($funcData) == 0 && $list_key = $this->getListKey()) {
            $funcData = get_list($list_key)->items;
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
