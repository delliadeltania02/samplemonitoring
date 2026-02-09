<?php
function to_subscript($text) {
    $map = ['0'=>'₀','1'=>'₁','2'=>'₂','3'=>'₃','4'=>'₄','5'=>'₅','6'=>'₆','7'=>'₇','8'=>'₈','9'=>'₉',
            'A'=>'A', 'R'=>'R', 'E'=>'E', 'V'=>'V']; // huruf tetap biasa
    return strtr($text, $map);
}

function extract_subscript_from_report($report_no) {
    // Contoh:
    // LAB2507008113-AF → tidak ada subscript
    // LAB2507008113A1-AF → subscript A1
    // LAB2507008113REV12A3-AF → subscript REV12A3

    if (!$report_no) return '';

    // Ambil bagian di antara code dan "-AF"
    // Misal LABxxxx+A1-AF → dapat "A1"
    if (!preg_match('/LAB[0-9]+(.*)-AF/i', $report_no, $m)) {
        return '';
    }

    $extra = trim($m[1]);
    if ($extra == '') return '';

    // Hilangkan karakter tidak penting
    $extra = strtoupper($extra);
    $extra = preg_replace('/[^A-Z0-9]/', '', $extra);

    return to_subscript($extra); 
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Sock Wash Test Report</title>
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

        .gpc-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .gpc-table th,
        .gpc-table td {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }

        .gpc-table thead th {
            text-align: center;
            font-weight: bold;
        }

        /* tengah */
        .center {
            text-align: center;
        }

        /* diagonal cell */
        .diagonal {
            position: relative;
        }

        .diagonal:before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            border-bottom: 1px solid #000;
            transform: rotate(-45deg);
            top: 0;
            left: 0;
        }

    </style>
