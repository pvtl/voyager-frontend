<?php

namespace Pvtl\VoyagerFrontend;

use Laravel\Scout\Searchable;

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
        $pageBlockPageModel = new \Pvtl\VoyagerPageBlocks\Page();
        $pageBlocks = $pageBlockPageModel->blocks()->get(['data'])->map(function ($block) {
            return json_encode($block['data']);
        });

        $array['page_blocks'] = implode(' ', $pageBlocks->toArray());

    }
}
