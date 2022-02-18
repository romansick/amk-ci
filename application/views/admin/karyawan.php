<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="col-12">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <button type="button" data-toggle="modal" data-target="#basicModal" class="btn btn-rounded btn-info float-right mb-3"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                                    </span>Add</button>
                                <table id="example" class="display min-w850">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Email</th>
                                        <th>No. HP</th>
                                        <th>Active</th>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($karyawan as $k) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $k['username']; ?></td>
                                                <th><?= $k['role']; ?></th>
                                                <td><?= $k['email']; ?></td>
                                                <td><?= $k['no_hp']; ?></td>
                                                <td>
                                                    <?php if ($k['is_active'] == 1) : ?>
                                                        <a href="<?= base_url('administrator/karyawan_nonactive/') . $k['id'] ?>" type="button" class="badge badge-rounded badge-success">Active</a>
                                                    <?php else : ?>

                                                        <a href="<?= base_url('administrator/karyawan_active/') . $k['id'] ?>" type="button" class="badge badge-rounded badge-danger">Non Active</a>
                                                    <?php endif; ?>
                                                    <a href="<?= base_url('administrator/karyawan_delete/') . $k['id'] ?>" type="button" class="badge badge-rounded badge-danger">Delete</a>
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
    <!--**********************************
            Content body end
        ***********************************-->


    <!-- Modal -->
    <div class="modal fade" id="basicModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Laryawan</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('administrator/register'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="mb-1 text-white"><strong>Jabatan</strong></label>
                            <select class="form-control" name="role_id">
                                <option>--Jabatan--</option>
                                <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mb-1 text-white"><strong>Username</strong></label>
                            <input type="text" class="form-control" placeholder="username" required id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label class="mb-1 text-white"><strong>Email</strong></label>
                            <input type="email" class="form-control" placeholder="hello@example.com" required id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label class="mb-1 text-white"><strong>Password</strong></label>
                            <input type="password" class="form-control" value="Password" required id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label class="mb-1 text-white"><strong>Phone Number</strong></label>
                            <input type="text" class="form-control" value="Phone Number" id="no_hp" name="no_hp">
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn bg-primary  btn-block">Sign me up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--**********************************
            Content body end
        ***********************************-->