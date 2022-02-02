<?php

namespace App\Imports;

use App\Agency;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class AgenciesImport implements ToModel
{
    public function model(array $row)
    {
        return new Agency([
            'name'     => $row[0],
            'email'    => $row[1],
            'password' => Hash::make($row[2])
        ]);
    }
}
