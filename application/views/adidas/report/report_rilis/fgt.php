<!DOCTYPE html>
<html>
<head>
    <title>Finished Good Test (FGT)</title>
    <?php require_once('/xampp/htdocs/samplemonitoring/application/views/layout/_css.php'); ?>
    <style>
        /* Margin halaman */
        @page {
             margin-top: 90px;    /* dari 190px → 160px */
            margin-bottom: 80px;
            margin-left: 20px;
            margin-right: 20px;
        }

        /* Header halaman */
        header {
            position: fixed;
             top: -70px;          /* dari -190px → -150px */
            left: 0;
            right: 0;
            height: 180px;         /* tetap */
        }
        /* Footer halaman */
        footer {
            position: fixed;
            bottom: -40px;
            left: 0;
            right: 0;
            height: 40px;
            text-align: center;
            font-size: 9px;
        }
        /* Table layout */
        table {
            border-spacing: 0;
            border-collapse: collapse;
            font-size: 10px;
            width: 100%;
        }

        td {
            padding: 4px;
            vertical-align: top;
        }

        h1 {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            font-family: Calibri;
        }

        body {
            font-family: Calibri, sans-serif;
            font-size: 10px;
            counter-reset: page;
        }

        footer:after {
            counter-increment: page;
            content: "Page " counter(page);
        }

        /* Agar header tabel (Material Spec) muncul di setiap halaman */
        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-row-group;
        }

        tr {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <!-- HEADER UTAMA (muncul di semua halaman) -->
    <header>
        <img style="position: absolute; right: 20px; top: 10px;"
            src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents(FCPATH.'assets/img/images/unnamed.png')) ?>"
            height="50" width="50" alt="logo" />
        <h1>Product TEST REPORT</h1>
    </header>
    <!-- FOOTER -->
    <footer>
        PT. KAHATEX<br>
        Jl. Cijerah Cigondewah Girang 16 RT 001/RW 032 Melong, Cimahi Selatan, Cimahi - Jawa Barat,<br>
        Tel. : (022) 6031566, 6031030, Fax: (022) 6031488, 6032166<br>
        Email: lab.umum.bd@kaha.com
    </footer>

    <!-- ISI HALAMAN -->
    <div class="page-content">
        <table border="1" style="margin-top: 5px;">
            <thead>
               
                <tr>
                    <td colspan="8">Testing Type : <?= isset($report[0]) ? $report[0]->testing_stages : 'N/A' ?> </td>
                </tr>
                <tr>
                    <td colspan="3">Report No :  <?= isset($report[0]) ? $report[0]->no_final: 'N/A' ?> </td>
                    <td colspan="2">Date Received :  <?= isset($report[0]) ? $report[0]->datetime_received : 'N/A' ?> </td>
                    <td colspan="3">Date Of Test :  <?= isset($report[0]) ? $report[0]->date_test : 'N/A' ?> </td>
                </tr>
                <tr>
                    <td colspan="3">adidas Article No :  <?= isset($report[0]) ? $report[0]->article_no : 'N/A' ?>  </td>
                    <td colspan="2">adidas Working No : <?= isset($report[0]) ? $report[0]->style_no : 'N/A' ?> </td>
                    <td colspan="3">adidas Model No : </td>
                </tr>
                <tr>
                    <td colspan="3">T1 Supplier Ref : <?= isset($report[0]) ? $report[0]->supplier_code : 'N/A' ?></td>
                    <td colspan="2">T1 Factory Name : <?= isset($report[0]) ? $report[0]->supplier_name : 'N/A' ?></td>
                    <td colspan="3">LO to Factory : </td>
                </tr>
                <tr>
                    <td colspan="3" style="width: 250px;">Reference table V1</td>
                    <td colspan="5" rowspan="3">Remarks :  
                         <?= isset($report[0]) ? $report[0]->order_number : ' ' ?><?= isset($report[0]) ? $report[0]->other_order_number : ' ' ?> &nbsp;/
                         <?= isset($report[0]) ? $report[0]->code_of_fabric : ' ' ?>&nbsp;/
                         <?= isset($report[0]) ? $report[0]->batch_lot : ' ' ?> &nbsp;/
                         <?= isset($report[0]) ? $report[0]->temperature_process : ' ' ?> 
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Date: <?= isset($report[0]) ? $report[0]->date_sending : 'N/A' ?></td>
                </tr>
                <tr><td colspan="3">Season : <?= isset($report[0]) ? $report[0]->season: 'N/A' ?></td></tr>
                <tr style="border-bottom:none;"><td colspan="8" style="font-size:small ; font-weight: bold;"><center>Finished Good Test</td></tr>
                
                <!-- HEADER KOLOM -->
                <tr style="font-weight:bold; text-align:center;">
                    <td colspan="2">Test Name</td>
                    <td>Requirement</td>
                    <td>Test Results</td>
                    <td>Requirement</td>
                    <td>Test Details</td>
                    <td colspan="2">Result</td>
                </tr>
            </thead>
            <tbody>
  
