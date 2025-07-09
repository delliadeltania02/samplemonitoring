<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active">List Applicant Information</li>
                </ol>
          </div>
        </div>
      </div>
</div>
<section class="content" id="content "data-url="<?= base_url('c_transaksi') ?>">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-10" style="padding-bottom: 1%;">
            
            </div>
            <div class="col-md-2" style="padding-bottom: 1%;">
              <a href="<?=site_url('c_transaksi/insert_email')?>" type="button" class="btn btn-block"  value="Tambah" style="font-size: 11px; background-color: #36454F;color: white;"><i class="fa-solid fa-plus"></i> &nbsp;Add Data</a>
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
                                          <th>Applicant</th>
                                          <th>Department</th>
                                          <th>Email</th>
                                          <th>No. Telepon</th>
                                          <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody id="myTable">
                                      <?php 
                                        $no = 1;
                                        foreach($department as $u) { ?> 
                                        <tr>
                                          <td><?= $no++ ?></td>
                                          <td><?= $u->applicant ?></td>
                                          <td><?= $u->department ?></td>
                                          <td><?= $u->email ?></td>
                                          <td><?= $u->no_tlp ?></td>
                                          <td>
                                          <a href="<?=site_url('c_transaksi/edit_email/').$u->id?>" class="btn btn-sm" style="font-size: 11px; background-color: #36454F;color: white;"><i class="fa fa-edit"></i></a>
                                          <a href="<?=site_url('c_transaksi/delete_email/').$u->id?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?php echo $u->email?>?');"class="btn btn-sm remove" style="font-size: 11px; background-color: #36454F;color: white;"><i class="fa fa-trash"></i></a>
                                          </td>
                                        </tr>
                                      <?php  } ?>
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