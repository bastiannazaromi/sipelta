<section class="content">

    <div class="row">
        <div class="col-xl-12 col-md-12">
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
                                    <th>Berita Acara</th>
                                    <th>Kuisioner Monitoring KP</th>
                                    <th>Kuisioner Mitra</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($mahasiswa as $hasil) : ?>
                                <tr>
                                    <th><?= $i++ ?></th>
                                    <td><?= $hasil['nim']; ?></td>
                                    <td><?= $hasil['nama']; ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>dosen/beritaAcara/<?= enkrip($hasil['nim']); ?>"
                                            class="badge badge-success" target="_blank"><i
                                                class="fas fa-file-download"></i>
                                            Download</a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url() ?>dosen/k_kp/<?= enkrip($hasil['nim']); ?>"
                                            class="badge badge-success" target="_blank"><i
                                                class="fas fa-file-download"></i>
                                            Download</a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url() ?>dosen/k_m/<?= enkrip($hasil['nim']); ?>"
                                            class="badge badge-success" target="_blank"><i
                                                class="fas fa-file-download"></i>
                                            Download</a>
                                    </td>
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
$(document).ready(function() {

    $('#by_tahun').change(function() {
        let tahun = $(this).find(':selected').val();
        document.location.href = '<?= base_url('dosen/form/') . $semester . "/" ; ?>' +
            tahun;
    });

});
</script>