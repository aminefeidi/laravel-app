<?php

namespace App\Imports;

use App\Models\Programme;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ProgrammeImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Programme([
            'tlc' => $row['tlc'],
            'ac_type_code' => $row['ac_type_code'],
            'airline' => $row['airline'],
            'flight_no' => $row['flight_no'],
            'departure_date' => $row['departure_date'],
            'arrival_date' => $row['arrival_date'],
            'airport_c_is_dep' => $row['airport_c_is_dep'],
            'airport_c_is_dest' => $row['airport_c_is_dest'],
            'code' => $row['code'],
            'type' => $row['type'],
        ]);
    }
}
