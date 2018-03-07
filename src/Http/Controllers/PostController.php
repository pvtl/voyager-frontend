<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use TCG\Voyager\Models\Page;
use TCG\Voyager\Models\Post;
use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{

    /**
     * Route: Gets all posts and passes data to a view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPosts()
    {
        $posts = Post::all();

        return view('voyager-frontend::modules/posts/posts', [
            'posts' => $posts,
        ]);
    }

    /**
     * Route: Gets a single posts and passes data to a view
     *
     * @param $slug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPost($slug)
    {
        $post = Post::where('slug', '=', $slug)->firstOrFail();

        return view('voyager-frontend::modules/posts/post', [
            'post' => $post,
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
}
