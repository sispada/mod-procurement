<?php

namespace ModuleProcurement\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Module\System\Models\SystemUser;

class ProcurementTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = SystemUser::find(6);

        dd($user->userable->workbios->pluck('workgroup_id'));
    }
}
