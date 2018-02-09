<?php

namespace Pivotal\VoyagerFrontend\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\ImageServiceProviderLaravel5;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Pivotal\VoyagerFrontend\VoyagerFrontendServiceProvider;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'voyagerfrontend:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Voyager Frontend package';

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" '.getcwd().'/composer.phar';
        }

        return 'composer';
    }

    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }

    /**
     * Execute the console command.
     *
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     *
     * @return void
     */
    public function handle(Filesystem $filesystem)
    {
        $this->info('Move Laravel\'s default assets, to make way for ours');
        $process = new Process('mv resources/assets resources/assets-' . time());
        $process->setWorkingDirectory(base_path())->mustRun();

        $this->info('Publishing the Voyager assets, database, language, and config files');
        $this->call('vendor:publish', ['--provider' => VoyagerFrontendServiceProvider::class]);

        $this->info('Dumping the autoloaded files and reloading all new files');
        $composer = $this->findComposer();
        $process = new Process($composer.' dump-autoload');
        $process->setWorkingDirectory(base_path())->mustRun();

        $this->info('Updating Root package.json to include dependencies');
        $process = new Process('npm i bootstrap popper.js jquery --save-dev');
        $process->setWorkingDirectory(base_path())->mustRun();

        $this->info('Migrating the database tables into your application');
        $this->call('migrate');

        $this->info('Seeding data into the database');
        $this->call('db:seed', ['--class' => 'VoyagerFrontendDatabaseSeeder']);

        $this->info('Successfully installed Voyager Frontend! Enjoy');
    }
}
