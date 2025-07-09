<div class="content-header">
      <div class="container-fluid">

        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Handling Sample</a></li>
                <li class="breadcrumb-item active">Test Result</li>
                </ol>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><button data-target="#ModalOption" data-toggle="modal" type="button" class="btn btn-sm btn-outline-primary" id="tambah">Method List</button></li>
            </ol>
          </div>
        </div>
      </div>
</div>
<section class="content">
    <div class="container-fluid">
        <form action = "<?php echo site_url('c_transaksi/tambahaksi_method'); ?>" method="post" name="method"> 
            <div class="card card-navy">
                <div class="card-header"></div>
                <div class="col-md-12">
                    <div class="card card-navy">
                    
                    </div>
                    <div class="col-md-12">
                        <span style="font-weight:bold;">Report No / Test Required</span>&nbsp;&nbsp;&nbsp;<input type="text" name="report_no" id="report_no" value="<?php echo htmlspecialchars($testResult->report_no); ?>" readonly>
                        <input type="text" name="id_kualitas" id="id_kualitas" value="<?php echo htmlspecialchars($testResult->id_kualitas); ?>" hidden>
                        <input type="text" name="test_required" id="test_required" value="<?php echo htmlspecialchars($testResult->test_required); ?>" readonly>
                        <input type="text" name="id_penerimaan" id="id_penerimaan" value="<?php echo htmlspecialchars($testResult->id_penerimaan); ?>" hidden>
                        <input type="text" name="id_reportkualitas" id="id_reportkualitas" value="<?php echo $kodereport ?>" hidden>
                    </div>
                    <div class="col-md-12"><br>
                    <span style="font-size: 15px;font-weight: bold;">Data Quality</span>
                    <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date Of Sampling</label>
                            <input class="form-control" type="date" name="date_sampling">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Time Of Sampling</label>
                            <input class="form-control" type="time" name="time_sampling">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date Of Test</label>
                            <input class="form-control" type="date" name="date_test">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date Finish Of Test</label>
                            <input class="form-control" type="date" name="date_finish">
                        </div>
                    </div>
                    <div class="col-md-12"><br>
                        <span style="font-size: 15px;font-weight: bold;">Test Method</span>
                        <hr>
                        <div class="form-group">
                            <label>Method Group</label>
                            <select name="method_group" id="method_group" class="form-control" onchange="updateTestMatrixDropdown(this.value)">
                                <option selected disabled>Pilih Method Group</option>
                                <?php foreach ($method_groups as $method_group): ?>
                                    <option value="<?php echo $method_group->id_methodgroup; ?>"><?php echo $method_group->method_group; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Test Matrix</label>
                            <select class="form-control select2" name="id_testmatrix" id="id_testmatrix">
                                <option selected disabled>Pilih Test Matrix</option>
                            </select>

                            <input name="report_no" id="report_no" type="text" class="form-control" value="<?= $testResult->report_no ?>" hidden> 
                            <input type="text" name="method_code" id="method_code" value="" class="form-control" hidden>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title_row" value="<?= $this->input->post('title')?>" readonly class="form-control"></input>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Measurement</label>
                            <input type="text" name="measurement_row" value="<?= $this->input->post('measurement')?>" readonly class="form-control"></input>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Test Result Type</label>
                            <select name="result_type" id="result_type" class="form-control" disabled>
                                <option selected disabled>PILIH</option>
                                <option value="boolean">Boolean</option>
                                <option value="number">Number</option>
                                <option value="statement">Statement</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6" id="div_statement" style="display: none;">
                        <div class="form-group">
                            <label>Statement</label>
                            <textarea type="text" name="statement" id="statement" value="<?= $this->input->post('statement')?>" readonly class="form-control"></textarea>
                        </div>                       
                    </div>
                    <div class="col-md-3" id="div_statement_status" style="display: none;">
                        <div class="form-group">
                            <label>Result</label>
                            <select name="status_statement_row" id="status_statement" class="form-control status_statement" onchange="status_statement(this);">
                                <option selected disabled>Pilih</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>                         
                    </div>
                    <div class="col-md-3" id="div_value_from" style="display: none;">
                        <div class="form-group">
                            <label>Value From</label>
                            <input type="text" name="value_from_row" id="value_from" value="<?= $this->input->post('value_from')?>" readonly class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3" id="div_value_to" style="display: none;">
                        <div class="form-group">
                            <label>Value To</label>
                            <input type="text" name="value_to_row" id="value_to" value="<?= $this->input->post('value_to')?>" readonly class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3" id="div_result" style="display: none;">
                        <div class="form-group">
                            <label>Result</label>
                            <input type="text" name="result_row" id="result" value="" readonly class="form-control"  onkeyup="sum_method(this);" >
                        </div>
                    </div>
                    <div class="col-md-3" id="div_status" style="display: none;">
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" name="status" id="status" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-3" id="div_passfail" style="display: none;">
                        <div class="form-group">
                            <label>Result / Before Wash</label>
                            <select name="result_passfail_row" id="result_passfail" class="form-control result_passfail" onchange="status_boolean(this);">
                                <option selected disabled>Pilih</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" id="div_passfail_1" style="display: none;">
                        <div class="form-group">
                            <label>Result / 1. Wash</label>
                            <select name="result_passfail_row_1" id="result_passfail1" class="form-control result_passfail1" onchange="status_boolean(this);">
                                <option selected disabled>Pilih</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" id="div_status_statement" style="display: none;">
                        <div class="form-group">
                            <label>Result</label>
                            <select name="status_statement" id="result_passfail1" class="form-control result_passfail1" onchange="status_boolean(this);">
                                <option selected disabled>Pilih</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                    </div>             
                    <div class="col-md-3" id="div_comment" style="display: none;">
                        <div class="form-group">
                            <label>Comment</label>
                            <input type="text" name="comment" id="comment" value="" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3" id="div_status_passfail" style="display: none;">
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" name="status_passfail" id="status_passfail" value="" class="form-control"  readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button disabled type="button" class="btn btn-block" style="background-color: #001f3f; color: white;" id="tambah"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                    </div>
                    <div class="col-md-12">
                    <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="table-responsive keranjang_method" id="keranjang_method">
                                                  
                                <table id="keranjang_method" class="table table-bordered" style="font-size: 10px;">
                                    <thead style=" font-weight: bolder;">
                                        <tr>
                                            <td hidden>Report No</td>
                                            <td rowspan="2" width="200px;"><center>Test Method</td>
                                            <td rowspan="2" width="250px;"><center>Method Name</td>
                                            <td><center>Test Result</td>
                                            <td ><center>Comment / Statement</td>
                                            <td ><center>Status</td>
                                            <td ><center>Aksi</td>
                                        </tr>
                                        <tr hidden>
                                            <td width="130px;"><center>Result</td>
                                            <td width="130px;"><center>Before Wash</td>
                                            <td width="130px;"><center>1. Wash</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                
                                    </tbody>
                                    <tfoot style="text-align:center;" >
                                        <tr class="tfoot_method">
                                        <td></td>
                                        <td colspan="2"><input name="report_no_hidden" id="report_no_hidden" type="hidden" class="form-control" value="<?= $testResult->report_no ?>"> </td>
                                        <td><b style="text-align:right;"><strong>Result Status </strong></td>
                                        <td id="result_status"></td>
                                        <td>
                                            <input type="text" name="result_status" id="result_status" value="<?= $this->input->post('result_status')?>" hidden>
                                            <input type="text" name="id_reportmethod" id="id_reportmethod" value="<?php echo $kodemethod; ?>" hidden>
                                        </td>
                                        </tr> 
                                    </tfoot>
                                </table>    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                    
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-1">
                        <a href="<?=site_url('#')?>" type="button" class="btn btn-block" style="background-color: #001f3f; color: white;">Back</a>
                    </div>
                    <div class="col-md-10">
                        
                    </div>
                    <div class="col-md-1">
                        <ol class="float-sm-right">
                            <button type="submit" class="btn btn-block" style="background-color: #001f3f; color: white;" value="Tambah">Submit</button>
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
                                <table id="example2" class="table table-bordered table-striped text-nowrap">
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
</section>

               
