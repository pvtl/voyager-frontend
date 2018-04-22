<?php

namespace Pvtl\VoyagerFrontend;

use Laravel\Scout\Searchable;
use Pvtl\VoyagerFrontend\Helpers\BladeCompiler;

class Post extends \TCG\Voyager\Models\Post
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

    /**
     * Update the post body
     *
     * @param  string $value
     * @return string
     * @throws \Exception
     */
    public function getBodyAttribute($value)
    {
        if (!empty($value)) {
            return BladeCompiler::getHtmlFromString($value);
        }
    }
}
