<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use Pvtl\VoyagerPages\Page;
use Pvtl\VoyagerFrontend\Helpers\Layouts;
use Pvtl\VoyagerFrontend\Traits\Breadcrumbs;
use Illuminate\Http\Request;

class PageController extends \Pvtl\VoyagerPages\Http\Controllers\PageController
{
    use Breadcrumbs;

    protected $viewPath = 'voyager-frontend';

    /**
     * Add the layout to the returned page
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPage($slug = 'home')
    {
        $view = parent::getPage($slug);
        $page = Page::findOrFail((int)$view->page->id);

        $view->layout = $page->layout;

        return $view;
    }

    /**
     * POST B(R)EAD - Create data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return View
     */
    public function create(Request $request)
    {
        $view = parent::create($request);

        $view['layouts'] = Layouts::getLayouts('voyager-frontend');

        return $view;
    }

    /**
     * POST B(R)EAD - Read data.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return View
     */
    public function edit(Request $request, $id)
    {
        $view = parent::edit($request, $id);

        $view['layouts'] = Layouts::getLayouts('voyager-frontend');

        return $view;
    }


    /**
     * POST - Change Page Layout
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id - the page id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLayout(Request $request, $id)
    {
        $page = Page::findOrFail((int)$id);
        $page->layout = $request->layout;
        $page->save();

        return redirect()
            ->back()
            ->with([
                'message' => __('voyager::generic.successfully_updated') . " Page Layout",
                'alert-type' => 'success',
            ]);
    }
}
