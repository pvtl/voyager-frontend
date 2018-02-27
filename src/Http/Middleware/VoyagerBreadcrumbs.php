<?php

namespace Pvtl\VoyagerFrontend\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpKernel\Exception\HttpException;

class VoyagerBreadcrumbs
{
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if ($this->app->isDownForMaintenance())
        {
            throw new HttpException(503);
        }

        $httpPath = explode('/', $_SERVER['REQUEST_URI']);

        if ($httpPath[1] === '') {
            return $next($request);
        }

        $breadcrumbs = array_map(function ($key, $crumb) use ($httpPath) {
            $crumbLink = $crumb;

            if ($key > 1) {
                $crumbLink = $httpPath[$key - 1] . '/' . $crumb;
            }

            return [
                'link' => env('APP_URL') . '/' . $crumbLink,
                'text' => empty($crumb) ? 'Home' : str_replace('-', ' ', $crumb),
            ];
        }, array_keys($httpPath), $httpPath);

        Session::flash('breadcrumbs', $breadcrumbs);

        return $next($request);
    }
}
