<style>
body {
  background-color: #f8f9f7; /* broken white */
}
.card {
  box-shadow: 0 1px 6px rgba(0,0,0,0.05);
  border-radius: 10px;
  border: none;
  background-color: #ffffff; /* white card on broken white */
}
.card-header {
  background: #2c3e50; /* charcoal/navy blend */
  color: white;
  font-weight: 500;
  font-size: 14px;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}
.btn-sm {
  padding: 6px 14px;
  font-size: 12px;
  border-radius: 30px;
  transition: all 0.3s ease-in-out;
}
.btn-sm i {
  margin-right: 4px;
}
.btn-modern {
  background: linear-gradient(to right, #2c3e50, #1c2833); /* charcoal to navy */
  color: white;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  border: none;
}
.btn-modern:hover {
  background: linear-gradient(to right, #1c2833, #0f1a21);
  color: #fff;
}
.table-wrapper {
  background: none;
  padding: 0;
  box-shadow: none;
  overflow-x: auto;
}
.dataTables_wrapper .dataTables_filter {
  text-align: right;
  padding-right: 10px;
  margin-top: 0;
}
.dataTables_wrapper .dataTables_length {
  padding-left: 10px;
  margin-top: 10px;
}
table.dataTable thead th {
  position: sticky;
  top: 0;
  background-color: #f1f3f2; /* soft broken white */
  z-index: 2;
  font-size: 13px;
  white-space: nowrap;
}
table.dataTable td {
  font-size: 12px;
  vertical-align: middle;
  white-space: nowrap;
}
table.dataTable td img {
  max-height: 40px;
  width: auto;
  object-fit: contain;
  display: block;
  margin: auto;
  border-radius: 6px;
}
.table td, .table th {
  padding: 6px 10px;
}
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
          <li class="breadcrumb-item active">Quality Sample</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" id="content" data-url="<?= base_url('c_transaksi') ?>">
  <div class="container-fluid">
    <div class="row align-items-center mb-2">
      <div class="col">
        <h5 class="mb-0" style="font-weight: 600; color: #2c3e50;">📦 List of Quality Sample</h5>
      </div>
    </div>
    <div class="card p-3">
      <div class="table-wrapper">
        <table id="example1" class="table table-bordered table-striped table-sm text-nowrap">
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
                                                    "Color Fastness to House Hold Laundering" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Fastness to Water" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Fastness to Perspiration" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Fastness to Washing" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Fastness to Rubbing" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Fastness to Light Fastness" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Fastness to Light Fastness Perspiration" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Fastness to Phenolic Yellowing" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Fastness to Saliva" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Fastness Dye Transfer In Storage" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    // Add other tests here
                                                    "Color Migration Fastness" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Migration Oven Test" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Fastness to Chlorine Water" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Fastness to Sea Water" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Fastness to Chlorine Bleach" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Color Fastness to Non-Chlorine Bleach" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Dimensional Stability to Laundering" =>  "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",  
                                                    "Appereance Change After Laundering" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",  
                                                    "Spirality" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Durability Test" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Wearing Test" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Cuttable Width" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Fabric Weight" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Product Weight" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Piece Weight" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Bow and Skew" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Heat Shrinkage" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Flammability" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Elongation & Recovery" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Fibre/Fuzz" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "ICI Pilling Box" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Martindale Pilling" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Random Tumble Pilling" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Snagging (Snag pod)" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Abrasion Resistance" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Abrasion Sock" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Bursting Pneumatic" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Ball Burst" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Textile Material Thickness Measurement" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Odour" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Moisture Content" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Accelerated Ageing by Hydrolysis" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Residu & Ageing by Test for Sticker" =>"{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Pull of Force" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Seam Slippage/Strength" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Seam Slippage of Woven" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Tear Strength" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Yarn Strength" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Tensile Strength" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Tear Force" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Thread Count" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Water Absorbency (Drop Test)" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Wicking Height" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Evaporation Rate" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Water Repellency (Spray Test)" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Waterproof (Hydrostatic)" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Air Permeability" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Fibre Content" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Oil Content" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "pH Value" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Formaldehyde" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Nickel Test" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Azo Dyes" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "AP" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "APEO" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Phtalates" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Snagging (Snag Pod)" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Bursting Pnematic" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}",
                                                    "Residue & Ageing Test for Sticker" => "{$u->report_no}/{$u->id_kualitas}/{$u->id_penerimaan}/{$u->id_reportkualitas}"
                                                  ];

                                                // Check if the test_required exists in the map
                                                /*if (isset($test_map[$u->test_required])) {
                                                    $link = $base_url . $test_map[$u->test_required];
                                                    echo "<a href=\"{$link}\">{$u->test_required}</a>";
                                                }*/
                                                    if (isset($test_map[$u->test_required])) {
                                                        $link = $base_url . $test_map[$u->test_required];

                                                        if ($u->status === 'kembali') {
                                                            // Tampilkan sebagai teks biasa jika status kembali
                                                            echo $u->test_required;
                                                        } else {
                                                            // Tampilkan sebagai link jika status bukan kembali
                                                            echo "<a href=\"{$link}\">{$u->test_required}</a>";
                                                        }
                                                    } else {
                                                        echo $u->test_required;
                                                    }

                                            ?>
                                          
                                            </td>
                                            <td>
                                             <a href="<?= ($u->status === 'kembali') 
                                                      ? site_url("c_transaksi/edit_kualitas/{$u->id_penerimaan}/{$u->id_reportkualitas}") 
                                                      : '#' ?>" 
                                                class="btn btn-sm <?= ($u->status === 'kembali') ? 'btn-warning' : 'btn-secondary disabled' ?>" 
                                                <?= ($u->status === 'kembali') ? '' : 'disabled' ?>>
                                                  Revisi
                                              </a>
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
</section>