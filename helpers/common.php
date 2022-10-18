<?php

if (! function_exists('getValueByKey')) {
    function getValueByKey($data, $key, $default = '')
    {
        if ($data && $key) {
            $arrkey = explode('.', $key);
            $dataTemp = $data;
            foreach ($arrkey as $keyItem) {
                if (isset($dataTemp[$keyItem])) {
                    $dataTemp = $dataTemp[$keyItem];
                } else {
                    return $default;
                }
            }

            return $dataTemp;
        }

        return $default;
    }
}
