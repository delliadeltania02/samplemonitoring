<style>
.dataTables_filter{
display:block;
float:right;
}
 </style>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Handling Sample</a></li>
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
                <div class="card">
                    <div class="card-header" style="background-color: #36454F;" >
                        <h3 class="card-title"></h3>
                    </div>
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
                                            <select name="applicant" id="applicant" class="form-control" disabled>
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
                                            <input type="text" name="department" id="department" class="form-control"  value="<?= $penerimaan['data']->department ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Telephone</label>
                                            <input type="text" name="telephone" id="telephone" class="form-control" value="<?= $penerimaan['data']->no_tlp ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" id="email" class="form-control" value="<?php echo $penerimaan['data']->email ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Buyer</label>
                                            <input type="text" name="buyer" class="form-control" value="adidas" value="<?php echo $penerimaan['data']->buyer ?>" disabled>
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
                                                <input type="datetime-local" name="datetime_received" class="form-control" value="<?php echo $penerimaan['data']->datetime_received ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Received Sample By</label>
                                                <input type="text" name="received_sample_by" class="form-control" value="<?php echo $this->session->userdata('bg_nama')?>" disabled>
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
                                                <input type="text" name="sample_description" class="form-control" value="<?php echo $penerimaan['data']->sample_description ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Batch / LOT Number</label>
                                                <input type="text" name="batch_lot" class="form-control" value="<?php echo $penerimaan['data']->batch_lot ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Order Number / PO - LCO</label>
                                                <input type="text" name="order_number" class="form-control" value="<?php echo $penerimaan['data']->order_number ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Code Of Fabric</label>
                                                <input type="text" name="code_of_fabric" id="code_of_fabric" class="form-control" value="<?php echo $penerimaan['data']->code_of_fabric?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Initial Width (LA)</label>
                                                <input type="text" name="initial_width" class="form-control" value="<?php echo $penerimaan['data']->initial_width ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Request Width (LP)</label>
                                                <input type="text" name="request_width" class="form-control" value="<?php echo $penerimaan['data']->request_width?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Finished Width (LJ)</label>
                                                <input type="text" name="finished_width" class="form-control" value="<?php echo $penerimaan['data']->finished_width ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Request Fabric Weight</label>
                                                <input type="text" name="request_fabric" class="form-control" value="<?php echo $penerimaan['data']->request_fabric ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Finished Fabric Weight</label>
                                                <input type="text" name="finish_fabric" class="form-control" value="<?php echo $penerimaan['data']->finish_fabric ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label>ERP Dyeing Number</label>
                                            <input type="text" name="dyeing_number" class="form-control" value="<?php echo $penerimaan['data']->dyeing_number?>" disabled>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>ERP Production Number</label>
                                                <input type="text" name="production_number" class="form-control" value="<?php echo $penerimaan['data']->production_number?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Country Of Destination</label>
                                                <input type="text" name="country_destination" class="form-control" value="<?php echo $penerimaan['data']->country_destination?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product End Use</label>
                                                <input type="text" name="product_end" class="form-control" value="<?php echo $penerimaan['data']->product_end ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Article No</label>
                                                <input type="text" name="article_no" class="form-control" value="<?php echo $penerimaan['data']->article_no ?>" disabled>
                                            </div>
                                        </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Item No</label>
                                            <select name="item_no" id="item_no" class="form-control select2" disabled>
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
                                            <input type="text" name="style_no" class="form-control" value="<?php echo $penerimaan['data']->style_no?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Season</label>
                                            <input type="text" name="season" class="form-control" value="<?php echo $penerimaan['data']->season ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Approved date by CCDA</label>
                                            <input type="text" name="approved_date" class="form-control" value="<?php echo $penerimaan['data']->approved_date?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                            <!-- Supplier Name -->
                                            <div class="col-md-6">
                                                <label>Supplier Name</label>
                                                <select name="supplier_name" id="supplier_name" class="form-control select2" disabled>
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
                                                <input type="text" name="supplier_code" class="form-control" disabled>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Size</label>
                                            <input type="text" name="size" class="form-control" value="<?php echo $penerimaan['data']->size?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Brands</label>
                                            <input type="text" name="brands" class="form-control" value="<?php echo $penerimaan['data']->brands ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Material ID</label>
                                            <input type="text" name="material_id" class="form-control" value="<?php echo $penerimaan['data']->material_id?>" disabled>
                                        </div>
                                    </div> 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Temp of process</label>
                                            <input type="text" name="temperature_process" class="form-control" value="<?php echo $penerimaan['data']->temperature_process ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Technique Print</label>
                                            <input type="text" name="technique_print" class="form-control" value="<?php echo $penerimaan['data']->technique_print?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Country Of Origin</label>
                                            <input type="text" name="country_origin" class="form-control" value="<?php echo $penerimaan['data']->country_origin ?>" disabled>
                                        </div>
                                    </div>        
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>OEKOTEX</label>
                                            <select name="oekotex" class="form-control" disabled>
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
                                            <input type="text" name="number_sample" class="form-control" value="<?php echo $penerimaan['data']->number_sample?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Quantity Of Sample</label>
                                            <input type="text" name="quantity_sample" class="form-control" value="<?php echo $penerimaan['data']->quantity_sample?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Time Of Delivery (TOD)</label>
                                            <input type="text" name="tod" class="form-control" value="<?php echo $penerimaan['data']->tod ?>" disabled>
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
                                            <input type="text" name="color[]" class="form-control" 
                                                value="<?= htmlspecialchars($colors[0]) ?>" disabled>
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" name="color[]" class="form-control" 
                                                value="<?= htmlspecialchars($colors[1]) ?>" disabled>
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" name="color[]" class="form-control" 
                                                value="<?= htmlspecialchars($colors[2]) ?>" disabled>
                                        </div>

                                        <div class="col-md-2" hidden>
                                            <button type="button" class="btn btn-block btn-tambah" style="background:#b8b8b8;">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-1" hidden>
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
                                            ?>" disabled><br>
                                        </div>
                                        <?php
                                           $color_of_map = $penerimaan['color_of_map'] ?? []; // array seperti ['a', 'b']
                                           $color_of_map = array_pad($color_of_map, 3, '');
                                        ?>
                                        <div class="col-md-3">
                                            <input type="text" name="color_of[]" class="form-control" 
                                            value="<?= htmlspecialchars($color_of_map[0]) ?>" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="color_of[]" class="form-control" 
                                            value="<?= htmlspecialchars($color_of_map[1]) ?>"disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="color_of[]" class="form-control"  
                                            value="<?= htmlspecialchars($color_of_map[2]) ?>" disabled>
                                        </div>
                                        <div class="col-md-2" hidden>
                                            <button type="button" class="btn btn-block btn-tambah-of" style="background:#b8b8b8;"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <div class="col-md-1" hidden>
                                            <button type="button" class="btn btn-block btn-hapus-of" style="background:#b8b8b8; display:none;"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><br>
                                            <div class="form-group">
                                                <label>Compotition</label>
                                                <input type="text" name="composition" id="composition" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Stage</label>
                                                <select name="stage" class="form-control" disabled>
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
                                                <input type="text" name="stageother" class="form-control" placeholder="other stage" disabled>
                                            </div>                                        
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Size Category</label>
                                                <select name="size_category" class="form-control" disabled>
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
                                                <input type="text" name="size_categoryother" class="form-control" placeholder="other size category" disabled>
                                            </div>                                        
                                        </div>
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sample No</label>
                                                <select name="sample_no" class="form-control" disabled>
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
                                                <input type="text" name="other_sampleno" class="form-control" placeholder="Report No" disabled>
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
                                            <select name="washing" class="form-control" disabled>
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
                                            <select name="bleching" class="form-control" disabled>
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
                                            <select name="drying" class="form-control" disabled> 
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
                                            <select name="ironing" class="form-control" disabled>
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
                                            <select name="profess" class="form-control" disabled>
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
                                    <input type="text" class="form-control" value="<?= $penerimaan['kualitas_satu']->test_required ?>" disabled>
                                </div>
                                <div class="col-md-12"><hr>
                                    <div class="form-group">
                                        <label>Report No</label>
                                        <input disabled type="text" name="report_no" class="form-control" onkeypress="return isReportNo(event)" value="<?= $penerimaan['data']->report_no ?>" Required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Current Specimen</label>&nbsp;&nbsp;
                                        <?php if (!empty($penerimaan['data']->image_path)): ?><br>
                                            <img src="<?= base_url('images/' . $penerimaan['data']->image_path) ?>" alt="Uploaded Specimen" style="max-width: 200px; padding-top:5px;">                                        
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <div class="col-md-1">
                                        <a href="<?=site_url('c_transaksi/index_kualitas')?>" type="button" class="btn btn-block" style="background-color: #36454F;color: white;" >Back</a> 
                                </div>
                                <div class="col-md-10">
                                    
                                </div>
                                <div class="col-md-1">
                                    <ol class="float-sm-right">

                                    </ol>
                                </div>      
                            </div>
                        </form>
                    </div>    
            </div>
		</div>
	</div>
</section>