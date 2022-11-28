<?php

namespace LaraIO\Core\Commands;

use Illuminate\Console\Command;
use LaraIO\Core\Facades\Module;
use Symfony\Component\Console\Input\InputArgument;

class ModuleEnableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:enable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable the specified module.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        /**
         * check if user entred an argument
         */
        if ($this->argument('module') === null) {
            $this->enableAll();

            return 0;
        }

        $module = Module::find($this->argument('module'));
        if (!$module->isActive()) {
            $module->Active();

            $this->info("Module [{$module}] Active successful.");
        } else {
            $this->comment("Module [{$module}] has already Active.");
        }

        return 0;
    }

    /**
     * enableAll
     *
     * @return void
     */
    public function enableAll()
    {
        /** @var Modules $modules */
        $modules = $this->laravel['modules']->all();

        foreach ($modules as $module) {
            if ($module->isDisabled()) {
                $module->enable();

                $this->info("Module [{$module}] enabled successful.");
            } else {
                $this->comment("Module [{$module}] has already enabled.");
            }
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::OPTIONAL, 'Module name.'],
        ];
    }
}
