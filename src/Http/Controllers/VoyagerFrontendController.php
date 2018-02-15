<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use TCG\Voyager\Models\Page;
use TCG\Voyager\Models\Post;
use Illuminate\Routing\Controller as BaseController;

class VoyagerFrontendController extends BaseController
{
    /**
     * Registers views to be used as 'voyager-frontend'
     *
     * @return void
     */
    public function index()
    {
        return view('voyager-frontend::voyager-frontend');
    }

    /**
     * Route: Gets all posts and passes data to a view
     * 
    * @return void
     */
    public function getAllPostsRoute()
    {
        $posts = Post::all();
        return view('voyager-frontend::modules/posts/posts', compact('posts'));
    }

    /**
     * Route: Gets a single posts and passes data to a view
     * 
     * @param str $slug The page slug
     * @return void
     */
    public function getPostRoutes($slug)
    {
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        return view('voyager-frontend::modules/posts/post', compact('post'));
    }

    /**
     * Route: Gets a single page and passes data to a view
     * 
     * @param str $slug The page slug
     * @return void
     */
    public function getPageRoutes($slug = 'home')
    {
        $page = Page::where('slug', '=', $slug)->firstOrFail();
        return view('voyager-frontend::modules/pages/default', compact('page'));
    }
}