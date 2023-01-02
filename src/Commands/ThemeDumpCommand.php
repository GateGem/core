<?php

namespace GateGem\Core\Commands;

use Illuminate\Console\Command;
use GateGem\Core\Facades\Theme;
use Symfony\Component\Console\Input\InputArgument;

class ThemeDumpCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'theme:dump';

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

        if ($theme = $this->argument('theme')) {
            $this->dump($theme);
        } else {
            foreach (Theme::getData() as $theme) {
                $this->dump($theme->getStudlyName());
            }
        }

        return 0;
    }

    public function dump($theme)
    {
        $theme = Theme::find($theme);

        $this->line("<comment>Running for theme</comment>: {$theme}");

        chdir($theme->getPath());

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
            ['theme', InputArgument::OPTIONAL, 'Theme name.'],
        ];
    }
}
