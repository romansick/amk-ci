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
                            <form action="<?= base_url('administrator/editrumah/') . $rumah['id']; ?>" method="post">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Lokasi Rumah</label>
                                    <div class="col-sm-10">
                                        <select class="form-control default-select " name="lokasi_id">
                                            <?php foreach ($lokasi as $l) : ?>
                                                <?php if ($rumah['lokasi_id'] == $l['id']) : ?>
                                                    <option value="<?= $l['id']; ?>" selected><?= $l['lokasi']; ?></option>
                                                <?php else : ?>
                                                    <option>Pilih Lokasi</option>
                                                    <option value="<?= $l['id']; ?>"><?= $l['lokasi']; ?></option>
                                                <?php endif; ?>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tipe Rumah</label>
                                    <div class="col-sm-10">
                                        <select class="form-control default-select " name="tipe_id">
                                            <?php foreach ($tipe as $r) : ?>
                                                <?php if ($rumah['tipe_id'] == $r['id']) : ?>
                                                    <option value="<?= $r['id']; ?>" selected><?= $r['nama_tipe']; ?></option>
                                                <?php else : ?>
                                                    <option>Pilih Tipe</option>
                                                    <option value="<?= $r['id']; ?>"><?= $r['nama_tipe']; ?></option>
                                                <?php endif; ?>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Blok </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $rumah['blok']; ?>" name="blok" placeholderrequired>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nomor Rumah</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $rumah['nomor']; ?>" name="nomor" placeholderrequired>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Harga Rumah</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $rumah['harga']; ?>" name="harga" placeholderrequired>

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