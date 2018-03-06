<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use TCG\Voyager\Models\Page;
use TCG\Voyager\Models\Post;
use Pvtl\VoyagerFrontend\Traits\Breadcrumbs;
use Illuminate\Routing\Controller as BaseController;

class VoyagerFrontendController extends BaseController
{
    use Breadcrumbs;

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
        ]);
    }

    /**
     * Gets recent posts and passes data to a view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recentBlogPosts($numPosts = 3)
    {
        $posts = Post::limit($numPosts)->orderBy('created_at', 'desc')->get();

        return view('voyager-frontend::modules/posts/recent-posts', [
            'recentPosts' => $posts,
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
        ]);
    }
}
