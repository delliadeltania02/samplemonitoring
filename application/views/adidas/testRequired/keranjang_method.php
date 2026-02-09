<tr class="row-keranjang-method">
    <td hidden>
        <input type="text" name="report_no" value="<?= $data_row['report_no'] ?>" hidden>
        <input type=text" name="id_testmethod" value="<?= $data_row['id_testmethod'] ?>">
    </td>

    <td hidden>
        <input type="hidden" name="id_testmatrix_hidden[]" value="<?= $data_row['id_testmatrix'] ?>">
    </td>

    <td class="method_code" style="width:200px;">
        <center>
            <?php $display_method_code = ($data_row['method_code'] === '-') ? '' : $data_row['method_code']; ?>
            <p style="color:blue;"><?= $display_method_code ?></p>
            <input type="hidden" name="method_code_hidden[]" value="<?= $data_row['method_code'] ?>">
            <p><?= $data_row['method_name'] ?></p>
            <input type="hidden" name="method_name_hidden[]" value="<?= $data_row['method_name'] ?>">
        </center>
    </td>

    <td class="measurement" style="width:250px;">
        <center>
            <?php 
                $display_measurement = ($data_row['measurement'] === '-') ? '' : $data_row['measurement']; 
                $display_title = ($data_row['title'] === '-') ? '' : $data_row['title'];
            ?>
            <p><?= $display_measurement ?></p>
            <input type="hidden" name="measurement_hidden[]" value="<?= $data_row['measurement'] ?>">
            <p><?= $display_title ?></p>
            <input type="hidden" name="title_hidden[]" value="<?= $data_row['title'] ?>">
        </center>
    </td>

   <td style="width:10%;">
    <center>
        <?php $display_nahm = ($data_row['nahm_sock'] === '-') ? '' : $data_row['nahm_sock']; ?>
        <?= $display_nahm ?>
        <?php $display_passfail = ($data_row['passfail'] === '-') ? '' : $data_row['passfail']; ?>
        <?= $display_passfail ?>
        <?php $display_passfail1 = ($data_row['passfail1'] === '-') ? '' : $data_row['passfail1']; ?>
        <?= $display_passfail1 ?>
        <?php $display_result = ($data_row['result'] === '-') ? '' : $data_row['result']; ?>
        <?= $display_result ?>
        <?php
            $val = $data_row['result_formaldehyde'];

            echo ($val === '-' || $val === '')
                ? ''
                : ((float)$val <= 16.00 ? 'Not Detectable' : $val);
            ?>
        <input type="hidden" class="form-control nahm_sock" name="nahm_sock_hidden[]" value="<?=  $data_row['nahm_sock'] ?>" >
        <input type="hidden" class="form-control result_formaldehyde" name="result_formaldehyde_hidden[]" value="<?= $data_row['result_formaldehyde'] ?>">
        <input type="hidden" class="form-control result" name="result_hidden[]" value="<?= $data_row['result'] ?>">
       
        <?php
        // =========================
        // BEFORE WASH
        // =========================
          $be = $data_row['be_wash'] ?? '';
            if (!empty($be) && $be !== '-') {
                echo "<div style='margin-top:5px; text-align:left;'><strong>Before wash = </strong>$be</div>";
            }
            // hidden input dengan index $i
            echo '<input type="hidden" name="be_wash[]" value="'.$be.'">';
        // =========================
        // WASHES
        // =========================
        $wash_sets = [
            ['af'=>'af_wash_1','ac'=>'ac_wash_1','label'=>'1x Wash'],
            ['af'=>'af_wash_5','ac'=>'ac_wash_5','label'=>'5x Wash'],
            ['af'=>'af_wash_15','ac'=>'ac_wash_15','label'=>'15x Wash'],
        ];

        foreach($wash_sets as $w){
            $af = $data_row[$w['af']] ?? '';
            $ac = $data_row[$w['ac']] ?? '';

            // tampilkan hanya kalau salah satu bukan '-' dan bukan kosong
            if(($af !== '' && $af !== '-') || ($ac !== '' && $ac !== '-')){
                $display_af = ($af === '-') ? '' : $af;
                $display_ac = ($ac === '-') ? '' : $ac;
               
                echo "<div style='margin-top:5px; text-align:left;'>";
                echo "<strong>{$w['label']}</strong><br>";
                echo "After wash = $display_af<br>";
                echo "Actual Shrinkage = $display_ac";
                echo "</div>";
            }

            // hidden input tetap dikirim
            echo '<input type="hidden" name="'.$w['af'].'[]" value="'.$af.'">';
            echo '<input type="hidden" name="'.$w['ac'].'[]" value="'.$ac.'">';
        }
        ?>
    </center>
