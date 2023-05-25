<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
 
    // menghubungkan ke tabel gaji
    protected $table = 'gaji';

    public function pegawai()
    {
        return $this->hasOne(pegawai::class,'id','pegawai_id');
    }
}
