<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
 
    // menghubungkan ke tabel jabatan
    protected $table = 'jabatan';
    
    public function pegawaiS()
    {
        return $this->hasMany(Pegawai::class);
    }
}
