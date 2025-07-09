<tr class="row-keranjang-method">
        <td hidden>
            <?= $this->input->post('report_no') ?>
            <input type="text" name="report_no" id="report_no" value="<?= $this->input->post('report_no')?>" hidden>
        </td>
        <td hidden>
            <?= $this->input->post('id_order') ?>
            <input type="text" name="id_order" id="id_order" value="<?= $this->input->post('id_order')?>" hidden>
        </td>
        <td hidden>
            <?= $this->input->post('id_testmatrix') ?>
            <input type="hidden" name="id_testmatrix_hidden[]" id="id_testmatrix" value="<?= $this->input->post('id_testmatrix')?>">
        </td>
        <td class="method_code width="200px;"><center>
            <p style="color:blue;"><?= $this->input->post('method_code') ?></p>
            <input type="hidden" name="method_name_hidden[]" id="method_name" value="<?= $this->input->post('method_name')?>">
            <p><?= $this->input->post('method_name') ?></p>
            <input type="hidden" name="method_code_hidden[]" id="method_code" value="<?= $this->input->post('method_code')?>">
        </td>
        <td class="measurement" width="250px;"><center>
            <p><?= $this->input->post('measurement') ?></p>
            <input type="hidden" name="measurement_hidden[]" id="measurement" value="<?= $this->input->post('measurement')?>">  
            <p><?= $this->input->post('title') ?></p>
            <input type="hidden" name="title_hidden[]" id="title" value="<?= $this->input->post('title')?>">  
        </td>
        <td style="width: 10%;"><center>
            <?= $this->input->post('result') ?> 
            <input class="form-control result" type="hidden" id="result" name="result_hidden[]" style="align: middle;" value="<?= $this->input->post('result')?>">
           
        </td>
        <td hidden ><center>
            <?= $this->input->post('result_passfail') ?>
            <input class="form-control result_passfail" type="hidden" id="result_passfail" name="result_passfail_hidden[]" style="align: middle;" value="<?= $this->input->post('result_passfail')?>">
        </td>
        <td hidden><center>
            <?= $this->input->post('result_passfail1') ?>
            <input class="form-control result_passfail11" type="hidden" id="result_passfail1" name="result_passfail1_hidden[]" style="align: middle;" value="<?= $this->input->post('result_passfail1')?>">
        </td>

        <td class="comment" ><center>
            <?= $this->input->post('comment') ?><?= $this->input->post('statement')?>
            <input class="form-control comment" type="hidden" id="comment" name="comment_hidden[]" style="align: middle;" value="<?= $this->input->post('comment')?>">
            <input class="form-control statement" type="hidden" id="statement" name="statement_hidden[]" style="align: middle;" value="<?= $this->input->post('statement')?>">
        </td>
        <td style="width: 10%;" class="status" ><center>
            <?= $this->input->post('status') ?> <?= $this->input->post('status_passfail') ?>
            <input class="form-control status_passfail" type="hidden" id="status_passfail" name="status_passfail_hidden[]" style="align: middle;" value="<?= $this->input->post('status_passfail')?>">
        </td>
        <td hidden>
            <input type="hidden" class="status" name="status_hidden[]" id="status" value="<?= $this->input->post('status')?>"  style="border:0; outline:0;" readonly>
        </td>
        <td style="width: 10%;"><center>
            <button type="button" class="btn btn-lg btn-danger" id="hapus_method" data-nama-method="<?= $this->input->post('method_name')?>"><i class="fa fa-trash"></i></button>
        </td>
</tr>