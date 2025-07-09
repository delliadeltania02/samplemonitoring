<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- TEMPAT META -->
    <?php require_once('_meta.php'); ?>
    <title>Handling Sample</title>
  <!-- TEMPAT CSS -->
  <?php require_once('_css.php');?>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php require_once('_navbar.php'); ?>
        <?php require_once('_sidebar.php'); ?>
      <div class="content-wrapper">
        <section class="content">
            <?php echo $contents ;?>
        </section>
      </div>
      <aside class="control-sidebar control-sidebar-dark">
      </aside>
    </div>
      <?php require_once('_js.php');?>
  </body>
</html>


