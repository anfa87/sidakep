<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
 
    // menghubungkan ke tabel kegiatan
    protected $table = 'kegiatan';

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id','id');
    }
}
