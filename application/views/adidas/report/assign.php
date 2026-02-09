<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        font-size: 14px;
        background-color: #f8f9fa;
    }

    .card {
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-radius: 10px;
        border: none;
    }

    .card-header {
        background-color: #36454F !important;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    h4 {
        font-weight: 600;
        color: #36454F;
        margin-top: 10px;
    }

    h4 hr {
        border-top: 2px solid #ccc;
        margin-top: 5px;
    }

    label {
        font-weight: 500;
        color: #444;
        margin-bottom: 5px;
    }

    input.form-control,
    select.form-control {
        border-radius: 6px;
        border: 1px solid #ccc;
        transition: border-color 0.3s, box-shadow 0.3s;
        box-shadow: none;
    }

    input.form-control:focus,
    select.form-control:focus {
        border-color: #36454F;
        box-shadow: 0 0 0 0.1rem rgba(54, 69, 79, 0.25);
    }

    .btn {
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .breadcrumb {
        background-color: transparent;
        font-size: 13px;
        padding: 0;
        margin-bottom: 10px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control[readonly] {
        background-color: #e9ecef;
        color: #495057;
    }

    .containerColor .form-control,
    .containerOf .form-control {
        margin-bottom: 10px;
    }

    .btn-tambah, .btn-hapus-of {
        background-color: #6c757d !important;
        color: white;
    }

    .btn-tambah:hover, .btn-hapus-of:hover {
        background-color: #5a6268 !important;
    }

    .input-group label {
        font-weight: 500;
        margin-right: 10px;
        margin-top: 5px;
    }

    .custom-file input[type="file"] {
        padding: 5px;
        font-size: 13px;
    }

    .pl-pr-1 {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .card-footer {
        background-color: #f1f1f1;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
          <li class="breadcrumb-item active">Assign Report</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" id="content" data-url="<?= base_url('c_transaksi')?>" >
    <div class="container-fluid">
            <form id="myForm"  action = "<?php echo site_url('c_transaksi/assign_aksi'); ?>" method="post" > 
              <div class="card-body">
                <div class="col-md-12">
                  <span style="font-size: 11px; font-weight: bold;">Assign Report</span><hr>                   
                </div>
                 <div class="col-md-4">
                  <div class="form-group">
                    <label>Report No</label>
                    <input type="text" class="form-control" name="test_pending" value="<?=$hasil->report_no?>" readonly>
                  </div>
                </div>
                 <div class="col-md-4">
                  <div class="form-group">
                    <label>Item No</label>
                    <input type="text" class="form-control" name="personil" value="<?=$hasil->item_no?>" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Order Number/LCO</label>
                    <input type="text" class="form-control" name="personil" value="<?=$hasil->order_number?>" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Date Received</label>
                      <input type="text" class="form-control" name="date_received" value="<?= $hasil->datetime_received?>" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Date Final of Test</label>
                    <input type="date" class="form-control" name="date_final" value="<?=$hasil->date_final?>" readonly>
                  </div>
                </div>
                 <div class="col-md-4">
                  <div class="form-group">
                    <label>Total Test</label>
                    <input type="text" class="form-control" name="personil" value="<?=$hasil->selesai?>" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Test Result</label>
                        <input type="text" class="form-control" name="personil" value="<?=$hasil->hasil_akhir?>" readonly>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Upload Signature</label>
                        <div class="custom-file">
                            <input type="file" name="image_path" accept="image/*" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Posisi</label>
                        <input type="text" class="form-control" name="posisi" required>
                    </div>
                </div>
               
              </div>
              <div class="card-footer  d-flex justify-content-between">
                  <div class="col-md-2">
                          <a href="<?=site_url('c_transaksi/index_reportAll')?>" type="button" class="btn btn-block" style="background-color: #36454F;color: white;" >Back</a> 
                  </div>
                    <div class="col-md-4">
                        
                    </div>
                    
                       <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-block" style="background-color:#36454F;color:white;" data-toggle="modal" data-target="#confirmModal">
                            Submit
                        </button>
                    </div>
                        
              </div>
            </form>
        <!-- Modal Konfirmasi -->
            <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    Apa Anda yakin ingin menyimpan data? <br>
                    <strong>Data yang sudah disimpan tidak bisa diubah.</strong>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <!-- Tombol submit asli -->
                    <button type="button" class="btn btn-dark" id="confirmSave">Ya, Simpan</button>
                </div>
                </div>
            </div>
            </div>

    </div>
</section>