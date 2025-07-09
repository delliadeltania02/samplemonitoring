<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active">Edit Material</li>
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
                    <?php foreach($edit as $u): ?>
                      <form action = "<?php echo site_url('c_transaksi/editaksi_material'); ?>" method="post">
                        <div class="card-body">    
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>
                                Item No
                              </label>
                              <input class="form-control" name="id_material" type="text" value="<?= $u->id_material ?>" hidden>
                              <input class="form-control" name="item_no" type="text" value="<?= $u->item_no ?>">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>
                                Code of Fabric
                              </label>
                              <input class="form-control" name="code_of_fabric" type="text" value="<?= $u->code_of_fabric ?>">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>
                                Deskripsi
                              </label>
                              <textarea class="form-control" name="deskripsi" type="text"><?= $u->deskripsi?></textarea>
                            </div>
                          </div>          	
                        </div>
                        <div class="card-footer">
                            <div class="col-md-1">
                              <a href="<?=site_url('c_transaksi/index_material')?>" type="button" class="btn btn-block" style="background-color: #36454F;color: white;" >Back</a> 
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
                    <?php endforeach ?>
                  </div>
            </div>
		</div>
	</div>
</section>