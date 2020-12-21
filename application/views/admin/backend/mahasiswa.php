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
                    <div class="col-lg-12 col-12 mb-3 text-right">
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalAdd"><i
                                class="fa fa-plus"></i> Mahasiswa</button>
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#modalImport"><i class="fa fa-plus"></i> Excel</button>
                        <button type="button" class="btn btn-sm btn-warning"
                            onclick="window.location='<?= base_url('excel/Format_excel_mahasiswa_kp.xlsx'); ?>'"><i
                                class="fa fa-download"></i>
                            Format KP</button>
                        <button type="button" class="btn btn-sm btn-warning"
                            onclick="window.location='<?= base_url('excel/Format_excel_mahasiswa_ta.xlsx'); ?>'"><i
                                class="fa fa-download"></i>
                            Format TA</button>
                    </div>
                    <div class="table-responsive">
                        <?php echo form_open('admin/mahasiswa/multiple_delete'); ?>
                        <table id="example" class="table table-bordered table-hover">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Semester</th>
                                    <?php if (dekrip($this->u4) == 6) : ?>
                                    <th>Judul</th>
                                    <?php endif ; ?>
                                    <th>Dosbing 1</th>
                                    <?php if (dekrip($this->u4) == 6) : ?>
                                    <th>Dosbing 2</th>
                                    <th>Kategori</th>
                                    <?php elseif (dekrip($this->u4) == 4) : ?>
                                    <th>Nama Instansi</th>
                                    <th>Alamat Instansi</th>
                                    <?php endif ; ?>
                                    <th>Tahun Akademik</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                    <th>
                                        <center><input type="checkbox" id="check-all"></center>
                                    </th>
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
                                    <?php if (dekrip($this->u4) == 6) : ?>
                                    <td><?= $hasil['judul']; ?></td>
                                    <?php endif ; ?>
                                    <td><?= $hasil['dosbing_1']; ?></td>
                                    <?php if (dekrip($this->u4) == 6) : ?>
                                    <td><?= $hasil['dosbing_2']; ?></td>
                                    <td><?= $hasil['kategori']; ?></td>
                                    <?php elseif (dekrip($this->u4) == 4) : ?>
                                    <td><?= $hasil['nama_instansi']; ?></td>
                                    <td><?= $hasil['alamat']; ?></td>
                                    <?php endif ; ?>
                                    <td><?= $hasil['tahun']; ?></td>

                                    <td><a href="<?= base_url() ?>admin/mahasiswa/resetPassword/<?= $hasil['id']; ?>"
                                            class="badge badge-success delete-people"><i class="fa fa-edit"></i>
                                            Reset</a>
                                    <td>
                                        <a href="#" class="badge badge-warning" data-toggle="modal"
                                            data-target="#modalEdit<?= $hasil['id']; ?>"><i class="fa fa-edit"></i>
                                            Edit</a>
                                    </td>
                                    <td>
                                        <center>
                                            <input type="checkbox" class="check-item" name="id[]"
                                                value="<?= $hasil['id'] ?>">
                                        </center>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="table table-warning">
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <?php if (dekrip($this->u4) == 6) : ?>
                                    <th>-</th>
                                    <th>-</th>
                                    <?php else : ?>
                                    <th>-</th>
                                    <?php endif ; ?>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
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

