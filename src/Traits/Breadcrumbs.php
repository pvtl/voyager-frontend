<?php

namespace Pvtl\VoyagerFrontend\Traits;

use Illuminate\Http\Request;
use TCG\Voyager\Models\MenuItem;

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

        $breadcrumbs = array_map(function ($key, $crumb) use ($httpPath) {
            $crumbPath = join('/', array_slice($httpPath, 0, $key + 1));
            $crumbLink = '/' . $crumbPath;

            if ($crumbText = MenuItem::where('url', $crumbLink)->first()) {
                return [
                    'link' => $crumbLink,
                    'text' => $crumbText->title,
                ];
            }

            return [
                'link' => $crumbLink,
                'text' => str_replace('-', ' ', $crumb),
            ];
        }, array_keys($httpPath), $httpPath);

        if ($menuItem = MenuItem::where('url', '/' . $request->path())->first()) {
            $crumbs[] = [
                'link' => $menuItem->url,
                'text' => $menuItem->title,
            ];

            $breadcrumbs = Breadcrumbs::getNavigationalBreadcrumbs($menuItem->parent_id, $crumbs);
        }

        array_unshift($breadcrumbs, [
            'link' => '/',
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
        if ($menuItem = MenuItem::where('id', $parentId)->first()) {
            array_unshift($crumbs, [
                'link' => $menuItem->url,
                'text' => $menuItem->title,
            ]);

            if (!is_null($menuItem->parent_id)) {
                $crumbs = Breadcrumbs::getNavigationalBreadcrumbs($menuItem->parent_id, $crumbs);
            }
        }

        return $crumbs;
    }
}
