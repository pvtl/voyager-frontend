<?php

namespace Pvtl\VoyagerFrontend\Exceptions;

use Exception;
use TCG\Voyager\Models\DataType;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $pageController = '\Pvtl\VoyagerFrontend\Http\Controllers\PageController';
        $pageBlockController = '\Pvtl\VoyagerPageBlocks\Http\Controllers\PageController';

        $moduleRoutes = Cache::remember('pages/routes/excluded', 30, function () {
            $moduleRoutes = [];
            $dataTypes = DataType::all();

            foreach ($dataTypes as $dataType) {
                array_push($moduleRoutes, $dataType->slug, $dataType->slug . '/*');
            }

            return $moduleRoutes;
        });

        try {
            if (!Request::is($moduleRoutes) && !class_exists('\Pvtl\VoyagerPageBlocks\Providers\PageBlocksServiceProvider')) {
                $controller = new $pageController();

                return response()->make($controller->getPage(Request::path()));
            } elseif (!Request::is($moduleRoutes)) {
                $controller = new $pageBlockController();

                return response()->make($controller->getPage(Request::path()));
            }
        } catch (\Exception $e) {
            return response()->view('errors.404', [], 404);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }


        return parent::render($request, $exception);
    }
}
