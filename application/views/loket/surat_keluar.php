<div class="content" data-color="green" data-background-color="white" data-image="<?= base_url(); ?>assets/img/sidebar-2.jpg">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg">
                <div class="content">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header card-header-success">
                                <h3 class="card-title"><?= $title ?></h3>
                            </div>
                            <div class="card-body">
                                <?= form_error('surat', '<div class="text-danger" surat="alert">', '</div>'); ?>
                                <?= $this->session->flashdata('message'); ?>
                                <?php if ($this->session->flashdata('success') == TRUE) : ?>
                                    <div class="alert alert-success">
                                        <span><?= $this->session->flashdata('success'); ?></span>
                                    </div>
                                <?php endif; ?>
                                <!-- <a href="" class="btn btn-success" data-toggle="modal" data-target="#newsuratModal">Tambah Surat</a> -->
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="myTable">
                                                <thead class="text-success">

                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">Nomor Surat</th>
                                                        <th scope="col">Nama </th>
                                                        <th scope="col">Surat</th>
                                                        <th scope="col">Tanggal</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Keterangan</th>
                                                        <th scope="col">File</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($surat_keluar as $s) : ?>
                                                        <tr>
                                                            <th scope="row"><?= $i ?></th>
                                                            <td><?= $s['no_surat']; ?></td>
                                                            <td><?= $s['nm_surat_keluar']; ?></td>
                                                            <td><?= $s['nm_surat']; ?></td>
                                                            <td><?= $s['tgl']; ?></td>
                                                            <td class="font-weight-bold"><?= $status[$s['status']]; ?></td>
                                                            <td><?= $s['keterangan']; ?></td>
                                                            <td>
                                                                <button class="btn btn-simple btn-info btn-sm" data-toggle="modal" data-target="#lihatSurat<?= $s['id']; ?>"><i class="material-icons">remove_red_eye</i></button>
                                                            </td>
                                                            <td>
                                                                <a href="<?= base_url('upload/surat_keluar/') . $s['file'] ?>" class="btn btn-success btn-sm" target="blank">Cetak </a>
                                                            </td>
                                                            <?php $i++; ?>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




<?php foreach ($surat_keluar as $s) : ?>
    <div class="modal fade" id="lihatSurat<?= $s['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-notice">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                    <h5 class="modal-title text-center" id="myModalLabel">Surat Keluar</h5>
                </div>
                <div class="modal-body">
                    <div class="instruction">
                        <div class="row">
                            <div class="col-md-12">
                                <embed type="application/pdf" width="100%" height="450px;" src="<?= base_url('upload/surat_keluar') ?>/<?= $s['file'] ?>"></embed>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-info btn-round" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</body>