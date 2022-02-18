<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="<?= base_url('administrator/addhouse/') . $lokasi['id']; ?>" method="post">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Lokasi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $lokasi['lokasi']; ?>" readonly>
                                        <input type="hidden" value<?= $lokasi['id']; ?> name="lokasi_id">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tipe Rumah</label>
                                    <div class="col-sm-10">
                                        <select class="form-control default-select " name="tipe_id">
                                            <option>Pilih Tipe</option>
                                            <?php foreach ($tipe as $r) : ?>
                                                <option value="<?= $r['id']; ?>"><?= $r['nama_tipe']; ?></option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Harga</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Harga Rumah" name="harga">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Blok</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Blok Rumah" name="blok">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nomor</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Nomor Rumah" name="nomor">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
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