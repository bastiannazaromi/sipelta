<section class="content">

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                value="<?php echo $this->security->get_csrf_hash(); ?>" id="csrf_id">
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

    $('#jurnal_menunggu').change(function() {

        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();
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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#jurnal_acc').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#jurnal_tolak').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#laporan_pdf_menunggu').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#laporan_pdf_acc').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#laporan_pdf_tolak').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#lembar_produk_menunggu').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#lembar_produk_acc').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#lembar_produk_tolak').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#pengesahan_menunggu').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#pengesahan_acc').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#pengesahan_tolak').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#persetujuan_menunggu').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#persetujuan_acc').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#persetujuan_tolak').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#brosur_menunggu').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#brosur_acc').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

    $('#brosur_tolak').change(function() {
        let csrfName = $("#csrf_id").attr('name');
        let csrfHash = $("#csrf_id").val();

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
            dataType: 'json',
            data: dataJson,
            success: function(result) {
                toastr.success('Sukses');
                $("#csrf_id").val(result);
            }
        });
    });

});
</script>