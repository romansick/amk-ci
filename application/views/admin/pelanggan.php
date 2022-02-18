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
                                <table id="example" class="display min-w850">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Hp</th>
                                        <th>Active</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($konsumen as $k) : ?>
                                            <tr>
                                                <td>1</td>
                                                <td><?= $k['username']; ?></td>
                                                <td><?= $k['email']; ?></td>
                                                <td><?= $k['no_hp']; ?></td>
                                                <td>
                                                    <?php if ($k['is_active'] == 1) : ?>
                                                        <a href="<?= base_url('administrator/nonactive/') . $k['id'] ?>" type="button" class="badge badge-rounded badge-success">Active</a>
                                                    <?php else : ?>
                                                        <a href="<?= base_url('administrator/active/') . $k['id'] ?>" type="button" class="badge badge-rounded badge-danger">Non Active</a>

                                                    <?php endif; ?>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
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