<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Page;

class VoyagerFrontendPagesDataRowsTableSeeder extends Seeder
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
                'body'             => '<p>This is the body of the lorem ipsum page</p>',
                'image'            => 'pages/page1.jpg',
                'slug'             => 'home',
                'meta_description' => 'This is the meta description',
                'meta_keywords'    => 'keyword1, keyword2, keyword3',
                'status'           => 'ACTIVE',
                'template'         => 'home',
            ])->save();
        }
    }

    protected function findPage($slug)
    {
        return Page::firstOrNew(['slug' => $slug]);
    }
}
