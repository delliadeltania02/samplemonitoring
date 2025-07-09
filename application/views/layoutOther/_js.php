<!-- jQuery -->
<script src="<?php echo base_url('assets');?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets');?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets');?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('assets');?>/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets');?>/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url('assets');?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url('assets');?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets');?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets');?>/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url('assets');?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets');?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url('assets');?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets');?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets');?>/dist/js/adminlte.js"></script>
<script src="<?php echo base_url('assets');?>/dist/js/underscore-min.js"></script>

<!-- Icon -->
<script src="<?php echo base_url('assets');?>/dist/js/all.min.js"></script>


 <!-- DataTables -->
 <script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>


<!--script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script-->



<!-----FORM DINAMIS------>
<script src="<?php echo base_url('assets');?>/dist/js/cbpHorizontalMenu.min.js"></script>
<script src="<?php echo base_url('assets');?>/dist/js/cbpHorizontalMenu.js"></script>
<script src="<?php echo base_url('assets');?>/dist/js/modernizr.custom.js"></script>


<script src="<?php echo base_url('assets');?>/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets');?>/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url('assets');?>/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url('assets');?>/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url('assets');?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url('assets');?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url('assets');?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets');?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo base_url('assets');?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="<?php echo base_url('assets');?>/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="<?php echo base_url('assets');?>/plugins/dropzone/min/dropzone.min.js"></script>
 <!-- #region -->

<script>
    $("#id_testmethod").select2();
    function editMethod(){
      $("#id_testmethod").val().change();
    }

    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
      
    })

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  });

  $(function (){
    $("#example").DataTable({
      "responsive": true,
      "autoWidth": false,
      select: {
        style: 'multi'
      },
      responsive: {
        details: false
      },
      scrollX: true
    });
  });

  $(document).ready( function() {
    $( '#exampleMethod' ).dataTable( {
    "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
      // Bold the grade for all 'A' grade browsers
      if ( aData[4] == "A" )
      {
        $('td:eq(4)', nRow).html( '<b>A</b>' );
      }
    }
  } );
 } );

  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,

    });
  });

  $(function () {
    $("#example2").DataTable({
      "responsive": true,
      "autoWidth": false,
      
    });
  });

  $(function () {
    $("#example3").DataTable({
      "responsive": true,
      "autoWidth": false,
     
    });
  });

  $(function () {
    $("#example4").DataTable({
      "responsive": true,
      "autoWidth": false,
     
    });
  });

  $(function () {
    $("#example5").DataTable({
      "responsive": true,
      "autoWidth": true,
      "ordering": false
    });
  });

  
</script>

