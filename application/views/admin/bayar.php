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
             <div class="col-lg-12">

                 <div class="card">
                     <div class="card-header"> Invoice
                         <span class="float-right">
                             <strong>Status:</strong>
                             <?php if ($transaksi['status_pembayaran'] == 0) { ?>
                                 <span class="badge badge-warning">UNPAID</span>
                             <?php } else { ?>
                                 <span class="badge badge-success">PAID</span>
                             <?php } ?>
                         </span>
                     </div>
                     <div class="card-body">
                         <div class="row mb-5">
                             <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                 <h6>Data Konsumen:</h6>
                                 <div> <strong><?= $transaksi['username']; ?></strong> </div>
                                 <div>Email: <?= $transaksi['email']; ?></div>
                                 <div>Phone: <?= $transaksi['no_hp']; ?></div>
                             </div>
                             <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                             </div>
                             <div class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
                                 <div class="row align-items-center">
                                     <div class="col-sm-9">
                                         <div class="brand-logo mb-3">

                                             <img class="logo-abbr mr-2" src="<?= base_url('/rumah/') . $tipe['image']; ?>" alt="" style="width: 100px;">
                                         </div>
                                         <span>
                                             <strong><?= $tipe['nama_tipe'] ?>, Blok <?= $transaksi['blok']; ?>, Nomor <?= $transaksi['nomor']; ?>, <?= $lokasi['lokasi']; ?></strong></span><br>

                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="table-responsive">
                             <table class="table table-striped">
                                 <thead>
                                     <tr>
                                         <th>Lokasi Rumah</th>
                                         <th class="right">Harga</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td class="left"><?= $tipe['nama_tipe'] ?>, Blok <?= $transaksi['blok']; ?>, Nomor <?= $transaksi['nomor']; ?>, <?= $lokasi['lokasi']; ?></td>
                                         <td class="right">Rp <?= $transaksi['harga']; ?></td>
                                     </tr>

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

 <!--  -->