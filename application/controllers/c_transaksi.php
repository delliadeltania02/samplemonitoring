<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Alignment;
    use PhpOffice\PhpSpreadsheet\Chart\Chart;
    use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
    use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
    use PhpOffice\PhpSpreadsheet\Chart\Legend;
    use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
    use PhpOffice\PhpSpreadsheet\Chart\Title;
	use PhpOffice\PhpSpreadsheet\Chart\DataLabels;
	use Dompdf\Dompdf;
	use Dompdf\Options;

class c_transaksi extends CI_Controller {
public function __construct()
{
    parent::__construct();

		// Method report yang BOLEH diakses tanpa login
		$public_methods = [
			'fgwt', 
			'fgt',
			'ftr',
			'ttr1',
			'ttr2',
			'report_finalhandling',
			'getHistoryNo',
			'getHistoryAll'
		];

		// Ambil nama method yang sedang diakses
		$current_method = $this->router->fetch_method();

		// Jika method TIDAK ADA di public_methods → wajib login
		if (!in_array($current_method, $public_methods)) {
			if (!$this->session->userdata('logincek')) {
				redirect('auth/login');
				exit;
			}
		}

		// Load library & model
		$this->load->library('form_validation');
		$this->load->helper(['url','form']);
		$this->load->model(['m_login','m_transaksi']);
		$this->load->library('upload');
	}

public function proses_kualitas()
{
    $id_penerimaan = $this->input->post('id_penerimaan');
    $report_no     = $this->input->post('report_no');
    $tests         = $this->input->post('test_required'); // array
    $colors        = $this->input->post('color');         // array (optional)

    if (empty($id_penerimaan) || empty($report_no) || empty($tests)) {
        $this->session->set_flashdata('error', 'Test belum dipilih');
        redirect('c_transaksi/index_kualitas');
        return;
    }

    $data = [
        'id_penerimaan' => $id_penerimaan,
        'report_no'     => $report_no,
        'test_required' => json_encode(array_values($tests)),
        'status'        => 'proses',
        'created_at'    => date('Y-m-d H:i:s')
    ];

    // kalau color ada → simpan sebagai JSON
    if (!empty($colors)) {
        $data['color'] = json_encode(array_values($colors));
    }

    $this->db->insert('tbl_kualitas', $data);

    if (!$this->db->affected_rows()) {
        $this->session->set_flashdata('error', 'Gagal memulai test');
        redirect('c_transaksi/index_kualitas');
        return;
    }

    $id_kualitas = $this->db->insert_id();

    // simpan ke session (kalau masih mau dipakai)
    $this->session->set_userdata('id_kualitas_array', [$id_kualitas]);

    // redirect ke halaman test
    redirect(
        'c_transaksi/index_testResult/' .
        $report_no . '/' .
        $id_kualitas . '/' .
        $id_penerimaan
    );
}


public function get_test_required_dropdown()
{
    $id_penerimaan = $this->input->post('id_penerimaan');

    /** =========================
     * 1. Ambil dari tbl_penerimaan
     * ========================= */
    $row = $this->db
        ->select('test_required, color')
        ->from('tbl_penerimaan')
        ->where('id_penerimaan', $id_penerimaan)
        ->get()
        ->row();

    $tests  = [];
    $colors = [];

    if ($row) {
        $tests  = json_decode($row->test_required, true) ?? [];
        $colors = json_decode($row->color, true) ?? [];
    }

    /** =========================
     * 2. Ambil test yang SUDAH ADA di tbl_kualitas
     * ========================= */
    $usedTests = [];

    $rows = $this->db
        ->select('test_required')
        ->from('tbl_kualitas')
        ->where('id_penerimaan', $id_penerimaan)
        ->get()
        ->result();

    foreach ($rows as $r) {
        $decoded = json_decode($r->test_required, true);

        if (is_array($decoded)) {
            $usedTests = array_merge($usedTests, $decoded);
        } elseif (!empty($r->test_required)) {
            // kalau suatu saat isinya string
            $usedTests[] = $r->test_required;
        }
    }

    /** =========================
     * 3. Filter sisa test
     * ========================= */
    if (!empty($usedTests)) {
        $tests = array_values(array_diff($tests, $usedTests));
    }

    echo json_encode([
        'tests'  => $tests,
        'colors' => $colors
    ]);
}



	public function get_order_detail($id_order)
	{
		$order = $this->m_transaksi->orderById(['id_order' => $id_order]);
		echo json_encode($order);
	}
	
	public function edit_order($id_order)
	{
		$where = ['id_order' => $id_order];
		$data['detail'] = $this->m_transaksi->orderById($where); // harus berupa object
		$this->template->load('layout/template', 'adidas/order/edit.php', $data);
	}

		public function detail_order($id_order)
		{
			$where = ['id_order' => $id_order];
			$data['detail'] = $this->m_transaksi->orderById($where); // harus berupa object
			$this->template->load('layout/template', 'adidas/order/detail.php', $data);
		}



	public function tambahaksi_order()
    {
		$data = array (
			'order_number' => $this->input->post('order_number'),
			'costumer_code' => $this->input->post('costumer_code'),
			'costumer_name' => $this->input->post('costumer_name'),
			'article_no' => $this->input->post('article_no'),
			'color' => $this->input->post('color'),
			'age' => $this->input->post('age'),
			'working_number' => $this->input->post('working_number'),
			'item_name' => $this->input->post('item_name'),
			'exception' => $this->input->post('exception'),
			'functional' => $this->input->post('functional'),
			'hangtag' => $this->input->post('hangtag'),
			'style' => $this->input->post('style'),
			'podd' => $this->input->post('podd'),
			'lco' => $this->input->post('lco'),
			'po_quantity' =>  $this->input->post('po_quantity'),
			'production_date' => $this->input->post('production_date'),
			'season' => $this->input->post('season'),
			'size' => $this->input->post('size'),
			'line' => $this->input->post('line'),
			'factory_discleamer' => $this->input->post('factory_discleamer'),
			'brand' => $this->input->post('brand')	
		);

		$this->m_transaksi->input_order($data, 'tbl_order');

		redirect('c_transaksi/index_order');
    }

	public function tambah_order()
	{
		 $this->template->load('layout/template', 'adidas/order/tambah.php');
	}

public function import_order()
{
    ini_set('memory_limit', '4096M');
    set_time_limit(0);

    if (empty($_FILES['file']['name'])) {
        $this->session->set_flashdata('error', 'File belum dipilih.');
        redirect('c_transaksi/import');
    }

    $this->load->library('Spreadsheet_Lib');
    $path = $_FILES["file"]["tmp_name"];

    // LOAD EXCEL READ ONLY
    $spreadsheet = $this->spreadsheet_lib->loadReadOnly($path);
    $sheet       = $spreadsheet->getActiveSheet();
    $highestRow  = $sheet->getHighestDataRow();

    /* ==============================
       AMBIL ORDER_NUMBER YANG SUDAH ADA
    ============================== */
    $existing = $this->db
        ->select('order_number')
        ->where("order_number IS NOT NULL AND order_number <> ''")
        ->get('tbl_order')
        ->result_array();

    $existingOrders = array_flip(array_column($existing, 'order_number'));

    $insertBatch = [];
    $updateBatch = [];
    $batchSize   = 500;

    for ($row = 2; $row <= $highestRow; $row++) {

        $r = $sheet->rangeToArray(
            "A{$row}:W{$row}",
            null,
            true,
            false
        )[0];

        $orderNumber = trim((string) $r[0]);

        // DATA DARI EXCEL
        $data = [
            'order_number'       => $orderNumber ?: null,
            'costumer_code'      => $r[1],
            'costumer_name'      => $r[2],
            'article_no'         => $r[3],
            'color'              => $r[4],
            'age'                => $r[5],
            'working_number'     => $r[6],
            'item_name'          => $r[7],
            'exception'          => $r[8],
            'functional'         => $r[9],
            'hangtag'            => $r[10],
            'style'              => $r[11],
            'podd'               => $this->spreadsheet_lib->excelDate($r[12]),
            'lco'                => $this->spreadsheet_lib->excelDate($r[13]),
            'po_quantity'        => $r[14],
            'production_date'    => $this->spreadsheet_lib->excelDate($r[15]),
            'season'             => $r[16],
            'size'               => $r[17],
            'line'               => $r[18],
            'factory_discleamer' => $r[19],
            'brand'              => $r[20],
            'type_order'         => $r[22],
        ];

        /* ==============================
           CASE LOGIC
        ============================== */

        // 1️⃣ ORDER NUMBER KOSONG → INSERT
        if ($orderNumber === '') {

            $data['created_at'] = date('Y-m-d H:i:s');
            $insertBatch[] = $data;

        }
        // 2️⃣ ORDER NUMBER ADA
        else {

            // SUDAH ADA → UPDATE SEMUA FIELD
            if (isset($existingOrders[$orderNumber])) {

                $dataUpdate = $data;
                unset($dataUpdate['order_number']);
                $dataUpdate['updated_at'] = date('Y-m-d H:i:s');
                $dataUpdate['order_number'] = $orderNumber;

                $updateBatch[] = $dataUpdate;

            }
            // BELUM ADA → INSERT
            else {

                $data['created_at'] = date('Y-m-d H:i:s');
                $insertBatch[] = $data;

            }
        }

        // EXECUTE PER CHUNK
        if (count($insertBatch) >= $batchSize) {
            $this->db->insert_batch('tbl_order', $insertBatch);
            $insertBatch = [];
        }

        if (count($updateBatch) >= $batchSize) {
            $this->db->update_batch('tbl_order', $updateBatch, 'order_number');
            $updateBatch = [];
        }
    }

    // FLUSH SISA DATA
    if (!empty($insertBatch)) {
        $this->db->insert_batch('tbl_order', $insertBatch);
    }

    if (!empty($updateBatch)) {
        $this->db->update_batch('tbl_order', $updateBatch, 'order_number');
    }

    unset($spreadsheet);

    $this->session->set_flashdata('success', 'Data order berhasil diimport.');
    redirect('c_transaksi/index_order');
}


	public function import()
    {
        $this->template->load('layout/template', 'adidas/order/import.php');
    }

	public function get_order_ajax()
	{
		header('Content-Type: application/json');

		$limit  = $this->input->get('length');
		$start  = $this->input->get('start');
		$search = $this->input->get('search')['value'] ?? '';

		$data  = $this->m_transaksi->get_order_data($limit, $start, $search);
		$total = $this->m_transaksi->count_order_data($search);

		$result = [];
		foreach ($data as $row) {
			$result[] = [
				'id_order' => $row->id_order,
				'order_number'   => $row->order_number,
				'costumer_code' => $row->costumer_code,
				'costumer_name' => $row->costumer_name,
				'article_no' => $row->article_no,
				'color' => $row->color,
				'age' => $row->age,
				'working_number' => $row->working_number,
				'item_name' => $row->item_name,
				'exception' => $row->exception,
				'functional' => $row->functional,
				'hangtag' => $row->hangtag,
				'style' => $row->style,
				'podd' => $row->podd,
				'lco' => $row->lco,
				'po_quantity' => $row->po_quantity,
				'production_date' => $row->production_date,
				'season' => $row->season,
				'size' => $row->size,
				'line' => $row->line,
				'factory_discleamer' => $row->factory_discleamer,
				'brand' => $row->brand
				
			];
		}

		echo json_encode([
			'draw'            => intval($this->input->get('draw')),
			'recordsTotal'    => $total,
			'recordsFiltered' => $total,
			'data'            => $result
		]);
	}



	public function index_order()
	{
		//$data['orders'] = $this->m_transaksi->get_all_order();
		$this->template->load('layout/template', 'adidas/order/index.php');
	}

	public function release_action_ajax()
	{
		$id_penerimaan = $this->input->post('id_penerimaan');
		$report_no = $this->input->post('report_no');
		$date_sending = $this->input->post('date_sending');

		// Contoh: update ke tabel penerimaan
		$this->db->where('id_penerimaan', $id_penerimaan);
		$this->db->update('tbl_penerimaan', [
			'date_sending' => $date_sending,
			'status' => 'Released'
		]);

		if ($this->db->affected_rows() > 0) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error']);
		}
	}

	public function rekap_per_bulan_excel()
	{
		$this->load->model('M_transaksi');
		$data = $this->M_transaksi->get_rekap_per_bulan();

		$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

		$bulanList = [
			'01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
			'04' => 'April', '05' => 'Mei', '06' => 'Juni',
			'07' => 'Juli', '08' => 'Agustus', '09' => 'September',
			'10' => 'Oktober', '11' => 'November', '12' => 'Desember'
		];

		$sheetIndex = 0;

		foreach ($bulanList as $bln => $namaBulan) {
			$filtered = array_filter($data, function($row) use ($bln) {
				return date('Y', strtotime($row->date_test)) >= 2025 &&
					date('m', strtotime($row->date_test)) == $bln;
			});

			if (empty($filtered)) continue;

			$sheet = $sheetIndex == 0 ? 
				$spreadsheet->getActiveSheet() : 
				$spreadsheet->createSheet($sheetIndex);
			$sheet->setTitle($namaBulan . ' 2025');

			// === Ambil buyer & test unik ===
			$buyers = array_unique(array_column($filtered, 'buyer'));
			sort($buyers);
			$testList = array_unique(array_column($filtered, 'test_required'));
			sort($testList);

			$buyerCount = count($buyers);

			// === Header ===
			$sheet->setCellValue('A1', 'NO');
			$sheet->setCellValue('B1', 'TEST REQUIRED');
			$sheet->mergeCells('A1:A2');
			$sheet->mergeCells('B1:B2');

			$firstBuyerCol = 'C';
			$lastBuyerCol = chr(ord('C') + $buyerCount - 1);
			$sheet->mergeCells($firstBuyerCol . '1:' . $lastBuyerCol . '1');
			$sheet->setCellValue($firstBuyerCol . '1', 'BUYER');

			$col = 'C';
			foreach ($buyers as $buyer) {
				$sheet->setCellValue($col . '2', strtoupper($buyer));
				$col++;
			}

			// Tambahkan kolom TOTAL & %
			$sheet->setCellValue($col . '1', 'TOTAL');
			$sheet->mergeCells($col . '1:' . $col . '2');
			$colPersen = chr(ord($col) + 1);
			$sheet->setCellValue($colPersen . '1', '%');
			$sheet->mergeCells($colPersen . '1:' . $colPersen . '2');
			$lastBuyerCol = $colPersen;

			// Style header
			$sheet->getStyle('A1:' . $lastBuyerCol . '2')->getFont()->setBold(true);
			$sheet->getStyle('A1:' . $lastBuyerCol . '2')->getAlignment()
				->setHorizontal('center')->setVertical('center');
			$sheet->getStyle('A1:' . $lastBuyerCol . '2')->getBorders()->getAllBorders()
				->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

			// === Isi data ===
			$rowNum = 3;
			$no = 1;
			$chartData = [];

			foreach ($testList as $test) {
				$sheet->setCellValue('A' . $rowNum, $no++);
				$sheet->setCellValue('B' . $rowNum, $test);

				$col = 'C';
				$totalPerTest = 0;

				foreach ($buyers as $buyer) {
					$count = count(array_filter($filtered, function ($r) use ($test, $buyer) {
						return $r->test_required == $test && $r->buyer == $buyer;
					}));
					$sheet->setCellValue($col . $rowNum, $count > 0 ? $count : 0);
					$totalPerTest += $count;
					$col++;
				}

				// total per test
				$sheet->setCellValue($col . $rowNum, $totalPerTest);
				$chartData[] = ['test' => $test, 'total' => $totalPerTest];

				$rowNum++;
			}

			// === Baris total per buyer ===
			$sheet->setCellValue('A' . $rowNum, 'TOTAL');
			$sheet->mergeCells('A' . $rowNum . ':B' . $rowNum);
			$grandTotal = 0;

			$col = 'C';
			foreach ($buyers as $buyer) {
				$totalBuyer = 0;
				foreach ($testList as $test) {
					$count = count(array_filter($filtered, function ($r) use ($test, $buyer) {
						return $r->test_required == $test && $r->buyer == $buyer;
					}));
					$totalBuyer += $count;
				}
				$sheet->setCellValue($col . $rowNum, $totalBuyer);
				$grandTotal += $totalBuyer;
				$col++;
			}
			$sheet->setCellValue($col . $rowNum, $grandTotal);

			// === Hitung & isi kolom persentase ===
			foreach ($chartData as $i => $cd) {
				$rowPersen = 3 + $i;
				$percent = $grandTotal > 0 ? ($cd['total'] / $grandTotal) * 100 : 0;
				$sheet->setCellValue($colPersen . $rowPersen, round($percent, 2) . '%');
			}

			// Style tabel
			$sheet->getStyle('A1:' . $lastBuyerCol . $rowNum)->getBorders()->getAllBorders()
				->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

			// Auto width
			foreach (range('A', $lastBuyerCol) as $col) {
				$sheet->getColumnDimension($col)->setAutoSize(true);
			}

		// === Chart di bawah tabel ===
		$chartStartRow = $rowNum + 2;
		$dataStart = 3;
		$dataEnd = $rowNum - 1;
		$labelCol = 'B';
		$valueCol = chr(ord($lastBuyerCol) - 1); // kolom TOTAL
		$percentCol = $lastBuyerCol; // kolom %

		$dataSeriesLabels = [
			new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('String', "'".$sheet->getTitle()."'!$valueCol$2", null, 1),
		];
		$xAxisTickValues = [
			new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('String', "'".$sheet->getTitle()."'!$labelCol$dataStart:$labelCol$dataEnd", null, count($chartData)),
		];
		$dataSeriesValues = [
			new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('Number', "'".$sheet->getTitle()."'!$valueCol$dataStart:$valueCol$dataEnd", null, count($chartData)),
		];

		// === Gantikan DataLabels (versi lama tidak support) ===
		$series = new \PhpOffice\PhpSpreadsheet\Chart\DataSeries(
			\PhpOffice\PhpSpreadsheet\Chart\DataSeries::TYPE_BARCHART,
			\PhpOffice\PhpSpreadsheet\Chart\DataSeries::GROUPING_CLUSTERED,
			range(0, count($dataSeriesValues) - 1),
			$dataSeriesLabels,
			$xAxisTickValues,
			$dataSeriesValues
		);
		$series->setPlotDirection(\PhpOffice\PhpSpreadsheet\Chart\DataSeries::DIRECTION_COL);

		$plotArea = new \PhpOffice\PhpSpreadsheet\Chart\PlotArea(null, [$series]);
		$chartTitle = new \PhpOffice\PhpSpreadsheet\Chart\Title('Persentase Pengujian - ' . $namaBulan . ' 2025');

		$chart = new \PhpOffice\PhpSpreadsheet\Chart\Chart(
			'chart1',
			$chartTitle,
			null,
			$plotArea
		);

		$chart->setTopLeftPosition('B' . ($rowNum + 2));
		$chart->setBottomRightPosition('L' . ($rowNum + 20));
		$sheet->addChart($chart);

				$sheetIndex++;
			}

			$spreadsheet->setActiveSheetIndex(0);

			$filename = 'Rekapan_Pengujian_Per_Bulan.xlsx';
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="' . $filename . '"');
			header('Cache-Control: max-age=0');

			$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$writer->setIncludeCharts(true);
			$writer->save('php://output');
	}


