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
                <li class="breadcrumb-item active">Test Matrix</li>
                </ol>
          </div>
        </div>
      </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
           <form action="<?php echo site_url('testMatrix/tambahaksiMatrix'); ?>" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 pl-pr-1">
                                        <div class="form-group">
                                            <label>Test Method ID</label>
                                            <select name="id_testmethod" class="form-control select2" id="id_testmethod" required>
                                                <option selected disabled>Select</option>
                                                <?php foreach ($testmethod as $u): ?>
                                                        <option value="<?= $u->id_testmethod?>"><?= $u->method_id ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-pr-1">
                                        <div class="form-group">
                                            <label>Test Method Name</label>
                                            <input name="title"  class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-pr-1">
                                        <div class="form-group">
                                            <label>Test Method Code</label>
                                            <input name="method_code"  class="form-control" required>
                                        </div>
                                    </div>
                                <div class="col-md-6 pl-pr-1">
                                    <div class="form-group">
                                        <label>Measurement</label>
                                        <input name="measurement"  class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3 pl-pr-1">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <select name="age" id="age" class="form-control" required> 
                                        <option selected disabled>Select</option>
                                        <?php foreach($age as $u):?>
                                            <option value="<?= $u->age ?>"><?= $u->age?></option>
                                        <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 pl-pr-1">
                                    <div class="form-group">
                                        <label>Dry Process</label>
                                        <select name="dry" id="dry" class="form-control" required> 
                                        <option selected disabled>Select</option>
                                        <option value="Line Dry/Flat Dry">Line Dry/Flat Dry</option>
                                        <option value="Tumble Dry">Tumble Dry</option>
                                        <option value="All">All</option>
                                        <option value="None">None</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Buyer</label>
                                            <select name="brand" class="form-control" required>
                                                <option selected disabled>Select</option>
                                                <?php foreach ($brand as $u): ?>
                                                    <option value="<?= $u->brand ?>"><?= $u->brand?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Product Type</label>
                                            <select name="product_type[]"  id="product_type[]" class="form-control selectpicker" multiple required>
                                                    <option disabled>Select</option>
                                                        <?php foreach($producttype as $u): ?>
                                                    <option value="<?= $u -> product_type?>"><?= $u-> product_type?></option>
                                                    <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Test Level</label>
                                            <input name="test_level"  class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Technology Concept</label>
                                            <select name="technology_concept" class="form-control" required>
                                                <option selected disabled>Select</option>
                                                <option value="TECHFIT">TECHFT</option>
                                                <option value="TECHFIT RECHARGER">TECHFIT RECHARGER</option>
                                                <option value="CONTROL">CONTROL</option>
                                                <option value="FORMOTION">FORMOTION</option>
                                                <option value="none">none</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                            <div class="form-group">
                                                <label>Fabric Tech</label>
                                                <select name="fabric_tech" class="form-control" required>
                                                    <option selected disabled>Select</option>
                                                    <option value="K">K : Knit</option>
                                                    <option value="W">W : Woven</option>
                                                    <option value="KW"> KN : Knit Woven </option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Composition</label>
                                            <select name="composition" class="form-control" required>
                                                <option selected disabled>Select</option>
                                                <option value="N">N: Natural</option>
                                                <option value="S">S: Synthetic</option>
                                                <option value="NS">NS: Natural Synthetic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Test Result Type</label>
                                            <select name="result_type" id="result_type" class="form-control" required>
                                                <option selected disabled>Select</option>
                                                <option value="Boolean">Boolean</option>
                                                <option value="Number">Number</option>
                                                <option value="Statement">Statement</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pl-pr-1">
                                       <br> <h3><b>Expected</b></h3><hr>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>UOM</label>
                                            <input name="uom" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Value From</label>
                                            <input name="value_from" class="form-control" onkeypress="return isNumberKey(event)" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Value To</label>
                                            <input name="value_to" class="form-control" onkeypress="return isNumberKey(event)"  disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pl-pr-1">
                                        <div class="form-group">
                                            <label>Pass/Fail</label>
                                            <select name="pass_fail" id="pass_fail" class="form-control" disabled>
                                                <option selected disabled>Select</option>
                                                <option value="Accepted">Accepted</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pl-pr-1">
                                        <div class="form-group">
                                            <label>Statement</label>
                                            <textarea id="statement" name="statement" class="form-control" disabled></textarea>
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
            </div>
		</div>
	</div>
</section>