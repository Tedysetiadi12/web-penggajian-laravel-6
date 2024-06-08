<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jabatan;
use App\pegawai;
use App\penggajian;
use Carbon\Carbon;

class createController extends Controller
{
    public function createJabatan(Request $request){
        $createJabtan = $request->validate([
            'nama_jabatan'=>'required',
            'gaji_pokok'=>'required',
            'uang_kesehatan'=>'required'
        ]);

        $cek = Jabatan::create([
            'nama_jabatan' => $createJabtan['nama_jabatan'],
            'gaji_pokok' => $createJabtan['gaji_pokok'],
            'uang_kesehatan' => $createJabtan['uang_kesehatan']
        ]);

        if ($cek) {
            return redirect('/jabatan')->with('success', 'Data jabatan berhasil ditambahkan.');
        } else {
            return redirect('/jabatan')->with('error', 'Data jabatan gagal ditambahkan.');
        }
        return redirect('/jabatan');
    }
    

    public function tambahpegawai(Request $request){
        
        $nama_file = time().'-'.$request->file('foto')->getClientOriginalName();
        // menyimpan file kedalam folder 
        $path = $request->file('foto')->storeAs('foto',$nama_file,'public');
        $cek = pegawai::create([
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
            return redirect('/pegawai')->with('success', 'Data jabatan berhasil ditambahkan.');
        } else {
            return redirect('/pegawai')->with('error', 'Data jabatan gagal ditambahkan.');
        }

       return redirect('/pegawai');

    }

    public function tambahgaji(Request $request){
        $pegawai = pegawai::findOrFail($request->pegawai_id);
        $jabatan = $pegawai->jabatan;
        $periode = Carbon::parse($request->periode);

        $total_hadir = $request->total_hadir;
        $total_izin = $request->total_izin ?? 0;
        $total_sakit = $request->total_sakit ?? 0;
        $total_alpha = $request->total_alpha ?? 0;

      $total_days_in_month = 30;

      // Total days not attended
      $total_tidak_hadir = $total_izin + $total_sakit + $total_alpha;

      // Calculate daily deduction
      $potongan_per_hari = $jabatan->gaji_pokok / $total_days_in_month;

      // Calculate total salary
      $total_gaji = $jabatan->gaji_pokok - ($total_tidak_hadir * $potongan_per_hari) + ($total_izin * $jabatan->uang_kesehatan);

        penggajian::create([
            'pegawai_id' => $pegawai->id,
            'jabatan_id' => $jabatan->id,
            'total_hadir' => $total_hadir,
            'total_izin' => $total_izin,
            'total_sakit' => $total_sakit,
            'total_alpha' => $total_alpha,
            'total_gaji' => $total_gaji,
            'periode' => $periode,
        ]);

        return redirect('/penggajian')->with('success', 'Penggajian berhasil ditambahkan.');
    }

}
