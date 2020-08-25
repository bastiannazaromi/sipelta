<section class="content">

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 col-12 text-right">
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalAdd"><i
                                class="fa fa-plus"></i> Mahasiswa</button>
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#modalImport"><i class="fa fa-plus"></i> Excel</button>
                        <button type="button" class="btn btn-sm btn-warning"
                            onclick="window.location='<?= base_url('excel/Format_excel_mahasiswa.xlsx'); ?>'"><i
                                class="fa fa-download"></i>
                            Format</button>
                    </div>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <?php echo form_open('admin/mahasiswa/multiple_delete'); ?>
                        <table id="example" class="table table-bordered table-hover">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Judul TA</th>
                                    <th>Kategori</th>
                                    <th>Dosbing 1</th>
                                    <th>Dosbing 2</th>
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
                                    <td><?= $hasil['judul']; ?></td>
                                    <td><?= $hasil['kategori']; ?></td>
                                    <td><?= $hasil['dosbing_1']; ?></td>
                                    <td><?= $hasil['dosbing_2']; ?></td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="dosbing_1">Dosen Pembimbing 1</label>
                        <select class="custom-select" id="inputGroupSelect02" name="dosbing_1">
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach ($dosen as $ds) : ?>
                            <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dosbing_2">Dosen Pembimbing 2</label>
                        <select class="custom-select" id="inputGroupSelect02" name="dosbing_2">
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach ($dosen as $ds) : ?>
                            <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="custom-select" id="inputGroupSelect02" name="kategori">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Hardware">Hardware</option>
                            <option value="Pemrograman">Pemrograman</option>
                            <option value="Jaringan">Jaringan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul TA</label>
                        <textarea class="form-control" id="judul" name="judul" required autocomplete="off"></textarea>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Mahasiswa</h5>
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
                        <input type="text" class="form-control" id="nim" name="nim" required autocomplete="off"
                            value="<?= $dt['nim']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off"
                            value="<?= $dt['nama']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="dosbing_1">Dosen Pembimbing 1</label>
                        <select class="custom-select" id="inputGroupSelect02" name="dosbing_1">
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach ($dosen as $ds) : ?>
                            <option value="<?= $ds['nama']; ?>"
                                <?php if ($ds['nama'] == $dt['dosbing_1']) echo 'selected="selected"'; ?>>
                                <?= $ds['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dosbing_2">Dosen Pembimbing 2</label>
                        <select class="custom-select" id="inputGroupSelect02" name="dosbing_2">
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach ($dosen as $ds) : ?>
                            <option value="<?= $ds['nama']; ?>"
                                <?php if ($ds['nama'] == $dt['dosbing_2']) echo 'selected="selected"'; ?>>
                                <?= $ds['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="custom-select" id="inputGroupSelect02" name="kategori">
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
                    <div class="form-group">
                        <label for="judul">Judul TA</label>
                        <textarea class="form-control" id="judul" name="judul" required
                            autocomplete="off"><?= $dt['judul']; ?></textarea>
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
                        <label for="nim">Upload File</label>
                        <input type="file" class="form-control" name="fileExcel" required autocomplete="off">
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