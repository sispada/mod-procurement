<?php

namespace ModuleProcurement\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Module\System\Imports\BaseImport;

class ProcurementBaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $path = base_path(
            'modules' . DIRECTORY_SEPARATOR .
                'procurement' . DIRECTORY_SEPARATOR .
                'database' . DIRECTORY_SEPARATOR .
                'masters' . DIRECTORY_SEPARATOR .
                'base-seeder.xlsx'
        );

        if (File::exists($path)) {
            Excel::import(new BaseImport($this->command), $path);
        }
    }
}
