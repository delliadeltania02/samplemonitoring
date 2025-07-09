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
                <li class="breadcrumb-item active">Report All</li>
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
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead >
                            <tr >
                                <th style="text-align: center;vertical-align: middle;">No</th>
                                <th style="text-align: center;vertical-align: middle;">Report No</th>
                                <th style="text-align: center;vertical-align: middle;">Item No</th>
                                <th style="text-align: center;vertical-align: middle;">Order Number/PO LCO</th>
                                <th style="text-align: center;vertical-align: middle;">Date Received</th>
                                <th style="text-align: center;vertical-align: middle;">Date Final of Test</th>
                                <th style="text-align: center;vertical-align: middle;" width=10px;>Done</th>
                                <th style="text-align: center;vertical-align: middle;" width=10px;>On Progress</th>
                                <th style="text-align: center;vertical-align: middle;">Test Result</th>
                                <th style="text-align: center;vertical-align: middle;"></th>
                            </tr>
                        </thead>
                        <tbody id="myTable"  style="text-align: center;">
                            <?php $no = 1; foreach($hasil as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row->report_no ?></td>
                                <td><?= $row->item_no?></td>
                                <td><?= $row->order_number?></td>
                                <td><?= date('d-m-Y', strtotime($row->datetime_received)) ?></td>
                                <td><?= date('d-m-Y H:i', strtotime($row->date_final)) ?></td>
                                <td><?= $row->selesai ?></td>
                                <td style="background-color: <?= $row->belum_selesai == 0 ? '	#228B22	' : '#fff3cd' ?>;">
                                    <?= $row->belum_selesai ?>
                                </td>
                                <td><?= $row->hasil_akhir ?></td>
                                <td>
                                    <?php if ($row->belum_selesai == 0): ?>
                                        <a href="<?= site_url('c_transaksi/report_test_all/') . $row->id_penerimaan.'/'.$row->report_no ?>" class="btn btn-outline-info btn-sm button2" target="_blank"><i class="fa fa-file-alt"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>