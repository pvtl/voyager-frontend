<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Routing\Controller as BaseController;

class ImageResizeController extends BaseController
{

    /**
     * Returns the URL to the resized image
     * - eg. /image-resize?path=blocks/SDtjllHDuzHvNYGRkOuS1mSpHCuJ4L8DSq3Unhpm.jpeg&height=100&width=200
     *
     * @return str
     */
    public function resize()
    {
        // Inputs (available configs)
        $imagePath = $_GET['path'];
        $height = isset($_GET['height']) ? $_GET['height'] : 250;
        $width = isset($_GET['width']) ? $_GET['width'] : 250;
        $quality = isset($_GET['quality']) ? $_GET['quality'] : 100;

        $storagePath = storage_path() . '/app/public/';
        $resizedImagePath = 'resized/' . $imagePath;

        // @todo check if file exists
        if (empty($imagePath)) {
            echo '';
        }

        $resizedImage = Image::make($storagePath . $imagePath)
            ->resize($width, $height)
            ->encode('', $quality);

        Storage::disk(config('voyager.storage.disk'))
            ->put($resizedImagePath, (string)$resizedImage, 'public');

        echo '/storage/' . $resizedImagePath;
    }
}
