<!DOCTYPE html>
<html>
<head>
    <title>TRIM TEST REPORT</title>
    <?php require_once('/xampp/htdocs/samplemonitoring/application/views/layout/_css.php'); ?>
    <style>
        /* Margin halaman */
        @page {
            margin-top: 210px;   /* dikurangi dari 240px */
            margin-bottom: 80px;
            margin-left: 20px;
            margin-right: 20px;
        }

        /* Header halaman */
        header {
            position: fixed;
            top: -190px;        /* naikkan sedikit supaya tidak terlalu jauh dari konten */
            left: 0;
            right: 0;
            height: 180px;      /* sesuaikan dengan tinggi nyata header */
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
            src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents('/xampp/htdocs/samplemonitoring/assets/img/images/unnamed.png')) ?>"
            height="50" width="50" alt="logo" />

        <h1>TRIM TEST REPORT</h1>

        <table style="width: 100%;">
            <tr>
                <td style="width: 140px;"><strong>Applicant</strong></td>
                <td style="width: 10px; text-align: right;">:</td>
                <td><?= isset($report[0]) ? $report[0]->applicant : 'N/A' ?></td>
            </tr>
            <tr>
                <td style="width: 140px;"><strong>Test Report No</strong></td>
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

        <div style="font-size: 12px; text-align:center; margin-top:5px;">
            Submission No : <?= isset($report[0]) ? $report[0]->sample_no : 'N/A' ?>
        </div>
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
                    <td colspan="3" style="width: 250px;">Trim Type :  <?= isset($report[0]) ? $report[0]->deskripsi : 'N/A' ?> </td>
                    <td colspan="5">Remarks :  
                         <?= isset($report[0]) ? $report[0]->order_number : ' ' ?><?= isset($report[0]) ? $report[0]->other_order_number : ' ' ?> &nbsp;/
                         <?= isset($report[0]) ? $report[0]->code_of_fabric : ' ' ?>&nbsp;/
                         <?= isset($report[0]) ? $report[0]->batch_lot : ' ' ?> &nbsp;/
                         <?= isset($report[0]) ? $report[0]->temperature_process : ' ' ?> <br>
                         HP : <br>
                         MC : <br>
                         Tanggal Datang Heat :
                    </td>
                </tr>
                <tr style="border-bottom:none;"><td colspan="8" height="30px"></td></tr>
                
                <!-- HEADER KOLOM -->
                <tr style="font-weight:bold; text-align:center;">
                    <td>Method ID</td>
                    <td>Composition<br>N: Natural<br>S: Synthetic</td>
                    <td>Test Standard Name</td>
                    <td colspan="2">Minimum Requirements<br>(Underlined mandatory)</td>
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

                if ($type == 'Physical Test') {
                        echo "<tr style='background:#f0f0f0; font-weight:bold; text-align:center; font-size:14px;'>
                                <td colspan='8' style='padding:6px;'>Trim {$type}</td>
                            </tr>";
                }


                    $no = 1;
                    foreach ($grouped[$type] as $u):
                ?>
                    <tr>
                        <td><?= $u['method_code'] ?></td>
                        <td style="text-align:center;"><?= $u['composition'] ?></td>
                        <td><?= $u['title'] ?>
                    <?php if (!empty($u['rilis']) && (int)$u['rilis'] > 0): ?>
                        <sup>A<?= (int)$u['rilis'] ?></sup>
                    <?php endif; ?>
                </td>

                        <td colspan="2"><?= $u['remakrs']?><br><b>Value From :</b>  <?= $u['value_from'] ?><br><b>Value To :</b><?= $u['value_to']?></td>
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

                        <td><?= $u['uom'] ?></td>
                        <td> <?php 
                                                $display_numeric = ($u['status_numeric']  === '-') ? '' : $u['status_numeric'];
                                                $display_shrinkage = ($u['status_shrinkage'] === '-') ? '' : $u['status_shrinkage'];
                                                $display_boolean    = ($u['status_boolean']    === '-') ? '' : $u['status_boolean'];
                                                $display_statement  = ($u['status_statement_result']    === '-') ? '' : $u['status_statement_result'];
                                              ?>
                                              <?= $display_numeric ?>
                                              <?= $display_shrinkage ?>
                                              <?= $display_boolean ?>
                                              <?= $display_statement ?></td>
                    </tr>
                <?php
                    endforeach;
                endforeach;
                ?>
            </tbody>
        </table>
        <div style="margin-top: 10px;">
            <span>* All tests need to follow the adidas "Quality Assurance Test Matrix" according to lab test and most updated version<br>
           Revision date formulir : May 2025<br>
           NOTE : Valid for the one sample concerned<br>
           It is prohibited to reproduce the report without approval of the laboratory.
            </span><br>
            <center><span style=font-weight:bold;font-size:14px;">Sample Photo</span><br><br>
            <table>
                <tr><center>
                    <?php
                    $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/samplemonitoring/images/sample_photo/' . $report[0]->image_path;
                    if (!empty($report[0]->image_path) && file_exists($imagePath)) {
                        $imageData = base64_encode(file_get_contents($imagePath));
                        $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                        $mimeType = ($imageType == 'png') ? 'image/png' : 'image/jpeg';
                        echo "
                                <img width='18%' src='data:{$mimeType};base64,{$imageData}'>
                            ";
                    }
                    ?>
                    </tr>
            </table>
            <center><span style="font-weight:bold;font-size:12px;">***End Of Report***</span><br><br>
            <span style="margin-left: 500px;font-weight:bold;font-size:10px">Prepared and checked by:</span><br>
            <span style="margin-left: 470px;font-weight:bold;font-size:10px">Report issued date:</span>
            <table>
            <tr>
                <td style="text-align:center;">
                <?php
                    // Lokasi file TTD tetap
                    $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/samplemonitoring/images/ttd/TTD-1 Ci Lily Blue.png';

                    // Cek apakah file TTD ada
                    if (file_exists($imagePath)) {
                        $imageData = base64_encode(file_get_contents($imagePath));
                        $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                        $mimeType = ($imageType == 'png') ? 'image/png' : 'image/jpeg';
                        echo "<img width='10%' src='data:{$mimeType};base64,{$imageData}' style='margin-left:450px'><br><br>";
                    } else {
                        echo "<p style='color:red;text-align:center;'>TTD tidak ditemukan di folder images.</p>";
                    }
                ?>
                </td>
            </tr>
            </table>
            <span style="margin-left: 420px;font-weight:bold;font-size:10px;text-decoration: underline;">Lily/Erlin</span><br>
            <span style="margin-left: 508px;font-weight:bold;font-size:10px;">Lab. Manager/Ass.Manager</span><br>
        </div>
    </div>
</body>
</html>
