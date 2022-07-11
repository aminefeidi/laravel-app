<?php

namespace App\Exports;

use App\Models\Demande;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DemandesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Demande::all();
    }

    public function headings(): array
    {
        return ['id', 'Type', 'Date debut', 'Date fin', 'Commentaires', 'Matricule', 'crée à', 'modifié à'];
    }
}
