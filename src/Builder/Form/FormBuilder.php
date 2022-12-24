<?php

namespace GateGem\Core\Builder\Form;

use GateGem\Core\Builder\HtmlBuilder;
use GateGem\Core\Support\Config\FieldConfig;
use GateGem\Core\Support\Config\FormConfig;

class FormBuilder extends HtmlBuilder
{
    public  $option;
    public $data;
    public $formData;
    public function __construct($option, $data, $formData)
    {
        $this->option = $option;
        $this->data = $data;
        $this->formData = $formData;
    }
    public function RenderItemField(FieldConfig $item)
    {
        $field_name = $item->getField();
        echo '<div class="form-group field-' . $field_name . '">';
        if ($item->getType(FieldBuilder::Text) != FieldBuilder::Button)
            echo ' <label for="input-' . $field_name . '" class="form-label">' . __($item->getTitle()) . '</label>';
        echo FieldBuilder::Render($item, $this->data, $this->formData);
        echo '</div>';
    }
    public function RenderHtml()
    {
        echo '<div class="form-builder ' . $this->option->getValueInForm(FormConfig::FORM_CLASS, 'p-1') . '">';
        $layoutForm = $this->option->getValueInForm(FormConfig::FORM_LAYOUT, null);
        if ($layoutForm) {
            if (is_callable($layoutForm)) $layoutForm = $layoutForm($this->option, $this->data, $this->formData);
            foreach ($layoutForm as $row) {
                echo '<div class="row">';
                foreach ($row as $cell) {
                    if (isset($cell['key']) && $cell['key'] != "") {
                        echo '<div class="key_' . $cell['key'] . ' ' . getValueByKey($cell, 'column', FieldBuilder::Col12) . ' ' . getValueByKey($cell, 'class', '') . ' " ' . getValueByKey($cell, 'attr', '') . '>';
                        foreach ($this->option->getFields() as $item) {
                            if ($this->checkRender($item) && $item->getKeyLayout() === $cell['key']) {
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
            foreach ($this->option->getFields() as $item) {
                if ($this->checkRender($item)) {
                    echo '<div class="' . $item->getFieldColumn(FieldBuilder::Col12)  . '">';
                    $this->RenderItemField($item);
                    echo '</div>';
                }
            }
            echo '</div>';
        }
        echo '</div>';
    }
    private function checkRender(FieldConfig $item)
    {
        if (getValueByKey($this->formData, 'isNew', false)) {
            if ($item->checkHideAdd()) return false;
        } else {
            if ($item->checkHideEdit()) return false;
        }
        return $item->getField() !== '';
    }
    public static function Render($data, $option,  $formData)
    {
        return (new self($data, $option, $formData))->ToHtml();
    }
}
