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
                <li class="breadcrumb-item active">Quality Sample</li>
                </ol>
          </div>
        </div>
      </div>
</div>
<section class="content" id="content "data-url="<?= base_url('c_transaksi') ?>">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-10" style="padding-bottom: 1%;">
            
            </div>
            <div class="col-md-2" style="padding-bottom: 1%;">
           
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #36454F;" >
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">    
                        <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-striped table-sm text-nowrap">
                                    <thead>
                                      <tr>
                                      <th class="all">No</th>
                                          <th>Report No</th>
                                          <th>Item No</th>
                                          <th>Stage</th>
                                          <th>Date Received</th>
                                          <th>Batch/LOT Number</th>
                                          <th>Order Number/PO-LCO</th>
                                          <th>Article No</th>
                                          <th>Code Of Fabric</th>
                                          <th>Style No</th>
                                          <th>Color</th>
                                          <th>Color Of ...</th>
                                          <th>Test Required</th>
                                          <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody id="myTable">
                                      <?php
                                       $no = 1;
                                       foreach($kualitas as $u) : ?>
                                       
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $u->report_no?></td>
                                            <td><?= $u->item_no?></td>
                                            <td><?= $u->stage?></td>
                                            <td><?= $u->datetime_received  ?></td>
                                            <td><?= $u->batch_lot?></td>
                                            <td><?= $u->order_number?></td>
                                            <td><?= $u->article_no?></td>
                                            <td><?= $u->code_of_fabric?></td>
                                            <td><?= $u->style_no?></td>
                                            <td><?= $u->color?></td>
                                            <td><?= $u->color_of?></td>
                                            <td>
                                            <?php
                                                $base_url = site_url('c_transaksi/index_testResult/');

                                                // Map of test names to URL parameters
                                                $test_map = [
                                                    "Color Fastness to House Hold Laundering" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Fastness to Water" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Fastness to Perspiration" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Fastness to Washing" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Fastness to Rubbing" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Fastness to Light Fastness" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Fastness to Light Fastness Perspiration" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Fastness to Phenolic Yellowing" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Fastness to Saliva" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Fastness Dye Transfer In Storage" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    // Add other tests here
                                                    "Color Migration Fastness" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Migration Oven Test" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Fastness to Chlorine Water" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Fastness to Sea Water" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Fastness to Chlorine Bleach" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Color Fastness to Non-Chlorine Bleach" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Dimensional Stability to Laundering" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",  
                                                    "Appereance Change After Laundering" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",  
                                                    "Spirality" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Durability Test" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Wearing Test" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Cuttable Width" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Fabric Weight" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Product Weight" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Piece Weight" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Bow and Skew" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Heat Shrinkage" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Flammability" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Elongation & Recovery" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Fibre/Fuzz" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "ICI Pilling Box" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Martindale Pilling" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Random Tumble Pilling" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Snagging (Snag pod)" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Abrasion Resistance" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Abrasion Sock" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Bursting Pneumatic" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Ball Burst" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Textile Material Thickness Measurement" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Odour" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Moisture Content" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Accelerated Ageing by Hydrolysis" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Residu & Ageing by Test for Sticker" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Pull of Force" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Seam Slippage/Strength" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Seam Slippage of Woven" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Tear Strength" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Yarn Strength" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Tensile Strength" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Tear Force" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Thread Count" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Water Absorbency (Drop Test)" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Wicking Height" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Evaporation Rate" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Water Repellency (Spray Test)" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Waterproof (Hydrostatic)" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Air Permeability" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Fibre Content" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Oil Content" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "pH Value" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Formaldehyde" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Nickel Test" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Azo Dyes" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "AP" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "APEO" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Phtalates" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Snagging (Snag Pod)" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}",
                                                    "Bursting Pnematic" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}"
                                                ];

                                                // Check if the test_required exists in the map
                                                if (isset($test_map[$u->test_required])) {
                                                    $link = $base_url . $test_map[$u->test_required];
                                                    echo "<a href=\"{$link}\">{$u->test_required}</a>";
                                                } 
                                            ?>
                                          
                                            </td>
                                            <td>
                                              <a href="<?= site_url('c_transaksi/detail_kualitas/' . $u->id_penerimaan . '/' . $u->id_kualitas) ?>" class="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
                                              <a href="<?=site_url('c_transaksi/hapus_kualitas/').$u->id_kualitas?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?php echo $u->test_required ?>');" class="btn btn-outline-danger btn-sm remove"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                       
                                      <?php endforeach; ?>
                                    </tbody>
                                  </table>
                              </div>
                            </div>
                        </div>        	
                    </div>
                    </div>
            </div>
		</div>
	</div>
</section>