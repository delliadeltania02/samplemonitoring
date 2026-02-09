<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(APPPATH.'views/layout/_meta.php'); ?>
    <title>Login Scan Barcode</title>
    <?php require_once(APPPATH.'views/layout/_css.php'); ?>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
        }

        .login-image {
            flex: 1;
            background: url('<?= base_url("images/3nd.avif") ?>') no-repeat center center;
            background-size: cover;
            display: none;
        }

        .login-form-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
        }

        .card {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: none;
        }

        .card-body {
            padding: 2rem;
        }

        .card-footer {
            background-color: transparent;
            border-top: none;
            padding: 1rem 2rem 2rem;
            text-align: right;
        }

        .login-title {
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 1.5rem;
            color: #212529;
            text-align: center;
        }

        .form-control {
            border-radius: 10px;
        }

        .input-group-text {
            border-radius: 0 10px 10px 0;
        }

        .btn-login {
            background-color: #36454F;
            color: white;
            border-radius: 10px;
            padding: 0.6rem 2rem;
            font-weight: 600;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #2b3a43;
        }

        @media (min-width: 768px) {
            .login-image {
                display: block;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-image"></div>

    <div class="login-form-wrapper">
        <div class="login-box">
            <div class="text-center mb-4">
                <h4 class="login-title">Login untuk Akses Hasil Scan</h4>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class='alert alert-danger'><?= $this->session->flashdata('error') ?></div>
                <?php endif; ?>
            </div>
            <form action="<?= site_url('auth/login_scan') ?>" method="post">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Username" name="username" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-login" name="login">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>
</body>
</html>
