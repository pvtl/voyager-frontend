<?php

namespace Pvtl\VoyagerFrontend\Traits;

use Illuminate\Http\Request;
use TCG\Voyager\Models\MenuItem;
use Illuminate\Support\Facades\Cache;

trait Breadcrumbs
{
    /**
     * Defines an array of breadcrumbs
     *
     * @param Request $request
     * @return array
     */
    public static function getBreadcrumbs(Request $request)
    {
        $httpPath = $request->segments();
        $menuItems = self::getMenuItems('url');

        $breadcrumbs = array_map(function ($key, $crumb) use ($httpPath, $menuItems) {
            $crumbPath = join('/', array_slice($httpPath, 0, $key + 1));
            $crumbLink = '/' . $crumbPath;

            if (in_array($crumbLink, $menuItems)) {
                return [
                    'link' => $crumbLink,
                    'text' => $menuItems[$crumbLink]->title,
                ];
            }

            return [
                'link' => $crumbLink,
                'text' => str_replace('-', ' ', $crumb),
            ];
        }, array_keys($httpPath), $httpPath);

        $path = '/' . $request->path();
        if (in_array($path, $menuItems)) {
            $crumbs[] = [
                'link' => $menuItems[$path]->url,
                'text' => $menuItems[$path]->title,
            ];

            $breadcrumbs = Breadcrumbs::getNavigationalBreadcrumbs($menuItems[$path]->parent_id, $crumbs);
        }

        array_unshift($breadcrumbs, [
            'link' => env('APP_URL'),
            'text' => 'Home',
        ]);

        return $breadcrumbs;
    }

    /**
     * Recursively build crumbs from menu items
     *
     * @param $parentId
     * @param array $crumbs
     * @return array
     */
    public static function getNavigationalBreadcrumbs($parentId, $crumbs = [])
    {
        $menuItems = self::getMenuItems('id');

        if (in_array($parentId, $menuItems)) {
            array_unshift($crumbs, [
                'link' => $menuItems[$parentId]->url,
                'text' => $menuItems[$parentId]->title,
            ]);

            if (!is_null($menuItems[$parentId]->parent_id)) {
                $crumbs = Breadcrumbs::getNavigationalBreadcrumbs($menuItems[$parentId]->parent_id, $crumbs);
            }
        }

        return $crumbs;
    }

    /**
     * Build an indexed list of MenuItem(s) by $key
     *
     * @param $key
     * @return array
     */
    public static function getMenuItems($key)
    {
        $menuItems = [];

        $storedMenuItems = Cache::remember('', 10, function () {
            return MenuItem::all();
        });

        foreach ($storedMenuItems as $menuItem) {
            $menuItems[$menuItem->{$key}] = $menuItem;
        }

        return $menuItems;
    }
}
