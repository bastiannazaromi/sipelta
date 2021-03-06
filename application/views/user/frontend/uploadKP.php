<section class="content">

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Berkas</th>
                                    <th>Nama File</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($berkas as $hasil) : ?>
                                <tr>
                                    <th><?= $i++ ?></th>
                                    <td><?= $hasil['berkas']; ?></td>
                                    <td><?= $hasil['judul']; ?></td>
                                    <td>
                                        <div class="badge <?php echo $hasil['status'] == 'ACC' ? 'btn-success' : 'badge-danger'; ?>"
                                            role="alert">
                                            <?= $hasil['status']; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Upload Berkas</h3>
                </div>
                <div class="card-body ">
                    <form action="<?= base_url('user/dapur/uploadBerkas'); ?>" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                            value="<?php echo $this->security->get_csrf_hash(); ?>" id="csrf_login">

                        <div class="form-group">
                            <label for="lap_pdf">Laporan PDF <small class="text-dark">( Format : pdf || max : 10 MB
                                    )</small></label>
                            <input type="file" class="form-control" accept=".pdf" id="lap_pdf" name="lap_pdf"
                                autocomplete="off">
                            <small class="text-danger"><?= $this->session->flashdata('lap_pdf'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="pengesahan">Lembar Pengesahan <small class="text-dark">( Format :
                                    pdf | jpg | jpeg | png max : 5 MB
                                    )</small></label>
                            <input type="file" class="form-control" accept=".pdf, .png, .jpg, .jpeg" id="pengesahan"
                                name="pengesahan" autocomplete="off">
                            <small class="text-danger"><?= $this->session->flashdata('pengesahan'); ?></small>
                        </div>

                        <button type="submit" name="update" class="btn btn-primary btn-block">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>