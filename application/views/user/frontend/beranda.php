<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="<?= base_url('assets/uploads/poltek.ico'); ?>">

    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/beranda/'); ?>fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?= base_url('assets/frontend/beranda/'); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/beranda/'); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/beranda/'); ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/beranda/'); ?>css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/beranda/'); ?>css/owl.theme.default.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/frontend/beranda/'); ?>css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/frontend/beranda/'); ?>css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="<?= base_url('assets/frontend/beranda/'); ?>fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="<?= base_url('assets/frontend/beranda/'); ?>css/aos.css">

    <link href="<?= base_url('assets/lightbox/'); ?>ekko-lightbox.css" rel="stylesheet" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= base_url('assets/frontend/beranda/'); ?>css/style.css">

    <style type="text/css">
    .gambar-atas {
        background: url(<?= base_url('assets/uploads/bg/' . $bg_header[0]['bg']);
        ?>) no-repeat center center;
        background-size: cover;

        display: block;
        max-width: 100%;
        height: auto;
        padding-top: 60px;
        padding-bottom: 60px;
    }

    .imggallery {
        max-height: 200px;
    }
    </style>

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="flash-sukses" data-flashdata="<?= $this->session->flashdata('flash-sukses'); ?>"></div>
    <div class="flash-error" data-flashdata="<?= $this->session->flashdata('flash-error'); ?>"></div>


    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light gambar-atas">

        </nav>

        <header class="site-navbar py-2 js-sticky-header site-navbar-target" style="background: #ffd633" role="banner">

            <div class="container">
                <div class="row align-items-center">

                    <div class="col-11 col-xl-2">
                        <h1 class="mb-0 site-logo"><a href="<?= base_url('user/beranda'); ?>"
                                class="text-black h2 mb-0">SIPESTA </a></h1>
                    </div>
                    <div class="col-12 col-md-10 d-none d-xl-block">
                        <nav class="site-navigation position-relative text-right" role="navigation">

                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                                <li><a href="#beranda" class="nav-link">BERANDA</a></li>
                                <li><a href="#" class="nav-link"
                                        onclick="window.location='<?= base_url('user/dapur'); ?>'">UPLOAD</a></li>
                                <li><a href="#galery" class="nav-link">GALERY</a></li>
                                <li><a href="#about" class="nav-link">ABOUT</a></li>

                                <?php if (empty($this->session->userdata('user_login'))) : ?>
                                <li><a href="#" class="nav-link"
                                        onclick="window.location='<?= base_url('user/login'); ?>'">LOGIN</a></li>
                                <?php else : ?>
                                <li><a href="#" class="nav-link"
                                        onclick="window.location='<?= base_url('user/logout'); ?>'" data-toggle="modal"
                                        data-target="#logoutModal">LOGOUT</a></li>
                                <?php endif ?>
                            </ul>
                        </nav>
                    </div>


                    <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a
                            href="#" class="site-menu-toggle js-menu-toggle text-black"><span
                                class="icon-menu h3"></span></a></div>

                </div>
            </div>

        </header>

        <div class="site-content py-5 mt-5" id="beranda">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php $i = 1;
                                foreach ($bg_content as $hasil) : ?>
                                <div class="carousel-item <?= $i == 1 ? 'active' : ''; ?> ">
                                    <img src="<?= base_url('assets/uploads/bg/' . $hasil['bg']); ?>" class="img-fluid"
                                        alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 class="text-warning"><?= $hasil['deskripsi']; ?></h5>
                                    </div>
                                </div>

                                <?php $i++;
                                endforeach; ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="site-section mt-5 bg-light" id="galery">
            <div class="container">
                <h2 class="text-center mb-5 mt-5" style="color: #ffd633">GALERY</h2>
                <hr class="bg-dark mb-5" />
                <div class="col-md-12 blog-content">
                    <div id="gallery">
                        <div class="row">

                            <?php foreach ($galery as $hasil) : ?>

                            <div class="col-lg-3 col-md-4 col-6">
                                <a href="<?= base_url('assets/uploads/galery/' . $hasil['galery']); ?>"
                                    data-toggle="lightbox" data-gallery="gallery" class="d-block mb-4 h-100">
                                    <img class="img-fluid img-thumbnail"
                                        src="<?= base_url('assets/uploads/galery/' . $hasil['galery']); ?>" alt="">
                                </a>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section mt-5t" id="about">
            <div class="container">
                <h2 class="text-center mb-5 mt-5" style="color: #ffd633">ABOUT</h2>
                <hr class="bg-dark mb-5" />
                <div class="col-md-12 blog-content">

                    <?php foreach ($about as $ab) : ?>
                    <p class="lead"><?= $ab['deskripsi']; ?> </p>
                    <br>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <footer class="footer bg-dark">
            <div class="container">

                <div class="row mt-5 pt-4 text-center">
                    <div class="col-md-12">
                        <p class="text-white">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy; SIPESTA
                        </p>
                    </div>

                </div>
            </div>
        </footer>

    </div> <!-- .site-wrap -->

    <!-- Modal -->

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
                    <a class="btn btn-warning" href="<?= base_url('user/Login/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->

    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/jquery-migrate-3.0.1.min.js"></script>
    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/jquery-ui.js"></script>
    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/popper.min.js"></script>
    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/jquery.stellar.min.js"></script>
    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/jquery.countdown.min.js"></script>
    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/jquery.easing.1.3.js"></script>
    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/aos.js"></script>
    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/jquery.fancybox.min.js"></script>
    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/jquery.sticky.js"></script>


    <script src="<?= base_url('assets/frontend/beranda/'); ?>js/main.js"></script>

    <script src="<?= base_url('assets/sweetalert/sweetalert2.js'); ?> "></script>
    <script src="<?= base_url('assets/sweetalert/new_script.js'); ?> "></script>

    <script src="<?= base_url('assets/lightbox/'); ?>ekko-lightbox.js" crossorigin="anonymous"></script>

    <script>
    $(document).on("click", '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
    </script>

</body>

</html>