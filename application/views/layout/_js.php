<!-- jQuery -->
<script src="<?php echo base_url('assets');?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets');?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets');?>/plugins/jquery-ui/jquery-ui.min.js"></script>

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
<!--script src="<php echo base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script-->
<script src="<?php echo base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-autofill/js/dataTables.autoFill.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-select/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-select/js/select.bootstrap4.min.js"></script>

<!-- Dynamic Form Scripts -->
<script src="<?php echo base_url('assets');?>/dist/js/cbpHorizontalMenu.min.js"></script>
<script src="<?php echo base_url('assets');?>/dist/js/cbpHorizontalMenu.js"></script>
<script src="<?php echo base_url('assets');?>/dist/js/modernizr.custom.js"></script>

<script src="<?php echo base_url('assets');?>/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets');?>/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url('assets');?>/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url('assets');?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url('assets');?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo base_url('assets');?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="<?php echo base_url('assets');?>/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="<?php echo base_url('assets');?>/plugins/dropzone/min/dropzone.min.js"></script>

<script src="<?php echo base_url('assets');?>/html5-qrcode-master/minified/html5-qrcode.min.js"></script>
<script>
  $('#modalPilihTest').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);

    const id_penerimaan = button.data('id_penerimaan');
    const id_kualitas   = button.data('id_kualitas');
    const report_no     = button.data('report_no');

    console.log('OPEN MODAL:', {
      id_penerimaan,
      id_kualitas,
      report_no
    });

    $('#id_penerimaan').val(id_penerimaan);
    $('#id_kualitas').val(id_kualitas);
    $('#report_no').val(report_no);

    $('#searchTest').val('');
    $('.dropdown-toggle').text('Pilih Test Required');

    loadTestRequired(id_penerimaan);
  });


function loadTestRequired(id_penerimaan) {
  $('#list-test-required').empty().html('<small>Loading...</small>');

  $.ajax({
    url: "<?= site_url('c_transaksi/get_test_required_dropdown') ?>",
    type: "POST",
    dataType: "json",
    data: { id_penerimaan },
    success: function (res) {
      console.log('RES:', res);
      let html = '';

      if (!res || res.length === 0) {
        html = '<small class="text-muted">Tidak ada test tersedia</small>';
      } else {
        res.forEach((item, i) => {
          html += `
            <div class="custom-control custom-checkbox test-item mb-1">
              <input
                type="checkbox"
                class="custom-control-input"
                name="test_required[]"
                value="${item.test_required}"
                id="test_${i}">
              <label class="custom-control-label" for="test_${i}">
                ${item.test_required}
              </label>
            </div>
          `;
        });
      }

      $('#list-test-required').html(html);
    },
    error: function (xhr) {
      console.error(xhr.responseText);
      $('#list-test-required').html(
        '<small class="text-danger">Gagal memuat data</small>'
      );
    }
  });
}

$(document).on('keyup', '#searchTest', function () {
  const keyword = $(this).val().toLowerCase();

  $('#list-test-required .test-item').each(function () {
    const text = $(this).text().toLowerCase();
    $(this).toggle(text.includes(keyword));
  });
});


$(document).on('change', 'input[name="test_required[]"]', function () {
  const total = $('input[name="test_required[]"]:checked').length;

  $('.dropdown-toggle').text(
    total ? total + ' test dipilih' : 'Pilih Test Required'
  );
});

$(document).on('click', '#btnSelectAll', function (e) {
  e.preventDefault();

  $('#list-test-required input[type="checkbox"]:visible')
    .prop('checked', true)
    .trigger('change');
});

$(document).on('click', '#btnClearAll', function (e) {
  e.preventDefault();

  $('#list-test-required input[type="checkbox"]')
    .prop('checked', false)
    .trigger('change');

  $('.dropdown-toggle').text('Pilih Test Required');
});

$(document).on('click', '.dropdown-menu', function (e) {
  e.stopPropagation();
});

function openDeleteModal(id) {
    const input = document.getElementById('id_handlingsample');
    if (!input) {
      console.error('Hidden input id_handlingsample tidak ditemukan');
      return;
    }

    input.value = id;

    $('#modalDeleteReport')
      .appendTo('body')
      .modal('show');
  }

function deleteReport() {
  const id = document.getElementById('id_handlingsample').value;

  if (!id) {
    alert('ID tidak ditemukan');
    return;
  }

  $.ajax({
    url: "<?= site_url('c_transaksi/deleteReportHandling'); ?>",
    type: "POST",
    dataType: "json",
    data: {
      id_handlingsample: id
    },
    success: function (res) {
      if (res.status) {
        $('#modalDeleteReport').modal('hide');

        // reload halaman / datatable
        location.reload();
      } else {
        alert(res.message);
      }
    },
    error: function (xhr) {
      console.error(xhr.responseText);
      alert('Terjadi kesalahan saat menghapus data');
    }
  });
}

  $(document).on('hidden.bs.modal', function () {
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '0');
  });
</script>


<script>
  function updateClock() {
    const clockEl = document.getElementById('clock');
    if (!clockEl) return; // ⬅️ PENTING

    const now = new Date();

    const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    const dayName = days[now.getDay()];
    const date = now.getDate();
    const monthName = months[now.getMonth()];
    const year = now.getFullYear();

    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');

    clockEl.textContent =
      `${dayName}, ${date} ${monthName} ${year} - ${hours}:${minutes}:${seconds}`;
  }

  setInterval(updateClock, 1000);
  updateClock();
</script>



<script>
  document.querySelectorAll('.has-submenu > a').forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const parent = this.parentElement;
      parent.classList.toggle('open');
    });
  });
