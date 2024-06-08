<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penggajian PT.TUNAS</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
         @include('layouts.Menubar')
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.header')
            <!--  Header End -->

            {{-- content star--}}
            <div class="container-fluid">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        @endforeach
                    </ul>
                </div>
            @endif
                    @yield('content')
            </div>
            {{-- content End--}}
        </div>
    </div>
      <!-- Modal -->
  <div class="modal fade" id="ModalUbah" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
             <h1 class="modal-title fs-5" id="exampleModalLabel">Form Ubah Password</h1>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="card">
                     <div class="card-body">
                     <form action="/ubahpassword" method="POST">
                         @csrf
                         <div class="mb-3">
                             <label for="exampleInputEmail1" class="form-label">Password lama</label>
                             <input type="password" class="form-control" name="password_lama" 
                             id="exampleInputEmail1" aria-describedby="emailHelp">
                         </div>
                         <div class="row">
                         <div class="col">
                             <div class="mb-3">
                                 <label for="exampleInputEmail1" class="form-label">Password Baru</label>
                                 <input type="password" class="form-control" name="password_baru" 
                                 id="exampleInputEmail1" aria-describedby="emailHelp">
                             </div>
                         </div>
                         </div>
                     </div>
                 </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Simpan</button>
                 </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <script>
        new DataTable('#example', {
            layout: {
                bottomEnd: {
                    paging: {
                        boundaryNumbers: false
                    }
                }
            }
        });
    </script>
      {{--       --}}
</body>

</html>