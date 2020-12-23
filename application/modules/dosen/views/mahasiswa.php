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
                                    <th>Semester</th>
                                    <?php if (dekrip($this->u3) == 6) : ?>
                                    <th>Judul</th>
                                    <?php endif ; ?>
                                    <th>Dosbing 1</th>
                                    <?php if (dekrip($this->u3) == 6) : ?>
                                    <th>Dosbing 2</th>
                                    <th>Kategori</th>
                                    <?php elseif (dekrip($this->u3) == 4) : ?>
                                    <th>Nama Instansi</th>
                                    <th>Alamat Instansi</th>
                                    <?php endif ; ?>
                                    <th>Tahun Akademik</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($mahasiswa as $hasil) : ?>
                                <tr>
                                    <th><?= $i++ ?></th>
                                    <td><?= $hasil['nim']; ?></td>
                                    <td><?= $hasil['nama']; ?></td>
                                    <td><?= $hasil['semester']; ?></td>
                                    <?php if (dekrip($this->u3) == 6) : ?>
                                    <td><?= $hasil['judul']; ?></td>
                                    <?php endif ; ?>
                                    <td><?= $hasil['dosbing_1']; ?></td>
                                    <?php if (dekrip($this->u3) == 6) : ?>
                                    <td><?= $hasil['dosbing_2']; ?></td>
                                    <td><?= $hasil['kategori']; ?></td>
                                    <?php elseif (dekrip($this->u3) == 4) : ?>
                                    <td><?= $hasil['nama_instansi']; ?></td>
                                    <td><?= $hasil['alamat']; ?></td>
                                    <?php endif ; ?>
                                    <td><?= $hasil['tahun']; ?></td>

                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="table table-warning">
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <?php if (dekrip($this->u3) == 6) : ?>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <?php else : ?>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <?php endif ; ?>
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

    let semester = $('.semester');
    let semester_edit = $('.semester_edit');
    let dosbing_2_edit = $('.dosbing_2_edit');
    let kategori_edit = $('.kategori_edit');

    $(semester).each(function(i) {
        $(semester[i]).change(function() {
            let smstr = $(this).find(':selected').val();

            if (smstr == 6) {
                $('.dosbing_2_tambah').removeClass('d-none');
                $('.kategori_tambah').removeClass('d-none');
                $('.judul_tambah').removeClass('d-none');
                $('.tempat_tambah').addClass('d-none');
                $('.alamat_tambah').addClass('d-none');
            } else {
                $('.dosbing_2_tambah').addClass('d-none');
                $('.kategori_tambah').addClass('d-none');
                $('.judul_tambah').addClass('d-none');
                $('.tempat_tambah').removeClass('d-none');
                $('.alamat_tambah').removeClass('d-none');
            }
        });
    });

    $(semester_edit).each(function(i) {
        $(semester_edit[i]).change(function() {
            let smstr = $(this).find(':selected').val();

            if (smstr == 6) {
                $('.dosbing_2_edit').removeClass('d-none');
                $('.kategori_edit').removeClass('d-none');
                $('.judul_edit').removeClass('d-none');
                $('.tempat_edit').addClass('d-none');
                $('.alamat_edit').addClass('d-none');
            } else {
                $('.dosbing_2_edit').addClass('d-none');
                $('.kategori_edit').addClass('d-none');
                $('.judul_edit').addClass('d-none');
                $('.tempat_edit').removeClass('d-none');
                $('.alamat_edit').removeClass('d-none');
            }
        });
    });

    $('#by_tahun').change(function() {
        let tahun = $(this).find(':selected').val();
        document.location.href = '<?= base_url('dosen/mahasiswa/') . $semester . "/" ; ?>' +
            tahun;
    });

});
</script>