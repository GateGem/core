<?php

use  Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use  LaraIO\Core\Facades\Action;
use LaraIO\Core\Facades\Filter;
use LaraIO\Core\Http\Action\ChangeFieldValue;
use LaraIO\Core\Models\Option;
use LaraIO\Core\Utils\BaseScan;

if (!function_exists('add_action')) {
    /**
     * @param  string | array  $hook
     * @param $callback
     * @param  int  $priority
     * @param  int  $arguments
     */
    function add_action($hook, $callback, int $priority = 20, int $arguments = 1)
    {
        Action::addListener($hook, $callback, $priority, $arguments);
    }
}

if (!function_exists('remove_action')) {
    /**
     * @param  string  $hook
     */
    function remove_action($hook, $callback = null)
    {
        Action::removeListener($hook, $callback);
    }
}
if (!function_exists('do_action')) {
    /**
     * @param  string  $hook
     */
    function do_action()
    {
        $args = func_get_args();
        Action::fire(array_shift($args), $args);
    }
}

if (!function_exists('add_filter')) {
    /**
     * @param  string | array  $hook
     * @param $callback
     * @param  int  $priority
     * @param  int  $arguments
     */
    function add_filter($hook, $callback, int $priority = 20, int $arguments = 1)
    {
        Filter::addListener($hook, $callback, $priority, $arguments);
    }
}
if (!function_exists('remove_filter')) {
    /**
     * @param  string  $hook
     */
    function remove_filter($hook, $callback)
    {
        Filter::removeListener($hook, $callback);
    }
}

if (!function_exists('apply_filters')) {
    /**
     * @return mixed
     */
    function apply_filters()
    {
        $args = func_get_args();

        return Filter::fire(array_shift($args), $args);
    }
}

if (!function_exists('get_hooks')) {
    /**
     * @param  string|null  $name
     * @param  bool  $isFilter
     * @return array
     */
    function get_hooks(?string $name = null, bool $isFilter = true): array
    {
        if ($isFilter) {
            $listeners = Filter::getListeners();
        } else {
            $listeners = Action::getListeners();
        }

        if (empty($name)) {
            return $listeners;
        }

        return Arr::get($listeners, $name, []);
    }
}


if (!function_exists('get_do_action_hook')) {
    /**
     * @param  string | array  $action
     * @param $param
     */
    function get_do_action_hook($action, $param)
    {
        if ($param) {
            if (is_string($param)) {
                if (json_decode($param, true) == null && $param != '{}') {
                    throw new \Exception('param is not validate json');
                } else {
                    $param = json_decode($param, true)??[];
                }
            }
        }
        return 'wire:click="DoAction(\'' . base64_encode(urlencode($action))  . '\',\'' . base64_encode(urlencode(json_encode($param ?? [])))  . '\')"';
    }
}

if (!function_exists('aciton_change_field_value_hook')) {
    /**
     * @param $param
     */
    function aciton_change_field_value_hook($param)
    {
        return get_do_action_hook(ChangeFieldValue::class, $param);
    }
}

if (!function_exists('add_link_symbolic')) {
    /**
     * @param $target
     * @param $link
     * @param $relative
     * @param $force
     */
    function add_link_symbolic($target, $link, $relative = false, $force = true)
    {
        BaseScan::Link($target, $link, $relative, $force);
    }
}



if (!function_exists('set_option')) {
    function set_option($key, $value = null, $locked = null)
    {
        Cache::forget($key);
        $setting = Option::where('key', $key)->first();
        if ($value !== null) {
            $setting = $setting ?? new Option(['key' => $key]);
            $setting->value = $value;
            $setting->locked = $locked === true;
            $setting->save();
            Cache::forever($key, $setting->value);
        } else if ($setting != null) {
            $setting->delete();
        }
    }
}
if (!function_exists('get_option')) {
    /**
     * Get Value: get_option("seo_key")
     * Get Value Or Default: get_option("seo_key","value_default")
     */
    function get_option($key, $default = null)
    {
        if (Cache::has($key) && Cache::get($key) != '') return Cache::get($key);

        $setting = Option::where('key', $key)->first();

        if ($setting == null) {
            return $default;
        }
        //Set Cache Forever
        Cache::forever($key, $setting->value);
        return $setting->value ?? $default;
    }
}


if (!function_exists('add_route_admin')) {
    function add_route_admin($callback)
    {
        add_action('register_route_admin', $callback);
    }
}
