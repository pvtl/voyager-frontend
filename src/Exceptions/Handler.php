<?php

namespace Pvtl\VoyagerFrontend\Exceptions;

use Exception;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * This is our Catch-All Route for Pages
     * - When Laravel 404s, check if there's a page that exist and return that,
     * - otherwise continue rendering the exception as normal
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // We only want to look at 404s
        if ($e instanceof NotFoundHttpException) {
            // Use Page Blocks if it exists - otherwise use standard pages
            if (class_exists('\Pvtl\VoyagerPageBlocks\Providers\PageBlocksServiceProvider')) {
                $controller = new \Pvtl\VoyagerPageBlocks\Http\Controllers\PageController();
            } else {
                $controller = new \Pvtl\VoyagerFrontend\Http\Controllers\PageController();
            }

            // Return the Page view
            return response()->make($controller->getPage(Request::path()));
        }

        // Otherwise, render the default exception
        return parent::render($request, $e);
    }
}
