<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class c_transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
        $this->load->helper(array('url','form'));
		$this->load->model('m_login');
		$this->load->model('m_transaksi');
		$this->load->library('upload');
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

			$penerimaan_per_bulan = $this->m_transaksi->getPenerimaanPerBulan();
			$bulan = [];
			$jumlah = [];

			foreach ($penerimaan_per_bulan as $row) {
				$bulan[] = date('F Y', strtotime($row->bulan . '-01')); // ubah jadi format "Juni 2025"
				$jumlah[] = $row->total;
			}

			$data['penerimaan_bulan_labels'] = $bulan;
			$data['penerimaan_bulan_values'] = $jumlah;

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
		$this->template->load('layout/template','adidas/penerimaan/tambah.php', $data);
	}


	public function tambahaksi_penerimaan()
	{
		// Generate data untuk QR code
		$qrcode_data = $this->_generate_data_qrcode();

		// Mendapatkan data input dari form
		$color = $this->input->post('color');
		$test_required = $this->input->post('test_required');
		$color_of = $this->input->post('color_of');

		// Filter nilai kosong atau hanya spasi dari test_required
		if (is_array($test_required)) {
			$test_required = array_filter($test_required, function($value) {
				return !empty(trim($value)); // Menghapus nilai kosong atau spasi
			});
		}

		// Validasi jika kedua input adalah array dan tidak kosong
		if (is_array($color) && is_array($test_required) && count($color) > 0 && count($test_required) > 0) {
		foreach ($color as $i => $c) {
			$co = $color_of[$i] ?? null; // Ambil sesuai index
			foreach ($test_required as $t) {
				$this->m_transaksi->saveKualitas(
					$t,
					$c,
					$co,
					$this->input->post('id_kualitas'),
					$this->input->post('color_of_name'),
					$this->input->post('id_penerimaan'),
					$this->input->post('report_no')
				);
			}
		}
		echo "Data Berhasil disimpan";
	} else {
		echo "Error: Input Color atau Test Required tidak valid.";
		return;
	}

		// Mengambil data file gambar yang diupload
		$image_upload = $_FILES['image_path'];

		// Cek apakah file ada dan valid
		if (isset($image_upload) && $image_upload['error'] == 0) {
			$config = array(
				'upload_path' => FCPATH . 'images/', // Path lengkap
				'allowed_types' => 'jpg|jpeg|png|gif', // Tipe file yang diperbolehkan
				'max_size' => 5000, // Ukuran maksimal file dalam KB
				'file_name' => time() . '_' . $image_upload['name'], // Nama file yang unik
			);

			// Load dan inisialisasi library upload dengan konfigurasi baru
			$this->load->library('upload');
			$this->upload->initialize($config);

			// Proses upload file
			if ($this->upload->do_upload('image_path')) {
				// Mendapatkan nama file yang sudah diupload
				$uploaded_data = $this->upload->data();
				$image_path = $uploaded_data['file_name']; // Nama file yang diupload
			} else {
				echo "Error: " . $this->upload->display_errors();
				return;
			}
		} else {
			//$image_path = null; // Jika tidak ada file yang diupload
			//$image_path = $this->input->post('old_image_path'); 
			$image_path = $this->input->post('existing_image_path');
		}

		// Menyimpan data penerimaan utama
		$penerimaan = array(
			'id_penerimaan' => $this->input->post('id_penerimaan'),
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
			'qrcode_path' => $this->_generate_qrcode($this->input->post('report_no'), $qrcode_data),
			'qrcode_data' => $qrcode_data,
			'image_path' => $image_path // Menambahkan path gambar ke dalam data
			
		);

		$penerimaan['id_penerimaan'] = $this->m_transaksi->kodePenerimaan();
		// Menyimpan data penerimaan ke database
		$this->m_transaksi->insertPenerimaan($penerimaan);

		// Redirect ke halaman penerimaan
		redirect('c_transaksi/index_penerimaan');
	}

	public function editaksi_penerimaan()
	{
		$id_penerimaan = $this->input->post('id_penerimaan');

		// Generate data QR code
		$qrcode_data = $this->_generate_data_qrcode();

		// Cek apakah ada upload gambar baru
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
				echo "Error: " . $this->upload->display_errors();
				return;
			}
		} else {
			// Jika tidak ada upload baru, ambil dari form atau set null
			$image_path = $this->input->post('existing_image_path') ?? null;
		}

		// Data utama penerimaan yang akan diupdate
		$penerimaan = array(
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
			'qrcode_path' => $this->_generate_qrcode($this->input->post('report_no'), $qrcode_data),
			'qrcode_data' => $qrcode_data,
			'image_path' => $image_path
		);

		// Update data ke database
		$this->m_transaksi->updatePenerimaan($id_penerimaan, $penerimaan);

		// Optional: Update data kualitas jika diperlukan
		$color = $this->input->post('color');
		$test_required = $this->input->post('test_required');
		$color_of = $this->input->post('color_of');	

		if (is_array($test_required)) {
			$test_required = array_filter($test_required, function($value) {
				return !empty(trim($value));
			});
		}

		if (is_array($color) && is_array($color_of) && is_array($test_required)) {
		$this->m_transaksi->deleteKualitasByPenerimaan($id_penerimaan);

		for ($i = 0; $i < count($color); $i++) {
			$c = $color[$i] ?? '';
			$co = $color_of[$i] ?? '';

			foreach ($test_required as $t) {
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

		// Redirect
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

	public function detail_penerimaan($id)
	{
		$where = array('id_penerimaan' => $id);
		$data['penerimaan'] = $this->m_transaksi->getByIdPenerimaan($where, 'tbl_penerimaan')->result();
		$this->template->load('layout/template','adidas/penerimaan/detail.php', $data);
	}

	public function index_kualitas()
    {
        // Ambil data kualitas dengan filter
        $data['kualitas'] = $this->m_transaksi->joinKualitas()->result();

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

	public function index_testResult($report_no = null, $id_kualitas = null, $id = null) {
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
		$this->template->load('layout/template', 'adidas/testRequired/testResult.php', $this->data);
	}

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
		//$this->template->load('layout/template', 'adidas/testRequired/testResult.php', $this->data);
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
		$this->template->load('layoutOther/template', 'adidas/testRequired/testResult.php', $this->data);
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

	public function keranjang_method()
    { 
        $this->data['testmethod'] = $this->m_transaksi->tampil_testmethod()->result();
        $this->data['testmatrix'] = $this->m_transaksi->tampil_testmatrix()->result();
        $this->load->view('adidas/testRequired/keranjang_method.php', $this->data);
    }

	public function report_test_all($id_penerimaan)
	{
		$this->data['report'] = $this->m_transaksi->get_report_data_all($id_penerimaan);
		//$this->data['handling'] = $this->m_transaksi->get_report_data_adidas($id_penerimaan); 
		$this->data['method'] = $this->m_transaksi-> get_reportmethod_adidasAll($id_penerimaan);

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
        $html = $this->load->view('adidas/report/reportTestAll', $this->data, true);

        // Load HTML ke Dompdf dan render
        $dompdf->loadHtml($html);
        $dompdf->render();

        // Mengunduh atau menampilkan hasil PDF
        $dompdf->stream('FGT Report ' . date('d F Y'), array("Attachment" => false)); // Tampilkan PDF di browser
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
		$this->load->model('m_transaksi');
		$data['user'] = $this->m_login->current_user();
		$this->template->load('layout/template','other/penerimaan/tambah.php', $data);
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
		$this->db->delete('m_email');

		redirect('c_transaksi/index_email');
	}

	public function delete_emailOther($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('m_email');

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
        $config['upload_path'] = FCPATH . '../testresult/images/';
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
        $config['upload_path'] = FCPATH . '../testresult/images/';
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



	public function upload()
    {   
        if($_FILES['simbol_care']['size'] != 0){
            $upload_dir = './images/';
			
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir);
            }

        $config['upload_path']          = './xampp/htdocs/testresult/images/';
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
        $id_care = $this->input->post('id_care');
        $kategori_care = $this->input->post('kategori_care');
        $simbol_care = $this->input->post('simbol_care');
        $deskripsi = $this->input->post('deskripsi');

        $config['upload_path']			= FCPATH . '../testresult/images/';
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
            redirect('c_transaksi/index_careInstuction', $error);
        }else{

            $upload_data = $this->upload->data();
            $data['simbol_care'] = $upload_data['file_name'];

            $update = $this->db->where('id_care', $id_care);
            $update = $this->db->update('m_care', $data);

            if($update){
                redirect('c_transaksi/index_careInstruction');
              }else{
                  echo "Gagal";
              }
        }
    }

	public function editaksi_careOther()
    {
        $id_care = $this->input->post('id_care');
        $kategori_care = $this->input->post('kategori_care');
        $simbol_care = $this->input->post('simbol_care');
        $deskripsi = $this->input->post('deskripsi');

        $config['upload_path']			= FCPATH . '../testresult/images/';
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

		$testmatrix_post = $this->input->post('id_testmatrix_hidden');

		if (empty($testmatrix_post) || count(array_filter($testmatrix_post)) === 0) {
			$this->session->set_flashdata('error', 'Data metode pengujian tidak boleh kosong.');
			redirect('c_transaksi/index_testResult/' .
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

		// Data untuk report_handlingsample
		$data_report = array(
			'id_reportkualitas' => $this->input->post('id_reportkualitas'),
			'id_penerimaan' => $this->input->post('id_penerimaan'),
			'id_kualitas' => $this->input->post('id_kualitas'),
			'result_status' => $this->input->post('result_status'),
			 'date_final'       => $this->input->post('date_final')
		);

		// Mulai transaksi
		$this->db->trans_start();

		// Insert ke report_kualitas
		$this->m_transaksi->insert_reportkualitas($data);

		// Insert ke report_handlingsample
		$this->m_transaksi->insert_handlingsample($data_report);

		// ✅ Update status di tbl_kualitas jadi 'selesai'
		$this->db->where('id_kualitas', $this->input->post('id_kualitas'));
		$this->db->update('tbl_kualitas', ['status' => 'selesai']);

		// Selesaikan transaksi
		$this->db->trans_complete(); 	


		if ($this->db->trans_status() === FALSE) {
			log_message('error', 'Transaction failed during insert.');
			redirect('c_transaksi/error');
		} else {

			   // Cek apakah bisa masuk report_finalhandling
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

	
	
	public function index_user()
	{
		$data['user'] = $this->m_transaksi->tampil_data()->result();
        $data['level'] = $this->m_transaksi->get_level()->result();
		$this->template->load('layout/template', 'adidas/user/tambah', $data);
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
}
