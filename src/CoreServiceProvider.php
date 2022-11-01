<?php

namespace LaraPlatform\Core;

use Illuminate\Support\ServiceProvider;
use LaraPlatform\Core\Commands\CoreCommand;
use LaraPlatform\Core\Facades\Theme;
use LaraPlatform\Core\Loader\OptionLoader;
use LaraPlatform\Core\Loader\TableLoader;
use LaraPlatform\Core\Supports\ServicePackage;
use LaraPlatform\Core\Traits\WithServiceProvider;
use LaraPlatform\Core\Builder\Menu\MenuBuilder;

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
            ->hasRoutes('web')
            ->hasCommand(CoreCommand::class);
    }
    public function registerMenu()
    {
        add_menu_with_sub('Dasboard', function ($subItem) {
            $subItem->setName(__("core::menu.sidebar.dashboard"));
            $subItem->addItem(function ($item) {
                $item->setItem(__("core::menu.sidebar.dashboard"), 'bi bi-speedometer', '', 'admin.dashboard', MenuBuilder::ItemRouter);
            });
        }, 'bi bi-speedometer');

        add_menu_with_sub("user", function ($subItem) {
            $subItem->setName(__("core::menu.sidebar.user"));
            $subItem->addItem(function ($item) {
                $item->setItem(__("core::menu.sidebar.user"), 'bi bi-speedometer', '', ['name' => 'admin.table.slug', 'param' => ['module' => 'user']], MenuBuilder::ItemRouter);
            })->addItem(function ($item) {
                $item->setItem(__("core::menu.sidebar.role"), 'bi bi-speedometer', '', ['name' => 'admin.table.slug', 'param' => ['module' => 'role']], MenuBuilder::ItemRouter);
            })->addItem(function ($item) {
                $item->setItem(__("core::menu.sidebar.permission"), 'bi bi-speedometer', '', ['name' => 'admin.table.slug', 'param' => ['module' => 'permission']], MenuBuilder::ItemRouter);
            });
        }, 'bi bi-speedometer');
        add_menu_with_sub('Setting', function ($subItem) {
            $subItem->setName(__("core::menu.sidebar.setting"));
            $subItem->addItem(function ($item) {
                $item->setItem(__("core::menu.sidebar.setting"), 'bi bi-speedometer', '', ['name' => 'admin.option', 'param' => []], MenuBuilder::ItemRouter);
            });
        }, 'bi bi-speedometer');
    }
    public function packageRegistered()
    {
        //\File::link(__DIR__."/../public", public_path('modules/lara-core'));
        add_asset_js(asset('modules/lara-core/js/lara-core.js'), '', 0);
        add_asset_css(asset('modules/lara-core/css/lara-core.css'), '',  0);
        Theme::Register(__DIR__ . '/../themes');
        Theme::active('lara-admin');
        Theme::print();
        TableLoader::load(__DIR__ . '/../config/tables');
        OptionLoader::load(__DIR__ . '/../config/options');
        $this->registerMenu();
    }
}
