<!DOCTYPE html>
<html lang="en">
    <head>
    <?php require_once(__DIR__ . '/../../layout/_meta.php'); ?>


    <title>Handling Sample</title>
    <?php require_once(__DIR__ . '/../../layout/_css.php'); ?>
    
    </head>
    <body style="background-color:#fffffe ;">
        <?php require_once(__DIR__ . '/../../layout-fe/_header.php'); ?>
        <div class="container-fluid">
            <div class="container-fluid">
                <form action = "<?php echo site_url('c_transaksi/editaksi_report'); ?>" method="post" >
                    <div class="card card-navy">
                        <div class="card-header"></div>
                        <div class="col-md-12">
                            <div class="col-md-12"><br>
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
                                <?php
                                $user_level = $this->session->userdata('level');
                                $report_no_url = urlencode($detail->report_no); // Pakai ini supaya aman di URL
                                $back_url = ($user_level == 10 || $user_level == 1)
                                    ? site_url('c_transaksi/index_bcKualitas/' . $report_no_url)
                                    : site_url('c_transaksi/index_report');
                                ?>
                                <a href="<?= $back_url ?>" type="button" class="btn btn-block" style="background-color: #36454F;color: white;">Back</a>
                            </div>
                            <div class="col-md-10">
                                
                            </div>
                            <div class="col-md-1">
                                <ol class="float-sm-right">
                                    <button type="submit" class="btn btn-block" style="background-color: #36454F;color: white;" value="Tambah">Submit</button>
                                </ol>
                            </div>      
                        </div>
                    </div>
                </form>
            </div>
            <!---- MODAL DATA ORDER ---->
            <div id="ModalOption" class="modal" role="dialog">
                <div class="modal-dialog modal-lg">
                <!--modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <span style="font-size: 14px; font-weight:bold;">Method List</span>
                        </div>
                        <div class="modal-body">
                            <style>
                            .pagination{
                                float:right;
                            }
                            .dataTables_filter{
                                float: right;
                            }
                            </style>
                            <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered table-striped text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th width="1%"><center>#</th>
                                                    <th><center>Test Method Code</th>
                                                    <th><center>Measurement</th>
                                                    <th><center>Dry Process</th>
                                                    <th><center>Value From</th>
                                                    <th><center>Value To </th>
                                                    <th><center>UOM</th>
                                                    <th><center>Pass/Fail</th>
                                                    <th hidden><center>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no = 1;
                                                    foreach($testmatrix as $u){
                                                ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $u->method_code?></td>
                                                    <td><?= $u->measurement?><br><?= $u->title?></td>
                                                    <td><?= $u->dry ?></td>
                                                    <td><?= $u->value_from?></td>
                                                    <td><?= $u->value_to?></td>
                                                    <td><?= $u->uom ?></td>
                                                    <td><?= $u->pass_fail ?></td>
                                                    <td hidden>
                                                        <a href="#" class="btn btn-outline-primary"><i class="fa fa-plus"></i></a>
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
        <?php require_once(__DIR__ . '/../../layout/_js.php'); ?>
      
    </body>
</html>
