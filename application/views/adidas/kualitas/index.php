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
/* Modal clean base */
.modal-clean {
  border-radius: 12px;
  border: none;
  box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}

/* Header */
.modal-header-clean {
  border-bottom: 1px solid #eee;
  padding: 14px 18px;
}

.modal-header-clean .modal-title {
  font-size: 15px;
  font-weight: 600;
  color: #2c3e50;
}

/* Body */
.modal-body-clean {
  padding: 50px 20px;
  font-size: 13px;
  color: #333;
}

/* Footer */
.modal-footer-clean {
  border-top: 1px solid #eee;
  padding: 12px 18px;
}

/* Close button */
.modal-header-clean .close {
  font-size: 20px;
  opacity: 0.5;
}

.modal-header-clean .close:hover {
  opacity: 1;
}

/* List test required */
.list-test {
  display: flex;
  flex-direction: column;
  gap: 8px;
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
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm text-nowrap tableDefault">
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
                                          <td class="text-nowrap">
                                            <!-- MULAI TEST / LANJUTKAN -->
                                            <a href="javascript:void(0)"
                                              class="btn btn-primary btn-sm"
                                              data-toggle="modal"
                                              data-target="#modalPilihTest"
                                              data-id_penerimaan="<?= $u->id_penerimaan ?>"
                                              data-report_no="<?= $u->report_no ?>">
                                              <i class="fa fa-play"></i> Mulai Test
                                            </a>
                                            <!-- DETAIL KUALITAS -->
                                            <a href="<?= site_url('c_transaksi/detail_kualitas/' . $u->id_penerimaan) ?>"
                                              class="btn btn-outline-success btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                        </tr>
                                      <?php endforeach; ?>
                                    </tbody>
        </table>
      </div>
      <div class="modal" id="modalPilihTest" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
          <form action="<?= site_url('c_transaksi/proses_kualitas') ?>" method="post">
            <div class="modal-content modal-clean">
              <div class="modal-header modal-header-clean">
                <h5 class="modal-title">Pilih Test Required</h5>
                <button type="button" class="close" data-dismiss="modal">
                  <span>&times;</span>
                </button>
              </div>
              <div class="modal-body modal-body-clean">
                  <input type="hidden" id="id_penerimaan" name="id_penerimaan">
                  <input type="hidden" id="report_no" name="report_no">
                  <!-- DROPDOWN TEST REQUIRED-->
                  <div class="form-group">
                    <label>Test Required</label>
                     <div class="dropdown w-100">
                      <button
                        class="btn btn-outline-secondary w-100 text-left dropdown-toggle"
                        type="button"
                        data-toggle="dropdown">
                        Pilih Test Required
                      </button>
                      <div class="dropdown-menu w-100 p-2"
                          style="max-height:260px; overflow-y:auto;">
                        <!-- SEARCH -->
                        <input type="text"
                              class="form-control form-control-sm mb-2"
                              id="searchTest"
                              placeholder="Cari test...">

                          <!-- ACTION BUTTON -->
                          <div class="d-flex justify-content-between mb-2">
                            <button type="button"
                                    class="btn btn-sm btn-outline-primary"
                                    id="btnSelectAll">
                              Select All
                            </button>

                            <button type="button"
                                    class="btn btn-sm btn-outline-danger"
                                    id="btnClearAll">
                              Clear
                            </button>
                          </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer modal-footer-clean">
                <button type="submit" class="btn btn-primary btn-sm px-4">
                  Mulai Pengujian
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
		</div>
	</div>
</section>
