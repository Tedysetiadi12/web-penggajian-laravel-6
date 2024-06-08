@extends('index')
@section('content')
<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <h5 class="card-title fw-semibold mb-4 mt-4">Laporan Penggajian</h5>           
            <div class="col">
              
            </div>
          <table id="example" class="display mt-3" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama pegawai</th>
                    <th>Jabatan</th>
                    <th>Gaji pokok</th>
                    <th>Tunjangan</th>
                    <th>Total Sakit</th>
                    <th>Total Hadir</th>
                    <th>Total Gaji</th>
                    <th>Periode</th>
                    <th>tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penggajians as $no => $dt)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $dt->pegawai->nama }}</td>
                    <td>{{ $dt->jabatan->nama_jabatan }}</td>
                    <td>{{ formatRupiah($dt->jabatan->gaji_pokok) }}</td>
                    <td>{{ formatRupiah($dt->jabatan->uang_kesehatan) }}</td>
                    <td>{{ $dt->total_sakit }}</td>
                    <td>{{ $dt->total_hadir }}</td>
                    <td>{{ formatRupiah($dt->total_gaji) }}</td>
                    <td>{{ formatTanggalperiode($dt->periode) }}</td>
                    <td>{{ formatTanggal($dt->created_at) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama pegawai</th>
                  <th>Jabatan</th>
                  <th>gaji Pokok</th>
                  <th>Tunjangan</th>
                  <th>Total Sakit</th>
                  <th>Total Hadir</th>
                  <th>Total Gaji</th>
                  <th>Priode</th>
                  <th>tanggal</th>
                </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection