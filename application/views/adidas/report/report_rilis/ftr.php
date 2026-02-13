<!DOCTYPE html>
<html>
<head>
    <title>Finished Garment Functional Test</title>
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

        <h1>FABRIC TEST REPORT</h1>

        <table style="width: 100%;">
            <tr>
                <td style="width: 140px;"><strong>Test Report No</strong></td>
                <td style="width: 10px; text-align: right;">:</td>
                <td><?= isset($report[0]) ? $report[0]->new_report_no: 'N/A' ?></td>
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
                    <td colspan="8">Testing Type : <?= isset($report[0]) ? $report[0]->testing_stages : 'N/A' ?> </td>
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
                    <td colspan="3">Supplier Ref :  <?= isset($report[0]) ? $report[0]->supplier_code: 'N/A' ?> </td>
                    <td colspan="2">Construction/Finish:</td>
                    <td colspan="3">Hangtag : </td>
                </tr>
                <tr>
                    <td colspan="3" style="width:250px; word-wrap:break-word; white-space:normal;">
                        Fabric Type / Composition :
                        <?= isset($report[0]) ? $report[0]->deskripsi : 'N/A' ?>
                    </td>

                    <td colspan="5"
                        style="
                            word-wrap: break-word;
                            overflow-wrap: break-word;
                            white-space: normal;
                        ">
                        Remarks :
                        <?= isset($report[0]) ? $report[0]->order_number : '' ?>
                        <?= isset($report[0]) ? $report[0]->other_order_number : '' ?> /
                        <?= isset($report[0]) ? $report[0]->code_of_fabric : '' ?> /
                        <?= isset($report[0]) ? $report[0]->batch_lot : '' ?> /
                        <?= isset($report[0]) ? $report[0]->temperature_process : '' ?>
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
        // Grouping by test_type
        $grouped = [];
        foreach ($method as $m) {
            $grouped[$m['test_type']][] = $m;
        }

        // 🔑 SORT BERDASARKAN method_id SAJA
        foreach ($grouped as &$items) {
            usort($items, function ($a, $b) {
                return strcmp($a['method_code'], $b['method_code']); // ASC
            });
        }
        unset($items);

        // Urutan result type
        $urut = ['Physical Test', 'Color Fastness Test', 'Functional Test', 'Chemical Test'];

        foreach ($urut as $type):
            if (!isset($grouped[$type])) continue;

            echo "
            <tr style='background:#f0f0f0; font-weight:bold; text-align:center;'>
                <td colspan='8'>{$type}</td>
            </tr>";

            foreach ($grouped[$type] as $u):
        ?>
<tr>
    <td><br><?= $u['method_code'] ?></td>

                <td style="text-align:center;"><?= $u['fabric_tech'] ?></td>
                <td style="text-align:center;"><?= $u['composition'] ?></td>
                <td><?= $u['title'] ?>
                    <?php if (!empty($u['rilis']) && (int)$u['rilis'] > 0): ?>
                        <sup>A<?= (int)$u['rilis'] ?></sup>
                    <?php endif; ?>
                </td>

                <!-- REMARKS + VALUE FROM / TO -->
                <td>
                    <?php
                    if (!empty($u['remakrs']) && $u['remakrs'] !== '-') {
                        echo $u['remakrs'].'<br>';
                    }

                    if (!empty($u['value_from']) && $u['value_from'] !== '-') {
                        echo '<b>Value From :</b> '.$u['value_from'].'<br>';
                    }

                    if (!empty($u['value_to']) && $u['value_to'] !== '-') {
                        echo '<b>Value To :</b> '.$u['value_to'];
                    }
                    ?>
                </td>

                <!-- RESULT -->
                <td>
                    <?php
                    $report_id = $u['id_reportkualitas'];
                    $subtests = $this->db->get_where(
                        'report_kualitas',
                        [
                            'id_reportkualitas' => $report_id,
                            'id_testmatrix'     => $u['id_testmatrix']
                        ]
                    )->result_array();

                    foreach ($subtests as $r) {
                        $hasOutput = false;

                        if (!empty($r['result']) && $r['result'] !== '-') {
                            echo '<b>'.$r['result'].'</b>';
                            $hasOutput = true;
                        }

                        if (!empty($r['comment']) && $r['comment'] !== '-') {
                            echo ' '.$r['comment'];
                            $hasOutput = true;
                        }

                        if (!empty($r['statement']) && $r['statement'] !== '-') {
                            echo ' '.$r['statement'];
                            $hasOutput = true;
                        }

                        if ($hasOutput) {
                            echo '<br>';
                        }
                    }
                    ?>
                </td>

                <td><?= $u['uom'] ?></td>
                <td><?php 
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
            <?php
                endforeach;
            endforeach;
            ?>
            </tbody>

        </table>
        <div style="margin-top: 10px;">
            <span>NOTE : Valid for the one sample concerned<br>
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
                                <img width='20%' src='data:{$mimeType};base64,{$imageData}'>
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
