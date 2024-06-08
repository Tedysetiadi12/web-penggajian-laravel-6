<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jabatan;
use App\pegawai;
use App\penggajian;
use Carbon\Carbon;

class updateController extends Controller
{
    public function  updatejab($id, Request $request){
        $up = jabatan::find($id);
        $up->nama_jabatan = $request->nama_jabatan;
        $up->gaji_pokok = $request->gaji_pokok;
        $up->uang_kesehatan = $request->uang_kesehatan;
        $cek = $up->save();
        if ($cek) {
            return redirect('/jabatan')->with('success', 'Data jabatan berhasil diedit.');
        } else {
            return redirect('/jabatan')->with('error', 'Data jabatan gagal diedit.');
        }
        return redirect('/jabatan');
    }

    public function updatepeg(Request $request, $id){

        $pegawai = pegawai::findOrFail($id);
        $path = $pegawai->foto;

        if ($request->file('foto')) {
              $nama_file = time().'-'.$request->file('foto')->getClientOriginalName();
                // menyimpan file kedalam folder 
                $path = $request->file('foto')->storeAs('foto',$nama_file,'public');
         if ($pegawai->foto) {
                \Storage::delete('public/foto/' . $pegawai->foto);
            }
            $path = 'foto/' . $nama_file;;
        }

       $cek = $pegawai->update([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'email' => $request->email,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jabatan_id' => $request->jabatan_id,
            'foto' => $path,
        ]);
        if ($cek) {
            return redirect('/pegawai')->with('success', 'Data jabatan berhasil diedit.');
        } else {
            return redirect('/pegawai')->with('error', 'Data jabatan gagal diedti.');
        }
        return Redirect('/pegawai');
    }

    public function updategaji(Request $request, $id)
    {
        $penggajian = penggajian::findOrFail($id);
        $pegawai = pegawai::findOrFail($request->pegawai_id);
        $jabatan = $pegawai->jabatan;
        $periode = Carbon::parse($request->periode);

        $total_hadir = $request->total_hadir;
        $total_izin = $request->total_izin ?? 0;
        $total_sakit = $request->total_sakit ?? 0;
        $total_alpha = $request->total_alpha ?? 0;

        $total_days_in_month = 30;
        $total_tidak_hadir = $total_izin + $total_sakit + $total_alpha;
        $potongan_per_hari = $jabatan->gaji_pokok / $total_days_in_month;
        $total_gaji = $jabatan->gaji_pokok - ($total_tidak_hadir * $potongan_per_hari) + ($total_izin * $jabatan->uang_kesehatan);

        $penggajian->update([
            'pegawai_id' => $pegawai->id,
            'total_hadir' => $total_hadir,
            'total_izin' => $total_izin,
            'total_sakit' => $total_sakit,
            'total_alpha' => $total_alpha,
            'total_gaji' => $total_gaji,
            'periode' => $periode,
        ]);

        return redirect('/penggajian')->with('success', 'Penggajian berhasil diperbarui.');
    }
}
