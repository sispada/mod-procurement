<?php

namespace ModuleProcurement\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->command->call('module:migrate', ['module' => 'Procurement']);
        
        $this->call(ProcurementBaseSeeder::class);
        $this->call(ProcurementDataSeeder::class);
        $this->call(ProcurementUserSeeder::class);
    }
}
