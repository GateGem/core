<?php

namespace LaraIO\Core\Support\Core;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use LaraIO\Core\Utils\BaseScan;
use SplFileInfo;

class CoreManager
{

    private $app;

    public function __construct()
    {
        $this->app = app();
    }

    /**
     * Setup an after resolving listener, or fire immediately if already resolved.
     *
     * @param  string  $name
     * @param  callable  $callback
     * @return void
     */
    public function callAfterResolving($name, $callback)
    {
        $this->app->afterResolving($name, $callback);

        if ($this->app->resolved($name)) {
            $callback($this->app->make($name), $this->app);
        }
    }

    public function loadViewsFrom($path, $namespace = 'core')
    {
        $this->callAfterResolving('view', function ($view) use ($path, $namespace) {
            if (
                isset($this->app->config['view']['paths']) &&
                is_array($this->app->config['view']['paths'])
            ) {
                foreach ($this->app->config['view']['paths'] as $viewPath) {
                    if (is_dir($appPath = $viewPath . '/vendor/' . $namespace)) {
                        $view->addNamespace($namespace, $appPath);
                    }
                }
            }

            $view->addNamespace($namespace, $path);
        });
    }
    public function RoleAdmin()
    {
        return config('core.permission.role', 'admin');
    }
    public function adminPrefix()
    {
        return apply_filters("router_admin_prefix", config('core.web.admin', '/admincp'));
    }
    public function MapPermissionModule($arr)
    {
        if (is_array($arr)) {
            if ($arr['name'] == 'core.table.slug') {
                return 'core.module.' . getValueByKey($arr, 'param.module', '');
            }
            return $arr['name'];
        }
        return $arr;
    }
    public function SwitchLanguage($lang, $redirect_current = false)
    {
        Session::put('language', $lang);
        if ($redirect_current)
            return Redirect::to(URL::current());
    }
    public function checkCurrentLanguage()
    {
        // current uri language ($lang_uri)
        $lang_uri = Request::segment(1);
        $languages = apply_filters('language_list', []);
        // Set default session language if none is set
        if (!Session::has('language')) {
            // use lang in uri, if provided
            if (in_array($lang_uri, $languages)) {
                $lang = $lang_uri;
            }
            // detect browser language
            elseif (Request::server('http_accept_language')) {
                $headerlang = substr(Request::server('http_accept_language'), 0, 2);

                if (in_array($headerlang, $languages)) {
                    // browser lang is supported, use it
                    $lang = $headerlang;
                }
                // use default application lang
                else {
                    $lang = Config::get('app.locale');
                }
            }
            // no lang in uri nor in browser. use default
            else {
                // use default application lang
                $lang = Config::get('app.locale');
            }

            // set application language for that user
            Session::put('language', $lang);
            app()->setLocale(Session::get('language'));
        }
        // session is available
        else {
            // set application to session lang
            app()->setLocale(Session::get('language'));
        }

        // prefix is missing? add it
        if (!in_array($lang_uri, $languages)) {
            return Redirect::to(URL::current());
        }
        // a valid prefix is there, but not the correct lang? change app lang
        elseif (in_array($lang_uri, $languages) and $lang_uri != Config::get('app.locale')) {
            Session::put('language', $lang_uri);
            app()->setLocale(Session::get('language'));
        }
    }
    public function RootPath($path = '')
    {
        return base_path(config('core.appdir.root') . '/' . $path);
    }
    public function ThemePath($path = '')
    {
        return $this->RootPath(config('core.appdir.theme') . '/' . $path);
    }
    public function PluginPath($path = '')
    {
        return $this->RootPath(config('core.appdir.plugin') . '/' . $path);
    }
    public function ModulePath($path = '')
    {
        return $this->RootPath(config('core.appdir.module') . '/' . $path);
    }
    public function LoadHelper($path)
    {
        if ($path && BaseScan::FileExists($path)) {
            require_once $path;
        }
    }

    public function RegisterHelper($path)
    {
        BaseScan::AllFile($path, function (SplFileInfo $file) {
            self::LoadHelper($file->getPathname());
        });
    }
}
