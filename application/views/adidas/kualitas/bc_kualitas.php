<!DOCTYPE html>
<html lang="en">
    <head>
    <?php require_once(__DIR__ . '/../../layout/_meta.php'); ?>


    <title>Handling Sample</title>
    <?php require_once(__DIR__ . '/../../layout/_css.php'); ?>
    <?php require_once(__DIR__ . '/../../layout-fe/_css.php'); ?>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed" style="background-color:#fffffe ;">
    <?php require_once(__DIR__ . '/../../layout-fe/_header.php'); ?>
        <div class="wrapper">
            <div class="content">
              <?php if (!empty($report_header)) : ?>
                    <div class="col-md-12"> 
                        <center>
                            <span style="font-weight:bold; color: #20321e;font-size:12px;">Report No : <?= htmlspecialchars($report_header->report_no) ?></span> |
                            <span style="font-weight:bold; color: #20321e;font-size:12px;">Date Received : <?= date('Y-m-d', strtotime($report_header->datetime_received)) ?></span> |
                            <span style="font-size:12px;"> <a href="<?= site_url('auth/logout_scan') ?>" style="color:red; font-weight:bold;">Logout</a></span>
                        </center>
                    </div>
                    <div class="col-md-12"><br>
                        <center>
                            <img src="<?= base_url('images/' . $report_header->image_path) ?>" alt="Report Image" width="28%;">
                        </center>
                    </div>
                <?php endif; ?>

                <div class="col-md-12"><br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th><center>Color</th>
                                <th><center>Color Of ...</th>
                                <th><center>Color Of Name</th>
                                <th><center>Test Required</th>
                                <?php 
                                    $level = $this->session->userdata('level');
                                    if ($level == 10 || $level == 1):  // Level 10 & Admin punya Aksi
                                ?>
                                    <th>Personil</th>
                                    <th>Test Result</th>
                                    <th>Date Final of Test</th>
                                    <th><center>Aksi</center></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php if (empty($report_data)): ?>
                                <tr>
                                    <td colspan="8" class="text-center text-danger font-weight-bold">
                                        ⚠️ Data tidak ditemukan atau semua test sudah diproses.
                                    </td>
                                </tr>
                            <?php else: ?>
                            <?php
                            $no = 1;
                            $level = $this->session->userdata('level');
                            $base_url = site_url('c_transaksi/bc_testResult/');
                            foreach($report_data as $u) : ?>
                            <tr>
                                <td><center><?=$u->color ?></td>
                                <td><center><?=$u->color_of ?></td>
                                <td><center><?=$u->color_of_name ?></td>
                                <td><center>
                                    <?php
                                    // Map of test names to URL parameters
                                    if ($level == 1 || $level == 7){
                                        $test_map = [
                                            "Color Fastness to House Hold Laundering" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Fastness to Water" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Fastness to Perspiration" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Fastness to Washing" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Fastness to Rubbing" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Fastness to Light Fastness" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Fastness to Light Fastness Perspiration" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Fastness to Phenolic Yellowing" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Fastness to Saliva" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Fastness Dye Transfer In Storage" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            // Add other tests here
                                            "Color Migration Fastness" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Migration Oven Test" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Fastness to Chlorine Water" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Fastness to Sea Water" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Fastness to Chlorine Bleach" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Color Fastness to Non-Chlorine Bleach" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Dimensional Stabilitity to Laundering" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",  
                                            "Appereance Change After Laundering" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",  
                                            "Spirality" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Durability Test" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Wearing Test" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Cuttable Width" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Fabric Weight" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Product Weight" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Piece Weight" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Bow and Skew" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Heat Shrinkage" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Flammability" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Elongation & Recovery" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Fibre/Fuzz" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "ICI Pilling Box" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Martindale Pilling" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Random Tumble Pilling" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Snagging (Snag pod)" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Abrasion Resistance" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Abrasion Sock" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Bursting Pneumatic" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Ball Burst" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Textile Material Thickness Measurement" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Odour" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Moisture Content" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Accelerated Ageing by Hydrolysis" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Residu & Ageing by Test for Sticker" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Pull of Force" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Seam Slippage/Strength" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Seam Slippage of Woven" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Tear Strength" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Yarn Strength" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Tensile Strength" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Tear Force" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Thread Count" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Water Absorbency (Drop Test)" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Wicking Height" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Evaporation Rate" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Water Repellency (Spray Test)" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Waterproof (Hydrostatic)" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Air Permeability" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Fibre Content" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Oil Content" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "pH Value" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Formaldehyde" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Nickel Test" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Azo Dyes" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "AP" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "APEO" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                            "Phtalates" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}"
                                        ];

                                        if (isset($test_map[$u->test_required])) {
                                            $link = $base_url . $test_map[$u->test_required];
                                            echo "<a href=\"{$link}\">{$u->test_required}</a>";
                                        } else {
                                            echo $u->test_required;
                                        }
                                    } else {
                                        // Level lain (misalnya 10), tidak pakai link
                                        echo $u->test_required;
                                    }
                                    ?>
                                </td>
                                <?php if ($level == 10 || $level == 1): ?>
                                    <td><?= $u->personil ?></td>
                                      <td><?= $u->result_status ?></td>
                                    <td><?= $u->date_final?></td>
                                    <td><center>
                                      <a href="<?= site_url('c_transaksi/update_report/') . $u->id_reportkualitas . '/' . $u->id_handlingsample ?>" 
                                        class="btn btn-outline-success btn-sm">
                                        <i class="fa-solid fa-file-pen"></i>
                                        </a>
                                    </center></td>

                                <?php endif; ?>
                            </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php require_once(__DIR__ . '/../../layout/_js.php'); ?>
        <?php require_once(__DIR__ . '/../../layout-fe/_js.php'); ?>
    </body>
</html>
