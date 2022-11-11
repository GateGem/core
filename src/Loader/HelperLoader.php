<?php

namespace LaraPlatform\Core\Loader;

use LaraPlatform\Core\Utils\BaseScan;
use Symfony\Component\Finder\SplFileInfo;

class HelperLoader
{
    public static function Load($path)
    {
        if ($path && BaseScan::FileExists($path)) {
            require_once $path;
        }
    }

    public static function Register($path)
    {
        BaseScan::AllFile($path, function (SplFileInfo $file) {
            self::Load($file->getPathname());
        });
    }
}
