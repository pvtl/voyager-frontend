<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Page;

class VoyagerFrontendPagesTableSeeder extends Seeder
{
    public function run()
    {
        // Create a Home Page
        $page = $this->findPage('home');
        if (!$page->exists) {
            $page->fill([
                'title'            => 'Home',
                'author_id'        => 0,
                'excerpt'          => 'This is the excerpt for the Lorem Ipsum Page',
                'body'             => '<p><br /></p><h3 class="text-center">This is the body of the lorem ipsum page</h3><p class="text-center">This is the body of the lorem ipsum page</p><p><br /></p>',
                'image'            => 'pages/page1.jpg',
                'slug'             => 'home',
                'meta_description' => 'This is the meta description',
                'meta_keywords'    => 'keyword1, keyword2, keyword3',
                'status'           => 'ACTIVE',
            ])->save();
        }

        // Create an About Page
        $page = $this->findPage('about');
        if (!$page->exists) {
            $page->fill([
                'title'            => 'About',
                'author_id'        => 0,
                'excerpt'          => 'This is the excerpt for the Lorem Ipsum Page',
                'body'             => '<p><br /></p><h3 class="text-center">This is the body of the lorem ipsum page</h3><p class="text-center">This is the body of the lorem ipsum page</p><p><br /></p>',
                'image'            => 'posts/post2.jpg',
                'slug'             => 'about',
                'meta_description' => 'This is the meta description for about',
                'meta_keywords'    => 'keyword1, keyword2, keyword3',
                'status'           => 'ACTIVE',
            ])->save();
        }
    }

    protected function findPage($slug)
    {
        return Page::firstOrNew(['slug' => $slug]);
    }
}
