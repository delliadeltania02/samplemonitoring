<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active">Edit Applicant Information</li>
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
                    <?php foreach($edit as $u) { ?>
                    <form action = "<?php echo site_url('c_transaksi/editaksi_email'); ?>" method="post">
                      <div class="card-body">    
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>
                              Applicant
                            </label>
                            <input class="form-control" name="id" type="text" value="<?php echo $u->id ?>" hidden>
                            <input class="form-control" name="applicant" type="text" value="<?php echo $u->applicant ?>">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>
                              Department
                            </label>
                            <select name="department" class="form-control">
                              <option selected disabled>---Select Department---</option>
                              <?php foreach($department as $m):?>
                                <option value="<?php echo $m->id_department; ?>"<?php if($m->id_department==$u->id_department) echo "selected"; ?>><?php echo $m->department; ?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>
                              Email
                            </label>
                            <input class="form-control" name="email" type="text" value="<?php echo $u->email ?>">
                          </div>
                        </div>      
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>
                              No. Telepon
                            </label>
                            <input class="form-control" name="no_tlp" type="text" value="<?php echo $u->no_tlp ?>">
                          </div>
                        </div>    	
                      </div>
                      <div class="card-footer">
                          <div class="col-md-1">
                            <a href="<?=site_url('c_transaksi/index_email')?>" type="button" class="btn btn-block" style="background-color: #36454F;color: white;" >Back</a> 
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