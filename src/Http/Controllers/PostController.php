<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use Pvtl\VoyagerFrontend\BlogPost;
use Illuminate\Support\Carbon;

class PostController extends \Pvtl\VoyagerBlog\Http\Controllers\PostController
{
    protected $viewPath = 'voyager-frontend';

    /**
     * Recent posts widget
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recentBlogPosts($numPosts = 4)
    {
        $posts = BlogPost::where([
            ['status', '=', 'PUBLISHED'],
        ])->whereDate('published_date', '<=', Carbon::now())
            ->limit($numPosts)
            ->orderBy('created_at', 'desc')
            ->get();

        return view("{$this->viewPath}::modules/posts/posts-grid", [
            'posts' => $posts,
        ]);
    }

    /**
     * Featured posts widget
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function featuredBlogPosts($numPosts = 4)
    {
        $posts = BlogPost::where([
            ['featured', '=', '1'],
            ['status', '=', 'PUBLISHED'],
        ])->whereDate('published_date', '<=', Carbon::now())
            ->limit($numPosts)
            ->orderBy('created_at', 'desc')
            ->get();

        return view("{$this->viewPath}::modules/posts/posts-grid", [
            'posts' => $posts,
        ]);
    }
}
