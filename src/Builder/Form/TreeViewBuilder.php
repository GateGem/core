<?php

namespace GateGem\Core\Builder\Form;

use GateGem\Core\Builder\HtmlBuilder;
use GateGem\Core\Support\Config\FieldConfig;

class TreeViewBuilder extends HtmlBuilder
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
    public function getModelField($value)
    {
        if (getValueByKey($this->formData, 'filter', false)) {
            return 'wire:model.lazy="' . getValueByKey($this->formData, 'prex', '') . $this->option->getField() . '"';
        }
        return (getValueByKey($this->option, FieldConfig::DEFER, true) ? 'wire:model.defer' : 'wire:model') . '="' . getValueByKey($this->formData, 'prex', '')  . $this->option->getField() . '.' . $value . '"';
    }
    private function TreeRenderItem($key, $items, $treeLevel = 0)
    {
        $class_li = '';
        if ($treeLevel == 0 || (isset($items[0]['isChild']) && $items[0]['isChild'] && isset($items[0]['show']) && $items[0]['show'])) {
            $class_li .= ' show ';
        }
        if (isset($items[0]['isActive']) && $items[0]['isActive']) {
            $class_li .= ' active ';
        }
        echo '<li class="' . $class_li . '">';
        $key_id = $this->option->getField() . '_' . $items[0]['value'] . '_' . time();
        $selectEvent = getValueByKey($this->option, 'selectEvent', "");
        $itemAttr = getValueByKey($this->option, 'itemAttr', "");
        if (is_callable($itemAttr)) {
            $itemAttr = $itemAttr($items, $key, $treeLevel);
        }
        if ($selectEvent) {
            $itemAttr .= ' ' . 'wire:click=\'' . $selectEvent . '("' . $items[0]['value'] . '")\'';
        }
        echo "<div " . $itemAttr . ">";
        if ((isset($items[0]['isChild']) && $items[0]['isChild']) || count($items) > 1) {

            if (getValueByKey($this->option, 'checkBox', true)) {
                if (((isset($items[0]['show']) && $items[0]['show']) && count($items) > 1) || ((!isset($items[0]['show']) || !$items[0]['show']))) {
                    if ($icon = getValueByKey($items[0], 'icon', '')) {
                        echo $icon;
                    } else {
                        echo '<span class="icon-open">' . getValueByKey($this->option, 'icon-open', '<i class="bi bi-chevron-down"></i>') . '</span>
                    <span class="icon-close">' . getValueByKey($this->option, 'icon-close', '<i class="bi bi-chevron-right"></i>') . '</span>';
                    }
                    echo '<div class="d-inline-block form-check ms-2">';
                } else {
                    echo '<div class="form-check  ms-4">';
                }
                echo '<input type="checkbox" value="' . $items[0]['value'] . '" ' . (getValueByKey($this->option, FieldConfig::ATTR, '')) . ' class="form-check-input" id="cbk_id_' . $key_id . '" ' .  $this->getModelField($items[0]['value']) . '/>
                    <label class="form-check-label" for="cbk_id_' . $key_id . '">' . $items[0]['text'] . '</label>
                    </div>';
            } else {
                if (((isset($items[0]['show']) && $items[0]['show']) && count($items) > 1) || ((!isset($items[0]['show']) || !$items[0]['show']))) {
                    if ($icon = getValueByKey($items[0], 'icon', '')) {
                        echo $icon;
                    } else {
                        echo '<span class="icon-open">' . getValueByKey($this->option, 'icon-open', '<i class="bi bi-chevron-down"></i>') . '</span>
                    <span class="icon-close">' . getValueByKey($this->option, 'icon-close', '<i class="bi bi-chevron-right"></i>') . '</span>';
                    }
                }
                echo '<label class="ps-1 label-item" for="cbk_id_' . $key_id . '" value="' . $items[0]['value'] . '" >' . $items[0]['text'] . '</label>';
            }
            echo "</div>";
            if (count($items) > 1)
                $this->TreeRender($items, strlen($key) + 2, $key);
        } else {

            if (getValueByKey($this->option, 'checkBox', true)) {
                if ($icon = getValueByKey($items[0], 'icon', '')) {
                    echo $icon;
                }
                echo '<div class="form-check  ms-4"> <input type="checkbox" value="' . $items[0]['value'] . '" ' . (getValueByKey($this->option, FieldConfig::ATTR, '')) . ' class="form-check-input" id="cbk_id_' . $key_id . '" ' .  $this->getModelField($items[0]['value']) . '/>
            <label class="form-check-label" for="cbk_id_' . $key_id . '">' . $items[0]['text'] . '</label>
            </div>';
            } else {
                if ($icon = getValueByKey($items[0], 'icon', '')) {
                    echo $icon;
                }
                echo '<label class="ps-3 label-item" for="cbk_id_' . $key_id . '" value="' . $items[0]['value'] . '">' . $items[0]['text'] . '</label>';
            }
            echo "</div>";
        }
        echo "</li>";
    }
    private function TreeRender($data, $treeLevel = 0, $keyPrent = '')
    {
        $gropData =  groupBy($data, function ($item) use ($treeLevel) {
            if (strlen($item['key']) < $treeLevel) return $item['key'];
            $pos =  strpos($item['key'], ".", $treeLevel);
            if (!$pos) return $item['key'];
            return substr($item['key'], 0, $pos);
        });
        if (count($gropData) == 0) return;
        ksort($gropData, SORT_STRING);
        echo "<ul>";
        if (!getValueByKey($this->option, 'skipTop', false)  && (isset($gropData[$keyPrent]) || $treeLevel == 0 || $keyPrent == '' || $keyPrent == 'root')) {
            if (isset($gropData[$keyPrent]) && !getValueByKey($gropData[$keyPrent][0], 'skipTop', false)) {
                $this->TreeRenderItem($keyPrent, $gropData[$keyPrent], $treeLevel);
            }
        }
        foreach ($gropData as $key => $items) {
            if ($keyPrent == $key) {
                continue;
            }
            $this->TreeRenderItem($key, $items, $treeLevel);
        }
        echo "</ul>";
    }
    public function RenderHtml()
    {
        $funcData = $this->option->getDataCache();
        if ($funcData) {
            echo '<div class="tree-view form-tree" tree-event-expand="' . getValueByKey($this->option, 'event-expand') . '" id="input-' . $this->option[FieldConfig::FIELD] . '">';
            $this->TreeRender($funcData, 0);
            echo '</div>';
        }
    }
    public static function Render($data, $option,  $formData)
    {
        return (new self($data, $option, $formData))->ToHtml();
    }
}
