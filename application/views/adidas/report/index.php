<style>
.dataTables_filter{
display:block;
float:right;
}
 </style>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Handling Sample</a></li>
                <li class="breadcrumb-item active">Report</li>
                </ol>
          </div>
        </div>
      </div>
</div>
<section class="content" id="content" data-url="<?= base_url('c_transaksi')?>" >
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #36454F;" >
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped table-sm text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Report No</th>
                                <th>Item No</th>
                                <th>Stage</th>
                                <th>Test Required</th>
                                <th>Personil</th>
                                <th>Date Received</th>
                                <th>Batch / LOT Number</th>
                                <th>Order Number/PO LCO</th>
                                <th>Style</th>
                                <th>Color</th>
                                <th>Color Of</th>
                                <th>Test Result</th>
                                <th>Date Final of Test</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php 
                                $no = 1;
                                foreach($report as $u) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $u->report_no?></td>
                                    <td><?= $u->item_no?></td>
                                    <td><?= $u->stage?></td>
                                    <td><?= $u->test_required?></td>
                                    <td><?= $u->personil ?></td>
                                    <td><?= $u->datetime_received ?></td>
                                    <td><?= $u->batch_lot ?></td>
                                    <td><?= $u->order_number ?></td>
                                    <td><?= $u->style_no ?></td>
                                    <td><?= $u->color ?></td>
                                    <td><?= $u->color_of ?></td>
                                    <td><?= $u->result_status ?></td>
                                    <td><?= $u->date_final?></td>
                                    <td>
                                        <a href="<?= site_url('c_transaksi/update_report/') . $u->id_reportkualitas . '/' . $u->id_handlingsample ?>" class="btn btn-outline-success btn-sm"><i class="fa-solid fa-file-pen"></i></a> &nbsp;
                                        <a href="<?= site_url('c_transaksi/report_test/') . $u->id_handlingsample.'/'.$u->test_required.'/'.$u->report_no ?>" class="btn btn-outline-info btn-sm button2" target="_blank"><i class="fa fa-file-alt"></i></a> &nbsp;
                                        <a href="<?= site_url('') ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?php echo $u->test_required ?>');" class="btn btn-outline-danger btn-sm remove"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>