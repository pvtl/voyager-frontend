<?php

namespace Pvtl\VoyagerFrontend\Helpers;

class Layouts
{
    /**
     * Scans project directories to retrieve a list of layouts
     * @param string $module
     * @return array
     */
    public static function getLayouts($module, $directory = 'layouts')
    {
        $layouts = array();

        // Get list of layouts from module
        $vendorLayoutsDir = base_path("vendor/pvtl/$module/resources/views/$directory");
        if (is_dir($vendorLayoutsDir)) {
            $layouts = scandir($vendorLayoutsDir);
        }

        // Get list of layouts from project
        $projectLayoutsDir = resource_path("views/vendor/$module/$directory");
        if (is_dir($projectLayoutsDir)) {
            $layouts = array_merge($layouts, scandir($projectLayoutsDir));
        }

        foreach ($layouts as $i => $layout) {
            // Only include files that are .blade.php files
            if (strpos($layout, '.blade.php') === false) {
                unset($layouts[$i]);
                continue;
            }

            // Strip out .blade.php for DB reference
            $layouts[$i] = str_replace('.blade.php', '', $layout);
        }

        // Remove duplicates
        $layouts = array_unique($layouts);

        // Reset indexes
        $layouts = array_values($layouts);

        // Reset indexes and return
        return $layouts;
    }
}
