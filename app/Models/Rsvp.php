<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasEncryptedRouteKey;

class Rsvp extends Model
{
    use HasFactory, HasEncryptedRouteKey;

    protected $fillable = [
        'nama_tamu',
        'jumlah',
        'kehadiran'
    ];
}