</script>


<script>
$(function () {
  //BAR CHART TIMELIME
const ctxBar = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: <?= json_encode($penerimaan_bulan_labels) ?>,
        datasets: [{
            label: 'Jumlah Sample Diterima',
            data: <?= json_encode(array_map('intval', $penerimaan_bulan_values)) ?>,
            backgroundColor: [
                'rgba(40, 167, 69, 0.8)', // hijau
                'rgba(255, 193, 7, 0.8)', // kuning
                'rgba(220, 53, 69, 0.8)', // merah
                'rgba(0, 123, 255, 0.8)', // biru
            ],
            borderRadius: 10,
            barPercentage: 0.5,
            categoryPercentage:0.5 
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: '#343a40',
                titleColor: '#fff',
                bodyColor: '#fff',
                padding: 10
            },
            title: {
                display: true,
                text: 'Jumlah Sample Diterima per Bulan',
                color: '#28a745',
                font: {
                    size: 18,
                    weight: 'bold'
                }
            }
        },
   scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false,
              min: <?= min($penerimaan_bulan_values) ?> - 1,
              max: <?= max($penerimaan_bulan_values) ?> + 1,
              stepSize: 1,
              callback: function(value) {
                return parseInt(value); // ✅ menghilangkan .0
              }
            },
            gridLines: {
              color: '#e9ecef'
            }
          }],
          xAxes: [{
            ticks: {
              fontColor: '#6c757d'
            },
            gridLines: {
              display: false
            }
          }]
        }
    }
});

  // PIE CHART TIMELINE
  var ctx = $('#pieTimeline').get(0).getContext('2d');
  var labels = <?= json_encode($timeline_labels) ?>;
  var values = <?= json_encode($timeline_values) ?>;
  var total = values.reduce((a, b) => a + b, 0);

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        data: values,
        backgroundColor: [
          '#00a65a', // Hijau → Sesuai Timeline
          '#f56954', // Merah → Melebihi Timeline
          '#d2d6de'  // Abu-abu → Belum Selesai
        ]
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            var value = data.datasets[0].data[tooltipItem.index];
            var label = data.labels[tooltipItem.index];
            var percent = (value / total * 100).toFixed(1);
            return label + ': ' + value + ' (' + percent + '%)';
          }
        }
      }
    }
  });
});
</script>


<script>
  $(function () {
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
    var labels = <?= json_encode($labels) ?>;
    var values = <?= json_encode($values) ?>;

    var total = values.reduce((a, b) => a + b, 0);

    var pieData = {
      labels: labels,
      datasets: [{
        data: values,
        backgroundColor: [
          '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc',
          '#8e44ad', '#2ecc71', '#e74c3c', '#3498db', '#95a5a6'
        ]
      }]
    };

    var pieOptions = {
      responsive: true,
      maintainAspectRatio: false,
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            var value = data.datasets[0].data[tooltipItem.index];
            var label = data.labels[tooltipItem.index];
            var percent = (value / total * 100).toFixed(1);
            return label + ': ' + value + ' (' + percent + '%)';
          }
        }
      }
    };

    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    });
  });
</script>

<script>
    $("#id_testmethod").select2();
    function editMethod(){
      $("#id_testmethod").val().change();
    }

    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.select2bs4').select2({ theme: 'bootstrap4' });
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

  $(document).ready(function() {
    $('#exampleMethod').dataTable({
      "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        if (aData[4] == "A") {
          $('td:eq(4)', nRow).html('<b>A</b>');
        }
      }
    });
  });


  //$(function () {
  //  $("#example2").DataTable({
  //    "responsive": true,
  //    "autoWidth": true,
  //    "ordering": false
  //  });
  //});

    $(function () {
    $("#otherTable").DataTable({
      "responsive": true,
      "autoWidth": true,
      "ordering": false 
    });
  });

  $(function () {
    $("#example3").DataTable({ "responsive": true, "autoWidth": false });
  });

  $(function () {
    $("#example4").DataTable({ "responsive": true, "autoWidth": false });
  });

  $(function () {
    $("#example5").DataTable({
      "responsive": true,
      "autoWidth": true,
      "ordering": false
    });
  });

  $(document).ready(function() {
  $('#example1').DataTable({
    scrollX: true,
    responsive: false, // disable agar scrollX bekerja penuh
    autoWidth: false
  });
});

