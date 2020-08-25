<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <fieldset class="border p-2 mb-3"
                    style="border: 5px solid #ddd !important; border-radius:10px; background-color:#adad85; padding-left:10px!important;">
                    <legend>Note*</legend>
                    <li class="ml-3">Dimensi : 1200 x 720 pixel</li>
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
                                class="fa fa-plus"></i> Galery</button>
                    </div>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Gambar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($galery as $hasil) : ?>
                                <tr>
                                    <th><?= $i++ ?></th>
                                    <td><img src="<?= base_url('assets/uploads/galery/' . $hasil['galery']); ?>"
                                            class="img-fluid" alt="Responsive image" width="150"></td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/galery/hapus/<?= $hasil['id']; ?>"
                                            class="badge badge-danger delete-people tombol-hapus"><i
                                                class="fa fa-trash"></i> Hapus</a>
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
        <form action="<?= base_url('admin/galery/tambah'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Galery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="form-group">
                        <label for="filebg">Upload File</label>
                        <input type="file" class="form-control" name="filegalery" required autocomplete="off">
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