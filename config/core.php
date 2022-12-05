<?php

// config for GateGem\Core

use GateGem\Core\Commands\CoreCommand;
use GateGem\Core\Commands\ModuleDisableCommand;
use GateGem\Core\Commands\ModuleDumpCommand;
use GateGem\Core\Commands\ModuleEnableCommand;

return [
    'web' => [
        'admin' => '',
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
    ]
];