</script>
<script>
    function docReady(fn) {
        // Check if the DOM is already available
        if (document.readyState === "complete" || document.readyState === "interactive") {
            // If so, call the function immediately
            setTimeout(fn, 1);
        } else {
            // Otherwise, wait for the DOMContentLoaded event
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            // Avoid processing the same QR code scan multiple times
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;

                // Log the decoded result (QR code data)
                console.log(`Scan result: ${decodedText}`, decodedResult);

                // Optional: Redirect the user to the decoded URL
                window.location.href = decodedText;  // Redirect to the URL in the QR code
            }
        }

        // Initialize the Html5QrcodeScanner with settings like fps and qrbox size
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 }
        );

        // Start the scanner and pass the onScanSuccess function to handle scanned results
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>
<script>
    function validasiEkstensi(){
        var inputFile = document.getElementById('gambar');
        var pathFile = inputFile.value;
        var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        var fileSize = inputFile.files[0].size / 1024 / 1024;
    
        if(!ekstensiOk.exec(pathFile)){
            alert('Silakan upload foto yang dengan ekstensi .jpeg/.jpg/.png!');
            inputFile.value = '';
            return false;
        }else if(fileSize > 2){
          alert('Silahkan upload foto kurang dari 2MB!');
            inputFile.value = '';
            return false;
        }else{
            // Preview gambar
            if (inputFile.files && inputFile.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').innerHTML = '<img src="'+e.target.result+'" style="height:300px"/>';
                };
                reader.readAsDataURL(inputFile.files[0]);
            }
        }
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
        })

       $(document).ready(function(){
      // 🔁 Auto-trigger fetch data saat form edit dibuka
      let currentSupplierName = $('#supplier_name').val();
      if (currentSupplierName !== '') {
        $.ajax({
          url: "<?= site_url('c_transaksi/getSupplierFill') ?>",
          type: 'POST',
          dataType: 'json',
          data: { supplier_name: currentSupplierName },
          success: function(data){
            $('input[name="supplier_code"]').val(data.supplier_code);
          }
        });
      }

      // 🖱️ Event: ketika user mengganti dropdown supplier_name
      $('#supplier_name').on('change', function(){
        if ($(this).val() === '') {
          $('input[name="supplier_code"]').val('');
        } else {
          $.ajax({
            url: "<?= site_url('c_transaksi/getSupplierFill') ?>",
            type: 'POST',
            dataType: 'json',
            data: { supplier_name: $(this).val() },
            success: function(data){
              $('input[name="supplier_code"]').val(data.supplier_code);
            }
          });
        }
      });
    });



          $(document).ready(function(){
        // 🔁 Auto-trigger fetch data saat form edit dibuka
        let currentItemNo = $('#item_no').val();
        if (currentItemNo !== '') {
          $.ajax({
            url: "<?= site_url('c_transaksi/getMaterialFill') ?>",
            type: 'POST',
            dataType: 'json',
            data: { item_no: currentItemNo },
            success: function(data){
              $('input[name="code_of_fabric"]').val(data.code_of_fabric);
              $('input[name="composition"]').val(data.deskripsi);
            }
          });
        }

        // 🖱️ Event: ketika user mengganti dropdown item_no
        $('#item_no').on('change', function(){
          if ($(this).val() === '') {
            $('input[name="code_of_fabric"]').val('');
            $('input[name="composition"]').val('');
          } else {
            $.ajax({
              url: "<?= site_url('c_transaksi/getMaterialFill') ?>",
              type: 'POST',
              dataType: 'json',
              data: { item_no: $(this).val() },
              success: function(data){
                $('input[name="code_of_fabric"]').val(data.code_of_fabric);
                $('input[name="composition"]').val(data.deskripsi);
              }
            });
          }
        });
      });


        $(document).ready(function(){
        // Trigger fetch data ketika edit
        let currentApplicant = $('#applicant').val();
        if (currentApplicant !== '') {
          $.ajax({
            url: "<?= site_url('c_transaksi/getApplicantFill')?>",
            type: 'POST',
            dataType: 'json',
            data: {applicant: currentApplicant},
           success: function(data){
              if (data.applicant && data.applicant !== '') {
                $('input[name="department"]').val(data.department);
                $('input[name="email"]').val(data.email);
                $('input[name="telephone"]').val(data.no_tlp);
              } else {
                // Kosongkan kalau data tidak valid
                $('input[name="department"]').val('');
                $('input[name="email"]').val('');
                $('input[name="telephone"]').val('');
              }
            }
          })
        }
      });

        // Tetap tambahkan event ketika select applicant diganti
      $('#applicant').on('change', function(){
        if ($(this).val() == '') {
          $('input[name="department"]').val('');
          $('input[name="telephone"]').val('');
          $('input[name="email"]').val('');
        } else {
          $.ajax({
            url: "<?= site_url('c_transaksi/getApplicantFill') ?>",
            type: 'POST',
            dataType: 'json',
            data: {applicant: $(this).val()},
          success: function(data){
            if (data.applicant && data.applicant !== '') {
              $('input[name="department"]').val(data.department);
              $('input[name="email"]').val(data.email);
              $('input[name="telephone"]').val(data.no_tlp);
            } else {
              // Kosongkan kalau data tidak valid
              $('input[name="department"]').val('');
              $('input[name="email"]').val('');
              $('input[name="telephone"]').val('');
            }
          }
          });
        }
      });

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
        })

    
        $('#result_type').on('change', function () {
            let val = $(this).val();

            // ==== RESET SEMUA ====
            $('#div_statement, #div_statement_status, #div_passfail, #div_passfail_1, #div_status_passfail, #div_comment, #div_value_from, #div_value_to, #div_result, #div_status').hide();

            $('.shrinkage, .formaldehyde, .sock').hide().find('input, select, textarea').val('');

            $('input[name="result_row"]').val('').prop('readonly', true);
            $('input[name="status"]').val('').prop('readonly', true);
            $('textarea[name="statement"]').val('').prop('readonly', true);
            $('.status_row').val('');

            // ==== NUMBER ====
            if (val === 'number') {
                $('#div_value_from').show();
                $('#div_value_to').show();
                $('#div_result').show();
                $('#div_status').show();
                $('input[name="result_row"]').prop('readonly', false).val(0);
            }

            // ==== BOOLEAN ====
            if (val === 'boolean') {
                $('#div_passfail').show();
                $('#div_passfail_1').show();
                $('#div_status_passfail').show();
                $('#div_comment').show();
            }

            // ==== SOCK ====
            if (val === 'sock') {
                $('.sock').show();
                $('#div_comment').hide();
                $('#div_value_from').hide();
                $('#div_value_to').hide();
            }

            // ==== STATEMENT ====
            if (val === 'statement') {
                $('#div_statement').show();
                $('#div_statement_status').show();
                $('#div_status_passfail').show();
                $('textarea[name="statement"]').prop('readonly', false);
            }

            // ==== SHRINKAGE ====
            if (val === 'shrinkage') {
                $('.shrinkage').show();
                $('#div_comment').show();
            }

            // ==== FORMALDEHYDE ====
            if (val === 'formaldehyde') {
                $('.formaldehyde').show();
                $('#div_value_from').show();
                $('#div_value_to').show();
            }
        });


        $('#method_group').on('change', function () {
            if ($(this).val() == 'Product') {
                $('.other').show();
            } else {
                // hide
                $('.other').hide();
              

                // kosongkan semua input, select, textarea di dalam .other
                $('.other').find('input, select, textarea').val('');
               
                
                // kalau ada checkbox atau radio
                $('.other').find('input:checkbox, input:radio').prop('checked', false);
            }
        });


        $(document).on('click', '#tambah', function(e){   
            e.preventDefault(); // Supaya tombol tidak submit form default

            // Ambil semua field, pakai nama sesuai HTML
            const data_method = {
                id_testmethod: $('input[name="id_testmethod"]').val()||'-',
                id_order: $('input[name="id_order"]').val()|| '-',
                report_no: $('input[name="report_no"]').val()|| '-',
                id_testmatrix: $('select[name="id_testmatrix"]').val()|| '-',
                method_code: $('input[name="method_code"]').val()|| '-',
                //method_name: $('input[name="method_name"]').val()|| '-',
                method_name: $('input[name="title_row"]').val() || '-',
                measurement: $('input[name="measurement_row"]').val()|| '-',
                title: $('input[name="title_row"]').val()|| '-',
                result: $('input[name="result_row"]').val()|| '-',
                be_wash: $('input[name="be_wash"]').val()|| '-',
                af_wash_1: $('input[name="af_wash_1"]').val()|| '-',
                ac_wash_1: $('input[name="ac_wash_1"]').val()|| '-',
                af_wash_5: $('input[name="af_wash_5"]').val()|| '-',
                ac_wash_5: $('input[name="ac_wash_5"]').val()|| '-',
                af_wash_15: $('input[name="af_wash_15"]').val()|| '-',
                ac_wash_15: $('input[name="ac_wash_15"]').val()|| '-',
                result_passfail: $('select[name="result_passfail_row"]').val()|| '-',
                result_passfail1: $('select[name="state_1"]').val()|| '-',
                status_passfail: $('input[name="status_boolean"]').val()|| '-',
                statement: $('textarea[name="statement"]').val()|| '-',
                comment: $('input[name="comment"]').val()|| '-',
                status_numeric: $('input#status_numeric').val() || '-',
                status_shrinkage: $('input#status_shrinkage').val() || '-',
                status_boolean: $('input#status_boolean').val() || '-',
                status_statement_result: $('input#status_statement_result').val() || '-',
                mass_of : $('input[name="mass_of"]').val() || '-',
                range_graph_1 : $('input[name="range_graph_1"]').val() || '-',
                range_graph_2 : $('input[name="range_graph_2"]').val() || '-',
                status_formaldehyde : $('input[name="status_formaldehyde"]').val() || '-',
                result_formaldehyde : $('input[name="result_formaldehyde"]').val() || '-',
                nahm_sock : $('input[name="nahm_sock"]').val() || '-',
                result_sock : $('input[name="result_sock"]').val() || '-',
                comment_sock : $('input[name="comment_sock"]').val() || '-',
                status_sock : $('input[name="status_sock"]').val() || '-'
            };

            // AJAX kirim ke PHP keranjang
            $.ajax({
                url: "<?=site_url('c_transaksi/keranjang_method')?>",
                type: 'POST',
                data: data_method,
                success: function(data){
                    // Reset semua input form supaya bisa tambah baris lagi
                    reset(); // pastikan fungsi reset() mengosongkan semua input
                    $('table#keranjang_method tbody').append(data);
                    $('tfoot').show();

                    // Hitung status global setelah tambah
                    const status = hitung_status(); // fungsi hitung_status() tetap dipakai
                    $('input[name="result_status"]').val(status);
                    $('#result_status').text(status);
                },
                error: function(){
                    alert('Terjadi kesalahan saat menambah data.');
                }
            });
        });


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


    function reset() {
        // ===== Reset Select2 Test Matrix =====
        $('select[name="id_testmatrix"]').val(null).trigger('change').prop('disabled', false);

        // ===== Reset Input Text =====
        $('#title_row, #measurement_row, #value_from, #value_to, #result_row, #status, #be_wash, #af_wash_1, #af_wash_5, #af_wash_15, #ac_wash_1, #ac_wash_5, #ac_wash_15, #status_numeric, #status_shrinkage, #status_boolean, #status_statement_result, #method_code, #comment').val('');
        
        // ===== Reset Textarea =====
        $('#statement').val('');

        // ===== Reset Selects =====
        //$('#method_group').val($('#method_group option:first').val()).prop('disabled', false).trigger('change');
        // $('#result_type, #result_passfail, #result_passfail1, #status_statement').val('Pilih').prop('disabled', false);
        $('#result_type').val('Pilih').prop('disabled', true);

        // ===== Hide semua div opsional =====
        $('#div_result, #div_value_from, #div_value_to, #div_passfail, #div_passfail_1, #div_status_statement, #div_comment, #div_statement, #div_statement_status').hide();
        $('.shrinkage').hide();
        $('.formaldehyde').hide().find('input, select, textarea').val('');
        $('.sock').hide().find('input, select, textarea').val('');

        // ===== Nonaktifkan tombol tambah =====
        $('#tambah').prop('disabled', true);

    }


        </script>
   
              
        <script>
         function hitung_status() {
            let table = document.getElementById("keranjang_method");
            let status_td = table.querySelectorAll("td.status");
            let p_counter = 0;
            let f_counter = 0;

            for (let i = 0; i < status_td.length; i++) {
                let v = status_td[i].innerText.toLowerCase().trim();

                if (v.includes('fail')) {
                    f_counter++;
                } else if (v.includes('pass')) {
                    p_counter++;
                }
            }

            let text = (f_counter > 0) ? "fail" : "pass";

            // update tampilan
            document.getElementById('result_status_text').innerHTML = text;
            document.getElementById('result_status').value = text;

            // RETURN INI YANG WAJIB ADA
            return text;
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
<script>
$(document).ready(function(){
  $('#confirmSave').on('click', function(){
    $('#confirmModal').modal('hide'); // tutup modal
    $('#myForm').submit(); // jalankan submit form
  });
});
</script>
<script>
document.getElementById('exportExcel').addEventListener('click', function() {
  window.location.href = "<?= site_url('c_transaksi/dashboard_excel') ?>";
});
</script>
<script>
$(document).ready(function(){
  // Ketika tombol Release diklik
  $('.btn-release').on('click', function(e){
    e.preventDefault();
    const id = $(this).data('id');
    const report = $(this).data('report');

    // Masukkan data ke modal
    $('#modal_id_penerimaan').val(id);
    $('#modal_report_no').val(report);

    // Tampilkan modal
    $('#releaseModal').modal('show');
  });
});
</script>
<script>
$(document).ready(function() {
    var table = $('#orderTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= base_url('index.php/c_transaksi/get_order_ajax') ?>",
            type: "GET"
        },
        columns: [
            { 
                data: null, 
                render: function (data, type, row, meta) {
                    // auto numbering
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                className: "text-center"
            },
            { data: 'id_order', visible: false},
            { data: 'working_number' },
            { data: 'item_name' },
            { data: 'brand' },
            { data: 'order_number' },
            { data: 'costumer_name' },
            { data: 'article_no' },
            { data: 'color' },
            { data: 'po_quantity' },
            { data: 'podd' },
            { data: 'lco' },
            { data: 'production_date' },
            { data: 'season' },
            { data: 'line' },
            {
                data: null,
                render: function (data, type, row) {
                    const baseUrl = "<?php echo base_url('index.php/c_transaksi'); ?>";
                  return `
                        <div class="btn-group" role="group">
                            <a href="${baseUrl}/detail_order/${row.id_order}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            <a href="${baseUrl}/edit_order/${row.id_order}" class="btn btn-warning btn-sm text-white" hidden>
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${row.id_order}" hidden>
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                        `;
                }
            }
        ]
    });

    // Contoh event handler tombol "Pilih"
    $('#orderTable').on('click', '.pilih-btn', function() {
        let id = $(this).data('id');
        alert('Kamu pilih order ID: ' + id);
        // di sini bisa redirect atau autofill form
    });
});

