<?php

namespace GateGem\Core\Traits;

use GateGem\Core\Facades\Core;
use Illuminate\Support\Facades\Log;

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
        self::$datas[$key] = [
            ...$config,
            'key' => $key
        ];
        if ($key == 'catalog') {
            Log::info(self::$datas[$key]);
        }
    }
    public static function load($path)
    {
        $files = Core::AllFile($path);
        if ($files && count($files)) {
            foreach ($files as $file) {
                self::Data($file->getBasename('.' . $file->getExtension()), Core::FileReturn($file->getRealPath()));
            }
        }
    }
}
