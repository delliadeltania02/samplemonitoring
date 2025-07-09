<style>
.dataTables_filter{
display:block;
float:right;
}
 </style>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>User Management</b></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>


<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action = "<?php echo site_url('c_transaksi/tambah'); ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" placeholder="NAMA LENGKAP" required>
                    <input type="text" value="1" name="user_status" hidden>
                  </div>  
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="USERNAME" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="PASSWORD" required>
                  </div> 
                  <div class="form-group">
                    <label>Hak Akses</label>
                    <select name="id_level" class="form-control">
                    	<option value="" selected hidden>HAK AKSES</option>
                      <?php foreach ($level as $u): ?>
                       <option value="<?= $u->id_level?>"><?= $u->nama_level ?></option>
                       <?php endforeach ?>
                    </select>
                  </div>                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-outline-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
			</div>
			<div class="col-md-8">
			<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
<!-- -------------------------------------------------------------------------------------------- -->                
            <table id="example1" class="table table-bordered table-striped table-sm text-nowrap">
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
                        <a href="<?=site_url('#')?>" data-target="#editModal" data-toggle="modal" class="btn btn-outline-info button2" onclick="setinput('<?=$u->id_user?>','<?=$u->username?>')"><i class="fa fa-edit"></i></a>
                        <a href="<?=site_url('c_transaksi/hapus/').$u->id_user?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?php echo $u->username?>?');" class="btn btn-outline-danger remove"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
<!-- -------------------------------------------------------------------------------------------- -->              	
              </div>
              <!-- /.card-body -->
            </div>
        	</div>
		</div><!-- /.row -->
	  </div><!-- /.container-fluid --> 

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
</section>	


</div>
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