</script>
<script>
   $(document).ready(function() {

    $('#order_number').select2();

    $('#order_number').on('change', function() {
        let select = $(this).val();

        if (select === 'other') {
            $('#other_container').slideDown('fast');
        } else {
            $('#other_container').slideUp('fast');
            $('#other_order_number').val('');
        }
    });

});

</script>
<script>
$('#order_number').on('change', function() {
    let orderNumber = $(this).val();

    if (orderNumber === 'other') {
        $('#other_order_number').show().val('');
        $('#order_number, #costumer_code, #costumer_name, #article_no, #color, #age, #working_numer, #item_name, #exception, #functional, #hangtag, #style, #podd, #lco, #po_quantity, #production_date, #season, #size, #line, #factory_discleamer, #brand').val('');
        return;
    }

    $('#other_order_number').hide();

    $.ajax({
      url: "<?= site_url('c_transaksi/get_dataorder') ?>",
      type: "POST",
      data: { order_number: orderNumber },
      dataType: "json",
      success: function(data) {
          if (data) {
              $('#order_number').val(data.order_number);
              $('#costumer_code').val(data.costumer_code);
              $('#costumer_name').val(data.costumer_name);
              $('#article_no').val(data.article_no);
              $('#color').val(data.color);
              $('#age').val(data.age);
              $('#working_number').val(data.working_number);
              $('#item_name').val(data.item_name);
              $('#exception').val(data.exception);
              $('#functional').val(data.functional);
              $('#hangtag').val(data.hangtag);
              $('#style').val(data.style);
              $('#podd').val(data.podd);
              $('#lco').val(data.lco);
              $('#po_quantity').val(data.po_quantity);
              $('#production_date').val(data.production_date);
              $('#season').val(data.season);
              $('#size').val(data.size);
              $('#line').val(data.line);
              $('#factory_discleamer').val(data.factory_discleamer);
              $('#brand').val(data.brand);
          } else {
              $('#order_number, #costumer_code, #costumer_name, #article_no, #color, #age, #working_numer, #item_name, #exception, #functional, #hangtag, #style, #podd, #lco, #po_quantity, #production_date, #season, #size, #line, #factory_discleamer, #brand').val('');
          }
      },
      error: function(xhr, status, error) {
          console.error("AJAX Error:", error);
          alert('Gagal mengambil data order. Coba periksa URL di controller.');
      }
  });
});
</script>
<script>
// Ketika pilih Test Matrix
$('#id_testmatrix').on('change', function() {
    if ($(this).val() === '') reset();
    else {
        $.ajax({
            url: "<?= site_url('c_transaksi/get_all_method') ?>",
            type: 'POST',
            dataType: 'json',
            data: { id_testmatrix: $(this).val() },
            success: function(data) {
                $('input[name="id_testmethod"]').val(data.id_testmethod);
                $('#method_code').val(data.method_code);
                $('input[name="title_row"]').val(data.method_name);
                $('input[name="measurement_row"]').val(data.measurement);
                $('#value_from_row').val(data.value_from);
                $('#value_to_row').val(data.value_to);

                $('#result').val(''); // kosongkan result dulu
                $('#status_numeric').val('');
                $('#status_display').html('');

                $('#div_result').hide(); // tampilkan input result
                $('select#result_type').prop('disabled', false);
                $('button#tambah').prop('disabled', false);
            }
        });
    }
});

