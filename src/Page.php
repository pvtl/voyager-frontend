<?php

namespace Pvtl\VoyagerFrontend;

use Laravel\Scout\Searchable;
use Pvtl\VoyagerPageBlocks\Http\Controllers\PageController;

class Page extends \TCG\Voyager\Models\Page
{
    use Searchable;

    public $asYouType = false;

    /**
     * Get the indexed data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        if (!class_exists('\Pvtl\VoyagerPageBlocks\Page')) {
            return $array;
        }

        // Include page block data to be "Searchable"
        $pageBlockPageController = new PageController();
        $pageBlockPageModel = new \Pvtl\VoyagerPageBlocks\Page();
        $pageBlocks = $pageBlockPageModel->blocks()->get()->map(function ($block) use ($pageBlockPageController) {
            // If it's an included file, return the HTML of this block to be searched
            if ($block->type === 'include') {
                return $pageBlockPageController->prepareIncludeBlockTypes($block);
            }

            return json_encode($block->data);
        });

        $array['page_blocks'] = implode(' ', $pageBlocks->toArray());

    }
}
