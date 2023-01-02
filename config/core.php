<?php

// config for GateGem\Core

use GateGem\Core\Commands\CoreCommand;
use GateGem\Core\Commands\ModuleDisableCommand;
use GateGem\Core\Commands\ModuleDumpCommand;
use GateGem\Core\Commands\ModuleEnableCommand;
use GateGem\Core\Commands\ModuleLinkCommand;
use GateGem\Core\Commands\PluginDumpCommand;
use GateGem\Core\Commands\ThemeDumpCommand;

return [
    'web' => [
        'admin' => '',
    ],
    'permission' => [
        'guest' => ['core.dashboard'],
        'custom' => [
            'core.user.permission',
            'core.role.permission',
            'core.permission.load-permission'
        ],
    ],
    'appdir' => [
        'root' => 'GateApp',
        'theme' => 'Themes',
        'module' => 'Modules',
        'plugin' => 'Plugins',
    ],
    'commands' => [
        CoreCommand::class,
        ModuleDumpCommand::class,
        ModuleDisableCommand::class,
        ModuleEnableCommand::class,
        ModuleLinkCommand::class,
        ThemeDumpCommand::class,
        PluginDumpCommand::class
    ]
];
