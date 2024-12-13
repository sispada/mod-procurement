<?php

namespace Module\Procurement\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Module\Procurement\Models\ProcurementWorkunit;

class WorkunitImport implements ToCollection, WithHeadingRow
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
        $this->command->info('workunit_table');
        $this->command->getOutput()->progressStart(count($rows));

        foreach ($rows as $row) {
            $this->command->getOutput()->progressAdvance();

            $record = (object) $row->toArray();

            /** CREATE NEW RECORD */
            $model = new ProcurementWorkunit();
            $model->name = $record->name;
            $model->slug = sha1(str($record->name)->slug());
            $model->save();
        }

        $this->command->getOutput()->progressFinish();
    }
}
