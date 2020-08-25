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
                    </div>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Judul TA</th>
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
                                    <td><?= $hasil['judul']; ?></td>
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