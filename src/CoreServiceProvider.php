<?php

namespace LaraPlatform\Core;

use Illuminate\Support\ServiceProvider;
use LaraPlatform\Core\Commands\CoreCommand;
use LaraPlatform\Core\Facades\Theme;
use LaraPlatform\Core\Loader\TableLoader;
use LaraPlatform\Core\Supports\ServicePackage;
use LaraPlatform\Core\Traits\WithServiceProvider;

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
            ->runsMigrations()
            ->hasRoutes('web')
            ->hasCommand(CoreCommand::class);
    }

    public function packageRegistered()
    {
        //\File::link(__DIR__."/../public", public_path('modules/lara-core'));
        add_asset_js(asset('modules/lara-core/js/lara-core.js'),'', 0);
        add_asset_css(asset('modules/lara-core/css/lara-core.css'),'',  0);
        Theme::Register(__DIR__.'/../themes');
        Theme::active('lara-admin');
        Theme::print();
        TableLoader::load(__DIR__.'/../config/tables');
    }
}
