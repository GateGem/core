<?php

namespace LaraIO\Core\Support\Theme;

use LaraIO\Core\Support\Core\Assets;
use LaraIO\Core\Support\Core\DataInfo;
use LaraIO\Core\Traits\WithLoadInfoJson;

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
    public function PublicFolder()
    {
        return public_path('themes');
    }
    private $layout;
    private Assets $assets;
    private ?DataInfo $data_active;
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
        $this->layout = null;
        foreach ($this->getData() as $item) {
            $item->setStatus(DataInfo::UnActive);
            $this->data_active = null;
            if ($item->checkKeyValue('name', $themeName)) {
                $this->data_active = $item;
                $this->layout = 'theme::' .   $this->data_active->getValue('layout', 'layout');
                $this->data_active->setStatus(DataInfo::Active);
                $this->data_active->DoActive('theme');
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
