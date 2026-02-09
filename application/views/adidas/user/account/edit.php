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
          <li class="breadcrumb-item"><a href="#">System</a></li>
          <li class="breadcrumb-item active">Add Account</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" id="content" data-url="<?= base_url('c_transaksi') ?>">
  <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col">
           
            </div>
            <div class="col-auto">
               
            </div>
        </div>
        <div class="card p-1">
              <div >
                <form action="<?= site_url('c_transaksi/editaksi_account'); ?>" method="post">
                    <!-- ID USER (WAJIB) -->
                    <input type="hidden" name="id_user" value="<?= $u->id_user ?>">
                    <input type="hidden" name="user_status" value="1">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text"
                                class="form-control"
                                name="nama"
                                value="<?= $u->nama ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text"
                                class="form-control"
                                name="username"
                                value="<?= $u->username ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password"
                                class="form-control"
                                name="password"
                                placeholder="Kosongkan jika tidak diubah">
                            <small class="text-muted">
                                Isi hanya jika ingin mengganti password
                            </small>
                        </div>
                        <div class="form-group">
                            <label>Hak Akses</label>
                            <select name="id_level" class="form-control" required>
                                <option value="" disabled>Pilih Hak Akses</option>
                                <?php foreach ($level as $l): ?>
                                    <option value="<?= $l->id_level ?>"
                                        <?= ($l->id_level == $u->id_level) ? 'selected' : '' ?>>
                                        <?= $l->nama_level ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-modern btn-sm">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="<?= site_url('c_transaksi/index_user'); ?>" class="btn btn-secondary btn-sm">
                            Batal
                        </a>
                    </div>
                </form>
              </div>
          </div>
      </div>
</section>
