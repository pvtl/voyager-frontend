<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class SearchController extends BaseController
{
    protected $searchableModels = [];

    public function __construct()
    {
        $this->searchableModels = self::getSearchableModels();
    }

    public function index(Request $request)
    {
        $searchString = $request->input('search');

        if (empty($this->searchableModels) || is_null($this->searchableModels)) {
            return view('voyager-frontend::modules.search.search', [
                'resultCollections' => [],
            ]);
        }

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

    /**
     * Retrieves an array of searchable models from our config
     * @return array
     */
    public static function getSearchableModels()
    {
        return config('scout.tntsearch.searchableModels');
    }
}
