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
                <li class="breadcrumb-item active">Add Sample Other Buyer</li>
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
                        <form action = "<?php echo site_url('c_transaksi/tambahaksi_penerimaan_other'); ?>" method="post" > 
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label>Date Time Received</label>
                                        <input type="text" name="datetime_received" class="form-control" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s');?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Received Sample By</label>
                                        <input type="text" name="received_sample_by" class="form-control" value="<?php echo $this->session->userdata('bg_nama')?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Report No</label>
                                        <input type="text" name="report_no" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Applicant</label>
                                        <input type="text" name="applicant" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select name="department" class="form-control">
                                            <option>Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <input type="text" name="telephone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Buyer</label>
                                        <input type="text" name="buyer" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sample Description</label>
                                        <input type="text" name="sample_description" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Batch / LOT Number</label>
                                        <input type="text" name="batch_lot" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Order Number / PO - LCO</label>
                                        <input type="text" name="order_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Article No</label>
                                        <input type="text" name="article_no" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Size</label>
                                        <input type="text" name="size" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Code Of Fabric</label>
                                        <input type="text" name="code_fabric" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Compotition</label>
                                        <input type="text" name="compotition" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Item No</label>
                                        <input type="text" name="item_no" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Style No</label>
                                        <input type="text" name="style_no" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Season</label>
                                        <input type="text" name="season" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Brands</label>
                                        <input type="text" name="brands" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Supplier Name</label>
                                        <input type="text" name="supplier_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Initial Width (LA)</label>
                                        <input type="text" name="initial_width" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Request Width (LP)</label>
                                        <input type="text" name="request_width" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Finished Width (LI)</label>
                                        <input type="text" name="finished_width" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Request Fabric Weight</label>
                                        <input type="text" name="request_fabric" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Finish Fabric Weight</label>
                                        <input type="text" name="finish_fabric" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Color</label>
                                        <input type="text" name="color" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Color Of ...</label>
                                        <input type="text" name="color_of" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Material ID</label>
                                        <input type="text" name="material_id" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country Of Destination</label>
                                        <input type="text" name="country_destination" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country Of Origin</label>
                                        <input type="text" name="country_origin" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Product End Use</label>
                                        <input type="text" name="product_end" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>OEKOTEX</label>
                                        <input type="text" name="oekotex" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ERP Dyeing Number</label>
                                        <input type="text" name="dyeing_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ERP Production Number</label>
                                        <input type="text" name="production_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Temperature Of Process</label>
                                        <input type="text" name="temperature_process" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Technique Print</label>
                                        <input type="text" name="technique_print" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Approved By (adidas strike)</label>
                                        <input type="text" name="approved_by" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Time Of Delivery (TOD)</label>
                                        <input type="text" name="tod" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Stage</label>
                                        <input type="text" name="stage" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Size Category</label>
                                        <input type="text" name="size_category" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sample Number</label>
                                        <input type="text" name="sample_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Care Instruction ( Washing )</label>
                                        <input type="text" name="washing" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Care Instruction ( Bleach )</label>
                                        <input type="text" name="bleach" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Care Instruction ( Drying )</label>
                                        <input type="text" name="drying" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Care Instruction ( Ironing )</label>
                                        <input type="text" name="ironing" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Care Instruction ( Process )</label>
                                        <input type="text" name="profess" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Number Of Sample</label>
                                        <input type="text" name="number_sample" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Quantity Of Sample</label>
                                        <input type="text" name="quantity_sample" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Test Required</label>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="household" value="Color Fastness to House Hold Laundering">
                                            <label for="household">Color Fastness to House Hold Laundering</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="water" value="Color Fastness to Water">
                                            <label for="water">Color Fastness to Water</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="perspiration" value="Color Fastness to Perspiration">
                                            <label for="perspiration">Color Fastness to Perspiration</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="washing" value="Color Fastness to Washing">
                                            <label for="washing">Color Fastness to Washing</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="rubbing" value="Color Fastness to Rubbing">
                                            <label for="rubbing">Color Fastness to Rubbing</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="lightfastness" value="Color Fastness to Light Fastness">
                                            <label for="lightfastness">Color Fastness to Light Fastness</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="fastnessperspiration" value="Color Fastness to Light Fastness Perspiration">
                                            <label for="fastnessperspiration">Color Fastness to Light Fastness Perspiration</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="phenolicyellowing" value="Color Fastness to Phenolic Yellowing">
                                            <label for="phenolicyellowing">Color Fastness to Phenolic Yellowing</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="saliva" value="Color Fastness to Saliva">
                                            <label for="saliva">Color Fastness to Saliva</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="storage" value="Color Fastness Dye Transfer In Storage">
                                            <label for="storage">Color Fastness Dye Transfer In Storage</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="migration" value="Color Migration Fastness">
                                            <label for="migration">Color Migration Fastness</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="oven" value="Color Migration Oven Test">
                                            <label for="oven">Color Migration Oven Test</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="laundering" value="Dimensional Stability to Laundering">
                                            <label for="laundering">Dimensional Stability to Laundering</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="appereancechange" value="Appereance Change After Laundering">
                                            <label for="appereancechange">Appereance Change After Laundering</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="spirality" value="Spirality">
                                            <label for="spirality">Spirality</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="durability" value="Durability Test">
                                            <label for="durability">Durability Test</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="wearingtest" value="Wearing Test">
                                            <label for="wearingtest">Wearing Test</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="cuttable" value="Cuttable Width">
                                            <label for="cuttable">Cuttable Width</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="fabricweight" value="Fabric Weight">
                                            <label for="fabricweight">Fabric Weight</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="bow" value="Bow and Skew">
                                            <label for="bow">Bow and Skew</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="shrinkage" value="Heat Shrinkage">
                                            <label for="shrinkage">Heat Shrinkage</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="flammability" value="Flammability">
                                            <label for="flammability">Flammability</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="elongation" value="Elongation">
                                            <label for="elongation">Elongation</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="fiber" value="Fiber/Fuzz">
                                            <label for="fiber">Fiber/Fuzz</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="ici" value="ICI Pilling Box">
                                            <label for="ici">ICI Pilling Box</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="martindale" value="Martindale Pilling">
                                            <label for="martindale">Martindale Pilling</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                    
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="tumble" value="Random Tumble Pilling">
                                            <label for="tumble">Random Tumble Pilling</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="snagging" value="Snagging (Snag Pod)">
                                            <label for="snagging">Snagging (Snag Pod)</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="abrasion" value="Abrasion Resistance">
                                            <label for="abrasion">Abrasion Resistance</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="pnematic" value="Bursting Pnematic">
                                            <label for="pnematic">Bursting Pnematic</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Hydraulic" value="Bursting Hydraulic">
                                            <label for="Hydraulic">Bursting Hydraulic</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Burst" value="Ball Burst">
                                            <label for="Burst">Ball Burst</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Slippage" value="Seam Slippage/Strenght">
                                            <label for="Slippage">Seam Slippage/Strenght</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Tearing" value="Tearing">
                                            <label for="Tearing">Tearing</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Yarn" value="Yarn Strength">
                                            <label for="Yarn">Yarn Strength</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Tiecord" value="Tiecord Ends/Button Pull Test">
                                            <label for="Tiecord">Tiecord Ends/Button Pull Test</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Moisture" value="Moisture Content">
                                            <label for="Moisture">Moisture Content</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Absorbancy" value="Water Absorbancy (Drop Test)">
                                            <label for="Absorbancy">Water Absorbancy (Drop Test)</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Wicking" value="Wicking Height">
                                            <label for="Wicking">Wicking Height</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Evaporation" value="Evaporation Rate">
                                            <label for="Evaporation">Evaporation Rate</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Repellency" value="Water Repellency (Spray Test)">
                                            <label for="Repellency">Water Repellency (Spray Test)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                    
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Waterproof" value="Waterproof (Hydrostatic)">
                                            <label for="Waterproof">Waterproof (Hydrostatic)</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Permeability" value="Air Permeability">
                                            <label for="Permeability">Air Permeability</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Accelerated" value="Accelerated Aging by Hydrolysis">
                                            <label for="Accelerated">Accelerated Aging by Hydrolysis</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Residue" value="Residue & Ageing Test for Sticker">
                                            <label for="Residue">Residue & Ageing Test for Sticker</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Fibre" value="Fibre Analysis">
                                            <label for="Fibre">Fibre Analysis</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Content" value="Fibre Content">
                                            <label for="Content">Fibre Content</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="oil" value="Oil Content">
                                            <label for="oil">Oil Content</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="ph" value="pH Value">
                                            <label for="ph">pH Value</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Formaldehyde" value="Formaldehyde">
                                            <label for="Formaldehyde">Formaldehyde</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="nickel" value="Nickel Test">
                                            <label for="nickel">Nickel Test</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="azo" value="Azo Dyes">
                                            <label for="azo">Azo Dyes</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="ap" value="AP / APEO">
                                            <label for="ap">AP / APEO</label>
                                        </div>
                                        <div class="icheck-secondary">
                                            <input type="checkbox" name="test_required[]" id="Phtalates" value="Phtalates">
                                            <label for="Phtalates">Phtalates</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="col-md-1">
                                        <a href="<?=site_url('c_method/index_ttd')?>" type="button" class="btn btn-block" style="background-color: #36454F;color: white;" >Back</a> 
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
                    </div>
            </div>
		</div>
	</div>
</section>