<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">

            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-danger">
                    <div class="card-body  p-4">
                        <div class="media">
                            <span class="mr-3">
                                <i class="flaticon-381-user-7"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">Konsumen</p>
                                <h3 class="text-white"><?= $konsumen; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-success">
                    <div class="card-body p-4">
                        <div class="media">
                            <span class="mr-3">
                                <i class="flaticon-381-user-7"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">Karyawan</p>
                                <h3 class="text-white"><?= $karyawan; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <div class="widget-stat card bg-info">
                    <div class="card-body p-4">
                        <div class="media">
                            <span class="mr-3">
                                <i class="flaticon-381-user-7"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">Total Transaksi</p>
                                <h3 class="text-white"><?= $transaksi; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card text-white bg-success">
                    <div class="card-header">
                        <h5 class="card-title text-white">Selamat datang, <?= $user['username']; ?></h5>
                    </div>
                    <div class="card-body mb-0">
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--**********************************
            Content body end
        ***********************************-->