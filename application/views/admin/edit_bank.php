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
                            <form action="<?= base_url('administrator/editbank/') . $bank['id']; ?>" method="post">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Bank</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $bank['nama_bank']; ?>" name="nama_bank" placeholderrequired>
                                        <input type="hidden" value<?= $bank['id']; ?> name="id">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nomor Rekening</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $bank['no_rek']; ?>" name="no_rek" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Pemilik</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $bank['pemilik']; ?>" name="pemilik" required>
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