<style>
    .card-modern {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        margin-bottom: 15px;
        transition: all 0.3s;
    }
    .card-header-modern {
        background-color: #001f3f;
        color: white;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        padding: 10px 15px;
    }
    .card-body-modern {
        padding: 15px;
        background-color: #f8f9fa;
    }
    .toggle-icon {
        transition: transform 0.3s;
    }
    .toggle-icon.rotate {
        transform: rotate(180deg);
    }
    .shrinkage{
        display: none;
    }
    .form-check {
    display: flex;
    align-items: center;
    gap: 6px; /* jarak antara checkbox & label */
    }

    .form-check-input {
    position: static !important; /* hilangkan posisi absolut bawaan */
    margin-top: 0 !important;
    }

    .form-check-label {
    margin-bottom: 0;
    font-size: 11px;
}
</style>
<?php
$jenisReportMap = [
    'fgt'        => 'Finished Good Test (FGT)',
    'fgwt'       => 'Finished Garment Wash Test Report',
    'ftr'        => 'Fabric Test Report',
    'ftrf'       => 'Fabric Test Report Formaldehyde',
    'ttr1'       => 'Trim Test Report (Trim Physical Tests)',
    'ttr2'       => 'Trim Test Report (Trim Physical Tests + Color Fastness Tests)',
    'swtr'       => 'Sock Wash Test Report',
    'ptr'        => 'Product Test Report (Finished Good Test)',
    'str1'       => 'Sock Test Report (Physical Tests + Color Fastness Tests)',
    'str2'       => 'Sock Test Report (Physical Tests + Color Fastness Tests)',
    'phdanform'  => 'pH Value + Formaldehyde Test Report'
]; ?>
<div class="content-header">
      <div class="container-fluid">

        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
                <li class="breadcrumb-item active">Kualitas - <?= htmlspecialchars($testResult->report_no ?? '') ?></li>
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
        <form action = "<?php echo site_url('c_transaksi/simpan_rilis'); ?>" method="post" name="method"> 
            <!-- CARD Riwayat Relase -->
            <div class="card card-modern">
                <div class="card-header-modern" data-toggle="collapse" data-target="#cardDataSign" onclick="this.querySelector('.toggle-icon').classList.toggle('rotate')">
                    <span>Riwayat Release - <?= htmlspecialchars($testResult->test_required ?? '') ?></span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
                <div id="cardDataSign" class="collapse show">
                    <div class="card-body-modern">
                         <div class="table-wrapper">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Report No</th>
                                        <th>Order Number / PO LCO</th>
                                        <th>Date Sending</th>
                                        <th>Personil</th>
                                        <th>Status</th>
                                        <th><center><i class="fa-regular fa-file-lines"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        if (!empty($riwayat)) {
                                            foreach ($riwayat as $row): 
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row->new_report_no ?? '-' ?></td>
                                        <td><?= $row->order_number ?? '-' ?></td>
                                        <td><?= $row->date_sending ?: '-' ?></td>
                                        <td><?= $row->personil ?: '-' ?></td>
                                        <td>
                                            <?php 
                                                $st = $row->result_status ?: '-';

                                                if ($st === 'Accepted' || $st === 'PASS') {
                                                    echo "<span class='badge bg-success'>$st</span>";
                                                } elseif ($st === 'Rejected' || $st === 'FAIL') {
                                                    echo "<span class='badge bg-danger'>$st</span>";
                                                } else {
                                                    echo $st;
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                $jenis = $row->jenis_report;
                                                $id    = $row->id_penerimaan;
                                                $no    = $row->new_report_no;

                                                $urlMap = [
                                                    'fgt'   => "c_transaksi/fgt/$id/$no",
                                                    'fgwt'  => "c_transaksi/fgwt/$id/$no",
                                                    'ftr'   => "c_transaksi/ftr/$id/$no",
                                                    'ftrf'  => "c_transaksi/ftrf/$id/$no",
                                                    'ttr1'  => "c_transaksi/ttr1/$id/$no",
                                                    'ttr2'  => "c_transaksi/ttr2/$id/$no",
                                                    'swtr'  => "c_transaksi/swtr/$id/$no",
                                                    'ptr'   => "c_transaksi/ptr/$id/$no",
                                                    'str1'  => "c_transaksi/str1/$id/$no",
                                                    'str2'  => "c_transaksi/str2/$id/$no",
                                                    'phdanform' => "c_transaksi/phdanform/$id/$no"
                                                ];

                                                $url   = isset($urlMap[$jenis]) ? site_url($urlMap[$jenis]) : '#';
                                                $label = isset($jenisReportMap[$jenis]) ? $jenisReportMap[$jenis] : 'Unknown Report';
                                            ?>
                                            <a href="<?= $url ?>"
                                            class="btn btn-outline-info btn-sm button2"
                                            target="_blank"
                                            title="<?= $label ?>">
                                                Link
                                            </a>
                                            <div class="small text-muted mt-1">
                                                <?= $label ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                        endforeach;
                                    } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
              <!-- CARD Riwayat Relase -->
            <div class="card card-modern">
                <div class="card-header-modern" data-toggle="collapse" data-target="#cardData" onclick="this.querySelector('.toggle-icon').classList.toggle('rotate')">
                    <span>Testing Data - <?= htmlspecialchars($testResult->test_required ?? '') ?></span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
                <div id="cardData" class="collapse">
                    <div class="card-body-modern">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 140px;"><strong>Master Report No</strong></td>
                        <td style="width: 10px; text-align: right;">:</td>
                        <td><?= isset($report[0]) ? $report[0]->report_no : 'N/A' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Date of Received</strong></td>
                        <td style="text-align: right;">:</td>
                        <td>
                            <?= isset($report[0])
                                ? ($report[0]->datetime_received
                                    ? date('d F Y', strtotime($report[0]->datetime_received))
                                    : 'N/A')
                                : 'N/A' ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Date of Test</strong></td>
                        <td style="text-align: right;">:</td>
                        <td>
                            <?= isset($report[0])
                                ? ($report[0]->date_test
                                    ? date('d F Y', strtotime($report[0]->date_test))
                                    : 'N/A')
                                : 'N/A' ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Date</strong></td>
                        <td style="text-align: right;">:</td>
                        <td><?= date('d F Y') ?></td>
                    </tr>
                </table>
            
        <!-- Table for Test Result -->
        <table border="1" style="margin-top: 5px;">
            <thead>
                <!-- MATERIAL SPECIFICATION muncul di setiap halaman -->
                 <tr>
                    <td colspan="8">MATERIAL SPECIFICATION</td>
                </tr>
                <tr>
                    <td colspan="8">Testing Type : <?= isset($report[0]) ? $report[0]->stage : 'N/A' ?> </td>
                </tr>
                <tr>
                    <td colspan="3">Material Supplier :  <?= isset($report[0]) ? $report[0]->supplier_name : 'N/A' ?> </td>
                    <td colspan="2">Season :  <?= isset($report[0]) ? $report[0]->season : 'N/A' ?> </td>
                    <td colspan="3">Color Code/Name(Solid) :  <?= isset($report[0]) ? $report[0]->color : 'N/A' ?> </td>
                </tr>
                <tr>
                    <td colspan="3">adidas No :  <?= isset($report[0]) ? $report[0]->item_no : 'N/A' ?>  </td>
                    <td colspan="2">Weight : / Width : <?= isset($report[0]) ? $report[0]->request_fabric : 'N/A' ?> / <?= isset($report[0]) ? $report[0]->request_width : 'N/A' ?> </td>
                    <td colspan="3">AOP CCN : </td>
                </tr>
                <tr>
                    <td colspan="3">Supplier Ref :  </td>
                    <td colspan="2">Construction/Finish:</td>
                    <td colspan="3">Hangtag : </td>
                </tr>
                <tr>
                    <td colspan="3" style="width: 250px;">Fabric Type / Composition :  <?= isset($report[0]) ? $report[0]->deskripsi : 'N/A' ?> </td>
                    <td colspan="5">Remarks :  
                         <?= isset($report[0]) ? $report[0]->order_number : ' ' ?> &nbsp;/
                         <?= isset($report[0]) ? $report[0]->code_of_fabric : ' ' ?>&nbsp;/
                         <?= isset($report[0]) ? $report[0]->batch_lot : ' ' ?> &nbsp;/
                         <?= isset($report[0]) ? $report[0]->temperature_process : ' ' ?> 
                    </td>
                </tr>
                <tr style="border-bottom:none;"><td colspan="8" height="30px"></td></tr>
                
                <!-- HEADER KOLOM -->
                <tr style="font-weight:bold; text-align:center;">
                    <td>Method ID</td>
                    <td>Fabric Tech.<br>K: Knit<br>W: Woven</td>
                    <td>Composition<br>N: Natural<br>S: Synthetic</td>
                    <td>Test Standard Name</td>
                    <td>Minimum Requirements<br>(Underlined mandatory)</td>
                    <td>Test Results</td>
                    <td>Test Details</td>
                    <td width="10px;">A/R</td>
                </tr>
            </thead>
           <tbody>
                <?php
                // Kelompokkan data berdasarkan test_type
                $grouped = [];
                foreach ($method as $m) {
                    $grouped[$m['test_type']][] = $m;
                }

                // Tentukan urutan tampilan (biar rapi)
                $urut = ['Physical Test', 'Color Fastness Test', 'Functional Test', 'Chemical Test'];

                foreach ($urut as $type):
                    if (!isset($grouped[$type])) continue; // kalau ga ada, skip

                    // Judul test type
                    echo "<tr style='background:#f0f0f0; font-weight:bold; text-align:center; font-size:14px;'>
                            <td colspan='8' style='padding:6px;'>{$type}</td>
                        </tr>";

                    $no = 1;
                    foreach ($grouped[$type] as $u):
                ?>
                    <tr>
                        <td><?= $u['method_code'] ?></td>
                        <td style="text-align:center;"><?= $u['fabric_tech'] ?></td>
                        <td style="text-align:center;"><?= $u['composition'] ?></td>
                        <td><?= $u['title'] ?></td>
                        <td><?= $u['remakrs']?><br><b>Value From :</b>  <?= $u['value_from'] ?><br><b>Value To :</b><?= $u['value_to']?></td>
                         <td>
                            <?php
                                // Jika ada beberapa baris sub-test, loop masing-masing
                                $report_id = $u['id_reportkualitas'];
                                $subtests = $this->db->get_where('report_kualitas', ['id_reportkualitas' => $report_id, 'id_testmatrix' => $u['id_testmatrix']])->result_array();

                                foreach($subtests as $r){
                                    echo '<b>'.$r['result'].'</b>';
                                    if(!empty($r['comment'])){
                                        echo ''.$r['comment'].'';
                                    }
                                    if(!empty($r['statement'])){
                                        echo ''.$r['statement'].'';
                                    }
                                    echo '<br>'; // spasi antar sub-test
                                }
                            ?>
                        </td>
                        <td><?= $u['uom'] ?></td>
                        <td><?= $u['result_status'] ?></td>
                    </tr>
                <?php
                    endforeach;
                endforeach;
                ?>
            </tbody>
        </table>    
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Jenis Report</label>
                        <select name="jenis_report" id="jenis_report" class="form-control select2" required>
                            <option selected disabled value="">--- Pilih Jenis Report ---</option>
                            <option value="fgt">Finished Good Test (FGT)</option>
                            <option value="fgwt">Finished Garment Wash Test Report</option>
                            <option value="ftr">Fabric Test Report</option>
                            <option value="ftrf">Fabric Test Report Formaldehyde</option>
                            <option value="ttr1">Trim Test Report  (Trim Physical Tests)</option>
                            <option value="ttr2">Trim Test Report  (Trim Physical Tests + Color Fastness Tests)</option>
                            <option value="swtr">Sock Wash Test Report</option>
                            <option value="ptr">Product Test Report ( Finished Good Test)</option>
                            <option value="str1">Sock Test Report (Physical Tests + Color Fastness Tests)</option>
                            <option value="phdanform">pH Value + Formaldehyde Test Report</option>
                            <option value="str2">Sock Test Report (Physical Tests + Color Fastness Tests)</option>
                        </select>
                    </div>
                </div>
               <!--div class="col-md-4">
                    <div class="form-group">
                        <label>Report No</label>
                        <input type="text" name="report_no" id="report_no" class="form-control" value="<= new_report_no ?>" readonly>
                        <input type="hidden" id="id_penerimaan" name="id_penerimaan" value="<= $id_penerimaan ?>">
                    </div>
                </div-->

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Report No</label>

                        <!-- Pilihan -->
                        <div>
                            <label>
                                <input type="radio" name="adding_type" value="adding" checked>
                                Adding
                            </label>
                            &nbsp;&nbsp;
                            <label>
                                <input type="radio" name="adding_type" value="no_adding">
                                No Adding
                            </label>
                        </div>

                        <input type="hidden"
                            name="report_no"
                            id="report_no"
                            value="<?= $report_no ?>">

                        <input type="hidden"
                            id="id_penerimaan"
                            name="id_penerimaan"
                            value="<?= $id_penerimaan ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date Sending Report</label>
                        <input type="date" name="date_sending" id="date_sending" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Signature</label>
                        <select name="signature" id="signature" class="form-control">
                            <option selected disabled value=" ">--Pilih Sign--</option>
                            <?php foreach ($ttd as $u): ?>
                            <option value="<?= $u->id_ttd ?>" > <?= $u->nama ?> </option>
                            <?php endforeach ?>
                        </select>
                </div>
                <div class="col-md-4">
                    <label>Review By</label>
                    <select name="review" id="review" class="form-control">
                        <option selected disabled value=" ">--Pilih Sign--</option>
                        <?php foreach ($ttd as $u): ?>
                        <option value="<?= $u->id_ttd ?>" > <?= $u->nama ?> </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Authorized By</label>
                    <select name="authorized" id="authorized" class="form-control">
                        <option selected disabled value=" ">--Pilih Sign--</option>
                        <?php foreach ($ttd as $u): ?>
                        <option value="<?= $u->id_ttd ?>" > <?= $u->nama ?> </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Comment</label>
                    <textarea onkeypress="enterComment();" class="form-control" name="comment" id="comment" rows="3" style="white-space: pre-wrap;"></textarea>
                </div>
                <div class="col-md-6">
                    <label>Remarks</label>
                    <textarea onkeypress="enterRemarks();" class="form-control" type="text" name="remarks" id="remarks" style="white-space: pre-wrap;"></textarea>
                </div>
               
                </div>
                <div class="card-footer">
                  <div class="col-md-1">
                      <a href="<?=site_url('c_transaksi/index_reportAll')?>" type="button" class="btn btn-block" style="background-color: #001f3f; color: white;">Back</a>
                  </div>
                  <div class="col-md-10">
                      
                  </div>
                  <div class="col-md-1">
                      <ol class="float-sm-right">
                          <button type="submit" class="btn btn-block" style="background-color: #001f3f; color: white;" value="Tambah">Submit</button>
                      </ol>
                  </div>      
                </div>
        </form>
    </div>            
</section>

               