// Hitung status ketika user mengetik result
$('#result').on('keyup', function() {
    const status = sum_method();
    $('#status_numeric').val(status);
    $('#status_display').html('<strong>' + status + '</strong>');
});

function sum_method() {

    const from   = parseInterval($('#value_from_row').val());
    const to     = parseInterval($('#value_to_row').val());
    const result = parseInterval($('#result').val());

    if (!from || !to || !result) return "fail";

    const lowerLimit = from.max;
    const upperLimit = to.max;

    // belum menyentuh batas bawah
    if (result.max < lowerLimit) return "fail";

    // sudah melewati batas atas
    if (result.min > upperLimit) return "fail";

    return "pass";
}




function updateStatusSock(el) {
  const status = el.value?.trim() || '';
  const result = (status !== "Rejected") ? 'pass' : 'fail';

  const target = document.querySelector("#status_sock");
  if (target) {
    target.value = result;
  }
}




function status_boolean() {
    const status1 = document.querySelector("#result_passfail")?.value || '';
    const status2 = document.querySelector("#result_passfail1")?.value || '';

    // Logika: pass kalau kedua dropdown bukan "Rejected"
    const result = (status1 && status2) ? ((status1 !== "Rejected" && status2 !== "Rejected") ? 'pass' : 'fail') : '';

    // Set ke input status_boolean kalau ada
    const statusInput = document.getElementById('status_boolean');
    if (statusInput) {
        statusInput.value = result;
    }

    console.log({ status1, status2, result });
    return result;
}

