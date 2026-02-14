<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                <li class="breadcrumb-item active">Add Care Instruction</li>
                </ol>
          </div>
        </div>
      </div>
</div>
<section class="content" id="content "data-url="<?= base_url('c_transaksi') ?>">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-10" style="padding-bottom: 1%;">
            
            </div>
            <div class="col-md-2" style="padding-bottom: 1%;">
              
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #36454F;" >
                        <h3 class="card-title"></h3>
                    </div>
                    <form action="<?php echo site_url('c_transaksi/tambahaksi_care'); ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <!-- CSRF Token -->
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <!-- Category Dropdown -->
                            <div class="form-group">
                                <label>Category</label>
                                <select name="kategori_care" id="kategori_care" class="form-control" required>
                                    <option selected disabled>Select</option>
                                    <option value="Washing Process">Washing Process</option>
                                    <option value="Bleching Process">Bleching Process</option>
                                    <option value="Tumble Drying Process">Tumble Drying Process</option>
                                    <option value="Ironing Process">Ironing Process</option>
                                    <option value="Professional Textile Care Process">Professional Textile Care Process</option>
                                </select>
                            </div> 
                            <!-- File Upload -->
                            <div class="form-group">
                                <label>Care Instruction</label>
                                <div class="custom-file">
                                    <input type="file" id="simbol_care" name="simbol_care" onchange="return validasiEkstensi1()" required>
                                </div>
                            </div>
                            <!-- Description Field -->
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" class="form-control" name="deskripsi" id="deskripsi" required></textarea>
                            </div> 
                            <!-- Error and Success Message -->
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <a href="<?= site_url('c_transaksi/index_careInstruction') ?>" class="btn btn-secondary"> Back </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-primary"> Submit </button>
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
            </div>
		</div>
	</div>
</section>


