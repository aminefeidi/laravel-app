<?php

namespace App\Imports;

use App\Models\Programme;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class ProgrammeImport implements ToModel, WithChunkReading, WithBatchInserts, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $programme = new Programme();
        $depDate = $this->transformDate($row[13]);
        $programme->dep_sched_dt = $depDate;
        $arrDate = $this->transformDate($row[17]);
        $programme->arr_sched_dt = $arrDate;
        $programme->fn_carrier = $row[0];
        $programme->fn_number = $row[1];
        $programme->fn_suffix = $row[2];
        $programme->day_of_origin = $row[3];
        $programme->ac_owner = $row[4];
        $programme->ac_subtype = $row[5];
        $programme->ac_logical_no = $row[6];
        $programme->ac_version = $row[7];
        $programme->ac_registration = $row[8];
        $programme->dep_ap_actual = $row[9];
        $programme->dep_ap_sched = $row[10];
        $programme->next_info_dt = $row[11];
        $programme->dep_dt_est = $row[12];
        $programme->arr_ap_actual = $row[14];
        $programme->arr_ap_sched = $row[15];
        $programme->arr_dt_est = $row[16];
        $programme->slot_time_actual = $row[18];
        $programme->leg_state = $row[19];
        $programme->leg_type = $row[20];
        $programme->employer_cockpit = $row[21];
        $programme->employer_cabin = $row[22];
        $programme->flight_hours = $row[23];
        $programme->flight_minutes = $row[24];
        $programme->cycles = $row[25];
        $programme->delay_code_01 = $row[26];
        $programme->delay_code_02 = $row[27];
        $programme->delay_code_03 = $row[28];
        $programme->delay_code_04 = $row[29];
        $programme->delay_time_01 = $row[30];
        $programme->delay_time_02 = $row[31];
        $programme->delay_time_03 = $row[32];
        $programme->delay_time_04 = $row[33];
        $programme->subdelay_code_01 = $row[34];
        $programme->subdelay_code_02 = $row[35];
        $programme->subdelay_code_03 = $row[36];
        $programme->subdelay_code_04 = $row[37];
        $programme->pax_booked_f = $row[38];
        $programme->pax_booked_c = $row[39];
        $programme->pax_booked_y = $row[40];
        $programme->pax_booked_trs_f = $row[41];
        $programme->pax_booked_trs_c = $row[42];
        $programme->pax_booked_trs_y = $row[43];
        $programme->pad_booked_f = $row[44];
        $programme->pad_booked_c = $row[45];
        $programme->pad_booked_y = $row[46];
        $programme->pad_booked_trs_f = $row[47];
        $programme->pad_booked_trs_c = $row[48];
        $programme->pad_booked_trs_y = $row[49];
        $programme->pax_flown_male = $row[50];
        $programme->pax_flown_female = $row[51];
        $programme->pax_flown_adult = $row[52];
        $programme->pax_flown_children = $row[53];
        $programme->pax_infant = $row[54];
        $programme->pax_flown_f = $row[55];
        $programme->pax_flown_c = $row[56];
        $programme->pax_flown_y = $row[57];
        return $programme;
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    private function transformDate($value, $format = 'd/m/y g:i a')
    {
        try {
            return Carbon::instance(Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return Carbon::createFromFormat($format, $value);
        }
    }
}
