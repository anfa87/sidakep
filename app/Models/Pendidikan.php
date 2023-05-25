<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

     // menghubungkan ke tabel pendidikan
     protected $table = 'pendidikan';

     protected $guarded = ['id'];

     public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
