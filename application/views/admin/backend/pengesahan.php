<section class="content">

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="row">
                <div class="col-sm-3 mb-1 float-sm-right">
                    <div class="form-group">
                        <select class="custom-select" id="by_tahun" name="by_tahun">
                            <option value="">-- Pilih Tahun --</option>
                            <?php foreach ($tahun as $hasil) : ?>
                            <option value="<?= enkrip($hasil['tahun']); ?>"
                                <?= ($th_ini == $hasil['tahun']) ? 'selected="selected"' : ''; ?>>
                                <?= $hasil['tahun']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php echo form_open('admin/pengesahan/multiple_delete'); ?>
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                            value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <table id="example" class="table table-bordered table-hover">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <?php if ($this->u3 == "ta") : ?>
                                    <th>Judul TA</th>
                                    <?php endif; ?>
                                    <th>Nama File</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>
                                        <center><input type="checkbox" id="check-all"></center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($pengesahan as $hasil) : ?>
                                <tr>
                                    <th><?= $i++ ?></th>
                                    <td><?= $hasil['nim']; ?></td>
                                    <td><?= $hasil['nama']; ?></td>
                                    <?php if ($this->u3 == "ta") : ?>
                                    <td><?= $hasil['judul']; ?></td>
                                    <?php endif; ?>
                                    <td>
                                        <a href="<?= base_url('assets/uploads/pengesahan/' . $hasil['nama_file']); ?>"
                                            target="_blank"><?= $hasil['nama_file']; ?></a>
                                    </td>
                                    <td><?= $hasil['create_at']; ?></td>
                                    <td class="text-center">
                                        <div class="badge <?php echo $hasil['status'] == 'ACC' ? 'btn-success' : 'badge-danger'; ?>"
                                            role="alert">
                                            <?= $hasil['status']; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <center>
                                            <input type="checkbox" class="check-item" name="id[]"
                                                value="<?= $hasil['id'] ?>">
                                        </center>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <tfoot>
                                <tr class="table table-warning">
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <?php if ($this->u3 == "ta") : ?>
                                    <th>-</th>
                                    <?php endif; ?>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>
                                        <center>
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data-data ini ?')"><i
                                                    class="fa fa-trash "></i></button>
                                        </center>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script src="<?= base_url(); ?>assets/admin/plugins/jquery/jquery.min.js"></script>

<script>
$(document).ready(function() {

    $('#by_tahun').change(function() {
        let tahun = $(this).find(':selected').val();
        document.location.href = '<?= base_url('admin/pengesahan/') . $kategori . "/"; ?>' +
            tahun;
    });

});
</script>