<?php

namespace Pvtl\VoyagerFrontend;

use Laravel\Scout\Searchable;
use Pvtl\VoyagerFrontend\Helpers\BladeCompiler;

class Post extends \TCG\Voyager\Models\Post
{
    use Searchable;

    public $asYouType = false;

    public static $slugPrefix = 'posts/';

    /**
     * Get the indexed data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }

    /**
     * Update the post body
     *
     * @param  string  $value
     * @return string
     */
    public function getBodyAttribute($value)
    {
        if (!empty($value)) {
            return BladeCompiler::getHtmlFromString($value);
        }
    }
}
