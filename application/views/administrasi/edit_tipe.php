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
                            <form action="<?= base_url('administrasi/edittipe/') . $tipe['id']; ?>" method="post">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Tipe </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $tipe['nama_tipe']; ?>" name="nama_tipe" placeholderrequired>

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