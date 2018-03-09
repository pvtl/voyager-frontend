<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use Pvtl\VoyagerFrontend\Post;
use Illuminate\Support\Carbon;
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
        // Get featured post
        $featuredPost = Post::where([
                ['status', '=', 'PUBLISHED'],
                ['featured', '=', '1'],
            ])->whereDate('published_date', '<=', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->first();
        $featuredPostId = $featuredPost ? $featuredPost->id : 0;

        // Get all posts
        $posts = Post::where([
                ['status', '=', 'PUBLISHED'],
                ['id', '!=', $featuredPostId],
            ])->whereDate('published_date', '<=', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('voyager-frontend::modules/posts/posts', [
            'featuredPost' => $featuredPost,
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
        // The post
        $post = Post::where([
                ['slug', '=', $slug],
                ['status', '=', 'PUBLISHED'],
            ])->whereDate('published_date', '<=', Carbon::now())
            ->firstOrFail();

        // Related posts (based on tags)
        $relatedPosts = array();
        if (!empty(trim($post->tags))) {
            $tags = explode(',', $post->tags);
            $relatedPosts = Post::where([
                    ['id', '!=', $post->id],
                ])->where(function ($query) use ($tags) {
                    foreach ($tags as $tag) {
                        $query->orWhere('tags', 'LIKE', '%'.trim($tag).'%');
                    }
                })->limit(4)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('voyager-frontend::modules/posts/post', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    /**
     * Recent posts widget
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recentBlogPosts($numPosts = 4)
    {
        $posts = Post::where([
                ['status', '=', 'PUBLISHED'],
            ])->whereDate('published_date', '<=', Carbon::now())
            ->limit($numPosts)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('voyager-frontend::modules/posts/posts-grid', [
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
        $posts = Post::where([
            ['featured', '=', '1'],
            ['status', '=', 'PUBLISHED'],
            ])->whereDate('published_date', '<=', Carbon::now())
            ->limit($numPosts)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('voyager-frontend::modules/posts/posts-grid', [
            'posts' => $posts,
        ]);
    }
}
