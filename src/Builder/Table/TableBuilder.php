<?php

namespace GateGem\Core\Builder\Table;

use GateGem\Core\Builder\HtmlBuilder;
use GateGem\Core\Builder\Form\FieldBuilder;

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
    public function RenderCell($row, $column)
    {
        echo '<td>';
        echo '<div class="cell-data ' . getValueByKey($column, 'classData', '') . '">';
        if (isset($column['funcCell'])) {
            echo $column['funcCell']($row, $column);
        } else if (isset($column['field'])) {
            $cell_value = isset($row[$column['field']]) ? $row[$column['field']] : null;
            $funcData = getValueByKey($column, 'funcData', null);

            if ($funcData && is_array($funcData)) {
            } else if ($funcData) {
                if (!isset($this->cacheData[$column['field']])) {
                    $funcData = $funcData();
                    $this->cacheData[$column['field']] = $funcData;
                } else {
                    $funcData = $this->cacheData[$column['field']];
                }
            }
            if (!is_null($funcData) && is_array($funcData)) {
                foreach ($funcData as $item) {
                    if ($item['id'] == $cell_value) {
                        $cell_value = $item['text'];
                        break;
                    }
                }
            }
            if (is_object($cell_value) || is_array($cell_value))
                htmlentities(print_r($cell_value));
            else if ($cell_value != ""&&getValueByKey($column, 'fieldType', '') === FieldBuilder::Image) {
                echo '<img src="' . url($cell_value) . '" style="max-height:35px"/>';
            } else if ($cell_value != "")
                echo htmlentities($cell_value);
            else
                echo "&nbsp;";
        } else {
            echo "&nbsp;";
        }
        echo '</div>';
        echo '</td>';
    }
    public function RenderRow($row)
    {
        if ($this->option && isset($this->option['fields'])) {
            echo '<tr>';
            foreach ($this->option['fields'] as $column) {
                if (getValueByKey($column, 'view', true)) {
                    $this->RenderCell($row, $column);
                }
            }
            echo '</tr>';
        }
    }
    public function RenderHeader()
    {
        echo '<thead  class="table-light"><tr>';
        if ($this->option && isset($this->option['fields'])) {
            foreach ($this->option['fields'] as $column) {
                if (getValueByKey($column, 'view', true)) {
                    echo '<td x-data="{ filter: false }" class="position-relative">';
                    echo '<div class="cell-header d-flex flex-row' . getValueByKey($column, 'classHeader', '') . '">';
                    echo '<div class="cell-header_title flex-grow-1">';
                    echo __($column['title']);
                    echo '</div>';
                    echo '<div class="cell-header_extend">';
                    if (isset($column['field'])) {
                        echo '<i class="bi bi-funnel" @click="filter = true"></i>';
                        if (getValueByKey($this->formData, 'sort.' . $column['field'], 1) == 1) {
                            echo '<i class="bi bi-sort-alpha-down" wire:click="doSort(\'' . $column['field'] . '\',0)"></i>';
                        } else {
                            echo '<i class="bi bi-sort-alpha-down-alt" wire:click="doSort(\'' . $column['field'] . '\', 1)"></i>';
                        }
                    }
                    echo '</div>';
                    echo '</div>';
                    if (isset($column['field'])) {
                        echo '<div  x-show="filter"  @click.outside="filter = false" style="display:none;" class="form-filter-column">';
                        echo "<p class='p-0'>" . __($column["title"]) . "</p>";
                        echo  FieldBuilder::Render($column, [], ['prex' => 'filter.', 'filter' => true]);
                        echo '<p class="text-end text-white p-0"> <i class="bi bi-eraser"  wire:click="clearFilter(\'' . $column['field'] . '\')"></i></p>';
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
        echo '<table class="table ' . getValueByKey($this->option, 'classTable', 'table-hover table-bordered') . '">';
        $this->RenderHeader();
        echo '<tbody>';
        if ($this->data != null && count($this->data) > 0) {
            foreach ($this->data as $row) {
                if ($this->option && isset($this->option['funcRow'])) {
                    echo $this->option['funcRow']($row, $this->option);
                } else {
                    $this->RenderRow($row);
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
