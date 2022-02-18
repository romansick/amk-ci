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
                </span>Add</button>
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
                                    <th>Judul</th>
                                    <th>Menu</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($submenu as $sm) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td> <?= $sm['judul']; ?></td>
                                            <td> <?= $sm['menu']; ?></td>
                                            <td>
                                                <?php if ($sm['is_active'] == 1) : ?>
                                                    <a href="<?= base_url('menu/offsubmenu/') . $sm['id']; ?>" class="badge badge-pill badge-success">Active</a>
                                                <?php else : ?>
                                                    <a href="<?= base_url('menu/onsubmenu/') . $sm['id']; ?>" class="badge badge-pill badge-danger">Non Active</a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('menu/edit/') . $sm['id']; ?>" type="button" class="btn btn-warning btn-sm">Edit <span class="btn-icon-right"><i class="fa fa-edit"></i></span>
                                                </a>

                                                <a href="<?= base_url('menu/deletesub/') . $sm['id']; ?>" type="button" class="btn btn-danger btn-sm ml-3">Delete <span class="btn-icon-right"><i class="fa fa-trash"></i></span>
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
                <h5 class="modal-title">Add Menu</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control input-default " name="judul" required placeholder="JUDUL">
                    </div>

                    <div class="form-group">
                        <select class="form-control select2" name="menu_id" required>
                            <option>Select</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control input-default " name="url" required placeholder="URL">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control input-default " name="icon" required placeholder="ICON">
                    </div>

                    <div class="custom-control custom-checkbox mb-3 checkbox-success">
                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked>
                        <label class="custom-control-label" for="is_active">Aktif</label>

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