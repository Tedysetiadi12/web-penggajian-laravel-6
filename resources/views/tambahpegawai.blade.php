@extends('index');
@section('content')
<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <h5 class="card-title fw-semibold mb-4 mt-4">Data Pegawai</h5>           
          <div class="col">
              <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Pegawai
              </button>
              @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
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
                      <th>Foto</th>
                      <th>Nama pegawai</th>
                      <th>Tanggal Lahir</th>
                      <th>Alamat</th>
                      <th>No handphone</th>
                      <th>Email</th>
                      <th>Tanggal masuk</th>
                      <th>Jabatan</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($pegawai as $no => $dt)
                      
                  <tr>
                      <td>{{ $no + 1 }}</td>
                      <td><img src="{{ asset('storage/' . $dt->foto) }}" alt="{{$dt->foto}}" width="50" height="50" style="border-radius:50%; object-fit: cover;"></td>
                      <td>{{ $dt->nama }}</td>
                      <td>{{ formatTanggal($dt->tanggal_lahir) }}</td>
                      <td>{{ $dt->alamat }}</td>
                      <td>{{ $dt->nohp }}</td>
                      <td>{{ $dt->email }}</td>
                      <td>{{ formatTanggal($dt->tanggal_masuk) }}</td>
                      <td>{{ $dt->jabatan->nama_jabatan }}</td>
                      <td>
                          <i data-bs-toggle="modal" data-bs-target="#modaledit{{ $dt->id }}" class="ti ti-edit" style="color:#00b3ff;font-size:1.6rem;"></i>
                          <i data-bs-toggle="modal" data-bs-target="#modadelete{{ $dt->id }}" class="ti ti-trash" style="color:#ff0000;font-size:1.6rem;"></i>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
              <tfoot>
                  <tr>
                      <th>No</th>
                      <th>Foto</th>
                      <th>Nama pegawai</th>
                      <th>Tanggal Lahir</th>
                      <th>Alamat</th>
                      <th>No handphone</th>
                      <th>Email</th>
                      <th>Tanggal masuk</th>
                      <th>Jabatan</th>
                      <th>Aksi</th>
                  </tr>
              </tfoot>
          </table>
          </div>
      </div>
    </div>
  <!-- Modal edit-->
  @foreach ($pegawai as $p)  
<div class="modal fade" id="modaledit{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Forms Tambah Pegawai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="card">
              <div class="card-body">
                <form action="/updatepegawai/{{ $p->id }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="row">
                    <div class="col-6">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Pegawai</label>
                        <input type="text" name="nama" value="{{ $p->nama }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                      </div> 
                    </div>
                    <div class="col-6">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tangaal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ $p->tanggal_lahir }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Alamat Tinggal</label>
                    <input type="text" name="alamat" value="{{ $p->alamat }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                  </div>
                  <div class="row">
                    <div class="col-6">  
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">No Hanphone</label>
                        <input type="number" name="nohp" value="{{ $p->nohp }}" class="form-control" id="exampleInputPassword1" required>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Email</label>
                        <input type="email" name="email" value="{{ $p->email }}" class="form-control" id="exampleInputPassword1" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4">  
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" value="{{ $p->tanggal_masuk }}" class="form-control" id="exampleInputPassword1" required>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="mb-3">
                        <label for="disabledSelect" class="form-label">Jabatan Pegawai</label>
                        <select id="disabledSelect" class="form-select" name="jabatan_id" required>
                          @foreach ($jabatan as $j)
                          <option value="{{ $j->id }}" {{ old('jabatan_id', $p->jabatan_id) == $j->id ? 'selected' : '' }}>{{ $j->nama_jabatan }}</option>
                      @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="mb-3">
                        <label for="editfile" class="form-label">Foto pegawai</label> <br>
                        <img src="{{ asset('storage/' . $p->foto) }}" alt="" width="50">
                        <input type="file" name="foto" accept="image/*" class="form-control" id="exampleInputPassword1"  value="{{ $p->foto }}" >
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
@endforeach
  <!-- Modal delete-->
  @foreach ($pegawai as $p)  
<div class="modal fade" id="modadelete{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Pegawai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="card">
              <div class="card-body">
                <form action="/deletepegawai/{{ $p->id }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('DELETE')
                  <p>Apakah ingin menghapus data <b>{{ $p->nama }}</b></p> 
             </div>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
      </form>
      </div>
    </div>
  </div>
</div>
@endforeach

  <!-- Modal tambah-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Forms Tambah Pegawai</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                  <form action="/createpegawai" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-6">
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Nama Jabatan</label>
                          <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tangaal Lahir</label>
                          <input type="date" name="tanggal_lahir" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Alamat tinggal</label>
                      <input type="text" name="alamat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="row">
                      <div class="col-6">  
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">No hanphone</label>
                          <input type="number" name="nohp" class="form-control" id="exampleInputPassword1" required>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Email</label>
                          <input type="email" name="email" class="form-control" id="exampleInputPassword1" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">  
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Tanggal Masuk</label>
                          <input type="date" name="tanggal_masuk" class="form-control" id="exampleInputPassword1" required>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="mb-3">
                          <label for="disabledSelect" class="form-label">Jabatan Pegawai</label>
                          <select id="disabledSelect" class="form-select" name="jabatan_id" required>
                            <option value="0">>-------------<</option>
                            @foreach ($jabatan as $j)
                            <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="mb-3">
                          <label for="editfile" class="form-label">Foto pegawai</label>
                          <input type="file" name="foto" accept="image/*" class="form-control" id="exampleInputPassword1" required>
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