<?php

namespace Pvtl\VoyagerFrontend;

use Laravel\Scout\Searchable;

class Post extends \TCG\Voyager\Models\Post
{
    use Searchable;
}
