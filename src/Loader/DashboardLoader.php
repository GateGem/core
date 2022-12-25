<?php

namespace GateGem\Core\Loader;

use GateGem\Core\Support\Config\WidgetConfig;
use GateGem\Core\Traits\WithDataLoader;

class DashboardLoader
{
    use WithDataLoader;
    public static function getConfigByPostion($postion)
    {
        return collect(self::getData())->where(function (WidgetConfig $item, $key) use ($postion) {
            return $item->getPosition() == $postion && $item->getEnable();
        })->sortBy(function($item){
            return $item->getSort(1000);
        });
    }
}
