<?php


namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportFile implements ToCollection
{

    /**
     * @inheritDoc
     */
    public function collection(Collection $collection)
    {
        return $collection;
    }
}
