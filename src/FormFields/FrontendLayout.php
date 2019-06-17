<?php

namespace Pvtl\VoyagerFrontend\FormFields;

use TCG\Voyager\FormFields\AbstractHandler;

class FrontendLayout extends AbstractHandler
{
    protected $codename = 'frontend_layout';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('voyager-frontend::formfields.frontend_layout', [
            'row'             => $row,
            'options'         => $options,
            'dataType'        => $dataType,
            'dataTypeContent' => $dataTypeContent,
        ]);
    }
}
