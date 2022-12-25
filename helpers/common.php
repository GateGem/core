<?php

use GateGem\Core\Loader\DashboardLoader;
use GateGem\Core\Support\Core\GateData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

if (!function_exists('getValueByKey')) {
    function getValueByKey($data, $key, $default = '')
    {
        if ($data && $key) {
            $arrkey = explode('.', $key);
            $dataTemp = $data;
            if (is_array($dataTemp) || is_a($dataTemp, GateData::class)) {
                foreach ($arrkey as $keyItem) {
                    if (isset($dataTemp[$keyItem])) {
                        $dataTemp = $dataTemp[$keyItem];
                    } else {
                        return $default;
                    }
                }
            } else {
                foreach ($arrkey as $keyItem) {
                    if (isset($dataTemp->{$keyItem})) {
                        $dataTemp = $dataTemp->{$keyItem};
                    } else {
                        return $default;
                    }
                }
            }


            return $dataTemp;
        }

        return $default;
    }
}
if (!function_exists('groupBy')) {
    /**
     * Group items from an array together by some criteria or value.
     *
     * @param  $arr array The array to group items from
     * @param  $criteria string|callable The key to group by or a function the returns a key to group by.
     * @return array
     *
     */
    function groupBy($arr, $criteria): array
    {
        return array_reduce($arr, function ($accumulator, $item) use ($criteria) {
            $key = (is_callable($criteria)) ? $criteria($item) : $item[$criteria];
            if (!array_key_exists($key, $accumulator)) {
                $accumulator[$key] = [];
            }
            array_push($accumulator[$key], $item);
            return $accumulator;
        }, []);
    }
}

if (!function_exists('ReplaceTextInFile')) {
    function ReplaceTextInFile($file, $search, $replace, $checkOnly = false, $textCheck = '')
    {
        $content = file_get_contents($file);
        if ($checkOnly && (Str::contains($replace, $content, true) || ($textCheck != '' && Str::contains($textCheck, $content, true)))) {
            return;
        }
        file_put_contents($file, str_replace(
            $search,
            $replace,
            $content
        ));
    }
}

if (!function_exists('FieldRender')) {
    function FieldRender($option, $data = null, $formData = null)
    {
        return \GateGem\Core\Builder\Form\FieldBuilder::Render($option, $data, $formData);
    }
}
if (!function_exists('FormRender')) {
    function FormRender($option, $data = null, $formData = null)
    {
        return \GateGem\Core\Builder\Form\FormBuilder::Render($option, $data, $formData);
    }
}

if (!function_exists('TableRender')) {
    function TableRender($option, $data = null, $formData = null)
    {
        return \GateGem\Core\Builder\Table\TableBuilder::Render($option, $data, $formData);
    }
}

if (!function_exists('getClassByComponent')) {
    function getClassByComponent($component)
    {
        return app('livewire')->getClass($component);
    }
}
if (!function_exists('getClassByWidget')) {
    function getClassByWidget($widget)
    {
        return getClassByComponent("widget-{$widget}");
    }
}

if (!function_exists('getDashboard')) {
    function getDashboard($postion='')
    {
        return DashboardLoader::getConfigByPostion($postion);
    }
}
