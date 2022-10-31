<?php

namespace LaraPlatform\Core\Builder\Form;

use Illuminate\Support\Arr;
use LaraPlatform\Core\Builder\HtmlBuilder;

class TreeBuilder extends HtmlBuilder
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
            return 'wire:model.lazy="' . getValueByKey($this->formData, 'prex', '') . $this->option['field'] . '"';
        }
        return (getValueByKey($this->option, 'defer', true) ? 'wire:model.defer' : 'wire:model') . '="' . getValueByKey($this->formData, 'prex', '')  . $this->option['field'] . '.'.$value.'"';
    }
    private function TreeRender($data, $treeLevel = 0)
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
        foreach ($gropData as $key => $items) {
            echo "<li>";
            if (count($items) == 1) {
                echo '<div class="form-check"><input type="checkbox" value="'.$items[0]['value'].'" ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-check-input" id="input-' . $this->option['field'] . '" ' .  $this->getModelField($items[0]['value']) . '/></div>';
                echo $items[0]['text'];
            } else {
                echo '<div class="form-check"><input type="checkbox" ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-check-input" id="input-' . $key . '"/></div>';
                echo $key;
                $this->TreeRender($items, strlen($key) + 1);
            }
            echo "</li>";
        }
        echo "</ul>";
    }
    public function RenderHtml()
    {
        $funcData = getValueByKey($this->option, 'funcData', null);
        if ($funcData && is_array($funcData)) {
        } else if ($funcData) {
            $funcData = $funcData();
        }
        if ($funcData) {
            $this->TreeRender($funcData, 0);
        }
    }
    public static function Render($data, $option,  $formData)
    {
        return (new self($data, $option, $formData))->ToHtml();
    }
}
