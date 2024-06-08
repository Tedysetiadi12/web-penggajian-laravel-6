<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jabatan;
use App\pegawai;
use App\penggajian;

class deleteController extends Controller
{
    public function delJabatan($id){
        $mv = jabatan::find($id);
       $cek = $mv->delete();

        if ($cek) {
            return redirect('/jabatan')->with('success', 'Data jabatan berhasil dihapus.');
        } else {
            return redirect('/jabatan')->with('error', 'Data jabatan gagal dihapus.');
        }
        return redirect('/jabatan');
    }
    public function deletepegawai($id){
        $pegawai = pegawai::findOrFail($id);
        if ($pegawai->foto) {
            \Storage::delete('public/foto/' . $pegawai->foto);
        }
       $cek = $pegawai->delete();

        if ($cek) {
            return redirect('/pegawai')->with('success', 'Data jabatan berhasil dihapus.');
        } else {
            return redirect('/pegawai')->with('error', 'Data jabatan gagal dihapus.');
        }
        return Redirect('/pegawai');
    }

    public function deletepenggajian($id){
        $penggajian = penggajian::findOrFail($id);
        
        $cek = $penggajian->delete();

        if ($cek) {
            return redirect('/penggajian')->with('success', 'Data jabatan berhasil dihapus.');
        } else {
            return redirect('/penggajian')->with('error', 'Data jabatan gagal dihapus.');
        }
        return Redirect('/penggajian');

    }

}
