<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <fieldset class="border p-2 mb-3"
                    style="border: 5px solid #ddd !important; border-radius:10px; background-color:#adad85; padding-left:10px!important;">
                    <legend>Note*</legend>
                    <li class="ml-3">Header : 1350 x 125 pixel</li>
                    <li class="ml-3">Jumbotron : 1200 x 450 pixel</li>
                    <li class="ml-3">Maksimum : 5 mb</li>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 col-12 text-right">
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalAdd"><i
                                class="fa fa-plus"></i> Background</button>
                    </div>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Gambar</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($background as $hasil) : ?>
                                <tr>
                                    <th><?= $i++ ?></th>
                                    <td><img src="<?= base_url('assets/uploads/bg/' . $hasil['bg']); ?>"
                                            class="img-fluid" alt="Responsive image" width="150"></td>
                                    <td><?= $hasil['deskripsi']; ?></td>
                                    <td>
                                        <a href="#" class="badge badge-warning" data-toggle="modal"
                                            data-target="#modalEdit<?= $hasil['id']; ?>"><i class="fa fa-edit"></i>
                                            Edit</a>
                                        <?php if ($hasil['id'] != 1) : ?>
                                        <a href="<?= base_url() ?>admin/background/hapus/<?= $hasil['id']; ?>"
                                            class="badge badge-danger delete-people tombol-hapus"><i
                                                class="fa fa-trash"></i> Hapus</a>
                                        <?php endif; ?>
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

<!-- Modal Add-->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('admin/background/tambah'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Background</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">
                        <label for="filebg">Upload File</label>
                        <input type="file" class="form-control" name="filebg" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" required
                            autocomplete="off">
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
<?php foreach ($background as $dt) : ?>
<div class="modal fade" id="modalEdit<?= $dt['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('admin/background/edit'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Background</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="<?= $dt['id']; ?>" name="id">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">
                        <label for="filebg">Upload File</label>
                        <input type="file" class="form-control" name="filebg" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" required
                            autocomplete="off" value="<?= $dt['deskripsi']; ?>">
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