<?php

namespace GateGem\Core\Builder\Form;

use GateGem\Core\Builder\HtmlBuilder;
use GateGem\Core\Support\Config\ConfigManager;
use GateGem\Core\Support\Config\FieldConfig;
use GateGem\Core\Support\Config\FormConfig;

class FormBuilder extends HtmlBuilder
{
    public $option;
    public $data;
    public $formData;
    public function __construct($option, $data, $formData)
    {
        $this->option = $option;
        $this->data = $data;
        $this->formData = $formData;
    }
    public function RenderItemField($item)
    {
        echo '<div class="form-group field-' . $item[FieldConfig::FIELD] . '">';
        if ($item->getDataValue(FieldConfig::FIELD_TYPE, FieldBuilder::Text) != FieldBuilder::Button)
            echo ' <label for="input-' . $item[FieldConfig::FIELD] . '" class="form-label">' . __($item[FieldConfig::TITLE]) . '</label>';
        echo FieldBuilder::Render($item, $this->data, $this->formData);
        echo '</div>';
    }
    public function RenderHtml()
    {
        echo '<div class="form-builder ' . getValueByKey($this->option,  ConfigManager::FORM . '.' . FormConfig::FORM_CLASS, '') . '">';
        $layoutForm = getValueByKey($this->option, ConfigManager::FORM . '.' . FormConfig::FORM_LAYOUT, null);
        if ($layoutForm) {
            if (is_callable($layoutForm)) $layoutForm = $layoutForm($this->option, $this->data, $this->formData);
            foreach ($layoutForm as $row) {
                echo '<div class="row">';
                foreach ($row as $cell) {
                    if (isset($cell['key']) && $cell['key'] != "") {
                        echo '<div class="key_' . $cell['key'] . ' ' . getValueByKey($cell, 'column', FieldBuilder::Col12) . ' ' . getValueByKey($cell, 'class', '') . ' " ' . getValueByKey($cell, 'attr', '') . '>';
                        foreach ($this->option[ConfigManager::FIELDS] as $item) {
                            if ($this->checkRender($item) && isset($item[FieldConfig::KEY_LAYOUT]) && $item[FieldConfig::KEY_LAYOUT] == $cell['key']) {
                                $this->RenderItemField($item);
                            }
                        }
                        echo '</div>';
                    }
                }
                echo '</div>';
            }
        } else {
            echo '<div class="row">';
            foreach ($this->option[ConfigManager::FIELDS] as $item) {
                if ($this->checkRender($item)) {
                    echo '<div class="' . getValueByKey($item, FieldConfig::FIELD_COLUMN, FieldBuilder::Col12) . '">';
                    $this->RenderItemField($item);
                    echo '</div>';
                }
            }
            echo '</div>';
        }
        echo '</div>';
    }
    private function checkRender($item)
    {
        if (getValueByKey($this->formData, 'isNew', false)) {
            if (!$item->getDataValue(FieldConfig::ADD, true)) return false;
        } else {
            if (!$item->getDataValue(FieldConfig::EDIT, true)) return false;
        }
        return isset($item[FieldConfig::FIELD]) && $item[FieldConfig::FIELD] != "";
    }
    public static function Render($data, $option,  $formData)
    {
        return (new self($data, $option, $formData))->ToHtml();
    }
}
