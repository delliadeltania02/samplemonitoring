<style>
body {
  background-color: #f8f9f7; /* broken white */
  font-family: 'Inter', sans-serif;
}

h4 {
  font-weight: 600;
  color: #2c3e50;
}

.card {
  box-shadow: 0 1px 6px rgba(0,0,0,0.05);
  border-radius: 12px;
  border: none;
  background-color: #ffffff;
}

.card-header {
  background: linear-gradient(90deg, #2c3e50, #1c2833);
  color: #fff;
  font-weight: 500;
  font-size: 14px;
  border-top-left-radius: 12px;
  border-top-right-radius: 12px;
}

.btn {
  border-radius: 30px;
  font-size: 13px;
  transition: all 0.25s ease;
}

.btn i {
  margin-right: 4px;
}

.btn-success {
  background: linear-gradient(to right, #27ae60, #1e8449);
  border: none;
}

.btn-success:hover {
  background: linear-gradient(to right, #229954, #196f3d);
}

.btn-outline-primary:hover {
  color: #fff;
  background: #2c3e50;
  border-color: #2c3e50;
}

.table-wrapper {
  overflow-x: auto;
}

table.dataTable thead th {
  background-color: #f3f4f6;
  color: #2c3e50;
  font-weight: 600;
  font-size: 13px;
  text-transform: uppercase;
}

table.dataTable td {
  font-size: 12.5px;
  vertical-align: middle;
  color: #2f3640;
}

.table td, .table th {
  padding: 6px 10px;
}

.dataTables_wrapper .dataTables_filter input {
  border-radius: 20px;
  padding: 5px 10px;
  border: 1px solid #ccc;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
  border-radius: 30px;
  padding: 3px 10px;
}
</style>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
          <li class="breadcrumb-item active">Data Order</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content" id="content" data-url="<?= base_url('c_transaksi') ?>">
  <div class="container-fluid">
    <div class="row align-items-center mb-2">
      <div class="col">
        <h5 class="mb-0" style="font-weight: 600; color: #2c3e50;">📦 List of Data Order</h5>
      </div>
    <div>
      <a href="<?=site_url('c_transaksi/import')?>" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-file-import me-1"></i>Import Excel
      </a>
      <a href="<?=site_url('c_transaksi/tambah_order') ?>" class="btn btn-success btn-sm">
        <i class="fas fa-plus me-1"></i>Tambah Order
      </a>
    </div>
  </div>
  <div class="table-responsive">
   <table id="orderTable" class="table table-striped table-bordered table-hover align-middle text-nowrap">
      <thead class="table-light">
        <tr class="text-center align-middle">
          <th>No</th>
          <th hidden>Id Order</th>
          <th>Working No</th>
          <th>Item</th>
          <th>Brand</th>
          <th>Order No</th>
          <th>Customer</th>
          <th>Article No</th>
          <th>Color</th>
          <th>PO Quantity</th>
          <th>PODD</th>
          <th>LCO</th>
          <th>Production Date</th>
          <th>Season</th>
          <th>Line</th>
          <th style="width: 90px;">Action</th>
        </tr>
      </thead>
     
    </table>
  </div>
</div>

</section>
<script>
  setTimeout(() => {
          $.ajax({
            url:"<= site_url('c_transaksi/index_order') ?>",
            type: "GET",
            dataType:"",
            cache:"false",
            success:function($data)
            {
              $('#example2').html($data);
            }
          })
        }, 2000);
</script>