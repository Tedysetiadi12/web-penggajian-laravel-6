@extends('index');
@section('content')
<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <h5 class="card-title fw-semibold mb-4 mt-4">Data penggajian</h5>           
            <div class="col">
                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Tambah penggajian
                </button>
                @if(session('success'))
                  <template id="my-template">
                    <swal-title>
                      <p>
                    {{ session('success') }}
                    </p>
                    </swal-title>
                    <swal-icon type="success" color="green"></swal-icon>
                    </template>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
                @endif
            </div>
          <table id="example" class="display mt-3" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama pegawai</th>
                    <th>Jabatan</th>
                    <th>Total Hadir</th>
                    <th>Total Izin</th>
                    <th>Total Sakit</th>
                    <th>Total Alpha</th>
                    <th>Total Gaji</th>
                    <th>Periode</th>
                    <th>tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penggajians as $no => $dt)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $dt->pegawai->nama }}</td>
                    <td>{{ $dt->jabatan->nama_jabatan }}</td>
                    <td>{{ $dt->total_hadir }}</td>
                    <td>{{ $dt->total_izin }}</td>
                    <td>{{ $dt->total_sakit }}</td>
                    <td>{{ $dt->total_alpha }}</td>
                    <td>{{ formatRupiah($dt->total_gaji) }}</td>
                    <td>{{ formatTanggalperiode($dt->periode) }}</td>
                    <td>{{ formatTanggal($dt->created_at) }}</td>
                    <td>
                        <i data-bs-toggle="modal" data-bs-target="#modaledit{{ $dt->id }}" class="ti ti-edit" style="color:#00b3ff;font-size:1.6rem;"></i>
                        <i data-bs-toggle="modal" data-bs-target="#modaldelete{{ $dt->id }}" class="ti ti-trash" style="color:#ff0000;font-size:1.6rem;"></i>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama pegawai</th>
                  <th>Jabatan</th>
                  <th>Total Hadir</th>
                  <th>Total Izin</th>
                  <th>Total Sakit</th>
                  <th>Total Alpha</th>
                  <th>Total Gaji</th>
                  <th>Priode</th>
                  <th>tanggal</th>
                  <th>Aksi</th>
                </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
</div>

  <!-- Modal delete-->
  @foreach ($penggajians as $p)  
<div class="modal fade" id="modaldelete{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data penggajian</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <form action="/deletepenggajian/{{ $p->id }}" method="POST" >
            @csrf
            @method('DELETE')
            <div class="row">
              <p>Apakah ingin menghapus Data <b>{{ $p->pegawai->nama }}</b></p>
            </div>
        </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

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

    <!-- Modal edit-->
    @foreach ($penggajians as $p)  
<div class="modal fade" id="modaledit{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Forms Tambah Pegawai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
      <div class="card-body">
        <form action="/updatepenggajian/{{ $p->id }}" method="POST" >
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="disabledSelect" class="form-label">Nama Pegawai</label>
                <select id="disabledSelect" class="form-select" name="pegawai_id" required>
                  <option value="0">nama pegawai</option>
                  @foreach ($data as $j)
                  <option value="{{ $j->id }}" {{ $p->pegawai_id == $j->id ? 'selected' : '' }}>{{ $j->nama }}</option>
                   @endforeach
                </select>  
              </div>
            </div>
          </div>
          <div class="row">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Priode Gaji</label>
              <input type="month" name="periode" value="{{ \Carbon\Carbon::parse($p->periode)->format('Y-m') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
          </div>
          <div class="row">
            <div class="col-6">  
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Total Hadir</label>
                <input type="number" name="total_hadir" value="{{ $p->total_hadir }}" class="form-control" id="exampleInputPassword1" required>
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Total Izin</label>
                <input type="number" name="total_izin" value="{{ $p->total_izin }}" class="form-control" id="exampleInputPassword1" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">  
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tolal Sakit </label>
                <input type="number" name="total_sakit" value="{{ $p->total_sakit }}" class="form-control" id="exampleInputPassword1" >
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="disabledSelect" class="form-label">Tolat Alpa</label>
                <input type="number" name="total_alpha" value="{{ $p->total_alpha }}" class="form-control" id="exampleInputPassword1" >
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
@endforeach

 
@endsection