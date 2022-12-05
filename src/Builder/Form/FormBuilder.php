<?php

namespace GateGem\Core\Builder\Form;

use GateGem\Core\Builder\HtmlBuilder;

class FormBuilder extends HtmlBuilder
{
    public $option;
    public $data;
    public $formData;
    public function __construct($data, $option, $formData)
    {
        $this->option = $option;
        $this->data = $data;
        $this->formData = $formData;
    }
    public function RenderItemField($item)
    {
        echo '<div class="form-group field-' . $item['field'] . '">';
        echo ' <label for="input-' . $item['field'] . '" class="form-label">' . __($item['title']) . '</label>';
        echo FieldBuilder::Render($item, $this->data, $this->formData);
        echo '</div>';
    }
    public function RenderHtml()
    {
        echo '<div class="form-builder ' . getValueByKey($this->option, 'formClass', '') . '">';
        $layoutForm = getValueByKey($this->option, 'layoutForm.common', null);
        if ($layoutForm) {
            foreach ($layoutForm as $row) {
                echo '<div class="row">';
                foreach ($row as $cell) {
                    if (isset($cell['key']) && $cell['key'] != "") {
                        echo '<div class="' . getValueByKey($cell, 'column', FieldBuilder::Col12) . ' ' . getValueByKey($cell, 'class', '') . ' " ' . getValueByKey($cell, 'attr', '') . '>';
                        foreach ($this->option['fields'] as $item) {
                            if ($this->checkRender($item) && isset($item['field']) && $item['field'] && isset($item['keyColumn']) && $item['keyColumn'] == $cell['key']) {
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
            foreach ($this->option['fields'] as $item) {
                if ($this->checkRender($item) && isset($item['field']) && $item['field']) {
                    echo '<div class="' . getValueByKey($item, 'column', FieldBuilder::Col12) . '">';
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
            return getValueByKey($item, 'add', true);
        }
        return getValueByKey($item, 'edit', true);
    }
    public static function Render($data, $option,  $formData)
    {
        return (new self($data, $option, $formData))->ToHtml();
    }
}
