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

/* ===== MODAL CLEAN MINIMAL ===== */
.modal {
  background: rgba(0,0,0,.35);
}

.modal-dialog {
  margin: 60px auto;
  max-width: 420px;
}

.modal-content {
  border-radius: 12px;
  border: none;
  box-shadow: 0 10px 30px rgba(0,0,0,.15);
}

.modal-header {
  border-bottom: none;
  padding: 15px 20px;
}

.modal-title {
  font-size: 16px;
  font-weight: 600;
}

.modal-header .close {
  font-size: 22px;
  opacity: .6;
}

.modal-header .close:hover {
  opacity: 1;
}

.modal-body {
  padding: 20px;
  color: #555;
  font-size: 14px;
  line-height: 1.6;
}

.modal-footer {
  border-top: none;
  padding: 15px 20px 20px;
}

.modal-footer .btn {
  min-width: 100px;
  border-radius: 8px;
}


</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
          <li class="breadcrumb-item active">Received Report Test Required</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" id="content" data-url="<?= base_url('c_transaksi') ?>">
  <div class="container-fluid">
        <div class="row align-items-center mb-2">
          <div class="col">
              <h5 class="mb-0" style="font-weight: 600; color: #2c3e50;">📦 List of Received Report Test Required</h5>
          </div>
        </div>
          <div class="card p-3">
              <div class="table-wrapper">
                      <table id="example1" class="table table-bordered table-striped table-sm text-nowrap" style="width:100%">
                          <thead>
                              <tr>
                                  <th style="width:20px;">No</th>
                                  <th>Report No</th>
                                  <th>Item No</th>
                                  <th>Stage</th>
                                  <th>Test Required</th>
                                  <th>Personil</th>
                                  <th>Date Received</th>
                                  <th>Batch / LOT Number</th>
                                  <th>Order Number/PO LCO</th>
                                  <th>Style</th>
                                  <th>Color</th>
                                  <th>Color Of</th>
                                  <th>Test Result</th>
                                  <th>Date Final of Test</th>
                                  <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody id="myTable">
                              <?php 
                                  $no = 1;
                                  foreach($report as $u) { ?>
                                  <tr>
                                      <td><?= $no++ ?></td>
                                      <td><?= $u->report_no?></td>
                                      <td><?= $u->item_no?></td>
                                      <td><?= $u->stage?></td>
                                      <td><?= $u->test_required?></td>
                                      <td><?= $u->personil ?></td>
                                      <td><?= $u->datetime_received ?></td>
                                      <td><?= $u->batch_lot ?></td>
                                      <td><?= $u->order_number ?></td>
                                      <td><?= $u->style_no ?></td>
                                      <td><?= $u->color ?></td>
                                      <td><?= $u->color_of ?></td>
                                      <td><?= $u->result_status ?></td>
                                      <td><?= $u->date_final?></td>
                                      <td class="text-nowrap">
                                        <!-- BUTTON EDIT → hanya muncul jika date_final kosong -->
                                        <?php if (empty($u->date_final)) : ?>
                                            <a href="<?= site_url('c_transaksi/update_report/') . $u->id_reportkualitas . '/' . $u->id_handlingsample ?>" 
                                              class="btn btn-outline-success btn-sm">
                                                <i class="fa-solid fa-file-pen"></i>
                                            </a> &nbsp;
                                        <?php endif; ?>
                                        

                                        <!-- BUTTON PDF → hanya muncul jika date_final dan personil terisi -->
                                        <?php if (!empty($u->date_final) && !empty($u->personil)): ?>
                                            <a href="<?= site_url('c_transaksi/report_test/' 
                                                    . $u->id_handlingsample . '/' 
                                                    . $u->id_reportkualitas . '/'
                                                    . rawurlencode(str_replace('/', '_', $u->test_required)) . '/' 
                                                    . rawurlencode($u->report_no)) ?>"
                                                class="btn btn-outline-info btn-sm button2" 
                                                target="_blank">
                                                <i class="fa fa-file-alt"></i>
                                            </a> &nbsp;
                                        <?php endif; ?>

                                     <button 
                      type="button"
                      class="btn btn-danger btn-sm"
                      onclick="openDeleteModal('<?= $u->id_handlingsample ?>')">
                      <i class="fa fa-trash"></i>
                    </button>

                                    </td>

                                  </tr>
                              <?php } ?>
                          </tbody>
                      </table>

              </div>
              <div class="modal modal-delete" id="modalDeleteReport" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h5 class="modal-title">Konfirmasi Hapus</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body text-center">
                      <p class="mb-0">
                        Jika data di hapus, maka akan di kembalikan ke Kualitas.
                      </p>
                      <input type="hidden" id="id_handlingsample">
                    </div>

                    <div class="modal-footer justify-content-center">
                      <button class="btn btn-light" data-dismiss="modal">Batal</button>
                      <button class="btn btn-danger px-4" onclick="deleteReport()">Hapus</button>
                    </div>

                  </div>
                </div>
              </div>
          </div>
      </div>
</section>
