<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(APPPATH.'views/layout/_meta.php'); ?>
    <title>Login Scan Barcode</title>
    <?php require_once(APPPATH.'views/layout/_css.php'); ?>
</head>
<body class="hold-transition" style="background-color: #f7f7f7;">

<div class="col-md-12" style="padding-top:8%;">
    <div class="login-logo">
        <a href=""><b>Login untuk Akses Hasil Scan</b></a>
    </div>
</div>

<div class="col-md-4"></div>
<div class="col-md-4">
    <center>
    <?php if ($this->session->flashdata('error')): ?>
        <div class='alert alert-danger'><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= site_url('auth/login_scan') ?>" method="post">
        <div class="card">
            <div class="card-body">
                <div class="login-logo">
                    <p style="font-size: 12px;">Silakan login untuk melanjutkan</p>
                </div>
                <br>
                <div class="form-group">
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn" style="background-color:#36454F; color:white;" name="login">Sign in</button>
            </div>
        </div>
    </form>
</div>
<div class="col-md-4"></div>

<script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>
</body>
</html>
