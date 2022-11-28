<?php

namespace LaraIO\Core;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use LaraIO\Core\Commands\CoreCommand;
use LaraIO\Core\Facades\Theme;
use LaraIO\Core\Loader\OptionLoader;
use LaraIO\Core\Loader\TableLoader;
use LaraIO\Core\Support\Core\ServicePackage;
use LaraIO\Core\Traits\WithServiceProvider;
use LaraIO\Core\Builder\Menu\MenuBuilder;
use LaraIO\Core\Facades\Core;
use LaraIO\Core\Facades\Module;
use LaraIO\Core\Facades\Plugin;

class CoreServiceProvider extends ServiceProvider
{
    use WithServiceProvider;

    public function configurePackage(ServicePackage $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         */
        $package
            ->name('core')
            ->hasConfigFile()
            ->hasViews()
            ->hasHelpers()
            ->hasAssets()
            ->hasTranslations()
            ->runsMigrations()
            ->runsSeeds()
            ->hasRoutes('web');
    }
    public function extending()
    {
        add_filter('page_body_class', function ($prev) {
            return $prev . (session('admin_sidebar_mini') ? ' is-sidebar-mini ' : '');
        });
        add_filter('language_list', function ($prev) {
            return [
                ...$prev,
                'en' => 'us',
                'vi' => 'vn',
                'jp' => 'jp'
            ];
        });
    }
    public function registerMenu()
    {
        add_menu_with_sub(function ($subItem) {
            $subItem
                ->addItem('core::menu.sidebar.user', 'bi bi-speedometer', '', ['name' => 'core.table.slug', 'param' => ['module' => 'user']], MenuBuilder::ItemRouter)
                ->addItem('core::menu.sidebar.role', 'bi bi-speedometer', '', ['name' => 'core.table.slug', 'param' => ['module' => 'role']], MenuBuilder::ItemRouter)
                ->addItem('core::menu.sidebar.permission', 'bi bi-speedometer', '', ['name' => 'core.table.slug', 'param' => ['module' => 'permission']], MenuBuilder::ItemRouter);
        }, 'core::menu.sidebar.user',  'bi bi-speedometer');
        add_menu_with_sub(function ($subItem) {
            $subItem->addItem('core::menu.sidebar.setting', 'bi bi-speedometer', '', ['name' => 'core.option', 'param' => []], MenuBuilder::ItemRouter)
                ->addItem('core::menu.sidebar.module', 'bi bi-speedometer', '', ['name' => 'core.table.slug', 'param' => ['module' => 'module']], MenuBuilder::ItemRouter)
                ->addItem('core::menu.sidebar.plugin', 'bi bi-speedometer', '', ['name' => 'core.table.slug', 'param' => ['module' => 'plugin']], MenuBuilder::ItemRouter)
                ->addItem('core::menu.sidebar.theme', 'bi bi-speedometer', '', ['name' => 'core.table.slug', 'param' => ['module' => 'theme']], MenuBuilder::ItemRouter);
        }, 'core::menu.sidebar.setting', 'bi bi-speedometer');
        
        add_menu_item('core::menu.sidebar.dashboard', 'bi bi-speedometer', '', 'core.dashboard', MenuBuilder::ItemRouter, '', '', -100);
    }
    public function packageRegistered()
    {
        Theme::RegisterApp();
        Module::RegisterApp();
        Plugin::RegisterApp();

        Theme::Register(__DIR__ . '/../themes');
        TableLoader::load(__DIR__ . '/../config/tables');
        OptionLoader::load(__DIR__ . '/../config/options');
        $this->registerMenu();
        $this->extending();
    }
    private function bootGate()
    {
        if (!$this->app->runningInConsole()) {
            app(config('core.auth.permission', \LaraIO\Core\Models\Permission::class))->get()->map(function ($permission) {
                Gate::define($permission->slug, function ($user = null) use ($permission) {
                    if (!$user) $user = auth();
                    return $user->hasPermissionTo($permission) || $user->isSuperAdmin();
                });
            });
            Gate::before(function ($user, $ability) {
                if (!$user) $user = auth();
                if ($user->isSuperAdmin()) {
                    return true;
                }
            });
            Gate::define(Core::adminPrefix(), function ($user) {
                return true;
            });

            //Blade directives
            Blade::directive('role', function ($role) {
                return "if(auth()->check() &&(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('{$role}'))) :"; //return this if statement inside php tag
            });

            Blade::directive('endrole', function ($role) {
                return "endif;"; //return this endif statement inside php tag
            });
            add_filter('permission_custom', function ($prev) {
                return [
                    ...$prev,
                    'core.module.user.permission',
                    'core.module.role.permission',
                    'core.module.permission.load-permission',
                ];
            });
        }
    }
    public function packageBooted()
    {
        add_link_symbolic(__DIR__ . '/../public', public_path('modules/lara-core'));
        add_asset_js(asset('modules/lara-core/js/lara-core.js'), '', 0);
        add_asset_css(asset('modules/lara-core/css/lara-core.css'), '',  0);
        add_asset_css('https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css', 'https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css',  0);

        $this->bootGate();
        Module::BootApp();
        Plugin::BootApp();
    }
}
