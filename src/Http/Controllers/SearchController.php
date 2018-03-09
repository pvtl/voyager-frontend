<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use Pvtl\VoyagerFrontend\Page;
use Pvtl\VoyagerFrontend\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class SearchController extends BaseController
{
    protected $searchableModels = [];

    public function __construct()
    {
        $this->searchableModels = [
            Page::class,
            Post::class,
        ];
    }

    public function index(Request $request)
    {
        $searchString = $request->input('q');

        // perform Model::search('string')->get(); on multiple Models?
        $searchResults = array_map(function ($model) use ($searchString) {
            $model::search($searchString)->paginate(10);
        }, $this->searchableModels);

        dd('here');

        // return search blade view
    }
}
