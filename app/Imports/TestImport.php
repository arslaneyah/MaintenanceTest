<?php

namespace App\Imports;
use App\Kilometrage;
use App\Gasoil;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TestImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }
}
