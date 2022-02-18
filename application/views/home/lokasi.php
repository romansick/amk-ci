<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">

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
                                                <a type="button" href="<?= base_url('home/listrumah/') . $l['id']; ?>" class="btn btn-info btn-sm mr-3">List Rumah <span class="btn-icon-right"><i class="fa fa-home"></i></span>
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