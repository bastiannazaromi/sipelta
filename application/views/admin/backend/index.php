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
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <div class="flash-sukses" data-flashdata="<?= $this->session->flashdata('flash-sukses'); ?>"></div>
        <div class="flash-error" data-flashdata="<?= $this->session->flashdata('flash-error'); ?>"></div>

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
                        <span class="mr-2 d-lg-inline text-dark"><?= nama($this->session->userdata('id')); ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('admin/admin/profile'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('admin/auth/logout'); ?>" data-toggle="modal"
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
                <span class="brand-text font-weight-light">SIPELTA</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('assets/uploads/profile/' . foto($this->session->userdata('id'))); ?>"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?= base_url('admin/admin/profile'); ?>"
                            class="d-block"><?= nama($this->session->userdata('id')); ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-1">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item mb-3">
                            <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link">
                                <i class="fas fa-fire nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                            <hr class="bg-light">
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="<?= base_url('admin/mahasiswa'); ?>" class="nav-link hr">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    List Mahasiswa
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="<?= base_url('admin/dosen'); ?>" class="nav-link hr">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    List Dosen
                                </p>
                            </a>
                        </li>

                        <?php if (level($this->session->userdata('id')) == "Super Admin") : ?>
                        <li class="nav-item has-treeview">
                            <a href="<?= base_url('admin/admin'); ?>" class="nav-link hr">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    List Admin
                                </p>
                            </a>
                        </li>
                        <?php endif; ?>

                        <li class="nav-item has-treeview">
                            <hr class="bg-light">
                            <a href="#" class="nav-link hr">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    File Upload
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('admin/jurnal'); ?>" class="nav-link">
                                        <i class="fas fa-book nav-icon"></i>
                                        <p>Jurnal TA</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('admin/laporan_pdf'); ?>" class="nav-link">
                                        <i class="fas fa-book nav-icon"></i>
                                        <p>Laporan TA PDF</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('admin/lembar_produk'); ?>" class="nav-link">
                                        <i class="fas fa-book nav-icon"></i>
                                        <p>Lembar Produk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('admin/pengesahan'); ?>" class="nav-link">
                                        <i class="fas fa-book nav-icon"></i>
                                        <p>Lembar Pengesahan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('admin/persetujuan'); ?>" class="nav-link">
                                        <i class="fas fa-book nav-icon"></i>
                                        <p>Lembar Persetujuan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('admin/brosur'); ?>" class="nav-link">
                                        <i class="fas fa-book nav-icon"></i>
                                        <p>Brosur</p>
                                    </a>

                                    <hr class="bg-light">
                                </li>
                            </ul>

                        </li>

                        <li class="nav-item has-treeview">
                            <a href="<?= base_url('admin/verifikasi'); ?>" class="nav-link hr">
                                <i class="nav-icon fas fa-check"></i>
                                <p>
                                    Verifikasi File
                                </p>
                            </a>

                            <hr class="bg-light">

                        </li>

                        <li class="nav-item has-treeview">
                            <a href="<?= base_url('admin/galery'); ?>" class="nav-link hr">
                                <i class="nav-icon fas fa-image"></i>
                                <p>
                                    Galery
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="<?= base_url('admin/background'); ?>" class="nav-link hr">
                                <i class="nav-icon fas fa-image"></i>
                                <p>
                                    Background
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="<?= base_url('admin/about'); ?>" class="nav-link hr">
                                <i class="nav-icon fas fa-question-circle"></i>
                                <p>
                                    About
                                </p>
                            </a>

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
            <strong>&copy; <a href="http://d3komputerphb.net/sipelta"
                    target='_blank'>d3komputerphb.net/sipelta</a></strong>
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

    <script src="<?= base_url('assets/sweetalert/sweetalert2.js'); ?> "></script>
    <script src="<?= base_url('assets/sweetalert/new_script.js'); ?> "></script>

    <script src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrap4.min.js"></script>

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
                    <a class="btn btn-primary" href="<?= base_url('admin/Auth/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script>
$(document).ready(function() {
    $('#example').DataTable();
});

$(document).ready(function() {
    $("#check-all").click(function() {
        if ($(this).is(":checked"))
            $(".check-item").prop("checked", true);
        else
            $(".check-item").prop("checked", false);
    });
});
</script>