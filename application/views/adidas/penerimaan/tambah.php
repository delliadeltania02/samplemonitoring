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
                <div class="card">
                    <div class="card-header" style="background-color: #36454F;" >
                        <h3 class="card-title"></h3>
                    </div>
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
                                            <input type="datetime-local" name="datetime_received" class="form-control">
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
                                            <input type="text" name="sample_description" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Batch / LOT Number</label>
                                            <input type="text" name="batch_lot" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Order Number / PO - LCO</label>
                                            <input type="text" name="order_number" class="form-control">
                                        </div>
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
                                            <input type="text" name="initial_width" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Request Width (LP)</label>
                                            <input type="text" name="request_width" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Finished Width (LJ)</label>
                                            <input type="text" name="finished_width" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Request Fabric Weight</label>
                                            <input type="text" name="request_fabric" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Finished Fabric Weight</label>
                                            <input type="text" name="finish_fabric" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label>ERP Dyeing Number</label>
                                        <input type="text" name="dyeing_number" class="form-control">
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>ERP Production Number</label>
                                            <input type="text" name="production_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Country Of Destination</label>
                                            <input type="text" name="country_destination" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product End Use</label>
                                            <input type="text" name="product_end" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Article No</label>
                                            <input type="text" name="article_no" class="form-control">
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
                                            <input type="text" name="style_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Season</label>
                                            <input type="text" name="season" class="form-control">
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
                                            <input type="text" name="size" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Brands</label>
                                            <input type="text" name="brands" class="form-control">
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
                                <div class="col-md-2">
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
                                            <input type="text" name="tod" class="form-control">
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
                                    <div class="col-md-4">
                                        
                                            <div class=" ">
                                                <label>1.</label>
                                                <input type="checkbox" name ="test_required[]" id="household" value="Color Fastness to House Hold Laundering">
                                                <label for="household">Color Fastness to House Hold Laundering</label>
                                            </div>
                                            <div class=" ">
                                                <label>2.</label>
                                                <input type="checkbox" name="test_required[]" id="water" value="Color Fastness to Water">
                                                <label for="water">Color Fastness to Water*)</label>
                                            </div>
                                            <div class=" ">
                                                <label>3.</label>
                                                <input type="checkbox" name="test_required[]" id="perspiration" value="Color Fastness to Perspiration">
                                                <label for="perspiration">Color Fastness to Perspiration*)</label>
                                            </div>
                                            <div class=" ">
                                                <label>4.</label>
                                                <input type="checkbox" name="test_required[]" id="washing" value="Color Fastness to Washing">
                                                <label for="washing">Color Fastness to Washing*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>5.</label>
                                                <input type="checkbox" name="test_required[]" id="rubbing" value="Color Fastness to Rubbing">
                                                <label for="rubbing">Color Fastness to Rubbing*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>6.</label>
                                                <input type="checkbox" name="test_required[]" id="lightfastness" value="Color Fastness to Light Fastness">
                                                <label for="lightfastness">Color Fastness to Light Fastness*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>7.</label>
                                                <input type="checkbox" name="test_required[]" id="fastnessperspiration" value="Color Fastness to Light Fastness Perspiration">
                                                <label for="fastnessperspiration">Color Fastness to Light Fastness Perspiration</label>
                                            </div>
                                            <div class=" ">
                                            <label>8.</label>
                                                <input type="checkbox" name="test_required[]" id="phenolicyellowing" value="Color Fastness to Phenolic Yellowing">
                                                <label for="phenolicyellowing">Color Fastness to Phenolic Yellowing*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>9.</label>
                                                <input type="checkbox" name="test_required[]" id="saliva" value="Color Fastness to Saliva">
                                                <label for="saliva">Color Fastness to Saliva*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>10.</label>
                                                <input type="checkbox" name="test_required[]" id="storage" value="Color Fastness Dye Transfer In Storage">
                                                <label for="storage">Color Fastness Dye Transfer In Storage*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>11.</label>
                                                <input type="checkbox" name="test_required[]" id="migration" value="Color Migration Fastness">
                                                <label for="migration">Color Migration Fastness</label>
                                            </div>
                                            <div class=" ">
                                            <label>12.</label>
                                                <input type="checkbox" name="test_required[]" id="oven" value="Color Migration Oven Test">
                                                <label for="oven">Color Migration Oven Test</label>
                                            </div>
                                            <div class=" ">
                                            <label>13.</label>
                                                <input type="checkbox" name="test_required[]" id="chlorinated" value="Color Fastness to Chlorinated Water">
                                                <label for="chlorinated">Color Fastness to Chlorinated Water</label>
                                            </div>
                                            <div class=" ">
                                            <label>14.</label>
                                                <input type="checkbox" name="test_required[]" id="seawater" value="Color Fastness to Sea Water">
                                                <label for="seawater">Color Fastness to Sea Water</label>
                                            </div>
                                            <div class=" ">
                                            <label>15.</label>
                                                <input type="checkbox" name="test_required[]" id="chlorine" value="Color Fastness to Chlorine Bleach">
                                                <label for="chlorine">Color Fastness to Chlorine Bleach</label>
                                            </div>
                                            <div class=" ">
                                            <label>16.</label>
                                                <input type="checkbox" name="test_required[]" id="non-chlorine" value="Color Fastness to Non-Chlorine Bleach">
                                                <label for="non-chlorine">Color Fastness to Non-Chlorine Bleach</label>
                                            </div>
                                            <div class=" ">
                                                <label>17.</label>
                                                <input type="checkbox" name="test_required[]" id="laundering" value="Dimensional Stability to Laundering">
                                                <label for="laundering">Dimensional Stability to Laundering*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>18.</label>
                                                <input type="checkbox" name="test_required[]" id="appereancechange" value="Appereance Change After Laundering">
                                                <label for="appereancechange">Appereance Change After Laundering</label>
                                            </div>
                                            <div class=" ">
                                            <label>19.</label>
                                                <input type="checkbox" name="test_required[]" id="spirality" value="Spirality">
                                                <label for="spirality">Spirality*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>20.</label>
                                                <input type="checkbox" name="test_required[]" id="durability" value="Durability Test">
                                                <label for="durability">Durability Test</label>
                                            </div>
                                            <div class=" ">
                                            <label>21.</label>
                                                <input type="checkbox" name="test_required[]" id="wearingtest" value="Wearing Test">
                                                <label for="wearingtest">Wearing Test</label>
                                            </div>
                                            <div class=" ">
                                            <label>22.</label>
                                                <input type="checkbox" name="test_required[]" id="cuttable" value="Cuttable Width">
                                                <label for="cuttable">Cuttable Width</label>
                                            </div>
                                            <div class=" ">
                                            <label>23.</label>
                                                <input type="checkbox" name="test_required[]" id="fabricweight" value="Fabric Weight">
                                                <label for="fabricweight">Fabric Weight</label>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class=" ">
                                            <label>24.</label>
                                                <input type="checkbox" name="test_required[]" id="productweigth" value="Product Weight">
                                                <label for="productweight">Product Weight</label>
                                            </div>
                                            <div class=" ">
                                            <label>25.</label>
                                                <input type="checkbox" name="test_required[]" id="pieceweight" value="Piece Weight">
                                                <label for="pieceweight">Piece Weight</label>
                                            </div>
                                            <div class=" ">
                                            <label>26.</label>
                                                <input type="checkbox" name="test_required[]" id="bow" value="Bow and Skew">
                                                <label for="bow">Bow and Skew</label>
                                            </div>
                                            <div class=" ">
                                            <label>27.</label>
                                                <input type="checkbox" name="test_required[]" id="shrinkage" value="Heat Shrinkage">
                                                <label for="shrinkage">Heat Shrinkage</label>
                                            </div>
                                            <div class=" ">
                                            <label>28.</label>
                                                <input type="checkbox" name="test_required[]" id="flammability" value="Flammability">
                                                <label for="flammability">Flammability</label>
                                            </div>
                                            <div class=" ">
                                            <label>29.</label>
                                                <input type="checkbox" name="test_required[]" id="elongation" value="Elongation & Recovery">
                                                <label for="elongation">Elongation & Recovery</label>
                                            </div>
                                            <div class=" ">
                                            <label>30.</label>
                                                <input type="checkbox" name="test_required[]" id="fiber" value="Fibre/Fuzz">
                                                <label for="fiber">Fibre/Fuzz</label>
                                            </div>
                                            <div class=" ">
                                            <label>31.</label>
                                                <input type="checkbox" name="test_required[]" id="ici" value="ICI Pilling Box">
                                                <label for="ici">ICI Pilling Box*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>32.</label>
                                                <input type="checkbox" name="test_required[]" id="martindale" value="Martindale Pilling">
                                                <label for="martindale">Martindale Pilling*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>33.</label>
                                                <input type="checkbox" name="test_required[]" id="tumble" value="Random Tumble Pilling">
                                                <label for="tumble">Random Tumble Pilling</label>
                                            </div>
                                            <div class=" ">
                                            <label>34.</label>
                                                <input type="checkbox" name="test_required[]" id="snagging" value="Snagging (Snag Pod)">
                                                <label for="snagging">Snagging (Snag Pod)</label>
                                            </div>
                                            <div class=" ">
                                            <label>35.</label>
                                                <input type="checkbox" name="test_required[]" id="abrasion" value="Abrasion Resistance">
                                                <label for="abrasion">Abrasion Resistance*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>36.</label>
                                                <input type="checkbox" name="test_required[]" id="abrasionsock" value="Abrasion Sock">
                                                <label for="abrasionsock">Abrasion Sock</label>
                                            </div>
                                            <div class=" ">
                                            <label>37.</label>    
                                                <input type="checkbox" name="test_required[]" id="pnematic" value="Bursting Pnematic">
                                                <label for="pnematic">Bursting Pnematic*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>38.</label>
                                                <input type="checkbox" name="test_required[]" id="Hydraulic" value="Bursting Hydraulic">
                                                <label for="Hydraulic">Bursting Hydraulic</label>
                                            </div>
                                            <div class=" ">
                                            <label>39.</label>
                                                <input type="checkbox" name="test_required[]" id="Burst" value="Ball Burst">
                                                <label for="Burst">Ball Burst</label>
                                            </div>
                                            <div class=" ">
                                            <label>40.</label>
                                                <input type="checkbox" name="test_required[]" id="textile" value="Textile Material Thickness Measurement">
                                                <label for="textile">Textile Material Thickness
                                                Measurement</label>
                                            </div>
                                            <div class=" ">
                                            <label>41.</label>
                                                <input type="checkbox" name="test_required[]" id="odour" value="Odour">
                                                <label for="odour">Odour</label>
                                            </div>
                                            <div class=" ">
                                            <label>42.</label>
                                                <input type="checkbox" name="test_required[]" id="moisture" value="Moisture Content">
                                                <label for="moisture">Moisture Content</label>
                                            </div>
                                            <div class=" ">
                                            <label>43.</label>
                                                <input type="checkbox" name="test_required[]" id="acceleratedageing" value="Accelerated Ageing by Hydrolysis">
                                                <label for="acceleratedageing">Accelerated Ageing by Hydrolysis</label>
                                            </div>
                                            <div class=" ">
                                            <label>44.</label>
                                                <input type="checkbox" name="test_required[]" id="residue" value="Residue & Ageing Test for Sticker">
                                                <label for="residue">Residue & Ageing Test for Sticker</label>
                                            </div>
                                            <div class=" ">
                                            <label>45.</label>
                                                <input type="checkbox" name="test_required[]" id="force" value="Pull of Force">
                                                <label for="force">Pull of Force</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class=" ">
                                            <label>46.</label>
                                                <input type="checkbox" name="test_required[]" id="seamstrengthe" value="Seam Slippage/Strength">
                                                <label for="seamstrength">Seam Slippage/Strength</label>
                                            </div>
                                            <div class=" ">
                                            <label>47.</label>
                                                <input type="checkbox" name="test_required[]" id="seamwoven" value="Seam Slippage of Woven">
                                                <label for="seamwoven">Seam Slippage of Woven</label>
                                            </div>
                                            <div class=" ">
                                            <label>48.</label>
                                                <input type="checkbox" name="test_required[]" id="tearstrength" value="Tear Strength">
                                                <label for="tearstrength">Tear Strength</label>
                                            </div>
                                            <div class=" ">
                                            <label>49.</label>
                                                <input type="checkbox" name="test_required[]" id="Yarn" value="Yarn Strength">
                                                <label for="Yarn">Yarn Strength</label>
                                            </div>
                                            <div class=" ">
                                            <label>50.</label>
                                                <input type="checkbox" name="test_required[]" id="TensileStrength" value="Tensile Strength">
                                                <label for="TensileStrength">Tensile Strength</label>
                                            </div>
                                            <div class=" ">
                                            <label>51.</label>
                                                <input type="checkbox" name="test_required[]" id="TearForce" value="Tear Force">
                                                <label for="TearForce">Tear Force</label>
                                            </div>
                                            <div class=" ">
                                            <label>52.</label>
                                                <input type="checkbox" name="test_required[]" id="ThreadCount" value="Thread Count">
                                                <label for="ThreadCount">Thread Count</label>
                                            </div>
                                            <div class=" ">
                                            <label>53.</label>
                                                <input type="checkbox" name="test_required[]" id="WaterAbsorbency" value="Water Absorbency (Drop Test)">
                                                <label for="WaterAbsorbency">Water Absorbency (Drop Test)</label>
                                            </div>
                                            <div class=" ">
                                            <label>54.</label>
                                                <input type="checkbox" name="test_required[]" id="WickingHeight" value="Wicking Height">
                                                <label for="WickingHeight">Wicking Height</label>
                                            </div>
                                            <div class=" ">
                                            <label>55.</label>
                                                <input type="checkbox" name="test_required[]" id="Evaporation" value="Evaporation Rate">
                                                <label for="Evaporation">Evaporation Rate</label>
                                            </div>
                                            <div class="">
                                            <label>56.</label>
                                                <input type="checkbox" name="test_required[]" id="Repellency" value="Water Repellency (Spray Test)">
                                                <label for="Repellency">Water Repellency (Spray Test)</label>
                                            </div>
                                            <div class=" ">
                                            <label>57.</label>
                                                <input type="checkbox" name="test_required[]" id="Waterproof" value="Waterproof (Hydrostatic)">
                                                <label for="Waterproof">Waterproof (Hydrostatic)</label>
                                            </div>
                                            <div class=" ">
                                            <label>58.</label>
                                                <input type="checkbox" name="test_required[]" id="Permeability" value="Air Permeability">
                                                <label for="Permeability">Air Permeability</label>
                                            </div>
                                            <div class=" ">
                                            <label>59.</label>
                                                <input type="checkbox" name="test_required[]" id="Content" value="Fibre Content">
                                                <label for="Content">Fibre Content*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>60.</label>
                                                <input type="checkbox" name="test_required[]" id="oil" value="Oil Content">
                                                <label for="oil">Oil Content</label>
                                            </div>
                                            <div class=" ">
                                            <label>61.</label>
                                                <input type="checkbox" name="test_required[]" id="ph" value="pH Value">
                                                <label for="ph">pH Value*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>62.</label>
                                                <input type="checkbox" name="test_required[]" id="Formaldehyde" value="Formaldehyde">
                                                <label for="Formaldehyde">Formaldehyde*)</label>
                                            </div>
                                            <div class=" ">
                                            <label>63.</label>
                                                <input type="checkbox" name="test_required[]" id="nickel" value="Nickel Test">
                                                <label for="nickel">Nickel Test</label>
                                            </div>
                                            <div class=" ">
                                            <label>64.</label>
                                                <input type="checkbox" name="test_required[]" id="azo" value="Azo Dyes">
                                                <label for="azo">Azo Dyes</label>
                                            </div>
                                            <div class=" ">
                                            <label>65.</label>
                                                <input type="checkbox" name="test_required[]" id="ap" value="APEO">
                                                <label for="ap">APEO</label>
                                            </div>
                                            <div class=" ">
                                            <label>66.</label>
                                                <input type="checkbox" name="test_required[]" id="apeo" value="AP">
                                                <label for="apeo">AP</label>
                                            </div>
                                            <div class=" ">
                                            <label>67.</label>
                                                <input type="checkbox" name="test_required[]" id="Phthalates" value="Phthalates">
                                                <label for="Phthalates">Phthalates</label>
                                            </div>
                                            <div class=" ">
                                                <span style="padding-left:15px;font-weight:bold;"><i>*)Accredited ISO/IEC 17025</i></span><hr>
                                            </div>
                                            <div class=" ">
                                                <label>Other Test ( Please specify ) :</label>
                                                <input type="text" name="test_required[]" class="form-control" >
                                            </div>
                                        </div>
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
                                                    <input type="file" name="image_path" accept="image/*" >
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