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
        $searchString = $request->input('search');

        $searchResults = array_map(function ($model) use ($searchString) {
            $result = $model::search($searchString)->take(5)->get();

            $modelPath = explode('\\', strtolower($model) . 's');
            $result->name = end($modelPath);

            return $result;
        }, $this->searchableModels);

        return view('voyager-frontend::modules.search.search', [
            'resultCollections' => $searchResults,
        ]);
    }

    // need to write cron to import searchable models and store index
    public function getSearchableModels()
    {
        return $this->searchableModels;
    }
}
