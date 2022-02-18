<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Administrator</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Detail</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6  col-md-6 col-xxl-5 ">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade show active" id="first">
                                        <img class="img-fluid" src="<?= base_url('rumah/') . $rumah['image']; ?>" alt="">
                                    </div>

                                </div>

                            </div>
                            <!--Tab slider End-->
                            <div class="col-xl-9 col-lg-6  col-md-6 col-xxl-7 col-sm-12">
                                <div class="product-detail-content">
                                    <!--Product details-->
                                    <div class="new-arrival-content pr">
                                        <h4><?= $rumah['nama_tipe']; ?></h4>

                                        <div class="d-table mb-2">
                                            <p class="price float-left d-block">IDR <?= $rumah['harga']; ?></p>
                                        </div>
                                        <p>Lokasi: <span class="item"> <?= $rumah['lokasi']; ?> </span>
                                        </p>
                                        <p class="text-content">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                            If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing.</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Gallery</h4>
                                    </div>
                                    <div class="card-body pb-1">
                                        <div id="lightgallery" class="row">
                                            <?php foreach ($galleri as $g) : ?>
                                                <a href="<?= base_url('rumah/') . $g['image']; ?>" data-exthumbimage="<?= base_url('rumah/') . $g['image']; ?>" data-src="<?= base_url('rumah/') . $g['image']; ?>" class="col-lg-3 col-md-6 mb-4">
                                                    <img src="<?= base_url('rumah/') . $g['image']; ?>" style="width:100%;" />
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- /# card -->
                            </div>
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