<section class="content">

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="row">
                <div class="col-sm-3 mb-1 float-sm-right">
                    <div class="form-group">
                        <select class="custom-select" id="by_tahun" name="by_tahun">
                            <option value="">-- Pilih Tahun --</option>
                            <?php foreach ($tahun as $hasil) : ?>
                            <option value="<?= enkrip($hasil['tahun']) ; ?>"><?= $hasil['tahun'] ; ?></option>
                            <?php endforeach ; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Judul TA</th>
                                    <th>Nama File</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($lembar_produk as $hasil) : ?>
                                <tr>
                                    <th><?= $i++ ?></th>
                                    <td><?= $hasil['nim']; ?></td>
                                    <td><?= $hasil['nama']; ?></td>
                                    <td><?= $hasil['judul']; ?></td>
                                    <td>
                                        <a href="<?= base_url('assets/uploads/lembar_produk/' . $hasil['nama_file']); ?>"
                                            target="_blank"><?= $hasil['nama_file']; ?></a>
                                    </td>
                                    <td><?= $hasil['create_at']; ?></td>
                                    <td class="text-center">
                                        <div class="badge <?php echo $hasil['status'] == 'ACC' ? 'btn-success' : 'badge-danger'; ?>"
                                            role="alert">
                                            <?= $hasil['status']; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <tfoot>
                                <tr class="table table-warning">
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                </tr>
                            </tfoot>
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

    $('#by_tahun').change(function() {
        let tahun = $(this).find(':selected').val();
        document.location.href = '<?= base_url('dosen/lembar_produk/') ; ?>' +
            tahun;
    });

});
</script>