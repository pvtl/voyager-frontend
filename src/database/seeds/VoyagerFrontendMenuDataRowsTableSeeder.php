<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class VoyagerFrontendMenuDataRowsTableSeeder extends Seeder
{
    public function run()
    {
        // Create a new Main Menu
        Menu::firstOrCreate([
            'name' => 'primary',
        ]);

        // Fill out that main menu
        $menu = Menu::where('name', 'primary')->firstOrFail();
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Home',
            'url'     => '/',
            'route'   => null,
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }
        
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Blog',
            'url'     => '/posts',
            'route'   => null,
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => '',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 10,
            ])->save();
        }
    }
}
