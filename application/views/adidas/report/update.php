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


<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
          <li class="breadcrumb-item active">Update Report</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" id="content" data-url="<?= base_url('c_transaksi')?>" >
    <div class="container-fluid">
            <form action = "<?php echo site_url('c_transaksi/editaksi_report'); ?>" method="post" > 
              <div class="card-body">
                <div class="col-md-12">
                  <span style="font-size: 11px; font-weight: bold;">Report Sample</span><hr>
                    <input type="hidden" name="id_reportkualitas" value="<?= $detail->id_reportkualitas; ?>">
                    <input type="hidden" name="id_handlingsample" value="<?= $detail->id_handlingsample; ?>">
                   
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Date Final of Test</label>
                    <input type="date" class="form-control" name="date_final" value="<?=$detail->date_final?>" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Test Pending</label>
                    <input type="text" class="form-control" name="test_pending" value="<?=$detail->test_pending?>" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Personil</label>
                    <input type="text" class="form-control" name="personil" value="<?php echo $this->session->userdata('bg_nama')?>" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Date Sending of Report</label>
                    <input type="date" class="form-control" name="date_sending" value="<?=$detail->date_sending?>" required>
                  </div>
                </div>
              </div>
              <div class="card card-modern">
                  <div class="card-header-modern" data-toggle="collapse" data-target="#cardTestMethod" onclick="this.querySelector('.toggle-icon').classList.toggle('rotate')">
                    <span>Sample Information</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                  </div>
                  <div id="cardTestMethod" class="collapse"><br>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Report No</label>
                          <input type="text" class="form-control" name="report_no" value="<?=$detail->report_no ?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Date Received</label>
                          <input type="text" class="form-control" name="date_received" value="<?= $detail->datetime_received?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Received Sample By</label>
                          <input type="text" class="form-control" name="received_sample_by" value="<?= $detail->received_sample_by?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Applicant</label>
                          <input type="text" class="form-control" name="applicant" value="<?= $detail->applicant?>"disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Departement / Tlp</label>
                          <input type="text" class="form-control" value="<?= $detail->department?> / <?= $detail->telephone ?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Email</label>
                          <input type="text" class="form-control" value="<?= $detail->email ?>"disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Batch / LOT</label>
                          <input type="text" class="form-control" value="<?= $detail->batch_lot?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Order Number / PO-LCO</label>
                          <input type="text" class="form-control" value="<?= $detail->order_number?>"disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Style</label>
                          <input type="text" class="form-control" value="<?= $detail->style_no?>"disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Code Of Fabric</label>
                          <input type="text" class="form-control" value="<?= $detail->code_of_fabric?>"disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Color</label>
                          <input type="text" class="form-control" value="<?= $detail->color?>"disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Color Of</label>
                          <input type="text" class="form-control" value="<?= $detail->color_of?>" disabled>
                      </div>
                    </div>
                  </div>
              </div>
                <div class="card card-modern">
                <div class="card-header-modern" data-toggle="collapse" data-target="#cardAfterWash" onclick="this.querySelector('.toggle-icon').classList.toggle('rotate')">
                    <span>Other Information</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
                <div id="cardAfterWash" class="collapse">
                   <div class="card-body-modern">
                        <div class="col-md-12">
                             <span class="fw-semibold d-block mb-2" style="font-size:12px;"><b>Washing Condition</b></span><br>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox"
                                    name="line_dry"
                                    value="Line Dry"
                                    <?= (!empty($detail->line_dry)) ? 'checked' : '' ?> disabled>
                                    <label class="form-check-label" for="line_dry">Line Dry</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Temperature</label>
                                <input type="text" name="temp" id="temp" class="form-control" value="<?= htmlspecialchars($detail->temp ?? '') ?>"  disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="tumble_dry" name="tumble_dry"  value="Tumble Dry"
                                    <?= (!empty($detail->tumble_dry)) ? 'checked' : '' ?>  disabled>
                                    <label class="form-check-label" for="tumble_dry">Tumble Dry</label>
                                </div>
                            </div>
                        </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                <label>Machine Model</label>
                                <input type="text" name="machine_model" id="machine_model"  class="form-control" value="<?= htmlspecialchars($detail->temp ?? '') ?>"  disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="hand_dry" name="hand_dry" value="Hand Wash Cold"
                                    <?= (!empty($detail->hand_dry)) ? 'checked' : '' ?>  disabled>
                                    <label class="form-check-label" for="hand_dry">Hand Wash Cold</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fibre Composition</label>
                                <input type="text" name="fibre_com" id="fibre_comp" class="form-control" value="<?= htmlspecialchars($detail->fibre_com ?? '') ?>"  disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr class="mt-2 mb-3">
                        </div>
                        <div class="col-md-6">
                            <span class="fw-semibold d-block mb-2" style="font-size:11px;">Stretched Neck Opening is OK according to size spec?</span>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="neck_yes" name="neck_yes" value="Yes"
                                    <?= (!empty($detail->neck_yes)) ? 'checked' : '' ?>  disabled>
                                    <label class="form-check-label" for="neck_yes">Yes</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="neck_no" name="neck_no" value="No"
                                    <?= (!empty($detail->neck_no)) ? 'checked' : '' ?>  disabled>
                                    <label class="form-check-label" for="neck_no">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr class="mt-2 mb-3">
                        </div>
                        <div class="col-md-12">
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;"><b>Spirality</b></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Body (%)</label>
                                <input type="text" name="body" id="body" class="form-control" value="<?= htmlspecialchars($detail->body ?? '') ?>"  disabled>
                            </div>
                        </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label>Sleeve (%)</label>
                                <input type="text" name="sleeve" id="sleeve" class="form-control" value="<?= htmlspecialchars($detail->sleeve ?? '') ?>"  disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sideseam (%)</label>
                                <input type="text" name="sideseam" id="sideseam" class="form-control" value="<?= htmlspecialchars($detail->sideseam ?? '') ?>"  disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sleeve cuff width</label>
                                <input type="text" name="sle_width" id="sle_width" class="form-control" value="<?= htmlspecialchars($detail->sle_width?? '') ?>"  disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>movement of side seam     cm</label>
                                <input type="text" name="mov_sideseam" id="mov_sideseam" class="form-control" value="<?= htmlspecialchars($detail->mov_sideseam ?? '') ?>"  disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>movement of sleeve opening     cm</label>
                                <input type="text" name="mov_sleeve" id="mov_sleeve" class="form-control" value="<?= htmlspecialchars($detail->mov_sleeve ?? '') ?>"  disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr class="mt-2 mb-3">
                        </div>
                        <!------After Wash Appearance Check List------>
                        <div class="col-md-12">
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;"><b>After Wash Appearance Check List</b></span>
                        </div>
                        <div class="col-md-3"><br>
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">Trim Durability</span>
                        </div>
                        <div class="col-md-2"><br>
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">1. Wash</span>
                        </div>
                        <div class="col-md-2"><br>
                           <span style="font-size:12px;">3. Wash**</span>
                        </div>
                        <div class="col-md-2"><br>
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">15. Wash***</span>
                        </div>
                        <div class="col-md-3"><br>
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">Comment</span>
                        </div>
                        <!---PRINT--->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Print / Heat Transfer</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                              <?php $value = $detail->{'1_wash_print'} ?? ''; ?>
                                    <select name="1_wash_print" id="1_wash_print" class="form-control"  disabled>
                                        <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>

                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'3_wash_print'} ?? ''; ?>
                                    <select name="3_wash_print" id="3_wash_print" class="form-control"  disabled>
                                        <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'15_wash_print'} ?? ''; ?>
                                    <select name="15_wash_print" id="15_wash_print" class="form-control"  disabled>
                                        <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                               <input type="text" class="form-control" name="com_wash_print" value="<?= htmlspecialchars($detail->com_wash_print ?? '') ?>"  disabled>
                            </div>
                        </div>
                              <!---Embroidery--->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Embroidery</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'1_wash_emb'} ?? ''; ?>
                                <select name="1_wash_emb" id="1_wash_emb" class="form-control"  disabled>
                                        <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'3_wash_emb'} ?? ''; ?>
                                <select name="3_wash_emb" id="3_wash_emb" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'15_wash_emb'} ?? ''; ?>
                                <select name="15_wash_emb" id="15_wash_emb" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                               <input type="text" class="form-control" id="com_wash_emb" name="com_wash_emb" value="<?= htmlspecialchars($detail->com_wash_print ?? '') ?>"  disabled>
                            </div>
                        </div>
                        <!---Label--->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Label</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'1_wash_label'} ?? ''; ?>
                                <select name="1_wash_label" id="1_wash_label" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'3_wash_label'} ?? ''; ?>
                                 <select name="3_wash_label" id="3_wash_label" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'15_wash_label'} ?? ''; ?>
                                 <select name="15_wash_label" id="15_wash_label" class="form-control"  disabled> 
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                        </select>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                               <input type="text" class="form-control" id="com_wash_label" name="com_wash_label" value="<?= htmlspecialchars($detail->com_wash_label ?? '') ?>"  disabled>
                            </div>
                        </div>
                         <!---Zipper/ snap button/ button/tie cord/etc.--->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Zipper/ snap button/ button/tie cord/etc.</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'1_wash_zip'} ?? ''; ?>
                                <select name="1_wash_zip" id="1_wash_zip" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'3_wash_zip'} ?? ''; ?>
                               <select name="3_wash_zip" id="3_wash_zip" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'15_wash_zip'} ?? ''; ?>
                               <select name="15_wash_zip" id="15_wash_zip" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                               <input type="text" class="form-control" id="com_wash_zip" name="com_wash_zip" value="<?= htmlspecialchars($detail->com_wash_zip ?? '') ?>"  disabled>
                            </div>
                        </div>
                        <div class="col-md-3"><br>
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">Fabric Properties</span>
                        </div>
                        <div class="col-md-2"><br>
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">1. Wash</span>
                        </div>
                        <div class="col-md-2"><br>
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">3. Wash**</span>
                        </div>
                        <div class="col-md-2"><br>
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">15. Wash***</span>
                        </div>
                         <div class="col-md-3"><br>
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">Comment</span>
                        </div>
                        <!---Discoloration   (colour change)--->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Discoloration   (colour change)</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <?php $value = $detail->{'1_wash_dis'} ?? ''; ?>
                               <select name="1_wash_dis" id="1_wash_dis" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'3_wash_dis'} ?? ''; ?>
                                 <select name="3_wash_dis" id="3_wash_dis" class="form-control"  disabled>
                                     <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'15_wash_dis'} ?? ''; ?>
                                <select name="15_wash_dis" id="15_wash_dis" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                               <input type="text" class="form-control" id="com_wash_dis" name="com_wash_dis" value="<?= htmlspecialchars($detail->com_wash_dis?? '') ?>"  disabled>
                            </div>
                        </div>
                        <!---Colour Staining --->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Colour Staining </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                  <?php $value = $detail->{'1_wash_sta'} ?? ''; ?>
                               <select name="1_wash_sta" id="1_wash_sta" class="form-control"  disabled>
                                     <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'3_wash_sta'} ?? ''; ?>
                                <select name="3_wash_sta" id="3_wash_sta" class="form-control"  disabled>
                                  <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'15_wash_sta'} ?? ''; ?>
                                <select name="15_wash_sta" id="15_wash_sta" class="form-control"  disabled>
                                  <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                               <input type="text" class="form-control" id="com_wash_sta" name="com_wash_sta" value="<?= htmlspecialchars($detail->com_wash_sta ?? '') ?>"  disabled>
                            </div>
                        </div>
                        <!---Pilling--->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Pilling</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'1_wash_pil'} ?? ''; ?>
                               <select name="1_wash_pil" id="1_wash_pil" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'3_wash_pil'} ?? ''; ?>
                                <select name="3_wash_pil" id="3_wash_pil" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'15_wash_pil'} ?? ''; ?>
                                <select name="15_wash_pil" id="15_wash_pil" class="form-control"  disabled>
                                   <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                               <input type="text" class="form-control" id="com_wash_pil" name="com_wash_pil" value="<?= htmlspecialchars($detail->com_wash_pil ?? '') ?>"  disabled>
                            </div>
                        </div>
                         <!---Shrinkage & Spirality--->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Shrinkage & Spirality.</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                 <?php $value = $detail->{'1_wash_shrink'} ?? ''; ?>
                                <select name="1_wash_shrink" id="1_wash_shrink" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $value = $detail->{'3_wash_shrink'} ?? ''; ?>
                               <select name="3_wash_shrink" id="3_wash_shrink" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                  <?php $value = $detail->{'15_wash_shrink'} ?? ''; ?>
                               <select name="15_wash_shrink" id="15_wash_shrink" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                               <input type="text" class="form-control" id="com_wash_shrink" name="com_wash_shrink" value="<?= htmlspecialchars($detail->com_wash_shrink ?? '') ?>"  disabled>
                            </div>
                        </div>
                        <!---Appearance of garment after wash---->
                        <div class="col-md-3"><br>
                            <label>Appearance of garment after wash</label>
                        </div>
                        <div class="col-md-2"><br>
                            <div class="form-group">
                                <?php $value = $detail->{'1_wash_app'} ?? ''; ?>
                               <select name="1_wash_app" id="1_wash_app" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2"><br>
                            <div class="form-group">
                                <?php $value = $detail->{'3_wash_app'} ?? ''; ?>
                                  <select name="3_wash_app" id="3_wash_app" class="form-control"  disabled>
                                   <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2"><br>
                            <div class="form-group">
                                <?php $value = $detail->{'15_wash_app'} ?? ''; ?>
                                 <select name="15_wash_app" id="15_wash_app" class="form-control"  disabled>
                                    <option value="" disabled <?= ($value === '' ? 'selected' : '') ?>>PILIH</option>
                                        <?php 
                                            $options = ['Accepted', 'Rejected'];
                                            foreach ($options as $opt) {
                                                $selected = ($value === $opt) ? 'selected' : '';
                                                echo "<option value='$opt' $selected>$opt</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3"><br>
                            <div class="form-group">
                               <input type="text" class="form-control" name="com_wash_app" id="com_wash_app" value="<?= htmlspecialchars($detail->com_wash_app ?? '') ?>"  disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               <div class="card card-modern">
                  <div class="card-header-modern" data-toggle="collapse" data-target="#cardTestInfo" onclick="this.querySelector('.toggle-icon').classList.toggle('rotate')">
                    <span>Test Information</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                  </div>
                  <div id="cardTestInfo" class="collapse"><br>
                    <div class="col-md-12">
                      <div class="form-group">
                          <div class="table-responsive">
                            <table class="table" border="1"> 
                                  <thead>
                                      <tr><center>
                                          <th style="width: 300px;">Method ID</th>
                                          <th style="width: 100px;"><center>Fabric Tech.<br> K: Knit <br>W: Woven</th>
                                          <th style="width: 100px;"><center>Composition<br>N: Natural <br>S:Synthetic</th>
                                          <th style="width: 200px;"><center>Test Standard<br>Name</th>
                                          <th style="width: 250px;"><center>Requirement</th>
                                          <th style="width: 200px;"><center>Test Result</th>
                                          <th style="width: 100px;"><center>Test Details</th>
                                          <th><center>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $no = 1;
                                      foreach($method as $u) { 
                                    ?>
                                    <tr>
                                        <td><?= $u['method_code'] ?></td>
                                        <td><center><?= $u['fabric_tech']?></td>
                                        <td><center><?= $u['composition'] ?></td>
                                        <td><?=$u['method_name']?></td>
                                        <td><?= $u['fashion_casual'] ?><br><br>&nbsp;<?= $u['hybrid_performance'] ?></td>
                                        <td >
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

                                        <td><center><?= $u['uom'] ?></td>
                                        <td><center>
                                              <?php 
                                                $display_numeric = ($u['status_numeric']  === '-') ? '' : $u['status_numeric'];
                                                $display_shrinkage = ($u['status_shrinkage'] === '-') ? '' : $u['status_shrinkage'];
                                                $display_boolean    = ($u['status_boolean']    === '-') ? '' : $u['status_boolean'];
                                                $display_statement  = ($u['status_statement_result']    === '-') ? '' : $u['status_statement_result'];
                                                $display_formaldehyde =  ($u['status_formaldehyde_result'] === '-') ? '' : $u['status_formaldehyde_result'];
                                              ?>
                                              <?= $display_numeric ?>
                                              <?= $display_shrinkage ?>
                                              <?= $display_boolean ?>
                                              <?= $display_statement ?>
                                              <?= $display_formaldehyde ?>
                                        </td>
                                        
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><span style="font-weight: bold;">Result : <?= $detail->result_status ?></span></td>
                                        <td colspan="8"></td>
                                    </tr>
                                  </tbody>
                                  
                              </table>
                          </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="card-footer">
                  <div class="col-md-2">
                          <a href="<?=site_url('c_transaksi/index_report')?>" type="button" class="btn btn-block" style="background-color: #36454F;color: white;" >Back</a> 
                  </div>
                  <div class="col-md-6">
                      
                  </div>
                    <div class="col-md-2">
                          <a href="<?= site_url('c_transaksi/kirim_ulang/'.$detail->id_kualitas.'/'.$detail->id_penerimaan) ?>" class="btn btn-block btn-warning" onclick="return confirm('Kirim ulang ke Kualitas?')">Send To Kualitas</a>
                  </div>  
                  <div class="col-md-2">
                          <button type="submit" class="btn btn-block" style="background-color: #36454F;color: white;" value="Tambah">Submit</button>
                  </div>      
              </div>
            </form>
    </div>
</section>