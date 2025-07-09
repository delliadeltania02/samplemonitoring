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
                <li class="breadcrumb-item active">Detail Sample</li>
                </ol>
          </div>
        </div>
      </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <class="card">
                    <div class="card-header" style="background-color: #36454F;" >
                        <h3 class="card-title"></h3>
                    </div>
                    <?php foreach($penerimaan as $u) { ?>
                        <form action = "<?php echo site_url('c_transaksi/editaksi_penerimaan'); ?>" method="post" > 
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Date Time Received</label>
                                        <input type="text" name="id_penerimaan" class="form-control" value="<?php echo $u->id_penerimaan ?>" hidden>
                                        <input type="text" name="datetime_received" class="form-control" value="<?php echo $u->datetime_received;?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Received Sample By</label>
                                        <input type="text" name="received_sample_by" class="form-control" value="<?php echo $u->received_sample_by?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Report No</label>
                                        <input type="text" name="report_no" class="form-control" value="<?php echo $u->report_no?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Applicant</label>
                                        <input type="text" name="applicant" class="form-control" value="<?php echo $u->applicant?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select name="department" class="form-control" value="<?php echo $u->deparment?>" readonly>
                                            <option>Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <input type="text" name="telephone" class="form-control" value="<?php echo $u->telephone ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="<?php echo $u->email ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Buyer</label>
                                        <input type="text" name="buyer" class="form-control" value="<?php echo $u->buyer ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sample Description</label>
                                        <input type="text" name="sample_description" class="form-control" value="<?php echo $u->sample_description ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Batch / LOT Number</label>
                                        <input type="text" name="batch_lot" class="form-control" value="<?php echo $u->batch_lot ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Order Number / PO - LCO</label>
                                        <input type="text" name="order_number" class="form-control" value="<?php echo $u->order_number?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Article No</label>
                                        <input type="text" name="article_no" class="form-control" value="<?php echo $u->article_no?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Size</label>
                                        <input type="text" name="size" class="form-control" value="<?php echo $u->size?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Code Of Fabric</label>
                                        <input type="text" name="code_fabric" class="form-control" value="<?php echo $u->code_fabric ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Compotition</label>
                                        <input type="text" name="compotition" class="form-control" value="<?php echo $u->compotition?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Item No</label>
                                        <input type="text" name="item_no" class="form-control" value="<?php echo $u->item_no ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Style No</label>
                                        <input type="text" name="style_no" class="form-control" value="<?php echo $u->style_no ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Season</label>
                                        <input type="text" name="season" class="form-control" value="<?php echo $u->season ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Brands</label>
                                        <input type="text" name="brands" class="form-control" value="<?php echo $u->brands ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Supplier Name</label>
                                        <input type="text" name="supplier_name" class="form-control" value="<?php echo $u->supplier_name ?>" readonly> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Initial Width (LA)</label>
                                        <input type="text" name="initial_width" class="form-control" value="<?php echo $u->initial_width?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Request Width (LP)</label>
                                        <input type="text" name="request_width" class="form-control" value="<?php echo $u->request_width?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Finished Width (LI)</label>
                                        <input type="text" name="finished_width" class="form-control" value="<?php echo $u->finished_width?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Request Fabric Weight</label>
                                        <input type="text" name="request_fabric" class="form-control" value="<?php echo $u->request_fabric?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Finish Fabric Weight</label>
                                        <input type="text" name="finish_fabric" class="form-control" value="<?php echo $u->finish_fabric ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Color</label>
                                        <input type="text" name="color" class="form-control" value="<?php echo $u->color ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Color Of ...</label>
                                        <input type="text" name="color_of" class="form-control" value="<?php echo $u->color_of ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Material ID</label>
                                        <input type="text" name="material_id" class="form-control" value="<?php echo $u->material_id ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country Of Destination</label>
                                        <input type="text" name="country_destination" class="form-control" value="<?php echo $u->country_destination ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country Of Origin</label>
                                        <input type="text" name="country_origin" class="form-control" value="<?php echo $u->country_origin ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Product End Use</label>
                                        <input type="text" name="product_end" class="form-control" value="<?php echo $u->product_end?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>OEKOTEX</label>
                                        <input type="text" name="oekotex" class="form-control" value="<?php echo $u->oekotex?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ERP Dyeing Number</label>
                                        <input type="text" name="dyeing_number" class="form-control" value="<?php echo $u->dyeing_number?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ERP Production Number</label>
                                        <input type="text" name="production_number" class="form-control" value="<?php echo $u->production_number?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Temperature Of Process</label>
                                        <input type="text" name="temperature_process" class="form-control" value="<?php echo $u->temperature_process?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Technique Print</label>
                                        <input type="text" name="technique_print" class="form-control" value="<?php echo $u->technique_print ?>"readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Approved By (adidas strike)</label>
                                        <input type="text" name="approved_by" class="form-control" value="<?php echo $u->approved_by?>"readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Time Of Delivery (TOD)</label>
                                        <input type="text" name="tod" class="form-control" value="<?php echo $u->tod ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Stage</label>
                                        <input type="text" name="stage" class="form-control" value="<?php echo $u->stage ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Size Category</label>
                                        <input type="text" name="size_category" class="form-control" value="<?php echo $u->size_category ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sample Number</label>
                                        <input type="text" name="sample_number" class="form-control" value="<?php echo $u->sample_number ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Care Instruction ( Washing )</label>
                                        <input type="text" name="washing" class="form-control" value="<?php echo $u->washing?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Care Instruction ( Bleach )</label>
                                        <input type="text" name="bleach" class="form-control" value="<?php echo $u->bleach ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Care Instruction ( Drying )</label>
                                        <input type="text" name="drying" class="form-control" value="<?php echo $u->drying?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Care Instruction ( Ironing )</label>
                                        <input type="text" name="ironing" class="form-control" value="<?php echo $u->ironing ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Care Instruction ( Process )</label>
                                        <input type="text" name="profess" class="form-control" value="<?php echo $u->profess?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Number Of Sample</label>
                                        <input type="text" name="number_sample" class="form-control" value="<?php echo $u->number_sample?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Quantity Of Sample</label>
                                        <input type="text" name="quantity_sample" class="form-control" value="<?php echo $u->quantity_sample ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Test Required</label>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="household" value="Color Fastness to House Hold Laundering" <?php echo ($u->test_required == "Color Fastness to House Hold Laundering")?"checked":""?> readonly>
                                            <label for="household">Color Fastness to House Hold Laundering</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="water" value="Color Fastness to Water" <?php echo ($u->test_required == "Color Fastness to Water")?"checked":""?> readonly>
                                            <label for="water">Color Fastness to Water</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="perspiration" value="Color Fastness to Perspiration" <?php echo ($u->test_required == "Color Fastness to Perspiration")?"checked":""?> readonly>
                                            <label for="perspiration">Color Fastness to Perspiration</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="washing" value="Color Fastness to Washing" <?php echo ($u->test_required == "Color Fastness to Washing")?"checked":""?> readonly>
                                            <label for="washing">Color Fastness to Washing</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="rubbing" value="Color Fastness to Rubbing" <?php echo ($u->test_required == "Color Fastness to Rubbing")?"checked":""?> readonly>
                                            <label for="rubbing">Color Fastness to Rubbing</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="lightfastness" value="Color Fastness to Light Fastness" <?php echo ($u->test_required == "Color Fastness to Light Fastness")?"checked":""?> readonly>
                                            <label for="lightfastness">Color Fastness to Light Fastness</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="fastnessperspiration" value="Color Fastness to Light Fastness Perspiration" <?php echo ($u->test_required == "Color Fastness to Light Fastness Perspiration")?"checked":""?> readonly>
                                            <label for="fastnessperspiration">Color Fastness to Light Fastness Perspiration</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="phenolicyellowing" value="Color Fastness to Phenolic Yellowing" <?php echo ($u->test_required == "Color Fastness to Phenolic Yellowing")?"checked":""?> readonly>
                                            <label for="phenolicyellowing">Color Fastness to Phenolic Yellowing</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="saliva" value="Color Fastness to Saliva" <?php echo ($u->test_required == "Color Fastness to Saliva")?"checked":""?> readonly>
                                            <label for="saliva">Color Fastness to Saliva</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="storage" value="Color Fastness Dye Transfer In Storage" <?php echo ($u->test_required == "Color Fastness Dye Transfer In Storage")?"checked":""?> readonly >
                                            <label for="storage">Color Fastness Dye Transfer In Storage</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="migration" value="Color Migration Fastness" <?php echo ($u->test_required == "Color Migration Fastness")?"checked":""?> readonly>
                                            <label for="migration">Color Migration Fastness</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="oven" value="Color Migration Oven Test" <?php echo ($u->test_required == "Color Migration Oven Test")?"checked":""?> readonly>
                                            <label for="oven">Color Migration Oven Test</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="laundering" value="Dimensional Stability to Laundering" <?php echo ($u->test_required == "Dimensional Stability to Laundering")?"checked":""?>>
                                            <label for="laundering">Dimensional Stability to Laundering</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="appereancechange" value="Appereance Change After Laundering" <?php echo ($u->test_required == "Appereance Change After Laundering")?"checked":""?>>
                                            <label for="appereancechange">Appereance Change After Laundering</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="spirality" value="Spirality" <?php echo ($u->test_required == "Spirality")?"checked":""?>>
                                            <label for="spirality">Spirality</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="durability" value="Durability Test" <?php echo ($u->test_required == "Durability Test")?"checked":""?>>
                                            <label for="durability">Durability Test</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="wearingtest" value="Wearing Test" <?php echo ($u->test_required == "Wearing Test")?"checked":""?>>
                                            <label for="wearingtest">Wearing Test</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="cuttable" value="Cuttable Width" <?php echo ($u->test_required == "Cuttable Width")?"checked":""?>>
                                            <label for="cuttable">Cuttable Width</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="fabricweight" value="Fabric Weight" <?php echo ($u->test_required == "Fabric Weight")?"checked":""?>>
                                            <label for="fabricweight">Fabric Weight</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="bow" value="Bow and Skew" <?php echo ($u->test_required == "Bow and Skew")?"checked":""?>>
                                            <label for="bow">Bow and Skew</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="shrinkage" value="Heat Shrinkage"  <?php echo ($u->test_required == "Heat Shrinkage")?"checked":""?>>
                                            <label for="shrinkage">Heat Shrinkage</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="flammability" value="Flammability"  <?php echo ($u->test_required == "Flammability")?"checked":""?>>
                                            <label for="flammability">Flammability</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="elongation" value="Elongation" <?php echo ($u->test_required == "Elongation")?"checked":""?>>
                                            <label for="elongation">Elongation</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="fiber" value="Fiber/Fuzz" <?php echo ($u->test_required == "Fiber/Fuzz")?"checked":""?>>
                                            <label for="fiber">Fiber/Fuzz</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="ici" value="ICI Pilling Box" <?php echo ($u->test_required == "ICI Pilling Box")?"checked":""?>>
                                            <label for="ici">ICI Pilling Box</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="martindale" value="Martindale Pilling" <?php echo ($u->test_required == "Martindale Pilling")?"checked":""?>>
                                            <label for="martindale">Martindale Pilling</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                    
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="tumble" value="Random Tumble Pilling" <?php echo ($u->test_required == "Random Tumble Pilling")?"checked":""?>>
                                            <label for="tumble">Random Tumble Pilling</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="snagging" value="Snagging (Snag Pod)" <?php echo ($u->test_required == "Snagging (Snag Pod)")?"checked":""?>>
                                            <label for="snagging">Snagging (Snag Pod)</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="abrasion" value="Abrasion Resistance" <?php echo ($u->test_required == "Abrasion Resistance")?"checked":""?>>
                                            <label for="abrasion">Abrasion Resistance</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="pnematic" value="Bursting Pnematic" <?php echo ($u->test_required == "Bursting Pnematic")?"checked":""?>>
                                            <label for="pnematic">Bursting Pnematic</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Hydraulic" value="Bursting Hydraulic" <?php echo ($u->test_required == "Bursting Hydraulic")?"checked":""?>>
                                            <label for="Hydraulic">Bursting Hydraulic</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Burst" value="Ball Burst" <?php echo ($u->test_required == "Ball Burst")?"checked":""?>>
                                            <label for="Burst">Ball Burst</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Slippage" value="Seam Slippage/Strenght" <?php echo ($u->test_required == "Seam Slippage/Strenght")?"checked":""?>>
                                            <label for="Slippage">Seam Slippage/Strenght</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Tearing" value="Tearing" <?php echo ($u->test_required == "Tearing")?"checked":""?>>
                                            <label for="Tearing">Tearing</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Yarn" value="Yarn Strength" <?php echo ($u->test_required == "Yarn Strength")?"checked":""?>>
                                            <label for="Yarn">Yarn Strength</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Tiecord" value="Tiecord Ends/Button Pull Test" <?php echo ($u->test_required == "Tiecord Ends/Button Pull Test")?"checked":""?>>
                                            <label for="Tiecord">Tiecord Ends/Button Pull Test</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Moisture" value="Moisture Content">
                                            <label for="Moisture">Moisture Content</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Absorbancy" value="Water Absorbancy (Drop Test)" <?php echo ($u->test_required == "Water Absorbancy (Drop Test)")?"checked":""?>>
                                            <label for="Absorbancy">Water Absorbancy (Drop Test)</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Wicking" value="Wicking Height" <?php echo ($u->test_required == "Wicking Height")?"checked":""?>>
                                            <label for="Wicking">Wicking Height</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Evaporation" value="Evaporation Rate" <?php echo ($u->test_required == "Evaporation Rate")?"checked":""?>>
                                            <label for="Evaporation">Evaporation Rate</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Repellency" value="Water Repellency (Spray Test)" <?php echo ($u->test_required == "Water Repellency (Spray Test)")?"checked":""?>>
                                            <label for="Repellency">Water Repellency (Spray Test)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                    
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Waterproof" value="Waterproof (Hydrostatic)" <?php echo ($u->test_required == "Waterproof (Hydrostatic)")?"checked":""?>>
                                            <label for="Waterproof">Waterproof (Hydrostatic)</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Permeability" value="Air Permeability" <?php echo ($u->test_required == "Air Permeability")?"checked":""?>>
                                            <label for="Permeability">Air Permeability</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Accelerated" value="Accelerated Aging by Hydrolysis" <?php echo ($u->test_required == "Accelerated Aging by Hydrolysis")?"checked":""?>>
                                            <label for="Accelerated">Accelerated Aging by Hydrolysis</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Residue" value="Residue & Ageing Test for Sticker" <?php echo ($u->test_required == "Residue & Ageing Test for Sticker")?"checked":""?>>
                                            <label for="Residue">Residue & Ageing Test for Sticker</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Fibre" value="Fibre Analysis" <?php echo ($u->test_required == "Fibre Analysis")?"checked":""?>>
                                            <label for="Fibre">Fibre Analysis</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Content" value="Fibre Content" <?php echo ($u->test_required == "Fibre Content")?"checked":""?>>
                                            <label for="Content">Fibre Content</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="oil" value="Oil Content" <?php echo ($u->test_required == "Oil Content")?"checked":""?>>
                                            <label for="oil">Oil Content</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="ph" value="pH Value" <?php echo ($u->test_required == "pH Value")?"checked":""?>>
                                            <label for="ph">pH Value</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Formaldehyde" value="Formaldehyde" <?php echo ($u->test_required == "Formaldehyde")?"checked":""?>>
                                            <label for="Formaldehyde">Formaldehyde</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="nickel" value="Nickel Test" <?php echo ($u->test_required == "Nickel Test")?"checked":""?>>
                                            <label for="nickel">Nickel Test</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="azo" value="Azo Dyes" <?php echo ($u->test_required == "Azo Dyes")?"checked":""?>>
                                            <label for="azo">Azo Dyes</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="ap" value="AP / APEO" <?php echo ($u->test_required == "AP / APEO")?"checked":""?>>
                                            <label for="ap">AP / APEO</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required" id="Phtalates" value="Phtalates" <?php echo ($u->test_required == "Phtalates")?"checked":""?>>
                                            <label for="Phtalates">Phtalates</label>
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
                                      
                                    </ol>
                                </div>      
                            </div>
                        </form>
                    <?php } ?>
                    </div>
                        
            </div>
		</div>
	</div>
</section>