<?php

namespace Pvtl\VoyagerFrontend;

use Laravel\Scout\Searchable;

class Post extends \TCG\Voyager\Models\Post
{
    use Searchable;

    public $asYouType = false;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }
}
