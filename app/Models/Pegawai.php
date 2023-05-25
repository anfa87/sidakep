<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // menghubungkan ke tabel pegawai
    protected $table = 'pegawai';

    protected $guarded= ['id'];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function pendidikanS()
    {
        return $this->hasMany(Pendidikan::class);
    }

    public function user()
    {
        return $this->hasOne(User::class,'pegawai_id','id');
    }

    public function gaji()
    {
        return $this->hasMany(Gaji::class,'pegawai_id','id');
    }
}