<!-- Modal Add-->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('admin/mahasiswa/tambah'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" name="nim" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" class="form-control" name="nama" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="custom-select semester" name="semester">
                            <option value="">-- Pilih Semester --</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dosbing_1">Dosen Pembimbing 1</label>
                        <select class="custom-select" name="dosbing_1">
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach ($dosen as $ds) : ?>
                            <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group dosbing_2_tambah d-none">
                        <label for="dosbing_2">Dosen Pembimbing 2</label>
                        <select class="custom-select" name="dosbing_2">
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach ($dosen as $ds) : ?>
                            <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group kategori_tambah d-none">
                        <label for="kategori">Kategori</label>
                        <select class="custom-select" name="kategori">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Hardware">Hardware</option>
                            <option value="Pemrograman">Pemrograman</option>
                            <option value="Jaringan">Jaringan</option>
                        </select>
                    </div>
                    <div class="form-group judul_tambah d-none">
                        <label for="judul">Judul</label>
                        <textarea class="form-control" name="judul" autocomplete="off"></textarea>
                    </div>
                    <div class="form-group tempat_tambah d-none">
                        <label for="tempat">Nama Instansi</label>
                        <textarea class="form-control" name="nama_instansi" autocomplete="off"></textarea>
                    </div>
                    <div class="form-group alamat_tambah d-none">
                        <label for="tempat">Alamat Instansi</label>
                        <textarea class="form-control" name="alamat" autocomplete="off"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="add" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit-->
<?php foreach ($mahasiswa as $dt) : ?>
<div class="modal fade" id="modalEdit<?= $dt['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('admin/mahasiswa/edit'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="<?= $dt['id']; ?>" name="id">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" name="nim" required autocomplete="off"
                            value="<?= $dt['nim']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" class="form-control" name="nama" required autocomplete="off"
                            value="<?= $dt['nama']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="custom-select semester_edit" name="semester">
                            <option value="">-- Pilih Semester --</option>
                            <option value="4" <?php if (4 == $dt['semester']) echo 'selected="selected"'; ?>>4</option>
                            <option value="6" <?php if (6 == $dt['semester']) echo 'selected="selected"'; ?>>6</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dosbing_1">Dosen Pembimbing 1</label>
                        <select class="custom-select" name="dosbing_1">
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach ($dosen as $ds) : ?>
                            <option value="<?= $ds['nama']; ?>"
                                <?php if ($ds['nama'] == $dt['dosbing_1']) echo 'selected="selected"'; ?>>
                                <?= $ds['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group dosbing_2_edit <?= ($dt['semester'] == 4) ? 'd-none' : '' ; ?>">
                        <label for="dosbing_2">Dosen Pembimbing 2</label>
                        <select class="custom-select" name="dosbing_2">
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach ($dosen as $ds) : ?>
                            <option value="<?= $ds['nama']; ?>"
                                <?php if ($ds['nama'] == $dt['dosbing_2']) echo 'selected="selected"'; ?>>
                                <?= $ds['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group kategori_edit <?= ($dt['semester'] == 4) ? 'd-none' : '' ; ?>">
                        <label for="kategori">Kategori</label>
                        <select class="custom-select" name="kategori">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Hardware"
                                <?php if ($dt['kategori'] == 'Hardware') echo 'selected="selected"'; ?>>Hardware
                            </option>
                            <option value="Pemrograman"
                                <?php if ($dt['kategori'] == 'Pemrograman') echo 'selected="selected"'; ?>>Pemrograman
                            </option>
                            <option value="Jaringan"
                                <?php if ($dt['kategori'] == 'Jaringan') echo 'selected="selected"'; ?>>Jaringan
                            </option>
                        </select>
                    </div>
                    <div class="form-group judul_edit <?= ($dt['semester'] == 4) ? 'd-none' : '' ; ?>"">
                        <label for=" judul">Judul</label>
                        <textarea class="form-control" name="judul" autocomplete="off"><?= $dt['judul']; ?></textarea>
                    </div>
                    <div class="form-group tempat_edit <?= ($dt['semester'] == 6) ? 'd-none' : '' ; ?>">
                        <label for="tempat">Nama Instansi</label>
                        <textarea class="form-control" name="nama_instansi"
                            autocomplete="off"><?= $dt['nama_instansi']; ?></textarea>
                    </div>
                    <div class="form-group alamat_edit <?= ($dt['semester'] == 6) ? 'd-none' : '' ; ?>">
                        <label for="tempat">Alamat Instansi</label>
                        <textarea class="form-control" name="alamat" autocomplete="off"><?= $dt['alamat']; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="edit" class="btn btn-warning">Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endforeach; ?>

<!-- Modal Import-->
<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('admin/mahasiswa/import'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">
                        <label for="ktgr">Kategori</label>
                        <select class="custom-select" name="ktgr">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="KP">KP</option>
                            <option value="TA">TA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nim">Upload File</label>
                        <input type="file" class="form-control" accept=".xlsx" name="fileExcel" required
                            autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="add" class="btn btn-success">Import</button>
                </div>
            </div>
        </form>
    </div>
</div>

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
        document.location.href = '<?= base_url('admin/mahasiswa/semester/') . $semester . "/" ; ?>' +
            tahun;
    });

});
</script>