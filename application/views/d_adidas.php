<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(APPPATH.'views/layout/_meta.php'); ?>
    <?php require_once(APPPATH.'views/layout-fe/_css.php'); ?>
    <?php require_once(APPPATH.'views/layout/_css.php'); ?>
   

    <style>
    /* CSS untuk menata layout filter */
    .filter-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px; /* Kurangi jarak bawah */
        gap: 10px; /* Kurangi jarak antar elemen */
    }

    .filter-container > * {
        flex: 1; /* Agar semua elemen mendapatkan ruang yang sama */
        margin: 0; /* Menghilangkan margin */
    }

    /* Responsivitas untuk layar kecil */
    @media screen and (max-width: 768px) {
        .filter-container {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-container > * {
            width: 100%; /* Agar elemen memenuhi layar */
            margin-bottom: 5px; /* Atur jarak bawah untuk elemen pada layar kecil */
        }
    }

    .container-fluid {
            width: 100%; /* Responsif */
            max-width: 1200px; /* Set batas maksimum lebar */
            height: auto; /* Tinggi disesuaikan dengan konten */
            padding-top: 20px; /* Padding positif */
            margin-top: -30px; /* Geser kontainer ke atas */
        }
</style> 
</head>
<body class="hold-transition sidebar-mini layout-fixed" data-url="<?= base_url('Welcome') ?>" style="font-size: 16px;">
    <?php require_once(APPPATH.'views/layout-fe/_headerfe.php'); ?>
        <div class="col-md-12">
            <div class="col-md-2">
                &nbsp;
            </div>
           
            <div class="col-md-12">
                <center><h2 style="font-weight: bold; padding-top:15px;" hidden>Sample Monitoring</h2></center>
                <div class="table-responsive">
                    <div class="filter-container" >
                        <!-- Dropdown Filter -->
                        <div class="category-filter" hidden>
                        <label>Filter Report</label>
                            <select id="categoryFilter" class="form-control" >
                                <option value="">Report All</option>
                                <option value="fgwt">FGWT</option>
                                <option value="fgft">FGFT</option>
                                <option value="fgpt">FGPT</option>
                                <option value="heat">HEAT</option>
                            </select>
                        </div>
                    
                        <br>
                        <!-- Filter "Show entries" -->
                        <div id="example2_length" hidden></div>

                        <!-- Filter "Search" -->
                        <div id="example2_filter" hidden></div>
                    </div>
                    <table class="table" id="example2" style="width:100%;">
                        <thead class="btn-primary" style="font-weight:bold;">
                            <tr>
                                <th><center>No</th>
                                <th><center>Applicant</th>
                                <th><center>No report</th>
                                <th><center>PO/Order</th>
                                <th><center>Kode Kain</th>
                                <th><center>Warna/Batch</th>
                                <th><center>ERP Production</th>
                                <th><center>Report</th>
                                <th><center>Result</center></th>
                            </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
        </div>
        <?php require_once(APPPATH.'views/layout-fe/_js.php'); ?>
        <?php require_once(APPPATH.'views/layout/_js.php'); ?>

    <script>
$(document).ready(function () {

    let table = $('#example2').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: "<?= site_url('Welcome/ajax_d_adidas') ?>",
            type: "GET",
            dataSrc: "data"
        },
        ordering: false,
        pageLength: 10
    });

});
    </script>

</body>

</html>
