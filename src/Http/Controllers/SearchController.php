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
        $searchString = $request->input('keywords');

        if (empty($this->searchableModels) || is_null($this->searchableModels)) {
            return view('voyager-frontend::modules.search.listing', [
                'resultCollections' => [],
            ]);
        }

        foreach ($this->searchableModels as $model) {
            $result = $model::search($searchString)->take(5)->get();
            $modelPath = explode('\\', strtolower($model));

            // Add Model Slug Prefix
            foreach ($result as $item) {
                $dataType = \TCG\Voyager\Models\DataType::
                    where('name', $item->getTable())
                    ->first();

                if (!empty($item->slug) && !empty($dataType->slug)) {
                    $item->slug = $dataType->slug . '/' . $item->slug;
                }
            }

            $searchResults[end($modelPath)] = $result;
        }

        return view('voyager-frontend::modules.search.listing', [
            'resultCollections' => $searchResults,
        ]);
    }

    /**
     * Filters our duplicates and retrieves an array of
     * searchable models from our configuration file
     * @return array
     */
    public static function getSearchableModels()
    {
        $searchableModels = [];

        foreach (config('scout.tntsearch.searchableModels') as $model) {
            $modelName = substr($model, strrpos($model, '\\') + 1);

            if (count(preg_grep("/$modelName/", $searchableModels)) > 0) {
                continue;
            }

            $searchableModels[] = $model;
        }

        return $searchableModels;
    }
}
