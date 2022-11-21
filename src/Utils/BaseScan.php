<?php

namespace LaraIO\Core\Utils;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

class BaseScan
{
    /*
    * @var \Illuminate\Filesystem\Filesystem;
    */
    public static $filesystem;

    public static function checkFolder()
    {
        self::_check();
        $arr = [config('core::appdir.theme', 'themes'), config('core::appdir.module', 'modules'), config('core::appdir.plugin', 'plugins')];
        foreach ($arr as $item) {
            $public = public_path($item);
            $appdir = base_path(config('core::appdir.root', 'laro') . '/' . $item);
            self::$filesystem->ensureDirectoryExists($item);
            self::$filesystem->ensureDirectoryExists($appdir);
        }
    }

    private static function _check()
    {
        if (!self::$filesystem) {
            self::$filesystem = new Filesystem();
        }
    }

    public static function FileExists($path)
    {
        self::_check();

        return self::$filesystem->exists($path);
    }

    public static function SaveFileJson($path, $content)
    {
        return file_put_contents($path, json_encode($content));
    }
    public static function FileJson($path)
    {
        if (!self::FileExists($path)) {
            return [];
        }
        return json_decode(file_get_contents($path), true);
    }
    public static function FileReturn($path)
    {
        return include_once $path;
    }

    public static function AllFile($directory, $callback = null, $filter = null)
    {
        self::_check();
        if (!self::$filesystem->isDirectory($directory)) {
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
        $files = self::AllFile($directory);
        if (!$files || !is_array($files)) return [];

        $classList = collect($files)->map(function (SplFileInfo $file) use ($namespace) {
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
        if (!self::$filesystem->isDirectory($directory)) {
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
    public static function Link($target, $link, $relative = false, $force = true)
    {
        if (file_exists($link) && is_link($link) && $force) {

            return;
        }

        self::checkFolder();
        if (is_link($link)) {
            self::$filesystem->delete($link);
        }

        if ($relative) {
            self::$filesystem->relativeLink($target, $link);
        } else {
            self::$filesystem->link($target, $link);
        }
    }
    public static function delete($path)
    {
        if (file_exists($path)) {
            self::$filesystem->delete($path);
        }
    }
}