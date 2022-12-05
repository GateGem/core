<?php

namespace GateGem\Core\Commands;

use Illuminate\Console\Command;
use GateGem\Core\Facades\Module;
use Symfony\Component\Console\Input\InputArgument;

class ModuleDumpCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump-autoload the specified module or for all module.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Generating optimized autoload modules.');
        
        if ($module = $this->argument('module')) {
            $this->dump($module);
        } else {
            foreach (Module::getData() as $module) {
                $this->dump($module->getStudlyName());
            }
        }

        return 0;
    }

    public function dump($module)
    {
        $module = Module::find($module);

        $this->line("<comment>Running for module</comment>: {$module}");

        chdir($module->getPath());

        passthru('composer dump -o -n -q');
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
