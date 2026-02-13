<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                  <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                  <li class="breadcrumb-item active">Care Instruction</li>
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
               <a href="<?= site_url('c_transaksi/insert_careInstruction') ?>"
                class="btn btn-block"
                style="font-size: 11px; background-color: #36454F; color: white;">
                <i class="fa-solid fa-plus"></i> &nbsp;Add Data
              </a>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #36454F;" >
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">    
                        <div class="card">
                            <div class="card-body">
                        
                                 <table class="table table-bordered table-striped table-sm text-nowrap tableDefault">
                                    <thead>
                                      <tr>
                                          <th width="3%">#</th>
                                          <th width="25%"><center>Category</th>
                                          <th width="10%"><center>Care Instruction</th>
                                          <th  width="15%"><center>Description</th>
                                          <th  width="5%"><center>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody id="myTable">
                                      <?php
                              $no = 1;
                              foreach($index as $u){
                            ?>
                                <td><?= $no++ ?> </td>
                                <td><?= $u->kategori_care ?></td>
                                <td><center><img width='40%' src="http://localhost/samplemonitoring/images/care_instruction/<?= $u->simbol_care ?>" alt=""></td>
                                <td><?= $u->deskripsi ?></td>
                                <td><center>
                                <a href="<?=site_url('c_transaksi/edit_care/').$u->id_care?>" class="btn btn-sm" style="font-size: 11px; background-color: #36454F;color: white;"><i class="fa fa-edit"></i></a>&nbsp;
                                <a 
                                    href="<?= site_url('c_transaksi/delete_care/' . $u->id_care) ?>"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus <?= htmlspecialchars($u->deskripsi) ?>?');"
                                    class="btn btn-sm"
                                    style="font-size:11px; background-color:#36454F; color:white;"
                                ><i class="fa fa-trash"></i>
                                </a>
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
</section>