<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active">Add Department</li>
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
              
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #36454F;" >
                        <h3 class="card-title"></h3>
                    </div>
                    <form action = "<?php echo site_url('c_transaksi/tambahaksi_department'); ?>" method="post">
                      <div class="card-body">    
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>
                              ID Department
                            </label>
                            <input class="form-control" name="kode_department" type="text">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>
                              Department
                            </label>
                            <input class="form-control" name="department" type="text">
                          </div>
                        </div>       	
                      </div>
                      <div class="card-footer">
                          <div class="col-md-1">
                            <a href="<?=site_url('c_transaksi/index_department')?>" type="button" class="btn btn-block" style="background-color: #36454F;color: white;" >Back</a> 
                          </div>
                          <div class="col-md-10">
                              
                          </div>
                          <div class="col-md-1">
                              <ol class="float-sm-right">
                                  <button type="submit" class="btn btn-block" style="background-color: #36454F;color: white;" value="Tambah">Submit</button>
                              </ol>
                          </div>      
                      </div>
                    </form>
                  </div>
            </div>
		</div>
	</div>
</section>