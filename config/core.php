<?php

// config for LaraIO\Core

use LaraIO\Core\Commands\CoreCommand;
use LaraIO\Core\Commands\ModuleDisableCommand;
use LaraIO\Core\Commands\ModuleDumpCommand;
use LaraIO\Core\Commands\ModuleEnableCommand;

return [
    'web' => [
        'admin' => '',
    ],
    'appdir' => [
        'root' => 'LaraApp',
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
