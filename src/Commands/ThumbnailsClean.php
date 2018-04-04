<?php

namespace Pvtl\VoyagerFrontend\Commands;

use Illuminate\Console\Command;

class ThumbnailsClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voyager-frontend:clean-thumbnails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean out old thumbnails';

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
        dd('Coming soon...');
    }
}
