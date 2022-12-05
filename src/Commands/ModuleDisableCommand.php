<?php

namespace GateGem\Core\Commands;

use Illuminate\Console\Command;
use GateGem\Core\Facades\Module;
use Symfony\Component\Console\Input\InputArgument;

class ModuleDisableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable the specified module.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        /**
         * check if user entred an argument
         */
        if ($this->argument('module') === null) {
            $this->disableAll();
            return 0;
        }

        $module = Module::find($this->argument('module'));

        if ($module->isActive()) {
            $module->UnActive();

            $this->info("Module [{$module}] UnActive successful.");
        } else {
            $this->comment("Module [{$module}] has already UnActive.");
        }

        return 0;
    }

    /**
     * disableAll
     *
     * @return void
     */
    public function disableAll()
    {

        foreach (Module::getData() as $module) {
            if ($module->isActive()) {
                $module->UnActive();

                $this->info("Module [{$module}] UnActive successful.");
            } else {
                $this->comment("Module [{$module}] has already UnActive.");
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
