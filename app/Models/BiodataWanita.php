<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataWanita extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'ibu',
        'bapak',
        'foto',
        'deskripsi',
        'asal'
    ];
}
