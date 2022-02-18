<!--**********************************
            Content body start
        ***********************************-->
<?php
$query = "SELECT * FROM  `user_menu`";
$menu =  $this->db->query($query)->result_array();
?>
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="<?= base_url('menu/edit/') . $sub['id']; ?>" method="post">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Menu</label>
                                    <div class="col-sm-10">
                                        <select class="form-control default-select " required name="menu_id">
                                            <?php foreach ($menu as $m) : ?>
                                                <?php if ($sub['menu_id'] == $m['id']) : ?>
                                                    <option value="<?= $m['id'] ?>" selected><?= $m['menu'] ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>\
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $sub['judul']; ?>" name="judul" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Url</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $sub['url']; ?>" name="url" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Icon</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $sub['icon']; ?>" name="icon" required>
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
<!--**********************************
            Content body end
        ***********************************-->