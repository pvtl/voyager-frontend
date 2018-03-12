<?php

namespace Pvtl\VoyagerFrontend;

use Laravel\Scout\Searchable;

class Page extends \TCG\Voyager\Models\Page
{
    use Searchable;

    public $asYouType = false;

    /**
     * Get the indexed data array for the model.
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
