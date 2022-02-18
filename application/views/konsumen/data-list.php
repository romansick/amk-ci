<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">


        <div class="row">
            <?php foreach ($list as $r) : ?>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="new-arrival-product">
                                <div class="new-arrivals-img-contnent">
                                    <img class="img-fluid" src="<?= base_url('rumah/') . $r['image']; ?>" alt="">
                                </div>
                                <div class="new-arrival-content text-center mt-3">

                                    <?php if ($r['status'] == "NOT AVAILABLE") : ?>
                                        <button type="button" class="btn btn-rounded btn-dark"><?= $r['status']; ?></button>
                                    <?php else : ?>
                                        <h4><a href="<?= base_url('konsumen/detail/') . $r['id']; ?>" class="btn tp-btn-light btn-primary"><?= $r['nama_tipe']; ?></a></h4>
                                        <span class="price"><?= $r['harga']; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!--**********************************
            Content body end
***********************************-->