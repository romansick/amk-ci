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
                                    <form action="<?= base_url('administrator/addcustom'); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <input type="text" name="custom" class="form-control form-control-sm" placeholder="Custom">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <textarea type="text" name="deskripsi" class="form-control form-control-sm" placeholder="Deskripsi"></textarea>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image" id="image">
                                                <label class="custom-file-label">Gambar</label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <input type="text" name="harga" class="form-control form-control-sm" placeholder="Harga">
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

<script src="<?= base_url('assets/js/jquery-3.6.0.js'); ?>"></script>
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>