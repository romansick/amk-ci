<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Konsumen</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $title; ?></a></li>
            </ol>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
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
                                        <th>Total</th>
                                        <th>Tersedia</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($lokasi as $l) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td> <?= $l['lokasi']; ?></td>

                                            <td rowspan="1">
                                                <span class="badge badge-rounded badge-info">Total: 0</span>

                                            </td>
                                            <td rowspan="1">
                                                <span class="badge badge-rounded badge-primary">Tersedia: 0</span>
                                            </td>

                                            <td>
                                                <a type="button" href="<?= base_url('konsumen/datalist/') . $l['id']; ?>" class="btn btn-info btn-sm mr-3">List Rumah <span class="btn-icon-right"><i class="fa fa-home"></i></span>
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
            <form action="<?= base_url('administrator/lokasi'); ?>" method="post">
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