<?php

if (!function_exists('getValueByKey')) {
    function getValueByKey($data, $key, $default = '')
    {
        if ($data && $key) {
            $arrkey = explode('.', $key);
            $dataTemp = $data;
            if (is_array($dataTemp)) {
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
