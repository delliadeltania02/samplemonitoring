<!DOCTYPE html>
<html lang="en">
    <head>
    <?php require_once(__DIR__ . '/../../layout/_meta.php'); ?>


    <title>Handling Sample</title>
    <?php require_once(__DIR__ . '/../../layout/_css.php'); ?>
    
    </head>
    <body class="hold-transition" style="background-color:#f7f7f7 ;">
        <div class="container-fluid">
            <div class="row" style="padding-top: 7%;">
            <h1>QR Code Scanner</h1>
                <!-- Container for the QR Code Scanner -->
            <div id="qr-reader" style="width: 500px;"></div>
            <div id="qr-result"></div>
            </div>
        </div>
        <?php require_once(__DIR__ . '/../../layout/_js.php'); ?>
    </body>
</html>
