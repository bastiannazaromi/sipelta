<section class="content">

    <div class="row">
        <div class="col-md-12 mb-4">
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
                                    <td>
                                        <a href="<?= base_url('assets/uploads/' . $hasil['berkas'] . '/' . $hasil['judul']); ?>"
                                            target="_blank"><?= $hasil['judul']; ?></a>
                                    </td>
                                    <td>
                                        <?php if ($hasil['judul'] != null) : ?>
                                        <?= $hasil['status'] ; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>