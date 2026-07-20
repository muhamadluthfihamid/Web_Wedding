<?php

namespace App\Models;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Info extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'nama_pengantin_istri',
        'nama_pengantin_pria',
        'tanggal_pernikahan',
        'mulai_akad',
        'selesai_akad',
        'mulai_resepsi',
        'alamat',
        'deskripsi',
        'latitude',
        'longtitude'
    ];
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'info_id');
    }

}