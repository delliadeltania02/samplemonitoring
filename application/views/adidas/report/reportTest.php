<!DOCTYPE html>
<html>
    <head>
        <title>Finished Garment Functional Test</title>
        <?php require_once('/xampp/htdocs/handlingsample/application/views/layout/_css.php'); ?>
        <style>
            @page { margin: 30px 5px; border: 0px; }
            header { position: fixed; top: -60px; left: 0px; right: 0px; background-color: none; height: 50px; }
            footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: none; height: 50px; }
            p { page-break-after: always; }
            p:last-child { page-break-after: never; }
            table { border-spacing: 0; border-collapse: collapse; font-size: 12px; page-break-before: auto; }
            td { padding: 5px; }
        </style>
    </head>
    <body>
        <div class="row">
            <!-- Base64 Image -->
            <img style="padding-left: 88%; padding-top: 0%;" src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents('/xampp/htdocs/handlingsample/assets/img/images/unnamed.png')) ?>" height="50" width="50" alt="base64" />
            
            <!-- Header -->
            <header>
                <h1 style="font-size: 16px; font-weight: bolder; font-family: calibri; padding-left: 37%; padding-top: 6%;">FABRIC TEST REPORT</h1>
            </header>
            <!-- Table for Report Data -->
            <table class="table table-border" style="font-size: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left: 3%; padding-top: 1%; padding-right: 2%;">
                <tr>
                    <td><strong>Test Report No</strong></td>
                    <td>:</td>
                    <td><?= isset($handling) && $handling ? $handling->report_no : 'N/A' ?></td>
                </tr>
                <tr>
                    <td><strong>Date of Received</strong></td>
                    <td>:</td>
                    <td><?= isset($handling) && $handling->datetime_received ? date('d F Y', strtotime($handling->datetime_received)) : 'N/A' ?></td>
                </tr>
                <tr>
                    <td><strong>Date of Test</strong></td>
                    <td>:</td>
                    <td><?= isset($handling) && $handling->date_test ? date('d F Y', strtotime($handling->date_test)) : 'N/A' ?></td>
                </tr>
                <tr>
                    <td><strong>Date</strong></td>
                    <td>:</td>
                    <td><?= date('d F Y') ?></td>
                </tr>
            </table><br>
            <span style="font-size: 12px;padding-left:40%;">Submission No : <?= $handling->sample_no ?> </span>
            <!--Table for material specification-->
            <table class="table table-border" border="1px;" width="100%;" style="font-size: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left: 3%; padding-top: 1%; padding-right: 2%;">
                <tr>
                    <td colspan="3">MATERIAL SPECIFICATION</td>
                </tr>
                <tr>
                    <td colspan="3">Testing Type : <?= isset($handling) && $handling ? $handling->testing_stages : 'N/A' ?></td>
                </tr>
                <tr>
                    <td>Material Supplier : <?= isset($handling) && $handling ? $handling->supplier_name : 'N/A' ?></td>
                    <td>Season : <?= isset($handling) && $handling ? $handling->season: 'N/A' ?></td>
                    <td>Color Code/Name(Solid) :  <?= isset($handling) && $handling ? $handling->color: 'N/A' ?></td>
                </tr>
                <tr>
                    <td>adidas No : <?= isset($handling) && $handling ? $handling->item_no : 'N/A' ?> </td>
                    <td>Weight : / Width :<?= isset($handling) && $handling ? $handling->request_fabric:  'N/A' ?>/<?= isset($handling) && $handling ? $handling->request_width:  'N/A' ?></td>
                    <td>AOP CCN : </td>
                </tr>
                <tr>
                    <td>Supplier Ref : 
                        <?= isset($handling) && isset($handling->supplier_name) && isset($handling->supplier_code) 
                            ? "{$handling->supplier_name} - {$handling->supplier_code}" 
                            : 'N/A' ?>
                    </td>


                    <td>Construction/Finish:</td>
                    <td>Hangtag : </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 250px;">Fabric Type / Composition : <?= isset($handling) && $handling ? $handling->deskripsi : 'N/A' ?> </td>
                    <td colspan="2">Remarks :  
                        <?= isset($handling) && $handling ? $handling->order_number:  ' ' ?>&nbsp;/
                        <?= isset($handling) && $handling ? $handling->code_of_fabric:  ' ' ?>&nbsp;/
                        <?= isset($handling) && $handling ? $handling->batch_lot:  ' ' ?>&nbsp;/
                        <?= isset($handling) && $handling ? $handling->temperature_process:  ' ' ?>
                    </td>
                </tr>
            </table>
            
            <!-- Table for Test Result -->
            <table class="table table-border" border="1px" width="100%;"  style="font-size: 10px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; padding-left: 3%; padding-top: 1%; padding-right: 2%;">
                <thead>
                    <tr style="font-weight:bold;">
                        <td>Method ID</td>
                        <td style="width: 25px;"><center>Fabric Tech. K: Knit <br>W: Woven</td>
                        <td style="width: 25px;"><center>Compositi<br>on<br>N: Natural S:<br>Synthetic</td>
                        <td>Test Standard Name</td>
                        <td>Minimum Requirements<br>Underlined requirements are<br>mandatory<br>on material level!</td>
                        <td>Test Results</td>
                        <td>Test Details</td>
                        <td width="10px;">A/R</td>                
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($method as $u){
                    ?>
                    <tr>
                        <td><?= $u['method_code'] ?></td>
                        <td><center><?= $u['fabric_tech'] ?></td>
                        <td><center><?= $u['composition']?></td>
                        <td><?= $u['title']?></td>
                        <td><?= $u['remakrs']?><br><b>Value From :</b>  <?= $u['value_from'] ?><br><b>Value To :</b><?= $u['value_to']?></td>
                        <td><center>
                            <?php
                                // Jika ada beberapa baris sub-test, loop masing-masing
                                $report_id = $u['id_reportkualitas'];
                                $subtests = $this->db->get_where('report_kualitas', ['id_reportkualitas' => $report_id, 'id_testmatrix' => $u['id_testmatrix']])->result_array();

                                foreach($subtests as $r){
                                    // result selalu tampil
                                    echo '<b>'.$r['result'].'</b> ';

                                    if(!empty($r['comment']) && $r['comment'] !== '-'){
                                        echo $r['comment'].' ';
                                    }

                                    if(!empty($r['statement']) && $r['statement'] !== '-'){
                                        echo $r['statement'].' ';
                                    }

                                    echo '<br>';
                                }
                            ?>
                        </td>
                        <td><center><?= $u['uom']?></td>
                        <td>
                            <?php
                            $items = [
                                $u['result_status'],
                                $u['status_numeric'],
                                $u['status_statement_result'],
                                $u['status_boolean'],
                                $u['status_shrinkage']
                            ];

                            // Filter khusus PDF: buang null, kosong, dan tanda "-"
                            $items = array_filter($items, function($v){
                                return trim($v) !== '' && trim($v) !== '-' && $v !== null;
                            });

                            // GABUNG → tanpa karakter aneh
                            echo implode(' ', $items);
                            ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody> 
            </table>    
        </div>
        <footer style="padding-bottom:50px;">
            <span style="font-size: 9px;"><center>
                PT. KAHATEX<br>Jl. Cijerah Cigondewah Girang 16 RT 001/RW 032 Melong, Cimahi Selatan, Cimahi - Jawa Barat,<br>Tel. : (022) 6031566, 6031030, Fax: (022) 6031488, 6032166<br>Email: lab.umum.bd@kaha.com
            </span>
        </footer>       
    </body>
</html>
