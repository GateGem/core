<?php

namespace LaraPlatform\Core\Traits;

use LaraPlatform\Core\Utils\BaseScan;

trait WithDataLoader
{
    private static $datas = [];
    public static function setData($data)
    {
        self::$datas = $data;
    }
    public static function getData()
    {
        return  self::$datas;
    }
    public static function getDataByKey($key, $sub = null)
    {
        return getValueByKey(self::$datas, $key . ($sub ?? ''), null);
    }
    public static function Data($key, $config)
    {
        if (is_null(self::$datas) || !is_array(self::$datas))   self::$datas = [];
        self::$datas[$key] = $config;
    }
    public static function load($path)
    {
        $files = BaseScan::AllFile($path);
        foreach ($files as $file) {
            self::Data($file->getBasename('.' . $file->getExtension()), BaseScan::FileReturn($file->getRealPath()));
        }
    }
}
