<style>
.dataTables_filter{
display:block;
float:right;
}
 </style>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active">List Supplier</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content" data-url="<?=base_url('c_transaksi')?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10" style="padding-bottom: 1%">

            </div>
            <div class="col-md-2" style="padding-bottom: 1%">
                <a href="<?=site_url('c_transaksi/insert_supplier') ?>" type="button" class="btn btn-block" value="Tambah"  style="font-size: 11px; background-color: #36454F;color: white;"><i class="fa-solid fa-plus"></i> &nbsp;Add Data</a>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #36454F;" >
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">    
                        <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-sm text-nowrap">
                                    <thead>
                                      <tr>
                                          <th class="all">No</th>
                                          <th>Supplier Code</th>
                                          <th>Supplier Name</th>
                                          <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    <?php 
                                      $no = 1;
                                      foreach( $supplier as $u) { 
                                        ?>
                                      <tr>
                                        <td> <?= $no++ ?></td>
                                        <td><?= $u->supplier_code?> </td>
                                        <td><?= $u->supplier_name?></td>
                                        <td>
                                          <a href="<?=site_url('c_transaksi/edit_supplier/').$u->id_supplier?>" class="btn btn-sm" style="font-size: 11px; background-color: #36454F;color: white;"><i class="fa fa-edit"></i></a>
                                          <a href="<?=site_url('c_transaksi/delete_supplier/').$u->id_supplier?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?php echo $u->supplier_name?>?');"class="btn btn-sm remove" style="font-size: 11px; background-color: #36454F;color: white;"><i class="fa fa-trash"></i></a>
                                        </td>
                                      </tr>
                                      <?php } ?>
                                    </tbody>
                                  </table>
                                
                              </div>
                            </div>
                        </div>        	
                    </div>
                  </div>
            </div>
        </div>
    </div>
</section>