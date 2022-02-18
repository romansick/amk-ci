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
                                <i class="flaticon-381-calendar-1"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">Total</p>
                                <h3 class="text-white"><?= $total; ?></h3>

                                <?php var_dump($total); ?>
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
                                <i class="flaticon-381-diamond"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">Tersedia</p>
                                <h3 class="text-white"><?= $tersedia; ?></h3>
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
                                <i class="flaticon-381-heart"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">Terjual</p>
                                <h3 class="text-white"><?= $terjual; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Column starts -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Default accordion -->
                        <div id="accordion-one" class="accordion accordion-primary">
                            <div class="accordion__item">
                                <div class="accordion__header rounded-lg" data-toggle="collapse" data-target="#default_collapseOne">
                                    <span class="accordion__header--text"><?= $lokasi['lokasi']; ?></span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="default_collapseOne" class="collapse accordion__body show" data-parent="#accordion-one">
                                    <div class="accordion__body--text">
                                        <div class="d-flex justify-content-between pb-3">
                                            <div></div>
                                            <a href="<?= base_url('administrasi/addhouse/') .  $lokasi['id']; ?>" type="button" class="btn btn-rounded btn-info"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                                                </span>Tambah Rumah
                                            </a>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="example" class="display min-w850">
                                                <thead>
                                                    <th>No</th>
                                                    <th>Tipe</th>
                                                    <th>Status</th>
                                                    <th>Blok</th>
                                                    <th>Nomor</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1;
                                                    foreach ($rumah as $r) : ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td> <?= $r['nama_tipe']; ?></td>
                                                            <td>
                                                                <?php if ($r['status'] == 'AVAILABLE') { ?>
                                                                    <span class="badge badge-pill badge-success "><?= $r['status']; ?></span>
                                                                <?php } else if ($r['status'] == 'NOT AVAILABLE') { ?>
                                                                    <span class="badge badge-pill badge-dark ">Telah Dibooking</span>
                                                                <?php } ?>
                                                            </td>
                                                            <td>H</td>
                                                            <td>2</td>
                                                            </td>
                                                            <td><?= $r['harga']; ?></td>
                                                            <td>

                                                                <a href="<?= base_url('administrasi/galleri/') . $r['id']; ?>" type="button" class="btn btn-info btn-sm mr-3">Gallery <span class="btn-icon-right"><i class="fa fa-edit"></i></span>
                                                                </a>

                                                                <a href="<?= base_url('administrasi/editrumah/') . $r['id']; ?>" type="button" class="btn btn-warning btn-sm">Edit <span class="btn-icon-right"><i class="fa fa-edit"></i></span>
                                                                </a>

                                                                <a href="#" type="button" class="btn btn-danger btn-sm ml-3">Delete <span class="btn-icon-right"><i class="fa fa-trash"></i></span>
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
            </div>
            <!-- Column ends -->
        </div>

        <div class="row">
            <?php foreach ($list as $r) : ?>
                <div class="col-xl-3 col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="social-graph-wrapper bg-success">
                            <?= $r['nama_tipe']; ?>
                        </div>
                        <div class="row">
                            <div class="col ">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    <img src="<?= base_url('rumah/') . $r['image']; ?>" class="img-fluid" alt="">
                                    <h4 class="m-1"><span class="counter"><?= $r['harga']; ?></h4>
                                </div>
                            </div>

                        </div>
                        <?php if ($r['status'] == 'AVAILABLE') { ?>
                            <a href="javascript:void()" class="badge badge-rounded badge-primary"><?= $r['status']; ?></a>
                        <?php } else if ($r['status'] == 'NOT AVAILABLE') { ?>
                            <a href="javascript:void()" class="badge badge-rounded badge-dark"><?= $r['status']; ?></a>
                        <?php } ?>
                        <a href="<?= base_url('administrasi/detail/') . $r['id']; ?>" type="button" class="btn btn-info btn-sm mt-3">Detail
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!--**********************************
            Content body end
        ***********************************-->