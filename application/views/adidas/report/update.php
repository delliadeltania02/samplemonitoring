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
                <li class="breadcrumb-item active">Update Report</li>
                </ol>
          </div>
        </div>
      </div>
</div>
<section class="content" id="content" data-url="<?= base_url('c_transaksi')?>" >
    <div class="container-fluid">
        <div class="card">
            <div class="card-header" style="background-color: #36454F;" >
                <h3 class="card-title"></h3>
            </div>
            <form action = "<?php echo site_url('c_transaksi/editaksi_report'); ?>" method="post" > 
              <div class="card-body">
                <div class="col-md-12">
                  <span style="font-size: 11px; font-weight: bold;">Report Sample</span><hr>
                    <input type="hidden" name="id_reportkualitas" value="<?= $detail->id_reportkualitas; ?>">
                    <input type="hidden" name="id_handlingsample" value="<?= $detail->id_handlingsample; ?>">
                   
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Date Final of Test</label>
                    <input type="date" class="form-control" name="date_final" value="<?=$detail->date_final?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Test Pending</label>
                    <input type="text" class="form-control" name="test_pending" value="<?=$detail->test_pending?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Personil</label>
                    <input type="text" class="form-control" name="personil" value="<?php echo $this->session->userdata('bg_nama')?>" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Date Sending of Report</label>
                    <input type="date" class="form-control" name="date_sending" value="<?=$detail->date_sending?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <span style="font-size: 11px; font-weight: bold;"></span><hr>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Report No</label>
                      <input type="text" class="form-control" name="report_no" value="<?=$detail->report_no ?>" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Date Received</label>
                      <input type="text" class="form-control" name="date_received" value="<?= $detail->datetime_received?>" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Received Sample By</label>
                      <input type="text" class="form-control" name="received_sample_by" value="<?= $detail->received_sample_by?>" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Applicant</label>
                      <input type="text" class="form-control" name="applicant" value="<?= $detail->applicant?>"disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Departement / Tlp</label>
                      <input type="text" class="form-control" value="<?= $detail->department?> / <?= $detail->telephone ?>" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Email</label>
                      <input type="text" class="form-control" value="<?= $detail->email ?>"disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Batch / LOT</label>
                      <input type="text" class="form-control" value="<?= $detail->batch_lot?>" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Order Number / PO-LCO</label>
                      <input type="text" class="form-control" value="<?= $detail->order_number?>"disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Style</label>
                      <input type="text" class="form-control" value="<?= $detail->style_no?>"disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Code Of Fabric</label>
                      <input type="text" class="form-control" value="<?= $detail->code_of_fabric?>"disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Color</label>
                      <input type="text" class="form-control" value="<?= $detail->color?>"disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Color Of</label>
                      <input type="text" class="form-control" value="<?= $detail->color_of?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                      <div class="table-responsive">
                      <table class="table">
                              <thead>
                                  <tr><center>
                                      <th>Method ID</th>
                                      <th><center>Fabric Tech.<br> K: Knit W: Woven</th>
                                      <th><center>Composition<br>N: Natural S:Synthetic</th>
                                      <th>Test Standard Name</th>
                                      <th>Requirement</th>
                                      <th>Test Result</th>
                                      <th>Test Details</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $no = 1;
                                  foreach($method as $u) { 
                                ?>
                                <tr>
                                    <td><?= $u['method_code'] ?></td>
                                    <td><center><?= $u['fabric_tech']?></td>
                                    <td><center><?= $u['composition'] ?></td>
                                    <td><?=$u['method_name']?></td>
                                    <td><?= $u['fashion_casual'] ?><br><br>&nbsp;<?= $u['hybrid_performance'] ?></td>
                                    <td><?= $u['result'] ?><?= $u['passfail'] ?><br><?= $u['passfail1'] ?><?= $u['statement'] ?></td>
                                    <td><?= $u['uom'] ?></td>
                                    <td><?= $u['status_passfail'] ?></td>
                                    
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td><span style="font-weight: bold;">Result : <?= $detail->result_status ?></span></td>
                                    <td colspan="8"></td>
                                </tr>
                              </tbody>
                              
                          </table>
                      </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                  <div class="col-md-1">
                          <a href="<?=site_url('c_transaksi/index_report')?>" type="button" class="btn btn-block" style="background-color: #36454F;color: white;" >Back</a> 
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
</section>