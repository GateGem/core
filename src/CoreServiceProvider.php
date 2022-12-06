<?php

namespace GateGem\Core;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use GateGem\Core\Facades\Theme;
use GateGem\Core\Loader\OptionLoader;
use GateGem\Core\Loader\TableLoader;
use GateGem\Core\Support\Core\ServicePackage;
use GateGem\Core\Traits\WithServiceProvider;
use GateGem\Core\Builder\Menu\MenuBuilder;
use GateGem\Core\Facades\Core;
use GateGem\Core\Facades\Module;
use GateGem\Core\Facades\Plugin;
use Illuminate\Support\Facades\Log;

class CoreServiceProvider extends ServiceProvider
{
    use WithServiceProvider;

    public function configurePackage(ServicePackage $package): void
    {
        // $router = $this->app['router'];
        //\GateGem\Core\Http\Middleware\CoreMiddleware::class,
        // $router->middlewareGroup('web',[\GateGem\Core\Http\Middleware\CoreMiddleware::class]);
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
        // First Setup Layout Theme
        add_action("theme_head_before", function ($isPageTitle = true) {
            if (!isset($isPageTitle) || $isPageTitle === true) {
                echo "<title>" . page_title() . "</title>";
            }
            Theme::getAssets()->loadAsset("asset_head_before");
        }, 0);
        add_action("theme_head_after", function () {
            Theme::getAssets()->loadAsset("asset_head_after");
        }, 0);

        add_action("theme_body_before", function () {
            Theme::getAssets()->loadAsset("asset_body_before");
        }, 0);
        add_action("theme_body_after", function () {
            Theme::getAssets()->loadAsset("asset_body_after");
        }, 0);
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
        add_filter('core_auth_filter_gate', function ($prev, $user, $permission) {
            if ($permission->slug == 'core.option') {
                return false;
            }
            return $prev;
        }, 20, 3);
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
        Theme::LoadApp();
        Module::LoadApp();
        Plugin::LoadApp();
        $this->registerMenu();
        $this->extending();
    }
    private function bootGate()
    {
        if (!$this->app->runningInConsole()) {

            app(config('core.auth.permission', \GateGem\Core\Models\Permission::class))->get()->map(function ($permission) {
                Gate::define($permission->slug, function ($user = null) use ($permission) {
                    if (!$user) $user = auth();
                    if ($user->isBlock()) return false;
                    if (!apply_filters('core_auth_filter_gate', true, $user, $permission) || !apply_filters('core_auth_filter_gate_admin', true, $user)) return false;
                    return $user->hasPermissionTo($permission) || $user->isSuperAdmin();
                });
            });
            Gate::before(function ($user, $ability) {
                if (!$user) $user = auth();
                if (apply_filters('core_auth_filter_gate_admin', true, $user) && $user->isSuperAdmin()) {
                    return true;
                }
            });
            foreach (Core::getPermissionGuest() as $item) {
                Gate::define($item, function () {
                    return true;
                });
            }


            //Blade directives
            Blade::directive('role', function ($role) {
                return "if(auth()->check() &&(auth()->user()->isSuperAdmin() || auth()->user()->hasRole('{$role}'))) :"; //return this if statement inside php tag
            });

            Blade::directive('endrole', function ($role) {
                return "endif;"; //return this endif statement inside php tag
            });
        }
    }
    public function bootingPackage()
    {
        add_link_symbolic(__DIR__ . '/../public', public_path('modules/gate-core'));
        add_asset_js(asset('modules/gate-core/js/gate-core.js'), '', 0);
        add_asset_css(asset('modules/gate-core/css/gate-core.css'), '',  0);
        add_asset_css('https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css', 'https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css',  0);

        Module::RegisterApp();
        Plugin::RegisterApp();
    }
    public function packageBooted()
    {
        Module::BootApp();
        Plugin::BootApp();
        $this->bootGate();
    }
}