// Trigger otomatis saat dropdown berubah
document.querySelectorAll('.result_passfail, .result_passfail1').forEach(el => {
    el.addEventListener('change', status_boolean);
});

// Parsing input angka dengan +, -, %
function parseNumber(val){
    if(!val) return null;
    val = val.trim().replace('%','');
    let offset = 0;
    if(val.endsWith('+')) offset = 0.25;
    if(val.endsWith('-')) offset = -0.25;
    val = val.replace(/[+-]/g,'');
    const num = parseFloat(val);
    return isNaN(num) ? null : num + offset;
}

// Update AC, input actual shrinkage, status
function updateWashDisplay(afId, acDisplayId, acInputId, statusDisplayId){
    const be = parseNumber(document.getElementById('be_wash').value);
    const af = parseNumber(document.getElementById(afId).value);
    const acSpan = document.getElementById(acDisplayId);
    const acInput = document.getElementById(acInputId);
    const statusSpan = document.getElementById(statusDisplayId);

    if(be !== null && af !== null){
        const ac = ((af - be) / be) * 100;
        acSpan.textContent = ac.toFixed(2) + '%';
        acInput.value = ac.toFixed(2);
        const status = (ac >= -5 && ac <= 5) ? 'Pass' : 'Fail';
        statusSpan.textContent = status;
        statusSpan.style.color = (status === 'Pass') ? 'green' : 'red';
    } else {
        acSpan.textContent = '';
        acInput.value = '';
        statusSpan.textContent = '';
    }

    updateGlobalStatus();
}

// Update global shrinkage
function updateGlobalStatus(){
    const statuses = ['status_ac_wash_1_display','status_ac_wash_5_display','status_ac_wash_15_display']
        .map(id => document.getElementById(id).textContent)
        .filter(v => v !== '');

    let global = '';
    if(statuses.length > 0){
        global = statuses.includes('Fail') ? 'Fail' : 'Pass';
    }

    document.getElementById('status_shrinkage').value = global;
    document.querySelector('input[name="status"]').value = global;
}

