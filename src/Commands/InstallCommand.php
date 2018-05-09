<?php

namespace Pvtl\VoyagerFrontend\Commands;

use Pvtl\VoyagerFrontend\Providers\VoyagerFrontendServiceProvider;
use TCG\Voyager\Traits\Seedable;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    use Seedable;

    protected $seedersPath = __DIR__ . '/../../database/seeds/';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'voyager-frontend:install';

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
        if (file_exists(getcwd() . '/composer.phar')) {
            return '"' . PHP_BINARY . '" ' . getcwd() . '/composer.phar';
        }

        return 'composer';
    }

    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }


    /**
     * Execute the console command
     *
     * @param Filesystem $filesystem
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle(Filesystem $filesystem)
    {
        // Clean Up
        $this->info('Deleting Laravel\'s default assets, to make way for ours');
        (new Filesystem)->deleteDirectory(resource_path('assets', true));

        $this->info('Remove default welcome page');
        (new Filesystem)->delete(resource_path('views/welcome.blade.php'));

        $this->info('Remove default web route');
        $routes_contents = (new Filesystem)->get(base_path('routes/web.php'));
        if (false !== strpos($routes_contents, "return view('welcome')")) {
            $routes_contents = str_replace("\n\nRoute::get('/', function () {\n    return view('welcome');\n});", '',
                $routes_contents);
            (new Filesystem)->put(base_path('routes/web.php'), $routes_contents);
        }


        // Use our files
        $this->info('Copying authentication views to main project');
        (new Filesystem)->copyDirectory(
            __DIR__ . '/../../stubs/views', resource_path('views')
        );

        $this->info('Copying our webpack.mix.js to the project root');
        (new Filesystem)->copy(
            __DIR__ . '/../../webpack.mix.js', resource_path('../webpack.mix.js')
        );

        $this->info('Publishing the Voyager assets, database, and config files');
        $this->call('vendor:publish', ['--provider' => VoyagerFrontendServiceProvider::class]);

        $this->info('Updating Root package.json to include dependencies');

        $process = new Process('
            npm i foundation-sites scrollreveal motion-ui jquery --save-dev &&
            npm uninstall bootstrap bootstrap-sass --save-dev &&
            npm run dev
        ');
        $process->setTimeout(null); // Setting timeout to null to prevent installation from stopping at a certain point in time
        $process->setWorkingDirectory(base_path())->mustRun();

        $this->info('Dumping the autoloaded files and reloading all new files');
        $composer = $this->findComposer();
        $process = new Process($composer . ' dump-autoload');
        $process->setTimeout(null); // Setting timeout to null to prevent installation from stopping at a certain point in time
        $process->setWorkingDirectory(base_path())->mustRun();


        // Database
        $this->info('Migrating the database tables into your application');
        $this->call('migrate');

        $this->info('Seeding data into the database');
        $this->seed('VoyagerFrontendDatabaseSeeder');

        $this->info('Successfully installed Voyager Frontend! Enjoy');

        $this->call('voyager-blog:install');
        $this->call('voyager-pages:install');
    }
}
