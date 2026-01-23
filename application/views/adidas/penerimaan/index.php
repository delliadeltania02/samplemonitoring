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
                <li class="breadcrumb-item"><a href="#">Handling Sample</a></li>
                <li class="breadcrumb-item active">Received Sample</li>
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
              <a href="<?=site_url('c_transaksi/tambah_penerimaan')?>" type="button" class="btn btn-block"  value="Tambah" style="font-size: 11px; background-color: #36454F;color: white;"><i class="fa-solid fa-plus"></i> &nbsp;Add Data</a>
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
                                          <th>QR Code</th>
                                          <th>Date Received</th>
                                          <th>Received Sample By</th>
                                          <th>Applicant</th>
                                          <th>Department</th>
                                          <th>Telephone</th>
                                          <th>Email</th>
                                          <th>Buyer</th>
                                          <th>Report No</th>
                                          <th>Sample Description</th>
                                          <th>Batch/LOT Number</th>
                                          <th>Order Number/PO-LCO</th>
                                          <th>Article No</th>
                                          <th>Size</th>
                                          <th>Code Of Fabric</th>
                                          <th>Compotition</th>
                                          <th>Item No</th>
                                          <th>Style No</th>
                                          <th>Season</th>
                                          <th>Brands</th>
                                          <th>Supplier Name</th>
                                          <th>Initial Width (LA)</th>
                                          <th>Request Width (LP)</th>
                                          <th>Finished Width (LD)</th>
                                          <th>Request Fabric Weight</th>
                                          <th>Finish Fabric Weight</th>
                                          
                                          <th>Material ID</th>
                                          <th>Country Of Destination</th>
                                          <th>Country Of Origin</th>
                                          <th>Product End Use</th>
                                          <th>OEKOTEX</th>
                                          <th>ERP Dyeing Number</th>
                                          <th>ERP Production Number</th>
                                          <th>Temperature Of Process</th>
                                          <th>Technique Print</th>
                                          <th>Approved Date</th>
                                          <th>TOD</th>
                                          <th>Stage</th>
                                          <th>Size Category</th>
                                          <th>Sample Number</th>
                                          <th>Care Instruction (Washing)</th>
                                          <th>Care Instruction (Bleach)</th>
                                          <th>Care Instruction (Drying)</th>
                                          <th>Care Instruction (Ironing)</th>
                                          <th>Care Instruction (Process)</th>
                                          <th>Number Of Sample</th>
                                          <th>Quantity of Sample</th>
                                         <th>Gambar</th>
                                          <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody id="myTable">
                                      <?php
                                       $no = 1;
                                       foreach($penerimaan as $u) { 
                                      ?>
                                      <tr>
                                            <td><?= $no++ ?></td>
                                            <td width="60px;"><img style="width:100%;" src="<?php echo base_url().'/img_qrcode/'.$u->qrcode_path;?>"></td>
                                            <td><?= $u->datetime_received  ?></td>
                                            <td><?= $u->received_sample_by?></td>
                                            <td><?= $u->applicant?></td>
                                            <td><?= $u->department?></td>
                                            <td><?= $u->telephone ?></td>
                                            <td><?= $u->email?></td>
                                            <td><?= $u->buyer ?></td>
                                            <td><?= $u->report_no?></td>
                                            <td><?= $u->sample_description?></td>
                                            <td><?= $u->batch_lot?></td>
                                            <td><?= $u->order_number?></td>
                                            <td><?= $u->article_no?></td>
                                            <td><?= $u->size?></td>
                                            <td><?= $u->code_of_fabric?></td>
                                            <td><?= $u->compotition?></td>
                                            <td><?= $u->item_no?></td>
                                            <td><?= $u->style_no?></td>
                                            <td><?= $u->season?></td>
                                            <td><?= $u->brands?></td>
                                            <td><?= $u->supplier_name?></td>
                                            <td><?= $u->initial_width?></td>
                                            <td><?= $u->request_width?></td>
                                            <td><?= $u->finished_width?></td>
                                            <td><?= $u->request_fabric ?></td>
                                            <td><?= $u->finish_fabric?></td>
                                           
                                            <td><?= $u->material_id?></td>
                                            <td><?= $u->country_destination?></td>
                                            <td><?= $u->country_origin?></td>
                                            <td><?= $u->product_end?></td>
                                            <td><?= $u->oekotex ?></td>
                                            <td><?= $u->dyeing_number?></td>
                                            <td><?= $u->production_number?></td>
                                            <td><?= $u->temperature_process?></td>
                                            <td><?= $u->technique_print?></td>
                                            <td><?= $u->approved_date?></td>
                                            <td><?= $u->tod?></td>
                                            <td><?= $u->stage?></td>
                                            <td><?= $u->size_category?></td>
                                            <td><?= $u->sample_no?></td>
                                            <td><?= $u->washing?></td>
                                            <td><?= $u->bleach?></td>
                                            <td><?= $u->drying?></td>
                                            <td><?= $u->ironing?></td>
                                            <td><?= $u->profess?></td>
                                            <td><?= $u->number_sample?></td>
                                            <td><?= $u->quantity_sample?></td>
                                            <td><img width='100%' src="<?=base_url('images/'.$u->image_path)?>" alt=""></td>
                                            <td>
                                              <a href="<?=site_url('c_transaksi/detail_penerimaan/').$u->id_penerimaan?>" class="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
                                              <a href="<?=site_url('c_transaksi/edit_penerimaan/').$u->id_penerimaan?>" class="btn btn-outline-info btn-sm button2"><i class="fa fa-edit"></i></a>
                                              <a href="<?= site_url('c_transaksi/hapus_penerimaan/' . $u->id_penerimaan) ?>" onclick="return confirm('Yakin hapus? <?php echo $u->report_no ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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