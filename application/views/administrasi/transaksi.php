<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <?= $this->session->flashdata('message'); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <thead>
                                    <th>No</th>
                                    <th>Tipe Rumah</th>
                                    <th>Lokasi</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Tanggal Pemesanan</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Custom</th>
                                    <th>Status Pembayaran</th>
                                    <th>Pembayaran</th>
                                    <th>Bayar</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($transaksi as $t) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <?php
                                            $query = "SELECT * FROM `tipe_rumah` WHERE `id` = $t[tipe_id]";
                                            $tipe = $this->db->query($query)->row_array();
                                            ?>

                                            <td><?= $tipe['nama_tipe'] ?>, Blok <?= $t['blok']; ?>, Nomor <?= $t['nomor']; ?></td>

                                            <?php
                                            $query = "SELECT * FROM `lokasi_rumah` WHERE `id` = $t[lokasi_id]";
                                            $lokasi = $this->db->query($query)->row_array();
                                            ?>
                                            <td><?= $lokasi['lokasi']; ?></td>

                                            <td>
                                                <?php if (is_null($t['image'])) : ?>
                                                    <p>Pembayaran tidak ditemukan</p>
                                                <?php else : ?>
                                                    <div id="lightgallery" class="row">
                                                        <a href="<?= base_url('/tunai/') . $t['image']; ?>" data-exthumbimage="<?= base_url('/tunai/') . $t['image']; ?>" data-src="<?= base_url('/tunai/') . $t['image']; ?>" class="img-fluid">
                                                            <img src="<?= base_url('/tunai/') . $t['image']; ?>" style="width:100%;" />
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </td>

                                            <td> <?= $t['tanggal_pemesanan']; ?></td>
                                            <td>
                                                <?php if (is_null($t['tanggal_pembayaran'])) { ?>
                                                    <p>Data tidak ditemukan, silahkan selesaikan pembayaran</p>
                                                <?php } else { ?>
                                                    <?= $t['tanggal_pembayaran']; ?>
                                                <?php } ?>
                                            </td>

                                            <td>
                                                <a href="<?= base_url('administrasi/custom_pesanan/') . $t['id']; ?> " type="button" class="btn btn-primary btn-sm">+Custom</a>

                                            </td>

                                            <td>
                                                <?php if ($t['status_pembayaran'] == 0) { ?>
                                                    <span class="badge badge-danger">UNPAID</span>
                                                <?php } else if ($t['status_pembayaran'] == 1) { ?>

                                                    <?php if ($t['metode_bayar'] == 'KPR') { ?>
                                                        <span class="badge badge-success">PAID - KPR</span>
                                                    <?php } else if ($t['metode_bayar'] == 'TUNAI') { ?>
                                                        <span class="badge badge-success">PAID - TUNAI </span>
                                                    <?php } ?>

                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($t['status'] == 0) { ?>

                                                    <span class="badge badge-warning">Belum Dikonfirmasi</span>

                                                <?php } else if ($t['status'] == 1) { ?>
                                                    <span class="badge badge-success">Sudah Dikonfirmasi</span>

                                                <?php } else if ($t['status'] == 2) { ?>
                                                    <span class="badge badge-danger">Pembayaran Ditolak</span>
                                                <?php  } ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('administrasi/cetak/') . $t['id']; ?>" target="_blank" type="button" class="btn btn-sm btn-primary"> <i class="fa fa-print"></i> Print
                                                </a>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>