<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use Pvtl\VoyagerFrontend\Page;
use Pvtl\VoyagerFrontend\Traits\Breadcrumbs;
use Illuminate\Routing\Controller as BaseController;

class PageController extends BaseController
{
    use Breadcrumbs;

    /**
     * Route: Gets a single page and passes data to a view
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPage($slug = 'home')
    {
        if ($slug === '/') {
            $slug = 'home';
        }

        $page = Page::where('slug', '=', $slug)->firstOrFail();

        return view('voyager-frontend::modules/pages/default', [
            'page' => $page,
        ]);
    }
}
