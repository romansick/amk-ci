<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-7 order-md-1">
                                        <form class="needs-validation" novalidate="" action="<?= base_url('konsumen/makeinvoice'); ?>" method="POST">
                                            <div class="mb-3">
                                                <label for="email">Nama Konsumen </label>
                                                <input type="email" class="form-control" id="email" placeholder="Nama Konsumen" style="color: black; background-color: gray; cursor: not-allowed;" value="<?= $user['username']; ?>" readonly>
                                                <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                                                <input type="hidden" name="rumah_id" value="<?= $rumah['id']; ?>">

                                            </div>

                                            <div class="mb-3">
                                                <label for="address">No Hp/Wa</label>
                                                <input type="text" class="form-control" id="address" placeholder="Nomor Hp/WA" readonly style="color: black; background-color: gray; cursor: not-allowed;" value="<?= $user['no_hp']; ?>">
                                            </div>
                                            <hr class="mb-4">
                                            <div class="mb-3">
                                                <label for="address2">Lokasi Rumah </label>
                                                <input type="text" class="form-control" id="address2" placeholder="Lokasi Rumah" style="color: black; background-color: gray; cursor: not-allowed;" readonly value="<?= $rumah['lokasi']; ?>">
                                            </div>

                                            <div class="row">

                                                <div class="col-lg-6 col-md-12 mb-3">
                                                    <label for="zip">Blok</label>
                                                    <input type="text" class="form-control" id="zip" placeholder="Blok Rumah" value="<?= $rumah['blok']; ?>" style="color: black; background-color: gray; cursor: not-allowed;" readonly>

                                                </div>
                                                <div class="col-lg-6 col-md-12 mb-3">
                                                    <label for="zip">Nomor Rumah</label>
                                                    <input type="text" class="form-control" id="zip" placeholder="Nomor Rumah" value="<?= $rumah['nomor']; ?>" style="color: black; background-color: gray; cursor: not-allowed;" readonly>

                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-3">
                                                    <label for="address2">Harga Rumah </label>
                                                    <input type="text" class="form-control" id="address2" placeholder="Harga Rumah" style="color: black; background-color: gray; cursor: not-allowed;" readonly value="<?= $rumah['harga']; ?>">
                                                </div>

                                            </div>
                                            <hr class="mb-4">

                                            <button class="btn btn-primary btn-lg btn-block" onclick="return confirm('Lanjutkan Pembayaran?')" type="submit">Lanjutkan Pembayaran</button>
                                        </form>
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
<!--**********************************
            Content body end
        ***********************************-->