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
                    <form action="<?php echo site_url('c_transaksi/editaksi_care'); ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <!-- CSRF -->
                            <input type="hidden"
                                name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>">

                            <!-- ID CARE -->
                            <input type="hidden" name="id_care" value="<?= $care->id_care ?>">

                            <!-- CATEGORY -->
                            <div class="form-group">
                                <label>Category</label>
                                <select name="kategori_care" class="form-control" required>
                                    <option disabled>Select</option>
                                    <?php
                                    $kategori = [
                                        'Washing Process',
                                        'Bleching Process',
                                        'Tumble Drying Process',
                                        'Ironing Process',
                                        'Professional Textile Care Process'
                                    ];
                                    foreach ($kategori as $k):
                                    ?>
                                        <option value="<?= $k ?>" <?= ($care->kategori_care == $k) ? 'selected' : '' ?>>
                                            <?= $k ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                             <!-- CURRENT IMAGE -->
                            <div class="form-group">
                                <label>Current Care Symbol</label><br>
                                <img src="<?= base_url('images/care_instruction/' . $care->simbol_care) ?>"
                                     style="width:60px; border:1px solid #ccc; padding:4px;">
                            </div>
                            <!-- FILE UPLOAD (OPTIONAL) -->
                            <div class="form-group">
                                <label>Change Care Instruction (optional)</label>
                                <input type="file" name="simbol_care" id="simbol_care" onchange="return validasiEkstensi1()">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti simbol</small>
                            </div>
                             <!-- DESCRIPTION -->
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="deskripsi" required><?= $care->deskripsi ?></textarea>
                            </div>

                             <!-- FLASH MESSAGE -->
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?= $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>

                        </div>
                        <div class="card-footer">
                            <div class="col-md-1">
                                <a href="<?= site_url('c_transaksi/index_careInstruction') ?>" class="btn btn-secondary">
                                    Back
                                </a>
                            </div>
                            <div class="col-md-10"></div>
                            <div class="col-md-1">
                                <ol class="float-sm-right">
                                    <button type="submit" class="btn btn-primary">
                                     Update
                                    </button>
                                </ol>
                            </div>      
                        </div>
                    </form>
                  </div>
            </div>
		</div>
	</div>
</section>


