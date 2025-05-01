<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME', 'PBL IK-TI') }}</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('') }}plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    @stack('css')
    <link rel="stylesheet" href="{{ asset('') }}dist/css/adminlte.min.css">
    <style>
    /* Warna background dan teks saat aktif */
    .nav-sidebar .nav-link.active {
        background-color: #164B60 !important;
        color: white !important;
    }

    /* Pastikan icon dan teks juga ikut putih */
    .nav-sidebar .nav-link.active i,
    .nav-sidebar .nav-link.active p,
    .nav-sidebar .nav-link.active span {
        color: white !important;
    }

    /* (Opsional) Hover juga putih */
    .nav-sidebar .nav-link:hover {
        background-color: #164B60;
        color: white;
    }
    /* Override primary color */
    :root {
        --bs-primary: #164B60;
    }

    /* Tambahan untuk jaga-jaga kalau class langsung pakai background/text */
    .btn-primary,
    .bg-primary,
    .border-primary,
    .text-primary {
        background-color: #164B60 !important;
        border-color: #164B60 !important;
        color: #fff !important;
    }

    .user-header {
        background-color: #1B6B93 !important;
        color: white !important;
    }

    .user-header p,
    .user-header small {
        color: white !important;
    }
    /* Biar navbar selalu di atas */
    .main-header {
        z-index: 1040 !important;
        position: fixed !important;
        top: 0;
        left: 0;
        right: 0;
    }

    /* Biar isi konten geser turun */
    .content-wrapper {
        margin-top: 56px; /* tinggi navbar kamu */
    }

    /* Sidebar jangan nutupi header */
    .main-sidebar {
        z-index: 1030 !important;
    }

    /* Biar navbar gak ikut kegeser pas sidebar dibuka */
    body.sidebar-mini.layout-fixed .main-header {
        transition: none !important;
        margin-left: 0 !important;
        width: 100% !important;
    }


    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Preloader -->
    {{-- <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('dist/img/logo-polines.png') }}" alt="Polines Logo"
            height="80" width="80">
    </div> --}}
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark" style="background-color: #164B60">
            <ul class="navbar-nav d-flex align-items-center">
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li> -->
                <li class="nav-item d-flex align-items-center ml-2">
                    <a href="{{ url('') }}" class="nav-link d-flex align-items-center">
                        <img src="{{ asset('dist/img/logo-polines.png') }}" alt="Logo Polines"
                            style="height:30px; margin-right:10px;" class="elevation-0">
                        <span class="text-white font-weight-bold">Health Care</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="user-image img-circle elevation-2"
                            alt="User Image">
                        <span class="d-none d-md-inline">{{ ucwords($user['name']) }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <li class="user-header bg-info">
                            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-3" alt="User Image">
                            <p>
                                {{ ucwords($user['name']) }}
                                <small>Politeknik Negeri Semarang</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            
                            <a href="#" class="btn btn-default btn-flat float-right" data-toggle="modal"
                                data-target="#modal-logout"><i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="modal fade" id="modal-logout" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="modal-body text-center">
                            <h5>Apakah anda ingin keluar ?</h5>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-sm btn-default btn-flat"
                                data-dismiss="modal">Tidak</button>
                            <a class="btn btn-sm btn-info btn-flat float-right" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                            this.closest('form').submit();"><span>Ya,
                                    Keluar</span></a>
                        </div>
                    </form>
                </div>

            </div>

        </div>

        <aside class="main-sidebar main-sidebar-custom sidebar-dark-info elevation-4">
            <a href="{{ url('') }}" class="brand-link">
                <img src="{{ asset('') }}dist/img/logo-polines.png" alt="Logo Polines"
                    class="brand-image elevation-3" style="opacity: .8">
                <span
                    class="brand-text font-weight-light "><strong>{{ env('APP_NAME', 'PBL IK-TI Polines') }}</strong></span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    @include('layouts.sidebar')
                </nav>
            </div>

            {{-- <div class="sidebar-custom">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="btn btn-info btn-block" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                this.closest('form').submit();"><i
                            class="fas fa-sign-out-alt"></i> <span>Keluar</span></a>
                </form>
            </div> --}}
        </aside>

        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>&copy; {{ date('Y') }} <i>Task Force</i> PBL IK-TRK Polines</strong>
        </footer> -->
    </div>

    <script src="{{ asset('') }}plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('') }}plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    @stack('js')
    <script src="{{ asset('') }}dist/js/adminlte.min.js"></script>
    <script>
        $(function() {
            $("#datatable-main").DataTable({
                "responsive": true,
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, 'All']
                ],
                pageLength: 50,
                //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#datatable-main_wrapper .col-md-6:eq(0)');
            
            $('#datatable-sub').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        $('.confirm-button').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                    title: `Hapus data`,
                    icon: "warning",
                    buttons: {
                        confirm: {
                            text: 'Ya'
                        },
                        cancel: 'Tidak'
                    },
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
</body>

</html>
