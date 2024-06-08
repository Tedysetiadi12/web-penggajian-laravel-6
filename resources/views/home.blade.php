
@extends('index');
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="panel-header">
                                                <p>Jumlah Karyawan</p>
                                                <h5>{{ $jumlah_karyawan }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="panel-icon">
                                                <img src="assets/images//logos/team.png" alt="karyawan" height="48">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="panel-header">
                                                <p>Kariawan di gaji</p>
                                                <h5>{{ $jumlah_karyawan_digaji }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="panel-icon">
                                                <img src="assets/images/logos/total_order.png" alt="order" height="48">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-panel">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="panel-header">
                                                <p>Jumlah gaji keluar</p>
                                                <h5>{{ formatRupiah($total_semuagaji) }} </h5>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="panel-icon">
                                                <img src="assets/images//logos/orang.png" alt="paket" height="48">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah penggajian
                  </button>
                <table id="example" class="display mt-3" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama pegawai</th>
                            <th>Jabatan</th>
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
      <!-- Modal tambah-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Forms Tambah Pegawai</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                  <form action="/createpenggajian" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <label for="disabledSelect" class="form-label">Nama Pegawai</label>
                          <select id="disabledSelect" class="form-select" name="pegawai_id" required>
                            <option value="0">nama pegawai</option>
                            @foreach ($data as $j)
                            <option value="{{ $j->id }}">{{ $j->nama }}</option>
                            @endforeach
                          </select>  
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Priode Gaji</label>
                        <input type="month" name="periode" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">  
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Total Hadir</label>
                          <input type="number" name="total_hadir" class="form-control" id="exampleInputPassword1" required>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Total Izin</label>
                          <input type="number" name="total_izin" class="form-control" id="exampleInputPassword1" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">  
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Tolal Sakit </label>
                          <input type="number" name="total_sakit" class="form-control" id="exampleInputPassword1" >
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="mb-3">
                          <label for="disabledSelect" class="form-label">Tolat Alpa</label>
                          <input type="number" name="total_alpha" class="form-control" id="exampleInputPassword1" >
                        </div>
                      </div>
                    </div>  
              </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection