<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    protected $fillable = ['nama_jabatan', 'gaji_pokok', 'uang_kesehatan'];
    
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
