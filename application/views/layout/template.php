<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once('_meta.php'); ?>
  <title>Sample Monitoring</title>
  <?php require_once('_css.php'); ?>
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background-color: #f5f6fa;
      padding-right: 0 !important;
    }

  body.modal-open {
  padding-right: 0 !important;
  }

    .content-wrapper {
      background-color: #f5f6fa !important;
      padding: 0px;
      border-top-left-radius: 10px;
      min-height: 100vh;
    }

    .content {
      background-color: #fdfdfd;
      border-radius: 10px;
      padding: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .main-sidebar {
      background-color: #f0f0f0 !important;
      border-top-right-radius: 30px;
    }

    .sidebar {
      padding-top: 5px;
    }

  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse sidebar-closed">
  <div class="wrapper">

    <?php require_once('_navbar.php'); ?>
    <?php require_once('_sidebar.php'); ?>

    <div class="content-wrapper">
      <section class="content">
        <?php echo $contents; ?>
      </section>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
      <!-- Optional: Control sidebar content -->
    </aside>
  </div>
  <?php require_once('_js.php'); ?>
 
</body>
</html>
