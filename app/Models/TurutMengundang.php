<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TurutMengundang extends Model
{
    use HasFactory;

    protected $table = 'turut_mengundangs';

    protected $fillable = [
        'user_id',
        'nama',
        'hubungan',
        'urutan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