public function dashboard_excel()
{
    $data['total'] = $this->m_transaksi->get_summary_by_buyer();

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Summary');

    // === HEADER FORM ===
    $sheet->mergeCells('B1:F1');
    $sheet->setCellValue('B1', 'FORMULIR / FORM');
    $sheet->getStyle('B1')->getFont()->setBold(true)->setSize(14);
    $sheet->getStyle('B1')->getAlignment()->setHorizontal('center');

    $sheet->mergeCells('B2:F2');
    $sheet->setCellValue('B2', 'DEPARTEMEN LABORAT / LABORATORY DEPARTMENT');
    $sheet->getStyle('B2')->getAlignment()->setHorizontal('center');

    $sheet->mergeCells('B3:F3');
    $sheet->setCellValue('B3', 'REKAPAN PENERIMAAN SAMPLE / SAMPLE RECEIPT SUMMARY');
    $sheet->getStyle('B3')->getFont()->setBold(true);
	$sheet->getStyle('B3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
	//$sheet->getStyle('B4')->getAlignment()->setHorizontal('center')->getFont()->setBold(true);

    $sheet->setCellValue('B6', 'BULAN / MONTH : ' . strtoupper(date('F Y')));

    // === HEADER TABEL ===
    $headerRow = 8;
    $sheet->setCellValue('B' . $headerRow, 'NO');
    $sheet->setCellValue('C' . $headerRow, 'BUYER');
    $sheet->setCellValue('D' . $headerRow, 'SAMPEL DI TERIMA / SAMPLE RECEIVED');
    $sheet->setCellValue('E' . $headerRow, 'SAMPEL SELESAI SESUAI TIMELINE / SAMPLE COMPLETED AS PER TIMELINE');
    $sheet->setCellValue('F' . $headerRow, 'SAMPEL SELESAI MELEBIHI TIMELINE / SAMPLE COMPLETED BEYOND THE TIMELINE');

    $sheet->getStyle("B{$headerRow}:F{$headerRow}")->applyFromArray([
        'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
        'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'CFE2F3']
        ],
        'borders' => [
            'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
        ]
    ]);

    // === ISI DATA ===
    $row = $headerRow + 1;
    $no = 1;
    $total_sample = 0;
    $total_sesuai = 0;
    $total_melebihi = 0;

    foreach ($data['total'] as $d) {
        $sheet->setCellValue("B{$row}", $no++);
        $sheet->setCellValue("C{$row}", $d->buyer);
        $sheet->setCellValue("D{$row}", $d->total_sample);
        $sheet->setCellValue("E{$row}", $d->sesuai_timeline);
        $sheet->setCellValue("F{$row}", $d->melebihi_timeline);

        $sheet->getStyle("B{$row}:F{$row}")->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center']
        ]);

        $total_sample += $d->total_sample;
        $total_sesuai += $d->sesuai_timeline;
        $total_melebihi += $d->melebihi_timeline;

        $row++;
    }

    // === GRAND TOTAL ===
    $sheet->setCellValue("C{$row}", 'GRAND TOTAL');
    $sheet->setCellValue("D{$row}", $total_sample);
    $sheet->setCellValue("E{$row}", $total_sesuai);
    $sheet->setCellValue("F{$row}", $total_melebihi);
    $sheet->getStyle("B{$row}:F{$row}")->applyFromArray([
        'font' => ['bold' => true],
        'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'D9EAD3']
        ]
    ]);

    // === PERSENTASE ===
    $row++;
    $sheet->setCellValue("C{$row}", 'PERSENTASE / PERCENTAGE');
    $sheet->setCellValue("D{$row}", '100%');
    $sheet->setCellValue("E{$row}", $total_sample ? round(($total_sesuai / $total_sample) * 100, 2) . '%' : '0%');
    $sheet->setCellValue("F{$row}", $total_sample ? round(($total_melebihi / $total_sample) * 100, 2) . '%' : '0%');
    $sheet->getStyle("B{$row}:F{$row}")->applyFromArray([
        'font' => ['bold' => true, 'color' => ['rgb' => '0B5394']],
        'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
    ]);

    // Auto width
    foreach (range('B', 'F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // === SHEET 2: PIE CHART ===
    $chartSheet = $spreadsheet->createSheet();
    $chartSheet->setTitle('Chart');

    $chartSheet->setCellValue('B2', 'PERSENTASE SAMPEL YANG DITERIMA / PERCENTAGE OF SAMPLES RECEIVED');
    $chartSheet->mergeCells('B2:F2');
    $chartSheet->getStyle('B2')->getFont()->setBold(true)->setSize(12);
    $chartSheet->getStyle('B2')->getAlignment()->setHorizontal('center');

    // Masukkan data untuk chart
    $chartRow = 4;
    $chartSheet->setCellValue("B{$chartRow}", 'Buyer');
    $chartSheet->setCellValue("C{$chartRow}", 'Total Sample');
    $chartRow++;
    foreach ($data['total'] as $d) {
        $chartSheet->setCellValue("B{$chartRow}", $d->buyer);
        $chartSheet->setCellValue("C{$chartRow}", $d->total_sample);
        $chartRow++;
    }

    // Buat pie chart
    $dataSeriesLabels = [new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('String', 'Chart!$C$4', null, 1)];
    $xAxisTickValues = [new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('String', 'Chart!$B$5:$B$' . ($chartRow - 1), null, 4)];
    $dataSeriesValues = [new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('Number', 'Chart!$C$5:$C$' . ($chartRow - 1), null, 4)];

    $series = new \PhpOffice\PhpSpreadsheet\Chart\DataSeries(
        \PhpOffice\PhpSpreadsheet\Chart\DataSeries::TYPE_PIECHART,
        null,
        range(0, count($dataSeriesValues) - 1),
        $dataSeriesLabels,
        $xAxisTickValues,
        $dataSeriesValues
    );

    $layout = new \PhpOffice\PhpSpreadsheet\Chart\Layout();
    $layout->setShowPercent(true);

    $plotArea = new \PhpOffice\PhpSpreadsheet\Chart\PlotArea($layout, [$series]);
    $chartTitle = new \PhpOffice\PhpSpreadsheet\Chart\Title('Percentage of Samples Received');
    $chart = new \PhpOffice\PhpSpreadsheet\Chart\Chart(
        'chart1',
        $chartTitle,
        null,
        $plotArea
    );

    $chart->setTopLeftPosition('E6');
    $chart->setBottomRightPosition('M25');
    $chartSheet->addChart($chart);

    // === EXPORT ===
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="REKAPAN PENERIMAAN SAMPLE.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->setIncludeCharts(true);
    $writer->save('php://output');
    exit;
}


	public function d_sampleterima()
	{
		//$data['detail'] = $this->m_transaksi->getDetailSesuaiTimeline();
		$data['detail'] = $this->m_transaksi->get_detail_semua_timeline();
		$this->template->load('layout/template','adidas/d_sampleterima', $data);
	}

	public function d_melebihitimeline()
	{
		//$data['detail'] = $this->m_transaksi->getDetailSesuaiTimeline();
		$data['detail'] = $this->m_transaksi->get_detail_melebihi_timeline();
		$this->template->load('layout/template','adidas/d_melebihitimeline', $data);
	}

	
	public function d_sesuaitimeline()
	{
		//$data['detail'] = $this->m_transaksi->getDetailSesuaiTimeline();
		$data['detail'] = $this->m_transaksi->get_detail_sesuai_timeline();
		$this->template->load('layout/template','adidas/d_sesuaitimeline', $data);
	}

	public function assign_index($id_penerimaan = null, $report_no = null)
	{
		if ($id_penerimaan && $report_no) {
			// Mode edit: ambil data berdasarkan id_penerimaan dan report_no
			$data['hasil'] = $this->m_transaksi->get_assign_by_id($id_penerimaan, $report_no);
		} else {
			// Mode normal: tampilkan semua data
			$data['hasil'] = $this->m_transaksi->get_assign();
		}

	$this->template->load('layout/template', 'adidas/report/assign.php', $data);

	}


		public function kirim_ulang($id_kualitas, $id_penerimaan)
		{
			// Update status di tabel kualitas
			$this->db->where('id_kualitas', $id_kualitas);
			$this->db->where('id_penerimaan', $id_penerimaan);
			$this->db->update('tbl_kualitas', ['status' => 'kembali']);

			// Hapus date_final di report_handlingsample supaya dianggap belum selesai lagi
			$this->db->where('id_penerimaan', $id_penerimaan);
			$this->db->update('report_handlingsample', ['date_final' => NULL]);

			// (opsional) Kalau ada status lain yang perlu di-reset
			// $this->db->update('report_handlingsample', ['result_status' => NULL]);

			$this->session->set_flashdata('success', 'Data berhasil dikirim ulang ke Kualitas.');
			redirect('c_transaksi/index_report');
		}



	private function checkAndInsertFinalHandling($id_penerimaan, $report_no)
	{
		// Cek apakah masih ada yang belum selesai di tbl_kualitas
		$this->db->where('id_penerimaan', $id_penerimaan);
		$this->db->where('status !=', 'selesai');
		$sisa_kualitas = $this->db->count_all_results('tbl_kualitas');
		if ($sisa_kualitas > 0) return;

		// Cek jumlah handlingsample
		$this->db->where('id_penerimaan', $id_penerimaan);
		$total_handlingsample = $this->db->count_all_results('report_handlingsample');
		if ($total_handlingsample == 0) return;

		// Cek apakah semuanya sudah punya date_final
		$this->db->where('id_penerimaan', $id_penerimaan);
		$this->db->where("date_final IS NOT NULL", null, false);
		$this->db->where("date_final != '0000-00-00'", null, false);
		$this->db->where("date_final != ''", null, false);
		$jumlah_final = $this->db->count_all_results('report_handlingsample');

		if ($jumlah_final != $total_handlingsample) return;

		// Ambil semua id_reportkualitas untuk status hasil akhir
		$this->db->select('id_reportkualitas');
		$this->db->where('id_penerimaan', $id_penerimaan);
		$rows = $this->db->get('report_handlingsample')->result();

		$test_result = 'pass';
		foreach ($rows as $row) {
			if (!empty($row->id_reportkualitas)) {
				$this->db->where('id_reportkualitas', $row->id_reportkualitas);
				$this->db->where('status', 'fail');
				$fail = $this->db->count_all_results('report_kualitas');
				if ($fail > 0) {
					$test_result = 'fail';
					break;
				}
			}
		}

		// Cek dan insert jika belum ada
		$this->db->where('id_penerimaan', $id_penerimaan);
		$existing = $this->db->get('report_finalhandling')->row();

		if (!$existing) {
			$data = [
				'id_penerimaan' => $id_penerimaan,
				'report_no' => $report_no,
				'date_final' => date('Y-m-d H:i:s'),
				'test_result' => $test_result,
				'jumlah_pengetesan' => $total_handlingsample
			];
			$this->db->insert('report_finalhandling', $data);
		}
	}

	public function index_supplier()
	{
		$data['supplier'] = $this->m_transaksi->indexSupplier()->result();
		$this->template->load('layout/template','masterData/supplier/index.php', $data);	
	}

	public function insert_supplier()
	{
		$this->template->load('layout/template','masterData/supplier/tambah.php');
	}

	public function tambahaksi_supplier()
	{
		$data = array (
			'supplier_code' => $this->input->post('supplier_code'),
			'supplier_name' => $this->input->post('supplier_name')
		);

		$this->m_transaksi->insertSupplier($data,'m_supplier');

		redirect('c_transaksi/index_supplier');
	}

	public function edit_supplier($id_supplier)
	{
		$where = array('id_supplier' => $id_supplier);
		 $data['edit'] = $this->m_transaksi->getByIdSupplier($where, 'm_supplier')->result();
		$this->template->load('layout/template','masterData/supplier/edit.php', $data);
	}

	public function editaksi_supplier()
	{
		$id_supplier = $this->input->post('id_supplier');
		$supplier_code = $this->input->post('supplier_code');
		$supplier_name = $this->input->post('supplier_name');

		$data = array(
			'id_supplier' => $id_supplier,
			'supplier_code' => $supplier_code,
			'supplier_name' => $supplier_name
		);

		$this->m_transaksi->updateSupplier($id_supplier, $data);
		redirect('c_transaksi/index_supplier', $data);
	}

	public function delete_supplier($id_supplier)
	{
		$this->db->where('id_supplier', $id_supplier);
		$this->db->delete('m_supplier');

		redirect('c_transaksi/index_supplier');
	}

	// Adidas

	public function index_barcode()
	{
		$this->load->view('adidas/barcode/index.php');
	}

	public function index_bcKualitas($report_no)
	{
		// 🔒 Cek apakah user sudah login
		if (!$this->session->userdata('user_logged_in')) {
			$this->session->set_userdata('redirect_after_login', current_url());
			redirect('auth/login_scan_page');
		}

		$user_level = $this->session->userdata('level');

		// Load model
		$this->load->model('m_transaksi');

		// 🔀 Ambil data berdasarkan level
		if ($user_level == 1 || $user_level == 7) {
			$report_data = $this->m_transaksi->get_kualitas_reportno($report_no, 'belum');
			$report_type = 'kualitas';
		} elseif ($user_level == 10 || $user_level == 1) {
			$report_data = $this->m_transaksi->getReportSampleByReportNo($report_no, 'selesai');
			$report_type = 'handling_sample';
		}else {
				show_error('Anda tidak memiliki akses ke halaman ini.', 403, 'Akses Ditolak');
			return;
		}

		// Ambil header untuk semua level (optional)
		$report_header = $this->m_transaksi->get_penerimaan_by_reportno($report_no);

		// Kirim data ke view
		$data['report_header']     = $report_header;
		$data['report_data']       = $report_data;
		$data['report_type']       = $report_type;
		$data['user_level']        = $user_level;

		$this->load->view('adidas/kualitas/bc_kualitas', $data);
	}



	public function login_adidas()
	{
		$this->load->view('adidas/login/login.php');
	}

		public function index()
		{

			$penerimaan_per_bulan = array_reverse($this->m_transaksi->getPenerimaanPerBulan());

			$bulan  = [];
			$jumlah = [];

			foreach ($penerimaan_per_bulan as $row) {
				if (empty($row->bulan) || $row->bulan === '0000-00') continue; // skip data rusak

				$bulan[]  = date('F Y', strtotime($row->bulan . '-01'));
				$jumlah[] = (int)$row->total;
			}

			$data['penerimaan_bulan_labels']  = $bulan;
			$data['penerimaan_bulan_values']  = $jumlah;

			$data['total_penerimaan'] = $this->m_transaksi->getTotalPenerimaan();
			$data['penerimaan'] = $this->m_transaksi->getPenerimaan()->result();
			$buyer = $this->m_transaksi->getBuyerChart();
			$timeline = $this->m_transaksi->getTimelineStatus();
			$labels = [];	
			$values = [];
			$timeline_labels = [];
			$timeline_values = [];
			$statusCount = [
							'Sesuai Timeline' => 0,
							'Melebihi Timeline' => 0,
							'Belum Selesai' => 0
						];

			foreach ($timeline as $row) {
				$timeline_labels[] = $row->status;
				$timeline_values[] = $row->total;
				$statusCount[$row->status] = $row->total;
			}

			foreach ($buyer as $row){
				$labels[] = $row->buyer;
				$values[] = $row->total;
			}

			$data['labels'] = $labels;
			$data['values'] = $values;

			$data['timeline_labels'] = $timeline_labels;
			$data['timeline_values'] = $timeline_values;
			$data['timeline_count'] = $statusCount;
			
			$this->template->load('layout/template','adidas/dashboard', $data);
		}

	public function index_reportAll()
	{
		//$data['hasil'] = $this->m_transaksi->get_pengujian_selesai();
		$data['hasil'] = $this->m_transaksi->get_pengujian_selesai();
		//$data['report_final'] = $this->m_transaksi->getReportFinal()->result();
		$this->template->load('layout/template','adidas/report/indexAll.php', $data);
	}

	public function index_report()
	{
		$data['report'] = $this->m_transaksi->getReportSample()->result();
		$this->template->load('layout/template','adidas/report/index.php', $data);
	}
	public function index_penerimaan()
	{
		$data['penerimaan'] = $this->m_transaksi->getPenerimaan()->result();
		$this->template->load('layout/template','adidas/penerimaan/index.php', $data);
	}

	public function hapus_penerimaan($id)
	{
		$this->load->model('m_transaksi');

		// Cek apakah id_penerimaan sudah dipakai di report_handlingsample
		$dipakai_di_handlingsample = $this->db
			->where('id_penerimaan', $id)
			->count_all_results('report_handlingsample');

		// Cek apakah id_penerimaan sudah dipakai di report_kualitas
		$dipakai_di_kualitas = $this->db
			->where('id_penerimaan', $id)
			->count_all_results('report_kualitas');

		if ($dipakai_di_handlingsample > 0 || $dipakai_di_kualitas > 0) {
			$this->session->set_flashdata('error', 'Data tidak dapat dihapus karena sudah digunakan di report.');
			redirect('c_transaksi/daftar_penerimaan');
			return;
		}

		// Jika aman, hapus dari tabel anak dulu
		$this->db->where('id_penerimaan', $id);
		$this->db->delete('tbl_kualitas');

		// Kemudian hapus dari tabel penerimaan
		$this->db->where('id_penerimaan', $id);
		$this->db->delete('tbl_penerimaan');

		$this->session->set_flashdata('success', 'Data penerimaan berhasil dihapus.');
		redirect('c_transaksi/index_penerimaan');
	}

	public function tambah_penerimaan()
{
    $this->load->model('m_transaksi');
    
    $data['supplier'] = $this->m_transaksi->getSupplier()->result();
    $data['user'] = $this->m_login->current_user();
    $data['idPenerimaan'] = $this->m_transaksi->kodePenerimaan();
    $data['idKualitas'] = $this->m_transaksi->kodeKualitas();
    $data['department'] = $this->m_transaksi->getDepartment()->result();
    $data['email'] = $this->m_transaksi->getEmail()->result();
    $data['material'] = $this->m_transaksi->getMaterial()->result();
    $data['oekotex'] = $this->m_transaksi->getOekotex()->result();
    $data['stages'] = $this->m_transaksi->getStages()->result();
    $data['size'] = $this->m_transaksi->getSizecategory()->result();
    $data['washing'] = $this->m_transaksi->getCareWashing();
    $data['bleching'] = $this->m_transaksi->getCareBleching();
    $data['drying'] = $this->m_transaksi->getCareDrying();
    $data['profess'] = $this->m_transaksi->getCareProfess();
    $data['ironing'] = $this->m_transaksi->getCareIroning();
 	$data['producttype'] = $this->m_transaksi->tampil_producttype()->result();
	$data['regulation'] = $this->m_transaksi->get_regulation()->result();
    // Tambahkan data order untuk dropdown
    $data['order'] = $this->m_transaksi->getAllOrders()->result();

	// TEST REQUIRED
    $testReq = $this->m_transaksi->getTestRequiredPenerimaan();

    $total = count($testReq);
    $perColumn = ceil($total / 3);

    $data['test_required_columns'] = array_chunk($testReq, $perColumn);

    $this->template->load('layout/template','adidas/penerimaan/tambah.php', $data);
}

	public function tambahaksi_penerimaan()
	{
		// ===============================
		// 1. Generate QR Code Data
		// ===============================
		$qrcode_data = $this->_generate_data_qrcode();

		// ===============================
		// 2. Ambil & rapikan input array
		// ===============================
		$test_required = $this->input->post('test_required');
		$color         = $this->input->post('color');
		$color_of      = $this->input->post('color_of');
		//$color_of_name = $this->input->post('color_of_name');

		$test_required = is_array($test_required)
		? array_values(array_filter($test_required, function ($v) {
			return trim($v) !== '';
		}))
		: [];

		$color = is_array($color)
			? array_values(array_filter($color, function ($v) {
				return trim($v) !== '';
			}))
			: [];

		$color_of = is_array($color_of)
			? array_values(array_filter($color_of, function ($v) {
				return trim($v) !== '';
			}))
			: [];

		// Encode ke JSON
		$test_required_json = json_encode($test_required);
		$color_json         = json_encode($color);
		$color_of_json      = json_encode ($color_of);
		//$color_of_name_json = json_encode($color_of_name);

		// ===============================
		// 3. Upload Image 
		// ===============================
		$image_path = null;

		if (!empty($_FILES['image_path']['name'])) {

			$config = [
				'upload_path'   => FCPATH . 'images/sample_photo/',
				'allowed_types' => 'jpg|jpeg|png|gif',
				'max_size'      => 5000,
				'file_name'     => time() . '_' . $_FILES['image_path']['name']
			];

			$this->load->library('upload');
			$this->upload->initialize($config);

			if ($this->upload->do_upload('image_path')) {
				$uploaded_data = $this->upload->data();
				$image_path = $uploaded_data['file_name'];
			} else {
				show_error($this->upload->display_errors());
				return;
			}

		} else {
			$image_path = $this->input->post('existing_image_path');
		}

		// ===============================
		// 4. Simpan ke tbl_penerimaan
		// ===============================
		$penerimaan = [
			'id_penerimaan' => $this->m_transaksi->kodePenerimaan(),

			'applicant' => $this->input->post('applicant'),
			'department' => $this->input->post('department'),
			'telephone' => $this->input->post('telephone'),
			'email' => $this->input->post('email'),
			'buyer' => $this->input->post('buyer'),
			'datetime_received' => $this->input->post('datetime_received'),
			'received_sample_by' => $this->input->post('received_sample_by'),
			'sample_description' => $this->input->post('sample_description'),
			'batch_lot' => $this->input->post('batch_lot'),
			'order_number' => $this->input->post('order_number'),
			'other_order_number' => $this->input->post('other_order_number'),
			'code_of_fabric' => $this->input->post('code_of_fabric'),
			'initial_width' => $this->input->post('initial_width'),
			'request_width' => $this->input->post('request_width'),
			'finished_width' => $this->input->post('finished_width'),
			'request_fabric' => $this->input->post('request_fabric'),
			'finish_fabric' => $this->input->post('finish_fabric'),
			'dyeing_number' => $this->input->post('dyeing_number'),
			'production_number' => $this->input->post('production_number'),
			'country_destination' => $this->input->post('country_destination'),
			'product_end' => $this->input->post('product_end'),
			'article_no' => $this->input->post('article_no'),
			'item_no' => $this->input->post('item_no'),
			'style_no' => $this->input->post('style_no'),
			'season' => $this->input->post('season'),
			'approved_date' => $this->input->post('approved_date'),
			'supplier_name' => $this->input->post('supplier_name'),
			'size' => $this->input->post('size'),
			'brands' => $this->input->post('brands'),
			'material_id' => $this->input->post('material_id'),
			'temperature_process' => $this->input->post('temperature_process'),
			'technique_print' => $this->input->post('technique_print'),
			'country_origin' => $this->input->post('country_origin'),
			'oekotex' => $this->input->post('oekotex'),
			'number_sample' => $this->input->post('number_sample'),
			'quantity_sample' => $this->input->post('quantity_sample'),
			'tod' => $this->input->post('tod'),
			'report_no' => $this->input->post('report_no'),
			'color_of_name' => $this->input->post('color_of_name'),

			// ✅ SEMUA ARRAY
			'test_required' => $test_required_json,
			'color'         => $color_json,
			'color_of'		=> $color_of_json,
			//'color_of_name' => $color_of_name_json,

			'compotition' => $this->input->post('compotition'),
			'stage' => $this->input->post('stage'),
			'size_category' => $this->input->post('size_category'),
			'sample_no' => $this->input->post('sample_no'),
			'other_sampleno' => $this->input->post('other_sampleno'),
			'washing' => $this->input->post('washing'),
			'bleach' => $this->input->post('bleach'),
			'drying' => $this->input->post('drying'),
			'ironing' => $this->input->post('ironing'),
			'profess' => $this->input->post('profess'),

			'qrcode_path' => $this->_generate_qrcode(
				$this->input->post('report_no'),
				$qrcode_data
			),
			'qrcode_data' => $qrcode_data,
			'image_path'  => $image_path
		];

		$this->m_transaksi->insertPenerimaan($penerimaan);

		// ===============================
		// 5. Redirect
		// ===============================
		redirect('c_transaksi/index_penerimaan');
	}

	
	public function editaksi_penerimaan()
	{
		$id_penerimaan = $this->input->post('id_penerimaan');

		// Generate data QR code
		$qrcode_data = $this->_generate_data_qrcode();

		/* ===============================
		UPLOAD IMAGE
		=============================== */
		$image_upload = $_FILES['image_path'];
		if (isset($image_upload) && $image_upload['error'] == 0) {
			$config = array(
				'upload_path'   => FCPATH . 'images/sample_photo/',
				'allowed_types' => 'jpg|jpeg|png|gif',
				'max_size'      => 5000,
				'file_name'     => time() . '_' . $image_upload['name'],
			);
			$this->load->library('upload');
			$this->upload->initialize($config);

			if ($this->upload->do_upload('image_path')) {
				$uploaded_data = $this->upload->data();
				$image_path = $uploaded_data['file_name'];
			} else {
				echo "Error: " . $this->upload->display_errors();
				return;
			}
		} else {
			$image_path = $this->input->post('existing_image_path') ?? null;
		}

		/* ===============================
		UPDATE PENERIMAAN
		=============================== */
		$penerimaan = array(
			'applicant'            => $this->input->post('applicant'),
			'department'           => $this->input->post('department'),
			'telephone'            => $this->input->post('telephone'),
			'email'                => $this->input->post('email'),
			'buyer'                => $this->input->post('buyer'),
			'datetime_received'    => $this->input->post('datetime_received'),
			'received_sample_by'   => $this->input->post('received_sample_by'),
			'sample_description'   => $this->input->post('sample_description'),
			'batch_lot'            => $this->input->post('batch_lot'),
			'order_number'         => $this->input->post('order_number'),
			'other_order_number'   => $this->input->post('other_order_number'),
			'code_of_fabric'       => $this->input->post('code_of_fabric'),
			'initial_width'        => $this->input->post('initial_width'),
			'request_width'        => $this->input->post('request_width'),
			'finished_width'       => $this->input->post('finished_width'),
			'request_fabric'       => $this->input->post('request_fabric'),
			'finish_fabric'        => $this->input->post('finish_fabric'),
			'dyeing_number'        => $this->input->post('dyeing_number'),
			'production_number'    => $this->input->post('production_number'),
			'country_destination'  => $this->input->post('country_destination'),
			'product_end'          => $this->input->post('product_end'),
			'article_no'           => $this->input->post('article_no'),
			'item_no'              => $this->input->post('item_no'),
			'style_no'             => $this->input->post('style_no'),
			'season'               => $this->input->post('season'),
			'approved_date'        => $this->input->post('approved_date'),
			'supplier_name'        => $this->input->post('supplier_name'),
			'size'                 => $this->input->post('size'),
			'brands'               => $this->input->post('brands'),
			'material_id'          => $this->input->post('material_id'),
			'temperature_process'  => $this->input->post('temperature_process'),
			'technique_print'      => $this->input->post('technique_print'),
			'country_origin'       => $this->input->post('country_origin'),
			'oekotex'               => $this->input->post('oekotex'),
			'number_sample'        => $this->input->post('number_sample'),
			'quantity_sample'      => $this->input->post('quantity_sample'),
			'tod'                  => $this->input->post('tod'),
			'report_no'            => $this->input->post('report_no'),
			'color_of_name'        => $this->input->post('color_of_name'),
			'compotition'          => $this->input->post('compotition'),
			'stage'                => $this->input->post('stage'),
			'size_category'        => $this->input->post('size_category'),
			'sample_no'            => $this->input->post('sample_no'),
			'other_sampleno'       => $this->input->post('other_sampleno'),
			'washing'              => $this->input->post('washing'),
			'bleach'               => $this->input->post('bleach'),
			'drying'               => $this->input->post('drying'),
			'ironing'              => $this->input->post('ironing'),
			'profess'              => $this->input->post('profess'),
			'qrcode_path'          => $this->_generate_qrcode($this->input->post('report_no'), $qrcode_data),
			'qrcode_data'          => $qrcode_data,
			'image_path'           => $image_path
		);

		$this->m_transaksi->updatePenerimaan($id_penerimaan, $penerimaan);

		/* ===============================
		TAMBAH KUALITAS (HANYA YANG BARU)
		=============================== */
		$color         = $this->input->post('color');
		$color_of      = $this->input->post('color_of');
		$test_required = $this->input->post('test_required');

		if (is_array($test_required)) {
		$test_required = array_filter($test_required, function ($v) {
			return trim($v) !== '';
		});
	}

		// ambil test yang sudah ada di kualitas
		$existing_tests = $this->m_transaksi
			->getTestRequiredByPenerimaan($id_penerimaan);

		// cari yang baru ditambahkan
		$new_tests = array_diff($test_required, $existing_tests);

		// insert hanya yang baru
		if (is_array($color) && is_array($color_of) && !empty($new_tests)) {
			for ($i = 0; $i < count($color); $i++) {
				$c  = $color[$i] ?? '';
				$co = $color_of[$i] ?? '';

				foreach ($new_tests as $t) {
					$this->m_transaksi->saveKualitas(
						$t,
						$c,
						$co,
						$this->input->post('id_kualitas'),
						$this->input->post('color_of_name'),
						$id_penerimaan,
						$this->input->post('report_no')
					);
				}
			}
		}

		redirect('c_transaksi/index_penerimaan');
	}

	public function update_penerimaan()
	{
		$id = $this->input->post('id_penerimaan');

		// QR code baru (jika perlu)
		$qrcode_data = $this->_generate_data_qrcode();

		// Upload gambar jika ada yang baru
		$image_upload = $_FILES['image_path'];
		if (isset($image_upload) && $image_upload['error'] == 0) {
			$config = array(
				'upload_path' => FCPATH . 'images/',
				'allowed_types' => 'jpg|jpeg|png|gif',
				'max_size' => 5000,
				'file_name' => time() . '_' . $image_upload['name'],
			);
			$this->load->library('upload');
			$this->upload->initialize($config);

			if ($this->upload->do_upload('image_path')) {
				$uploaded_data = $this->upload->data();
				$image_path = $uploaded_data['file_name'];
			} else {
				echo "Upload Error: " . $this->upload->display_errors();
				return;
			}
		} else {
			$image_path = $this->input->post('old_image_path'); // pakai yang lama
		}

		// Ambil dan simpan data utama penerimaan
		$penerimaan = array(
			'applicant' => $this->input->post('applicant'),
			// tambahkan semua field yang kamu perlukan
			'qrcode_path' => $this->_generate_qrcode($this->input->post('report_no'), $qrcode_data),
			'qrcode_data' => $qrcode_data,
			'image_path' => $image_path
		);

		$this->m_transaksi->updatePenerimaan($id, $penerimaan);

		// Hapus semua data kombinasi sebelumnya lalu tambahkan ulang (jika pakai relasi)
		$colors = $this->input->post('color');
		$tests = $this->input->post('test_required');

		if (is_array($colors) && is_array($tests)) {
			$this->m_transaksi->deleteKualitasByPenerimaan($id);

			foreach ($colors as $c) {
				foreach ($tests as $t) {
					$this->m_transaksi->saveKualitas(
						$t,
						$c,
						$this->input->post('color_of'),
						$this->input->post('id_kualitas'),
						$this->input->post('color_of_name'),
						$id,
						$this->input->post('report_no')
					);
				}
			}
		}

		redirect('c_transaksi/index_penerimaan');
	}

	public function _generate_data_qrcode()
    {
        $this->load->helper('string');
        $code = strtoupper(random_string('alnum', 6));
        $cek_data = $this->get_data($code);
        if(!empty($cek_data)){
            $code = substr_replace($code, count($cek_data)+1,5);
        }
        return $code;
    }

	public function _generate_qrcode($report_no)
{
    $this->load->library('ciqrcode');
    $directory = "./img_qrcode";

    if (!is_dir($directory)) {
        mkdir($directory, 0777, TRUE);
    }

    // Buat kode unik untuk redirect
    $kode_unik = substr(md5($report_no . time()), 0, 8); // atau bisa gunakan UUID/random string

    // Simpan ke database redirect (hanya jika belum ada)
    $this->load->model('m_transaksi');
    $this->m_transaksi->insert_barcode_redirect($kode_unik, $report_no);

	
	// Tentukan IP server (ganti dengan IP server Anda)
	$ip_server = 'http://172.23.10.124';  // Ganti dengan IP server Anda

	$url_redirect = rtrim($ip_server, '/') . '/handlingsample/index.php/barcode/' . $kode_unik;
	//$url_redirect = base_url('index.php/barcode/' . $kode_unik);

    $image_name = strtolower($report_no) . rand(100, 999) . '.png';

    $config['cacheable'] = true;
    $config['quality'] = true;
    $config['size'] = 512;
    $config['black'] = array(224, 255, 255);
    $config['white'] = array(70, 130, 180);
    $this->ciqrcode->initialize($config);

    $params['data'] = $url_redirect;
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = $directory . '/' . $image_name;

    $this->ciqrcode->generate($params);

    return $image_name;
}


	/*public function _generate_qrcode($report_no, $data_code)
	{
		$this->load->library('ciqrcode');
		$directory = "./img_qrcode";
		$file_name = str_replace("","", strtolower($report_no)) . rand(pow(10,2), pow(10, 3)-1);
	
		if (!is_dir($directory)){
			mkdir($directory, 0777, TRUE);
		}
	
		$config['cacheable'] = true;  //boolean, the default is true
		$config['quality'] = true;  //boolean, the default is true
		$config['size'] = '1024';  //integer, the default is 1024
		$config['black'] = array(224,255,255);  // array, default is array(255,255,255)
		$config['white'] = array(70,130,180);  // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);
	
		$image_name = $file_name . '.png';
	
		// Tentukan IP server (ganti dengan IP server Anda)
		$ip_server = 'https://172.23.10.124';  // Ganti dengan IP server Anda
	
		// Bangun URL dengan IP server dan path, sertakan report_no
		$url_redirect = $ip_server . '/handlingsample/index.php/c_transaksi/index_bcKualitas/' . urlencode($report_no);  // Menambahkan report_no ke URL
	
		// Gunakan URL tersebut sebagai data untuk QR code
		$params['data'] = $url_redirect;  // Menambahkan IP server dan report_no ke dalam URL
		$params['level'] = 'H';  // H=High
		$params['size'] = 10;
		$params['savename'] = $directory . '/' . $image_name;
	
		$this->ciqrcode->generate($params);  // fungsi untuk generate QR CODE
	
		return $image_name;
	}*/


	
    public function get_data($qrcode_data="")
    {
        $this->db->select('*')->from('tbl_penerimaan');

        if(!empty($qrcode_data)){
            $this->db->where('qrcode_data', $qrcode_data);
        }

        $res = $this->db->get();
        return $res->result_array();
	}
		
	public function edit_penerimaan($id)
	{
		$where = array('id_penerimaan' => $id);
		$this->load->model('m_transaksi');

		// Ambil semua data kualitas berdasarkan id_penerimaan
		$kualitas_data = $this->m_transaksi->getKualitasByPenerimaan($id);

		// Ambil daftar color unik
		$colors = [];
		$test_required_all = [];
		$color_of_map = [];

		foreach ($kualitas_data as $row) {
			$clr = trim($row->color);
			if (!in_array($clr, $colors)) {
				$colors[] = $clr;
				//$color_of_map[] = $clr;
				//$color_of_map[$clr] = trim($row->color_of); 
			}
			$test_required_all[] = trim($row->test_required);
			$color_of_map[$clr] = trim($row->color_of);
		}

			// Daftar checkbox test yang tersedia
		$checkbox_options = [
			"Color Fastness to House Hold Laundering",
			"Color Fastness to Water",
			"Color Fastness to Perspiration",
			"Color Fastness to Washing",
			"Color Fastness to Rubbing",
			"Color Fastness to Light Fastness",
			"Color Fastness to Light Fastness Perspiration",
			"Color Fastness to Phenolic Yellowing",
			"Color Fastness to Saliva",
			"Color Fastness Dye Transfer In Storage",
			"Color Migration Fastness",
			"Color Migration Oven Test",
			"Color Fastness to Chlorinated Water",
			"Color Fastness to Sea Water",
			"Color Fastness to Chlorine Bleach",
			"Color Fastness to Non-Chlorine Bleach",
			"Dimensional Stability to Laundering",
			"Appereance Change After Laundering",
			"Spirality",
			"Durability Test",
			"Wearing Test",
			"Cuttable Width",
			"Fabric Weight",
			"Product Weight",
			"Piece Weight",
			"Bow and Skew",
			"Heat Shrinkage",
			"Flammability",
			"Elongation & Recovery",
			"Fiber/Fuzz",
			"ICI Pilling Box",
			"Martindale Pilling",
			"Random Tumble Pilling",
			"Snagging (Snag Pod)",
			"Abrasion Resistance",
			"Abrasion Sock",
			"Bursting Pnematic",
			"Bursting Hydraulic",
			"Ball Burst",
			"Textile Material Thickness Measurement",
			"Odour",
			"Moisture Content",
			"Accelerated Ageing by Hydrolysis",
			"Residue & Ageing Test for Sticker",
			"Pull of Force",
			"Seam Slippage/Strength",
			"Seam Slippage of Woven",
			"Tear Strength",
			"Yarn Strength",
			"Tensile Strength",
			"Tear Force",
			"Thread Count",
			"Water Absorbency (Drop Test)",
			"Wicking Height",
			"Evaporation Rate",
			"Water Repellency (Spray Test)",
			"Waterproof (Hydrostatic)",
			"Air Permeability",
			"Fibre Content",
			"Oil Content",
			"pH Value",
			"Formaldehyde",
			"Nickel Test",
			"Azo Dyes",
			"APEO",
			"AP",
			"Phthalates"
			// Tambahkan item lain jika ada
		];

		// Buat daftar test_required unik
		$test_required_all = array_unique($test_required_all);

		// Pisahkan test yang ada dalam checkbox vs yang lainnya
		$test_required_checked = [];
		$test_required_other = [];

		foreach ($test_required_all as $test_from_db) {
			$found = false;

			foreach ($checkbox_options as $option_label) {
				// Normalisasi keduanya untuk menghindari perbedaan kecil
				$clean_db     = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '', $test_from_db)));
				$clean_option = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '', $option_label)));

				if ($clean_db === $clean_option) {
					$test_required_checked[] = $option_label; // simpan label asli dari checkbox
					$found = true;
					break;
				}
			}

			if (!$found) {
				$test_required_other[] = $test_from_db; // tidak cocok
			}
		}


		// Ambil salah satu path gambar jika ada
		$image_path = '';
		foreach ($kualitas_data as $row) {
			if (!empty($row->image_path)) {
				$image_path = $row->image_path;
				break;
			}
		}

		// Siapkan data ke view
		$data['penerimaan'] = [
			'data'      => $this->m_transaksi->getByIdPenerimaan(['id_penerimaan' => $id], 'tbl_penerimaan')->row(),
			'kualitas'  => $kualitas_data,
			'email'     => $this->m_transaksi->getEmail()->result(),
			'material'  => $this->m_transaksi->getMaterial()->result(),
			'supplier'  => $this->m_transaksi->getSupplier()->result(),
			'oekotex'   => $this->m_transaksi->getOekotex()->result(),
			'stages'    => $this->m_transaksi->getStages()->result(),
			'size'      => $this->m_transaksi->getSizecategory()->result(),
			'washing'   => $this->m_transaksi->getCareWashing(),
			'bleching'  => $this->m_transaksi->getCareBleching(),
			'drying'    => $this->m_transaksi->getCareDrying(),
			'profess'   => $this->m_transaksi->getCareProfess(),
			'ironing'   => $this->m_transaksi->getCareIroning(),
			'image_path' => $image_path,
			'colors' => array_values($colors), // ex: ['a', 'b']
			'color_of_map' => array_values($color_of_map),
			'test_required_selected' => $test_required_checked, // checkbox yg dicentang
			'test_required_other' => implode(', ', $test_required_other), // yang tidak tersedia di checkbox
		];

		// Load view edit
		$this->template->load('layout/template', 'adidas/penerimaan/edit.php', $data);
	}

	public function detail_penerimaan($id)
	{
		$where = array('id_penerimaan' => $id);
		$this->load->model('m_transaksi');

		// Ambil semua data kualitas berdasarkan id_penerimaan
		$kualitas_data = $this->m_transaksi->getKualitasByPenerimaan($id);

		// Ambil daftar color unik
		$colors = [];
		$test_required_all = [];
		$color_of_map = [];

		foreach ($kualitas_data as $row) {
			$clr = trim($row->color);
			if (!in_array($clr, $colors)) {
				$colors[] = $clr;
				//$color_of_map[] = $clr;
				//$color_of_map[$clr] = trim($row->color_of); 
			}
			$test_required_all[] = trim($row->test_required);
			$color_of_map[$clr] = trim($row->color_of);
		}

			// Daftar checkbox test yang tersedia
		$checkbox_options = [
			"Color Fastness to House Hold Laundering",
			"Color Fastness to Water",
			"Color Fastness to Perspiration",
			"Color Fastness to Washing",
			"Color Fastness to Rubbing",
			"Color Fastness to Light Fastness",
			"Color Fastness to Light Fastness Perspiration",
			"Color Fastness to Phenolic Yellowing",
			"Color Fastness to Saliva",
			"Color Fastness Dye Transfer In Storage",
			"Color Migration Fastness",
			"Color Migration Oven Test",
			"Color Fastness to Chlorinated Water",
			"Color Fastness to Sea Water",
			"Color Fastness to Chlorine Bleach",
			"Color Fastness to Non-Chlorine Bleach",
			"Dimensional Stability to Laundering",
			"Appereance Change After Laundering",
			"Spirality",
			"Durability Test",
			"Wearing Test",
			"Cuttable Width",
			"Fabric Weight",
			"Product Weight",
			"Piece Weight",
			"Bow and Skew",
			"Heat Shrinkage",
			"Flammability",
			"Elongation & Recovery",
			"Fiber/Fuzz",
			"ICI Pilling Box",
			"Martindale Pilling",
			"Random Tumble Pilling",
			"Snagging (Snag Pod)",
			"Abrasion Resistance",
			"Abrasion Sock",
			"Bursting Pnematic",
			"Bursting Hydraulic",
			"Ball Burst",
			"Textile Material Thickness Measurement",
			"Odour",
			"Moisture Content",
			"Accelerated Ageing by Hydrolysis",
			"Residue & Ageing Test for Sticker",
			"Pull of Force",
			"Seam Slippage/Strength",
			"Seam Slippage of Woven",
			"Tear Strength",
			"Yarn Strength",
			"Tensile Strength",
			"Tear Force",
			"Thread Count",
			"Water Absorbency (Drop Test)",
			"Wicking Height",
			"Evaporation Rate",
			"Water Repellency (Spray Test)",
			"Waterproof (Hydrostatic)",
			"Air Permeability",
			"Fibre Content",
			"Oil Content",
			"pH Value",
			"Formaldehyde",
			"Nickel Test",
			"Azo Dyes",
			"APEO",
			"AP",
			"Phthalates"
			// Tambahkan item lain jika ada
		];

		// Buat daftar test_required unik
		$test_required_all = array_unique($test_required_all);

		// Pisahkan test yang ada dalam checkbox vs yang lainnya
		$test_required_checked = [];
		$test_required_other = [];

		foreach ($test_required_all as $test_from_db) {
			$found = false;

			foreach ($checkbox_options as $option_label) {
				// Normalisasi keduanya untuk menghindari perbedaan kecil
				$clean_db     = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '', $test_from_db)));
				$clean_option = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '', $option_label)));

				if ($clean_db === $clean_option) {
					$test_required_checked[] = $option_label; // simpan label asli dari checkbox
					$found = true;
					break;
				}
			}

			if (!$found) {
				$test_required_other[] = $test_from_db; // tidak cocok
			}
		}


		// Ambil salah satu path gambar jika ada
		$image_path = '';
		foreach ($kualitas_data as $row) {
			if (!empty($row->image_path)) {
				$image_path = $row->image_path;
				break;
			}
		}

		// Siapkan data ke view
		$data['penerimaan'] = [
			'data'      => $this->m_transaksi->getByIdPenerimaan(['id_penerimaan' => $id], 'tbl_penerimaan')->row(),
			'kualitas'  => $kualitas_data,
			'email'     => $this->m_transaksi->getEmail()->result(),
			'material'  => $this->m_transaksi->getMaterial()->result(),
			'supplier'  => $this->m_transaksi->getSupplier()->result(),
			'oekotex'   => $this->m_transaksi->getOekotex()->result(),
			'stages'    => $this->m_transaksi->getStages()->result(),
			'size'      => $this->m_transaksi->getSizecategory()->result(),
			'washing'   => $this->m_transaksi->getCareWashing(),
			'bleching'  => $this->m_transaksi->getCareBleching(),
			'drying'    => $this->m_transaksi->getCareDrying(),
			'profess'   => $this->m_transaksi->getCareProfess(),
			'ironing'   => $this->m_transaksi->getCareIroning(),
			'image_path' => $image_path,
			'colors' => array_values($colors), // ex: ['a', 'b']
			'color_of_map' => array_values($color_of_map),
			'test_required_selected' => $test_required_checked, // checkbox yg dicentang
			'test_required_other' => implode(', ', $test_required_other), // yang tidak tersedia di checkbox
		];

		// Load view edit
		$this->template->load('layout/template', 'adidas/penerimaan/detail.php', $data);
	}

	public function detail_kualitas($id_penerimaan, $id_kualitas)
	{
		$this->load->model('m_transaksi');

		// Ambil semua data kualitas berdasarkan id_penerimaan
		$kualitas_data = $this->m_transaksi->getKualitasByPenerimaan($id_penerimaan);

		// Ambil data kualitas spesifik berdasarkan id_kualitas
		$kualitas_satu = $this->m_transaksi->getKualitasById($id_kualitas);

		if (!$kualitas_satu) {
			show_404();
		}

		// Ambil image dari data ini saja
		$image_path = !empty($kualitas_satu->image_path) ? $kualitas_satu->image_path : '';

		$data['penerimaan'] = [
			'data'          => $this->m_transaksi->getByIdPenerimaan(['id_penerimaan' => $id_penerimaan], 'tbl_penerimaan')->row(),
			'kualitas'      => $kualitas_data, // list semua kualitas di penerimaan ini
			'kualitas_satu' => $kualitas_satu, // hanya 1 untuk detail tampilan
			'email'         => $this->m_transaksi->getEmail()->result(),
			'material'      => $this->m_transaksi->getMaterial()->result(),
			'supplier'      => $this->m_transaksi->getSupplier()->result(),
			'oekotex'       => $this->m_transaksi->getOekotex()->result(),
			'stages'        => $this->m_transaksi->getStages()->result(),
			'size'          => $this->m_transaksi->getSizecategory()->result(),
			'washing'       => $this->m_transaksi->getCareWashing(),
			'bleching'      => $this->m_transaksi->getCareBleching(),
			'drying'        => $this->m_transaksi->getCareDrying(),
			'profess'       => $this->m_transaksi->getCareProfess(),
			'ironing'       => $this->m_transaksi->getCareIroning(),
			'image_path'    => $image_path,
			'color'         => trim($kualitas_satu->color),
			'color_of'      => trim($kualitas_satu->color_of),
			'test_required' => trim($kualitas_satu->test_required),
		];

		$this->template->load('layout/template', 'adidas/kualitas/detail.php', $data);
	}

	public function editaksi_report()
	{
		// Ambil kedua ID dari POST
		$id_reportkualitas = $this->input->post('id_reportkualitas', TRUE);
		$id_handlingsample = $this->input->post('id_handlingsample', TRUE);

		// Periksa apakah kedua ID ada
		if (empty($id_reportkualitas) || empty($id_handlingsample)) {
			echo "Error: id_reportkualitas atau id_handlingsample tidak ditemukan!";
			return;
		}

		// Ambil data lain dari POST
		$date_final = $this->input->post('date_final');
		$test_pending = $this->input->post('test_pending');
		$personil = $this->input->post('personil');
		$date_sending = $this->input->post('date_sending');

		// Buat array data untuk update
		$data = array(
			'date_final' => $date_final,
			'test_pending' => $test_pending,
			'personil' => $personil,
			'date_sending' => $date_sending
		);

		// Panggil model untuk update dengan dua ID
		$this->m_transaksi->editReport($id_reportkualitas, $id_handlingsample, $data);

		// ✅ Cek dan insert ke report_finalhandling kalau semua selesai
		$this->checkAndInsertFinalHandling(
			$this->input->post('id_penerimaan'),
			$this->input->post('report_no')
		);

		// Redirect sesuai level
		$user_level = $this->session->userdata('level');

		if ($user_level == 10 || $user_level == 1) {
			redirect('c_transaksi/index_bcKualitas/' . url_title($this->input->post('report_no'), 'dash', TRUE));
		} else {
			redirect('c_transaksi/index_report');
		}
	}

	public function edit_kualitas( $id_penerimaan, $id_reportkualitas)
	{
		$data['detail'] = $this->m_transaksi->getKualitasRevisi($id_reportkualitas, $id_penerimaan)->row();
		$data['method'] = $this->m_transaksi->getReportMethod($id_reportkualitas);
    	$data['mode'] = 'edit';

		$data['kodemethod'] = $this->m_transaksi->kode_method();

		// Ambil data Method Groups
		$data['method_groups'] = $this->m_transaksi->get_method_groups();
	
		// Ambil Test Matrix berdasarkan Method Group yang dipilih
		if (!empty($this->input->post('method_group'))) {
			$id_method_group = $this->input->post('method_group');
			$this->data['test_matrices'] = $this->m_transaksi->get_test_matrices_by_method_group($id_method_group);
		}

		$user_level = $this->session->userdata('level');

		if ($user_level == 10) {
			$this->load->view('adidas/report/update_bc', $data);
		} else {
			$this->template->load('layout/template', 'adidas/testRequired/edit', $data);
		}
	}


	public function index_kualitas()
    {
        // Ambil data kualitas dengan filter
        $data['kualitas'] = $this->m_transaksi->getIndexKualitas()->result();
		//$data['kualitas'] = $this->m_transaksi->joinKualitasByPenerimaan()->result();


        // Load tampilan dengan data
        $this->template->load('layout/template', 'adidas/kualitas/index.php', $data);
    }

	public function index_kualitas_other()
    {
        // Ambil data kualitas dengan filter
        $data['kualitas'] = $this->m_transaksi->joinKualitas()->result();

        // Load tampilan dengan data
        $this->template->load('layoutOther/template', 'adidas/kualitas/index.php', $data);
    }

	public function getFilterByType()
	{
		$types = $this->input->post('types'); // array test_type

		if (empty($types)) {
			echo json_encode([]);
			return;
		}

		$this->db->select('id_methodgroup, test_level, composition');
		$this->db->from('tbl_testmatrix');
		$this->db->where_in('LOWER(test_type)', $types);
		$this->db->group_by(['id_methodgroup', 'test_level', 'composition']);

		$rows = $this->db->get()->result();

		$result = [
			'id_methodgroup' => [],
			'test_level'   => [],
			'composition'  => []
		];

		foreach ($rows as $r) {
			if ($r->id_methodgroup)
				$result['id_methodgroup'][$r->id_methodgroup] = true;
			if ($r->test_level)
				$result['test_level'][$r->test_level] = true;
			if ($r->composition)
				$result['composition'][$r->composition] = true;
		}

		echo json_encode([
			'id_methodgroup' => array_keys($result['id_methodgroup']),
			'test_level'   => array_keys($result['test_level']),
			'composition'  => array_keys($result['composition']),
		]);
	}


	public function index_testResult($report_no = null, $id_kualitas = null, $id = null)
{
    // ---------------------------------------------------------
    // Validasi parameter
    // ---------------------------------------------------------
    if (empty($report_no) || empty($id_kualitas) || empty($id)) {
        show_error('Nomor laporan, ID kualitas, atau ID tidak ditemukan.');
        return;
    }

    // ---------------------------------------------------------
    // Ambil test_required dari session / fallback ke current id
    // ---------------------------------------------------------
    $id_kualitas_array = $this->session->userdata('id_kualitas_array') ?: [$id_kualitas];

    $tests_required_rows = $this->db
        ->where_in('id_kualitas', $id_kualitas_array)
        ->get('tbl_kualitas')
        ->result_array();

    $test_required_raw = array_column($tests_required_rows, 'test_required');
    $test_required = [];
    foreach ($test_required_raw as $item) {
        if (!$item) continue;
        $decoded = json_decode($item, true);
        if (is_array($decoded)) {
            $test_required = array_merge($test_required, $decoded);
        } else {
            $parts = array_map('trim', explode(',', $item));
            $test_required = array_merge($test_required, $parts);
        }
    }
    $test_required = array_unique($test_required);
    $this->data['test_required'] = $test_required;

    // ---------------------------------------------------------
    // Ambil data lainnya
    // ---------------------------------------------------------
    $this->data['method_groups'] = $this->m_transaksi->get_method_groups();
    $this->data['testmatrix']    = $this->m_transaksi->tampil_testmatrix()->result();

	// ---------------------------------------------------------
	// Build filter option dari tbl_testmatrix
	// ---------------------------------------------------------
	$filter_method_group = [];
	$filter_test_level   = [];
	$filter_composition  = [];

	if (!empty($this->data['testmatrix'])) {
		foreach ($this->data['testmatrix'] as $m) {

			if (!empty($m->id_methodgroup)) {
				$filter_method_group[$m->id_methodgroup] = true;
			}

			if (!empty($m->test_level)) {
				$filter_test_level[$m->test_level] = true;
			}

			if (!empty($m->composition)) {
				$filter_composition[$m->composition] = true;
			}
		}
	}

	$this->data['filter_method_group'] = array_keys($filter_method_group);
	$this->data['filter_test_level']   = array_keys($filter_test_level);
	$this->data['filter_composition']  = array_keys($filter_composition);

    $this->data['testResult']    = $this->m_transaksi->get_test_result($report_no, $id_kualitas_array);
    $this->data['mode']          = 'create';

    $this->data['penerimaan'] = $this->m_transaksi->get_report($report_no);
    $this->data['id_kualitas'] = $id_kualitas;
    $this->data['kodemethod']  = $this->m_transaksi->kode_method();
    $this->data['kodereport']  = $this->m_transaksi->kodeReportKualitas();

    $where = ['id_kualitas' => $id];
    $this->data['penerimaan'] = $this->m_transaksi->getByIdKualitas($where, 'tbl_kualitas')->result();

    $this->data['report_no'] = $report_no;

  	// ---------------------------------------------------------
	// Build matrix_group (FINAL & BENAR)
	// ---------------------------------------------------------
	$matrix_group  = [];
	$result_lookup = [];

	// lookup method_code per test_type + id_testmatrix
	$matrix_lookup = [];
	if (!empty($this->data['testmatrix'])) {
		foreach ($this->data['testmatrix'] as $m) {
			$type_key = strtolower(trim($m->test_type));
			$matrix_lookup[$type_key][$m->id_testmatrix] = $m->method_code;
		}
	}

	if (!empty($this->data['testResult'])) {
		foreach ($this->data['testResult'] as $row) {

			if (empty($row->id_kualitas)) continue;

			$type_key = strtolower(trim($row->test_type ?? 'UNKNOWN'));

			$method = $matrix_lookup[$type_key][$row->id_testmatrix] ?? '-';

			$matrix_group[$type_key][] = [
				'test_name'     => $row->test_required ?? '-',
				'title'         => $row->title ?? '',
				'method_code'   => $method,
				'id_testmatrix' => $row->id_testmatrix ?? '',
				'id_methodgroup'  => $row->id_methodgroup ?? '',
				'test_level'    => $row->test_level ?? '',
				'composition'   => $row->composition ?? '',
				'result_type'	=> $row->result_type ?? '',
				'value_from'	=> $row->value_from ?? '',
				'value_to'		=> $row->value_to ?? '',
			];

			$result_lookup[$row->id_testmatrix] = [
				'result'          => $row->result ?? '',
				'status'          => $row->status ?? '',
				'result_passfail' => $row->result_passfail ?? '',
				'comment'         => $row->comment ?? ''
			];
		}
	}

	$this->data['matrix_group']  = $matrix_group;
	$this->data['result_lookup'] = $result_lookup;


		// ---------------------------------------------------------
		// Load view
		// ---------------------------------------------------------
		$this->template->load(
			'layout/template',
			'adidas/testRequired/testResult.php',
			$this->data
		);
	}



	/*public function index_testResult($report_no = null, $id_kualitas = null, $id = null, $id_reportkualitas = null, $id_handlingsample = null)
	{
		// Validasi parameter penting
		if (empty($report_no) || empty($id_kualitas) || empty($id)) {
			show_error('Nomor laporan, ID kualitas, atau ID penerimaan tidak ditemukan.');
			return;
		}
		

		$segment_count = count($this->uri->segment_array());
		$existing_report = null;
		$test_required_from_url = '';

		$this->data['method'] = (!empty($id_reportkualitas)) 
		? $this->m_transaksi->getReportMethod($id_reportkualitas) 
		: [];
		 	 
		if ($segment_count == 6) {
				$id_reportkualitas = $this->uri->segment(6);
				$existing_report = $this->m_transaksi->getTestRequired($id, $id_reportkualitas);
				$test_required_from_url = $existing_report->test_required ?? '';

				// Load test method jika report_kualitas sudah ada
				$this->data['testMethods'] = $this->m_transaksi->getAllTestMethodByReport($id_reportkualitas);
				
			} else {
				$test_required_from_url = $this->m_transaksi->getTestRequiredName($id_kualitas, $id);

				// Masih input baru, belum ada method
				$this->data['testMethods'] = [];
			}

		// Jika ada id_handlingsample, prioritaskan sebagai test_required
		if (!empty($id_handlingsample)) {
			$test_required_from_url = urldecode($id_handlingsample);
		}

		// Data awal untuk view
		$this->data['method_groups'] = $this->m_transaksi->get_method_groups();
		if (!empty($this->input->post('method_group'))) {
			$id_method_group = $this->input->post('method_group');
			$this->data['test_matrices'] = $this->m_transaksi->get_test_matrices_by_method_group($id_method_group);
		}

		// Siapkan data untuk form testResult
		if (!empty($id_reportkualitas)) {
			$existing_report = $this->m_transaksi->getTestRequired($id, $id_reportkualitas);
		}

		if ($existing_report) {
			$this->data['testResult'] = $existing_report;
			$this->data['kodereport'] = $existing_report->id_reportkualitas;
		} else {
			$this->data['kodereport'] = $this->m_transaksi->kodeReportKualitas();
			$this->data['testResult'] = (object)[
				'report_no'         => $report_no,
				'id_kualitas'       => $id_kualitas,
				'id_penerimaan'     => $id,
				'test_required'     => $test_required_from_url,
				'id_reportkualitas' => null,
			];
		}
		
		// Set default agar tidak undefined saat create data
		$this->data['selected_method_group'] = '';
		$this->data['selected_test_matrix'] = '';
		$this->data['selected_method_code']  = '';

		if ($existing_report) {
			$this->data['testResult'] = $existing_report;

			// Ambil data method group dan test matrix dari id_testmatrix yang ada
			if (!empty($existing_report->id_testmatrix)) {
				$testMatrix = $this->m_transaksi->getTestMatrixDetail($existing_report->id_testmatrix);
				if ($testMatrix) {
					$this->data['selected_method_group'] = $testMatrix->group_id; // pastikan field ini benar
					$this->data['selected_test_matrix'] = $testMatrix->id_testmatrix;
					$this->data['selected_method_code'] = $testMatrix->method_code;
				}
			}
		}



		// Data tambahan
		$this->data['detail']       = $existing_report;
		$this->data['testmatrix']   = $this->m_transaksi->tampil_testmatrix()->result();
		$this->data['report_data']  = $this->m_transaksi->get_report($report_no);
		$this->data['id_kualitas']  = $id_kualitas;
		$this->data['kodemethod']   = $this->m_transaksi->kode_method();
		$this->data['penerimaan']   = $this->m_transaksi->getByIdKualitas(['id_kualitas' => $id], 'tbl_kualitas')->result();

		// Load tampilan berdasarkan level user
		$user_level = $this->session->userdata('level');

		if (!empty($id_reportkualitas) && !empty($id_handlingsample) && $user_level == 10) {
			$this->load->view('adidas/report/update_bc', $this->data);
		} elseif (!empty($id_reportkualitas) && !empty($id_handlingsample)) {
			$this->template->load('layout/template', 'adidas/report/update', $this->data);
		} else {
			$this->template->load('layout/template', 'adidas/testRequired/samplemonitoring.php', $this->data);
		}
	}*/

		public function bc_testResult($report_no = null, $id_kualitas = null, $id = null) {
		// Cek apakah semua parameter telah diisi
		if (empty($report_no) || empty($id_kualitas) || empty($id)) {
			show_error('Nomor laporan, ID kualitas, atau ID tidak ditemukan.');
			return;
		}
	
		// Ambil data Method Groups
		$this->data['method_groups'] = $this->m_transaksi->get_method_groups();
	
		// Ambil Test Matrix berdasarkan Method Group yang dipilih
		if (!empty($this->input->post('method_group'))) {
			$id_method_group = $this->input->post('method_group');
			$this->data['test_matrices'] = $this->m_transaksi->get_test_matrices_by_method_group($id_method_group);
		}
	
		// Ambil data lainnya untuk view
		$this->data['testmatrix'] = $this->m_transaksi->tampil_testmatrix()->result();
		$this->data['penerimaan'] = $this->m_transaksi->get_report($report_no);
		$this->data['id_kualitas'] = $id_kualitas;
		$this->data['kodemethod'] = $this->m_transaksi->kode_method();
		$this->data['testResult'] = $this->m_transaksi->get_test_result($report_no, $id_kualitas);
		$this->data['kodereport'] = $this->m_transaksi->kodeReportKualitas();

	
		// Ambil data penerimaan berdasarkan ID
		$where = array('id_kualitas' => $id);
		$this->data['penerimaan'] = $this->m_transaksi->getByIdKualitas($where, 'tbl_kualitas')->result();
	
		// Memuat view dengan data yang diperlukan
		//$this->template->load('layout/template', 'adidas/testRequired/samplemonitoring.php', $this->data);
		$this->load->view('adidas/testRequired/bc_testResult', $this->data);  // Memuat view dengan data
	}

	public function index_testResultOther($report_no = null, $id_kualitas = null, $id = null) {
		// Cek apakah semua parameter telah diisi
		if (empty($report_no) || empty($id_kualitas) || empty($id)) {
			show_error('Nomor laporan, ID kualitas, atau ID tidak ditemukan.');
			return;
		}
	
		// Ambil data Method Groups
		$this->data['method_groups'] = $this->m_transaksi->get_method_groups();
	
		// Ambil Test Matrix berdasarkan Method Group yang dipilih
		if (!empty($this->input->post('method_group'))) {
			$id_method_group = $this->input->post('method_group');
			$this->data['test_matrices'] = $this->m_transaksi->get_test_matrices_by_method_group($id_method_group);
		}
	
		foreach ($method_dari_db as $row) {
			$this->load->view('adidas/testRequired/keranjang_method', ['row' => $row]);
		}

		// Ambil data lainnya untuk view
		$this->data['testmatrix'] = $this->m_transaksi->tampil_testmatrix()->result();
		$this->data['penerimaan'] = $this->m_transaksi->get_report($report_no);
		$this->data['id_kualitas'] = $id_kualitas;
		$this->data['kodemethod'] = $this->m_transaksi->kode_method();
		$this->data['testResult'] = $this->m_transaksi->get_test_result($report_no, $id_kualitas);
		$this->data['kodereport'] = $this->m_transaksi->kodeReportKualitas();
	
		// Ambil data penerimaan berdasarkan ID
		$where = array('id_kualitas' => $id);
		$this->data['penerimaan'] = $this->m_transaksi->getByIdKualitas($where, 'tbl_kualitas')->result();
	
		// Memuat view dengan data yang diperlukan
		$this->template->load('layoutOther/template', 'adidas/testRequired/samplemonitoring.php', $this->data);
	}
	
	public function get_test_matrices_by_method_group($id_method_group) {
		$test_matrices = $this->m_transaksi->get_test_matrices_by_method_group($id_method_group);
	
		if (empty($test_matrices)) {
			echo '<option selected disabled>No Test Matrix Available</option>';
			return;
		}
	
		$options = '<option selected disabled>Pilih Test Matrix</option>';
		foreach ($test_matrices as $test_matrix) {
			$options .= '<option value="' . $test_matrix->id_testmatrix . '">' . $test_matrix->method_code . '</option>';
		}
	
		echo $options;
	}
	
	public function get_all_method(){
		$data = $this->m_transaksi->lihat_nama_method($_POST['id_testmatrix']);
		echo json_encode($data);
	}

	/*public function keranjang_method()
	{
		// Ambil semua value POST dulu (wajib, sesuai kode kamu)
		$data_row = [
			'id_testmethod'     => $this->input->post('id_testmethod'),
			'report_no'         => $this->input->post('report_no'),
			'id_order'          => $this->input->post('id_order'),
			'id_testmatrix'     => $this->input->post('id_testmatrix'),
			'method_code'       => $this->input->post('method_code'),
			'method_name'       => $this->input->post('method_name'),
			'measurement'       => $this->input->post('measurement'),
			'title'             => $this->input->post('title_row'),
			'result'            => $this->input->post('result'),
			'passfail'          => $this->input->post('result_passfail'),
			'passfail1'         => $this->input->post('result_passfail1'),
			'comment'           => $this->input->post('comment'),
			'statement'         => $this->input->post('statement'),
			'status'            => $this->input->post('status'),
			'status_passfail'   => $this->input->post('status_passfail'),
			'be_wash'           => $this->input->post('be_wash'),
			'af_wash_1'         => $this->input->post('af_wash_1'),
			'ac_wash_1'         => $this->input->post('ac_wash_1'),
			'af_wash_5'         => $this->input->post('af_wash_5'),
			'ac_wash_5'         => $this->input->post('ac_wash_5'),
			'af_wash_15'        => $this->input->post('af_wash_15'),
			'ac_wash_15'        => $this->input->post('ac_wash_15'),
			'status_shrinkage'  => $this->input->post('status_shrinkage'),
			'status_boolean'    => $this->input->post('status_boolean'),
			'status_statement_result' => $this->input->post('status_statement_result'),
			'status_numeric'    => $this->input->post('status_numeric'),
			'status_formaldehyde' => $this->input->post('status_formaldehyde'),
			'mass_of'           => $this->input->post('mass_of'),
			'result_formaldehyde' => $this->input->post('result_formaldehyde'),
			'range_graph_1'     => $this->input->post('range_graph_1'),
			'range_graph_2'     => $this->input->post('range_graph_2'),
		];

		// === Ambil data dari database (kalau id_testmatrix ada) ===
		//$this->load->model('TestMethod_model');
		$rowDB = $this->M_transaksi->lihat_nama_method($data_row['id_testmatrix']);

		// Kalau database ada datanya → isi POST yang kosong
		if ($rowDB) {
			foreach ($data_row as $key => $value) {
				if ($value === "" || $value === null) {
					if (isset($rowDB->$key)) {
						$data_row[$key] = $rowDB->$key;
					}
				}
			}
		}

		// load view
		$this->load->view('adidas/testRequired/keranjang_method', [
			'data_row' => $data_row
		]);
	}*/

	public function keranjang_method()
	{
		$data_row = [
			'id_testmethod'		=> $this->input->post('id_testmethod'),
			'report_no'         => $this->input->post('report_no'),
			'id_order'          => $this->input->post('id_order'),
			'id_testmatrix'     => $this->input->post('id_testmatrix'),
			'method_code'       => $this->input->post('method_code'),
			'method_name'       => $this->input->post('method_name'),
			'measurement'       => $this->input->post('measurement'),
			'title'         	=> $this->input->post('title'),
			'result'            => $this->input->post('result'),
			'passfail'   		=> $this->input->post('result_passfail'),
			'passfail1'  		=> $this->input->post('result_passfail1'),
			'comment'           => $this->input->post('comment'),
			'statement'         => $this->input->post('statement'),
			'status'            => $this->input->post('status'),
			'status_passfail'   => $this->input->post('status_passfail'),
			'be_wash'			=> $this->input->post('be_wash'),
			'af_wash_1'			=> $this->input->post('af_wash_1'),
			'ac_wash_1'			=> $this->input->post('ac_wash_1'),
			'af_wash_5'			=> $this->input->post('af_wash_5'),
			'ac_wash_5'			=> $this->input->post('ac_wash_5'),
			'af_wash_15'		=> $this->input->post('af_wash_15'),
			'ac_wash_15'		=> $this->input->post('ac_wash_15'),
			'status_shrinkage'	=> $this->input->post('status_shrinkage'),
			'status_boolean' 	=> $this->input->post('status_boolean'),
			'status_statement_result' => $this->input->post('gstatus_statement_result'),
			'status_numeric' 	=> $this->input->post('status_numeric'),
			'status_formaldehyde' => $this->input->post('status_formaldehyde'),
			'mass_of'			=> $this->input->post('mass_of'),
			'result_formaldehyde' => $this->input->post('result_formaldehyde'),
			'range_graph_1' => $this->input->post('range_graph_1'),
			'range_graph_2'	=> $this->input->post('range_graph_2'),
			'nahm_sock' 		=> $this->input->post('nahm_sock'),
			'result_sock'	=> $this->input->post('result_sock'),
			'comment_sock'	=> $this->input->post('comment_sock'),
			'status_sock'	=> $this->input->post('status_sock')
		];

		$this->load->view('adidas/testRequired/keranjang_method', ['data_row' => $data_row]);
	}


	public function report_test($id_handlingsample)
    {
        

		 // Memanggil model untuk mengambil data
		 $this->data['handling'] = $this->m_transaksi->get_report_data_adidas($id_handlingsample); 

        // Pastikan data tersedia sebelum lanjut
        if (!$this->data['handling']) {
            show_404(); // Jika tidak ada data, tampilkan 404
            return; // Hentikan proses lebih lanjut jika data tidak ditemukan
        }

		$this->data['deskripsi_item'] = $this->m_transaksi->get_deskripsi_item($id_handlingsample);

		if (!$this->data['deskripsi_item']) {
            show_404(); // Jika tidak ada data, tampilkan 404
            return; // Hentikan proses lebih lanjut jika data tidak ditemukan
        }

		$this->data['method'] = $this->m_transaksi-> get_reportmethod_adidas($id_handlingsample);

		if (!$this->data['method']){
			show_404();
			return;
		}

        // Set data untuk title dan lainnya
        $this->data['title'] = 'FABRIC TEST REPORT';
        $this->data['no'] = 1; // Ini bisa diubah sesuai kebutuhan

        // Menyiapkan Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true); // Enable PHP in HTML (Jika diperlukan)

        // Inisialisasi Dompdf dengan options
        $dompdf = new Dompdf($options);

        $dompdf->setPaper('A4', 'portrait'); // Set ukuran kertas

        // Muat view HTML untuk laporan
        $html = $this->load->view('adidas/report/reportTest', $this->data, true);

        // Load HTML ke Dompdf dan render
        $dompdf->loadHtml($html);
        $dompdf->render();

        // Mengunduh atau menampilkan hasil PDF
        $dompdf->stream('FGT Report ' . date('d F Y'), array("Attachment" => false)); // Tampilkan PDF di browser
    }


	

	// Non - adidas
	

	public function login_other()
	{
		$this->load->view('other/login/login.php');
	}

	public function index_other()
	{
		$this->template->load('layoutOther/template','other/dashboard');
	}

	public function index_penerimaan_other()
	{
		$data['penerimaan'] = $this->m_transaksi->getPenerimaanOther()->result();
		$this->template->load('layoutOther/template','other/penerimaan/index.php', $data);
	}

	public function tambah_penerimaan_other()
	{
		$this->load->model('m_login');
		$this->load->model('m_transaksi');
		$data['user'] = $this->m_login->current_user();
		$this->template->load('layout/template','other/penerimaan/tambah.php',$data);
	}

	public function tambahaksi_penerimaan_other()
	{
		$data = $this->input->post();
		unset($data['submit']);
		$this->load->model('m_transaksi');
		$this->m_transaksi->insertPenerimaan($data);

		redirect('c_transaksi/index_penerimaan_other');
	}

	//master data

	public function index_department()
	{
		$data['department'] = $this->m_transaksi->getDepartment()->result();
		$this->template->load('layout/template','masterData/department/index.php', $data);
	}

	
	public function index_departmentOther()
	{
		$data['department'] = $this->m_transaksi->getDepartment()->result();
		$this->template->load('layoutOther/template','masterData/department/index.php', $data);
	}

	public function insert_department()
	{
		$this->template->load('layout/template','masterData/department/tambah.php');
	}

	public function insert_departmentOther()
	{
		$this->template->load('layoutOther/template','masterData/department/index.php');
	}

	public function tambahaksi_department()
	{
		$data = array (
			'kode_department' => $this->input->post('kode_department'),
			'department' => $this->input->post('department')
		);

		$this->m_transaksi->insertDepartment($data,'m_department');

		redirect('c_transaksi/index_department');
	}

	public function tambahaksi_departmentOther()
	{
		$data = array (
			'kode_department' => $this->input->post('kode_department'),
			'department' => $this->input->post('department')
		);

		$this->m_transaksi->insertDepartment($data,'m_department');

		redirect('c_transaksi/index_departmentOther');
	}

	
	public function edit_department($id_department)
	{
		$where = array('id_department' => $id_department);
		$data['edit'] = $this->m_transaksi->getByIdDepartment($where, 'm_department')->result();
		$this->template->load('layout/template','masterData/department/edit.php', $data);
	}

	public function edit_departmentOther($id_department)
	{
		$where = array('id_department' => $id_department);
		$data['edit'] = $this->m_transaksi->getByIdDepartment($where, 'm_department')->result();
		$this->template->load('layoutOther/template','masterData/department/edit.php', $data);
	}

	public function editaksi_department()
	{
		$id_department = $this->input->post('id_department');
		$kode_department = $this->input->post('kode_department');
		$department = $this->input->post('department');

		$data = array (
			'id_department' => $id_department,
			'kode_department' => $kode_department,
			'department' => $department
		);

		$this->m_transaksi->updateDepartment($id_department, $data);
		redirect('c_transaksi/index_department', $data);
	}

	public function editaksi_departmentOther()
	{
		$id_department = $this->input->post('id_department');
		$kode_department = $this->input->post('kode_department');
		$department = $this->input->post('department');

		$data = array (
			'id_department' => $id_department,
			'kode_department' => $kode_department,
			'department' => $department
		);

		$this->m_transaksi->updateDepartment($id_department, $data);
		redirect('c_transaksi/index_departmentOther', $data);
	}

	public function delete_department($id_department)
	{
		$this->db->where('id_department', $id_department);
		$this->db->delete('m_department');

		redirect('c_transaksi/index_department');
	}

	
	public function delete_departmentOther($id_department)
	{
		$this->db->where('id_department', $id_department);
		$this->db->delete('m_department');

		redirect('c_transaksi/index_departmentOther');
	}


	public function index_email()
	{
		$data['department'] = $this->m_transaksi->joinDeptEmail()->result();
		$data['email'] = $this->m_transaksi->getEmail()->result();
		$this->template->load('layout/template','masterData/email/index.php', $data);
	}

	public function index_emailOther()
	{
		$data['department'] = $this->m_transaksi->joinDeptEmail()->result();
		$data['email'] = $this->m_transaksi->getEmail()->result();
		$this->template->load('layoutOther/template','masterData/email/index.php', $data);
	}

	public function insert_email()
	{
		$data['department'] = $this->m_transaksi->getDepartment()->result();
		$data['email'] = $this->m_transaksi->getEmail()->result();
		$this->template->load('layout/template','masterData/email/tambah.php', $data);
	}

	
	public function insert_emailOther()
	{
		$data['department'] = $this->m_transaksi->getDepartment()->result();
		$data['email'] = $this->m_transaksi->getEmail()->result();
		$this->template->load('layoutOther/template','masterData/email/tambah.php', $data);
	}

	public function tambahaksi_email()
	{
		$data = array (
			'applicant' => $this->input->post('applicant'),
			'id_department' => $this->input->post('department'),
			'email' => $this->input->post('email'),
			'no_tlp' => $this->input->post('no_tlp')
		);
		
		$this->m_transaksi->insertEmail($data, 'm_email');

		redirect('c_transaksi/index_email');
	}

	
	public function tambahaksi_emailOther()
	{
		$data = array (
			'applicant' => $this->input->post('applicant'),
			'id_department' => $this->input->post('department'),
			'email' => $this->input->post('email'),
			'no_tlp' => $this->input->post('no_tlp')
		);
		
		$this->m_transaksi->insertEmail($data, 'm_email');

		redirect('c_transaksi/index_emailOther');
	}

	public function edit_email($id)
	{
		$data['department'] = $this->m_transaksi->getDepartment()->result();
		$where = array('id' => $id);
		$data['edit'] = $this->m_transaksi->getByIdEmail($where, 'm_email')->result();
		$this->template->load('layout/template','masterData/email/edit.php', $data);
	}

	public function edit_emailOther($id)
	{
		$data['department'] = $this->m_transaksi->getDepartment()->result();
		$where = array('id' => $id);
		$data['edit'] = $this->m_transaksi->getByIdEmail($where, 'm_email')->result();
		$this->template->load('layoutOther/template','masterData/email/edit.php', $data);
	}

	public function editaksi_email()
	{
		$id = $this->input->post('id');
		$applicant = $this->input->post('applicant');
		$id_department = $this->input->post('department');
		$email = $this->input->post('email');
		$no_tlp = $this->input->post('no_tlp');

		$data = array (
			'id' => $id,
			'applicant' => $applicant,
			'id_department' => $id_department,
			'email' => $email,
			'no_tlp' => $no_tlp
		);

		$this->m_transaksi->updateEmail($id, $data);

		redirect ('c_transaksi/index_email', $data);
	}

	public function editaksi_emailOther()
	{
		$id = $this->input->post('id');
		$applicant = $this->input->post('applicant');
		$id_department = $this->input->post('department');
		$email = $this->input->post('email');
		$no_tlp = $this->input->post('no_tlp');

		$data = array (
			'id' => $id,
			'applicant' => $applicant,
			'id_department' => $id_department,
			'email' => $email,
			'no_tlp' => $no_tlp
		);

		$this->m_transaksi->updateEmail($id, $data);

		redirect ('c_transaksi/index_emailOther', $data);
	}

	public function delete_email($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('m_applicant');

		redirect('c_transaksi/index_email');
	}

	public function delete_emailOther($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('m_applicant');

		redirect('c_transaksi/index_emailOther');
	}

	public function getMaterialFill(){
		$data = $this->m_transaksi->materialFill($_POST['item_no']);
		echo json_encode($data);
	}

	public function getSupplierFill()
	{
		$data = $this->m_transaksi->supplierFill($_POST['supplier_name']);
		echo json_encode($data);
	}

	public function getApplicantFill(){
		$data = $this->m_transaksi->applicantFill($_POST['applicant']);
		echo json_encode($data);
	}

	
	public function index_material()
	{
		$data['index'] = $this->m_transaksi->getMaterial()->result();
		$this->template->load('layout/template','masterData/material/index.php', $data);
	}

	public function index_materialOther()
	{
		$data['index'] = $this->m_transaksi->getMaterial()->result();
		$this->template->load('layoutOther/template','masterData/material/index.php', $data);
	}

	public function insert_material()
	{
	
		$this->template->load('layout/template','masterData/material/tambah.php');
	}

	public function insert_materialOther()
	{
	
		$this->template->load('layoutOther/template','masterData/material/tambah.php');
	}

	public function tambahaksi_material()
	{
		$data = array (
			'item_no' => $this->input->post('item_no'),
			'code_of_fabric' => $this->input->post('code_of_fabric'),
			'deskripsi' => $this->input->post('deskripsi'),
		
		);

		$this->m_transaksi->insertMaterial($data,'m_material');

		redirect('c_transaksi/index_material');
	}

	public function tambahaksi_materialOther()
	{
		$data = array (
			'item_no' => $this->input->post('item_no'),
			'code_of_fabric' => $this->input->post('code_of_fabric'),
			'deskripsi' => $this->input->post('deskripsi'),
		
		);

		$this->m_transaksi->insertMaterial($data,'m_material');

		redirect('c_transaksi/index_materialOther');
	}

	public function edit_material($id_material)
	{
		$where = array ('id_material' => $id_material);
		$data['edit'] = $this->m_transaksi->getByIdMaterial($where,'m_material')->result();
		$this->template->load('layout/template','masterData/material/edit.php', $data);
	}

	public function edit_materialOther($id_material)
	{
		$where = array ('id_material' => $id_material);
		$data['edit'] = $this->m_transaksi->getByIdMaterial($where,'m_material')->result();
		$this->template->load('layoutOther/template','masterData/material/edit.php', $data);
	}

	public function editaksi_material()
	{
		$id_material = $this->input->post('id_material');
		$item_no = $this->input->post('item_no');
		$code_of_fabric = $this->input->post('code_of_fabric');
		$deskripsi = $this->input->post('deskripsi');
		

		$data = array (
			'id_material' => $id_material,
			'item_no' => $item_no,
			'code_of_fabric' => $code_of_fabric,
			'deskripsi' => $deskripsi
		);

		$this->m_transaksi->updateMaterial($id_material, $data);

		redirect('c_transaksi/index_material');
	}

	public function editaksi_materialOther()
	{
		$id_material = $this->input->post('id_material');
		$item_no = $this->input->post('item_no');
		$code_of_fabric = $this->input->post('code_of_fabric');
		$deskripsi = $this->input->post('deskripsi');
		

		$data = array (
			'id_material' => $id_material,
			'item_no' => $item_no,
			'code_of_fabric' => $code_of_fabric,
			'deskripsi' => $deskripsi
		);

		$this->m_transaksi->updateMaterial($id_material, $data);

		redirect('c_transaksi/index_materialOther');
	}

	public function delete_material($id_material)
	{
		$this->db->where('id_material', $id_material);
		$this->db->delete('m_material');

		redirect('c_transaksi/index_material');
	}

	public function delete_materialOther($id_material)
	{
		$this->db->where('id_material', $id_material);
		$this->db->delete('m_material');

		redirect('c_transaksi/index_materialOther');
	}

	public function index_buyer()
	{
		$data['index'] = $this->m_transaksi->getBrand()->result();
		$this->template->load('layout/template','masterData/buyer/index.php', $data);
	}

	public function index_buyerOther()
	{
		$data['index'] = $this->m_transaksi->getBrand()->result();
		$this->template->load('layoutOther/template','masterData/buyer/index.php', $data);
	}

	public function tambah_buyer()
	{
		
		$this->template->load('layout/template','masterData/buyer/tambah.php');
	}

	public function tambah_buyerOther()
	{
		
		$this->template->load('layoutOther/template','masterData/buyer/tambah.php');
	}

	public function tambahaksi_buyer()
	{
		$data = array(
			'brand' => $this->input->post('brand')
		);

		$this->m_transaksi->insertBrand($data, 'm_brand');

		redirect('c_transaksi/index_buyer');
	}

	public function tambahaksi_buyerOther()
	{
		$data = array(
			'brand' => $this->input->post('brand')
		);

		$this->m_transaksi->insertBrand($data, 'm_brand');

		redirect('c_transaksi/index_buyerOther');
	}

	public function edit_buyer($id_brand)
	{
		$where = array('id_brand' => $id_brand);
		$data['buyer'] = $this->m_transaksi->getByIdBrand($where, 'm_brand')->result();
		$this->template->load('layout/template','masterData/buyer/edit.php', $data);
	}

	public function edit_buyerOther($id_brand)
	{
		$where = array('id_brand' => $id_brand);
		$data['buyer'] = $this->m_transaksi->getByIdBrand($where, 'm_brand')->result();
		$this->template->load('layoutOther/template','masterData/buyer/edit.php', $data);
	}

	public function editaksi_buyer()
	{
		$id_brand = $this->input->post('id_brand');
		$brand = $this->input->post('brand');

		$data = array (
			'id_brand' => $id_brand,
			'brand' => $brand
		);

		$this->m_transaksi->updateBrand($id_brand, $data);
		redirect('c_transaksi/index_buyer', $data);
	}

	public function editaksi_buyerOther()
	{
		$id_brand = $this->input->post('id_brand');
		$brand = $this->input->post('brand');

		$data = array (
			'id_brand' => $id_brand,
			'brand' => $brand
		);

		$this->m_transaksi->updateBrand($id_brand, $data);
		redirect('c_transaksi/index_buyerOther', $data);
	}

	public function delete_buyer($id_brand)
	{
		$this->db->where('id_brand', $id_brand);
		$this->db->delete('m_brand');

		redirect('c_transaksi/index_buyer');
	}

	public function delete_buyerOther($id_brand)
	{
		$this->db->where('id_brand', $id_brand);
		$this->db->delete('m_brand');

		redirect('c_transaksi/index_buyerOther');
	}

	public function index_oekotex()
	{
		$data['index'] = $this->m_transaksi->getOekotex()->result();
		$this->template->load('layout/template','masterData/oekotex/index.php', $data);
	}

	public function index_oekotexOther()
	{
		$data['index'] = $this->m_transaksi->getOekotex()->result();
		$this->template->load('layoutOther/template','masterData/oekotex/index.php', $data);
	}

	public function insert_oekotex()
	{
		$this->template->load('layout/template','masterData/oekotex/tambah.php');
	}

	public function insert_oekotexOther()
	{
		$this->template->load('layoutOther/template','masterData/oekotex/tambah.php');
	}

	public function tambahaksi_oekotex()
	{
		$data = array (
			'oekotex' => $this->input->post('oekotex')
		);

		$this->m_transaksi->insertOekotex($data, 'm_oekotex');

		redirect('c_transaksi/index_oekotex');
	}

	public function tambahaksi_oekotexOther()
	{
		$data = array (
			'oekotex' => $this->input->post('oekotex')
		);

		$this->m_transaksi->insertOekotex($data, 'm_oekotex');

		redirect('c_transaksi/index_oekotexOther');
	}

	public function edit_oekotex($id)
	{
		$where = array('id' => $id);
		$data['edit'] = $this->m_transaksi->getByIdOekotex($where,'m_oekotex')->result();
		$this->template->load('layout/template','masterData/oekotex/edit.php', $data);
	}

	public function edit_oekotexOther($id)
	{
		$where = array('id' => $id);
		$data['edit'] = $this->m_transaksi->getByIdOekotex($where,'m_oekotex')->result();
		$this->template->load('layoutOther/template','masterData/oekotex/edit.php', $data);
	}

	public function editaksi_oekotex()
	{
		$id = $this->input->post('id');
		$oekotex = $this->input->post('oekotex');

		$data = array(
			'id' => $id,
			'oekotex' => $oekotex
		);

		$this->m_transaksi->udpateOekotex($id, $data);

		redirect('c_transaksi/index_oekotex', $data);
	}

	public function editaksi_oekotexOther()
	{
		$id = $this->input->post('id');
		$oekotex = $this->input->post('oekotex');

		$data = array(
			'id' => $id,
			'oekotex' => $oekotex
		);

		$this->m_transaksi->udpateOekotex($id, $data);

		redirect('c_transaksi/index_oekotexOther', $data);
	}

	public function delete_oekotex($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('m_oekotex');

		redirect('c_transaksi/index_oekotex');
	}

	public function delete_oekotexOther($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('m_oekotex');

		redirect('c_transaksi/index_oekotexOther');
	}

	public function index_sizecategory()
	{
		$data['index'] = $this->m_transaksi->getSizecategory()->result();
		$this->template->load('layout/template','masterData/sizeCategory/index.php', $data);
	}

	public function index_sizecategoryOther()
	{
		$data['index'] = $this->m_transaksi->getSizecategory()->result();
		$this->template->load('layoutOther/template','masterData/sizeCategory/index.php', $data);
	}

	public function insert_sizecategory()
	{
		$this->template->load('layout/template','masterData/sizeCategory/tambah.php');
	}

	public function insert_sizecategoryOther()
	{
		$this->template->load('layoutOther/template','masterData/sizeCategory/tambah.php');
	}

	public function tambahaksi_sizecategory()
	{
		$data = array (
			'age' => $this->input->post('age')
		);

		$this->m_transaksi->insertSizecategory($data,'m_age');

		redirect('c_transaksi/index_sizecategory');

	}

	public function tambahaksi_sizecategoryOther()
	{
		$data = array (
			'age' => $this->input->post('age')
		);

		$this->m_transaksi->insertSizecategory($data,'m_age');

		redirect('c_transaksi/index_sizecategoryOther');

	}

	public function edit_sizecategory($id_age)
	{
		$where = array('id_age' => $id_age);
		$data['edit'] = $this->m_transaksi->getByIdSizecategory($where,'m_age')->result();
		$this->template->load('layout/template','masterData/sizeCategory/edit.php', $data);
	}

	public function edit_sizecategoryOther($id_age)
	{
		$where = array('id_age' => $id_age);
		$data['edit'] = $this->m_transaksi->getByIdSizecategory($where,'m_age')->result();
		$this->template->load('layoutOther/template','masterData/sizeCategory/edit.php', $data);
	}

	public function editaksi_sizecategory()
	{
		$id_age = $this->input->post('id_age');
		$age = $this->input->post('age');

		$data = array(
			'id_age' => $id_age,
			'age' => $age
		);

		$this->m_transaksi->updateSizecategory($id_age, $data);

		redirect('c_transaksi/index_sizecategory');
	}

	public function editaksi_sizecategoryOther()
	{
		$id_age = $this->input->post('id_age');
		$age = $this->input->post('age');

		$data = array(
			'id_age' => $id_age,
			'age' => $age
		);

		$this->m_transaksi->updateSizecategory($id_age, $data);

		redirect('c_transaksi/index_sizecategoryOther');
	}

	public function delete_sizecategory($id_age)
	{
		$this->db->where('id_age',$id_age);
		$this->db->delete('m_age');

		redirect('c_transaksi/index_sizecategory');
	}

	public function delete_sizecategoryOther($id_age)
	{
		$this->db->where('id_age',$id_age);
		$this->db->delete('m_age');

		redirect('c_transaksi/index_sizecategoryOther');
	}

	public function index_stages()
	{
		$data['index'] = $this->m_transaksi->getStages()->result();
		$this->template->load('layout/template','masterData/stages/index.php', $data);
	}

	public function index_stagesOther()
	{
		$data['index'] = $this->m_transaksi->getStages()->result();
		$this->template->load('layoutOther/template','masterData/stages/index.php', $data);
	}

	public function insert_stages()
	{
		$this->template->load('layout/template','masterData/stages/tambah.php');
	}

	public function insert_stagesOther()
	{
		$this->template->load('layoutOther/template','masterData/stages/tambah.php');
	}

	public function tambahaksi_stages()
	{
		$data = array (
			'testing_stages' => $this->input->post('testing_stages')
		);

		$this->m_transaksi->insertStages($data, 'm_stages');
		redirect('c_transaksi/index_stages');
	}

	public function tambahaksi_stagesOther()
	{
		$data = array (
			'testing_stages' => $this->input->post('testing_stages')
		);

		$this->m_transaksi->insertStages($data, 'm_stages');
		redirect('c_transaksi/index_stagesOther');
	}

	public function edit_stages($id_stages)
	{
		$where = array('id_stages' => $id_stages);
		$data['edit'] = $this->m_transaksi->getByIdStages($where,'m_stages')->result();
		$this->template->load('layout/template','masterData/stages/edit.php', $data);
	}

	
	public function edit_stagesOther($id_stages)
	{
		$where = array('id_stages' => $id_stages);
		$data['edit'] = $this->m_transaksi->getByIdStages($where,'m_stages')->result();
		$this->template->load('layoutOther/template','masterData/stages/edit.php', $data);
	}

	public function editaksi_stages()
	{
		$id_stages = $this->input->post('id_stages');
		$testing_stages = $this->input->post('testing_stages');

		$data = array (
			'id_stages' => $id_stages,
			'testing_stages' => $testing_stages
		);

		$this->m_transaksi->updateStages($id_stages, $data);

		redirect('c_transaksi/index_stages');
	}

	public function editaksi_stagesOther()
	{
		$id_stages = $this->input->post('id_stages');
		$testing_stages = $this->input->post('testing_stages');

		$data = array (
			'id_stages' => $id_stages,
			'testing_stages' => $testing_stages
		);

		$this->m_transaksi->updateStages($id_stages, $data);

		redirect('c_transaksi/index_stagesOther');
	}

	public function delete_stages($id_stages)
	{
		$this->db->where('id_stages', $id_stages);
		$this->db->delete('m_stages');

		redirect('c_transaksi/index_stages');
	}

	public function delete_stagesOther($id_stages)
	{
		$this->db->where('id_stages', $id_stages);
		$this->db->delete('m_stages');

		redirect('c_transaksi/index_stagesOther');
	}

	public function index_careInstruction()
	{
		$data['index'] = $this->m_transaksi->getCare()->result();
		$this->template->load('layout/template','masterData/careInstruction/index.php', $data);
	}

	public function index_careInstructionOther()
	{
		$data['index'] = $this->m_transaksi->getCare()->result();
		$this->template->load('layoutOther/template','masterData/careInstruction/index.php', $data);
	}

	public function insert_careInstruction()
	{
		$data['washing'] = $this->m_transaksi->getCareWashing();
		$data['bleching'] = $this->m_transaksi->getCareBleching();
		$data['drying'] = $this->m_transaksi->getCareDrying();
		$data['ironing'] = $this->m_transaksi->getCareIroning();
		$data['profess'] = $this->m_transaksi->getCareProfess();

		$this->template->load('layout/template','masterData/careInstruction/tambah.php', $data);	
	}

	public function insert_careInstructionOther()
	{
		$data['washing'] = $this->m_transaksi->getCareWashing();
		$data['bleching'] = $this->m_transaksi->getCareBleching();
		$data['drying'] = $this->m_transaksi->getCareDrying();
		$data['ironing'] = $this->m_transaksi->getCareIroning();
		$data['profess'] = $this->m_transaksi->getCareProfess();

		$this->template->load('layoutOther/template','masterData/careInstruction/tambah.php', $data);	
	}

	public function tambahaksi_care()
    {
        // Konfigurasi untuk upload file
        $config['upload_path'] = FCPATH . '../samplemonitoring/images/care_instruction/';
        $config['allowed_types'] = 'png|jpg|gif';
        $config['max_size'] = 2048; // 2MB
        $config['max_width'] = 40000;
        $config['max_height'] = 40000;

        $this->upload->initialize($config);

        // Proses upload file
        if (!$this->upload->do_upload('simbol_care')) {
            // Jika upload gagal, tampilkan error
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', "Gagal mengunggah file: " . $error['error']);
            redirect('c_transaksi/index_careInstruction');
        } else {
            // Jika upload berhasil
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name']; // Nama file yang diupload

            // Data untuk disimpan ke database
            $data = array(
                'kategori_care' => $this->input->post('kategori_care'),
                'simbol_care' => $file_name,
                'deskripsi' => $this->input->post('deskripsi')
            );

            // Simpan ke database melalui model
            $insert = $this->m_transaksi->tambahCare($data);

            if ($insert) {
                // Jika data berhasil disimpan
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                redirect('c_transaksi/index_careInstruction');
            } else {
                // Jika gagal menyimpan ke database
                $this->session->set_flashdata('error', 'Gagal menyimpan data ke database.');
                redirect('c_transaksi/index_careInstruction');
            }
        }
    }

	public function tambahaksi_careOther()
    {
        // Konfigurasi untuk upload file
        $config['upload_path'] = FCPATH . '../samplemonitoring/images/care_instruction/';
        $config['allowed_types'] = 'png|jpg|gif';
        $config['max_size'] = 2048; // 2MB
        $config['max_width'] = 40000;
        $config['max_height'] = 40000;

        $this->upload->initialize($config);

        // Proses upload file
        if (!$this->upload->do_upload('simbol_care')) {
            // Jika upload gagal, tampilkan error
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', "Gagal mengunggah file: " . $error['error']);
            redirect('c_transaksi/index_careInstructionOther');
        } else {
            // Jika upload berhasil
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name']; // Nama file yang diupload

            // Data untuk disimpan ke database
            $data = array(
                'kategori_care' => $this->input->post('kategori_care'),
                'simbol_care' => $file_name,
                'deskripsi' => $this->input->post('deskripsi')
            );

            // Simpan ke database melalui model
            $insert = $this->m_transaksi->tambahCare($data);

            if ($insert) {
                // Jika data berhasil disimpan
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                redirect('c_transaksi/index_careInstructionOther');
            } else {
                // Jika gagal menyimpan ke database
                $this->session->set_flashdata('error', 'Gagal menyimpan data ke database.');
                redirect('c_transaksi/index_careInstructionOther');
            }
        }
    }

	public function delete_care($id_care)
	{
		$this->db->where('id_care', $id_care);
		$this->db->delete('m_care');

		redirect('c_transaksi/index_careInstruction');
	}

	public function edit_care($id_care)
	{
		$where = ['id_care' => $id_care];
		$data['care'] = $this->m_transaksi->getByIdCare($where)->row();

		if (!$data['care']) {
			show_404();
		}

		$this->template->load(
			'layout/template',
			'masterData/careInstruction/edit',
			$data
		);
	}

	public function upload()
    {   
        if($_FILES['simbol_care']['size'] != 0){
            $upload_dir = './images/';
			
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir);
            }

        $config['upload_path']          = './xampp/htdocs/samplemonitoring/images/';
        $config['allowed_types']        = 'png|jpg|gif|jpeg';
        $config['max_size']             = 2048;
        $config['max_width']            = 40000;
        $config['max_height']           = 40000;

        $this->load->library('upload', $config);

            if (!$this->upload->do_upload('simbol_care')){
                    $this->form_validation->set_message('upload', $this->upload->display_errors());
                    return false;
                }else{
                    $upload_data = $this->upload->data();
                    $name = $upload_data['file_name'];

                    $insert = $this->m_transaksi->insertCare($name);
        
                    if($insert){
						redirect('c_transaksi/index_careInstruction');
                    }else{
						echo "Gagal";
						redirect('c_transaksi/index_careInstruction');
                    }
                }
        }else{
            $this->form_validation->set_message('upload',"No File selected!");
            return false;
        }
    }
	
	public function editaksi_care()
	{
		$id_care        = $this->input->post('id_care');
		$kategori_care  = $this->input->post('kategori_care');
		$deskripsi      = $this->input->post('deskripsi');

		// ambil data lama
		$care_lama = $this->db
			->get_where('m_care', ['id_care' => $id_care])
			->row();

		if (!$care_lama) {
			show_404();
		}

		// data update (tanpa simbol dulu)
		$data = [
			'kategori_care' => $kategori_care,
			'deskripsi'     => $deskripsi
		];

		// === KONFIG UPLOAD ===
	if (!empty($_FILES['simbol_care']['name'])) {

		$config['upload_path']   = FCPATH . 'images/care_instruction/';
		$config['allowed_types'] = 'png|jpg|gif';
		$config['max_size']      = 2048;
		$config['encrypt_name']  = TRUE;

		// WAJIB seperti ini
		$this->load->library('upload');
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('simbol_care')) {

			$this->session->set_flashdata(
				'error',
				$this->upload->display_errors()
			);
			redirect('c_transaksi/edit_care/' . $id_care);
			return;
		}

		$upload_data = $this->upload->data();
		$data['simbol_care'] = $upload_data['file_name'];

		if (!empty($care_lama->simbol_care)) {
			@unlink(FCPATH . 'images/care_instruction/' . $care_lama->simbol_care);
		}
	}


		// update DB
		$update = $this->db->where('id_care', $id_care)
						->update('m_care', $data);

		if ($update) {
			$this->session->set_flashdata('success', 'Data berhasil diperbarui');
			redirect('c_transaksi/index_careInstruction');
		} else {
			$this->session->set_flashdata('error', 'Gagal memperbarui data');
			redirect('c_transaksi/edit_care/' . $id_care);
		}
	}

	public function editaksi_careOther()
    {
        $id_care = $this->input->post('id_care');
        $kategori_care = $this->input->post('kategori_care');
        $simbol_care = $this->input->post('simbol_care');
        $deskripsi = $this->input->post('deskripsi');

        $config['upload_path']			= FCPATH . '../samplemonitoring/images/care_instruction/';
		$config['allowed_types']        = 'png|jpg|gif';
		$config['max_size']             = 2048;
		$config['max_width']            = 40000;
		$config['max_height']           = 40000; 

        $this->load->library('upload', $config);

        $data = array(
            'id_care' => $id_care,
            'kategori_care' => $kategori_care,
            'simbol_care' => $simbol_care['file_name'],
            'deskripsi' => $deskripsi
        );

        if(!$this->upload->do_upload('simbol_care'))
        {
            $error = array('error' => $this->upload->display_errors());
            redirect('c_transaksi/index_careInstuctionOther', $error);
        }else{

            $upload_data = $this->upload->data();
            $data['simbol_care'] = $upload_data['file_name'];

            $update = $this->db->where('id_care', $id_care);
            $update = $this->db->update('m_care', $data);

            if($update){
                redirect('c_transaksi/index_careInstructionOther');
              }else{
                  echo "Gagal";
              }
        }
    }

	public function hapus_kualitas($id_kualitas)
	{
		$this->db->where('id_kualitas', $id_kualitas);
		$this->db->delete('tbl_kualitas');

		redirect('c_transaksi/index_kualitas');
	}

	public function hapus_care($id_care)
	{
		$this->db->where('id_care', $id_care);
		$this->db->delete('m_care');

		redirect('c_transaksi/index_care');
	}

	public function hapus_careOther($id_care)
	{
		$this->db->where('id_care', $id_care);
		$this->db->delete('m_care');

		redirect('c_transaksi/index_careOther');
	}


	
	public function tambahaksi_method()
	{
		
		function postArr($key, $i)
		{
			$ci = &get_instance();
			$arr = $ci->input->post($key);

			return isset($arr[$i]) ? $arr[$i] : null;
		}

		// ===============================
		// Ambil POST
		// ===============================
		$report_no      = $this->input->post('report_no');
		$id_penerimaan  = $this->input->post('id_penerimaan');
		$id_kualitas    = $this->input->post('id_kualitas');
		$id_reportkualitas = $this->input->post('id_reportkualitas');

		$test_required  = $this->input->post('test_required');

		$id_testmatrix  = (array) $this->input->post('id_testmatrix');
		$result         = (array) $this->input->post('result');
		$status         = (array) $this->input->post('status');
		$comment        = (array) $this->input->post('comment');

		// ===============================
		// Validasi minimal IDENTITAS
		// ===============================
		if (!$report_no || !$id_penerimaan || !$id_kualitas) {
			echo "<script>alert('Data utama belum lengkap');history.back();</script>";
			exit;
		}

		// ===============================
		// Siapkan data yang benar-benar diisi
		// ===============================
		$rows = [];

		foreach ($id_testmatrix as $i => $id_tm) {

			$hasValue =
				(!empty($result[$i])) ||
				(!empty($status[$i])) ||
				(!empty($comment[$i]));

			// kalau method kosong → SKIP
			if (!$hasValue) {
				continue;
			}

			$rows[] = [
				'id_reportkualitas' => $id_reportkualitas,
				'id_penerimaan'     => $id_penerimaan,
				'id_kualitas'       => $id_kualitas,
				'report_no'         => $report_no,
				'test_required'     => is_array($test_required)
										? json_encode($test_required)
										: $test_required,

				'id_testmatrix'     => $id_tm,
				'result'            => $result[$i] ?? null,
				'status'            => $status[$i] ?? null,
				'comment'           => $comment[$i] ?? null,

				'date_sampling'     => $this->input->post('date_sampling'),
				'time_sampling'     => $this->input->post('time_sampling'),
				'date_test'         => $this->input->post('date_test'),
				'date_finish'       => $this->input->post('date_finish'),

				//SHRINKAGE
				'be_wash'    => postArr('be_wash', $i),
				'af_wash_1'  => postArr('af_wash_1', $i),
				'ac_wash_1'  => postArr('ac_wash_1', $i),

				'af_wash_5'  => postArr('af_wash_5', $i),
				'ac_wash_5'  => postArr('ac_wash_5', $i),

				'af_wash_15' => postArr('af_wash_15', $i),
				'ac_wash_15' => postArr('ac_wash_15', $i),

				//FORMALDEHYDE
				'mass_of'       => postArr('mass_of', $i),
				'range_graph_1' => postArr('range_graph_1', $i),
				'range_graph_2' => postArr('range_graph_2', $i),
				//'result_formaldehyde' => postArr('result_formaldehyde_hidden', $i),
				//'status_formaldehyde' => postArr('status_formaldehyde', $i),

				//SOCK
				'nahm_sock'			  => postArr('nahm_sock', $i),
				'result_sock'		  => postArr('result_sock', $i),
				'comment_sock'		  => postArr('comment_sock', $i),
				'status_sock'		  => postArr('status_sock', $i),

				// WASH (com_wash)
				'com_wash_app'       => $this->input->post('com_wash_app'),
				'com_wash_shrink'    => $this->input->post('com_wash_shrink'),
				'com_wash_pil'       => $this->input->post('com_wash_pil'),
				'com_wash_sta'       => $this->input->post('com_wash_sta'),
				'com_wash_dis'       => $this->input->post('com_wash_dis'),
				'com_wash_zip'       => $this->input->post('com_wash_zip'),
				'com_wash_label'     => $this->input->post('com_wash_label'),
				'com_wash_emb'       => $this->input->post('com_wash_emb'),
				'com_wash_print'     => $this->input->post('com_wash_print'),
				'com_wash_logo'		 => $this->input->post('com_wash_logo'),

				// WASH 1X
				'1_wash_print'       => $this->input->post('1_wash_print'),
				'1_wash_emb'         => $this->input->post('1_wash_emb'),
				'1_wash_label'       => $this->input->post('1_wash_label'),
				'1_wash_zip'         => $this->input->post('1_wash_zip'),
				'1_wash_dis'         => $this->input->post('1_wash_dis'),
				'1_wash_sta'         => $this->input->post('1_wash_sta'),
				'1_wash_pil'         => $this->input->post('1_wash_pil'),
				'1_wash_shrink'      => $this->input->post('1_wash_shrink'),
				'1_wash_app'         => $this->input->post('1_wash_app'),
				'1_wash_logo'		 => $this->input->post('1_wash_logo'),

				// WASH 3X
				'3_wash_print'       => $this->input->post('3_wash_print'),
				'3_wash_emb'         => $this->input->post('3_wash_emb'),
				'3_wash_label'       => $this->input->post('3_wash_label'),
				'3_wash_zip'         => $this->input->post('3_wash_zip'),
				'3_wash_dis'         => $this->input->post('3_wash_dis'),
				'3_wash_sta'         => $this->input->post('3_wash_sta'),
				'3_wash_pil'         => $this->input->post('3_wash_pil'),
				'3_wash_shrink'      => $this->input->post('3_wash_shrink'),
				'3_wash_app'         => $this->input->post('3_wash_app'),
				'3_wash_logo'		 => $this->input->post('3_wash_logo'),

				// WASH 15X
				'15_wash_print'      => $this->input->post('15_wash_print'),
				'15_wash_emb'        => $this->input->post('15_wash_emb'),
				'15_wash_label'      => $this->input->post('15_wash_label'),
				'15_wash_zip'        => $this->input->post('15_wash_zip'),
				'15_wash_dis'        => $this->input->post('15_wash_dis'),
				'15_wash_sta'        => $this->input->post('15_wash_sta'),
				'15_wash_pil'        => $this->input->post('15_wash_pil'),
				'15_wash_shrink'     => $this->input->post('15_wash_shrink'),
				'15_wash_app'        => $this->input->post('15_wash_app'),
				'15_wash_logo'		 => $this->input->post('15_wash_logo'),

				// MEASUREMENTS
				'mov_sleeve'         => $this->input->post('mov_sleeve'),
				'mov_sideseam'       => $this->input->post('mov_sideseam'),
				'sle_width'          => $this->input->post('sle_width'),
				'sideseam'           => $this->input->post('sideseam'),
				'sleeve'             => $this->input->post('sleeve'),
				'body'               => $this->input->post('body'),
				'neck_no'            => $this->input->post('neck_no'),
				'neck_yes'           => $this->input->post('neck_yes'),
				'fibre_com'          => $this->input->post('fibre_com'),
				'machine_model'      => $this->input->post('machine_model'),
				'temp'               => $this->input->post('temp'),
				'hand_dry'           => $this->input->post('hand_dry'),
				'tumble_dry'         => $this->input->post('tumble_dry'),
				'line_dry'           => $this->input->post('line_dry')
			];
		}

		// ===============================
		// TIDAK ADA DATA → BOLEH
		// ===============================
		if (empty($rows)) {
			redirect(
				'c_transaksi/index_testResult/' .
				$report_no . '/' .
				$id_kualitas . '/' .
				$id_penerimaan
			);
			return;
		}

		// ===============================
		// DB TRANSACTION
		// ===============================
		$this->db->trans_start();

		$this->db->insert_batch('report_kualitas', $rows);

		// update status kualitas (optional)
		$this->db->where('id_kualitas', $id_kualitas)
				->update('tbl_kualitas', ['status' => 'selesai']);

		$this->db->trans_complete();

		// ===============================
		// FINAL
		// ===============================
		if ($this->db->trans_status() === FALSE) {

			echo "<script>alert('Gagal menyimpan data');history.back();</script>";
			exit;

		} else {

			redirect('c_transaksi/index_kualitas');
		}
	}


	public function editaksi_method()
	{
		// Helper biar tidak Undefined Index
		function postArr($key, $i)
		{
			$ci = &get_instance();
			$arr = $ci->input->post($key);
			return isset($arr[$i]) ? $arr[$i] : null;
		}

		// Data testmatrix yang dikirim dari form
		$testmatrix_post = $this->input->post('id_testmatrix_hidden');

		// Validasi minimal 1 baris
		if (empty($testmatrix_post) || count(array_filter($testmatrix_post)) === 0) {
			$this->session->set_flashdata('error', 'Data metode pengujian tidak boleh kosong.');
			redirect('c_transaksi/edit_kualitas/' .
			$this->input->post('id_penerimaan') . '/' .
			$this->input->post('id_reportkualitas'));
			return;
		}

		$id_reportkualitas = $this->input->post('id_reportkualitas');
		$jumlah_method = count((array)$testmatrix_post);

		$data = [];

		// LOOP UPDATE
		for ($i = 0; $i < $jumlah_method; $i++) {

		$data[$i] = [
			// IDENTITAS
			'id_testmatrix'      => postArr('id_testmatrix_hidden', $i),
			'id_reportkualitas'  => $id_reportkualitas,
			'id_penerimaan'      => $this->input->post('id_penerimaan'),
			'id_kualitas'        => $this->input->post('id_kualitas'),
			'report_no'          => $this->input->post('report_no'),
			'test_required'      => $this->input->post('test_required'),

			// RESULT
			'result'             => postArr('result_hidden', $i),
			'status'             => postArr('status_hidden', $i),

			// PASS FAIL
			'passfail'           => postArr('result_passfail_hidden', $i),
			'passfail1'          => postArr('result_passfail1_hidden', $i),
			'status_passfail'    => postArr('status_passfail_hidden', $i),

			// COMMENT & STATEMENT
			'comment'            => postArr('comment_hidden', $i),
			'statement'          => postArr('statement_hidden', $i),

			// TANGGAL
			'date_sampling'      => $this->input->post('date_sampling'),
			'time_sampling'      => $this->input->post('time_sampling'),
			'date_test'          => $this->input->post('date_test'),
			'date_finish'        => $this->input->post('date_finish'),

			// STATUS TYPE
			'status_boolean'     => postArr('status_boolean', $i),
			'status_statement_result' => postArr('status_statement_result', $i),
			'status_numeric'     => postArr('status_numeric', $i),
			'status_shrinkage'   => postArr('status_shrinkage', $i),

			// SHRINKAGE
			'be_wash'    => postArr('be_wash', $i),
			'af_wash_1'  => postArr('af_wash_1', $i),
			'ac_wash_1'  => postArr('ac_wash_1', $i),
			'af_wash_5'  => postArr('af_wash_5', $i),
			'ac_wash_5'  => postArr('ac_wash_5', $i),
			'af_wash_15' => postArr('af_wash_15', $i),
			'ac_wash_15' => postArr('ac_wash_15', $i),

			// FORMALDEHYDE (⚠️ PALING KRITIS)
			'mass_of'             => postArr('mass_of_hidden', $i),
			'range_graph_1'       => postArr('range_graph_1_hidden', $i),
			'range_graph_2'       => postArr('range_graph_2_hidden', $i),
			'result_formaldehyde' => postArr('result_formaldehyde_hidden', $i),
			'status_formaldehyde' => postArr('status_formaldehyde', $i),

			// SOCK
			'nahm_sock'    => postArr('nahm_sock', $i),
			'result_sock'  => postArr('result_sock', $i),
			'comment_sock' => postArr('comment_sock', $i),
			'status_sock'  => postArr('status_sock', $i),

			// COM WASH (GLOBAL)
			'com_wash_app'    => $this->input->post('com_wash_app'),
			'com_wash_shrink' => $this->input->post('com_wash_shrink'),
			'com_wash_pil'    => $this->input->post('com_wash_pil'),
			'com_wash_sta'    => $this->input->post('com_wash_sta'),
			'com_wash_dis'    => $this->input->post('com_wash_dis'),
			'com_wash_zip'    => $this->input->post('com_wash_zip'),
			'com_wash_label'  => $this->input->post('com_wash_label'),
			'com_wash_emb'    => $this->input->post('com_wash_emb'),
			'com_wash_print'  => $this->input->post('com_wash_print'),
			'com_wash_logo'   => $this->input->post('com_wash_logo'),

			// WASH 1X
			'1_wash_print'  => $this->input->post('1_wash_print'),
			'1_wash_emb'    => $this->input->post('1_wash_emb'),
			'1_wash_label'  => $this->input->post('1_wash_label'),
			'1_wash_zip'    => $this->input->post('1_wash_zip'),
			'1_wash_dis'    => $this->input->post('1_wash_dis'),
			'1_wash_sta'    => $this->input->post('1_wash_sta'),
			'1_wash_pil'    => $this->input->post('1_wash_pil'),
			'1_wash_shrink' => $this->input->post('1_wash_shrink'),
			'1_wash_app'    => $this->input->post('1_wash_app'),
			'1_wash_logo'   => $this->input->post('1_wash_logo'),

			// WASH 3X
			'3_wash_print'  => $this->input->post('3_wash_print'),
			'3_wash_emb'    => $this->input->post('3_wash_emb'),
			'3_wash_label'  => $this->input->post('3_wash_label'),
			'3_wash_zip'    => $this->input->post('3_wash_zip'),
			'3_wash_dis'    => $this->input->post('3_wash_dis'),
			'3_wash_sta'    => $this->input->post('3_wash_sta'),
			'3_wash_pil'    => $this->input->post('3_wash_pil'),
			'3_wash_shrink' => $this->input->post('3_wash_shrink'),
			'3_wash_app'    => $this->input->post('3_wash_app'),
			'3_wash_logo'   => $this->input->post('3_wash_logo'),

			// WASH 15X
			'15_wash_print'  => $this->input->post('15_wash_print'),
			'15_wash_emb'    => $this->input->post('15_wash_emb'),
			'15_wash_label'  => $this->input->post('15_wash_label'),
			'15_wash_zip'    => $this->input->post('15_wash_zip'),
			'15_wash_dis'    => $this->input->post('15_wash_dis'),
			'15_wash_sta'    => $this->input->post('15_wash_sta'),
			'15_wash_pil'    => $this->input->post('15_wash_pil'),
			'15_wash_shrink' => $this->input->post('15_wash_shrink'),
			'15_wash_app'    => $this->input->post('15_wash_app'),
			'15_wash_logo'   => $this->input->post('15_wash_logo'),

			// MEASUREMENTS (GLOBAL)
			'mov_sleeve'    => $this->input->post('mov_sleeve'),
			'mov_sideseam'  => $this->input->post('mov_sideseam'),
			'sle_width'     => $this->input->post('sle_width'),
			'sideseam'      => $this->input->post('sideseam'),
			'sleeve'        => $this->input->post('sleeve'),
			'body'          => $this->input->post('body'),
			'neck_no'       => $this->input->post('neck_no'),
			'neck_yes'      => $this->input->post('neck_yes'),
			'fibre_com'     => $this->input->post('fibre_com'),
			'machine_model' => $this->input->post('machine_model'),
			'temp'          => $this->input->post('temp'),
			'hand_dry'      => $this->input->post('hand_dry'),
			'tumble_dry'    => $this->input->post('tumble_dry'),
			'line_dry'      => $this->input->post('line_dry')
		];
	}


		// Data summary
		$data_report = [
			'id_reportkualitas' => $id_reportkualitas,
			'id_penerimaan'     => $this->input->post('id_penerimaan'),
			'id_kualitas'       => $this->input->post('id_kualitas'),
			'result_status'     => $this->input->post('result_status'),
			'date_final'        => $this->input->post('date_final')
		];

		// TRANSAKSI
		$this->db->trans_start();

		// DELETE DATA LAMA
		$this->m_transaksi->delete_reportkualitas_by_id($id_reportkualitas);

		// INSERT DATA BARU
		$this->m_transaksi->insert_reportkualitas($data);

		// UPDATE SUMMARY
		$this->m_transaksi->update_handlingsample($data_report, $id_reportkualitas);

		// STATUS selalu ‘selesai’
		$this->db->where('id_kualitas', $this->input->post('id_kualitas'));
		$this->db->update('tbl_kualitas', ['status' => 'selesai']);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			log_message('error', 'Transaction failed during update.');
			redirect('c_transaksi/error');
		} else {
			$this->checkAndInsertFinalHandling(
				$this->input->post('id_penerimaan'),
				$this->input->post('report_no')
			);

			redirect('c_transaksi/index_kualitas');
		}
	}


	public function tambahaksi_methodbc()
	{
		$testmatrix_post = $this->input->post('id_testmatrix_hidden');

		if (empty($testmatrix_post) || count(array_filter($testmatrix_post)) === 0) {
			$this->session->set_flashdata('error', 'Data metode pengujian tidak boleh kosong.');
			redirect('c_transaksi/index_bcTestResult/' . 
				$this->input->post('report_no') . '/' . 
				$this->input->post('id_kualitas') . '/' . 
				$this->input->post('id_penerimaan'));
			return;
		}

		$jumlah_method = count((array) $this->input->post('id_testmatrix_hidden'));

		$data = [];
		for ($i = 0; $i < $jumlah_method; $i++) {
			array_push($data, ['id_testmatrix' => $this->input->post('id_testmatrix_hidden')[$i]]);
			$data[$i]['id_reportkualitas'] = $this->input->post('id_reportkualitas');
			$data[$i]['id_penerimaan'] = $this->input->post('id_penerimaan');
			$data[$i]['id_kualitas'] = $this->input->post('id_kualitas');
			$data[$i]['report_no'] = $this->input->post('report_no');
			$data[$i]['test_required'] = $this->input->post('test_required');
			$data[$i]['result'] = $this->input->post('result_hidden')[$i];
			$data[$i]['status'] = $this->input->post('status_hidden')[$i];
			$data[$i]['passfail'] = $this->input->post('result_passfail_hidden')[$i];
			$data[$i]['passfail1'] = $this->input->post('result_passfail1_hidden')[$i];
			$data[$i]['status_passfail'] = $this->input->post('status_passfail_hidden')[$i];
			$data[$i]['comment'] = $this->input->post('comment_hidden')[$i];
			$data[$i]['statement'] = $this->input->post('statement_hidden')[$i];
			$data[$i]['date_sampling'] = $this->input->post('date_sampling');
			$data[$i]['time_sampling'] = $this->input->post('time_sampling');
			$data[$i]['date_test'] = $this->input->post('date_test');
			$data[$i]['date_finish'] = $this->input->post('date_finish');
		}

		$data_report = array(
			'id_reportkualitas' => $this->input->post('id_reportkualitas'),
			'id_penerimaan' => $this->input->post('id_penerimaan'),
			'id_kualitas' => $this->input->post('id_kualitas'),
			'result_status' => $this->input->post('result_status'),
			'date_final' => $this->input->post('date_final') // ditambahkan agar seragam
		);

		$this->db->trans_start();

		$this->m_transaksi->insert_reportkualitas($data);
		$this->m_transaksi->insert_handlingsample($data_report);

		// Update status kualitas jadi selesai
		$this->db->where('id_kualitas', $this->input->post('id_kualitas'));
		$this->db->update('tbl_kualitas', ['status' => 'selesai']);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			log_message('error', 'Transaction failed during insert.');
			redirect('c_transaksi/error');
		} else {
			// Check insert ke final handling
			$this->checkAndInsertFinalHandling(
				$this->input->post('id_penerimaan'),
				$this->input->post('report_no')
			);

			// Redirect ke halaman hasil barcode
			redirect('c_transaksi/index_bcKualitas/' . url_title($this->input->post('report_no'), 'dash', TRUE));
		}
	}


	public function tambahaksi_methodOther()
	{
		$jumlah_method = count((array) $this->input->post('id_testmatrix_hidden'));

		$data = [];
		for ($i = 0; $i < $jumlah_method; $i++) {
			array_push($data, ['id_testmatrix' => $this->input->post('id_testmatrix_hidden')[$i]]);
			$data[$i]['id_reportkualitas'] = $this->input->post('id_reportkualitas');
			$data[$i]['id_penerimaan'] = $this->input->post('id_penerimaan');
			$data[$i]['id_kualitas'] = $this->input->post('id_kualitas');
			$data[$i]['report_no'] = $this->input->post('report_no');
			$data[$i]['test_required'] = $this->input->post('test_required');
			$data[$i]['result'] = $this->input->post('result_hidden')[$i];
			$data[$i]['status'] = $this->input->post('status_hidden')[$i];
			$data[$i]['passfail'] = $this->input->post('result_passfail_hidden')[$i];
			$data[$i]['passfail1'] = $this->input->post('result_passfail1_hidden')[$i];
			$data[$i]['status_passfail'] = $this->input->post('status_passfail_hidden')[$i];
			$data[$i]['comment'] = $this->input->post('comment_hidden')[$i];
			$data[$i]['statement'] = $this->input->post('statement_hidden')[$i];
			$data[$i]['date_sampling'] = $this->input->post('date_sampling');
			$data[$i]['time_sampling'] = $this->input->post('time_sampling');
			$data[$i]['date_test'] = $this->input->post('date_test');
			$data[$i]['date_finish'] = $this->input->post('date_finish');
		}

		// Data untuk report_handlingsample
		$data_report = array(
			'id_reportkualitas' => $this->input->post('id_reportkualitas'),
			'id_penerimaan' => $this->input->post('id_penerimaan'),
			'id_kualitas' => $this->input->post('id_kualitas'),
			'result_status' => $this->input->post('result_status')
		);

		// Mulai transaksi
		$this->db->trans_start();

		// Masukkan data ke reportkualitas
		$this->m_transaksi->insert_reportkualitas($data);

		// Masukkan data ke report_handlingsample
		$this->m_transaksi->insert_handlingsample($data_report);

		// Selesaikan transaksi
		$this->db->trans_complete();

		// Periksa status transaksi
		if ($this->db->trans_status() === FALSE) {
			log_message('error', 'Transaction failed during insert.');
			// Anda bisa mengarahkan kembali atau menampilkan error
			redirect('c_transaksi/error');
		} else {
			// Jika sukses, alihkan ke halaman berikutnya
			redirect('c_transaksi/index_kualitasOther');
		}
	}
	
	public function index_user()
	{
		$data['user'] = $this->m_transaksi->tampil_data()->result();
        $data['level'] = $this->m_transaksi->get_level()->result();
		$this->template->load('layout/template', 'adidas/user/account/index', $data);
	}

	public function tambah_user()
	{
		$data['user'] = $this->m_transaksi->tampil_data()->result();
        $data['level'] = $this->m_transaksi->get_level()->result();
		$this->template->load('layout/template', 'adidas/user/account/tambah', $data);
	}

		public function edit_user($id_user)
		{
			$where = ['id_user' => $id_user];

			$data['u'] = $this->m_transaksi->GetByIdUser($where); // 1 object
			$data['level'] = $this->m_transaksi->get_level()->result();
			$data['user'] = $this->m_transaksi->tampil_data()->result();
			
			$this->template->load(
				'layout/template',
				'adidas/user/account/edit',
				$data
			);
		}

		public function editaksi_account()
{
    // ambil data dari form
    $id_user     = $this->input->post('id_user');
    $nama        = $this->input->post('nama');
    $username    = $this->input->post('username');
    $password    = $this->input->post('password');
    $id_level    = $this->input->post('id_level');
    $user_status = $this->input->post('user_status');

    // data utama (tanpa password dulu)
    $data = [
        'nama'        => $nama,
        'username'    => $username,
        'id_level'    => $id_level,
        'user_status' => $user_status
    ];

    // kalau password diisi → update
    if (!empty($password)) {
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    // update ke DB
    $this->db->where('id_user', $id_user);
    $update = $this->db->update('tbl_login', $data);

    // feedback
    if ($update) {
        $this->session->set_flashdata('success', 'Data user berhasil diperbarui');
    } else {
        $this->session->set_flashdata('error', 'Gagal memperbarui data user');
    }

    redirect('c_transaksi/account');
}




	public function index_userOther()
	{
		$data['user'] = $this->m_transaksi->tampil_data()->result();
        $data['level'] = $this->m_transaksi->get_level()->result();
		$this->template->load('layoutOther/template', 'adidas/user/tambah', $data);
	}
	
	public function hapus($id_user)
    {
        $this->m_transaksi->delete_user($id_user);

        redirect('c_transaksi/index_user');
    }

	public function hapusOther($id_user)
    {
        $this->m_transaksi->delete_user($id_user);

        redirect('c_transaksi/index_userOther');
    }

	public function tambah()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            //'user_status' => $this->input->post('user_status'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'id_level' => $this->input->post('id_level')
        );

        $this->m_transaksi->insert_user($data, 'tbl_login');

        redirect('c_transaksi/index_user');
    }

	public function tambahOther()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            //'user_status' => $this->input->post('user_status'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'id_level' => $this->input->post('id_level')
        );

        $this->m_transaksi->insert_user($data, 'tbl_login');

        redirect('c_transaksi/index_userOther');
    }

	public function ambil_dataorder($id_order = null)
	{
		$data = $this->db->get_where('tbl_order', ['id_order' => $id_order])->row();

		if ($data) {
			$this->session->set_flashdata('id_order', $data->id_order);
			$this->session->set_flashdata('working_number', $data->working_number);
			$this->session->set_flashdata('item_name', $data->item_name);
			$this->session->set_flashdata('style', $data->style);
			$this->session->set_flashdata('brand', $data->brand);
			$this->session->set_flashdata('order_number', $data->order_number);
			$this->session->set_flashdata('costumer_code', $data->costumer_code);
			$this->session->set_flashdata('costumer_name', $data->costumer_name);
			$this->session->set_flashdata('article_no', $data->article_no);
			$this->session->set_flashdata('color', $data->color);
			$this->session->set_flashdata('age', $data->age);
			$this->session->set_flashdata('podd', $data->podd);
			$this->session->set_flashdata('lco', $data->lco);
			$this->session->set_flashdata('po_quantity', $data->po_quantity);
			$this->session->set_flashdata('production_date', $data->production_date);
			$this->session->set_flashdata('season', $data->season);
			$this->session->set_flashdata('line', $data->line);
		}

		redirect('c_transaksi/tambah_penerimaan');
	}

	public function get_dataorder()
	{
		$order_number = $this->input->post('order_number');
		$data = $this->db->get_where('tbl_order', ['order_number' => $order_number])->row_array();

		echo json_encode($data);
	}

	/*public function index_rilis($id_penerimaan, $new_report_no)
	{
		$this->data['riwayat'] = $this->m_transaksi->getHistoryNo($id_penerimaan);
		$this->data['id_penerimaan'] = $id_penerimaan; 
		$this->data['new_report_no'] = $new_report_no;
		$this->data['report'] = $this->m_transaksi->get_report_data_all($id_penerimaan);
		//$this->data['handling'] = $this->m_transaksi->get_report_data_adidas($id_penerimaan); 
		$this->data['method'] = $this->m_transaksi->get_reportmethod_adidasAll($id_penerimaan, $new_report_no);
        $this->data['ttd'] = $this->m_transaksi->tampil_ttd()->result();
		
		if (!$this->data['method']){
			show_404();
			return;
		}
		$this->template->load('layout/template', 'adidas/report/re_rilis.php', $this->data);
	}*/
	/*public function index_rilis($id_penerimaan, $new_report_no)
	{
		$this->data['riwayat'] = $this->m_transaksi->getHistoryNo($id_penerimaan);
		$this->data['id_penerimaan'] = $id_penerimaan; 
		$this->data['new_report_no'] = $new_report_no;

		// 🔹 AMBIL REPORT NO LAMA
		$last = $this->db->query("
			SELECT report_no
			FROM report_finalhandling
			WHERE id_penerimaan = ?
			ORDER BY id_final DESC
			LIMIT 1
		", [$id_penerimaan])->row();

		$this->data['report_no'] = $last ? $last->report_no : $new_report_no;

		$this->data['report'] = $this->m_transaksi->get_report_data_all($id_penerimaan);
		$this->data['method'] = $this->m_transaksi->get_reportmethod_adidasAll($id_penerimaan, $new_report_no);
		$this->data['ttd'] = $this->m_transaksi->tampil_ttd()->result();

		if (!$this->data['method']){
			show_404();
			return;
		}

		$this->template->load('layout/template', 'adidas/report/re_rilis.php', $this->data);
	}*/
	/*public function index_rilis($id_penerimaan, $report_no)
	{
		$this->data['riwayat'] = $this->m_transaksi->getHistoryNo($id_penerimaan);
		// ⬅️ INI YANG KURANG
		$this->data['id_penerimaan'] = $id_penerimaan;

		/* ===============================
		VALIDASI REPORT PERTAMA
		=============================== 
		$current = $this->db->query("
			SELECT report_no, new_report_no
			FROM report_kualitas
			WHERE id_penerimaan = ?
			AND report_no = ?
			LIMIT 1
		", [$id_penerimaan, $report_no])->row();

		if (!$current) {
			show_404();
			return;
		}

		$this->data['report_no']     = $current->report_no;
		$this->data['new_report_no'] = $current->new_report_no; // boleh null

		/* ===============================
		DATA REPORT
		=============================== 
		$this->data['report'] = $this->m_transaksi
			->get_report_data_all($id_penerimaan, $current->new_report_no);

		$this->data['method'] = $this->m_transaksi
			->get_reportmethod_adidasAll($id_penerimaan, $current->new_report_no);

		$this->data['ttd'] = $this->m_transaksi
			->tampil_ttd()
			->result();

		if (!$this->data['method']) {
			show_404();
			return;
		}

		$this->template->load(
			'layout/template',
			'adidas/report/re_rilis.php',
			$this->data
		);
	}*/
	public function index_rilis($id_penerimaan, $report_no)
	{
		$this->data['riwayat'] = $this->m_transaksi->getHistoryNo($id_penerimaan);
		$this->data['id_penerimaan'] = $id_penerimaan;

		/* ===============================
		VALIDASI REPORT (MASTER / FINAL)
		=============================== */
		$current = $this->db->query("
			SELECT report_no, new_report_no
			FROM report_kualitas
			WHERE id_penerimaan = ?
			AND (report_no = ? OR new_report_no = ?)
			LIMIT 1
		", [$id_penerimaan, $report_no, $report_no])->row();

		if (!$current) {
			show_404();
			return;
		}

		$this->data['report_no']     = $current->report_no;
		$this->data['new_report_no'] = $current->new_report_no;

		/* ===============================
		DATA REPORT (PAKAI FINAL)
		=============================== */
		$this->data['report'] = $this->m_transaksi
			->get_report_data_all($id_penerimaan, $current->new_report_no);

		$this->data['method'] = $this->m_transaksi
			->get_reportmethod_adidasAll($id_penerimaan, $current->new_report_no);

		$this->data['ttd'] = $this->m_transaksi
			->tampil_ttd()
			->result();

		if (!$this->data['method']) {
			$this->data['method'] = []; // biar view aman
			//$this->data['warning_method'] = true;
		}

		
		$this->template->load(
			'layout/template',
			'adidas/report/re_rilis.php',
			$this->data
		);
	}


	public function update_report($id_reportkualitas, $id_handlingsample)
	{
		// Ambil data
		$data['detail'] = $this->m_transaksi->getReportUpdate($id_reportkualitas, $id_handlingsample)->row();
		$data['method'] = $this->m_transaksi->getReportMethod($id_reportkualitas);

		// Cek level user
		$user_level = $this->session->userdata('level');

		// Jika level 10 (barcode user) maka load view khusus
		if ($user_level == 10) {
			$this->load->view('adidas/report/update_bc', $data);
		} else {
			$this->template->load('layout/template', 'adidas/report/update', $data);
		}
	}

public function simpan_rilis()
{
    $id_penerimaan   = $this->input->post('id_penerimaan');
    $report_no       = $this->input->post('report_no');
    $jenis_report    = $this->input->post('jenis_report');
    $date_sending    = $this->input->post('date_sending');
    $signature       = $this->input->post('signature');
    $review          = $this->input->post('review');
    $authorized      = $this->input->post('authorized');
    $comment         = $this->input->post('comment');
    $remarks         = $this->input->post('remarks');
    $adding_type     = $this->input->post('adding_type');
	$personil		 = $this->input->post('personil');

    $this->db->trans_start();

    /* =====================================================
       1️⃣ HANDLE REPORT NUMBER (ADDING LOGIC)
    ====================================================== */

    $new_report_no = $report_no;
    $next_version  = 0;

    preg_match('/(-[A-Z]+)$/', $report_no, $m);
    $suffix = $m[1] ?? '';
    $base_without_suffix = str_replace($suffix, '', $report_no);

    if ($adding_type === 'adding') {

        $base_exist = $this->db->where('id_penerimaan', $id_penerimaan)
            ->where('jenis_report', $jenis_report)
            ->where('new_report_no', $report_no)
            ->count_all_results('report_finalhandling');

        if ($base_exist > 0) {

            $like = $base_without_suffix . "A%{$suffix}";

            $max = $this->db->query("
                SELECT MAX(
                    CAST(
                        SUBSTRING_INDEX(
                            SUBSTRING_INDEX(new_report_no, 'A', -1),
                        '-', 1
                    ) AS UNSIGNED)
                ) AS max_ver
                FROM report_finalhandling
                WHERE id_penerimaan = ?
                AND jenis_report = ?
                AND new_report_no LIKE ?
            ", [$id_penerimaan, $jenis_report, $like])->row();

            $next_version = ($max && $max->max_ver)
                ? ((int)$max->max_ver + 1)
                : 1;

            $new_report_no = $base_without_suffix . 'A' . $next_version . $suffix;
        }
    }

    /* =====================================================
       2️⃣ HITUNG RESULT STATUS
    ====================================================== */

    $result_status = 'PASS';

    $fail = $this->db->where('id_penerimaan', $id_penerimaan)
        ->where('report_no', $report_no)
       // ->where('jenis_report', $jenis_report)
        ->where('status', 'FAIL')
        ->count_all_results('report_kualitas');

    if ($fail > 0) {
        $result_status = 'FAIL';
    }

    /* =====================================================
       3️⃣ AMBIL TEST YANG BELUM SELESAI
    ====================================================== */

    $tests = $this->db->select('test_required')
        ->from('tbl_kualitas')
        ->where('id_penerimaan', $id_penerimaan)
        ->where('report_no', $report_no)
        ->where('(status IS NULL OR status != "selesai")', null, false)
        ->get()
        ->result();

    /* =====================================================
       4️⃣ INSERT FINAL HANDLING
    ====================================================== */

    if (!empty($tests)) {

        foreach ($tests as $row) {

            $this->db->insert('report_finalhandling', [
                'id_penerimaan' => $id_penerimaan,
                'report_no'     => $report_no,
                'new_report_no' => $new_report_no,
                'date_sending'  => $date_sending,
                'signature'     => $signature,
                'review'        => $review,
                'authorized'    => $authorized,
                'comment_final' => $comment,
                'remarks_final' => $remarks,
                'jenis_report'  => $jenis_report,
                'test_required' => $row->test_required,
                'result_status' => $result_status,
				'personil'		=> $personil
            ]);
        }

        /* =============================================
           5️⃣ UPDATE tbl_kualitas → selesai
        ============================================== */

        $test_names = array_map(function($r){
            return $r->test_required;
        }, $tests);

        $this->db->where('id_penerimaan', $id_penerimaan);
        $this->db->where('report_no', $report_no);
        $this->db->where_in('test_required', $test_names);
        $this->db->update('tbl_kualitas', [
            'status' => 'selesai'
        ]);
    }

    /* =====================================================
       6️⃣ UPDATE report_kualitas (rilis flag)
    ====================================================== */

    $this->db->where('id_penerimaan', $id_penerimaan);
    $this->db->where('report_no', $report_no);
    //$this->db->where('jenis_report', $jenis_report);
    $this->db->where('(rilis IS NULL OR rilis = 0)', null, false);

    $this->db->update('report_kualitas', [
        'new_report_no' => $new_report_no,
        'rilis'         => ($adding_type === 'adding') ? $next_version : 1
    ]);

    $this->db->trans_complete();

    redirect('c_transaksi/index_reportAll');
}





	public function get_report_no($id_penerimaan, $reportType)
	{
		// Ambil report terakhir berdasarkan id_penerimaan
		$last = $this->db->query("
			SELECT report_no 
			FROM report_finalhandling 
			WHERE id_penerimaan = ?
			ORDER BY id_final DESC 
			LIMIT 1
		", [$id_penerimaan])->row();

		if ($last) {
			// Jika sudah ada rilisan, generate new_report_no otomatis
			if (preg_match('/A(\d+)/', $last->report_no, $m)) {
				$next = intval($m[1]) + 1;
				$new_report_no = preg_replace('/A\d+/', "A{$next}", $last->report_no);
			} else {
				$new_report_no = str_replace('/AF', 'A1/AF', $last->report_no);
			}
		} else {
			// Rilis pertama
			$new_report_no = $reportType; // bisa juga gunakan default report_no
		}

		// Kembalikan dalam format JSON
		echo json_encode(['report_no' => $new_report_no]);
	}


	//REPORT
		public function fgt($id_penerimaan, $new_report_no)
		{
			$this->load->model('M_transaksi');

			/* ===================================================
			1️⃣ AMBIL DATA REPORT FINAL
			=================================================== */
			$report = $this->M_transaksi->get_report_data_all($id_penerimaan, $new_report_no);

			if (!$report) {
				show_404();
				return;
			}

			/* ===================================================
			2️⃣ AMBIL DATA METHOD (BERDASARKAN new_report_no)
			=================================================== */
			$method = $this->M_transaksi->get_reportmethod_adidasAll($id_penerimaan, $new_report_no);

			if (!$method) {
				show_404();
				return;
			}

			/* ===================================================
			3️⃣ HITUNG SUBSCRIPT (A1, A2, dst)
			=================================================== */
			$subscript = '';
			if (!empty($new_report_no) && preg_match('/A\d+/', $new_report_no, $m)) {
				$subscript = $m[0]; // Contoh: A1, A2
			}

			/* ===================================================
			4️⃣ PERSIAPAN DATA UNTUK VIEW
			=================================================== */
			$this->data['report']    = $report;
			$this->data['method']    = $method;
			$this->data['subscript'] = $subscript;
			$this->data['title']     = 'FABRIC TEST REPORT';
			$this->data['no']        = 1; // nomor urut table jika perlu

			/* ===================================================
			5️⃣ GENERATE PDF DENGAN DOMPDF
			=================================================== */
			$options = new \Dompdf\Options();
			$options->set('isHtml5ParserEnabled', true);
			$options->set('isPhpEnabled', true);

			$dompdf = new \Dompdf\Dompdf($options);
			$dompdf->setPaper('A4', 'portrait');

			$html = $this->load->view(
				'adidas/report/report_rilis/fgt',
				$this->data,
				true
			);

			$dompdf->loadHtml($html);
			$dompdf->render();

			$dompdf->stream(
				'FGT Report ' . date('d F Y'),
				["Attachment" => false]
			);
		}


		public function fgwt($id_penerimaan, $new_report_no) 
{
    $this->load->model('m_transaksi');

    /* ===================================================
       1️⃣ AMBIL DATA REPORT FINAL
       =================================================== */
    $report = $this->m_transaksi->get_report_data_all($id_penerimaan, $new_report_no);

    if (!$report) {
        show_404();
        return;
    }

    /* ===================================================
       2️⃣ AMBIL DATA METHOD (BERDASARKAN new_report_no)
       =================================================== */
    $method = $this->m_transaksi->get_reportmethod_adidasAll($id_penerimaan, $new_report_no);

    if (!$method) {
        show_404();
        return;
    }

    /* ===================================================
       3️⃣ AMBIL CHECKLIST & SHRINKAGE
       =================================================== */
    $ceklis    = $this->m_transaksi->get_reportmethod_checklist($id_penerimaan);
    $shrinkage = $this->m_transaksi->get_reportmethod_shrinkage($id_penerimaan);

    /* ===================================================
       4️⃣ HITUNG SUBSCRIPT (A1, A2, dst)
       =================================================== */
    $subscript = '';
    if (!empty($new_report_no) && preg_match('/A\d+/', $new_report_no, $m)) {
        $subscript = $m[0]; // Contoh: A1, A2
    }

    /* ===================================================
       5️⃣ CARE INSTRUCTION
       =================================================== */
    foreach ($report as $r) {
        $care_ids = [
            $r->washing,
            $r->bleach,
            $r->drying,
            $r->ironing,
            $r->profess
        ];

        $care_images = [];

        foreach ($care_ids as $id) {
            if (empty($id)) continue;

            $care = $this->db->get_where('m_care', ['id_care' => $id])->row();
            if (!$care || empty($care->simbol_care)) continue;

            $path = FCPATH . 'images/care_instruction/' . $care->simbol_care;
            if (!file_exists($path)) continue;

            $care_images[] = base64_encode(file_get_contents($path));
        }

        $r->care_images = $care_images;
    }

    /* ===================================================
       6️⃣ PERSIAPAN DATA UNTUK VIEW
       =================================================== */
    $this->data['report']    = $report;
    $this->data['method']    = $method;
    $this->data['ceklis']    = $ceklis;
    $this->data['shrinkage'] = $shrinkage;
    $this->data['subscript'] = $subscript;
    $this->data['title']     = 'Finished Garment Wash Test Report';
    $this->data['no']        = 1;

    /* ===================================================
       7️⃣ GENERATE PDF
       =================================================== */
    $options = new \Dompdf\Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);

    $dompdf = new \Dompdf\Dompdf($options);
    $dompdf->setPaper('A4', 'portrait');

    $html = $this->load->view('adidas/report/report_rilis/fgwt', $this->data, true);

    $dompdf->loadHtml($html);
    $dompdf->render();

    $dompdf->stream(
        'Finished Garment Wash Test Report ' . date('d F Y'),
        ["Attachment" => false]
    );
}

		public function ftr($id_penerimaan, $new_report_no)
		{
			$this->load->model('m_transaksi');

			/* ===================================================
			1️⃣ AMBIL DATA REPORT FINAL
			=================================================== */
			$report = $this->m_transaksi->get_report_data_all($id_penerimaan, $new_report_no);

			if (!$report) {
				show_404();
				return;
			}

			/* ===================================================
			2️⃣ AMBIL DATA METHOD (BERDASARKAN new_report_no)
			=================================================== */
			$method = $this->m_transaksi->get_reportmethod_adidasAll($id_penerimaan, $new_report_no);

			if (!$method) {
				show_404();
				return;
			}

			/* ===================================================
			3️⃣ HITUNG SUBSCRIPT (A1, A2, dst)
			=================================================== */
			$subscript = '';
			if (!empty($new_report_no) && preg_match('/A\d+/', $new_report_no, $m)) {
				$subscript = $m[0]; // Contoh: A1, A2
			}

			/* ===================================================
			4️⃣ PERSIAPAN DATA UNTUK VIEW
			=================================================== */
			$this->data['report']    = $report;
			$this->data['method']    = $method;
			$this->data['subscript'] = $subscript;
			$this->data['title']     = 'FABRIC TEST REPORT';
			$this->data['no']        = 1; // nomor urut tabel jika perlu

			/* ===================================================
			5️⃣ GENERATE PDF
			=================================================== */
			$options = new \Dompdf\Options();
			$options->set('isHtml5ParserEnabled', true);
			$options->set('isPhpEnabled', true);

			$dompdf = new \Dompdf\Dompdf($options);
			$dompdf->setPaper('A4', 'portrait');

			$html = $this->load->view('adidas/report/report_rilis/ftr', $this->data, true);

			$dompdf->loadHtml($html);
			$dompdf->render();

			$dompdf->stream(
				'FGT Report ' . date('d F Y'),
				["Attachment" => false]
			);
		}



	public function swtr($id_penerimaan, $new_report_no)
	{
			$this->data['report'] = $this->m_transaksi->get_report_data_all($id_penerimaan, $new_report_no);
			$this->data['method'] = $this->m_transaksi->get_reportmethod_adidasAll($id_penerimaan, $new_report_no);
			$this->data['ceklis'] = $this->m_transaksi->get_reportmethod_checklist($id_penerimaan);
			$this->data['shrinkage'] = $this->m_transaksi->get_reportmethod_shrinkage($id_penerimaan);

					if (!$this->data['method']) {
						show_404();
						return;
					}

					//CARE INSTRUCTION
					foreach ($this->data['report'] as $r) {

						$care_ids = [
							$r->washing,
							$r->bleach,
							$r->drying,
							$r->ironing,
							$r->profess
						];

						$care_images = [];

						foreach ($care_ids as $id) {

							if (empty($id)) {
								continue; // kalau kosong skip
							}

							$care = $this->db->get_where('m_care', ['id_care' => $id])->row();

							if (!$care || empty($care->simbol_care)) {
								continue; // kalau tidak cocok di DB skip
							}

							$path = FCPATH . 'images/' . $care->simbol_care;

							if (!file_exists($path)) {
								continue; // file tidak ada → skip
							}

							// aman → tambahkan ke array
							$care_images[] = base64_encode(file_get_contents($path));
						}

						// jika benar-benar tidak ada gambar → tetap array kosong
						$r->care_images = $care_images;
				}


			// Set data untuk title dan lainnya
			$this->data['title'] = 'Sock Wash Test Report';
			$this->data['no'] = 1;

			// DomPDF
			$options = new Options();
			$options->set('isHtml5ParserEnabled', true);
			$options->set('isPhpEnabled', true);

			$dompdf = new Dompdf($options);
			$dompdf->setPaper('A4', 'portrait');

			/* ===============================
			SUBSCRIPT (A1, A2, dst)
			================================ */
			$subscript = '';
			if (!empty($new_report_no) && preg_match('/A\d+/', $new_report_no, $m)) {
				$subscript = $m[0]; // A1, A2
			}

			$this->data['subscript'] = $subscript;

			// Load HTML
			$html = $this->load->view('adidas/report/report_rilis/swtr', $this->data, true);

			$dompdf->loadHtml($html);
			$dompdf->render();

			// Output PDF
			$dompdf->stream('Sock Wash Test Report ' . date('d F Y'), array("Attachment" => false));
	}
		public function ftrf($id_penerimaan, $new_report_no)
		{
			$this->data['report'] = $this->m_transaksi->get_report_data_all($id_penerimaan,  $new_report_no);
			//$this->data['handling'] = $this->m_transaksi->get_report_data_adidas($id_penerimaan); 
			$this->data['method'] = $this->m_transaksi-> get_reportmethod_adidasAll($id_penerimaan, $new_report_no);

			if (!$this->data['method']){
				show_404();
				return;
			}

			// Set data untuk title dan lainnya
			$this->data['title'] = 'FABRIC TEST REPORT';
			$this->data['no'] = 1; // Ini bisa diubah sesuai kebutuhan

			// Menyiapkan Dompdf
			$options = new Options();
			$options->set('isHtml5ParserEnabled', true);
			$options->set('isPhpEnabled', true); // Enable PHP in HTML (Jika diperlukan)

			// Inisialisasi Dompdf dengan options
			$dompdf = new Dompdf($options);

			$dompdf->setPaper('A4', 'portrait'); // Set ukuran kertas

			
			/* ===============================
			SUBSCRIPT (A1, A2, dst)
			================================ */
			$subscript = '';
			if (!empty($new_report_no) && preg_match('/A\d+/', $new_report_no, $m)) {
				$subscript = $m[0]; // A1, A2
			}

			$this->data['subscript'] = $subscript;

			// Muat view HTML untuk laporan
			$html = $this->load->view('adidas/report/report_rilis/ftrf', $this->data, true);

			// Load HTML ke Dompdf dan render
			$dompdf->loadHtml($html);
			$dompdf->render();

			// Mengunduh atau menampilkan hasil PDF
			$dompdf->stream('FGT Report ' . date('d F Y'), array("Attachment" => false)); // Tampilkan PDF di browser
		}
	
		public function ttr1($id_penerimaan, $new_report_no)
		{
			$this->data['report'] = $this->m_transaksi->get_report_data_all($id_penerimaan, $new_report_no);
			//$this->data['handling'] = $this->m_transaksi->get_report_data_adidas($id_penerimaan); 
			$this->data['method'] = $this->m_transaksi-> get_reportmethod_adidasAll($id_penerimaan, $new_report_no);

			if (!$this->data['method']){
				show_404();
				return;
			}

			// Set data untuk title dan lainnya
			$this->data['title'] = 'TRIM TEST REPORT';
			$this->data['no'] = 1; // Ini bisa diubah sesuai kebutuhan

			// Menyiapkan Dompdf
			$options = new Options();
			$options->set('isHtml5ParserEnabled', true);
			$options->set('isPhpEnabled', true); // Enable PHP in HTML (Jika diperlukan)

			// Inisialisasi Dompdf dengan options
			$dompdf = new Dompdf($options);

			$dompdf->setPaper('A4', 'portrait'); // Set ukuran kertas

			
			/* ===============================
			SUBSCRIPT (A1, A2, dst)
			================================ */
			$subscript = '';
			if (!empty($new_report_no) && preg_match('/A\d+/', $new_report_no, $m)) {
				$subscript = $m[0]; // A1, A2
			}

			$this->data['subscript'] = $subscript;

			// Muat view HTML untuk laporan
			$html = $this->load->view('adidas/report/report_rilis/ttr1', $this->data, true);

			// Load HTML ke Dompdf dan render
			$dompdf->loadHtml($html);
			$dompdf->render();

			// Mengunduh atau menampilkan hasil PDF
			$dompdf->stream('TRIM TEST REPORT ' . date('d F Y'), array("Attachment" => false)); // Tampilkan PDF di browser
		}
		public function ttr2($id_penerimaan, $new_report_no)
		{
			$this->data['report'] = $this->m_transaksi->get_report_data_all($id_penerimaan, $new_report_no);
			//$this->data['handling'] = $this->m_transaksi->get_report_data_adidas($id_penerimaan); 
			$this->data['method'] = $this->m_transaksi-> get_reportmethod_adidasAll($id_penerimaan, $new_report_no);

			if (!$this->data['method']){
				show_404();
				return;
			}

			// Set data untuk title dan lainnya
			$this->data['title'] = 'TRIM TEST REPORT';
			$this->data['no'] = 1; // Ini bisa diubah sesuai kebutuhan

			// Menyiapkan Dompdf
			$options = new Options();
			$options->set('isHtml5ParserEnabled', true);
			$options->set('isPhpEnabled', true); // Enable PHP in HTML (Jika diperlukan)

			// Inisialisasi Dompdf dengan options
			$dompdf = new Dompdf($options);

			$dompdf->setPaper('A4', 'portrait'); // Set ukuran kertas

			
			/* ===============================
			SUBSCRIPT (A1, A2, dst)
			================================ */
			$subscript = '';
			if (!empty($new_report_no) && preg_match('/A\d+/', $new_report_no, $m)) {
				$subscript = $m[0]; // A1, A2
			}

			$this->data['subscript'] = $subscript;

			// Muat view HTML untuk laporan
			$html = $this->load->view('adidas/report/report_rilis/ttr2', $this->data, true);

			// Load HTML ke Dompdf dan render
			$dompdf->loadHtml($html);
			$dompdf->render();

			// Mengunduh atau menampilkan hasil PDF
			$dompdf->stream('TRIM TEST REPORT ' . date('d F Y'), array("Attachment" => false)); // Tampilkan PDF di browser
		}

		public function get_test_required($id_penerimaan)
		{
			$data['tests'] = $this->m_transaksi
				->getTestRequiredByPenerimaan($id_penerimaan)
				->result();

			$this->load->view('adidas/kualitas/_list_test_required', $data);
		}

		public function deleteReportHandling()
		{
			$id_handlingsample = $this->input->post('id_handlingsample');

			if (!$id_handlingsample) {
				echo json_encode([
					'status' => false,
					'message' => 'ID Handling Sample tidak ditemukan'
				]);
				return;
			}

			$result = $this->m_transaksi->deleteReportHandling($id_handlingsample);

			echo json_encode([
				'status' => $result,
				'message' => $result ? 'Data berhasil dihapus' : 'Gagal menghapus data'
			]);
		}

}
