<?php

namespace Pvtl\VoyagerFrontend\Helpers;

class ClassEvents
{
    /**
     * Fire in the hole! Execute our form hook.
     *
     * @param $classString
     * @return mixed
     */
    public static function executeClass($classString)
    {
        list($className, $methodName) = explode('::', $classString);
        preg_match('/\(.*?\)/', $methodName, $parameters);

        if (count($parameters) > 0) {
            $methodName = str_replace($parameters[0], '', $methodName);
            $parameters = explode(',', str_replace(['(', ')'], '', $parameters[0]));
        }

        $class = new $className();

        return $class->$methodName(...$parameters);
    }
}
