<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class SearchController extends BaseController
{
    public function index()
    {
        // find a way to grab all "Searchable" models so we can use them below

        // perform Model::search('string')->get(); on multiple Models?
        
        // return search blade view
    }
}
