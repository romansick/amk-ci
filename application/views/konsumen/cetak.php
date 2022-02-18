 <?php
    $query = "SELECT * FROM `tipe_rumah` WHERE `id` = $transaksi[tipe_id]";
    $tipe = $this->db->query($query)->row_array();
    ?>

 <?php
    $query = "SELECT * FROM `lokasi_rumah` WHERE `id` = $transaksi[lokasi_id]";
    $lokasi = $this->db->query($query)->row_array();
    ?>
 <div class="row">
     <div class="col-lg-12">

         <div class="card">
             <div class="card-header"> Invoice
                 <span class="float-right">
                     <strong>Status:</strong>
                     <?php if ($transaksi['status_pembayaran'] == 0) { ?>
                         <span class="badge badge-warning">UNPAID</span>
                     <?php } else { ?>
                         <?php if ($transaksi['metode_bayar'] == 'KPR') { ?>
                             <span class="badge badge-success">PAID - KPR</span>
                         <?php } else if ($transaksi['metode_bayar'] == 'TUNAI') { ?>
                             <span class="badge badge-success">PAID - TUNAI </span>
                         <?php } ?>
                     <?php } ?>
                 </span>
             </div>
             <div class="card-body">
                 <div class="row mb-5">
                     <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                         <h6>Data Konsumen:</h6>
                         <div> <strong><?= $user['username']; ?></strong> </div>
                         <div>Email: <?= $user['email']; ?></div>
                         <div>Phone: <?= $user['no_hp']; ?></div>
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
                 <div class="table-responsive">
                     <table class="table table-striped">
                         <thead>
                             <tr>
                                 <th>Custom</th>
                                 <th class="right">Harga</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php foreach ($custom as $c) : ?>
                                 <?php if (empty($c['transaksi_id'])) { ?>
                                     <p></p>
                                 <?php } else { ?>
                                     <tr>
                                         <td class="left">Custom: <?= $c['data_custom']; ?>, jumlah <?= $c['qty']; ?>, harga per item: <?= $c['harga_custom']; ?></td>
                                         <?php $customPrice = $c['harga_custom'] * $c['qty']; ?>
                                         <td class="right">Rp <?= $customPrice; ?></td>
                                     </tr>
                                 <?php } ?>
                             <?php endforeach; ?>

                         </tbody>
                     </table>
                 </div>

             </div>


         </div>
     </div>
     <?php if ($transaksi['status_pembayaran'] == 0) : ?>
         <div class="col-xl-12 col-lg-12">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title">Pilih Metode Pembayaran</h4>
                 </div>
                 <div class="d-flex">
                     <div class="col-xl-6 col-lg-6">
                         <div class="card">
                             <div class="card-header pb-0 border-0">

                                 <div class="mr-auto pr-3">
                                     <h4 class="text-black fs-20">KPR</h4>
                                     <div class="card text-white bg-success">

                                         <div class="card-body mb-0">
                                             <p class="card-text">Klik tombol berikut untuk melanjutkan pembayaran secara KPR</p>
                                             <button class="btn  btn-light btn-lg">Bayar <span class="btn-icon-right"><i class="fa fa-arrow-right"></i></span>
                                             </button>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-xl-6 col-lg-6">
                         <div class="card">
                             <div class="card-header pb-0 border-0">
                                 <div class="mr-auto pr-3">
                                     <h4 class="text-black fs-20">TUNAI</h4>
                                     <div class="card text-white bg-info">
                                         <div class="card-body mb-0">
                                             <p class="card-text">Klik tombol berikut untuk melanjutkan pembayaran secara TUNAI</p>
                                             <a type="button" href="<?= base_url('konsumen/tunai/') . $transaksi['id']; ?>" class="btn  btn-light btn-lg">Bayar <span class="btn-icon-right"><i class="fa fa-arrow-right"></i></span>
                                             </a>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     <?php endif; ?>
 </div>

 <script>
     window.print();
 </script>

 <!--**********************************
            Content body end
        ***********************************-->

 <!--  -->