</td>


    <td hidden>
        <input type="hidden" class="form-control result_passfail" name="result_passfail_hidden[]" value="<?= $data_row['passfail'] ?>">
    </td>

    <td hidden>
        <input type="hidden" class="form-control result_passfail11" name="result_passfail1_hidden[]" value="<?= $data_row['passfail1'] ?>">
    </td>

    <td class="comment">
        <?php $display_result_sock = ($data_row['result_sock'] === '-') ? '' : $data_row['result_sock']; ?>
        <?= $display_result_sock ?><br>
        <?php $display_comment_sock = ($data_row['comment_sock'] === '-') ? '' : $data_row['comment_sock']; ?>
        <?= $display_comment_sock ?>
        <?php $display_comment = ($data_row['comment'] === '-') ? '' : $data_row['comment']; ?>
        <?= $display_comment ?>
        <?php $display_statement = ($data_row['statement'] === '-') ? '' : $data_row['statement']; ?>
        <?= $display_statement ?>
        <?php 
        $display_mass = ($data_row['mass_of'] === '-' || $data_row['mass_of'] === '') 
            ? '' 
            : 'THE MASS OF THE TEST SPECIMENS :<br>' . $data_row['mass_of']; 
        ?>
        <?= $display_mass ?><br><br>
        <?php
        $display_range_1 = ($data_row['range_graph_1'] === '-' || $data_row['range_graph_1'] === '')
            ? ''
            : 'THE RANGE OF THE CALIBRATION GRAPH<br>' .$data_row['range_graph_1'];
        ?>
        <?= $display_range_1 ?><br>
        <?php $display_range_2 = ($data_row['range_graph_2'] === '-') ? '' : $data_row['range_graph_2']; ?>
        <?= $display_range_2 ?>

        
        <input type="hidden" class="form-control range_2" name="range_graph_2_hidden[]" value="<?= $data_row['range_graph_2'] ?>">
        <input type="hidden" class="form-control range_1" name="range_graph_1_hidden[]" value="<?= $data_row['range_graph_1'] ?>">
        <input type="hidden" class="form-control mass_of" name="mass_of_hidden[]" value="<?= $data_row['mass_of'] ?>">
        <input type="hidden" class="form-control comment" name="comment_hidden[]" value="<?= $data_row['comment'] ?>">
        <input type="hidden" class="form-control statement" name="statement_hidden[]" value="<?= $data_row['statement'] ?>">
    </td>

    <td style="width:10%;" class="status">
        <center>
            <?php
            $statuses = ['status_shrinkage','status_boolean','status_numeric','status_statement_result','status_formaldehyde','status_sock'];
            foreach($statuses as $s){
                $display = ($data_row[$s] === '-') ? '' : $data_row[$s];
                echo $display.' ';
                echo "<input type='hidden' class='{$s}' name='{$s}[]' value='{$data_row[$s]}'>";
            }
            ?>
        </center>
    </td>

    <td style="width:10%;">
        <center>
            <button type="button" class="btn btn-lg btn-danger" id="hapus_method" data-nama-method="<?= $data_row['method_name'] ?>">
                <i class="fa fa-trash"></i>
            </button>
        </center>
    </td>
</tr>
