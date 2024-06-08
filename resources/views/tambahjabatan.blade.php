@extends('index')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                       Tambah Jabatan
                    </button>
                </div>
                <h5 class="card-title fw-semibold mb-4 mt-4">Data Jabatan</h5>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        <table id="example" class="display mt-3" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
                                <th>Gaji pokok</th>
                                <th>Tunjangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $no => $dt)
                                
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $dt->nama_jabatan }}</td>
                                <td>{{ formatRupiah($dt->gaji_pokok) }}</td>
                                <td>{{ formatRupiah($dt->uang_kesehatan) }}</td>
                                <td>
                                    <i data-bs-toggle="modal" data-bs-target="#update{{ $dt->id }}" class="ti ti-edit" style="color:#00b3ff;font-size:1.6rem;"></i>
                                    <a href="/deljabatan/{{ $dt->id }}"><i class="ti ti-trash" style="color:#ff0000;font-size:1.6rem;"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
                                <th>Gaji Pokok</th>
                                <th>Tunjangan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
            </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Forms Tambah Jabatan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                    <form action="/createJabatan" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Jabatan</label>
                            <input type="text" class="form-control" name="nama_jabatan" 
                            id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Gaji Pokok</label>
                                <input type="number" class="form-control" name="gaji_pokok" 
                                id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tunjangan</label>
                            <input type="number" class="form-control" name="uang_kesehatan" 
                            id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
  <!-- Modal -->
  @foreach ($data as $dt)
<div class="modal fade" id="update{{$dt->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Forms edit Jabatan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                    <form action="/updatejab/{{ $dt->id }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama jabatan</label>
                            <input type="text" class="form-control" name="nama_jabatan" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $dt->nama_jabatan }}">
                        </div>
                        <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Gaji pokok</label>
                                <input type="number" class="form-control" name="gaji_pokok" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $dt->gaji_pokok }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tunjangan</label>
                            <input type="number" class="form-control" name="uang_kesehatan" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $dt->uang_kesehatan }}">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  @endforeach
@endsection