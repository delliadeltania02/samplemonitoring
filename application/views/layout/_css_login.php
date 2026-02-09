<!-- Favicon -->
<link href="<?php echo base_url('assets-fe');?>/img/kaha.ico" rel="icon" size="48x48">

<!-- Google Font: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<!-- Bootstrap & Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url('assets');?>/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets');?>/plugins/fontawesome-free/css/all.min.css">

<!-- Optional: Custom Component or Login-Specific Style -->
<link rel="stylesheet" href="<?php echo base_url('assets');?>/dist/css/component.css">

<!-- Custom Login Style -->
<style>
    body {
        font-family: "Poppins", sans-serif;
        background-color: #f7f7f7;
    }

    .login-section {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    .login-box {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        max-width: 900px;
        width: 100%;
    }

    .login-info {
        background: #36454F;
        color: #fff;
        padding: 50px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    .login-form {
        padding: 50px;
        flex: 1;
    }

    .login-form .form-control {
        border-radius: 30px;
    }

    .login-form .btn {
        border-radius: 30px;
    }

    .alert {
        margin-top: 10px;
        color: #fff;
        background-color: #e74c3c;
        padding: 10px;
        border-radius: 5px;
    }
</style>
