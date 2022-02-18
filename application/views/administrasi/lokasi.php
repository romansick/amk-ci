<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">

        <!-- row -->

        <div class="d-flex justify-content-between pb-3">
            <div></div>
            <button type="button" data-toggle="modal" data-target="#basicModal" class="btn btn-rounded btn-info"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                </span>Add</button>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Basic Datatable</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th colspan="5" style="text-align: center;">Rumah</th>
                                    </tr>
                                    <tr>
                                        <th>Lokasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($lokasi as $l) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td> <?= $l['lokasi']; ?></td>



                                            <td>
                                                <a type="button" href="<?= base_url('administrasi/listrumah/') . $l['id']; ?>" class="btn btn-info btn-sm mr-3">List Rumah <span class="btn-icon-right"><i class="fa fa-home"></i></span>
                                                </a>
                                                <a href="<?= base_url('administrasi/edit_lokasi/') . $l['id']; ?>" type="button" class="btn btn-warning btn-sm">Edit <span class="btn-icon-right"><i class="fa fa-edit"></i></span>
                                                </a>
                                                <a href="<?= base_url('administrasi/delete_lokasi/') . $l['id']; ?>" type=" button" class="btn btn-danger btn-sm">Delete <span class="btn-icon-right"><i class="fa fa-trash"></i></span>
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


<!-- Modal -->
<div class="modal fade" id="basicModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Menu</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="<?= base_url('administrasi/rumah'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control input-default " name="lokasi" required placeholder="LOKASI">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--**********************************
            Content body end
***********************************-->