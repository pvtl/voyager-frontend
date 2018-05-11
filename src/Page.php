<?php

namespace Pvtl\VoyagerFrontend;

use Laravel\Scout\Searchable;
use Pvtl\VoyagerFrontend\Helpers\BladeCompiler;

class Page extends \Pvtl\VoyagerPages\Page
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
        return $this->toArray();
    }
}
