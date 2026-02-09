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
        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
                <li class="breadcrumb-item active">Test Method</li>
                </ol>
          </div>
        </div>
      </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                 <?php foreach($editmethod as $u){ ?>
                        <form action="<?php echo site_url('c_method/editaksi_testmethod'); ?>" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 pl-pr-1">
                                        <input type="hidden" name="id_testmethod" value="<?php echo $u->id_testmethod ?>">
                                        <div class="form-group">
                                            <label>Test Method ID</label>
                                            <input name="method_id"  class="form-control" value="<?php echo $u->method_id ?>" required>
                                        </div>
                                    </div>                          
                                    <div class="col-md-6 pl-pr-1">
                                        <div class="form-group">
                                            <label>Test Standard Name</label>
                                            <input name="method_name" class="form-control" value="<?php echo $u->method_name ?>" required>
                                        </div>
                                    </div>
                                        <div class="col-md-6 pl-pr-1">
                                            <div class="form-group">
                                                <label>Test Method Group</label>
                                                <select name="id_methodgroup" class="form-control" required>
                                                    <option value="" disabled>PILIH</option>

                                                    <?php foreach ($methodgroup as $m): ?>
                                                        <option 
                                                            value="<?= $m->id_methodgroup ?>"
                                                            <?= ($m->id_methodgroup == $u->id_methodgroup) ? 'selected' : '' ?>
                                                        >
                                                            <?= $m->id_methodgroup . '. ' . $m->method_group ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-6 pl-pr-1">
                                            <div class="form-group">
                                                <label>Model/Article Level</label>
                                                <select name="ma_testmethod" class="form-control" required>
                                                    <option selected disabled>PILIH</option>
                                                    <?php foreach ($level as $m): ?>
                                                        <option <?php echo ( $m->ma_testmethod == $u->ma_testmethod ) ? "selected": "" ?>><?php echo $m->ma_testmethod; ?></option>
                                                       
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 pl-pr-1">
                                            <div class="form-group">
                                                <label>Fashion/Casual</label>
                                                <textarea onkeypress="enterFashion();" id="fashion" name="fashion_casual" class="form-control" required><?php echo $u->fashion_casual ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3 pl-pr-1">
                                            <div class="form-group">
                                                <label>Hybrid/Performance</label>
                                                <textarea onkeypress="enterHybrid();" id="hybrid" name="hybrid_performance" class="form-control" required><?php echo $u->hybrid_performance ?></textarea>
                                            </div>
                                        </div>                                  
                                        <div class="col-md-12 pl-pr-1">
                                            <div class="form-group">
                                                <label>remakrs</label>
                                                <textarea onkeypress="enterRemarks();" id="txtremarks" name="remakrs" class="form-control" required><?php echo $u->remakrs ?></textarea>
                                            </div>
                                        </div>                                     
                                        <div class="col-md-6 pl-pr-1">
                                        </div>
                                        <div class="col-md-2 pl-pr-1">
                                        </div>
                                        <div class="col-md-2 pl-pr-1" hidden>
                                            <div class="form-group">
                                                <br>
                                                <a href="#" type="button" class="btn btn-block btn-info">Batal</a>
                                            </div>
                                        </div>
                                        <div class="col-md-2 pl-pr-1" hidden>
                                            <br>
                                                <div class="update ml-auto mr-auto">
                                                    <button type="submit" class="btn btn-block btn-info"></button>
                                                </div>
                                        </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="col-md-1">
                                        <a href="<?=site_url('c_method/index_testmethod')?>" type="button" class="btn btn-block" style="background-color: #36454F;color: white;">Back</a>
                                </div>
                                <div class="col-md-10">
                                    
                                </div>
                                <div class="col-md-1">
                                    <ol class="float-sm-right">
                                        <button type="submit" class="btn btn-block" value="Tambah" style="background-color: #36454F;color: white;">Submit</button>
                                    </ol>
                                </div>      
                            </div>
                        </form>
                    <?php } ?>
            </div>
		</div>
	</div>
</section>