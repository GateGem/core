<?php

use GateGem\Core\Models\DataList;
use GateGem\Core\Models\Option;
use Illuminate\Support\Facades\Cache;

if (!function_exists('set_option')) {
    function set_option($key, $value = null, $locked = null)
    {
        try {
            Cache::forget($key);
            $setting = Option::where('key', $key)->first();
            if ($value !== null) {
                $setting = $setting ?? new Option(['key' => $key]);
                $setting->value = $value;
                $setting->locked = $locked === true;
                $setting->save();
                Cache::forever($key, $setting->value);
            } else if ($setting != null) {
                $setting->delete();
            }
        } catch (\Exception $e) {
        }
    }
}
if (!function_exists('get_option')) {
    /**
     * Get Value: get_option("seo_key")
     * Get Value Or Default: get_option("seo_key","value_default")
     */
    function get_option($key, $default = null)
    {
        try {
            if (Cache::has($key) && Cache::get($key) != '') return Cache::get($key);
            $setting = Option::where('key', trim($key))->first();
            if ($setting == null) {
                return $default;
            }
            //Set Cache Forever
            Cache::forever($key, $setting->value);
            return $setting->value ?? $default;
        } catch (\Exception $e) {
            return $default;
        }
    }
}

if (!function_exists('remove_cache_list')) {
    function remove_cache_list($key)
    {
        $cache_key = "data_list_key-" . $key;
        Cache::delete($cache_key);
    }
}

if (!function_exists('get_list')) {
    /**
     * Get Value: get_list("seo_key")
     * Get Value Or Default: get_list("seo_key","value_default")
     */
    function get_list($key, $default = null)
    {
        try {
            $cache_key = "data_list_key-" . $key;
            if (Cache::has($cache_key) && Cache::get($cache_key) != '') return Cache::get($cache_key);
            $dataList = DataList::with('Items')->where('key', trim($key))->first();
            if ($dataList == null) {
                return $default;
            }
            //Set Cache Forever
            Cache::put($cache_key, $dataList,);
            return $dataList ?? $default;
        } catch (\Exception $e) {
            return $default;
        }
    }
}
