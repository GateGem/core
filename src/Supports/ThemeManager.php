<?php

namespace LaraPlatform\Core\Supports;

use LaraPlatform\Core\Loader\HelperLoader;

class ThemeManager
{
    private $path;

    private $info;

    private $layout;

    private $arrTheme = [];

    private $app;

    private Assets $assets;

    public function getAssets(): Assets
    {
        return $this->assets ?? ($this->assets = new Assets());
    }

    public function __construct()
    {
        $this->app = app();
    }

    public function print()
    {
        // print_r($this->layout);
        // print_r($this->info);
        // print_r($this->path);
    }

    public function Register($path)
    {
        $arr = BaseScan::AllFolder($path);
        foreach ($arr as $item) {
            $this->AddTheme($item);
        }
    }

    public function AddTheme($path)
    {
        $this->arrTheme[] = [
            'path' => $path,
            'info' => BaseScan::FileJson($path.'/theme.json'),
        ];
    }

    /**
     * Setup an after resolving listener, or fire immediately if already resolved.
     *
     * @param  string  $name
     * @param  callable  $callback
     * @return void
     */
    private function callAfterResolving($name, $callback)
    {
        $this->app->afterResolving($name, $callback);

        if ($this->app->resolved($name)) {
            $callback($this->app->make($name), $this->app);
        }
    }

    private function loadViewsFrom($path)
    {
        $namespace = 'theme';
        $this->callAfterResolving('view', function ($view) use ($path, $namespace) {
            if (
                isset($this->app->config['view']['paths']) &&
                is_array($this->app->config['view']['paths'])
            ) {
                foreach ($this->app->config['view']['paths'] as $viewPath) {
                    if (is_dir($appPath = $viewPath.'/vendor/'.$namespace)) {
                        $view->addNamespace($namespace, $appPath);
                    }
                }
            }

            $view->addNamespace($namespace, $path);
        });
    }

    public function active($themeName)
    {
        $this->info = null;
        $this->path = null;
        $this->layout = null;
        foreach ($this->arrTheme as $item) {
            if ($item['info']['name'] == $themeName) {
                $this->path = $item['path'];
                $this->info = $item['info'];
                $this->layout = 'theme::'.($this->info && isset($this->info['layout']) && $this->info['layout'] ? $this->info['layout'] : 'layout');
                $this->loadViewsFrom($this->path.'/views');
                HelperLoader::Load($this->path.'/function.php');
                // \File::remove(public_path('themes/'.$themeName));
                // \File::link($this->path."/public", public_path('themes/'.$themeName));
                return;
            }
        }
    }

    public function Layout()
    {
        return $this->layout;
    }
}
