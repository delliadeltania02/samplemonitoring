<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active">Edit Buyer</li>
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
                    <?php foreach($buyer as $u){ ?>
                    <form action = "<?php echo site_url('c_transaksi/editaksi_buyer'); ?>" method="post">
                      <div class="card-body">    
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>
                                Buyer
                            </label>
                            <input class="form-control" name="id_brand" type="hidden" value="<?php echo $u->id_brand ?>"> 
                            <input class="form-control" name="brand" type="text" value="<?php echo $u->brand?>">
                          </div>
                        </div>	
                      </div>
                      <div class="card-footer">
                          <div class="col-md-1">
                            <a href="<?=site_url('c_transaksi/index_buyer')?>" type="button" class="btn btn-block" style="background-color: #36454F;color: white;" >Back</a> 
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
                    <?php } ?>
                  </div>
            </div>
		</div>
	</div>
</section>