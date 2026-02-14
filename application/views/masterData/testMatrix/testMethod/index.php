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
          <li class="breadcrumb-item active">Test Method</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" id="content" data-url="<?= base_url('c_transaksi') ?>">
  <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col">
              <h5 class="mb-0" style="font-weight: 600; color: #2c3e50;">📦 List of Test Method</h5>
            </div>
            <div class="col-auto">
                <a href="<?= site_url('testMatrix/tambahMethod') ?>" class="btn btn-modern btn-sm">
                <i class="fa fa-plus"></i>&nbsp; Add New Method
                </a>
            </div>
        </div>
          <div class="card p-3">
              <div >
               <table id="example1" class="table table-bordered table-striped table-sm" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th style="width:40px;">No</th>
                            <th style="width:80px;">Test Method ID</th>
                            <th style="width:180px;">Test Standard Name</th>
                            <th style="width:120px;">Test Method Group</th>
                            <th style="width:150px;">Model / Article Level</th>
                            <th style="width:120px;">Fashion / Casual</th>
                            <th style="width:150px;">Hybrid / Performance</th>
                            <th style="width:200px;">Remarks</th>
                            <th style="width:100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                            $no = 1;
                            foreach($testmethod as $u){
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $u->method_id ?></td>
                            <td><?= $u->method_name?></td>
                            <td><?= $u->id_methodgroup?></td>
                            <td><?= $u->ma_testmethod?></td>
                            <td><?= $u->fashion_casual?></td>
                            <td><?= $u->hybrid_performance?></td>
                            <td><?= $u->remakrs?></td>
                            <td>
                                <a href="<?=site_url('testMatrix/editMethod/').$u->id_testmethod?>" class="btn btn-outline-info btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="<?=site_url('testMatrix/hapus_testmethod/').$u->id_testmethod?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?php echo $u->method_name?>?');" class="btn btn-outline-danger btn-sm remove"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                </table>
              </div>
          </div>
      </div>
</section>