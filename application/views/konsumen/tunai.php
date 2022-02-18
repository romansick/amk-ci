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

             <div class="col-xl-12">
                 <div class="card text-white bg-primary">
                     <div class="card-header">
                         <h5 class="card-title text-white">Daftar Bank</h5>
                     </div>
                     <div class="card-body mb-0">
                         <p class="card-text">Silahkan lakukan pembayaran <strong>DP</strong> pada salah satu bank yang tersedia pada daftar berikut.</p>
                         <div class="basic-list-group">
                             <ul class="list-group">
                                 <?php foreach ($bank as $b) : ?>
                                     <li class="list-group-item"><?= $b['no_rek']; ?> - <?= $b['nama_bank']; ?> - a.n <?= $b['pemilik']; ?></li>
                                 <?php endforeach; ?>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-12 col-lg-12">
                 <div class="card">
                     <div class="card-header">
                         <h4 class="card-title">Upload Bukti Pembayaran <strong>DP</strong></h4>
                     </div>
                     <div class="card-body">
                         <span class="mb-3">Silahkan upload bukti pembayaran anda.</li>
                             <div class="basic-form">
                                 <form action="<?= base_url('konsumen/save_dp_tunai/') . $transaksi['id']; ?>" method="post" enctype="multipart/form-data">
                                     <div class="input-group">
                                         <div class="custom-file">
                                             <input type="file" class="custom-file-input" name="image" id="image">
                                             <label class="custom-file-label">Choose file</label>
                                         </div>

                                     </div>
                                     <button type="submit" class="btn btn-primary my-3">Save</button>
                                 </form>
                             </div>
                     </div>
                 </div>
             </div>

         </div>
     </div>
 </div>

 <script src="<?= base_url('assets/js/jquery-3.6.0.js'); ?>"></script>
 <script>
     $('.custom-file-input').on('change', function() {
         let fileName = $(this).val().split('\\').pop();
         $(this).next('.custom-file-label').addClass("selected").html(fileName);
     });
 </script>

 <!--**********************************
            Content body end
        ***********************************-->

 <!--  -->