<?php

namespace App\Imports;

use App\Models\PasienDirawatNonKomorbid;
use Maatwebsite\Excel\Concerns\ToModel;

class PasienDirawatNonKomorbidImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PasienDirawatNonKomorbid([
            //
        ]);
    }
}
