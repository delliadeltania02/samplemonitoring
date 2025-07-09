 <!-- Vendor JS Files -->
 <script src="<?php echo base_url('assets-fe');?>/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?php echo base_url('assets-fe');?>/vendor/aos/aos.js"></script>
  <script src="<?php echo base_url('assets-fe');?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url('assets-fe');?>/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?php echo base_url('assets-fe');?>/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url('assets-fe');?>/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?php echo base_url('assets-fe');?>/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url('assets-fe');?>/js/main.js"></script>

  <script src="<?php echo base_url('msdropdown');?>/dist/js/dd.min.js?ver=4.0"></script>

  <!---ASSET1-->
  <!-- jQuery -->
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

<script src="<?php echo base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-autofill/js/dataTables.autoFill.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-select/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-select/js/select.bootstrap4.min.js"></script>

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
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

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
    }
    });
	});



	$(function () {
    $("#example2").DataTable({
      "responsive": true,
      "autoWidth": true,
      "ordering": false,
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
<script>
    // Fungsi untuk memperbarui Test Matrix berdasarkan pilihan Method Group
    function updateTestMatrixDropdown(methodGroupId) {
    $.ajax({
        url: "<?php echo site_url('c_transaksi/get_test_matrices_by_method_group/'); ?>" + methodGroupId,
        method: "GET",
        success: function(data) {
            $('#id_testmatrix').html(data); // Update dropdown dengan hasil dari server
        },
        error: function() {
            alert('Terjadi kesalahan saat memuat data Test Matrix.');
        }
    });
}
<script>
        $(document).ready(function(){
          $('tfoot').hide()

          $(document).keypress(function(event){
              if (event.which == '13') {
                  event.preventDefault();
              }
          })

          $('#item_no').on('change', function(){

            if($(this).val() == '') reset()
            else {
              $.ajax({
                url: "<?= site_url('c_transaksi/getMaterialFill')?>",
                type: 'POST',
                dataType: 'json',
                data: {item_no: $(this).val()},
                success: function(data){
                  $('input[name="code_of_fabric"]').val(data.code_of_fabric)
                  $('input[name="composition"]').val(data.deskripsi)
            
                }
              })
            }
          })

          function reset(){
            $('#item_no').val('')
            $('input[name="code_of_fabric"]').val('')
            $('input[name="composition"]').val('')
          }

        })

        $(document).ready(function(){
          $('#applicant').on('change', function(){
            if($(this).val() == '') reset()
            else{
              $.ajax({
                url: "<?= site_url('c_transaksi/getApplicantFill')?>",
                type: 'POST',
                dataType: 'json',
                data: {applicant: $(this).val()},
                success: function(data){
                  $('input[name="department"]').val(data.department)
                  $('input[name="email"]').val(data.email)
                  $('input[name="telephone"]').val(data.no_tlp)            
                }
              })
            }
          })
        })

        $(document).ready(function() {
        var max_fields = 10;
        var wrapper = $(".containerColor");
        var add_button = $(".btn-tambah");

          var x = 1;
          $(add_button).click(function(e) {
          e.preventDefault();
          if (x < max_fields) {
              x++;
              $(wrapper).append(' <div class="form-group containerColor">\
                                          <div class="col-md-12">\
                                          &nbsp;\
                                          </div>\
                                          <div class="col-md-3">\
                                              <input type="text" name="color[]" class="form-control" placeholder="(A)">\
                                          </div>\
                                          <div class="col-md-3">\
                                              <input type="text" name="color[]" class="form-control"  placeholder="(B)">\
                                          </div>\
                                          <div class="col-md-3">\
                                              <input type="text" name="color[]" class="form-control"  placeholder="(C)">\
                                          </div>\
                                          <div class="col-md-1">\
                                              <button type="button" class="btn btn-block btn-hapus" style="background:#b8b8b8;"><i class="fa fa-times"></i></button>\
                                          </div>\
                                      </div>'); //add input box
          } else {
              alert('You Reached the limits')
          }
        })

          $(".containerColor").on("click", ".btn-hapus", function(){
          $(this).parent().parent('.containerColor').remove();
          })
      });

      $(document).ready(function() {
        var max_fields = 10;
        var wrapper = $(".containerOf");
        var add_button = $(".btn-tambah-of");

          var x = 1;
          $(add_button).click(function(e) {
          e.preventDefault();
          if (x < max_fields) {
              x++;
              $(wrapper).append(' <div class="form-group containerOf">\
                                          <div class="col-md-12">\
                                          &nbsp;\
                                          </div>\
                                          <div class="col-md-3">\
                                              <input type="text" name="color_of[]" class="form-control" placeholder="(A)">\
                                          </div>\
                                          <div class="col-md-3">\
                                              <input type="text" name="color_of[]" class="form-control"  placeholder="(B)">\
                                          </div>\
                                          <div class="col-md-3">\
                                              <input type="text" name="color_of[]" class="form-control"  placeholder="(C)">\
                                          </div>\
                                          <div class="col-md-1">\
                                              <button type="button" class="btn btn-block btn-hapus-of" style="background:#b8b8b8;"><i class="fa fa-times"></i></button>\
                                          </div>\
                                      </div>'); //add input box
          } else {
              alert('You Reached the limits')
          }
        })

          $(".containerOf").on("click", ".btn-hapus-of", function(){
          $(this).parent().parent('.containerOf').remove();
          })
      });
	    </script>
      <script>
       function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 && charCode != 43 && charCode != 45 && charCode != 37
            && (charCode < 48 || charCode > 57 )){
              alert('Format yang anda masukan tidak sesuai!');
              return false;
            } 
          return true;
       }

         function isReportNo(evt)
          {
              var charCode = (evt.which) ? evt.which : evt.keyCode;
              if (charCode === 47){
                  alert('Format yang anda masukan tidak sesuai!');
                  return false;
                } 
              return true;
          }
    </script>
      <script>
        $(document).ready(function(){
			$('tfoot').hide()

			$(document).keypress(function(event){
		    	if (event.which == '13') {
		      		event.preventDefault();
			   	}
			})

			$('#id_testmatrix').on('change', function(){
				if($(this).val() == '') reset()
				else {
					$.ajax({
						url: "<?= site_url('c_transaksi/get_all_method') ?>",
						type: 'POST',
						dataType: 'json',
						data: {id_testmatrix: $(this).val()},
						success: function(data){
                            $('input[name="method_code"]').val(data.method_code)
                            $('input[name="title_row"]').val(data.method_name)
							              $('input[name="measurement_row"]').val(data.measurement)
                            //$('input[name="title_row"]').val(data.title)
                            $('input[name="value_from_row"]').val(data.value_from)
                            $('input[name="value_to_row"]').val(data.value_to)  
                            $('select#result_type').prop('disabled', false)
							              $('button#tambah').prop('disabled', false)
                            $('input[name="status"]').html('<strong>' + sum_method() + '</strong>');
						}
					})
				}
			})
        })

        
        $('#result_type').on('change', function(){
        if($(this).val() == 'number')$('#div_statement').hide(),
                                     $('#div_statement_status').hide(), 
                                     $('#div_value_from').show(),
                                      $('#div_value_to').show(),
                                      $('#div_result').show(),
                                      $('input[name="result_row"]').prop('readonly', false).val(0),
                                      $('#div_status').show()
                                      $('#div_passfail').hide().val(''),
                                      $('#div_passfail_1').hide().val(''),
                                      $('#div_status_passfail').hide().val(''),
                                      $('#div_comment').hide().val(''),
                                      $('input[name="comment"]').val(''),
                                      $('select[name="result_passfail_row"]').prop('readonly', true).val(''),
                                      $('select[name="result_passfail_row_1"]').prop('readonly', true).val(''),
                                      $('input[name="status_passfail"]').prop('readonly', true).val(''),
                                      $('textarea[name="statement"]').prop('readonly', true).val(''),
                                      $('select[name="status_statement"]').prop('readonly', true).val('') 

        });

        $('#result_type').on('change', function(){
        if($(this).val() == 'boolean')$('#div_statement').hide(),
                                      $('#div_statement_status').hide(),
                                      $('#div_passfail').show(),
                                      $('#div_passfail_1').show(),
                                      $('#div_status_passfail').show(),
                                      $('#div_comment').show(),
                                      $('#div_value_from').hide(),
                                      $('#div_value_to').hide(),
                                      $('#div_result').hide(),
                                      $('#div_status').hide(),
                                      $('select[name="result_passfail_row"]').prop('readonly', false),
                                      $('select[name="result_passfail_row_1"]').prop('readonly', false),
                                      $('input[name="result_row"]').prop('readonly', true).val(''),
                                      $('input[name="status"]').prop('readonly', true).val(''),
                                      $('textarea[name="statement"]').prop('readonly', true).val('') 
                                      $('select[name="status_statement"]').prop('readonly', true).val('')             
        });

        $('#result_type').on('change', function(){
        if($(this).val() == 'statement')$('#div_statement').show(),
                                        $('#div_statement_status').show(),
                                        $('#div_passfail').hide(),
                                        $('#div_passfail_1').hide(),
                                         $('#div_status_passfail').show(),
                                        $('#div_comment').hide(),
                                        $('#div_value_from').hide(),
                                        $('#div_value_to').hide(),
                                        $('#div_result').hide(),
                                        $('#div_status').hide(),
                                        $('textarea[name="statement"]').prop('readonly', false),
                                        $('select[name="result_passfail_row"]').prop('readonly', false),
                                        $('select[name="result_passfail_row_1"]').prop('readonly', false),
                                        $('input[name="result_row"]').prop('readonly', true).val(''),
                                        $('input[name="status"]').prop('readonly', true).val('')                   
        });

        $('#id_testmatrix').on('change', function(){
            $('select[name="result_passfail_row"]').prop('readonly', true),
            $('input[name="result_row"]').prop('readonly', true).val(''),
            $('input[name="status"]').prop('readonly', true).val(''),
            $('select[name="result_passfail_row"]').prop('readonly',true).val(''),
            $('input[name="status_passfail"]').prop('readonly', true).val(''),
            $('#div_passfail').hide(),
            $('#div_status_passfail').hide(),
            $('#div_value_from').hide(),
            $('#div_value_to').hide(),
            $('#div_result').hide(),
            $('#div_status').hide(),
            $('#result_type').prop('disable', false)
        });

        $(document).on('click', '#tambah', function(e){   
				//const url_keranjang_barang = $('#content').data('url') + '/keranjang_barang'
				const data_method = {
                    id_order : $('input[name="id_order"]').val(),
                    report_no : $('input[name="report_no"]').val(),
                    id_testmatrix: $('select[name="id_testmatrix"]').val(),
                    method_code: $('input[name="method_code"]').val(),
                    measurement: $('input[name="measurement_row"]').val(),
                    title: $('input[name="title_row"]').val(),
                    result: $('input[name="result_row"]').val(),
                    before_wash: $('input[name="before_wash_row"]').val(),
                    wash1: $('input[name="wash1_row"]').val(),
                    status: $('input[name="status"]').val(),
                    result_passfail: $('select[name="result_passfail_row"]').val(),
                    result_passfail1: $('select[name="result_passfail_row_1"]').val(),
                    status_passfail: $('input[name="status_passfail"]').val(),
                    statement: $('textarea[name="statement"]').val(),
                    comment: $('input[name="comment"]').val()
				}
                    
                        $.ajax({
                            url: "<?=site_url('c_transaksi/keranjang_method') ?>",
                            type: 'POST',
                            data: data_method,
                            success: function(data){
                                //if($('select[name="id_testmatrix"]').val() == data_method.id_testmatrix) $('option[value="' + data_method.id_testmatrix + '"]').hide()
                                reset()

                                $('table#keranjang_method tbody').append(data)
                                $('tfoot').show()


                                $('#result_status tfoot').html('<strong>' + hitung_status() + '</strong>')
                                $('input[name="result_status"]').val(hitung_status())
                                $('input[name="result_status"]').html('<strong>' + hitung_status() + '</strong>');
                            
                            },
                            error:function(){
                            alert('error');
                            }
                        })
			})

                    $(document).on('click', '#hapus_method', function() {
                          // Remove the row containing the clicked delete button
                          $(this).closest('.row-keranjang-method').remove();

                          // Check if tbody is empty and hide tfoot if there are no rows left
                          if ($('tbody').children().length === 0) {
                              $('tfoot').hide();  // Hide the entire tfoot section
                          }

                          // Show the option in the select dropdown if it was previously hidden
                          $('option[value="' + $(this).data('method_name') + '"]').show();
                      });
                                            
                        $('#simpanshrinkage').on('click', function(){
              
                        var currentRow =  $(this).closest("tr");

                        const data_shrinkage = {
                            report_no : currentRow.find("td:eq(0)").text(),
                            id_testmatrix :currentRow.find("td:eq(1)").text,
                            result :currentRow.find("td:eq(4)").text(),
                            status :currentRow.find("td:eq(5)").text(),
                            comment :currentRow.find("td.eq(6)").text()
                        }

                        $.ajax({
                            type: 'POST',
                            url: "<=site_url('c_transaksi/tambahaksi_method') ?>",
                            data:data_shrinkage,
                            success: function(data){
                                console.log("berhasil");

                                window.history.back();
                            }
                        })
                    })

            function status_boolean(){
                var status1 = document.querySelector("#result_passfail").value;
                var status2 = document.querySelector("#result_passfail1").value;

                if (status1 !== "Rejected" && status2 !== "Rejected"){
                    document.querySelector("#status_passfail").value = 'pass';
                } else {
                    document.querySelector("#status_passfail").value = 'fail';
                }
            }

           

         

        function reset()
        {
            $('select[name="id_testmatrix"]').val('Pilih Method'),
            $('input[name="measurement_row"]').val(''),
            $('input[name="value_from_row"]').val(''),
            $('input[name="value_to_row"]').val(''),
            $('input[name="result_row"]').prop('readonly', true).val(''),
            $('input[name="title_row"]').prop('readonly', true).val(''),
            $('select[name="result_type"]').prop('readonly', true).val(''),
            $('select[name="result_passfail_row"]').prop('readonly', true).val(''),
            $('input[name="status_passfail"]').prop('readonly', true).val(''),
            $('#div_value_from').hide(),
            $('#div_value_to').hide(),
            $('#div_result').hide(),
            $('#div_status').hide(),
            $('#div_passfail').hide().val(''),
            $('#div_passfail_1').hide().val(''),
            $('#div_status_passfail').hide().val(''),
            $('#div_statement').hide(),
            $('#div_statement_status').hide(),
            $('input[name="status"]').val(''),
            $('#div_comment').hide().val(''),
            $('#result_type').prop('disable', true).val(''),
            $('textarea[name="statement"]').prop('readonly', true).val(''), 
            $('select[name="status_statement"]').prop('readonly', false).val('')
          
        }
        </script>
         <script>
            function sum_method()
            {
                var result = document.getElementById('result').value;
                var value_from = document.getElementById('value_from').value;
                var value_to = document.getElementById('value_to').value;

                console.log('result:', result, 'value_from:', value_from, 'value_to:', value_to );
                
                var result1 = parseFloat(value_from) <= parseFloat(result);
                var result2 = parseFloat(value_to) >= parseFloat(result);
                var result3 = parseFloat(value_to) <= parseFloat(result);
                var result4 = parseFloat(value_from) > parseFloat(result);
                var result5 = parseFloat(value_to) < parseFloat(result);
                            
                if (result1 == true && result2 == true){
                   document.getElementById('status').value = "pass";
                }else if(result1 == true && result3 == false){ 
                    document.getElementById('status').value = "pass";
                }else if(result4 == true && result2 == true){
                    document.getElementById('status').value = "fail";
                }else if(result5 == true){
                    document.getElementById('status').value = "pass";
                }else{
                    document.getElementById('status').value = "fail";
                }
            }
        </script>

        <script>
          document.addEventListener("DOMContentLoaded", function() {
            document.querySelector("#status_statement").addEventListener("change", status_statement);
          });

          function status_statement() {
            var status = document.querySelector("#status_statement").value;

            if (status !== "Rejected") {
              document.querySelector("#status_passfail").value = 'pass';
            } else {
              document.querySelector("#status_passfail").value = 'fail';
            }
          }
        </script>
              
        <script>
            function hitung_status()
            {
                let table = document.getElementById("keranjang_method");
                let status_td = table.querySelectorAll("td.status");
                let result_td = table.querySelector("td.result_status");
                let p_counter = 0
                let f_counter = 0
                let pass = 'pass';
                let fail = 'fail';

                for (let i = 0; i < status_td.length; i++) {
                v = status_td[i].innerText
                if(v === 'pass')
                { p_counter += 1}
                else {f_counter += 1}
                }

                 if(f_counter > 0) {
                    console.log(fail)
                    text = "fail";
                    document.getElementById('result_status').value = "fail";
                    document.querySelector('input[name="result_status"]').value="fail";
                 }else { 
                    console.log(pass)
                    text = "pass";
                    document.getElementById('result_status').value = "pass";
                    document.querySelector('input[name="result_status"]').value = "pass";
                 }
                
                 document.getElementById("result_status").innerHTML = text;
             
                //document.getElementsByName("result_status_hidden").innerHTML = text;
                //document.querySelector('input[name="result_status"]').innerHTML = text;   
                console.log(p_counter)
                console.log(f_counter)
            }
        </script>

          <script>
            $(document).ready(function() {
                // Event handler untuk setiap link di daftar tes
                $('.test-link').on('click', function(e) {
                    e.preventDefault(); // Mencegah link dari reload halaman

                    // Ambil data dari atribut link yang diklik
                    var idKualitas = $(this).data('id');
                    var testRequired = $(this).data('test');

                    // Perbarui nilai input dengan data yang diambil
                    $('#id_reportmethod').val(idKualitas);
                    $('#test_required').val(testRequired);
                });
            });
        </script>
      <!-- Validasi Ekstensi File -->
<script>
    function validasiEkstensi1() {
        var fileInput = document.getElementById('simbol_care');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload a file with one of the following extensions: .jpg, .jpeg, .png, .gif');
            fileInput.value = ''; // Clear the input field
            return false;
        }
        return true;
    }
</script>

<script>
    // Fungsi untuk memperbarui Test Matrix berdasarkan pilihan Method Group
    function updateTestMatrixDropdown(methodGroupId) {
    $.ajax({
        url: "<?php echo site_url('c_transaksi/get_test_matrices_by_method_group/'); ?>" + methodGroupId,
        method: "GET",
        success: function(data) {
            $('#id_testmatrix').html(data); // Update dropdown dengan hasil dari server
        },
        error: function() {
            alert('Terjadi kesalahan saat memuat data Test Matrix.');
        }
    });
}

</script>
       