?>


                        <?php foreach ($method as $u): ?>
                                            <tr>
                                                <td colspan="2"><?= $u['method_code'] ?></td>
        <td>
        <?= $u['title'] ?>
        <?php if (!empty($u['rilis']) && (int)$u['rilis'] > 0): ?>
            <sup>A<?= (int)$u['rilis'] ?></sup>
        <?php endif; ?>
    </td>


                        <td>
                                          <center>

                                              <?php 
                                              // =========================
                                              // PASSFAIL, PASSFAIL1, RESULT
                                              // =========================
                                              $display_passfail  = ($u['passfail']  === '-') ? '' : $u['passfail'];
                                              $display_passfail1 = ($u['passfail1'] === '-') ? '' : $u['passfail1'];
                                              $display_result    = ($u['result']    === '-') ? '' : $u['result'];
                                              ?>

                                              <?= $display_passfail ?>
                                              <?= $display_passfail1 ?>
                                              <?= $display_result ?>

                                              <input type="hidden" class="form-control result" name="result_hidden[]" value="<?= $u['result'] ?>">

                                              <?php
                                              // =========================
                                              // BEFORE WASH
                                              // =========================
                                              $be = $u['be_wash'] ?? '';
                                              if (!empty($be) && $be !== '-') {
                                                  echo "<div style='margin-top:5px; text-align:left;'><strong>Before wash = </strong>$be</div>";
                                              }
                                              echo '<input type="hidden" name="be_wash[]" value="'.$be.'">';

                                              // =========================
                                              // WASH SETS
                                              // =========================
                                              $wash_sets = [
                                                  ['af'=>'af_wash_1','ac'=>'ac_wash_1','label'=>'1x Wash'],
                                                  ['af'=>'af_wash_5','ac'=>'ac_wash_5','label'=>'5x Wash'],
                                                  ['af'=>'af_wash_15','ac'=>'ac_wash_15','label'=>'15x Wash'],
                                              ];

                                              foreach($wash_sets as $w){
                                                  $af = $u[$w['af']] ?? '';
                                                  $ac = $u[$w['ac']] ?? '';

                                                  if (($af !== '' && $af !== '-') || ($ac !== '' && $ac !== '-')) {

                                                      $display_af = ($af === '-') ? '' : $af;
                                                      $display_ac = ($ac === '-') ? '' : $ac;

                                                      echo "<div style='margin-top:5px; text-align:left;'>";
                                                      echo "<strong>{$w['label']}</strong><br>";
                                                      echo "After wash = $display_af<br>";
                                                      echo "Actual Shrinkage = $display_ac";
                                                      echo "</div>";
                                                  }

                                                  echo '<input type="hidden" name="'.$w['af'].'[]" value="'.$af.'">';
                                                  echo '<input type="hidden" name="'.$w['ac'].'[]" value="'.$ac.'">';
                                              }
                                              ?>

                                          </center>
                                        </td>

                        <td>
                            <?= $u['remakrs'] ?><br>
                            <b>Value From :</b> <?= $u['value_from'] ?><br>
                            <b>Value To :</b> <?= $u['value_to'] ?>
                        </td>

                        <td><?= $u['uom'] ?></td>
                         <td colspan="2"><center>
                                              <?php 
                                                $display_numeric = ($u['status_numeric']  === '-') ? '' : $u['status_numeric'];
                                                $display_shrinkage = ($u['status_shrinkage'] === '-') ? '' : $u['status_shrinkage'];
                                                $display_boolean    = ($u['status_boolean']    === '-') ? '' : $u['status_boolean'];
                                                $display_statement  = ($u['status_statement_result']    === '-') ? '' : $u['status_statement_result'];
                                              ?>
                                              <?= $display_numeric ?>
                                              <?= $display_shrinkage ?>
                                              <?= $display_boolean ?>
                                              <?= $display_statement ?>
                                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div style="margin-top: 10px;">
            <span>* All tests need to follow the adidas "Quality Assurance Test Matrix" according to lab test and most updated version
                <br>NOTE : Valid for the one sample concerned
                <br>It is prohibited to reproduce the report without approval of the laboratory.
                <br>R1 : 1st Retest
                <br>A1 : 1st Adding
            </span><br>
            <table >
                <tr>
                    <td rowspan="3" style="width: 200px;">

                    </td>
                    <td>
                        <center><span style=font-weight:bold;font-size:14px;">Sample Photo</span><br><br>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td><center>
                        <?php
                        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/samplemonitoring/images/sample_photo/' . $report[0]->image_path;
                        if (!empty($report[0]->image_path) && file_exists($imagePath)) {
                            $imageData = base64_encode(file_get_contents($imagePath));
                            $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                            $mimeType = ($imageType == 'png') ? 'image/png' : 'image/jpeg';
                            echo "
                                    <img width='40%' src='data:{$mimeType};base64,{$imageData}'>
                                ";
                        }
                        ?>
                    </td>
                    <td style="width: 150px;">
                        <img 
                            src="data:image/png;base64,<?php echo base64_encode( file_get_contents(FCPATH.'assets/img/confidential.png')); ?>" 
                            style="width:100%; height:auto;"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        <center><h3><?= isset($report[0]) ? $report[0]->report_no : 'N/A' ?></h3>
                    </td>
                    <td>
                    </td>
                </tr>
                
            </table>
           <!-- PUSATKAN SEMUA -->
            <table width="100%" style="text-align:center; margin-top:10px;">
            <tr>
                <td>
                    &nbsp;
                </td>
                <!-- KOLOM TABEL -->
                <td style="vertical-align:top; text-align:center; width:450px;">
                    <table border="1" style="font-weight:bold; border-collapse:collapse; width:80%; margin:0 auto; height: 80px;">
                        <tr>
                            <td style="text-align:center;">Result</td>
                            <td style="width:80px; text-align:center;">Signature</td>
                            <td style="width:80px; text-align:center;">Reviewed by</td>
                            <td style="width:80px; text-align:center;">Authorized by</td>
                        </tr>
                  
                            <?php
                            // pastikan report ada dan file TTD ada
                            $signature_file = (isset($report[0]) && !empty($report[0]->signature_file)) ? $report[0]->signature_file : null;
                            $review_file    = (isset($report[0]) && !empty($report[0]->review_file)) ? $report[0]->review_file : null;
                            $authorized_file= (isset($report[0]) && !empty($report[0]->authorized_file)) ? $report[0]->authorized_file : null;

                            $signature_name = (isset($report[0]) && !empty($report[0]->signature_name)) ? $report[0]->signature_name : null;
                            $review_name    = (isset($report[0]) && !empty($report[0]->review_name)) ? $report[0]->review_name : null;
                            $authorized_name= (isset($report[0]) && !empty($report[0]->authorized_name)) ? $report[0]->authorized_name : null;

                            // fungsi untuk generate img base64
                            function ttd_img($file) {
                                $filePath = 'images/ttd/' . $file;
                                if ($file && file_exists($filePath) && filesize($filePath) > 0) {
                                    return 'data:image/jpg;base64,' . base64_encode(file_get_contents($filePath));
                                } else {
                                    return ''; // kosong jika file tidak ada
                                }
                            }
                            ?>
                            <tr>
                                <td style="text-align:center; vertical-align:middle; width:50px;">
                                    <?= isset($report[0]) ? $report[0]->result_status : 'N/A' ?>
                                </td>
                                <!-- SIGNATURE -->
                                <td style="width:125px; text-align:center; vertical-align:bottom;">
                                  <div style="height:70px; display:flex; justify-content:center; align-items:center;">
                                        <img src="<?= ttd_img($signature_file) ?>" 
                                            style="max-height:80px; max-width:70%; object-fit:contain;">
                                    </div>
                                    <div style="margin-top:5px;">
                                        <strong><?= $signature_name ?></strong><br>
                                        <span>Date: <?= $report[0]->date_final ?></span>
                                    </div>
                                </td>
                                <!-- REVIEWED -->
                                <td style="width:125px; text-align:center; vertical-align:bottom;">
                                    <div style="height:70px; display:flex; justify-content:center; align-items:center;">
                                        <img src="<?= ttd_img($review_file) ?>" 
                                            style="max-height:80px; max-width:70%; object-fit:contain;">
                                    </div>
                                    <div style="margin-top:5px;">
                                        <strong><?= $review_name ?></strong><br>
                                        <span>Date: <?= $report[0]->date_final ?></span>
                                    </div>
                                </td>
                                <!-- AUTHORIZED -->
                                <td style="width:125px; text-align:center; vertical-align:bottom;">
                                    <div style="height:70px; display:flex; justify-content:center; align-items:center;">
                                        <img src="<?= ttd_img($authorized_file) ?>" 
                                            style="max-height:80px; max-width:70%; object-fit:contain;">
                                    </div>
                                    <div style="margin-top:5px;">
                                        <strong><?= $authorized_name ?></strong><br>
                                        <span>Date: <?= $report[0]->date_final ?></span>
                                    </div>
                                </td>


                            </tr>
                    </table>
                </td>
                <!-- KOLOM GAMBAR -->
                <td style="vertical-align:top; width:140px; text-align:center;">
                    <img 
                        src="data:image/png;base64,<?php echo base64_encode(   file_get_contents(FCPATH.'assets/img/approved.png')); ?>" 
                        style="width:100%; height:auto; margin-top: 60%;">
                </td>
            </tr>
            <tr></tr>
        </table>
        </div>
    </div>
</body>
</html>
