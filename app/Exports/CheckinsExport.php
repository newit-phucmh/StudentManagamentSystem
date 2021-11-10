<?php

namespace App\Exports;

use App\Models\CheckinInfor;
use Maatwebsite\Excel\Concerns\FromCollection;

class CheckinsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CheckinInfor::all();
    }
}
