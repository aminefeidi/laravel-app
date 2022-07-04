<?php

namespace Database\Seeders;

use App\Imports\ProgrammeImport;
use App\Models\Programme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class ProgrammeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new ProgrammeImport, public_path() . "/csv/Programme.csv");
    }
}
