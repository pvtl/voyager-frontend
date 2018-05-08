<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class VoyagerFrontendMenuDataRowsTableSeeder extends Seeder
{
    public function run()
    {
        $this->createMainMenu();
        $this->createSocialMenu();
    }

    protected function createMainMenu()
    {
        // Create a new menu
        Menu::firstOrCreate([
            'name' => 'primary',
        ]);
        $menu = Menu::where('name', 'primary')->firstOrFail();

        // Fill out that menu
        $this->createMenuItem($menu->id, 'Home', '/home', 1);
        $this->createMenuItem($menu->id, 'About', '/about', 2);
    }

    protected function createSocialMenu()
    {
        // Create a new menu
        Menu::firstOrCreate([
            'name' => 'social',
        ]);
        $menu = Menu::where('name', 'social')->firstOrFail();

        // Fill out that menu
        $this->createMenuItem(
            $menu->id,
            'Facebook',
            'https://www.facebook.com/wearepvtl',
            1,
            '_blank',
            'fa-facebook-square'
        );
        $this->createMenuItem(
            $menu->id,
            'Twitter',
            'https://twitter.com/wearepvtl',
            2,
            '_blank',
            'fa-twitter-square'
        );
        $this->createMenuItem(
            $menu->id,
            'Instagram',
            'https://www.instagram.com/wearepvtl/',
            3,
            '_blank',
            'fa-instagram'
        );
        $this->createMenuItem(
            $menu->id,
            'Google+',
            'https://plus.google.com/100970850483584616344',
            4,
            '_blank',
            'fa-google-plus-square'
        );
        $this->createMenuItem(
            $menu->id,
            'LinkedIn',
            'https://www.linkedin.com/company/pivotal-agency',
            5,
            '_blank',
            'fa-linkedin'
        );
    }


    protected function createMenuItem($menuId, $title, $url, $order, $target = '_self', $icon = '')
    {
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menuId,
            'title' => $title,
            'url' => $url,
            'route' => null,
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target' => $target,
                'icon_class' => $icon,
                'color' => null,
                'parent_id' => null,
                'order' => $order,
            ])->save();
        }

        return $menuItem;
    }
}
