<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasEncryptedRouteKey;

class BiodataWanita extends Model
{
    use HasFactory, HasEncryptedRouteKey;
    protected $fillable = [
        'user_id',
        'nama',
        'ibu',
        'bapak',
        'foto',
        'deskripsi',
        'asal'
    ];
}
