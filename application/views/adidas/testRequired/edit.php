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

        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
                <li class="breadcrumb-item active">Kualitas - <?= htmlspecialchars($detail->report_no ?? '') ?></li>
                </ol>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><button data-target="#ModalOption" data-toggle="modal" type="button" class="btn btn-sm btn-outline-primary" id="tambah">Method List</button></li>
            </ol>
          </div>
        </div>
      </div>
</div>
<section class="content">
    <div class="container-fluid">
        <form action = "<?php echo site_url('c_transaksi/editaksi_method'); ?>" method="post" name="method"> 
            <!-- Inputan ID -->
            <input type="hidden" name="id_kualitas" id="id_kualitas" value="<?= htmlspecialchars($detail->id_kualitas ?? '') ?>" >
            <input type="hidden" name="test_required" id="test_required" value="<?= htmlspecialchars($detail->test_required ?? '') ?>" readonly>
            <input type="hidden" name="id_penerimaan" id="id_penerimaan" value="<?= htmlspecialchars($detail->id_penerimaan ?? '') ?>" >
            <input type="hidden" name="id_reportkualitas" id="id_reportkualitas" value="<?= htmlspecialchars($detail->id_reportkualitas ?? $kodereport ?? '') ?>" >
            <input type="hidden" name="report_no" id="report_no" value="<?= htmlspecialchars($detail->report_no?? '') ?>" > 
            <!-- CARD Data Quality -->
            <div class="card card-modern">
                <div class="card-header-modern" data-toggle="collapse" data-target="#cardDataQuality" onclick="this.querySelector('.toggle-icon').classList.toggle('rotate')">
                    <span>Kualitas - <?= htmlspecialchars($detail->test_required ?? '') ?></span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
                <div id="cardDataQuality" class="collapse show">
                    <div class="card-body-modern">
                        <!-- Semua input Data Quality -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>Date Of Sampling</label>
                                <input class="form-control" type="date" name="date_sampling" value="<?= htmlspecialchars($detail->date_sampling?? '') ?>" >
                            </div>
                            <div class="col-md-6">
                                <label>Time Of Sampling</label>
                                <input class="form-control" type="time" name="time_sampling" value="<?= htmlspecialchars($detail->time_sampling ?? '') ?>" >
                            </div>
                            <div class="col-md-6 mt-2">
                                <label>Date Of Test</label>
                                <input class="form-control" type="date" name="date_test" value="<?= htmlspecialchars($detail->date_test?? '') ?>" >
                            </div>
                            <div class="col-md-6 mt-2">
                                <label>Date Finish Of Test</label>
                                <input class="form-control" type="date" name="date_finish" value="<?= htmlspecialchars($detail->date_finish ?? '') ?>" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CARD Other -->
            <div class="card card-modern other" style="display: none;">
                <div class="card-header-modern" data-toggle="collapse" data-target="#cardAfterWash" onclick="this.querySelector('.toggle-icon').classList.toggle('rotate')">
                    <span>Other - <?= htmlspecialchars($detail->test_required ?? '') ?></span>
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
                                    <?= (!empty($detail->line_dry)) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="line_dry">Line Dry</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Temperature</label>
                                <input type="text" name="temp" id="temp" class="form-control" value="<?= htmlspecialchars($detail->temp ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="tumble_dry" name="tumble_dry"  value="Tumble Dry"
                                    <?= (!empty($detail->tumble_dry)) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="tumble_dry">Tumble Dry</label>
                                </div>
                            </div>
                        </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                <label>Machine Model</label>
                                <input type="text" name="machine_model" id="machine_model"  class="form-control" value="<?= htmlspecialchars($detail->temp ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="hand_dry" name="hand_dry" value="Hand Wash Cold"
                                    <?= (!empty($detail->hand_dry)) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="hand_dry">Hand Wash Cold</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fibre Composition</label>
                                <input type="text" name="fibre_com" id="fibre_comp" class="form-control" value="<?= htmlspecialchars($detail->fibre_com ?? '') ?>">
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
                                    <?= (!empty($detail->neck_yes)) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="neck_yes">Yes</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="neck_no" name="neck_no" value="No"
                                    <?= (!empty($detail->neck_no)) ? 'checked' : '' ?>>
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
                                <input type="text" name="body" id="body" class="form-control" value="<?= htmlspecialchars($detail->body ?? '') ?>">
                            </div>
                        </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label>Sleeve (%)</label>
                                <input type="text" name="sleeve" id="sleeve" class="form-control" value="<?= htmlspecialchars($detail->sleeve ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sideseam (%)</label>
                                <input type="text" name="sideseam" id="sideseam" class="form-control" value="<?= htmlspecialchars($detail->sideseam ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sleeve cuff width</label>
                                <input type="text" name="sle_width" id="sle_width" class="form-control" value="<?= htmlspecialchars($detail->sle_width?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>movement of side seam     cm</label>
                                <input type="text" name="mov_sideseam" id="mov_sideseam" class="form-control" value="<?= htmlspecialchars($detail->mov_sideseam ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>movement of sleeve opening     cm</label>
                                <input type="text" name="mov_sleeve" id="mov_sleeve" class="form-control" value="<?= htmlspecialchars($detail->mov_sleeve ?? '') ?>">
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
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">3. Wash**</span>
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
                                    <select name="1_wash_print" id="1_wash_print" class="form-control">
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
                                    <select name="3_wash_print" id="3_wash_print" class="form-control">
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
                                    <select name="15_wash_print" id="15_wash_print" class="form-control">
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
                               <input type="text" class="form-control" name="com_wash_print" value="<?= htmlspecialchars($detail->com_wash_print ?? '') ?>">
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
                                <select name="1_wash_emb" id="1_wash_emb" class="form-control">
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
                                <select name="3_wash_emb" id="3_wash_emb" class="form-control">
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
                                <select name="15_wash_emb" id="15_wash_emb" class="form-control">
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
                               <input type="text" class="form-control" id="com_wash_emb" name="com_wash_emb" value="<?= htmlspecialchars($detail->com_wash_print ?? '') ?>">
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
                                <select name="1_wash_label" id="1_wash_label" class="form-control">
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
                                 <select name="3_wash_label" id="3_wash_label" class="form-control">
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
                                 <select name="15_wash_label" id="15_wash_label" class="form-control">
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
                               <input type="text" class="form-control" id="com_wash_label" name="com_wash_label" value="<?= htmlspecialchars($detail->com_wash_label ?? '') ?>">
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
                                <select name="1_wash_zip" id="1_wash_zip" class="form-control">
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
                               <select name="3_wash_zip" id="3_wash_zip" class="form-control">
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
                               <select name="15_wash_zip" id="15_wash_zip" class="form-control">
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
                               <input type="text" class="form-control" id="com_wash_zip" name="com_wash_zip" value="<?= htmlspecialchars($detail->com_wash_zip ?? '') ?>">
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
                               <select name="1_wash_dis" id="1_wash_dis" class="form-control">
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
                                 <select name="3_wash_dis" id="3_wash_dis" class="form-control">
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
                                <select name="15_wash_dis" id="15_wash_dis" class="form-control">
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
                               <input type="text" class="form-control" id="com_wash_dis" name="com_wash_dis" value="<?= htmlspecialchars($detail->com_wash_dis?? '') ?>">
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
                               <select name="1_wash_sta" id="1_wash_sta" class="form-control">
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
                                <select name="3_wash_sta" id="3_wash_sta" class="form-control">
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
                                <select name="15_wash_sta" id="15_wash_sta" class="form-control">
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
                               <input type="text" class="form-control" id="com_wash_sta" name="com_wash_sta" value="<?= htmlspecialchars($detail->com_wash_sta ?? '') ?>">
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
                               <select name="1_wash_pil" id="1_wash_pil" class="form-control">
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
                                <select name="3_wash_pil" id="3_wash_pil" class="form-control">
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
                                <select name="15_wash_pil" id="15_wash_pil" class="form-control">
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
                               <input type="text" class="form-control" id="com_wash_pil" name="com_wash_pil" value="<?= htmlspecialchars($detail->com_wash_pil ?? '') ?>">
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
                                <select name="1_wash_shrink" id="1_wash_shrink" class="form-control">
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
                               <select name="3_wash_shrink" id="3_wash_shrink" class="form-control">
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
                               <select name="15_wash_shrink" id="15_wash_shrink" class="form-control">
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
                               <input type="text" class="form-control" id="com_wash_shrink" name="com_wash_shrink" value="<?= htmlspecialchars($detail->com_wash_shrink ?? '') ?>">
                            </div>
                        </div>
                        <!---Appearance of garment after wash---->
                        <div class="col-md-3"><br>
                            <label>Appearance of garment after wash</label>
                        </div>
                        <div class="col-md-2"><br>
                            <div class="form-group">
                                <?php $value = $detail->{'1_wash_app'} ?? ''; ?>
                               <select name="1_wash_app" id="1_wash_app" class="form-control">
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
                                  <select name="3_wash_app" id="3_wash_app" class="form-control">
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
                                 <select name="15_wash_app" id="15_wash_app" class="form-control">
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
                               <input type="text" class="form-control" name="com_wash_app" id="com_wash_app" value="<?= htmlspecialchars($detail->com_wash_app ?? '') ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              <!-- CARD Sock -->
            <div class="card card-modern sock" style="display: none;">
                <div class="card-header-modern" data-toggle="collapse" data-target="#cardDataSock" onclick="this.querySelector('.toggle-icon').classList.toggle('rotate')">
                    <span>After Wash Appearance Checklist Sock</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
                <div id="cardDataSock" class="collapse">
                    <div class="card-body-modern">
                        <!-- Semua input Data Quality -->
                        <div class="row">
                        <div class="col-md-3"><br>
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">&nbsp;</span>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jaguard logo appearance</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                               <?php $value = $detail->{'1_wash_logo'} ?? ''; ?>
                                <select name="1_wash_logo" id="1_wash_logo" class="form-control">
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
                                <?php $value = $detail->{'3_wash_logo'} ?? ''; ?>
                                <select name="3_wash_logo" id="3_wash_logo" class="form-control">
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
                               <?php $value = $detail->{'15_wash_logo'} ?? ''; ?>
                                <select name="15_wash_logo" id="15_wash_logo" class="form-control">
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
                               <input type="text" class="form-control" name="com_wash_logo" value="<?=  $detail->com_wash_logo ?>">
                            </div>
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
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">3. Wash**</span>
                        </div>
                        <div class="col-md-2"><br>
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">15. Wash***</span>
                        </div>
                        <div class="col-md-3"><br>
                           <span class="fw-semibold d-block mb-2" style="font-size:12px;">Comment</span>
                        </div>
                        <div class="col-md-12">
                            <hr>
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
                                <select name="1_wash_print" id="1_wash_print" class="form-control">
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
                                <select name="3_wash_print" id="3_wash_print" class="form-control">
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
                                <select name="15_wash_print" id="15_wash_print" class="form-control">
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
                               <input type="text" class="form-control" name="com_wash_print" value="<?= $detail->com_wash_print ?>">
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
                                <select name="1_wash_emb" id="1_wash_emb" class="form-control">
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
                                <select name="3_wash_emb" id="3_wash_emb" class="form-control">
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
                                <select name="15_wash_emb" id="15_wash_emb" class="form-control">
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
                               <input type="text" class="form-control" id="com_wash_emb" name="com_wash_emb" <?= $detail->com_wash_emb ?>>
                            </div>
                        </div>
                        <!---Label--->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Accesorries (badge/label etc.)</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                 <?php $value = $detail->{'1_wash_label'} ?? ''; ?>
                                <select name="1_wash_label" id="1_wash_label" class="form-control">
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
                                <select name="3_wash_label" id="3_wash_label" class="form-control">
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
                                <select name="15_wash_label" id="15_wash_label" class="form-control">
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
                               <input type="text" class="form-control" id="com_wash_label" name="com_wash_label" value="<?= $detail->com_wash_label ?>">
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
                        <div class="col-md-12">
                            <hr>
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
                                <select name="1_wash_dis" id="1_wash_dis" class="form-control">
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
                                <select name="3_wash_dis" id="3_wash_dis" class="form-control">
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
                                <select name="15_wash_dis" id="15_wash_dis" class="form-control">
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
                               <input type="text" class="form-control" id="com_wash_dis" name="com_wash_dis" value="<?= $detail->com_wash_dis ?>">
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
                               <select name="1_wash_sta" id="1_wash_sta" class="form-control">
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
                                <select name="3_wash_sta" id="3_wash_sta" class="form-control">
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
                                <select name="15_wash_sta" id="15_wash_sta" class="form-control">
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
                               <input type="text" class="form-control" id="com_wash_sta" name="com_wash_sta" value="<?= htmlspecialchars($detail->com_wash_sta ?? '') ?>">
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
                               <select name="1_wash_pil" id="1_wash_pil" class="form-control">
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
                                <select name="3_wash_pil" id="3_wash_pil" class="form-control">
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
                                <select name="15_wash_pil" id="15_wash_pil" class="form-control">
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
                               <input type="text" class="form-control" id="com_wash_pil" name="com_wash_pil" value="<?= htmlspecialchars($detail->com_wash_pil ?? '') ?>">
                            </div>
                        </div>
                        <!---Appearance of sock after wash---->
                              <div class="col-md-2"><br>
                            <div class="form-group">
                                <?php $value = $detail->{'1_wash_app'} ?? ''; ?>
                               <select name="1_wash_app" id="1_wash_app" class="form-control">
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
                                  <select name="3_wash_app" id="3_wash_app" class="form-control">
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
                                 <select name="15_wash_app" id="15_wash_app" class="form-control">
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
                               <input type="text" class="form-control" name="com_wash_app" id="com_wash_app" value="<?= htmlspecialchars($detail->com_wash_app ?? '') ?>">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CARD Test Method -->
            <div class="card card-modern">
                <div class="card-header-modern" data-toggle="collapse" data-target="#cardTestMethod" onclick="this.querySelector('.toggle-icon').classList.toggle('rotate')">
                    <span>Method - <?= htmlspecialchars($detail->test_required ?? '') ?></span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
                <div id="cardTestMethod" class="collapse">
                    <div class="card-body-modern test_result">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Method Group</label>
                                <select name="method_group" id="method_group" class="form-control" onchange="updateTestMatrixDropdown(this.value)">
                                    <option selected disabled>Pilih Method Group</option>
                                    <?php foreach ($method_groups as $method_group): ?>
                                        <option value="<?php echo $method_group->method_group; ?>"><?php echo $method_group->method_group; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Test Matrix</label>
                                <select class="form-control select2" name="id_testmatrix" id="id_testmatrix" data-placeholder="Pilih Test Matrix">
                                    <option selected disabled>Pilih Test Matrix</option>
                                </select>
                                <input type="text" name="method_code" id="method_code" value="" class="form-control" hidden>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title_row" id="title_row"  value="<?= $this->input->post('title')?>" readonly class="form-control"></input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Measurement</label>
                                <input type="text" name="measurement_row" id="measurement_row" value="<?= $this->input->post('measurement')?>" readonly class="form-control"></input>
                            </div>
                        </div>
                         <div class="col-md-6" style="display: none;">
                            <div class="form-group">
                                <label>Value From</label>
                                <input type="text" name="value_from_row" id="value_from" value="<?= $this->input->post('value_from')?>" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 " style="display: none;">
                            <div class="form-group">
                                <label>Value To</label>
                                <input type="text" name="value_to_row" id="value_to" value="<?= $this->input->post('value_to')?>" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Test Result Type</label>
                                <select name="result_type" id="result_type" class="form-control" disabled>
                                    <option selected disabled>PILIH</option>
                                    <option value="boolean">Boolean</option>
                                    <option value="number">Number</option>
                                    <option value="statement">Statement</option>
                                    <option value="shrinkage">Shrinkage</option>
                                    <option value="formaldehyde">Formaldehyde</option>
                                    <option value="sock">Sock</option>
                                </select>
                            </div>
                        </div>
                        <!---SHRINKAGE--->
                        <!-- BEFORE WASH -->
                        <div class="col-md-6 shrinkage">
                            <div class="form-group">
                                <label>Before Wash: </label>
                                <input type="text" name="be_wash" id="be_wash" class="form-control">
                            </div>
                        </div>
                        <!-- WASH 1 -->
                        <div class="col-md-4 shrinkage">
                            <label>1. Wash: </label>
                            <span id="ac_wash_1_display" style="font-weight:bold; margin-left:5px;" hidden></span>
                            <span id="status_ac_wash_1_display" style="font-weight:bold; margin-left:10px;" onchange="status_shrinkage();"></span>
                        </div>
                        <!-- WASH 5 -->
                        <div class="col-md-4 shrinkage">
                            <label>5. Wash: </label>
                            <span id="ac_wash_5_display" style="font-weight:bold; margin-left:5px;" hidden></span>
                            <span id="status_ac_wash_5_display" style="font-weight:bold; margin-left:10px;" onchange="status_shrinkage();"></span>
                        </div>
                        <!-- WASH 15 -->
                        <div class="col-md-4 shrinkage">
                            <label>15. Wash: </label>
                            <span id="ac_wash_15_display" style="font-weight:bold; margin-left:5px;" hidden></span>
                            <span id="status_ac_wash_15_display" style="font-weight:bold; margin-left:10px;" onchange="status_shrinkage();"></span>
                        </div>
                        <!-- GLOBAL STATUS -->
                        <div class="col-md-4" hidden>
                            <label>Status Global: </label>
                            <span id="status_passfail_display" style="font-weight:bold; color:blue; margin-left:5px;"></span>
  
                        </div>
                        <!---AFTER WASH 1--->
                        <div class="col-md-2 shrinkage">
                            <div class="form-group">
                                <label>After Wash</label>
                                <input type="text" name="af_wash_1" id="af_wash_1" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 shrinkage">
                            <div class="form-group">
                                <label>Actual Shrinkage</label>
                                <input type="text" name="ac_wash_1" id="ac_wash_1" class="form-control" readonly>
                            </div>
                        </div>
                        <!---AFTER WASH 5--->
                        <div class="col-md-2 shrinkage">
                            <div class="form-group">
                                <label>After Wash</label>
                                <input type="text" name="af_wash_5" id="af_wash_5" class="form-control">
                            </div>
                        </div>
                         <div class="col-md-2 shrinkage">
                            <div class="form-group">
                                <label>Actual Shrinkage</label>
                                <input type="text" name="ac_wash_5" id="ac_wash_5" class="form-control" readonly>
                            </div>
                        </div>
                        <!---AFTER WASH 15--->
                         <div class="col-md-2 shrinkage">
                            <div class="form-group">
                                <label>After Wash</label>
                                <input type="text" name="af_wash_15" id="af_wash_15" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 shrinkage">
                            <div class="form-group">
                                <label>Actual Shrinkage</label>
                                <input type="text" name="ac_wash_15" id="ac_wash_15" class="form-control" readonly>
                            </div>
                        </div>
                        <!---END SHRINKAGE--->
                        <div class="col-md-6" id="div_statement" style="display: none;">
                            <div class="form-group">
                                <label>Statement</label>
                                <textarea type="text" name="statement" id="statement" value="<?= $this->input->post('statement')?>" readonly class="form-control"></textarea>
                            </div>                       
                        </div>
                        <div class="col-md-3" id="div_statement_status" style="display: none;">
                            <div class="form-group">
                                <label>Result</label>
                                   <select name="status_statement_row" id="status_statement" class="form-control status_statement">
                                    <option selected disabled>Pilih</option>
                                    <option value="Accepted">Accepted</option>
                                    <option value="Rejected">Rejected</option>
                                    <option value="Not Available">Not Available</option>
                                </select>
                            </div>                         
                        </div>
                        <div class="col-md-3" id="div_value_from" style="display: none;">
                            <div class="form-group">
                                <label>Value From</label>
                                <input type="text" name="value_from_row" id="value_from_row" value="<?= $this->input->post('value_from')?>" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3" id="div_value_to" style="display: none;">
                            <div class="form-group">
                                <label>Value To</label>
                                <input type="text" name="value_to_row" id="value_to_row" value="<?= $this->input->post('value_to')?>" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3" id="div_result" style="display: none;">
                            <div class="form-group">
                                <label>Result</label>
                                <input type="text" name="result_row" id="result" value="" readonly class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-12" id="div_status" style="display: none;">
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" name="status" id="status" value="" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3" id="div_passfail" style="display: none;">
                            <div class="form-group">
                                <label>Result / Before Wash</label>
                                <select name="result_passfail_row" id="result_passfail" class="form-control result_passfail" onchange="status_boolean(this);">
                                    <option selected disabled>Pilih</option>
                                    <option value="Accepted">Accepted</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3" id="div_passfail_1" style="display: none;">
                            <div class="form-group">
                                <label>Result / 1. Wash</label>
                                <select name="state_1" id="result_passfail1" class="form-control result_passfail1" onchange="status_boolean(this);">
                                    <option selected disabled>Pilih</option>
                                    <option value="Accepted">Accepted</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3" id="div_status_statement" style="display: none;">
                            <div class="form-group">
                                <label>Result</label>
                                <select name="state_2"  class="form-control result_passfail1" onchange="status_boolean(this);">
                                    <option selected disabled>Pilih</option>
                                    <option value="Accepted">Accepted</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                        </div>             
                        <div class="col-md-3" id="div_comment" style="display: none;">
                            <div class="form-group">
                                <label>Comment</label>
                                <input type="text" name="comment" id="comment" value="" class="form-control" >
                            </div>
                        </div>
                         <!---FORMALDEHYDE---->
                        <div class="col-md-2 formaldehyde" style="display: none;">
                            <label>The mass of the test specimens</label>
                            <input type="text" name="mass_of" class="form-control">
                        </div> 
                        <div class="col-md-2 formaldehyde" style="display: none;">
                            <label>The range of the calibration graph</label>
                            <input type="text" name="range_graph_1" class="form-control" placeholder="ex: CONCENTRATION 15-600 PPM">
                            <input type="text" name="range_graph_2" class="form-control" placeholder="ex: ABS 0.026 - 0.804">
                        </div> 
                        <div class="col-md-1 formaldehyde" style="display: none;">
                            <label>Result</label>
                            <input type="text" name="result_formaldehyde" class="form-control" oninput="status_formaldehyde_result()">
                        </div> 
                        <!---SOCK--->
                         <div class="col-md-3 sock" style="display: none;">
                            <div class="form-group">
                                <label>nahmboard number</label>
                                <input type="text" name="nahm_sock" id="nahm_sock" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 sock" style="display: none;">
                            <div class="form-group">
                                <label>Result</label>
                                <select name="result_sock" id="result_sock" class="form-control result_sock" onchange="updateStatusSock(this);">
                                    <option selected disabled>Pilih</option>
                                    <option value="Accepted">Accepted</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 sock" style="display: none;">
                            <div class="form-group">
                                <label>Comment</label>
                                <input type="text" name="comment_sock" id="comment_sock" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id="status_sock" name="status_sock" class="status_row">

                        <input type="hidden" id="status_formaldehyde" name="status_formaldehyde" class="status_row">
                        <input type="hidden" id="status_numeric" name="status_numeric" class="status_row">

                        <input type="hidden" id="status_shrinkage" name="status_shrinkage" class="status_row">

                        <input type="hidden" id="status_boolean" name="status_boolean" class="status_row">

                        <input type="hidden" id="status_statement_result" name="status_statement_result" class="status_row">

                        <div class="col-md-1">
                            <label>&nbsp;</label>
                            <button disabled type="button" class="btn btn-block" style="background-color: #001f3f; color: white;" id="tambah"><i class="fa fa-plus"></i></button>
                        </div>
                        
                    </div>
                </div>
                <div class="collapse show" id="cardKerajangMethod">
                    <div class="col-md-12"><hr>
                            <div class="form-group">
                                <div class="table-responsive keranjang_method">                   
                                    <table id="keranjang_method" class="table table-bordered" style="font-size: 10px;">
                                        <thead style=" font-weight: bolder;">
                                            <tr>
                                                <td hidden>Report No</td>
                                                <td rowspan="2" width="200px;"><center>Test Method</td>
                                                <td rowspan="2" width="250px;"><center>Method Name</td>
                                                <td><center>Test Result</td>
                                                <td ><center>Comment / Statement</td>
                                                <td ><center>Status</td>
                                                <td ><center>Aksi</td>
                                            </tr>
                                            <tr hidden>
                                                <td width="130px;"><center>Result</td>
                                                <td width="130px;"><center>Before Wash</td>
                                                <td width="130px;"><center>1. Wash</td>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-keranjang">
                                       <?php foreach ($method as $i => $u): ?>
                                            <?php
                                            $data_row = [
                                                'report_no' => $this->input->post('report_no')[$i] ?? $u['report_no'],
                                                //'id_order'  => $this->input->post('id_order')[$i] ?? $u['id_order'],
                                                'id_testmatrix' => $this->input->post('id_testmatrix')[$i] ?? $u['id_testmatrix'],

                                                'method_code' => $this->input->post('method_code')[$i] ?? $u['method_code'],
                                                'method_name' => $this->input->post('method_name')[$i] ?? $u['method_name'],
                                                'measurement' => $this->input->post('measurement')[$i] ?? $u['measurement'],
                                                'title'       => $this->input->post('title')[$i] ?? $u['title'],
                                                'result'      => $this->input->post('result')[$i] ?? $u['result'],

                                                'passfail'    => $this->input->post('passfail')[$i] ?? $u['passfail'],
                                                'passfail1'   => $this->input->post('passfail1')[$i] ?? $u['passfail1'],

                                                'comment'     => $this->input->post('comment')[$i] ?? $u['comment'],
                                                'statement'   => $this->input->post('statement')[$i] ?? $u['statement'],

                                                'status'            => $this->input->post('status')[$i] ?? $u['status'],
                                                'status_passfail'   => $this->input->post('status_passfail')[$i] ?? $u['status_passfail'],

                                                'be_wash'   => $this->input->post('be_wash')[$i] ?? $u['be_wash'],
                                                'af_wash_1' => $this->input->post('af_wash_1')[$i] ?? $u['af_wash_1'],
                                                'ac_wash_1' => $this->input->post('ac_wash_1')[$i] ?? $u['ac_wash_1'],
                                                'af_wash_5' => $this->input->post('af_wash_5')[$i] ?? $u['af_wash_5'],
                                                'ac_wash_5' => $this->input->post('ac_wash_5')[$i] ?? $u['ac_wash_5'],
                                                'af_wash_15'=> $this->input->post('af_wash_15')[$i] ?? $u['af_wash_15'],
                                                'ac_wash_15'=> $this->input->post('ac_wash_15')[$i] ?? $u['ac_wash_15'],
                                                
                                                'nahm_sock' => $this->input->post('nahm_sock')[$i] ?? $u['nahm_sock'],
                                                'result_sock' => $this->input->post('result_sock')[$i] ?? $u['result_sock'],
                                                'comment_sock' => $this->input->post('comment_sock')[$i] ?? $u['comment_sock'],

                                                'mass_of' => $this->input->post('mass_of')[$i] ?? $u['mass_of'],
                                                'range_graph_1' => $this->input->post('range_graph_1')[$i] ?? $u['range_graph_1'],
                                                'range_graph_2' => $this->input->post('range_graph_2')[$i] ?? $u['range_graph_2'],

                                                'result_formaldehyde' => $this->input->post('result_formaldehyde')[$i] ?? $u['result_formaldehyde'],

                                                'status_formaldehyde' => $this->input->post('status_formaldehyde')[$i] ?? $u['status_formaldehyde'],
                                                'status_sock' => $this->input->post('status_sock')[$i] ?? $u['status_sock'],
                                                'status_shrinkage'  => $this->input->post('status_shrinkage')[$i] ?? $u['status_shrinkage'],
                                                'status_boolean'    => $this->input->post('status_boolean')[$i] ?? $u['status_boolean'],
                                                'status_statement_result' => $this->input->post('status_statement_result')[$i] ?? $u['status_statement_result'],
                                                'status_numeric'    => $this->input->post('status_numeric')[$i] ?? $u['status_numeric'],
                                            ];
                                            ?>

                                            <?php $this->load->view('adidas/testRequired/keranjang_method', ['data_row' => $data_row]); ?>
                                        <?php endforeach; ?>

                                        </tbody>

                                        <tfoot style="text-align:center;" >
                                            <tr class="tfoot_method">
                                            <td></td>
                                            <td colspan="2"><input name="report_no_hidden" id="report_no_hidden" type="hidden" class="form-control" value="<?= $detail->report_no ?>"> </td>
                                            <td><b style="text-align:right;"><strong>Result Status </strong></td>
                                             <td id="result_status_text"></td>
                                            <td>
                                                <input type="text" name="result_status" id="result_status" value="<?= $this->input->post('result_status')?>">
                                                <input type="text" name="id_reportmethod" id="id_reportmethod" value="<?php echo $kodemethod; ?>" hidden>
                                            </td>
                                            </tr> 
                                        </tfoot>
                                    </table>    
                                </div>
                            </div>
                    </div>
                </div> 
                <div class="card-footer">
                    <div class="col-md-1">
                        <a href="<?=site_url('#')?>" type="button" class="btn btn-block" style="background-color: #001f3f; color: white;">Back</a>
                    </div>
                    <div class="col-md-10">
                        
                    </div>
                    <div class="col-md-1">
                        <ol class="float-sm-right">
                            <button type="submit" class="btn btn-block" style="background-color: #001f3f; color: white;" value="Tambah">Submit</button>
                        </ol>
                    </div>      
                </div>
            </div>
        </form>
    </div>
     <!---- MODAL DATA ORDER ---->
    <div id="ModalOption" class="modal" role="dialog">
        <div class="modal-dialog modal-lg">
        <!--modal content-->
            <div class="modal-content">
                <div class="modal-header">
                   <span style="font-size: 14px; font-weight:bold;">Method List</span>
                </div>
                <div class="modal-body">
                    <style>
                    .pagination{
                        float:right;
                    }
                    .dataTables_filter{
                        float: right;
                    }
                    </style>
                    <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-striped text-nowrap">
                                    <thead>
                                        <tr>
                                            <th width="1%"><center>#</th>
                                            <th><center>Test Method Code</th>
                                            <th><center>Measurement</th>
                                            <th><center>Dry Process</th>
                                            <th><center>Value From</th>
                                            <th><center>Value To </th>
                                            <th><center>UOM</th>
                                            <th><center>Pass/Fail</th>
                                            <th hidden><center>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach($testmatrix as $u){
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $u->method_code?></td>
                                            <td><?= $u->measurement?><br><?= $u->title?></td>
                                            <td><?= $u->dry ?></td>
                                            <td><?= $u->value_from?></td>
                                            <td><?= $u->value_to?></td>
                                            <td><?= $u->uom ?></td>
                                            <td><?= $u->pass_fail ?></td>
                                            <td hidden>
                                                <a href="#" class="btn btn-outline-primary"><i class="fa fa-plus"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>              
</section>

               
