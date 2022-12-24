<?php

namespace GateGem\Core\Builder\Table;

use GateGem\Core\Builder\HtmlBuilder;
use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Support\Config\ConfigManager;
use GateGem\Core\Support\Config\FieldConfig;

class TableBuilder extends HtmlBuilder
{
    public $data;
    public $option;
    public $formData = [];
    public function __construct($option, $data, $formData)
    {
        $this->data = $data;
        $this->formData = $formData;
        $this->option = $option;
    }

    private $cacheData = [];
    public function RenderCell($row, $column, $key)
    {
        echo '<td>';
        echo '<div class="cell-data ' . $column->getKeyData(FieldConfig::CLASS_DATA, '') . '">';
        if (isset($column[FieldConfig::FUNC_CELL])) {
            echo $column[FieldConfig::FUNC_CELL]($row[$column[FieldConfig::FIELD]], $row, $column);
        } else if (isset($this->option['tableInline']) && $this->option['tableInline'] == true) {
            echo FieldRender([...$column, 'prex' => 'tables.' . $key . '.']);
        } else if (isset($column[FieldConfig::FIELD])) {
            $cell_value = isset($row[$column[FieldConfig::FIELD]]) ? $row[$column[FieldConfig::FIELD]] : null;
            $funcData =  $column->getDataCache();
            if (!is_null($funcData) && (is_array($funcData) ||  is_a($funcData, \ArrayAccess::class))) {
                $fieldKey = $column->getDataKey();
                $fieldText = $column->getDataText();
                foreach ($funcData as $item) {
                    if ($item[$fieldKey] == $cell_value) {
                        $cell_value = $item[$fieldText];
                        break;
                    }
                }
            }
            $format_value = $column->getDataFormat('d/M/Y');
            if (is_callable($format_value)) {
                echo  $format_value($cell_value);
            } else {
                if (is_object($cell_value) || is_array($cell_value)) {

                    if ($cell_value instanceof \Illuminate\Support\Carbon) {
                        echo $cell_value->format($format_value);
                    } else {
                        htmlentities(print_r($cell_value));
                    }
                } else if ($cell_value != "" && $column->getType('') === FieldBuilder::Image) {
                    echo '<img src="' . url($cell_value) . '" style="max-height:35px"/>';
                } else if ($cell_value != "")
                    echo htmlentities($cell_value);
                else
                    echo "&nbsp;";
            }
        } else {
            echo "&nbsp;";
        }
        echo '</div>';
        echo '</td>';
    }
    public function CheckColumnShow(FieldConfig $column)
    {
        if ($column->checkHideView()) return false;
        if ($column->getType(FieldBuilder::Text) == FieldBuilder::Button) return false;
        if ($column->checkCallable(FieldConfig::CHECK_SHOW) && !$column[FieldConfig::CHECK_SHOW]()) return false;
        return true;
    }
    public function RenderRow($row, $key)
    {
        if ($this->option && isset($this->option[ConfigManager::FIELDS])) {
            echo '<tr>';
            foreach ($this->option[ConfigManager::FIELDS] as $column) {
                if ($this->CheckColumnShow($column)) {
                    $this->RenderCell($row, $column, $key);
                }
            }
            echo '</tr>';
        }
    }
    public function RenderHeader()
    {
        echo '<thead  class="table-light"><tr>';
        if ($this->option && isset($this->option[ConfigManager::FIELDS])) {
            foreach ($this->option[ConfigManager::FIELDS] as $column) {
                if ($this->CheckColumnShow($column)) {
                    $field_name = $column->getField();
                    $title_name = __($column->getTitle());
                    echo '<td x-data="{ filter: false }" class="position-relative">';
                    echo '<div class="cell-header d-flex flex-row' . getValueByKey($column, FieldConfig::CLASS_HEADER, '') . '">';
                    echo '<div class="cell-header_title flex-grow-1">';
                    echo $title_name;
                    echo '</div>';
                    echo '<div class="cell-header_extend">';
                    if ($field_name) {
                        if ($this->option->checkFilter() && $column->checkFilter()) {
                            echo '<i class="bi bi-funnel" @click="filter = true"></i>';
                        }
                        if ($this->option->checkSort() && $column->checkSort()) {
                            if (getValueByKey($this->formData, 'sort.' .  $field_name, 1) == 1) {
                                echo '<i class="bi bi-sort-alpha-down" wire:click="doSort(\'' . $field_name . '\',0)"></i>';
                            } else {
                                echo '<i class="bi bi-sort-alpha-down-alt" wire:click="doSort(\'' . $field_name . '\', 1)"></i>';
                            }
                        }
                    }
                    echo '</div>';
                    echo '</div>';
                    if ($field_name) {
                        echo '<div  x-show="filter"  @click.outside="filter = false" style="display:none;" class="form-filter-column">';
                        echo "<p class='p-0'>" . $title_name . "</p>";
                        echo  FieldBuilder::Render($column, [], ['prex' => 'filter.', 'filter' => true]);
                        echo '<p class="text-end text-white p-0"> <i class="bi bi-eraser"  wire:click="clearFilter(\'' . $field_name . '\')"></i></p>';
                        '</div>';
                    }
                    echo '</td>';
                }
            }
        }
        echo '</tr></thead>';
    }
    public function RenderHtml()
    {
        echo '<div class="table-wapper">';
        echo '<table class="table ' . getValueByKey($this->option, ConfigManager::CLASS_TABLE, 'table-hover table-bordered') . '">';
        $this->RenderHeader();
        echo '<tbody>';
        if ($this->data != null && count($this->data) > 0) {
            foreach ($this->data as $key => $row) {
                if ($this->option && isset($this->option[ConfigManager::FUNC_ROW])) {
                    echo $this->option[ConfigManager::FUNC_ROW]($row, $this->option, $key);
                } else {
                    $this->RenderRow($row, $key);
                }
            }
        } else {
            echo '<tr><td colspan="100000"><span "table-empty-data">' . __(getValueByKey($this->option, 'emptyData', 'core::table.message.nodata')) . '</span></td</tr>';
        }
        echo '</tbody>';
        echo '</table>';

        echo '</div>';
    }
    public static function Render($data, $option, $formData = [])
    {
        return (new self($option, $data, $formData))->ToHtml();
    }
}
