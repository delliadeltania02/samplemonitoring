<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once('/xampp/htdocs/handlingsample/application/views/layout/_meta.php');?>
        <title>Handling Sample</title>
        <?php
		    echo form_open('auth/login');
    	?>
        <?php require_once('/xampp/htdocs/handlingsample/application/views/layout/_css.php');?>
    </head>
    <body class="hold-transition" style="background-color: #f7f7f7 ;">

        <?php
         if(isset($_GET['pesan'])){
            if($_GET['pesan'] == "gagal"){
                echo "<div class='alert'>username dan password tidak sesuai!</div>";
            }
         }
        ?>

        <div class="col-md-12" style="padding-top:8%;">
            <div class="login-logo">
                <a href=""><b>Welcome To Handling Sample</b></a>
            </div>
        </div>
        
        <div class="col-md-4">

        </div>
        <div class="col-md-4"><center>
            <form action="" method="post">
                <div class="card">
                    <div class="card-body">
                        <div class="login-logo">
                            <a href=""><p style="font-size: 12px;">Sign in to start your session</p></a>
                        </div><br>
                        <div class="col-md-12 pl-pr-1">
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                                        <div class="input-group-append">
                                                <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                                </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 pl-pr-1">
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 pl-pr-1">
                            
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn" style="background-color:#36454F; color:white;" value="login" name="login">Sign in</button>
                    </div>
                </div>   
            </form>
        </div>
        <div class="col-md-4">

        </div>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
