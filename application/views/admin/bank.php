<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Menu</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $title; ?></a></li>
            </ol>
        </div>
        <!-- row -->

        <div class="d-flex justify-content-between pb-3">
            <div></div>
            <button type="button" data-toggle="modal" data-target="#basicModal" class="btn btn-rounded btn-info"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                </span>Add
            </button>
        </div>
        <div class="row">
            <div class="col-12">
                <?= $this->session->flashdata('message'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Basic Datatable</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <thead>
                                    <th>No</th>
                                    <th>Nama Bank</th>
                                    <th>Nomor Rekening</th>
                                    <th>Pemilik</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($bank as $b) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td> <?= $b['nama_bank']; ?></td>
                                            <td> <?= $b['no_rek']; ?></td>
                                            <td> <?= $b['pemilik']; ?></td>
                                            <td>
                                                <a href="<?= base_url('administrator/editbank/') .  $b['id']; ?>" type="button" class="btn btn-warning btn-sm">Edit <span class="btn-icon-right"><i class="fa fa-edit"></i></span>
                                                </a>

                                                <a href="<?= base_url('administrator/deletebank/') . $b['id']; ?>" type="button" class="btn btn-danger btn-sm ml-3" onclick="return confirm('Data akan dihapus?')">Delete <span class="btn-icon-right"><i class="fa fa-trash"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Menu</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
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
                <h5 class="modal-title">Add Bank</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="<?= base_url('administrator/bank'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control input-default " name="nama_bank" required placeholder="Nama Bank">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-default " name="no_rek" required placeholder="Nomor Rekening">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-default " name="pemilik" required placeholder="Nama Pemilik">
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