<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?= base_url('assets/uploads/poltek.ico'); ?>">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/datatable/dataTables.bootstrap4.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/datatable/buttons.bootstrap4.min.css') ?>" type="text/css">

    <link href="<?= base_url() ; ?>assets/toastr/toastr.min.css" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <div class="flash-sukses" data-flashdata="<?= $this->session->flashdata('flash-sukses'); ?>"></div>
        <div class="flash-error" data-flashdata="<?= $this->session->flashdata('flash-error'); ?>"></div>

        <div class="toastr-sukses" data-flashdata="<?= $this->session->flashdata('toastr-sukses'); ?>"></div>
        <div class="toastr-error" data-flashdata="<?= $this->session->flashdata('toastr-error'); ?>"></div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <span class="mr-2 d-lg-inline text-dark"><?= $this->session->userdata('nama'); ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('dosen/profile'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('dosen/logout'); ?>" data-toggle="modal"
                            data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('user/beranda'); ?>" class="brand-link ml-2">
                <span class="brand-text font-weight-light">SIKAPTA</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('assets/uploads/profile/' . namaDosen($this->session->userdata('id'))); ?>"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?= base_url('dosen/profile'); ?>"
                            class="d-block"><?= $this->session->userdata('nama'); ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-1">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item mb-3">
                            <a href="<?= base_url('dosen'); ?>" class="nav-link">
                                <i class="fas fa-fire nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                            <hr class="bg-light">
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link hr">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    List Mahasiswa
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview ml-3">
                                <li class="nav-item">
                                    <a href="<?= base_url('dosen/mahasiswa/') . enkrip(4); ?>" class="nav-link">
                                        <i class="far fa-user nav-icon"></i>
                                        <p>Mahasiswa KP</p>
                                    </a>
                                </li>
                            </ul>
                            <hr class="bg-light">
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link hr">
                                <i class="nav-icon fas fa-download"></i>
                                <p>
                                    Download Form
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview ml-3">
                                <li class="nav-item">
                                    <a href="<?= base_url('dosen/form/') . enkrip(4); ?>" class="nav-link">
                                        <i class="fas fa-file-download nav-icon"></i>
                                        <p>KP</p>
                                    </a>
                                </li>
                            </ul>
                            <hr class="bg-light">

                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= $title; ?></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->

            <?php $this->load->view($page); ?>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>&copy; <a href="https://sikapta.d3komputerphb.id" target='_blank'>Beranda SIKAPTA</a></strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/admin/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url(); ?>assets/admin/dist/js/demo.js"></script>

    <script src="<?= base_url() ; ?>assets/toastr/toastr.min.js"></script>

    <script src="<?= base_url('assets/sweetalert/sweetalert2.js'); ?> "></script>
    <script src="<?= base_url('assets/sweetalert/new_script.js'); ?> "></script>

    <script src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/datatable/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatable/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatable/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatable/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatable/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatable/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatable/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatable/buttons.colVis.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
    <!-- panggil adapter jquery ckeditor -->
    <script src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>
    <!-- setup selector -->
    <script>
    $('textarea.texteditor').ckeditor();
    </script>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" untuk keluar dari halaman</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('dosen/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script>
$(document).ready(function() {
    $('#example').DataTable();

    var table = $('#examples').DataTable({
        lengthChange: false,
        pageLength: 25,
        buttons: [{
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
        columnDefs: [{
            visible: false
        }]
    });

    table.buttons().container()
        .appendTo('#examples_wrapper .col-md-6:eq(0)');
});

$(document).ready(function() {
    $("#check-all").click(function() {
        if ($(this).is(":checked"))
            $(".check-item").prop("checked", true);
        else
            $(".check-item").prop("checked", false);
    });
});

function bacaGambar(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#gambar_nodin').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#image").change(function() {
    bacaGambar(this);
});
</script>