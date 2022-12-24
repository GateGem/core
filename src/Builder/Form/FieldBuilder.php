<?php

namespace GateGem\Core\Builder\Form;

use GateGem\Core\Builder\HtmlBuilder;
use GateGem\Core\Support\Config\FieldConfig;

class FieldBuilder extends HtmlBuilder
{

    public const Text = 0;
    public const Number = 1;
    public const Date = 2;
    public const DateTime = 3;
    public const Time = 4;
    public const Color = 5;
    public const Textarea = 6;
    public const Quill = 7;
    public const Password = 8;
    public const Check = 9;
    public const Dropdown = 10;
    public const Multiselect = 11;
    public const Tag = 12;
    public const File = 13;
    public const Image = 14;
    public const Cron = 15;
    public const MultiCron = 16;
    public const TreeView = 17;

    public const Button = 900;
    public const includeInput = 9999;

    public const AllColor = ["warning", "info", "danger", "primary", "success"];
    public const secondary = "text-white bg-secondary";
    public const primary = "text-white bg-primary";
    public const success = "text-white bg-success";
    public const danger = "text-white bg-danger";
    public const warning = "text-dark bg-warning";
    public const info = "text-dark bg-info";
    public const light = "text-dark bg-light";
    public const dark = "text-white bg-dark";
    public static function getColor($name)
    {
        switch ($name) {
            case "secondary":
                return self::secondary;
            case "primary":
                return self::primary;
            case "success":
                return self::success;
            case "danger":
                return self::danger;
            case "warning":
                return self::warning;
            case "info":
                return self::info;
            case "light":
                return self::light;
            case "dark":
                return self::dark;
            default:
                return self::warning;
        }
    }
    public const Col = "col";
    public const Col1 = "col-xs-12 col-sm-12 col-md-1 col-lg-1";
    public const Col2 = "col-xs-12 col-sm-12 col-md-1 col-lg-2";
    public const Col3 = "col-xs-12 col-sm-12 col-md-4 col-lg-3";
    public const Col4 = "col-xs-12 col-sm-12 col-md-4 col-lg-4";
    public const Col5 = "col-xs-12 col-sm-12 col-md-4 col-lg-5";
    public const Col6 = "col-xs-12 col-sm-12 col-md-4 col-lg-6";
    public const Col7 = "col-xs-12 col-sm-12 col-md-8 col-lg-7";
    public const Col8 = "col-xs-12 col-sm-12 col-md-8 col-lg-8";
    public const Col9 = "col-xs-12 col-sm-12 col-md-8 col-lg-9";
    public const Col10 = "col-xs-12 col-sm-12 col-md-12 col-lg-10";
    public const Col11 = "col-xs-12 col-sm-12 col-md-12 col-lg-11";
    public const Col12 = "col-xs-12 col-sm-12 col-md-12 col-lg-12";
    public static function getSize($name)
    {
        switch ($name) {
            case "Col":
                return self::Col;
            case "Col1":
                return self::Col1;
            case "Col2":
                return self::Col2;
            case "Col3":
                return self::Col3;
            case "Col4":
                return self::Col4;
            case "Col5":
                return self::Col5;
            case "Col6":
                return self::Col6;
            case "Col7":
                return self::Col7;
            case "Col8":
                return self::Col8;
            case "Col9":
                return self::Col9;
            case "Col10":
                return self::Col10;
            case "Col11":
                return self::Col11;
            case "Col12":
                return self::Col12;
            default:
                return self::Col;
        }
    }
    public $option;
    public $data;
    public $formData;
    public function __construct($option, $data, $formData)
    {
        $this->option = $option;
        $this->data = $data;
        $this->formData = $formData;
    }
    public function getModelField()
    {
        if (getValueByKey($this->formData, FieldConfig::FILTER, false)) {
            return 'wire:model.lazy="' . getValueByKey($this->formData, 'prex', '') . $this->option->getField() . '"';
        }
        return ($this->option->getDefer(true) == true ? 'wire:model.defer' : 'wire:model') . '="' . getValueByKey($this->formData, 'prex', $this->option->getPrex())  . $this->option->getField() . '"';
    }
    public function getFormatDateTime()
    {
        $formatDate = $this->option->getDataFormatJs('');
        if ($formatDate) {
            return 'data-date-format="' . $formatDate . '"';
        }
        return '';
    }
    public function RenderHtml()
    {
        $fieldType = $this->option->getType(FieldBuilder::Text);
        if (getValueByKey($this->formData, 'filter', false) && ($fieldType == FieldBuilder::Quill || $fieldType == FieldBuilder::Textarea)) {
            $fieldType = FieldBuilder::Text;
        }
        $attr = $this->option->getAttr();
        $field_name = $this->option->getField();
        $class_name = $this->option->getClassField();
        if (!getValueByKey($this->formData, 'filter', false)) {
            $disable = $this->option->getEnable(true);
            if ($disable && is_callable($disable)) {
                $disable = $disable(getValueByKey($this->formData, 'isNew', true), $this->data, $this->option);
            }
            if (!$disable)
                $attr .= ' disabled ';
        }

        switch ($fieldType) {
            case FieldBuilder::Check:
                echo '<div class="form-check ' . $class_name . '"><input type="checkbox" ' . $attr . ' class="form-check-input" id="input-' . $field_name . '" ' .  $this->getModelField() . ' /></div>';
                break;
            case FieldBuilder::Number:
                echo '<input type="number" ' . $attr . ' class="form-control ' . $class_name . '" id="input-' . $field_name . '" ' .  $this->getModelField() . ' />';
                break;

            case FieldBuilder::Date:
                echo '<input type="text" ' . $attr . ' ' . $this->getFormatDateTime() . ' class="form-control el-date ' . $class_name . '" id="input-' . $field_name . '" ' .  $this->getModelField() . ' />';
                break;

            case FieldBuilder::DateTime:
                echo '<input type="text" ' . $attr . ' ' . $this->getFormatDateTime() . ' data-enable-time="true" class="form-control el-date ' . $class_name . '" id="input-' . $field_name . '" ' .  $this->getModelField() . ' />';
                break;

            case FieldBuilder::Time:
                echo '<input type="text"  ' . $attr . ' ' . $this->getFormatDateTime() . ' data-mode="time" class="form-control el-date ' . $class_name . '" id="input-' . $field_name . '" ' .  $this->getModelField() . ' />';
                break;

            case FieldBuilder::Color:
                echo '<input type="color" ' . $attr . ' class="form-control ' . $class_name . '" id="input-' . $field_name . '" ' .  $this->getModelField() . ' />';
                break;

            case FieldBuilder::Textarea:
                echo '<textarea ' . $attr . ' class="form-control  ' . $class_name . '" id="input-' . $field_name . '" ' .  $this->getModelField() . ' ></textarea>';
                break;

            case FieldBuilder::Quill:
                echo '<textarea ' . $attr . ' class="form-control el-quill  ' . $class_name . '" id="input-' . $field_name . '" ' .  $this->getModelField() . ' ></textarea>';
                break;

            case FieldBuilder::Password:
                echo '<input type="password" ' . $attr . ' class="form-control  ' . $class_name . '" id="input-' . $field_name . '" ' .  $this->getModelField() . ' />';
                break;
            case FieldBuilder::Tag:
                echo '<input type="text" ' . $attr . ' class="form-control el-tag  ' . $class_name . '" id="input-' . $field_name . '" ' .  $this->getModelField() . ' />';
                break;
            case FieldBuilder::Dropdown:
                $funcData = $this->option->getDataCache([]);
                echo '<select ' . $attr . ' class="form-control ' . $class_name . '"  id="input-' . $field_name . '" ' .  $this->getModelField() . ' >';
                $optionDefault = '';
                if (getValueByKey($this->formData, 'filter', false) || ($optionDefault = getValueByKey($this->option, FieldConfig::DATA_DEFAULT, ''))) {
                    if ($optionDefault === true)
                        echo '<option value="">' . __($this->option->getTitle()) . '</option>';
                    if ($optionDefault !== '' && $optionDefault !== true)
                        echo '<option value="">' . __($optionDefault) . '</option>';
                }
                if ($funcData) {
                    foreach ($funcData as $item) {
                        $data_key = getValueByKey($item, $this->option->getDataKey(), $item);
                        $data_text = getValueByKey($item, $this->option->getDataText(), $item);
                        if (is_array($data_text)) $data_text = json_encode($data_text);
                        if (is_array($data_key)) $data_key = json_encode($data_key);
                        echo '<option value="' . $data_key . '">' . $data_text . '</option>';
                    }
                }
                echo '</select>';
                break;
            case FieldBuilder::Multiselect:
                $funcData = $this->option->getDataCache([]);
                echo '<select ' . $attr . ' class="form-control ' . $class_name . '" multiple id="input-' . $field_name . '" ' .  $this->getModelField() . '>';
                if ($funcData) {
                    foreach ($funcData as $item) {
                        $data_key = getValueByKey($item, $this->option->getDataKey(), $item);
                        $data_text = getValueByKey($item, $this->option->getDataText(), $item);
                        if (is_array($data_text)) $data_text = json_encode($data_text);
                        if (is_array($data_key)) $data_key = json_encode($data_key);
                        echo '<option value="' . $data_key . '">' . $data_text . '</option>';
                    }
                }
                echo '</select>';
                break;

            case FieldBuilder::File:
                echo '<div
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
            >';
                echo '<input type="file" ' . $attr . ' class="form-control el-file ' . $class_name . '" id="input-' . $field_name . '" ' .  $this->getModelField() . ' />';
                echo '<div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>';
                break;

            case FieldBuilder::Image:
                $value_image = isset($this->data->{$this->option[FieldConfig::FIELD]}) ? $this->data->{$this->option[FieldConfig::FIELD]} : null;
                echo '<div  x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
                class="form-control el-image" for="input-' . $field_name . '" >';
                if ($value_image && !is_string($value_image)) {
                    echo '<img src="' . $value_image->temporaryUrl() . '"/>';
                } else if ($value_image) {
                    echo '<img src="' . asset($value_image) . '"/>';
                }
                echo '<div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>';
                echo '<input type="file" ' . $attr . ' class=" " id="input-' . $field_name . '" ' .  $this->getModelField() . ' />
                </div>';
                break;
            case FieldBuilder::Cron:
                echo '<input type="text" ' . $attr . ' class="form-control text-warning fw-bold fs-6 ' . $class_name . '" id="input-' . $field_name . '" ' .  $this->getModelField() . ' style="background-color: rgb(56, 43, 95);"/>';
                break;
            case FieldBuilder::MultiCron:
                echo '<textarea type="text" ' . $attr . ' class="form-control text-warning fw-bold fs-6 ' . $class_name . '" id="input-' . $field_name . '" ' .  $this->getModelField() . ' style="background-color: rgb(56, 43, 95);"></textarea>';
                break;
            case FieldBuilder::TreeView:
                echo TreeViewBuilder::Render($this->data, $this->option, $this->formData);
                break;
            case FieldBuilder::Button:
                echo ' <button type="button" class="' . ($class_name ?? 'btn btn-sm btn-danger') . ' " ' .  ($this->option[FieldConfig::ACTION]($this->data, $this->option, $this->formData)) . '\'>' . $this->option->getIcon() . ' <span> ' . __($this->option->getTitle('')) . ' </span></button>';
                break;
            case FieldBuilder::includeInput:
                if (getValueByKey($this->option, FieldConfig::INCLUDE)) {
                    include_once(getValueByKey($this->option, FieldConfig::INCLUDE));
                }
                break;
            case FieldBuilder::Text:
            default:
                echo '<input type="text" ' . $attr . ' class="form-control ' . $class_name . '" id="input-' . $field_name . '" ' .  $this->getModelField() . '/>';
                break;
        }
        $errors = getValueByKey($this->formData, 'errors');
        if ($errors && $errors->has($field_name)) {
            echo '<span class="error">' . $errors->first($field_name) . '</span> ';
        }
    }
    public static function Render($option, $data, $formData)
    {
        return (new self($option, $data, $formData))->ToHtml();
    }
}
