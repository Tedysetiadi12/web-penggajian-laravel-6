<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pegawai;
use App\Penggajian;

class mainController extends Controller
{
 public function home(){
    $jumlah_karyawan = pegawai::count();

    $jumlah_karyawan_digaji = penggajian::distinct('pegawai_id')->count('pegawai_id');
    $data = pegawai::all();
    $penggajians = Penggajian::with(['pegawai', 'jabatan'])->get();
    $total_semuagaji = Penggajian::sum('total_gaji');

    return view('home',['jumlah_karyawan'=>$jumlah_karyawan,'jumlah_karyawan_digaji'=>$jumlah_karyawan_digaji,'data' => $data, 'penggajians' => $penggajians,'total_semuagaji'=>$total_semuagaji]);
 }
 public function laporangaji(){
    $jumlah_karyawan = pegawai::count();

    $jumlah_karyawan_digaji = penggajian::distinct('pegawai_id')->count('pegawai_id');
    $data = pegawai::all();
    $penggajians = Penggajian::with(['pegawai', 'jabatan'])->get();
    $total_semuagaji = Penggajian::sum('total_gaji');

    return view('laporangaji',['jumlah_karyawan'=>$jumlah_karyawan,'jumlah_karyawan_digaji'=>$jumlah_karyawan_digaji,'data' => $data, 'penggajians' => $penggajians,'total_semuagaji'=>$total_semuagaji]);
 }
}
