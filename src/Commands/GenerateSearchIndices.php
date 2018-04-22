<?php

namespace Pvtl\VoyagerFrontend\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Pvtl\VoyagerFrontend\Http\Controllers\SearchController;

class GenerateSearchIndices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voyager-frontend:generate-search-indices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all search indices for Searchable Models.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!file_exists(config_path() . '/scout.php')) {
            Artisan::call("vendor:publish", ['--provider' => 'Laravel\Scout\ScoutServiceProvider']);
        }

        $searchableModels = SearchController::getSearchableModels();

        foreach ($searchableModels as $model) {
            if (!class_exists($model)) {
                continue;
            }

            Artisan::call("scout:import", ['model' => $model]);
        }

        return true;
    }
}
