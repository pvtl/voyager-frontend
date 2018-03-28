<?php

namespace Pvtl\VoyagerFrontend\Helpers;

class ClassEvents
{
    /**
     * Fire in the hole! Execute our custom functionality.
     *
     * @param $classString
     * @param mixed $forcedParams (eg. for form hooks, we pass through form data)
     * @return mixed
     */
    public static function executeClass($classString, $forcedParams = null)
    {
        list($className, $methodName) = explode('::', $classString);
        preg_match('/\(.*?\)/', $methodName, $parameters);

        if (count($parameters) > 0) {
            $methodName = str_replace($parameters[0], '', $methodName);
            $parameters = explode(',', str_replace(['(', ')'], '', $parameters[0]));
        }

        $class = new $className();

        return $class->$methodName($forcedParams, ...$parameters);
    }
}
