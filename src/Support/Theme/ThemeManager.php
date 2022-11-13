<?php

namespace LaraIO\Core\Support\Theme;

use LaraIO\Core\Facades\Core;
use LaraIO\Core\Loader\HelperLoader;
use LaraIO\Core\Support\Core\Assets;
use LaraIO\Core\Traits\WithLoadInfoJson;
use LaraIO\Core\Utils\BaseScan;

class ThemeManager
{
    use WithLoadInfoJson;
    public function FileInfoJson()
    {
        return "theme.json";
    }
    public function HookFilterPath()
    {
        return 'theme_root_path';
    }
    public function PathFolder()
    {
        return theme_path();
    }
    private $path;

    private $info;

    private $layout;
    private Assets $assets;
    public function setTitle($title)
    {
        $this->getAssets()->setData('page_title', $title);
    }
    public function getAssets(): Assets
    {
        return $this->assets ?? ($this->assets = new Assets());
    }
    public function active($themeName)
    {
        $this->info = null;
        $this->path = null;
        $this->layout = null;
        foreach ($this->getData() as $item) {
            if ($item['name'] == $themeName) {
                $this->path = $item['path'];
                $this->info = $item;
                $this->layout = 'theme::' . getValueByKey($this->info, 'layout', 'layout');
                Core::loadViewsFrom($this->path . '/views','theme');
                HelperLoader::Load($this->path . '/function.php');
                BaseScan::Link($this->path . "/public", public_path('themes/' . $themeName));
                return;
            }
        }
    }
    public function setLayoutNone()
    {
        $this->setLayout('none');
    }
    public function setLayout($layout)
    {
        $this->layout = 'theme::' . $layout;
    }
    public function Layout()
    {
        return $this->layout;
    }
}
