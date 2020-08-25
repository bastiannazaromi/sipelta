<section class="content">

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Berkas</th>
                                    <th>Nama File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($berkas as $hasil) : ?>
                                <tr>
                                    <th><?= $i++ ?></th>
                                    <td><?= $hasil['berkas']; ?></td>
                                    <td>
                                        <a href="<?= base_url('assets/uploads/' . $hasil['berkas'] . '/' . $hasil['judul']); ?>"
                                            target="_blank"><?= $hasil['judul']; ?></a>
                                    </td>
                                    <td>
                                        <?php if ($hasil['judul'] != null) : ?>
                                        <div class="form-group" data-toggle="badges">
                                            <label class="badge badge-success">
                                                <input type="radio" name="<?= $hasil['berkas']; ?>"
                                                    id="<?= $hasil['berkas'] . '_acc'; ?>" autocomplete="off"
                                                    <?= $hasil['status'] == 'ACC' ? 'checked' : ''; ?>
                                                    data-tabeldb="<?= $hasil['berkas']; ?>" data-status="ACC"
                                                    data-nim="<?= $nim; ?>"> ACC
                                            </label>
                                            <label class="badge badge-warning">
                                                <input type="radio" name="<?= $hasil['berkas']; ?>"
                                                    id="<?= $hasil['berkas'] . '_menunggu'; ?>" autocomplete="off"
                                                    <?= $hasil['status'] == 'Menunggu' ? 'checked' : ''; ?>
                                                    data-tabeldb="<?= $hasil['berkas']; ?>" data-status="Menunggu"
                                                    data-nim="<?= $nim; ?>">
                                                Menunggu
                                            </label>
                                            <label class="badge badge-danger">
                                                <input type="radio" name="<?= $hasil['berkas']; ?>"
                                                    id="<?= $hasil['berkas'] . '_tolak'; ?>" autocomplete="off"
                                                    <?= $hasil['status'] == 'Tolak' ? 'checked' : ''; ?>
                                                    data-tabeldb="<?= $hasil['berkas']; ?>" data-status="Tolak"
                                                    data-nim="<?= $nim; ?>">
                                                Tolak
                                            </label>
                                        </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

<script src="<?= base_url(); ?>assets/admin/plugins/jquery/jquery.min.js"></script>

<script>
$(document).ready(function() {
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    $('#jurnal_menunggu').change(function() {

        let tabel = 'tb_jurnal';
        let status = 'Menunggu';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#jurnal_acc').change(function() {

        let tabel = 'tb_jurnal';
        let status = 'ACC';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#jurnal_tolak').change(function() {

        let tabel = 'tb_jurnal';
        let status = 'Tolak';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#laporan_pdf_menunggu').change(function() {

        let tabel = 'tb_laporan_pdf';
        let status = 'Menunggu';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#laporan_pdf_acc').change(function() {

        let tabel = 'tb_laporan_pdf';
        let status = 'ACC';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#laporan_pdf_tolak').change(function() {

        let tabel = 'tb_laporan_pdf';
        let status = 'Tolak';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#lembar_produk_menunggu').change(function() {

        let tabel = 'tb_produk';
        let status = 'Menunggu';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#lembar_produk_acc').change(function() {

        let tabel = 'tb_produk';
        let status = 'ACC';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#lembar_produk_tolak').change(function() {

        let tabel = 'tb_produk';
        let status = 'Tolak';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#pengesahan_menunggu').change(function() {

        let tabel = 'tb_pengesahan';
        let status = 'Menunggu';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#pengesahan_acc').change(function() {

        let tabel = 'tb_pengesahan';
        let status = 'ACC';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#pengesahan_tolak').change(function() {

        let tabel = 'tb_pengesahan';
        let status = 'Tolak';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#persetujuan_menunggu').change(function() {

        let tabel = 'tb_persetujuan';
        let status = 'Menunggu';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#persetujuan_acc').change(function() {

        let tabel = 'tb_persetujuan';
        let status = 'ACC';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#persetujuan_tolak').change(function() {

        let tabel = 'tb_persetujuan';
        let status = 'Tolak';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#brosur_menunggu').change(function() {

        let tabel = 'tb_brosur';
        let status = 'Menunggu';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#brosur_acc').change(function() {

        let tabel = 'tb_brosur';
        let status = 'ACC';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

    $('#brosur_tolak').change(function() {

        let tabel = 'tb_brosur';
        let status = 'Tolak';
        let nim = $(this).data('nim');

        var dataJson = {
            [csrfName]: csrfHash,
            nim: nim,
            tabel: tabel,
            status: status
        };

        $.ajax({
            url: "<?= base_url('admin/verifikasi/update'); ?>",
            type: 'post',
            data: dataJson,
            success: function() {
                document.location.href =
                    `<?= base_url('admin/verifikasi/cek_file/'); ?>${nim}`;
            }
        });
    });

});
</script>