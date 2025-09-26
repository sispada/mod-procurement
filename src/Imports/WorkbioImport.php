<?php

namespace Module\Procurement\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Module\Procurement\Models\ProcurementBiodata;
use Module\Procurement\Models\ProcurementWorkbio;

class WorkbioImport implements ToCollection, WithHeadingRow
{
    /**
     * The construct function
     *
     * @param [type] $command
     * @param string $mode
     */
    public function __construct(protected $command)
    {
    }

    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        $this->command->info('_table');
        $this->command->getOutput()->progressStart(count($rows));

        foreach ($rows as $row) {
            $this->command->getOutput()->progressAdvance();

            /** CREATE NEW RECORD */
            $record  = (object) $row->toArray();
            $slug    = trim(str_replace(' ', '', $record->biodata_id));
            $biodata = ProcurementBiodata::firstWhere('slug', $slug);

            $model = new ProcurementWorkbio();
            $model->name = $biodata->name;
            $model->workgroup_id = $record->workgroup_id;
            $model->biodata_id = $biodata->id;
            $model->save();
        }

        $this->command->getOutput()->progressFinish();
    }
}
