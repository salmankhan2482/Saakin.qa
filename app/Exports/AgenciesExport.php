<?php

namespace App\Exports;

use App\Agency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class AgenciesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Agency::all();
    }
//    public function headings(): array
//    {
//        $columns = [
//            'id',
//            'access_code',
//            'group_code',
//            'go_agency_id',
//            'name',
//            'image',
//            'phone',
//            'email',
//            'head_office',
//            'agency_detail',
//            'status',
//        ];
//        return $columns;
//    }
}
