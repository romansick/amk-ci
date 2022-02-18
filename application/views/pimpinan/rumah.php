 <!--**********************************
            Content body start
        ***********************************-->
 <div class="content-body">
     <div class="container-fluid">
         <div class="page-titles">
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                 <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
             </ol>
         </div>
         <!-- row -->


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
                                     <th>No</th>
                                     <th>Tipe</th>
                                     <th>Image</th>
                                 </thead>
                                 <tbody>
                                     <?php $i = 1;
                                        foreach ($tipe as $t) : ?>
                                         <tr>
                                             <td><?= $i; ?></td>
                                             <td><?= $t['nama_tipe']; ?></td>
                                             <td><img src="<?= base_url('rumah/') . $t['image']; ?>" class="mr-3 rounded" width="75"></td>

                                         </tr>
                                     <?php $i++;
                                        endforeach; ?>
                                 </tbody>
                                 <tfoot>
                                     <tr>
                                         <th>No</th>
                                         <th>Tipe</th>
                                         <th>Image</th>
                                     </tr>
                                 </tfoot>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-12">
                 <div class="card">
                     <div class="card-header">
                         <h4 class="card-title">Datatable</h4>
                     </div>
                     <div class="card-body">
                         <div class="table-responsive">
                             <table id="example2" class="display ">
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
                                                 <a type="button" href="<?= base_url('pimpinan/listrumah/') . $l['id']; ?>" class="btn btn-info btn-sm mr-3">List Rumah <span class="btn-icon-right"><i class="fa fa-home"></i></span>
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
 <!--**********************************
            Content body end
        ***********************************-->


 <!--**********************************
            Content body end
        ***********************************-->