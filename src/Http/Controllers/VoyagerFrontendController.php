<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Page;
use TCG\Voyager\Models\Post;
use Illuminate\Routing\Controller as BaseController;

class VoyagerFrontendController extends BaseController
{
    protected $breadcrumbs;

    /**
     * VoyagerFrontendController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->breadcrumbs = $this->getBreadcrumbs($request);
    }

    /**
     * Registers views to be used as 'voyager-frontend'
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('voyager-frontend::voyager-frontend');
    }


    /**
     * Route: Gets all posts and passes data to a view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllPostsRoute()
    {
        $posts = Post::all();

        return view('voyager-frontend::modules/posts/posts', [
            'posts' => $posts,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }


    /**
     * Route: Gets a single posts and passes data to a view
     *
     * @param $slug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPostRoutes($slug)
    {
        $post = Post::where('slug', '=', $slug)->firstOrFail();

        return view('voyager-frontend::modules/posts/post', [
            'post' => $post,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }


    /**
     * Route: Gets a single page and passes data to a view
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPageRoutes($slug = 'home')
    {
        $page = Page::where('slug', '=', $slug)->firstOrFail();

        return view('voyager-frontend::modules/pages/default', [
            'page' => $page,
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    /**
     * Defines an array of breadcrumbs from the Request
     *
     * @param Request $request
     *
     * @return array
     */
    public function getBreadcrumbs(Request $request)
    {
        $httpPath = $request->segments();

        $breadcrumbs = array_map(function ($key, $crumb) use ($httpPath) {
            $crumbPath = join('/', array_slice($httpPath, 0, $key + 1));
            $crumbLink = env('APP_URL') . '/' . $crumbPath;

            return [
                'link' => $crumbLink,
                'text' => str_replace('-', ' ', $crumb),
            ];
        }, array_keys($httpPath), $httpPath);

        array_unshift($breadcrumbs, [
            'link' => '/',
            'text' => 'Home',
        ]);

        return $breadcrumbs;
    }
}
