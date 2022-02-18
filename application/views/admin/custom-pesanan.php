 <?php
    $query = "SELECT * FROM `tipe_rumah` WHERE `id` = $transaksi[tipe_id]";
    $tipe = $this->db->query($query)->row_array();
    ?>

 <?php
    $query = "SELECT * FROM `lokasi_rumah` WHERE `id` = $transaksi[lokasi_id]";
    $lokasi = $this->db->query($query)->row_array();
    ?>
 <div class="content-body">

     <div class="container-fluid">

         <div class="row">
             <div class="col-12">
                 <a href="<?= base_url('administrator/transaksi'); ?>" type="button" class="btn btn-info mb-3">
                     << Kembali </a>
                         <div class="card">
                             <div class="card-header">
                                 <h4 class="card-title"><?= $tipe['nama_tipe'] ?>, Blok <?= $transaksi['blok']; ?>, Nomor <?= $transaksi['nomor']; ?>, <?= $lokasi['lokasi']; ?></h4>
                                 <a href="<?= base_url('administrator/add_pesanan_custom/') . $transaksi['id']; ?>" type="button" class="btn btn-primary">+ Tambah</a>
                             </div>
                             <div class="card-body">
                                 <div class="table-responsive">
                                     <table id="example3" class="display min-w850">
                                         <thead>
                                             <tr>
                                                 <th>Custom</th>
                                                 <th>Harga</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php foreach ($custom as $c) : ?>
                                                 <?php if (is_null($c['transaksi_id'])) { ?>
                                                     Data tidak ditemukan
                                                 <?php } else { ?>
                                                     <tr>
                                                         <td><?= $c['data_custom']; ?></td>
                                                         <td><?= $c['harga_custom']; ?></td>

                                                     </tr>
                                                 <?php } ?>
                                             <?php endforeach; ?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                         </div>
             </div>
         </div>
     </div>
 </div>
 <!--**********************************
            Content body end
        ***********************************-->