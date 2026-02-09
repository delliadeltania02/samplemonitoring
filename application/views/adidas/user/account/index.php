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
          <li class="breadcrumb-item active">Account</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" id="content" data-url="<?= base_url('c_transaksi') ?>">
  <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col">
              <h5 class="mb-0" style="font-weight: 600; color: #2c3e50;">📦 List of Account</h5>
            </div>
            <div class="col-auto">
               <a href="<?= site_url('c_transaksi/tambah_user') ?>" class="btn btn-modern btn-sm">
                <i class="fa fa-plus"></i>&nbsp; Add New Account
                </a> 
            </div>
        </div>
      
          <div class="card p-3">
              <div >
               <table id="example1" class="table table-bordered table-striped table-sm" style="width:100%">
                    <thead>
                <tr>
                  <td>No</td>
                  <td>Nama Lengkap</td>
                  <td>Username</td>
                  <td>Hak Akses</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody id="myTable">
                <?php 
                  $no = 1;
                 foreach ($user as $u) { ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $u->nama?></td>
                    <td><?= $u->username?></td>
                    <td><?= $u->nama_level?></td>
                    <td>
                        <a href="<?=site_url('c_transaksi/edit_user/').$u->id_user?>" class="btn btn-outline-info button2"><i class="fa fa-edit"></i></a>
                        <a href="<?=site_url('c_transaksi/hapus/').$u->id_user?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?php echo $u->username?>?');" class="btn btn-outline-danger remove"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
                </table>
              </div>
          </div>
      </div>
      <div id="ModalEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h5>Edit User</h5>
            </div>
            <div class="modal-body">
          
              <input type="text" class="form-control" name="id_user" id="id_user" hidden>
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="NAMA LENGKAP" required>
                <input type="text" value="1" name="user_status" hidden>
              </div>  
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="USERNAME" required>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="PASSWORD" required>
              </div> 
              <div class="form-group">
                <label>Hak Akses</label>
                <select name="edithak" id="idhak" class="form-control">
                  <option value="" selected hidden>HAK AKSES</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-sm btn-primary" type="submit">Edit</button>
              <a class="btn btn-sm btn-secondary" href="<?php echo base_url();?>index.php/page/user">Batal</a>
        
            </div>
          </div>

        </div>
      </div>
</section>
<script>
    function setinput(id_user,nama, username, password, id_level, user_status) {

    $('#id_user').val(id_user);
    $('#nama').val(nama);
    $('#username').val(username);
    $('#password').val(password);
    $('#user_status').val(user_status);
    $('id_level').val(id_level);  
    }
</script>