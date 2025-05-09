<?php

namespace Module\Procurement\Imports;

use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DataImport implements WithMultipleSheets, WithChunkReading
{
    /**
     * the module has role table
     */
    protected $command;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $sheets;

    /**
     * Undocumented function
     *
     * @param [type] $command
     * @param string $mode
     */
    public function __construct($command, array $sheets = [])
    {
        $this->command = $command;
        $this->sheets = $sheets;
    }

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function chunkSize(): int
    {
        return 5000;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function sheets(): array
    {
        if ($this->sheets && count($this->sheets) > 0) {
            return $this->sheets;
        }

        return [
            'workunits' => new WorkunitImport($this->command),
            'workgroups' => new WorkgroupImport($this->command),
            'biodatas' => new BiodataImport($this->command),
        ];
    }
}
