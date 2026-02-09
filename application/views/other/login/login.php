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
            background-color: #f7f7f7;
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
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
        }

        .login-content {
            width: 100%;
            max-width: 450px;
        }

        .login-content h1 {
            font-size: 26px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
            color: #333;
        }

        .login-content p {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 30px;
            border: 1px solid #ccc;
            height: 45px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.5);
            outline: none;
        }

        .btn {
        border-radius: 30px;
        padding: 12px;
        font-weight: bold;
        border: none;
        cursor: pointer;
        background-color: #36454F; /* Warna seragam */
        color: white;
        transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #2c3e50; /* Sedikit gelap saat hover */
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
    <!-- Panel Kiri: Gambar -->
    <div class="left-panel">
        <img src="<?php echo base_url('assets-fe/img/3nd.avif'); ?>" class="logo-top-left" alt="Logo">
    </div>

    <!-- Panel Kanan: Login -->
    <div class="right-panel">
        <img src="<?php echo base_url('assets-fe/img/kh-logo.png'); ?>" class="logo-top-right" alt="Logo">
        <div class="login-content" style="padding-top: 25px;">
            <h1>Welcome to Sample Monitoring</h1>
            <p>Silahkan login untuk melanjutkan ke sistem (Other Buyer)</p>

            <?php if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal"): ?>
                <div class="alert">Username dan password tidak sesuai!</div>
            <?php endif; ?>

            <?php echo form_open('auth/login_other'); ?>
            <div class="form-group mb-4">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group mb-4">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="form-group text-center">
                <button type="submit" name="login" value="login" class="btn" style="width: 50%; background-color: #36454F; color: white;">Sign In</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets');?>/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets');?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
