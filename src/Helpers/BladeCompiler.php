<?php

namespace Pvtl\VoyagerFrontend\Helpers;

use Illuminate\Support\Facades\Blade;

class BladeCompiler
{
    /**
     * Compile blade template with passing arguments.
     *
     * @param string $value HTML-code including blade
     * @param array $args Array of values used in blade
     *
     * @return string
     */
    public static function getHtmlFromString($value, array $args = array())
    {
        $generated = Blade::compileString($value);

        ob_start() and extract($args, EXTR_SKIP);

        // We'll include the view contents for parsing within a catcher
        // so we can avoid any WSOD errors. If an exception occurs we
        // will throw it out to the exception handler.
        try {
            eval('?>' . $generated);

        // If we caught an exception, we'll silently flush the output
        // buffer so that no partially rendered views get thrown out
        // to the client and confuse the user with junk.
        } catch (\Exception $e) {
            ob_get_clean();
            throw $e;
        }

        $content = ob_get_clean();

        return $content;
    }
}
