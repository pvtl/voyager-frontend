<?php

return [
    /*
    |--------------------------------------------------------------------------
    | TNTSearch Configuration (https://github.com/teamtnt/laravel-scout-tntsearch-driver)
    |--------------------------------------------------------------------------
    |
    | There is where we define our configuration for the TNTSearch local search
    | implementation for Laravel Scout.
    |
    */
    'tntsearch' => [
        'storage' => storage_path(),
        'fuzziness' => env('TNTSEARCH_FUZZINESS', true),
        'fuzzy' => [
            'prefix_length' => 2,
            'max_expansions' => 50,
            'distance' => 2
        ],
        'asYouType' => env('TNTSEARCH_AS_YOU_TYPE', false),
        'searchBoolean' => env('TNTSEARCH_BOOLEAN', false),

        'searchableModels' => [
            '\Pvtl\VoyagerFrontend\Page',
            '\Pvtl\VoyagerFrontend\BlogPost',
        ],
    ],
];
