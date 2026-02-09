<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        font-size: 14px;
        background-color: #f8f9fa;
    }

    .card {
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-radius: 10px;
        border: none;
    }

    .card-header {
        background-color: #36454F !important;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    h4 {
        font-weight: 600;
        color: #36454F;
        margin-top: 10px;
    }

    h4 hr {
        border-top: 2px solid #ccc;
        margin-top: 5px;
    }

    label {
        font-weight: 500;
        color: #444;
        margin-bottom: 5px;
    }

    input.form-control,
    select.form-control {
        border-radius: 6px;
        border: 1px solid #ccc;
        transition: border-color 0.3s, box-shadow 0.3s;
        box-shadow: none;
    }

    input.form-control:focus,
    select.form-control:focus {
        border-color: #36454F;
        box-shadow: 0 0 0 0.1rem rgba(54, 69, 79, 0.25);
    }

    .btn {
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .breadcrumb {
        background-color: transparent;
        font-size: 13px;
        padding: 0;
        margin-bottom: 10px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control[readonly] {
        background-color: #e9ecef;
        color: #495057;
    }

    .containerColor .form-control,
    .containerOf .form-control {
        margin-bottom: 10px;
    }

    .btn-tambah, .btn-hapus-of {
        background-color: #6c757d !important;
        color: white;
    }

    .btn-tambah:hover, .btn-hapus-of:hover {
        background-color: #5a6268 !important;
    }

    .input-group label {
        font-weight: 500;
        margin-right: 10px;
        margin-top: 5px;
    }

    .custom-file input[type="file"] {
        padding: 5px;
        font-size: 13px;
    }

    .pl-pr-1 {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .card-footer {
        background-color: #f1f1f1;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
</style>

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
                <li class="breadcrumb-item active">Edit Test Matrix</li>
                </ol>
          </div>
        </div>
      </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                    <?php foreach($editmatrix as $u){ ?>
                        <form action="<?php echo site_url('testMatrix/editaksiMatrix'); ?>" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 pl-pr-1">
                                        <div class="form-group">
                                            <input type="hidden" name="id_testmatrix" value="<?php echo $u->id_testmatrix ?>">
                                            <label>Test Method ID</label>
                                            <select name="id_testmethod" class="form-control select2" required>
                                                <option selected disabled>Select</option>
                                                <?php foreach ($testmethod as $m): ?>
                                                    <option <?php echo ( $m->id_testmethod== $u->id_testmethod) ? "selected": "" ?>><?php echo $m->id_testmethod.". ".$m->method_id; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-pr-1">
                                        <div class="form-group">
                                            <label>Test Method Name</label>
                                            <input name="title"  class="form-control" value="<?php echo $u->title ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-pr-1">
                                        <div class="form-group">
                                            <label>Test Method Code</label>
                                            <input name="method_code"  class="form-control" value="<?php echo $u->method_code; ?>" required>
                                        </div>
                                    </div>
                                <div class="col-md-6 pl-pr-1">
                                    <div class="form-group">
                                        <label>Measurement</label>
                                        <input name="measurement"  class="form-control" value="<?php echo $u->measurement ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-3 pl-pr-1">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <select name="age" id="age" class="form-control" required> 
                                        <option selected disabled>Select</option>
                                        <?php foreach($age as $m):?>
                                            <option value="<?php echo $u->age; ?>"<?php if($m->age==$u->age) echo "selected"; ?>><?php echo $m->age; ?></option>
                                        <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 pl-pr-1">
                                    <div class="form-group">
                                        <label>Dry Process</label>
                                        <?php $dry = $u->dry; ?>
                                        <select name="dry" id="dry" class="form-control" required> 
                                        <option selected disabled>Select</option>
                                        <option <?php echo ($dry == 'Line Dry/Flat Dry') ? "selected": "" ?>>Line Dry/Flat Dry</option>
                                        <option <?php echo ($dry == 'Tumble Dry') ? "selected": "" ?>>Tumble Dry</option>
                                        <option <?php echo ($dry == 'All') ? "selected": "" ?>>All</option>
                                        <option <?php echo ($dry == 'None') ? "selected": "" ?>>None</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Buyer</label>
                                            <select name="brand" class="form-control" required>
                                                <option selected disabled>Select</option>
                                                    <?php foreach ($brand as $m): ?>
                                                        <option value="<?php echo $u->brand; ?>"<?php if($m->brand==$u->brand) echo "selected"; ?>><?php echo $m->brand; ?></option>
                                                    <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Product Type</label>
                                            <select name="product_type[]" class="form-control select2" multiple="multiple" required>
                                                    <option disabled>Select</option>
                                                    <?php 
                                                        $cats = explode(',', $u->product_type);
                                                        foreach($cats as $vald) {
                                                            foreach($producttype as $key=>$m) { ?>                    
                                                                <option value="<?php echo $m->product_type; ?>" <?=($vald == $m->product_type ? 'selected' : '')?> ><?php echo $m->product_type; ?></option> 
                                                    <?php   }
                                                        }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Test Level</label>
                                            <input name="test_level"  class="form-control" value="<?php echo $u->test_level ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Technology Concept</label>
                                            <?php $technology_concept = $u->technology_concept; ?>
                                            <select name="technology_concept" class="form-control" required>
                                                <option selected disabled>PILIH</option>
                                                <option <?php echo ($technology_concept == 'TECHFIT') ? "selected": "" ?>>TECHFIT</option>
                                                <option <?php echo ($technology_concept == 'TECHFIT RECHARGER') ? "selected": "" ?>>TECHFIT RECHARGER</option>
                                                <option <?php echo ($technology_concept == 'CONTROL') ? "selected": "" ?>>CONTROL</option>
                                                <option <?php echo ($technology_concept == 'FORMOTION') ? "selected": "" ?>>FORMOTION</option>
                                                <option <?php echo ($technology_concept == 'none') ? "selected": "" ?>>none</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                            <div class="form-group">
                                                <label>Fabric Tech</label>
                                                <?php $fabric = $u->fabric_tech; ?>
                                                <select name="fabric_tech" class="form-control" required>
                                                    <option selected disabled>Select</option>
                                                    <option <?php echo ($fabric == 'K') ? "selected": "" ?>>K : Knit</option>
                                                    <option <?php echo ($fabric == 'W') ? "selected": "" ?>>W : Woven</option>
                                                    <option <?php echo ($fabric == 'KW') ? "selected": "" ?>>KW : Knit Woven </option>
                                                    
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Composition</label>
                                            <?php $composition = $u->composition ?>
                                            <select name="composition" class="form-control" required>
                                                <option selected disabled>Select</option>
                                                <option <?php echo ($composition == 'N') ? "selected": "" ?>>N: Natural</option>
                                                <option <?php echo ($composition == 'S') ? "selected": "" ?>>S: Synthetic</option>
                                                <option <?php echo ($composition == 'NS') ? "selected": "" ?>>NS: Natural Synthetic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Test Result Type</label>
                                            <?php $type = $u->result_type ?>
                                            <select name="result_type" id="result_type" class="form-control" required>
                                                <option selected disabled>Select</option>
                                                <option <?php echo ($type == 'Boolean') ? "selected": ""?>>Boolean</option>
                                                <option <?php echo ($type == 'Number') ? "selected": "" ?>>Number</option>
                                                <option <?php echo ($type == 'Statement') ? "selected": "" ?>>Statement</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pl-pr-1">
                                       <br> <h3><b>Expected</b></h3><hr>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>UOM</label>
                                            <input name="uom" class="form-control" value="<?php echo $u->uom ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Value From</label>
                                            <input name="value_from" class="form-control" onkeypress="return isNumberKey(event)" value="<?php echo $u->value_from?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Value To</label>
                                            <input name="value_to" class="form-control" onkeypress="return isNumberKey(event)" value="<?php echo $u->value_to?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Pass/Fail</label>
                                            <?php $pass_fail = $u->pass_fail ?>
                                            <select name="pass_fail" id="pass_fail" class="form-control" disabled>
                                                <option selected disabled>Select</option>
                                                <option <?php echo ($pass_fail == 'Accepted') ? "selected": "" ?>>Accepted</option>
                                                <option <?php echo ($pass_fail == 'Rejected') ? "selected": "" ?>>Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pl-pr-1">
                                        <div class="form-group">
                                            <label>Statement</label>
                                           <textarea id="statementMatrix" name="statement" class="form-control">
                                                <?= isset($u->statement) ? $u->statement : '' ?>
                                            </textarea>
                                        </div>
                                    </div>
                                   <br>
                              
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="col-md-1">
                                        <a href="<?=site_url('testMatrix/indexMatrix')?>" type="button" class="btn btn-block btn-primary" >Back</a>
                                </div>
                                <div class="col-md-10">
                                    
                                </div>
                                <div class="col-md-1">
                                    <ol class="float-sm-right">
                                        <button type="submit" class="btn btn-block btn-primary" value="Tambah">Submit</button>
                                    </ol>
                                </div>      
                            </div>
                        </form>
                    <?php } ?>
            </div>
		</div>
	</div>
</section>