<?php

use Illuminate\Database\Seeder;

class VoyagerFrontendDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('VoyagerFrontendPagesDataRowsTableSeeder');
        $this->call('VoyagerFrontendMenuDataRowsTableSeeder');
    }
}
