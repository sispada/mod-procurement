<?php

namespace Module\Procurement\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Module\Procurement\Models\ProcurementDocument;

class DocumentImport implements ToCollection, WithHeadingRow
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

            $model = new ProcurementDocument();
            $model->name = $record->name;
            $model->slug = str($record->name)->slug();
            $model->mime = $record->mime;
            $model->extension = $record->extension;
            $model->maxsize = $record->maxsize;
            $model->save();
        }

        $this->command->getOutput()->progressFinish();
    }
}
