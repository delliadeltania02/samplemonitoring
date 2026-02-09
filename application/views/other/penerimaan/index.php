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
          <li class="breadcrumb-item active">Received Sample</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content" id="content" data-url="<?= base_url('c_transaksi') ?>">
  <div class="container-fluid">
    <div class="row align-items-center mb-2">
      <div class="col">
        <h5 class="mb-0" style="font-weight: 600; color: #2c3e50;">📦 List of Received Sample</h5>
      </div>
      <div class="col-auto">
        <a href="<?= site_url('c_transaksi/tambah_penerimaan') ?>" class="btn btn-modern btn-sm">
          <i class="fa fa-plus"></i>&nbsp; Add New Sample
        </a>
      </div>
    </div>

    <div class="card p-3">
      <div class="table-wrapper">
        <table id="example1" class="table table-bordered table-striped table-sm text-nowrap">
        <thead>
                  <tr>
                    <th>No</th>
                    <th>QR Code</th>
                    <th>Date Received</th>
                    <th>Received Sample By</th>
                    <th>Applicant</th>
                    <th>Department</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Buyer</th>
                    <th>Report No</th>
                    <th>Sample Description</th>
                    <th>Batch/LOT Number</th>
                    <th>Order Number/PO-LCO</th>
                    <th>Article No</th>
                    <th>Size</th>
                    <th>Code Of Fabric</th>
                    <th>Compotition</th>
                    <th>Item No</th>
                    <th>Style No</th>
                    <th>Season</th>
                    <th>Brands</th>
                    <th>Supplier Name</th>
                    <th>Initial Width (LA)</th>
                    <th>Request Width (LP)</th>
                    <th>Finished Width (LD)</th>
                    <th>Request Fabric Weight</th>
                    <th>Finish Fabric Weight</th>
                    <th>Material ID</th>
                    <th>Country Of Destination</th>
                    <th>Country Of Origin</th>
                    <th>Product End Use</th>
                    <th>OEKOTEX</th>
                    <th>ERP Dyeing Number</th>
                    <th>ERP Production Number</th>
                    <th>Temperature Of Process</th>
                    <th>Technique Print</th>
                    <th>Approved Date</th>
                    <th>TOD</th>
                    <th>Stage</th>
                    <th>Size Category</th>
                    <th>Sample Number</th>
                    <th>Care Instruction (Washing)</th>
                    <th>Care Instruction (Bleach)</th>
                    <th>Care Instruction (Drying)</th>
                    <th>Care Instruction (Ironing)</th>
                    <th>Care Instruction (Process)</th>
                    <th>Number Of Sample</th>
                    <th>Quantity of Sample</th>
                    <th>Gambar</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Data rows tetap seperti sebelumnya -->
                  <?php $no = 1; foreach($penerimaan as $u) { ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><img src="<?= base_url('img_qrcode/'.$u->qrcode_path) ?>"></td>
                    <td><?= $u->datetime_received ?></td>
                    <td><?= $u->received_sample_by ?></td>
                    <td><?= $u->applicant ?></td>
                    <td><?= $u->department ?></td>
                    <td><?= $u->telephone ?></td>
                    <td><?= $u->email ?></td>
                    <td><?= $u->buyer ?></td>
                    <td><?= $u->report_no ?></td>
                    <td><?= $u->sample_description ?></td>
                    <td><?= $u->batch_lot ?></td>
                    <td><?= $u->order_number ?></td>
                    <td><?= $u->article_no ?></td>
                    <td><?= $u->size ?></td>
                    <td><?= $u->code_of_fabric ?></td>
                    <td><?= $u->compotition ?></td>
                    <td><?= $u->item_no ?></td>
                    <td><?= $u->style_no ?></td>
                    <td><?= $u->season ?></td>
                    <td><?= $u->brands ?></td>
                    <td><?= $u->supplier_name ?></td>
                    <td><?= $u->initial_width ?></td>
                    <td><?= $u->request_width ?></td>
                    <td><?= $u->finished_width ?></td>
                    <td><?= $u->request_fabric ?></td>
                    <td><?= $u->finish_fabric ?></td>
                    <td><?= $u->material_id ?></td>
                    <td><?= $u->country_destination ?></td>
                    <td><?= $u->country_origin ?></td>
                    <td><?= $u->product_end ?></td>
                    <td><?= $u->oekotex ?></td>
                    <td><?= $u->dyeing_number ?></td>
                    <td><?= $u->production_number ?></td>
                    <td><?= $u->temperature_process ?></td>
                    <td><?= $u->technique_print ?></td>
                    <td><?= $u->approved_date ?></td>
                    <td><?= $u->tod ?></td>
                    <td><?= $u->stage ?></td>
                    <td><?= $u->size_category ?></td>
                    <td><?= $u->sample_no ?></td>
                    <td><?= $u->washing ?></td>
                    <td><?= $u->bleach ?></td>
                    <td><?= $u->drying ?></td>
                    <td><?= $u->ironing ?></td>
                    <td><?= $u->profess ?></td>
                    <td><?= $u->number_sample ?></td>
                    <td><?= $u->quantity_sample ?></td>
                    <td><img src="<?= base_url('images/'.$u->image_path) ?>"></td>
                    <td>
                      <a href="<?= site_url('c_transaksi/detail_penerimaan/'.$u->id_penerimaan) ?>" class="btn btn-outline-success btn-sm" title="Detail">
                        <i class="fa fa-eye"></i>
                      </a>
                      <a href="<?= site_url('c_transaksi/edit_penerimaan/'.$u->id_penerimaan) ?>" class="btn btn-outline-info btn-sm" title="Edit">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="<?= site_url('c_transaksi/hapus_penerimaan/'.$u->id_penerimaan) ?>" onclick="return confirm('Yakin hapus? <?= $u->report_no ?>')" class="btn btn-outline-danger btn-sm" title="Delete">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
