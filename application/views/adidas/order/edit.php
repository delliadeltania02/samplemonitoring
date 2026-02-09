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
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active">Detail Data Order</li>
                </ol>
          </div>
        </div>
      </div>
</div>
<section class="content" >
  <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                <class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title"></h3>
                  </div>
                  <!--form start-->

                    <form action = "<?php echo site_url('#'); ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <input type="hidden" value="<?php echo $detail->id_order?>" name="id_order">
                                        <input name="brand" type="text" class="form-control" value="<?php echo $detail->brand ?>"  >
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Order Number</label>
                                        <input name="order_number" type="text" class="form-control" value="<?php echo $detail->order_number ?>"  > 
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                <div class="form-group">
                                        <label>Costumer Code</label>
                                        <input name="costumer_code" type="text" class="form-control" value="<?php echo $detail->costumer_code ?>"  >
                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Costumer Name</label>
                                        <input name="costumer_name" type="text" class="form-control" value="<?php echo $detail->costumer_name?>"  >
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Articel No</label>
                                        <input name="article_no" type="text" class="form-control" value="<?php echo $detail->article_no ?>"  >
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                <div class="form-group">
                                        <label>Color</label>
                                        <input name="color" type="text" class="form-control" value="<?php echo $detail->color ?>"  >
                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input name="age" type="text" class="form-control" value="<?php echo $detail->age?>"  >
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Working Number</label>
                                        <input name="working_number" type="text" class="form-control" value="<?php echo $detail->working_number ?>"  > 
                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                <div class="form-group">
                                    <label>Item #</label>
                                    <input name="item_name"  type="text" class="form-control" value="<?php echo $detail->item_name?>"  >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Material Lifecycle Status</label>
                                <select name="exception" class="form-control">
                                    <option disabled>--Pilih--</option>
                                    <option value="Limited Released" <?= ($detail->exception == 'Limited Released') ? 'selected' : '' ?>>Limited Released</option>
                                    <option value="Released" <?= ($detail->exception == 'Released') ? 'selected' : '' ?>>Released</option>
                                    <option value="Restricted Released" <?= ($detail->exception == 'Restricted Released') ? 'selected' : '' ?>>Restricted Released</option>
                                </select>
                            </div>
                            <div class="col-md-4 pl-pr-1">
                                <div class="form-group">
                                    <label>Style</label>
                                    <input name="style" type="text" class="form-control" value="<?php echo $detail->style?>"  >
                                </div>
                            </div>
                                <div class="col-md-4 pl-pr-1">
                                <div class="form-group">
                                        <label>PODD</label>
                                        <input name="podd" type="date" class="form-control" value="<?php echo $detail->podd?>"  >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>LCO</label>
                                        <input name="lco" type="date" class="form-control" value="<?php echo $detail->lco?>"  >
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>PO Quantity</label>
                                        <input name="po_quantity" type="text" class="form-control" value="<?php echo $detail->po_quantity?>"  >
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                <div class="form-group">
                                        <label>Production Date</label>
                                        <input name="production_date" type="date" class="form-control" value="<?php echo $detail->production_date?>"  >
                                    </div>
                                </div>
                        
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Season</label>
                                        <input name="season" type="text" class="form-control" value="<?php echo $detail->season?>"  >
                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Factory Disclaimer</label>
                                      <select class="form-control" name="factory_discleamer">
                                            <option value="yes" <?= ($detail->factory_discleamer == 'yes') ? "selected" : "" ?>>Yes</option>
                                            <option value="no"  <?= ($detail->factory_discleamer == 'no')  ? "selected" : "" ?>>No</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Functional Fabric</label>
                                        <select class="form-control">
                                            <option value="yes" <?= ($detail->functional == 'yes') ? "selected": "" ?>>Yes</option>
                                            <option value="no" <?= ($detail->functional == 'no') ? "selected": "" ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Functional Hangtag</label>
                                        <input name="hangtag" type="hangtag" class="form-control" value="<?php echo $detail->hangtag  ?>"  >
                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Line</label>
                                        <input name="line" type="text" class="form-control" value="<?php echo $detail->line?>"  >
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                        <div class="card-footer">
                                  <div class="col-md-1">
                                        <a href="<?=site_url('c_transaksi/index_order')?>" type="button" class="btn btn-block" style="background-color: #36454F;color: white;" >Back</a> 
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