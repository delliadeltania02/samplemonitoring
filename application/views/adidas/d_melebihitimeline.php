<!-- Modern & Clean Dashboard UI Redesign (Enhanced Darker Accent) -->
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

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
    /* Tambahan fix untuk lebar kolom stabil */
    table.dataTable {
        table-layout: fixed;
        width: 100% !important;
        border-collapse: collapse;
    }

    /* Supaya teks yang panjang tidak bikin kolom melebar */
    table.dataTable thead th,
    table.dataTable tbody td {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

</style>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-3">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
          <li class="breadcrumb-item active">Detail Sesuai Timeline</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row mb-3">
      <div class="col-md-12" hidden>
        <span class="dashboard-title">Penerimaan & Pengujian Sample</span>
        <hr>
      </div>
    </div>
    <div class="card p-3">
      <div class="table-wrapper">
        <table id="example1" class="table table-bordered table-striped table-sm text-nowrap">
           <thead class="table-light">
                <tr class="text-center align-middle">
                    <th style="width: 50px;">No</th>
                    <th>Report No</th>
                    <th>Date Received</th>
                    <th>Date Final of Test</th>
                    <th>Total Test</th>
                </tr>
            </thead>
            <tbody  id="myTable">
                <?php $no = 1; foreach($detail as $u) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $u->report_no ?></td>
                        <td><?= date('d-m-Y', strtotime($u->datetime_received)) ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($u->date_final)) ?></td>
                        <td><?= $u->selesai ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
      </div>   
    </div>
     <div class="col-md-12" style="margin-top: 50px">
        <a href="<?=site_url('c_transaksi/index') ?>" class="btn btn-success btn-sm" 
        style="position: absolute; bottom: 10px; left: 10px;">Back To Dashboard</a> 
      </div>
</section>
