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
                        <table id="examples" class="table table-bordered table-hover">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>No. Telepon</th>
                                    <th>Email</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($rekap as $hasil) : ?>
                                <tr>
                                    <th><?= $i++ ?></th>
                                    <th><?= $hasil['nama']; ?></th>
                                    <th><?= $hasil['nim']; ?></th>
                                    <th><?= $hasil['no_telepon']; ?></th>
                                    <th><?= $hasil['email']; ?></th>
                                    <th>
                                        <?php if ($hasil['semester'] == 4) {
                                                if ($hasil['nama_laporan_pdf'] && $hasil['pengesahan']) {
                                                    echo 'Sudah upload berkas';
                                                } else {
                                                    echo 'Belum upload berkas';
                                                }
                                            } elseif ($hasil['semester'] == 6) {
                                                if ($hasil['nama_laporan_pdf'] && $hasil['pengesahan'] && $hasil['persetujuan'] && $hasil['brosur'] && $hasil['produk'] && $hasil['jurnal']) {
                                                    echo 'Sudah upload berkas';
                                                } else {
                                                    echo 'Belum upload berkas';
                                                }
                                            }

                                            ?>
                                    </th>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script src="<?= base_url(); ?>assets/admin/plugins/jquery/jquery.min.js"></script>

<script>
$('#by_tahun').change(function() {
    let tahun = $(this).find(':selected').val();
    document.location.href = '<?= base_url('admin/rekap/') . $semester . "/"; ?>' +
        tahun;
});
</script>