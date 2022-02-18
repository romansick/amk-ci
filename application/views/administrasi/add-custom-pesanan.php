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
                            <div class="card-body">
                                <div class="basic-form custom_file_input">
                                    <form action="<?= base_url('administrasi/add_pesanan_custom/') . $transaksi['id']; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <input type="number" name="qty" class="form-control form-control-sm" placeholder="Jumlah">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <textarea type="text" name="data_custom" class="form-control form-control-sm" placeholder="Deskripsi"></textarea>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <input type="text" name="harga_custom" class="form-control form-control-sm" placeholder="Harga Per Item">
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
    </div>
</div>
<!--**********************************
            Content body end
        ***********************************-->