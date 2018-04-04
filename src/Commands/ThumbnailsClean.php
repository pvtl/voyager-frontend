<?php

namespace Pvtl\VoyagerFrontend\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

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
        $storage = Storage::disk(config('voyager.storage.disk'));
        $images = $storage->allFiles('resized');
        $directories = $storage->allDirectories('resized');
        $oneWeekAgo = Carbon::now()->subWeek();
        $imagesToDelete = array();

        // Form an array of images that are older than 1 week
        foreach ((array)$images as $imageName) {
            $fileModifiedDate = Carbon::createFromTimestamp($storage->lastModified($imageName));

            if ($oneWeekAgo->gte($fileModifiedDate)) {
                $imagesToDelete[] = $imageName;
            }
        }

        // Delete the images
        $numImagesToDelete = count($imagesToDelete);
        if ($numImagesToDelete > 0) {
            $storage->delete($imagesToDelete);
        }

        // Remove any empty directories
        $numDeletedDirs = 0;
        foreach ((array)$directories as $dirName) {
            if (count($storage->files($dirName)) < 1) {
                $storage->deleteDirectory($dirName);
                $numDeletedDirs++;
            }
        }

        $this->info("Cleaned out $numImagesToDelete old images and $numDeletedDirs directories");
    }
}
