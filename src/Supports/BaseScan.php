<?php

namespace LaraPlatform\Core\Supports;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

class BaseScan
{
    /*
    * @var \Illuminate\Filesystem\Filesystem;
    */
    public static $filesystem;

    private static function _check()
    {
        if (! self::$filesystem) {
            self::$filesystem = new Filesystem();
        }
    }

    public static function FileExists($path)
    {
        self::_check();

        return self::$filesystem->exists($path);
    }

    public static function FileJson($path)
    {
        return json_decode(file_get_contents($path), true);
    }

    public static function AllFile($directory, $callback = null, $filter = null)
    {
        self::_check();
        if (! self::$filesystem->isDirectory($directory)) {
            return false;
        }
        if ($callback) {
            if ($filter) {
                collect(self::$filesystem->allFiles($directory))->filter($filter)->each($callback);
            } else {
                collect(self::$filesystem->allFiles($directory))->each($callback);
            }
        } else {
            return self::$filesystem->allFiles($directory);
        }
    }

    public static function AllClassFile($directory, $namespace, $callback = null, $filter = null)
    {
        $classList = collect(self::AllFile($directory))->map(function (SplFileInfo $file) use ($namespace) {
            return (string) Str::of($namespace)
                ->append('\\', $file->getRelativePathname())
                ->replace(['/', '.php'], ['\\', '']);
        });
        if ($callback) {
            if ($filter) {
                $classList = $classList->filter($filter);
            }
            $classList->each($callback);
        } else {
            return $classList;
        }
    }

    public static function AllFolder($directory, $callback = null, $filter = null)
    {
        self::_check();
        if (! self::$filesystem->isDirectory($directory)) {
            return false;
        }
        if ($callback) {
            if ($filter) {
                collect(self::$filesystem->directories($directory))->filter($filter)->each($callback);
            } else {
                collect(self::$filesystem->directories($directory))->each($callback);
            }
        } else {
            return self::$filesystem->directories($directory);
        }
    }
}
