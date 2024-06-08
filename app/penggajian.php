<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penggajian extends Model
{
    protected $table = 'penggajian';

    protected $fillable = [
        'pegawai_id', 'jabatan_id', 'total_hadir', 'total_izin', 'total_sakit', 'total_alpha', 'total_gaji', 'periode',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
