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
                <li class="breadcrumb-item active">Test Requisition Form</li>
                </ol>
          </div>
        </div>
      </div>
</div>
<section class="content">
    <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                        <form action = "<?php echo site_url('c_transaksi/tambahaksi_penerimaan'); ?>" method="post" enctype="multipart/form-data" > 
                            <div class="card-body">
                                <div class="col-md-12">
                                    <h4>Applicant Details<hr></h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Applicant</label>
                                            <select name="applicant" id="applicant" class="form-control select2" style="width: 100%;">
                                                <option selected disabled value="Select Applicant">--- Select Applicant ---</option>
                                                <?php foreach($email as $u): ?>
                                                    <option value="<?= $u->applicant?>"><?php echo $u->applicant?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <input type="text" name="department" id="department" value="" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Telephone</label>
                                            <input type="text" name="telephone" id="telephone" value="" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" id="email" value="" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Buyer</label>
                                            <input type="text" name="buyer" class="form-control" value="adidas" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <h4>For Lab use only<hr></h4>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label>Date Time Received</label>
                                            <input type="hidden" name="id_penerimaan" class="form-control" value="<?php echo $idPenerimaan ?>" >
                                            <input type="datetime-local" name="datetime_received" class="form-control" Required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Received Sample By</label>
                                            <input type="text" name="received_sample_by" class="form-control" value="<?php echo $this->session->userdata('bg_nama')?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h4><br>Sample Information<hr></h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Sample Description</label>
                                            <input type="text" name="sample_description" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Batch / LOT Number</label>
                                            <input type="text" name="batch_lot" id="batch_lot" class="form-control">
                                        </div>
                                    </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Order Number / PO - LCO</label>
                                            <select name="order_number" id="order_number" class="form-control select2" style="width: 100%;">
                                                <option selected disabled value="">--- Select Order Number ---</option>
                                                <option value="other">Other</option>
                                                <?php foreach($order as $u): ?>
                                                    <option value="<?= $u->order_number ?>"><?= $u->order_number ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                         <input type="text"
                                                    id="other_order_number"
                                                    name="other_order_number"
                                                    class="form-control"
                                                    style="display:none;"
                                                    placeholder="Masukkan order number lainnya...">
                                                </input>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Code Of Fabric</label>
                                            <input type="text" value="" name="code_of_fabric" id="code_of_fabric" class="form-control" readonly>
                                        </div>
                                    </div>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Initial Width (LA)</label>
                                            <input type="varchar" name="initial_width" id="initial_width" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Request Width (LP)</label>
                                            <input type="varchar" name="request_width" id="request_width" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Finished Width (LJ)</label>
                                            <input type="varchar" name="finished_width" id="finished_width" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Request Fabric Weight</label>
                                            <input type="varchar" name="request_fabric" id="request_fabric" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Finished Fabric Weight</label>
                                            <input type="varchar" name="finish_fabric" id="finish_fabric" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label>ERP Dyeing Number</label>
                                        <input type="text" name="dyeing_number" id="dyeing_number" class="form-control">
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>ERP Production Number</label>
                                            <input type="text" name="production_number" id="production_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Country Of Destination</label>
                                            <input type="text" name="country_destination" id="country_destination" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product End Use</label>
                                            <input type="text" name="product_end" id="product_end" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Article No</label>
                                            <input type="text" name="article_no" id="article_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Item No</label>
                                            <select name="item_no" id="item_no" class="form-control select2">
                                                <option selected disabled value="">--- Select Material ---</option>
                                                <?php foreach($material as $u): ?>
                                                    <option value="<?= $u->item_no?>"><?php echo $u->item_no?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Style No</label>
                                            <input type="text" name="style_no" id="working_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Season</label>
                                            <input type="text" name="season" id="season"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Approved date by CCDA</label>
                                            <input type="text" name="approved_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Supplier Code</label>
                                            <div class="col-md-6">
                                                <label>Supplier Name</label>
                                            <!--input type="text" name="supplier_name" class="form-control"-->
                                            <select name="supplier_name" id="supplier_name" class="form-control select2">
                                                <option selected disabled value="">--- Select Supplier ---</option>
                                                <?php foreach($supplier as $u): ?>
                                                    <option value="<?= $u->supplier_name?>"><?php echo $u->supplier_name?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="supplier_code" class="form-control" readonly>
                                           
                                        </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Size</label>
                                            <input type="text" name="size" id="size" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Brands</label>
                                            <input type="text" name="brands" id="brand" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Material ID</label>
                                            <input type="text" name="material_id" class="form-control">
                                        </div>
                                    </div> 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Temp of process</label>
                                            <input type="text" name="temperature_process" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Technique Print</label>
                                            <input type="text" name="technique_print" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Country Of Origin</label>
                                            <input type="text" name="country_origin" class="form-control">
                                        </div>
                                    </div>        
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>OEKOTEX</label>
                                            <select name="oekotex" class="form-control">
                                                <option selected disabled value="">--- Select OEKO-TEX ---</option>
                                                <?php foreach($oekotex as $u): ?>
                                                    <option value="<?= $u->id?>"><?php echo $u->oekotex?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Number Of Sample</label>
                                            <input type="text" name="number_sample" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Quantity Of Sample</label>
                                            <input type="text" name="quantity_sample" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Time Of Delivery (TOD)</label>
                                            <input type="text" name="tod" id="tod" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>PODD</label>
                                            <input type="text" name="podd" id="podd" class="form-control">
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label>PO Quantity</label>
                                            <input type="text" name="po_quantity" id="po_quantity" class="form-control">
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label>LCO</label>
                                            <input type="text" name="lco" id="lco" class="form-control">
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product Type</label>
                                                <select class="form-control" name="id_producttype" id="id_producttype" >
                                                    <option selected disabled>Select</option>
                                                    <?php foreach ($producttype as $u): ?>
                                                        <option value="<?= $u->id_producttype?>"><?= $u->product_type ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Testing Request</label>
                                                <select class="form-control" name="id_testingregulation" id="id_testingregulation">
                                                    <option selected disabled>Select</option>
                                                    <?php foreach ($regulation as $u): ?>
                                                        <option value="<?= $u->id_testingregulation?>"><?= $u->testing_regulation ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Factory Disclaimer</label>
                                                <input type="text" name="factory_discleamer" id="factory_discleamer" class="form-control">
                                            </div>
                                        </div>
                                        
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group containerColor">
                                        <div class="col-md-12">
                                            <label>Color</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="color[]" class="form-control" placeholder="(A)">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="color[]" class="form-control"  placeholder="(B)">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="color[]" class="form-control"  placeholder="(C)">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-block btn-tambah" style="background:#b8b8b8;"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-block btn-tambah" style="background:#b8b8b8; display:none;"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group containerOf"><br>
                                        <div class="col-md-12">
                                            <label>Color Of</label>
                                            <input type="text" name="color_of_name" class="form-control" placeholder="Color Of ...."><br>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="color_of[]" class="form-control" placeholder="(A)">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="color_of[]" class="form-control"  placeholder="(B)">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="color_of[]" class="form-control"  placeholder="(C)">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-block btn-tambah-of" style="background:#b8b8b8;"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-block btn-hapus-of" style="background:#b8b8b8; display:none;"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><br>
                                            <div class="form-group">
                                                <label>Compotition</label>
                                                <input type="text" name="composition" id="composition" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Stage</label>
                                                <select name="stage" class="form-control">
                                                <option value="" selected>--- Select Stages ---</option>
                                                <?php foreach($stages as $u): ?>
                                                    <option value="<?= $u->id_stages?>"><?php echo $u->testing_stages?></option>
                                                <?php endforeach ?>
                                            </select>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <input type="text" name="stageother" class="form-control" placeholder="other stage">
                                            </div>                                        
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Size Category</label>
                                                <select name="size_category" class="form-control">
                                                <option selected value="">--- Select Size ---</option>
                                                <?php foreach($size as $u): ?>
                                                    <option value="<?= $u->id_age?>"><?php echo $u->age?></option>
                                                <?php endforeach ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <input type="text" name="size_categoryother" class="form-control" placeholder="other size category">
                                            </div>                                        
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sample No</label>
                                                <select name="sample_no" class="form-control">
                                                    <option selected disabled>--- Select Sample No ---</option>
                                                    <option value="Sampling 1">Sampling 1</option>
                                                    <option value="Sampling 2">Sampling 2</option>
                                                    <option value="Sampling 3">Sampling 3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <input type="text" name="other_sampleno" class="form-control" placeholder="Report No">
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <label>Care Instruction</label>
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Washing Process</label>
                                            <select name="washing" class="form-control">
                                                <option selected disabled>--- Select Care Instruction ---</option>
                                                 <?php foreach($washing as $u) : ?>   
                                                    <option value="<?= $u->id_care?>"><?php echo $u->deskripsi ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                        <label>Bleching Process</label>
                                            <select name="bleach" class="form-control">
                                                <option selected disabled>--- Select Care Instruction ---</option>
                                                 <?php foreach($bleching as $u) : ?>   
                                                    <option value="<?= $u->id_care?>"><?php echo $u->deskripsi ?></option>
                                                <?php endforeach ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Tumble Drying Process</label>
                                            <select name="drying" class="form-control">
                                                <option selected disabled>--- Select Care Instruction ---</option>
                                                 <?php foreach($drying as $u) : ?>   
                                                    <option value="<?= $u->id_care?>"><?php echo $u->deskripsi ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                        <label>Ironing Process</label>
                                            <select name="ironing" class="form-control">
                                                <option selected disabled>--- Select Care Instruction ---</option>
                                                 <?php foreach($ironing as $u) : ?>   
                                                    <option value="<?= $u->id_care?>"><?php echo $u->deskripsi ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label>Professional Textile Care Process</label>
                                            <select name="profess" class="form-control">
                                                <option selected disabled>--- Select Care Instruction ---</option>
                                                 <?php foreach($profess as $u) : ?>   
                                                    <option value="<?= $u->id_care?>"><?php echo $u->deskripsi ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"><br>
                                    <h4>Test Required (please give checklist)<hr></h4>
                                </div>
                                <div class="row">
                                    <?php $no = 1; ?>
                                    <?php $totalCol = count($test_required_columns); ?>
                                    <?php $i = 0; ?>
                                    <?php foreach($test_required_columns as $col){ ?>
                                        <?php $i++; ?>
                                        <div class="col-md-4">

                                            <?php foreach($col as $row){ ?>

                                                <?php 
                                                $id = strtolower(str_replace(' ','_',$row['test_required']));
                                                ?>

                                                <div style="margin-bottom:5px;">
                                                    <label><?= $no ?>.</label>

                                                    <input type="checkbox"
                                                        name="test_required[]"
                                                        id="<?= $id ?>"
                                                        value="<?= $row['test_required'] ?>">

                                                    <label for="<?= $id ?>">
                                                        <?= $row['test_required'] ?>
                                                    </label>
                                                </div>

                                                <?php $no++; ?>

                                            <?php } ?>
                                            <?php if($i == $totalCol){ ?>

                                                <div style="margin-top:10px;">
                                                    <span style="font-weight:bold;">
                                                        <i>*)Accredited ISO/IEC 17025</i>
                                                    </span>
                                                    <hr>
                                                </div>

                                                <div>
                                                    <label>Other Test ( Please specify ) :</label>
                                                    <input type="text" name="test_required[]" class="form-control">
                                                </div>

                                            <?php } ?>

                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-12"><hr>
                                    <div class="form-group">
                                        <label>Report No</label>
                                        <input type="text" name="report_no" class="form-control" onkeypress="return isReportNo(event)" Required>
                                    </div>
                                </div>
                                <div class="col-md-12 pl-pr-1" >
                                            <div class="input-group">
                                                <label>Upload Specimen</label>&nbsp;&nbsp;
                                                <div class="custom-file">
                                                    <input type="file" name="image_path" accept="image/*"  onchange="cekUkuranFile(this)">
                                                </div>
                                            </div>
                                        </div> 
                            </div>
                            <div class="card-footer">
                                <div class="col-md-1">
                                        <a href="<?=site_url('c_transaksi/index_penerimaan')?>" type="button" class="btn btn-block" style="background-color: #36454F;color: white;" >Back</a> 
                                </div>
                                <div class="col-md-10">
                                    
                                </div>
                                <div class="col-md-1">
                                    <ol class="float-sm-right">
                                        <button type="submit" class="btn btn-block" style="background-color: #36454F;color: white;" value="Tambah">Submit</button>
                                    </ol>
                                </div>      
                            </div>
                        </form>
                <script>
                    const form = document.querySelector('form[action*="tambahaksi_penerimaan"]');
                    const textInputs = form.querySelectorAll('input[type="text"]');

                    textInputs.forEach(input => {
                        input.addEventListener('input', () => {
                            input.value = input.value.toUpperCase();
                        });
                    });
                </script>
            </div>
		</div>
	</div>
</section>