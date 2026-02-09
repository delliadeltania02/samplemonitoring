<!DOCTYPE html>
<html>
<head>
    <title>TEST REPORT</title>
    <?php require_once('/xampp/htdocs/handlingsample/application/views/layout/_css.php'); ?>
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
        <img style="position: absolute; right: 20px; top: 0px;"
            src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents('/xampp/htdocs/handlingsample/assets/img/images/unnamed.png')) ?>"
            height="50" width="50" alt="logo" />
        <h1>TEST REPORT</h1>
        <table style="width: 100%; padding-left: 540px; padding-top: 20px">
            <tr>
                <td style="width: 80px;">Report No</td>
                <td style="width: 10px; text-align: right;">:</td>
                <td><?= isset($report[0]) ? $report[0]->report_no : 'N/A' ?></td>
            </tr>
            <tr>
                <td>Date of Report</td>
                <td style="text-align: right;">:</td>
                <td><?= isset($report[0]) ? $report[0]->date_sending : 'N/A' ?></td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <td style="width: 50px;"><strong>APPLICANT</strong></td>
                <td style="width: 10px; text-align: right;">:</td>
                <td><?= isset($report[0]) ? $report[0]->applicant : 'N/A' ?></td>
            </tr>
            <tr>
                <td><strong>EXT</strong></td>
                <td style="text-align: right;">:</td>
                <td><?= isset($report[0]) ? $report[0]->telephone : 'N/A' ?></td>
            </tr>
        </table>
        <table style="padding-left: 50px;"><br>
            <tr>
                <td><b>SAMPLE DESCRIPTION</b></td>
            </tr>
        </table>
        <table style="padding-left: 50px;">
            <tr>
                <td style="width: 120px;"><strong>Date of Received</strong></td>
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
                <td style="width: 60px;"><strong>Date of Test</strong></td>
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
                <td><strong>Sample Type</strong></td>
                <td style="text-align: right;">:</td>
                <td></td>
            </tr>
            <tr>
                <td><strong>Buyer</strong></td>
                <td style="text-align: right;">:</td>
                <td> <?= isset($report[0]) ? $report[0]->buyer : 'N/A' ?></td>
            </tr>
            <tr>
                <td><strong>Order No</strong></td>
                <td style="text-align: right;">:</td>
                <td> <?= isset($report[0]) ? $report[0]->order_number : 'N/A' ?></td>
            </tr>
            <tr>
                <td><strong>RMS#</strong></td>
                <td style="text-align: right;">:</td>
                <td>#</td>
            </tr>
            <tr>
                <td><strong>Color</strong></td>
                <td style="text-align: right;">:</td>
                <td><?= isset($report[0]) ? $report[0]->color: 'N/A' ?></td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td style="text-align: right;">:</td>
                <td></td>
            </tr>
            <tr>
                <td><strong>Color</strong></td>
                <td style="text-align: right;">:</td>
                <td><?= isset($report[0]) ? $report[0]->code_of_fabric: 'N/A' ?></td>
            </tr>
            <tr>
                <td><strong>Color</strong></td>
                <td style="text-align: right;">:</td>
                <td><?= isset($report[0]) ? $report[0]->batch_lot: 'N/A' ?></td>
            </tr>
            <tr>
                <td><strong>Composition</strong></td>
                <td style="text-align: right;">:</td>
                <td><?= isset($report[0]) ? $report[0]->composition: 'N/A' ?></td>
            </tr>
            <tr>
                <td><strong>Request Fabric Weight</strong></td>
                <td style="text-align: right;">:</td>
                <td><?= isset($report[0]) ? $report[0]->request_fabric: 'N/A' ?></td>
            </tr>
              <tr>
                <td><strong>Request Width(LP)</strong></td>
                <td style="text-align: right;">:</td>
                <td><?= isset($report[0]) ? $report[0]->request_width: 'N/A' ?></td>
            </tr>
        </table>
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
        <table border="1" style="margin-top: 260px;">
            <thead>
                <!-- HEADER KOLOM -->
                <tr style="font-weight:bold; text-align:center;">
                    <td>No</td>
                    <td>TEST ITEM</td>
                    <td>TEST RESULT</td>
                    <td>REQUIREMENT</td>
                    <td>CONCLUSION</td>
                    <td>TEST METHOD</td>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($method as $u): ?>
                    <tr>
                        <td style="text-align:center;"><?= $no++ ?></td>
                        <td><?= $u['method_name'] ?><br>
                            THE MASS OF THE TEST SPECIMENS : <br>
                            <?= $u['mass_of'] ?><br>
                            THE RANGE OF THE CALIBRATION GRAPH :<br>
                            <?= $u['range_graph_1'] ?> <br>
                            <?= $u['range_graph_2'] ?> <br>
                            <?= $u['remakrs'] ?>
                        </td>
                        <td><center>
                        <?php
                            $val = $u['result_formaldehyde'];

                            echo ($val === '-' || $val === '' || $val === null)
                                ? ''
                                : ((float)$val <= 16.00 ? 'Not Detectable' : $val);
                        ?>
                        </td>

                        <td><CENTER>
                            <?= $u['value_to'] ?>
                        </td>
                        <td><center>
                            <?= $u['status_formaldehyde'] ?>
                        </td>
                        <td><center>
                            <?= $u['method_id'] ?>
                        </td>
                       
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table><br>
        <table style="width:200px;">
            <tr>
                <td>Signed for and on behalf of<br>
                    Laboratorium PT. KAHATEX    
                </td>
            </tr>
            <tr>
                <td>
                <?php
                    // Lokasi file TTD tetap
                    $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/samplemonitoring/images/ttd/TTD-1 Ci Lily Blue.png';

                    // Cek apakah file TTD ada
                    if (file_exists($imagePath)) {
                        $imageData = base64_encode(file_get_contents($imagePath));
                        $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                        $mimeType = ($imageType == 'png') ? 'image/png' : 'image/jpeg';
                        echo "<img width='33%' src='data:{$mimeType};base64,{$imageData}'><br><br>";
                    } else {
                        echo "<p style='color:red;text-align:center;'>TTD tidak ditemukan di folder images.</p>";
                    }
                ?>
                <hr>
                </td>
            </tr>
        </table>
        <div style="">
            <span>Lily Yulianti</span><br>
            <span>Laboratory Manager</span><br>
        </div>
        <div style="margin-top: 5px;">
            <span>NOTE : This Test For Reference Only as per Applicant Request<br>
            Valid for the one sample concerned<br>
            The reported result relate only for the sample items received and tested<br>
            It is prohibited to reproduce the report without approval of the laboratory.
            </span><br>
            <center><span style=font-weight:bold;font-size:11px;">Sample Photo</span><br><br>
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
        </div>
    </div>
</body>
</html>
