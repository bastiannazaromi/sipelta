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
                                    <?php if ($semester == enkrip(6)) : ?>
                                    <th>Judul</th>
                                    <?php else : ?>
                                    <th>Nama Instansi</th>
                                    <?php endif ; ?>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($mahasiswa as $hasil) : ?>
                                <?php if (status_file($hasil['nim']) != 'File belum lengkap') : ?>
                                <tr>
                                    <th><?= $i++ ?></th>
                                    <td><?= $hasil['nim']; ?></td>
                                    <td><?= $hasil['nama']; ?></td>
                                    <?php if ($semester == enkrip(6)) : ?>
                                    <td><?= $hasil['judul']; ?></td>
                                    <?php else : ?>
                                    <td><?= $hasil['nama_instansi']; ?></td>
                                    <?php endif ; ?>
                                    <td>
                                        <div class="badge <?= status_file($hasil['nim']) == 'Terverifikasi' ? 'btn-success' : 'badge-warning'; ?>"
                                            role="alert">
                                            <?= status_file($hasil['nim']); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/verifikasi/cek_file/<?= $hasil['nim']; ?>"
                                            class="badge badge-success"><i class="fa fa-check"></i> Cek File</a>
                                    </td>
                                </tr>
                                <?php endif; ?>
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
    document.location.href = '<?= base_url('admin/verifikasi/kategori/') . $semester . "/" ; ?>' +
        tahun;
});
</script>