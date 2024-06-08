<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    protected $table = 'pegawai';

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'alamat',
        'nohp',
        'email',
        'tanggal_masuk',
        'jabatan_id',
        'foto'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