// Event listener
document.addEventListener('DOMContentLoaded', function() {
    ['1','5','15'].forEach(id => {
        const afInput = document.getElementById(`af_wash_${id}`);
        afInput.addEventListener('input', () => {
            updateWashDisplay(
                `af_wash_${id}`,
                `ac_wash_${id}_display`,
                `ac_wash_${id}`,
                `status_ac_wash_${id}_display`
            );
        });
    });

    const beInput = document.getElementById('be_wash');
    beInput.addEventListener('input', () => {
        ['1','5','15'].forEach(id => {
            updateWashDisplay(
                `af_wash_${id}`,
                `ac_wash_${id}_display`,
                `ac_wash_${id}`,
                `status_ac_wash_${id}_display`
            );
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("#status_statement").addEventListener("change", status_statement);
});

  function status_statement() {
        var status = document.querySelector("#status_statement").value;
        var passfailElem = document.querySelector("#status_statement_result");

        if (!passfailElem) return;

        if (status !== "Rejected") {
            passfailElem.value = 'pass';
        } else {
            passfailElem.value = 'fail';
        }
    }

    function parseInterval(val) {
    if (!val) return null;

    val = val.toString().trim().replace("%", "");

    if (val.startsWith("<=")) return { min: -Infinity, max: parseFloat(val.slice(2)) };
    if (val.startsWith("<"))  return { min: -Infinity, max: parseFloat(val.slice(1)) };
    if (val.startsWith(">=")) return { min: parseFloat(val.slice(2)), max: Infinity };
    if (val.startsWith(">"))  return { min: parseFloat(val.slice(1)), max: Infinity };

    if (/^-?\d+(\.\d+)?\s*-\s*-?\d+(\.\d+)?$/.test(val)) {
        let [a, b] = val.split("-").map(v => parseFloat(v));
        return { min: Math.min(a, b), max: Math.max(a, b) };
    }

    let num = parseFloat(val);
    if (!isNaN(num)) return { min: num, max: num };

    return null;
}

function status_formaldehyde_result() {

    const resultVal = document.querySelector('input[name="result_formaldehyde"]')?.value;
    const fromVal   = document.getElementById('value_from_row')?.value;
    const toVal     = document.getElementById('value_to_row')?.value;
    const statusEl  = document.querySelector('input[name="status_formaldehyde"]');

    if (!statusEl) return;

    const from   = parseInterval(fromVal);
    const to     = parseInterval(toVal);
    const result = parseInterval(resultVal);

    if (!from || !to || !result) {
        statusEl.value = "";
        return;
    }

    const lowerLimit = from.max; // batas bawah efektif
    const upperLimit = to.max;   // batas atas efektif

    // batas tidak masuk akal
    if (lowerLimit > upperLimit) {
        statusEl.value = "fail";
        return;
    }

    const pass =
        result.max >= lowerLimit &&  // menyentuh batas bawah
        result.min <= upperLimit;    // tidak lewat batas atas

    statusEl.value = pass ? "pass" : "fail";
}

</script>
<script>
function cekUkuranFile(input) {
    const file = input.files[0];

    if (!file) return;

    const maxSize = 5 * 1024 * 1024; // 5 MB

    if (file.size > maxSize) {
        alert('Ukuran file terlalu besar. Maksimal 5 MB.');
        input.value = ''; // reset file
    }
}
</script>
<!--------DARI TEST RESULT--------------->
    <script>
          function enterFashion() {
              var key = window.event.keyCode;

              // If the user has pressed enter
              if (key === 13) {
                  document.getElementById("fashion").value = document.getElementById("fashion").value + "\n";
                  return false;
              }
              else {
                  return true;
              }
          }
        </script>
         <script>
          function enterHybrid() {
              var key = window.event.keyCode;

              // If the user has pressed enter
              if (key === 13) {
                  document.getElementById("hybrid").value = document.getElementById("hybrid").value + "\n";
                  return false;
              }
              else {
                  return true;
              }
          }
        </script>
         <script>
          function enterRemarks() {
              var key = window.event.keyCode;

              // If the user has pressed enter
              if (key === 13) {
                  document.getElementById("txtremarks").value = document.getElementById("txtremarks").value + "\n";
                  return false;
              }
              else {
                  return true;
              }
          }
        </script>
      <!---script>
        setTimeout(() => {
          $.ajax({
            url:"<= site_url('c_transaksi/index_order') ?>",
            type: "GET",
            dataType:"",
            cache:"false",
            success:function($data)
            {
              $('#example2').html($data);
            }
          })
        }, 2000);
      </script-->
      <script>
        $(document).ready(function(){
          $('tfoot').hide()

          $(document).keypress(function(event){
                if (event.which == '13') {
                    event.preventDefault();
                }
            })

          /*$('#rema').on('change', function(){
            $('button#tambahreqmin').prop('disabled', false)
            $('input[name="remarks_min1"]').prop('readonly',false)
            $('input[name="fc"]').prop('readonly',false)
            $('input[name="hp"]').prop('readonly',false)
            $('input[name="remarks_min2"]').prop('readonly',false)
            $('input[name="fchp"]').prop('readonly',false)

            $.ajax({
              type:'POST',
              dataType: 'json',
              data: {nama_req: $(this).val()},
              success: function(data){
                $('button#tambahreqmin').prop('disabled', false);
              }
            })
          })*/

          $(document).on('click', '#tambahreqmin', function(e){
            const data_req = {
              remarks_min1: $('textarea[name="remarks_min1"]').val(),
              fc: $('input[name="fc"]').val(),
              hp: $('input[name="hp"]').val(),
              remarks_min2: $('textarea[name="remarks_min2"]').val(),
              fchp: $('input[name="fchp"]').val(),
              }
            $.ajax({
              type: 'POST',
              url: "<?=site_url('c_mastermethod/keranjang_reqmin') ?>",
              data:data_req,
              success: function(data){
                $('table#keranjang_reqmin tbody').append(data);
                $('tfoot').show()
              },
              error:function(){
                alert('error');
              }
            })
          })

          $(document).on('click', '#tombol-hapus-req', function(){
            $(this).closest('.row-keranjang-min').remove()

            $('option')
          })
        })
      </script>
      <script>
        function openCity(evt, cityName) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(cityName).style.display = "block";
          evt.currentTarget.className += " active";
        }
      </script>
      <script>
            $(function() {
              cbpHorizontalMenu.init();
            });

            $(function () {
                $('select#product_type').select2();
            });
      </script>
<script>
  $(function () {
    var areaChartCanvas = $('#barChart').get(0).getContext('2d')
    var areaChartCanvasMaterial = $('#barChartMaterial').get(0).getContext('2d')
    var areaChartData = {
      labels  : ['Januari', 'Februari', 'Maret' ],
      datasets: [
        {
          label               : 'Pass',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Fail',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

 
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    var barChartCanvas = $('#barChartMaterial').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

  })
  </script>
  <script>
    $('#result_type').on('change', function () {

    const type = $(this).val();
    const mode = $('#form_mode').val(); // add / edit
    const isAdd = mode === 'add';

    if (type === 'Boolean') {
        $('#pass_fail').prop('disabled', false);

        $('input[name="uom"]').prop('disabled', true);
        $('input[name="value_to"]').prop('disabled', true);
        $('input[name="value_from"]').prop('disabled', true);
       $('#statementMatrix')..prop('disabled', true);

        if (isAdd) {
            $('input[name="uom"]').val('');
            $('input[name="value_to"]').val('');
            $('input[name="value_from"]').val('');
            $('#statementMatrix')..val('');
        }
    }

    if (type === 'Number') {
        $('#pass_fail').prop('disabled', true);
        $('input[name="uom"]').prop('disabled', false);
        $('input[name="value_to"]').prop('disabled', false);
        $('input[name="value_from"]').prop('disabled', false);
        $('#statementMatrix').prop('disabled', true);

        if (isAdd) {
            $('#pass_fail').val('');
           $('#statementMatrix').val('');
        }
    }

    if (type === 'Statement') {
        $('#statementMatrix').prop('disabled', false);

        $('input[name="uom"]').prop('disabled', true);
        $('input[name="value_to"]').prop('disabled', true);
        $('input[name="value_from"]').prop('disabled', true);
        $('#pass_fail').prop('disabled', true);

        if (isAdd) {
            $('input[name="uom"]').val('');
            $('input[name="value_to"]').val('');
            $('input[name="value_from"]').val('');
            $('#pass_fail').val('');
        }

        console.log('type:', type);
        console.log(
            'statement disabled:',
            $('#statementMatrix').prop('disabled')
        );
    }
});

$(document).ready(function () {
    $('#result_type').trigger('change');
});

  </script>
  <script>
    function validasiEkstensi(){
        var inputFile = document.getElementById('gambar');
        var pathFile = inputFile.value;
        var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        var fileSize = inputFile.files[0].size / 1024 / 1024;
    
        if(!ekstensiOk.exec(pathFile)){
            alert('Silakan upload foto yang dengan ekstensi .jpeg/.jpg/.png!');
            inputFile.value = '';
            return false;
        }else if(fileSize > 2){
          alert('Silahkan upload foto kurang dari 2MB!');
            inputFile.value = '';
            return false;
        }else{
            // Preview gambar
            if (inputFile.files && inputFile.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').innerHTML = '<img src="'+e.target.result+'" style="height:300px"/>';
                };
                reader.readAsDataURL(inputFile.files[0]);
            }
        }
      }
  </script>
  <script>
    function validasiEkstensi1(){
        var inputFile = document.getElementById('simbol_care');
        var pathFile = inputFile.value;
        var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        var fileSize = inputFile.files[0].size / 1024 / 1024;
    
        if(!ekstensiOk.exec(pathFile)){
            alert('Silakan upload foto yang dengan ekstensi .jpeg/.jpg/.png!');
            inputFile.value = '';
            return false;
        }else if(fileSize > 2){
          alert('Silahkan upload foto kurang dari 2MB!');
            inputFile.value = '';
            return false;
        }
      }
  </script>
  <script>
    function validasiEkstensi2(){
        var inputFile = document.getElementById('tanda_tangan');
        var pathFile = inputFile.value;
        var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        var fileSize = inputFile.files[0].size / 1024 / 1024;
    
        if(!ekstensiOk.exec(pathFile)){
            alert('Silakan upload foto yang dengan ekstensi .jpeg/.jpg/.png!');
            inputFile.value = '';
            return false;
        }else if(fileSize > 2){
          alert('Silahkan upload foto kurang dari 2MB!');
            inputFile.value = '';
            return false;
        }
      }
  </script>
  <script>
      function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode ))
          
          return false;
          return true;
      }
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

      function isReportNo(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode === 47) { // '/' = 47
                alert('Format yang anda masukkan tidak sesuai"/" !');
                return false;
            }
            return true;
        }

        function checkReportNo(input) {
            if (input.value.includes('/')) {
                alert('Format yang anda masukkan tidak sesuai "/" !');
                input.value = input.value.replace(/\//g, ''); // hapus semua '/'
            }
        }
    </script>
<script>
$(document).ready(function () {

    $.ajax({
        url: "<?= base_url('index.php/qad/get_total_wash'); ?>",
        type: "GET",
        dataType: "json",
        success: function (res) {

            const ctx = document.getElementById('washChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: res.labels,
                    datasets: [{
                        label: 'Total Wash (per 30.000)',
                        data: res.data,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Wash'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Working Number'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });

        }
    });

});
</script>
<script>
$(document).ready(function () {

    $.ajax({
        url: "<?= base_url('index.php/qad/get_fgt_chart'); ?>",
        type: "GET",
        dataType: "json",
        success: function (res) {

            const total =
                Number(res.going_to_be_test) +
                Number(res.tested) +
                Number(res.pass) +
                Number(res.fail);

            const ctx = document.getElementById('fgtChart').getContext('2d');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: [
                        'TESTED',
                        'GOING TO BE TEST',
                        'PASS',
                        'FAIL'
                    ],
                    datasets: [{
                        data: [
                            res.tested,
                            res.going_to_be_test,
                            res.pass,
                            res.fail
                        ],
                        backgroundColor: [
                            '#0d6efd', // biru - TESTED
                            '#6c757d', // abu - GOING TO BE TEST
                            '#198754', // hijau - PASS
                            '#dc3545'  // merah - FAIL
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const value = context.raw || 0;
                                    const percent = total > 0
                                        ? ((value / total) * 100).toFixed(2)
                                        : 0;
                                    return `${context.label}: ${value} (${percent}%)`;
                                }
                            }
                        }
                    }
                }
            });
        }
    });

});

</script>
