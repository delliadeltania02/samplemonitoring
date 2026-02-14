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
                <li class="breadcrumb-item active">Edit Sample</li>
                </ol>
          </div>
        </div>
      </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                        <form action = "<?php echo site_url('c_transaksi/editaksi_penerimaan'); ?>" method="post"  enctype="multipart/form-data" > 
                             <div class="card-body">
                                <div class="col-md-12">
                                    <h4>Applicant Details<hr></h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="id_penerimaan" class="form-control" value="<?php echo $penerimaan['data']->id_penerimaan ?>" hidden>
                                            <label>Applicant</label>
                                            <!-- Select Applicant -->
                                            <select name="applicant" id="applicant" class="form-control select2">
                                                <option value="">--- Select Applicant ---</option>
                                                <?php foreach ($penerimaan['email'] as $e): ?>
                                                    <option value="<?= $e->applicant ?>" 
                                                    <?= ($e->applicant == $penerimaan['data']->applicant) ? 'selected' : '' ?>>
                                                    <?= $e->applicant ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <input type="text" name="department" id="department" class="form-control"  value="<?= $penerimaan['data']->department ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Telephone</label>
                                            <input type="text" name="telephone" id="telephone" class="form-control" value="<?= $penerimaan['data']->no_tlp ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" id="email" class="form-control" value="<?php echo $penerimaan['data']->email ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Buyer</label>
                                            <input type="text" name="buyer" class="form-control" value="adidas" value="<?php echo $penerimaan['data']->buyer ?>" readonly>
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
                                                <input type="datetime-local" name="datetime_received" class="form-control" value="<?php echo $penerimaan['data']->datetime_received ?>">
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
                                    <div class="col-md-5">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Sample Description</label>
                                                <input type="text" name="sample_description" class="form-control" value="<?php echo $penerimaan['data']->sample_description ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Batch / LOT Number</label>
                                                <input type="text" name="batch_lot" class="form-control" value="<?php echo $penerimaan['data']->batch_lot ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Order Number / PO - LCO</label>
                                                <input type="text" name="order_number" class="form-control" value="<?php echo $penerimaan['data']->order_number ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Code Of Fabric</label>
                                                <input type="text" name="code_of_fabric" id="code_of_fabric" class="form-control" value="<?php echo $penerimaan['data']->code_of_fabric?>" readonly>
                                            </div>
                                        </div>
                                     <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Initial Width (LA)</label>
                                                <input type="varchar" name="initial_width" id="initial_width" class="form-control" value="<?php echo $penerimaan['data']->initial_width ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Request Width (LP)</label>
                                                <input type="varchar" name="request_width" id="request_width" class="form-control" value="<?php echo $penerimaan['data']->request_width?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Finished Width (LJ)</label>
                                                <input type="varchar" name="finished_width" id="finished_width" class="form-control" value="<?php echo $penerimaan['data']->finished_width ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Request Fabric Weight</label>
                                                <input type="varchar" name="request_fabric" id="request_fabric" class="form-control" value="<?php echo $penerimaan['data']->request_fabric ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Finished Fabric Weight</label>
                                                <input type="varchar" name="finish_fabric" id="finish_fabric" class="form-control" value="<?php echo $penerimaan['data']->finish_fabric ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label>ERP Dyeing Number</label>
                                            <input type="text" name="dyeing_number" class="form-control" value="<?php echo $penerimaan['data']->dyeing_number?>">
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>ERP Production Number</label>
                                                <input type="text" name="production_number" class="form-control" value="<?php echo $penerimaan['data']->production_number?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Country Of Destination</label>
                                                <input type="text" name="country_destination" class="form-control" value="<?php echo $penerimaan['data']->country_destination?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product End Use</label>
                                                <input type="text" name="product_end" class="form-control" value="<?php echo $penerimaan['data']->product_end ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Article No</label>
                                                <input type="text" name="article_no" class="form-control" value="<?php echo $penerimaan['data']->article_no ?>">
                                            </div>
                                        </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Item No</label>
                                            <select name="item_no" id="item_no" class="form-control select2">
                                            <option selected disabled value="">--- Select Material ---</option>
                                            <?php foreach($penerimaan['material'] as $u): ?>
                                                <option value="<?= $u->item_no ?>"
                                                <?= ($u->item_no == $penerimaan['data']->item_no) ? 'selected' : '' ?>>
                                                <?= $u->item_no ?>
                                                </option>
                                            <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Style No</label>
                                            <input type="text" name="style_no" class="form-control" value="<?php echo $penerimaan['data']->style_no?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Season</label>
                                            <input type="text" name="season" class="form-control" value="<?php echo $penerimaan['data']->season ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Approved date by CCDA</label>
                                            <input type="text" name="approved_date" class="form-control" value="<?php echo $penerimaan['data']->approved_date?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                            <!-- Supplier Name -->
                                            <div class="col-md-6">
                                                <label>Supplier Name</label>
                                                <select name="supplier_name" id="supplier_name" class="form-control select2">
                                                <option selected disabled value="">--- Select Supplier ---</option>
                                                <?php foreach($penerimaan['supplier'] as $u): ?>
                                                    <option value="<?= $u->supplier_name ?>"
                                                    <?= ($u->supplier_name == $penerimaan['data']->supplier_name) ? 'selected' : '' ?>>
                                                    <?= $u->supplier_name ?>
                                                    </option>
                                                <?php endforeach ?>
                                                </select>
                                            </div>
                                              <!-- Supplier Code -->
                                            <div class="col-md-6">
                                                <label>Supplier Code</label>
                                                <input type="text" name="supplier_code" class="form-control" readonly>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Size</label>
                                            <input type="text" name="size" class="form-control" value="<?php echo $penerimaan['data']->size?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Brands</label>
                                            <input type="text" name="brands" class="form-control" value="<?php echo $penerimaan['data']->brands ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Material ID</label>
                                            <input type="text" name="material_id" class="form-control" value="<?php echo $penerimaan['data']->material_id?>">
                                        </div>
                                    </div> 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Temp of process</label>
                                            <input type="text" name="temperature_process" class="form-control" value="<?php echo $penerimaan['data']->temperature_process ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Technique Print</label>
                                            <input type="text" name="technique_print" class="form-control" value="<?php echo $penerimaan['data']->technique_print?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Country Of Origin</label>
                                            <input type="text" name="country_origin" class="form-control" value="<?php echo $penerimaan['data']->country_origin ?>">
                                        </div>
                                    </div>        
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>OEKOTEX</label>
                                            <select name="oekotex" class="form-control">
                                                <option selected disabled value="">--- Select OEKO-TEX ---</option>
                                                <?php foreach($penerimaan['oekotex'] as $u): ?>
                                                    <option value="<?= $u->id ?>"
                                                        <?= ($u->id == $penerimaan['data']->oekotex) ? 'selected' : '' ?>>
                                                        <?= $u->oekotex ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Number Of Sample</label>
                                            <input type="text" name="number_sample" class="form-control" value="<?php echo $penerimaan['data']->number_sample?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Quantity Of Sample</label>
                                            <input type="text" name="quantity_sample" class="form-control" value="<?php echo $penerimaan['data']->quantity_sample?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Time Of Delivery (TOD)</label>
                                            <input type="text" name="tod" class="form-control" value="<?php echo $penerimaan['data']->tod ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Ambil data warna dari controller (hasil pengelompokan dari tbl_kualitas)
                                $colors = $penerimaan['colors'] ?? []; // array seperti ['a', 'b']

                                // Pastikan tetap ada 3 inputan, meskipun data hanya 1 atau 2
                                $colors = array_pad($colors, 3, '');
                                ?>

                                <div class="col-md-12">
                                    <div class="form-group containerColor">
                                        <div class="col-md-12">
                                            <label>Color</label>
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" name="color[]" class="form-control" placeholder="(A)"
                                                value="<?= htmlspecialchars($colors[0]) ?>">
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" name="color[]" class="form-control" placeholder="(B)"
                                                value="<?= htmlspecialchars($colors[1]) ?>">
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" name="color[]" class="form-control" placeholder="(C)"
                                                value="<?= htmlspecialchars($colors[2]) ?>">
                                        </div>

                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-block btn-tambah" style="background:#b8b8b8;">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-block btn-tambah" style="background:#b8b8b8; display:none;">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group containerOf"><br>
                                        <div class="col-md-12">
                                            <label>Color Of</label>
                                            <input type="text" name="color_of_name" class="form-control" placeholder="Color Of ...." value="<?= isset($penerimaan['kualitas'][0]->color_of_name) ? $penerimaan['kualitas'][0]->color_of_name : '';
                                            ?>"><br>
                                        </div>
                                        <?php
                                           $color_of_map = $penerimaan['color_of_map'] ?? []; // array seperti ['a', 'b']
                                           $color_of_map = array_pad($color_of_map, 3, '');
                                        ?>
                                        <div class="col-md-3">
                                            <input type="text" name="color_of[]" class="form-control" placeholder="(A)"
                                            value="<?= htmlspecialchars($color_of_map[0]) ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="color_of[]" class="form-control"  placeholder="(B)"
                                            value="<?= htmlspecialchars($color_of_map[1]) ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="color_of[]" class="form-control"  placeholder="(C)"
                                            value="<?= htmlspecialchars($color_of_map[2]) ?>">
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
                                                        <option selected disabled value="">--- Select Stages ---</option>
                                                        <?php foreach($penerimaan['stages'] as $u): ?>
                                                            <option value="<?= $u->id_stages ?>"
                                                                <?= ($u->id_stages == $penerimaan['data']->stage) ? 'selected' : '' ?>>
                                                                <?= $u->testing_stages ?>
                                                            </option>
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
                                                <option selected disabled value="">--- Select Size ---</option>
                                                    <?php foreach($penerimaan['size'] as $u): ?>
                                                        <option value="<?= $u->id_age ?>"
                                                            <?= ($u->id_age == $penerimaan['data']->size_category) ? 'selected' : '' ?>>
                                                            <?= $u->age ?>
                                                        </option>
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
                                                    <option value="Sampling 1" <?= ($penerimaan['data']->sample_no == 'Sampling 1') ? 'selected' : '' ?>>Sampling 1</option>
                                                    <option value="Sampling 2" <?= ($penerimaan['data']->sample_no == 'Sampling 2') ? 'selected' : '' ?>>Sampling 2</option>
                                                    <option value="Sampling 3" <?= ($penerimaan['data']->sample_no == 'Sampling 3') ? 'selected' : '' ?>>Sampling 3</option>
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
                                              <option selected disabled value="">--- Select Care Instruction ---</option>
                                                <?php foreach($penerimaan['washing'] as $u): ?>
                                                    <option value="<?= $u->id_care ?>"
                                                        <?= ($u->id_care == $penerimaan['data']->washing) ? 'selected' : '' ?>>
                                                        <?= $u->deskripsi ?>
                                                    </option>
                                                <?php endforeach ?>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                        <label>Bleching Process</label>
                                            <select name="bleching" class="form-control">
                                                <option selected disabled value="">--- Select Care Instruction ---</option>
                                                <?php foreach($penerimaan['bleching'] as $u): ?>
                                                    <option value="<?= $u->id_care ?>"
                                                        <?= ($u->id_care == $penerimaan['data']->bleach) ? 'selected' : '' ?>>
                                                        <?= $u->deskripsi ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Tumble Drying Process</label>
                                            <select name="drying" class="form-control">
                                                <option selected disabled value="">--- Select Care Instruction ---</option>
                                                <?php foreach($penerimaan['drying'] as $u): ?>
                                                    <option value="<?= $u->id_care ?>"
                                                        <?= ($u->id_care == $penerimaan['data']->drying) ? 'selected' : '' ?>>
                                                        <?= $u->deskripsi ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                        <label>Ironing Process</label>
                                            <select name="ironing" class="form-control">
                                                <option selected disabled>--- Select Care Instruction ---</option>
                                                 <?php foreach($penerimaan['ironing'] as $u): ?>
                                                    <option value="<?= $u->id_care ?>"
                                                        <?= ($u->id_care == $penerimaan['data']->ironing) ? 'selected' : '' ?>>
                                                        <?= $u->deskripsi ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        <label>Professional Textile Care Process</label>
                                            <select name="profess" class="form-control">
                                                <option selected disabled>--- Select Care Instruction ---</option>
                                                <?php foreach($penerimaan['profess'] as $u): ?>
                                                    <option value="<?= $u->id_care ?>"
                                                        <?= ($u->id_care == $penerimaan['data']->profess) ? 'selected' : '' ?>>
                                                        <?= $u->deskripsi ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"><br>
                                    <h4>Test Required (please give checklist)<hr></h4>
                                </div>
                                    <div class="col-md-4">
                                      <?php
                                            $selected = array_map('trim', array_unique(array_column($penerimaan['kualitas'], 'test_required')));
                                        ?>
                                            <div class=" ">
                                                <label>1.</label>
                                                <input type="checkbox" name ="test_required[]" id="household" value="Color Fastness to House Hold Laundering"
                                                <?= in_array("Color Fastness to House Hold Laundering", $selected) ? 'checked':''?>>
                                                <label for="household">Color Fastness to House Hold Laundering</label>
                                            </div>
                                            <div class=" ">
                                                <label>2.</label>
                                                <input type="checkbox" name="test_required[]" id="water" value="Color Fastness to Water"
                                                 <?= in_array("Color Fastness to Water", $selected) ? 'checked':''?>>
                                                <label for="water">Color Fastness to Water*)</label>
                                            </div>
                                            <div class=" ">
                                                <label>3.</label>
                                                <input type="checkbox" name="test_required[]" id="perspiration" value="Color Fastness to Perspiration"
                                                 <?= in_array("Color Fastness to Perspiration", $selected) ? 'checked':''?>>
                                                <label for="perspiration">Color Fastness to Perspiration*)</label>
                                            </div>
                                            <div class=" ">
                                                <label>4.</label>
                                                <input type="checkbox" name="test_required[]" id="washing" value="Color Fastness to Washing"
                                                <?= in_array("Color Fastness to Washing", $selected) ? 'checked':''?>>
                                                <label for="washing">Color Fastness to Washing*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>5.</label>
                                                <input type="checkbox" name="test_required[]" id="rubbing" value="Color Fastness to Rubbing"
                                                <?= in_array("Color Fastness to Rubbing", $selected) ? 'checked':''?>>
                                                <label for="rubbing">Color Fastness to Rubbing*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>6.</label>
                                                <input type="checkbox" name="test_required[]" id="lightfastness" value="Color Fastness to Light Fastness"
                                                <?= in_array("Color Fastness to Light Fastness", $selected) ? 'checked':''?>>
                                                <label for="lightfastness">Color Fastness to Light Fastness*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>7.</label>
                                                <input type="checkbox" name="test_required[]" id="fastnessperspiration" value="Color Fastness to Light Fastness Perspiration"
                                                <?= in_array("Color Fastness to Light Fastness Perspiration", $selected) ? 'checked':''?>>
                                                <label for="fastnessperspiration">Color Fastness to Light Fastness Perspiration</label>
                                            </div>
                                            <div class=" ">
                                            <label>8.</label>
                                                <input type="checkbox" name="test_required[]" id="phenolicyellowing" value="Color Fastness to Phenolic Yellowing"
                                                <?= in_array("Color Fastness to Phenolic Yellowing", $selected) ? 'checked':''?>>
                                                <label for="phenolicyellowing">Color Fastness to Phenolic Yellowing*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>9.</label>
                                                <input type="checkbox" name="test_required[]" id="saliva" value="Color Fastness to Saliva"
                                                 <?= in_array("Color Fastness to Saliva", $selected) ? 'checked':''?>>
                                                <label for="saliva">Color Fastness to Saliva*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>10.</label>
                                                <input type="checkbox" name="test_required[]" id="storage" value="Color Fastness Dye Transfer In Storage"
                                                <?= in_array("Color Fastness Dye Transfer In Storage", $selected) ? 'checked':''?>>
                                                <label for="storage">Color Fastness Dye Transfer In Storage*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>11.</label>
                                                <input type="checkbox" name="test_required[]" id="migration" value="Color Migration Fastness"
                                                 <?= in_array("Color Migration Fastness", $selected) ? 'checked':''?>>
                                                <label for="migration">Color Migration Fastness</label>
                                            </div>
                                            <div class=" ">
                                            <label>12.</label>
                                                <input type="checkbox" name="test_required[]" id="oven" value="Color Migration Oven Test"
                                                <?= in_array("Color Migration Oven Test", $selected) ? 'checked':''?>>
                                                <label for="oven">Color Migration Oven Test</label>
                                            </div>
                                            <div class=" ">
                                            <label>13.</label>
                                                <input type="checkbox" name="test_required[]" id="chlorinated" value="Color Fastness to Chlorinated Water"
                                                <?= in_array("Color Fastness to Chlorinated Water", $selected) ? 'checked':''?>>
                                                <label for="chlorinated">Color Fastness to Chlorinated Water</label>
                                            </div>
                                            <div class=" ">
                                            <label>14.</label>
                                                <input type="checkbox" name="test_required[]" id="seawater" value="Color Fastness to Sea Water"
                                                <?= in_array("Color Fastness to Sea Water", $selected) ? 'checked':''?>>
                                                <label for="seawater">Color Fastness to Sea Water</label>
                                            </div>
                                            <div class=" ">
                                            <label>15.</label>
                                                <input type="checkbox" name="test_required[]" id="chlorine" value="Color Fastness to Chlorine Bleach"
                                                <?= in_array("Color Fastness to Sea Water", $selected) ? 'checked':''?>>
                                                <label for="chlorine">Color Fastness to Chlorine Bleach</label>
                                            </div>
                                            <div class=" ">
                                            <label>16.</label>
                                                <input type="checkbox" name="test_required[]" id="non-chlorine" value="Color Fastness to Non-Chlorine Bleach"
                                                <?= in_array("Color Fastness to Non-Chlorine Bleach", $selected) ? 'checked':''?>>
                                                <label for="non-chlorine">Color Fastness to Non-Chlorine Bleach</label>
                                            </div>
                                            <div class=" ">
                                                <label>17.</label>
                                                <input type="checkbox" name="test_required[]" id="laundering" value="Dimensional Stability to Laundering"
                                                <?= in_array("Dimensional Stability to Laundering", $selected) ? 'checked':''?>>
                                                <label for="laundering">Dimensional Stability to Laundering*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>18.</label>
                                                <input type="checkbox" name="test_required[]" id="appereancechange" value="Appereance Change After Laundering"
                                                <?= in_array("Appereance Change After Laundering", $selected) ? 'checked':''?>>
                                                <label for="appereancechange">Appereance Change After Laundering</label>
                                            </div>
                                            <div class=" ">
                                            <label>19.</label>
                                                <input type="checkbox" name="test_required[]" id="spirality" value="Spirality"
                                                <?= in_array("Spirality", $selected) ? 'checked':''?>>
                                                <label for="spirality">Spirality*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>20.</label>
                                                <input type="checkbox" name="test_required[]" id="durability" value="Durability Test"
                                                <?= in_array("Durability Test", $selected) ? 'checked':''?>>
                                                <label for="durability">Durability Test</label>
                                            </div>
                                            <div class=" ">
                                            <label>21.</label>
                                                <input type="checkbox" name="test_required[]" id="wearingtest" value="Wearing Test"
                                                <?= in_array("Wearing Test", $selected) ? 'checked':''?>>
                                                <label for="wearingtest">Wearing Test</label>
                                            </div>
                                            <div class=" ">
                                            <label>22.</label>
                                                <input type="checkbox" name="test_required[]" id="cuttable" value="Cuttable Width"
                                                <?= in_array("Cuttable Width", $selected) ? 'checked':''?>>
                                                <label for="cuttable">Cuttable Width</label>
                                            </div>
                                            <div class=" ">
                                            <label>23.</label>
                                                <input type="checkbox" name="test_required[]" id="fabricweight" value="Fabric Weight"
                                                <?= in_array("Fabric Weight", $selected) ? 'checked':''?>>
                                                <label for="fabricweight">Fabric Weight</label>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class=" ">
                                            <label>24.</label>
                                                <input type="checkbox" name="test_required[]" id="productweigth" value="Product Weight"
                                                <?= in_array("Product Weight", $selected) ? 'checked' :'' ?>>
                                                <label for="productweight">Product Weight</label>
                                            </div>
                                            <div class=" ">
                                            <label>25.</label>
                                                <input type="checkbox" name="test_required[]" id="pieceweight" value="Piece Weight"
                                                <?= in_array("Piece Weight", $selected) ? 'checked' :'' ?>>
                                                <label for="pieceweight">Piece Weight</label>
                                            </div>
                                            <div class=" ">
                                            <label>26.</label>
                                                <input type="checkbox" name="test_required[]" id="bow" value="Bow and Skew"
                                                <?= in_array("Bow and Skew", $selected) ? 'checked' :'' ?>>
                                                <label for="bow">Bow and Skew</label>
                                            </div>
                                            <div class=" ">
                                            <label>27.</label>
                                                <input type="checkbox" name="test_required[]" id="shrinkage" value="Heat Shrinkage"
                                                <?= in_array("Heat Shrinkage", $selected) ? 'checked' :'' ?>>
                                                <label for="shrinkage">Heat Shrinkage</label>
                                            </div>
                                            <div class=" ">
                                            <label>28.</label>
                                                <input type="checkbox" name="test_required[]" id="flammability" value="Flammability"
                                                <?= in_array("Flammability", $selected) ? 'checked' :'' ?>>
                                                <label for="flammability">Flammability</label>
                                            </div>
                                            <div class=" ">
                                            <label>29.</label>
                                                <input type="checkbox" name="test_required[]" id="elongation" value="Elongation & Recovery"
                                                <?= in_array("Elongation & Recovery", $selected) ? 'checked' :'' ?>>
                                                <label for="elongation">Elongation & Recovery</label>
                                            </div>
                                            <div class=" ">
                                            <label>30.</label>
                                                <input type="checkbox" name="test_required[]" id="fiber" value="Fibre/Fuzz"
                                                <?= in_array("Fibre/Fuzz", $selected) ? 'checked' :'' ?>>
                                                <label for="fiber">Fibre/Fuzz</label>
                                            </div>
                                            <div class=" ">
                                            <label>31.</label>
                                                <input type="checkbox" name="test_required[]" id="ici" value="ICI Pilling Box"
                                                <?= in_array("ICI Pilling Box", $selected) ? 'checked' :'' ?>>
                                                <label for="ici">ICI Pilling Box*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>32.</label>
                                                <input type="checkbox" name="test_required[]" id="martindale" value="Martindale Pilling"
                                                <?= in_array("Martindale Pilling", $selected) ? 'checked' :'' ?>>
                                                <label for="martindale">Martindale Pilling*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>33.</label>
                                                <input type="checkbox" name="test_required[]" id="tumble" value="Random Tumble Pilling"
                                                <?= in_array("Random Tumble Pilling", $selected) ? 'checked' :'' ?>>
                                                <label for="tumble">Random Tumble Pilling</label>
                                            </div>
                                            <div class=" ">
                                            <label>34.</label>
                                                <input type="checkbox" name="test_required[]" id="snagging" value="Snagging (Snag Pod)"
                                                <?= in_array("Snagging (Snag Pod)", $selected) ? 'checked' :'' ?>>
                                                <label for="snagging">Snagging (Snag Pod)</label>
                                            </div>
                                            <div class=" ">
                                            <label>35.</label>
                                                <input type="checkbox" name="test_required[]" id="abrasion" value="Abrasion Resistance"
                                                <?= in_array("Abrasion Resistance", $selected) ? 'checked' :'' ?>>
                                                <label for="abrasion">Abrasion Resistance*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>36.</label>
                                                <input type="checkbox" name="test_required[]" id="abrasionsock" value="Abrasion Sock"
                                                <?= in_array("Abrasion Sock", $selected) ? 'checked' :'' ?>>
                                                <label for="abrasionsock">Abrasion Sock</label>
                                            </div>
                                            <div class=" ">
                                            <label>37.</label>    
                                                <input type="checkbox" name="test_required[]" id="pnematic" value="Bursting Pnematic"
                                                <?= in_array("Bursting Pnematic", $selected) ? 'checked' :'' ?>>
                                                <label for="pnematic">Bursting Pnematic*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>38.</label>
                                                <input type="checkbox" name="test_required[]" id="Hydraulic" value="Bursting Hydraulic"
                                                <?= in_array("Bursting Hydraulic", $selected) ? 'checked' :'' ?>>
                                                <label for="Hydraulic">Bursting Hydraulic</label>
                                            </div>
                                            <div class=" ">
                                            <label>39.</label>
                                                <input type="checkbox" name="test_required[]" id="Burst" value="Ball Burst"
                                                <?= in_array("Ball Burst", $selected) ? 'checked' :'' ?>>
                                                <label for="Burst">Ball Burst</label>
                                            </div>
                                            <div class=" ">
                                            <label>40.</label>
                                                <input type="checkbox" name="test_required[]" id="textile" value="Textile Material Thickness Measurement"
                                                <?= in_array("Textile Material Thickness Measurement", $selected) ? 'checked' :'' ?>>
                                                <label for="textile">Textile Material Thickness
                                                Measurement</label>
                                            </div>
                                            <div class=" ">
                                            <label>41.</label>
                                                <input type="checkbox" name="test_required[]" id="odour" value="Odour"
                                                <?= in_array("Odour", $selected) ? 'checked' :'' ?>>
                                                <label for="odour">Odour</label>
                                            </div>
                                            <div class=" ">
                                            <label>42.</label>
                                                <input type="checkbox" name="test_required[]" id="moisture" value="Moisture Content"
                                                <?= in_array("Moisture Content", $selected) ? 'checked' :'' ?>>
                                                <label for="moisture">Moisture Content</label>
                                            </div>
                                            <div class=" ">
                                            <label>43.</label>
                                                <input type="checkbox" name="test_required[]" id="acceleratedageing" value="Accelerated Ageing by Hydrolysis"
                                                <?= in_array("Accelerated Ageing by Hydrolysis", $selected) ? 'checked' :'' ?>>
                                                <label for="acceleratedageing">Accelerated Ageing by Hydrolysis</label>
                                            </div>
                                            <div class=" ">
                                            <label>44.</label>
                                                <input type="checkbox" name="test_required[]" id="residue" value="Residue & Ageing Test for Sticker"
                                                <?= in_array("Residue & Ageing Test for Sticker", $selected) ? 'checked' :'' ?>>
                                                <label for="residue">Residue & Ageing Test for Sticker</label>
                                            </div>
                                            <div class=" ">
                                            <label>45.</label>
                                                <input type="checkbox" name="test_required[]" id="force" value="Pull of Force"
                                                 <?= in_array("Pull of Force", $selected) ? 'checked' :'' ?>>
                                                <label for="force">Pull of Force</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class=" ">
                                            <label>46.</label>
                                                <input type="checkbox" name="test_required[]" id="seamstrengthe" value="Seam Slippage/Strength"
                                                <?= in_array("Seam Slippage/Strength", $selected) ? 'checked' :'' ?>>
                                                <label for="seamstrength">Seam Slippage/Strength</label>
                                            </div>
                                            <div class=" ">
                                            <label>47.</label>
                                                <input type="checkbox" name="test_required[]" id="seamwoven" value="Seam Slippage of Woven"
                                                 <?= in_array("Seam Slippage of Woven", $selected) ? 'checked' :'' ?>>
                                                <label for="seamwoven">Seam Slippage of Woven</label>
                                            </div>
                                            <div class=" ">
                                            <label>48.</label>
                                                <input type="checkbox" name="test_required[]" id="tearstrength" value="Tear Strength"
                                                <?= in_array("Tear Strength", $selected) ? 'checked' :'' ?>>
                                                <label for="tearstrength">Tear Strength</label>
                                            </div>
                                            <div class=" ">
                                            <label>49.</label>
                                                <input type="checkbox" name="test_required[]" id="Yarn" value="Yarn Strength"
                                                <?= in_array("Yarn Strength", $selected) ? 'checked' :'' ?>>
                                                <label for="Yarn">Yarn Strength</label>
                                            </div>
                                            <div class=" ">
                                            <label>50.</label>
                                                <input type="checkbox" name="test_required[]" id="TensileStrength" value="Tensile Strength"
                                                <?= in_array("Tensile Strength", $selected) ? 'checked' :'' ?>>
                                                <label for="TensileStrength">Tensile Strength</label>
                                            </div>
                                            <div class=" ">
                                            <label>51.</label>
                                                <input type="checkbox" name="test_required[]" id="TearForce" value="Tear Force"
                                                <?= in_array("Tear Force", $selected) ? 'checked' :'' ?>>
                                                <label for="TearForce">Tear Force</label>
                                            </div>
                                            <div class=" ">
                                            <label>52.</label>
                                                <input type="checkbox" name="test_required[]" id="ThreadCount" value="Thread Count"
                                                <?= in_array("Thread Count", $selected) ? 'checked' :'' ?>>
                                                <label for="ThreadCount">Thread Count</label>
                                            </div>
                                            <div class=" ">
                                            <label>53.</label>
                                                <input type="checkbox" name="test_required[]" id="WaterAbsorbency" value="Water Absorbency (Drop Test)"
                                                <?= in_array("Water Absorbency (Drop Test)", $selected) ? 'checked' :'' ?>>
                                                <label for="WaterAbsorbency">Water Absorbency (Drop Test)</label>
                                            </div>
                                            <div class=" ">
                                            <label>54.</label>
                                                <input type="checkbox" name="test_required[]" id="WickingHeight" value="Wicking Height"
                                                <?= in_array("Wicking Height", $selected) ? 'checked' :'' ?>>
                                                <label for="WickingHeight">Wicking Height</label>
                                            </div>
                                            <div class=" ">
                                            <label>55.</label>
                                                <input type="checkbox" name="test_required[]" id="Evaporation" value="Evaporation Rate"
                                                <?= in_array("Evaporation Rate", $selected) ? 'checked' :'' ?>>
                                                <label for="Evaporation">Evaporation Rate</label>
                                            </div>
                                            <div class="">
                                            <label>56.</label>
                                                <input type="checkbox" name="test_required[]" id="Repellency" value="Water Repellency (Spray Test)"
                                                <?= in_array("Water Repellency (Spray Test)", $selected) ? 'checked' :'' ?>>
                                                <label for="Repellency">Water Repellency (Spray Test)</label>
                                            </div>
                                            <div class=" ">
                                            <label>57.</label>
                                                <input type="checkbox" name="test_required[]" id="Waterproof" value="Waterproof (Hydrostatic)"
                                                 <?= in_array("Waterproof (Hydrostatic)", $selected) ? 'checked' :'' ?>>
                                                <label for="Waterproof">Waterproof (Hydrostatic)</label>
                                            </div>
                                            <div class=" ">
                                            <label>58.</label>
                                                <input type="checkbox" name="test_required[]" id="Permeability" value="Air Permeability"
                                                 <?= in_array("Air Permeability", $selected) ? 'checked' :'' ?>>
                                                <label for="Permeability">Air Permeability</label>
                                            </div>
                                            <div class=" ">
                                            <label>59.</label>
                                                <input type="checkbox" name="test_required[]" id="Content" value="Fibre Content"
                                                <?= in_array("Fibre Content", $selected) ? 'checked' :'' ?>>
                                                <label for="Content">Fibre Content*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>60.</label>
                                                <input type="checkbox" name="test_required[]" id="oil" value="Oil Content"
                                                <?= in_array("Oil Content", $selected) ? 'checked' :'' ?>>
                                                <label for="oil">Oil Content</label>
                                            </div>
                                            <div class=" ">
                                            <label>61.</label>
                                                <input type="checkbox" name="test_required[]" id="ph" value="pH Value"
                                                <?= in_array("pH Value", $selected) ? 'checked' :'' ?>>
                                                <label for="ph">pH Value*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>62.</label>
                                                <input type="checkbox" name="test_required[]" id="Formaldehyde" value="Formaldehyde"
                                                <?= in_array("Formaldehyde", $selected) ? 'checked' :'' ?>>
                                                <label for="Formaldehyde">Formaldehyde*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>63.</label>
                                                <input type="checkbox" name="test_required[]" id="nickel" value="Nickel Test"
                                                 <?= in_array("Nickel Test", $selected) ? 'checked' :'' ?>>
                                                <label for="nickel">Nickel Test</label>
                                            </div>
                                            <div class=" ">
                                            <label>64.</label>
                                                <input type="checkbox" name="test_required[]" id="azo" value="Azo Dyes"
                                                <?= in_array("Azo Dyes", $selected) ? 'checked' :'' ?>>
                                                <label for="azo">Azo Dyes</label>
                                            </div>
                                            <div class=" ">
                                            <label>65.</label>
                                                <input type="checkbox" name="test_required[]" id="ap" value="APEO"
                                                <?= in_array("APEO", $selected) ? 'checked' :'' ?>>
                                                <label for="ap">APEO</label>
                                            </div>
                                            <div class=" ">
                                            <label>66.</label>
                                                <input type="checkbox" name="test_required[]" id="apeo" value="AP"
                                                <?= in_array("AP", $selected) ? 'checked' :'' ?>>
                                                <label for="apeo">AP</label>
                                            </div>
                                            <div class=" ">
                                            <label>67.</label>
                                                <input type="checkbox" name="test_required[]" id="Phthalates" value="Phthalates"
                                                 <?= in_array("Phthalates", $selected) ? 'checked' :'' ?>>
                                                <label for="Phthalates">Phthalates</label>
                                            </div>
                                            <div class=" ">
                                                <span style="padding-left:15px;font-weight:bold;"><i>*)Accredited ISO/IEC 17025</i></span><hr>
                                            </div>
                                            <div class=" ">
                                                <label>Other Test ( Please specify ) :</label>
                                                <input type="text" name="test_required[]" class="form-control" value="<?= htmlspecialchars($penerimaan['test_required_other'] ?? '') ?>">
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-md-12"><hr>
                                    <div class="form-group">
                                        <label>Report No</label>
                                        <input type="text" name="report_no" class="form-control" onkeypress="return isReportNo(event)" value="<?= $penerimaan['data']->report_no ?>" Required>
                                    </div>
                                </div>
                                <div class="col-md-12 pl-pr-1">
                                    <div class="input-group">
                                        <label>Upload Specimen</label>&nbsp;&nbsp;
                                        <div class="custom-file">
                                            <input type="file" name="image_path" accept="image/*">
                                            <input type="hidden" name="existing_image_path" value="<?= $penerimaan['data']->image_path ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php if (!empty($penerimaan['data']->image_path)): ?>
                                        <div style="margin-top: 10px; padding-left: 20px;">
                                            <label>Current File:</label> <small><?= $penerimaan['data']->image_path ?></small><br>
                                            <img src="<?= base_url('images/' . $penerimaan['data']->image_path) ?>" alt="Uploaded Specimen" style="max-width: 200px; padding-top:10px;">
                                           
                                        </div>
                                        <?php endif; ?>
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
                       const form = document.querySelector('form[action*="editaksi_penerimaan"]');
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