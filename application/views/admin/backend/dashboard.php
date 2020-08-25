<section class="content">

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3> <?= $mahasiswa; ?></h3>

                    <p>Total Mahasiswa</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user fa-2x"></i>
                </div>
                <a href="<?= base_url('admin/mahasiswa'); ?>" class="small-box-footer">Detail <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3> <?= $dosen; ?></h3>

                    <p>Total Dosen</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user fa-2x"></i>
                </div>
                <a href="<?= base_url('admin/dosen'); ?>" class="small-box-footer">Detail <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <?php if (level($this->session->userdata('id')) == 'Super Admin') : ?>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3> <?= $admin; ?></h3>

                    <p>Total Admin</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user fa-2x"></i>
                </div>
                <a href="<?= base_url('admin/admin'); ?>" class="small-box-footer">Detail <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3> <?= $jurnal; ?></h3>

                    <p>Total Jurnal</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book fa-2x"></i>
                </div>
                <a href="<?= base_url('admin/jurnal'); ?>" class="small-box-footer">Detail <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3> <?= $laporan_pdf; ?></h3>

                    <p>Total Laporan PDF</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book fa-2x"></i>
                </div>
                <a href="<?= base_url('admin/laporan_pdf'); ?>" class="small-box-footer">Detail <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3> <?= $lembar_produk; ?></h3>

                    <p>Total Lembar Penyerahan Produk</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book fa-2x"></i>
                </div>
                <a href="<?= base_url('admin/lembar_produk'); ?>" class="small-box-footer">Detail <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3> <?= $pengesahan; ?></h3>

                    <p>Total Lembar Pengesahan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-image fa-2x"></i>
                </div>
                <a href="<?= base_url('admin/pengesahan'); ?>" class="small-box-footer">Detail <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3> <?= $persetujuan; ?></h3>

                    <p>Total Lembar Persetujuan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-image fa-2x"></i>
                </div>
                <a href="<?= base_url('admin/persetujuan'); ?>" class="small-box-footer">Detail <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3> <?= $brosur; ?></h3>

                    <p>Total Brosur</p>
                </div>
                <div class="icon">
                    <i class="fas fa-image fa-2x"></i>
                </div>
                <a href="<?= base_url('admin/brosur'); ?>" class="small-box-footer">Detail <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

</section>

</script>