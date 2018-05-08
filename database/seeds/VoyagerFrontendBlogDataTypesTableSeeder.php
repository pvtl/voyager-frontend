<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class VoyagerFrontendBlogDataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'blog_posts');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'blog_posts',
                'display_name_singular' => 'Blog Post',
                'display_name_plural'   => 'Blog Posts',
                'icon'                  => 'voyager-news',
                'model_name'            => 'Pvtl\\VoyagerFrontend\\BlogPost',
                'controller'            => '\\Pvtl\\VoyagerFrontend\\Http\\Controllers\\PostController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        if ($dataType->exists) {
            $dataType->update([
                'model_name' => 'Pvtl\\VoyagerFrontend\\BlogPost',
                'controller' => '\\Pvtl\\VoyagerFrontend\\Http\\Controllers\\PostController',
            ]);
        }
    }

    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
