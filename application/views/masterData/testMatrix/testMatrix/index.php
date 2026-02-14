<style>
  /* Body background */
body {
  background-color: #f8f9f7; /* broken white */
  font-family: "Segoe UI", Arial, sans-serif;
}

/* Card styling */
.card {
  box-shadow: 0 1px 6px rgba(0,0,0,0.05);
  border-radius: 10px;
  border: none;
  background-color: #ffffff; /* white card on broken white */
}

/* Card header */
.card-header {
  background: #2c3e50; /* charcoal/navy blend */
  color: white;
  font-weight: 500;
  font-size: 14px;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

/* Button small style */
.btn-sm {
  padding: 6px 14px;
  font-size: 12px;
  border-radius: 30px;
  transition: all 0.3s ease-in-out;
}

.btn-sm i {
  margin-right: 4px;
}

/* Modern button */
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

/* DataTables adjustments */
.dataTables_wrapper .dataTables_filter {
  text-align: right;
  padding-right: 10px;
  margin-top: 0;
}

.dataTables_wrapper .dataTables_length {
  padding-left: 10px;
  margin-top: 10px;
}

/* Table fix layout for alignment */
table.dataTable {
  width: 100% !important;
  table-layout: auto !important; /* Supaya lebar kolom ikut konten */
  border-collapse: collapse;
}

/* Table header styling */
table.dataTable thead th {
  white-space: nowrap !important; /* Jangan pecah baris */
  text-align: center !important;
  font-size: 12px;
  padding: 8px 12px;
  background-color: #f1f3f2;
  top: 0;
  z-index: 3;
}


/* Table body cell styling */
table.dataTable td {
  font-size: 12px;
  vertical-align: middle;
  text-align: center;
  white-space: normal; /* Biar wrap */
  overflow-wrap: break-word;
  word-break: break-word;
  padding: 6px;
  max-width: 200px;
}

/* Image in table */
table.dataTable td img {
  max-height: 40px;
  width: auto;
  object-fit: contain;
  display: block;
  margin: auto;
  border-radius: 6px;
}

/* Scroll body horizontal */
div.dataTables_scrollBody {
  overflow-x: auto;
}

/* Hilangkan gap kosong kanan */
.dataTables_scrollHeadInner,
.dataTables_scrollHeadInner table {
  width: 100% !important;
}

/* Table border adjustment */
.table td, .table th {
  padding: 6px 10px;
}

/* Responsive text */
h5 {
  font-weight: 600;
  color: #2c3e50;
}

</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
          <li class="breadcrumb-item active">Test Matrix</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" id="content" data-url="<?= base_url('c_transaksi') ?>">
  <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col">
              <h5 class="mb-0" style="font-weight: 600; color: #2c3e50;">📦 List of Test Matrix</h5>
            </div>
            <div class="col-auto">
                <a href="<?= site_url('testMatrix/tambahMatrix') ?>" class="btn btn-modern btn-sm">
                <i class="fa fa-plus"></i>&nbsp; Add New Matrix
                </a>
            </div>
        </div>
          <div class="card p-3">
              <div >
               <table id="example1" class="table table-bordered table-striped table-sm" style="width:100%">
                    <thead>
                                            <tr>
                                                <th width="2%">No</th>
                                                <th width="3%">Test Method ID</th>
                                                <th width="8%">Test Method Code</th>
                                                <th width="10%">Test Method Name</td>
                                                <th width="5%">Buyer</th>
                                                <th width="5%">Product Type</th>
                                                <th width="5%">Measurement</th>
                                                <th width="5%">Age</th>
                                                <th width="6%">Dry Process</th>
                                                <th>Test Level</th>
                                                <th>Technology Concept</th>
                                                <th width="5%">Fabric Tech</th>
                                                <th width="5%">Composition</th>
                                                <th hidden>Result Type</th>
                                                <th width="5%">Value From</th>
                                                <th width="5%">Value To </th>
                                                <th width="5%">UOM</th>
                                                <th width="5%">Pass/Fail</th>
                                                <th>Statement</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach($testmatrix as $u){
                                            ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $u->method_id ?></td>
                                                <td><?= $u->method_code?></td>
                                                <td><?= $u->title?></td>
                                                <td><?= $u->brand?></td>
                                                <td><?= $u->product_type?></td>
                                                <td><?= $u->measurement?></td>
                                                <td><?= $u->age?></td>
                                                <td><?= $u->dry ?></td>
                                                <td><?= $u->test_level?></td>
                                                <td><?= $u->technology_concept?></td>
                                                <td><?= $u->fabric_tech?></td>
                                                <td><?= $u->composition?></td>
                                                <td hidden></td>
                                                <td><?= $u->value_from?></td>
                                                <td><?= $u->value_to?></td>
                                                <td><?= $u->uom ?></td>
                                                <td><?= $u->pass_fail ?></td>
                                                <td><?= $u->statement?></td>
                                                <td>
                                                    <a href="<?=site_url('testMatrix/editMatrix/').$u->id_testmatrix?>" class="btn btn-outline-info btn-sm edit"><i class="fa fa-edit" ></i></a>
                                                    <a href="<?= site_url('testMatrix/hapus_testmatrix/'.$u->id_testmatrix) ?>"
                                                          onclick="return confirm('Apakah Anda yakin ingin menghapus <?= $u->method_code ?> ?');"
                                                    class="btn btn-outline-danger btn-sm remove">
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