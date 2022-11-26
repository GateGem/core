<?php

namespace LaraIO\Core\Commands;

use Illuminate\Console\Command;
use LaraIO\Core\Facades\Core;

class CoreCommand extends Command
{
    public $signature = 'core-install';
    public $description = 'laraio\core install';
    protected bool $askToRunMigrations = false;
    protected bool $copyServiceProviderInApp = true;
    protected ?string $starRepo = "laraio/core";

    public function handle(): int
    {
        if ($this->askToRunMigrations) {
            if ($this->confirm('Would you like to run the migrations now?')) {
                $this->comment('Running migrations...');

                $this->call('migrate');
            }
        }

        if ($this->copyServiceProviderInApp) {
            $this->copyServiceProviderInApp();
        }

        if ($this->starRepo) {
            if ($this->confirm('Would you like to star our repo on GitHub?')) {
                $repoUrl = "https://github.com/{$this->starRepo}";

                if (PHP_OS_FAMILY == 'Darwin') {
                    exec("open {$repoUrl}");
                }
                if (PHP_OS_FAMILY == 'Windows') {
                    exec("start {$repoUrl}");
                }
                if (PHP_OS_FAMILY == 'Linux') {
                    exec("xdg-open {$repoUrl}");
                }
            }
        }

        $this->info("LaraIO\\Core has been installed!");
        $this->comment('All done');

        return self::SUCCESS;
    }

    protected function copyServiceProviderInApp(): self
    {
        ReplaceTextInFile(app_path('Models/User.php'), "Illuminate\\Foundation\\Auth\\User", "LaraIO\\Core\\Models\\User");
        $this->info("App/Models/User.php has been updated!");
        ReplaceTextInFile(app_path('Http/Kernel.php'), "\\App\\Http\\Middleware\\VerifyCsrfToken::class,", "\\App\\Http\\Middleware\\VerifyCsrfToken::class,\n\\LaraIO\\Core\\Http\\Middleware\\CoreMiddleware::class,", true);
        $this->info("App/Http/Kernel.php has been updated!");
        ReplaceTextInFile(base_path('database/seeders/DatabaseSeeder.php'), "\\App\\Models\\User::factory(10)->create();", "\\App\\Models\\User::factory(10)->create();\n\t\t\$this->call([\\LaraIO\\Core\\Database\\Seeders\\InitLaraIOSeeder::class]);", true);
        $this->info("database/seeders/DatabaseSeeder.php has been updated!");
        Core::checkFolder();
        return $this;
    }
}
