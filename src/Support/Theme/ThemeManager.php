<?php

namespace LaraIO\Core\Support\Theme;

use LaraIO\Core\Support\Core\Assets;
use LaraIO\Core\Support\Core\DataInfo;
use LaraIO\Core\Traits\WithLoadInfoJson;

class ThemeManager
{
    use WithLoadInfoJson;
    public function getName()
    {
        return "theme";
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
        if (!isset($this->data_active) || !$this->data_active) {
            $this->data_active = $this->find(apply_filters("filter_theme_layout", get_option('page_site_theme')));
            if ($this->data_active) {
                if (!$this->layout) {
                    $this->layout = 'theme::' .   $this->data_active->getValue('layout', 'layout');
                }
                $this->data_active->DoRegister('theme');
            }
        }
        return $this->layout;
    }
}
