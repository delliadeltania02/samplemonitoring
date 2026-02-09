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

.modal {
  z-index: 1050 !important; /* default Bootstrap */
  display: none; /* biarkan Bootstrap yang atur tampilnya */
}

.modal-backdrop {
  z-index: 1040 !important;
}

.modal.show {
  display: block !important;
  opacity: 1 !important;
}
body.modal-open {
  overflow: hidden !important;
}

/* ===== Modern Modal Style ===== */
.modern-modal {
  border-radius: 16px;
  border: none;
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  overflow: hidden;
}

.modern-modal .modal-header {
  background: linear-gradient(135deg, #2c3e50, #1c2833);
  color: #fff;
  border-bottom: none;
  padding: 1rem 1.25rem;
}

.modern-modal .modal-title {
  font-weight: 600;
  font-size: 1.5 rem;
  color:#fff;
}

.modern-modal .modal-body {
  padding: 1.5rem;
  background-color: #f9fafb;
}

.modern-modal .form-label {
  font-weight: 500;
  color: #333;
  font-size: 1.2rem;
}

.modern-modal .form-control {
  border-radius: 10px;
  border: 1px solid #dcdcdc;
  box-shadow: none;
  transition: all 0.2s ease;
}

.modern-modal .form-control:focus {
  border-color: #5a6268;
  box-shadow: 0 0 0 3px rgba(44,62,80,0.15);
}

.modern-modal .modal-footer {
  background: #f1f3f2;
  border-top: none;
  padding: 1rem;
}

.btn-modern {
  background: linear-gradient(to right, #2c3e50, #1c2833);
  color: #fff;
  border: none;
  border-radius: 30px;
  padding: 0.45rem 1.25rem;
  font-size: 0.9rem;
  transition: all 0.3s ease;
}

.btn-modern:hover {
  background: linear-gradient(to right, #1c2833, #0f1a21);
}

.btn-light {
  border-radius: 30px;
  padding: 0.45rem 1.25rem;
  border: 1px solid #ccc;
  transition: 0.3s;
}

.btn-light:hover {
  background-color: #e9ecef;
}

</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
          <li class="breadcrumb-item active">Received Report Sample</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" id="content" data-url="<?= base_url('c_transaksi') ?>">
  <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h5 class="mb-0" style="font-weight: 600; color: #2c3e50;">📦 List of Received Report Sample</h5>
                </div>
            </div>
           <div class="card p-3">
                <div class="table-wrapper">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead >
                            <tr>
                                <th>No</th>
                                <th>Report No</th>
                                <th>Item No</th>
                                <th>Order Number/PO LCO</th>
                                <th>Date Received</th>
                                <th>Date Final of Test</th>
                                <th>Done</th>
                                <th>On Progress</th>
                                <th>Test Result</th>
                                
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    <tbody id="myTable">
                        <?php 
                            $no = 1; 
                            foreach($hasil as $row){ 
                                // Skip jika belum_selesai = 0 dan selesai = 0
                                if($row->belum_selesai == 0 && $row->selesai == 0) continue;
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row->report_no ?></td>
                            <td><?= $row->item_no?></td>
                            <td><?= $row->order_number?></td>
                            <td><?= date('d-m-Y', strtotime($row->datetime_received)) ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($row->date_final)) ?></td>
                            <td><?= $row->hasil_akhir ?></td>
                            <td><?= $row->selesai ?></td>
                            <td style="background-color: <?= $row->belum_selesai == 0 ? '#228B22' : '#fff3cd' ?>;">
                                <?= $row->belum_selesai ?>
                            </td>
                            <td hidden>
                                <?php if ($row->belum_selesai == 0): ?>
                                    <a href="<?= site_url('c_transaksi/assign_index/') . $row->id_penerimaan.'/'.$row->report_no?>" class="btn btn-outline-info btn-sm button2" target="_blank">Assign</a>
                                <?php endif; ?>
                            </td>
                            <td hidden>
                                <?php if ($row->belum_selesai == 0): ?>
                                    <a href="<?= site_url('c_transaksi/report_test_all/') . $row->id_penerimaan.'/'.$row->report_no ?>" class="btn btn-outline-info btn-sm button2" target="_blank"><i class="fa fa-file-alt"></i></a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a hidden href="<?= site_url('c_transaksi/report_test_all/') . $row->id_penerimaan.'/'.$row->report_no ?>" class="btn btn-outline-info btn-sm button2" target="_blank"><i class="fa fa-file-alt"></i></a>
                                <a href="<?= site_url('c_transaksi/index_rilis/') . $row->id_penerimaan.'/'.$row->report_no ?>" class="btn btn-outline-info btn-sm button2">Release</a>                 
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>

                    </table>
                </div>
            </div>
    </div>
</section>
<!-- Modal Release -->
<div class="modal fade" id="releaseModal" tabindex="-1" aria-labelledby="releaseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content modern-modal">
      <div class="modal-header">
        <h5 class="modal-title" id="releaseModalLabel">
          <i class="fas fa-paper-plane mr-2"></i> Release Report
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="form-group mb-3">
          <label class="form-label">Date Sending</label>
          <input type="date" class="form-control" id="date_sending">
        </div>

        <div class="form-group">
          <label class="form-label">Adding Report No</label>
          <input type="text" class="form-control" id="report_no" placeholder="Enter report number">
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">
          <i class="fas fa-times mr-1"></i> Cancel
        </button>
        <button type="button" class="btn btn-modern" id="submitRelease">
          <i class="fas fa-check mr-1"></i> Submit
        </button>
      </div>
    </div>
  </div>
</div>
