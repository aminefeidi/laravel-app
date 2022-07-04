<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tlc',
        'ac_type_code',
        'airline',
        'flight_no',
        'departure_date',
        'arrival_date',
        'airport_c_is_dep',
        'airport_c_is_dest',
        'code',
        'type',
    ];
}
