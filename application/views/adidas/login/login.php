<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(APPPATH . 'views/layout/_meta.php'); ?>
    <title>Sample Monitoring - Login</title>
    <?php require_once(APPPATH . 'views/layout/_css_login.php'); ?>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: "Poppins", sans-serif;
        }

        .split-container {
            display: flex;
            height: 100vh;
        }

      .left-panel {
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        .left-panel img.logo-top-left {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

       .logo-top-right {
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
            width: 260px;
        }   

       .right-panel {
            flex: 1;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative; /* Agar logo bisa diposisikan di dalam panel ini */
        }


        .login-content {
            width: 100%;
            max-width: 450px;
        }

        .login-content img {
            width: 80px;
            display: block;
            margin: 0 auto 20px auto;
        }

        .login-content h1 {
            font-size: 26px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .login-content p {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 30px;
        }

        .btn {
            border-radius: 30px;
        }

        .alert {
            margin-bottom: 20px;
            color: #fff;
            background-color: #e74c3c;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="split-container">
    <!-- Panel Kiri Kosong Saja -->
    <div class="left-panel">
        <img src="<?php echo base_url('assets-fe/img/foto_lab.png'); ?>" class="logo-top-left" alt="Logo">
    </div>

    <!-- Panel Kanan: Semua Tulisan & Login -->
    <div class="right-panel">
         <!-- Logo di pojok kanan atas -->
    <img src="<?php echo base_url('assets-fe/img/kh-logo.png'); ?>" class="logo-top-right" alt="Logo">
    <div class="login-content" style="padding-top: 25px;">
        <div class="header-text mb-5"><br>
            <h1 class="text-center">Welcome to Sample Monitoring</h1>
            <p class="text-center text-muted">Silahkan login untuk melanjutkan ke sistem</p>
        </div>

        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal"): ?>
            <div class="alert">Username dan password tidak sesuai!</div>
        <?php endif; ?>

        <?php echo form_open('auth/login'); ?>

        <div class="form-group mb-4"><br>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>

        <div class="form-group mb-4">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <div class="form-group d-flex justify-content-between align-items-center mb-4" hidden>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe" checked>
                <label class="form-check-label" for="rememberMe">Remember Me</label>
            </div>
            <a href="#">Forgot Password?</a>
        </div>

        <div class="form-group"><center><br>
            <button type="submit" name="login" value="login" class="btn btn-primary w-100">Sign In</button>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>

</div>

<script src="<?php echo base_url('assets');?>/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets');?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
