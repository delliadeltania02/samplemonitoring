<!DOCTYPE html>
<html lang="en">
    <head>
    <?php require_once('layout/_meta.php'); ?>
    <title>Handling Sample</title>
    <?php require_once('layout/_css.php');?>
    </head>
    <body class="hold-transition" style="background-color:#f7f7f7 ;">
        <div class="col-md-12" style="padding-top:8%;">
            <div class="login-logo">
                <a href=""><b>Welcome To Handling Sample</b><p>Please select the menu below</p></a>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row" style="padding-top: 7%;">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="col-md-6">
                        <a href="<?= site_url('Welcome/login_adidas') ?>">
                            <div class="small-box" style="background-color:	#36454F;">
                                <div class="inner">
                                    <center><h2 style="color:white;">adidas</h2></center>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= site_url('Welcome/login_other') ?>">
                            <div class="small-box" style="background-color:	#36454F;">
                                <div class="inner">
                                    <center><h2 style="color:white;">non - adidas</h2></center>
                                </div>
                            </div>
                        </a>
                    </div>      
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    <?php require_once('layout/_js.php');?>
    </body>
</html>
