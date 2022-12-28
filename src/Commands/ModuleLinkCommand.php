<?php

namespace GateGem\Core\Commands;

use GateGem\Core\CoreServiceProvider;
use GateGem\Core\Facades\Core;
use GateGem\Core\Facades\Module;
use GateGem\Core\Facades\Plugin;
use GateGem\Core\Facades\Theme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\InputOption;

class ModuleLinkCommand extends Command
{
    protected $name = 'module:link';


    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['reload', null, InputOption::VALUE_OPTIONAL, 'reload app.', null],
            ['relative', null, InputOption::VALUE_OPTIONAL, 'Create the symbolic link using relative path.', null],
            ['force', null, InputOption::VALUE_OPTIONAL, 'Recreate existing symbolic links.', null],
        ];
    }
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the symbolic links configured for the application';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->components->info('Generating optimized symbolic links.');
        Core::checkFolder(true);
        $force = $this->option('force');
        $relative = $this->option('relative');
        $reload = $this->option('reload');
        if ($reload) {
            Core::resetLinks();
            Theme::ResetData();
            Plugin::ResetData();
            Module::ResetData();
            Theme::LoadApp();
            Module::LoadApp();
            Plugin::LoadApp();
            Module::RegisterApp();
            Plugin::RegisterApp();
            Module::BootApp();
            Plugin::BootApp();
            // $core = app(CoreServiceProvider::class);
            // $core->register();
            // $core->boot();
        }
        Theme::findAndActive('gate-none');
        Theme::findAndActive(get_option('page_site_theme'));
        Theme::findAndActive(get_option('page_admin_theme'));
        Log::info(Core::getLinks());
        foreach (Core::getLinks() as  [
            'target' => $target,
            'link' => $link
        ]) {
            try {
                $link = ($link);
                $target = (realpath($target));
                $this->components->info("The [$link] link has been connected to [$target].");
                if (file_exists($link) && !$this->isRemovableSymlink($link, $force)) {
                    $this->components->error("The [$link] link already exists.");
                    continue;
                }

                if (is_link($link)) {
                    $this->laravel->make('files')->delete($link);
                }

                if (($relative)) {
                    $this->laravel->make('files')->relativeLink($target, $link);
                    $this->components->info("The [$link] relativeLink has been connected to [$target].");
                } else {
                    $this->laravel->make('files')->link($target, $link);
                    $this->components->info("The [$link] link has been connected to [$target].");
                }
            } catch (\Exception $e) {
            }
        }
        $this->call('storage:link');

        return 0;
    }
    /**
     * Determine if the provided path is a symlink that can be removed.
     *
     * @param  string  $link
     * @param  bool  $force
     * @return bool
     */
    protected function isRemovableSymlink(string $link, bool $force): bool
    {
        return is_link($link) && $force;
    }
}
