<?php

use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use Illuminate\Database\Seeder;

class VoyagerFrontendPagesDataRowsTableSeeder extends Seeder
{
    public function run()
    {
        $pageDataType = DataType::where('slug', 'pages')->firstOrFail();

        $dataRow = $this->dataRow($pageDataType, 'layout');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'frontend_layout',
                'display_name' => 'Layout',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 12,
            ])->save();
        }
    }

    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
    }
}
