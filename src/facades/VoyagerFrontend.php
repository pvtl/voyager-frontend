<?php

namespace Pvtl\VoyagerFrontend\Facades;

use Illuminate\Support\Facades\Facade;

class VoyagerFrontend extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'voyager-frontend';
    }
}