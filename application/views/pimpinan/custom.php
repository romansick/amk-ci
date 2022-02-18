<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Administrator</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $title; ?></a></li>
            </ol>
        </div>
        <!-- row -->

        <div class="d-flex justify-content-between pb-3">
            <div></div>
            <a href="<?= base_url('administrator/addcustom'); ?>" type="button" class="btn btn-rounded btn-info"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                </span>Add
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <?= $this->session->flashdata('message'); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <thead>
                                    <th>No</th>
                                    <th>Custom</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($custom as $c) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td> <?= $c['custom']; ?></td>
                                            <td class="col-lg-3"> <?= $c['deskripsi']; ?></td>

                                            <td>
                                                <div id="lightgallery" class="row">
                                                    <a href="<?= base_url('custom/') . $c['image']; ?>" data-exthumbimage="<?= base_url('custom/') . $c['image']; ?>" data-src="<?= base_url('custom/') . $c['image']; ?>" class="img-fluid">
                                                        <img src="<?= base_url('custom/') . $c['image']; ?>" style="width:100px; height: 100px;" />
                                                    </a>
                                                </div>
                                            </td>
                                            <td> <?= $c['harga']; ?></td>
                                            <td>
                                                <?php if ($c['is_active'] == 1) : ?>
                                                    <a href="<?= base_url('administrator/inactive_custom/') . $c['id']; ?>" class="badge badge-rounded badge-success">Aktif</a>
                                                <?php else : ?>
                                                    <a href="<?= base_url('administrator/active_custom/') . $c['id']; ?>" class="badge badge-rounded badge-danger">Tidak Aktif</a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('administrator/editcustom/') . $c['id']; ?>" type=" button" class="btn btn-warning btn-sm">Edit <span class="btn-icon-right"><i class="fa fa-edit"></i></span>
                                                </a>

                                                <a href="<?= base_url('administrator/deletecustom/') . $c['id']; ?>" type="button" class="btn btn-danger btn-sm ml-3" onclick="return confirm('Data akan dihapus?')">Delete <span class="btn-icon-right"><i class="fa fa-trash"></i></span>
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