</head>
<body>
    <!-- HEADER UTAMA (muncul di semua halaman) -->
    <header>
        <img style="position: absolute; right: 20px; top: 10px;"
            src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents('/xampp/htdocs/samplemonitoring/assets/img/images/unnamed.png')) ?>"
            height="50" width="50" alt="logo" />
        <h1>Sock Wash Test Report</h1>
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
        <table border="1" class="gpc-table">
            <tr>
                <td>Supplier : <?= isset($report[0]) ? $report[0]->supplier_name : 'N/A' ?></td>
                <td>Factory : <?= isset($report[0]) ? $report[0]->supplier_name : 'N/A' ?></td>
                <td>Report No :  <?= isset($report[0]) ? $report[0]->report_no : 'N/A' ?> </td>
                <td>Date: <?= isset($report[0]) ? $report[0]->date_sending : 'N/A' ?></td>
            </tr>
        </table><br>
        <table border="1"  class="gpc-table">
            <tr>
                <td>Working No</td>
                <td><?= isset($report[0]) ? $report[0]->style_no : 'N/A' ?></td>
                <td>PO Number</td>
                <td></td>
                <td>size</td>
                <td><?= isset($report[0]) ? $report[0]->size: 'N/A' ?></td>
            </tr>
            <tr>
                <td>Article No/Colour</td>
                <td><?= isset($report[0]) ? $report[0]->article_no: 'N/A' ?></td>
                <td>Quantity</td>
                <td></td>
                <td>nahmboard numbers</td>
                <td></td>
            </tr>
            <tr>
                <td>Style Name</td>
                <td></td>
                <td>Delivery Date</td>
                <td></td>
                <td>Customer No</td>
                <td></td>
            </tr>
        </table><br>
        <span style="font-size: 12px; font-weight: bold;"><center>Washing Condition</span>
        <table border="1"  class="gpc-table">
            <tr>
                <td>Line Dry</td>
                <td></td>
                <td>Temperature</td>
                <td><?= isset($report[0]) ? $report[0]->temp: 'N/A' ?></td>
            </tr>
            <tr>
                <td>Tumble Dry</td>
                <td></td>
                <td>Fiber composition</td>
                <td><?= isset($report[0]) ? $report[0]->fibre_com: 'N/A' ?></td>
            </tr>
            <tr>
                <td>Hand Wash Cold</td>
                <td></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table><br>
        <?php foreach ($ceklis as $u): ?>
        <?php endforeach; ?>
        <span style="font-size: 12px; font-weight: bold;"><center>After Wash Appearance Checklist</span>
        <table style="border-collapse: collapse; width: 100%; font-size: 12px;">
            <!-- HEADER -->
            <tr>
                <td rowspan="2" colspan="2" style="border:1px solid #000; text-align:center; font-weight:bold;">
                  
                </td>
                <td colspan="2" style="border:1px solid #000; text-align:center; font-weight:bold;">
                    1. wash
                </td>
                <td colspan="2" style="border:1px solid #000; text-align:center; font-weight:bold;">
                    3. wash**
                </td>
                <td colspan="2" style="border:1px solid #000; text-align:center; font-weight:bold;">
                    15. wash***
                </td>
                <td rowspan="2" style="border:1px solid #000; text-align:center; font-weight:bold;">
                    Comment
                </td>
            </tr>
            <tr>
                <td style="border:1px solid #000; text-align:center;">Accepted</td>
                <td style="border:1px solid #000; text-align:center;">Rejected</td>

                <td style="border:1px solid #000; text-align:center;">Accepted</td>
                <td style="border:1px solid #000; text-align:center;">Rejected</td>

                <td style="border:1px solid #000; text-align:center;">Accepted</td>
                <td style="border:1px solid #000; text-align:center;">Rejected</td>
            </tr>
            <tr>
                <td colspan="2" style="border:1px solid #000; padding:4px;">Jaguard logo appearance</td>
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_logo'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_logo'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_logo'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_logo'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_logo'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_logo'] == 'Rejected') ? 'V' : '' ?></td>
                <td style="border:1px solid #000;"> <?= isset($report[0]) ? $report[0]->com_wash_logo : ' ' ?></td>
            </tr>
            </tr>
            <!-- Trim Durability (group label) -->
            <tr>
                <td rowspan="4" style="border:1px solid #000; text-align:center; font-weight:bold;">
                    Trim Durability
                </td>
                <td style="border:1px solid #000; padding:4px;">Print / Heat Transfer</td>
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_print'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_print'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_print'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_print'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_print'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_print'] == 'Rejected') ? 'V' : '' ?></td>
                <td style="border:1px solid #000;"> <?= isset($report[0]) ? $report[0]->com_wash_print : ' ' ?></td>
            </tr>
            <tr>
                <td style="border:1px solid #000; padding:4px;">Embroidery</td>
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_emb'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_emb'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_emb'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_emb'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_emb'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_emb'] == 'Rejected') ? 'V' : '' ?></td>
                <td style="border:1px solid #000;"> <?= isset($report[0]) ? $report[0]->com_wash_emb : ' ' ?></td>
            </tr>
            <tr>
                <td style="border:1px solid #000; padding:4px;">Label</td>
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_label'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_label'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_label'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_label'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_label'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_label'] == 'Rejected') ? 'V' : '' ?></td>
                <td style="border:1px solid #000;"> <?= isset($report[0]) ? $report[0]->com_wash_label : ' ' ?></td>
            </tr>
            <tr>
                <td style="border:1px solid #000; padding:4px;">Zipper / snap button / tie cord / etc.</td>
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_zip'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_zip'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_zip'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_zip'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_zip'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_zip'] == 'Rejected') ? 'V' : '' ?></td>
                <td style="border:1px solid #000;"> <?= isset($report[0]) ? $report[0]->com_wash_zip : ' ' ?></td>
            </tr>
            <!-- Fabric Properties -->
            <tr>
                <td rowspan="4" style="border:1px solid #000; text-align:center; font-weight:bold;">
                    Fabric Properties
                </td>
                <td style="border:1px solid #000; padding:4px;">Discoloration (colour change)</td>
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_dis'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_dis'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_dis'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_dis'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_dis'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_dis'] == 'Rejected') ? 'V' : '' ?></td>
                <td style="border:1px solid #000;"> <?= isset($report[0]) ? $report[0]->com_wash_dis : ' ' ?></td>
            </tr>
            <tr>
                <td style="border:1px solid #000; padding:4px;">Colour Staining</td>
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_sta'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_sta'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_sta'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_sta'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_sta'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_sta'] == 'Rejected') ? 'V' : '' ?></td>
                <td style="border:1px solid #000;"> <?= isset($report[0]) ? $report[0]->com_wash_sta : ' ' ?></td>
            </tr>
            <tr>
                <td style="border:1px solid #000; padding:4px;">Pilling</td>
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_pil'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_pil'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_pil'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_pil'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_pil'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_pil'] == 'Rejected') ? 'V' : '' ?></td>
                <td style="border:1px solid #000;"> <?= isset($report[0]) ? $report[0]->com_wash_pil : ' ' ?></td>
            </tr>
            <tr>
                <td style="border:1px solid #000; padding:4px;">Shrinkage & Spirality</td>
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_shrink'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_shrink'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_shrink'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_shrink'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_shrink'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_shrink'] == 'Rejected') ? 'V' : '' ?></td>
                <td style="border:1px solid #000;"> <?= isset($report[0]) ? $report[0]->com_wash_shrink : ' ' ?></td>
            </tr>
            <tr>
                <td colspan="2" style="border:1px solid #000; padding:4px;">Appearance of garment after wash</td>
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_app'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['1_wash_app'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_app'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['3_wash_app'] == 'Rejected') ? 'V' : '' ?></td>
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_app'] == 'Accepted') ? 'V' : '' ?></td> 
                <td class="center" style="border:1px solid #000;"><?= ($u['15_wash_app'] == 'Rejected') ? 'V' : '' ?></td>
                <td style="border:1px solid #000;"> <?= isset($report[0]) ? $report[0]->com_wash_app : ' ' ?></td>
            </tr>
          
        </table>
      
        <div style="font-size:13px; margin-top:5px;text-decoration: underline;">
            <b>Comment</b>
        </div>
        <div style="font-size:11px; margin-top:5px;">
            <?= isset($report[0]) ? $report[0]->comment_final : ' ' ?>
        </div>
        <div style="font-size:13px; margin-top:5px;text-decoration: underline;">
            <b>Remarks</b>
        </div>
        <div style="font-size:11px; margin-top:5px;">
            <?= isset($report[0]) ? $report[0]->remarks_final : ' ' ?>
        </div>
     <div style="font-size:13px; margin-top:5px; text-decoration: underline;">
        <b>Care Instruction</b>
    </div>

    <table width="100%" style="margin-top:10px; border-collapse:collapse;">
        <tr>
           <td style="
            border:1px solid #000;
            padding:10px 14px;
            display:inline-block;
            white-space:nowrap;
        ">
            <?php
            $uniqueImages = [];

            foreach ($report as $r) {
                if (!empty($r->care_images)) {
                    foreach ($r->care_images as $img) {
                        if (!in_array($img, $uniqueImages)) {
                            $uniqueImages[] = $img;
                        }
                    }
                }
            }

            $uniqueImages = array_slice($uniqueImages, 0, 4);

            foreach ($uniqueImages as $img):
            ?>
                <img 
                    src="data:image/png;base64,<?= $img ?>"
                    style="width:45px; height:auto; margin-right:14px; vertical-align:middle;"
                >
            <?php endforeach; ?>

            </td>
        </tr>
    </table>


        <!-- FOTO BAJU -->
        <table>
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
                    <td>
                        <?php
                        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/samplemonitoring/images/sample_photo' . $report[0]->image_path;
                        if (!empty($report[0]->image_path) && file_exists($imagePath)) {
                            $imageData = base64_encode(file_get_contents($imagePath));
                            $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
                            $mimeType = ($imageType == 'png') ? 'image/png' : 'image/jpeg';
                            echo "
                                    <img width='18%' src='data:{$mimeType};base64,{$imageData}'>
                                ";
                        }
                        ?>
                    </td>
                    <td style="width: 150px;">
                        <img 
                            src="data:image/png;base64,<?php echo base64_encode(file_get_contents('C:/xampp/htdocs/samplemonitoring/assets/img/confidential.png')); ?>" 
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
                        src="data:image/png;base64,<?php echo base64_encode(file_get_contents('C:/xampp/htdocs/samplemonitoring/assets/img/approved.png')); ?>" 
                        style="width:100%; height:auto; margin-top: 60%;">
                </td>
            </tr>
            <tr></tr>
        </table>
        </div>
    </div>
</body>
</html>
