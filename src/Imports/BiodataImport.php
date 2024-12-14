<?php

namespace Module\Procurement\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Module\Procurement\Models\ProcurementBiodata;

class BiodataImport implements ToCollection, WithHeadingRow
{
    /**
     * The construct function
     *
     * @param [type] $command
     * @param string $mode
     */
    public function __construct(protected $command) {}

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $this->command->info('biodata_table');
        $this->command->getOutput()->progressStart(count($rows));

        foreach ($rows as $row) {
            $this->command->getOutput()->progressAdvance();

            $record = (object) $row->toArray();
            $slug   = trim(str_replace(' ', '', $record->slug));

            /** CREATE NEW RECORD */
            $model = new ProcurementBiodata();
            $model->name = $record->name;
            $model->slug = strlen($slug) < 18 ? null : $slug;
            $model->section = $record->section;
            $model->position = $record->position;
            $model->role = $record->role;
            $model->workgroup_id = $record->workgroup_id;
            $model->workunit_id = 39;
            $model->save();
        }

        $this->command->getOutput()->progressFinish();
    }
}
