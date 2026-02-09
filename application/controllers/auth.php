<?php
class Auth extends Ci_Controller
{
	function __construct()
	{
	parent::__construct();
	$this->load->model('m_login');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->m_login->login($username, $password); // Hanya return data

		if ($user) {
			$this->session->set_userdata([
				'logincek' => 'ok',
				'bg_username' => $user['username'],
				'bg_nama' => $user['nama'],
				'bg_password' => $user['password'],
				'bg_idlvl' => $user['id_level'],
				'user_logged_in' => true
			]);

			// Redirect berdasarkan level user
			switch ($user['id_level']) {
				case '1': // Superadmin
				case '2': // Penerimaan
				case '3': // Kualitas
				case '4': // Produksi
					redirect('c_transaksi/index');
					break;

				case '7': // Barcode
					redirect('c_transaksi/index_barcode');
					break;

				case '8': // Barcode other
					redirect('c_transaksi/index_barcode_other');
					break;

				default:
					redirect('c_transaksi/index');
			}
		} else {
			$this->session->set_flashdata('error', 'Username atau password salah!');
			//redirect('page/login'); // atau halaman login biasa
			redirect('Welcome/login_adidas'); // atau halaman login biasa
		}
	}

	public function login_other()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// cek login di model
		$user = $this->m_login->login_other($username, $password);

		if ($user) {
			// Set session
			$this->session->set_userdata([
				'logincek' => 'ok',
				'bg_username' => $user['username'],
				'bg_nama' => $user['nama'],
				'bg_password' => $user['password'],
				'bg_idlvl' => $user['id_level'],
				'user_logged_in' => true,
				'exclude_adidas' => true // <- tanda filter global untuk login_other
			]);

			// Redirect berdasarkan level user
			switch ($user['id_level']) {
				case '1': // Superadmin
				case '2': // Penerimaan
				case '3': // Kualitas
				case '4': // Produksi
					redirect('c_transaksiOther/index');
					break;

				case '7': // Barcode
					redirect('c_transaksiOther/index_barcode');
					break;

				case '8': // Barcode other
					redirect('c_transaksiOther/index_barcode_other');
					break;

				default:
					redirect('c_transaksiOther/index');
			}
		} else {
			$this->session->set_flashdata('error', 'Username atau password salah!');
			redirect('Welcome/login_other');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		header('location:'.base_url().'index.php/page/login');
	}

	public function login_scan()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->m_login->login($username, $password); // Model hanya return data

		if ($user) {

			//$this->session->sess_destroy();

			$this->session->set_userdata([
				'logincek' => 'ok',
				'bg_username' => $user['username'],
				'bg_nama' => $user['nama'],
				'bg_password' => $user['password'],
				'bg_idlvl' => $user['id_level'],
				'user_logged_in' => true,
				'level' => $user['id_level'],
			]);

			$redirect = $this->session->userdata('redirect_after_login');
			if ($redirect) {
				$this->session->unset_userdata('redirect_after_login');
				redirect($redirect); // 🔁 Kembali ke URL awal (misalnya index_bcKualitas/xxx)
			}

			// Tidak ada fallback redirect, biar aman
			show_error('Akses tidak valid. Silakan scan ulang barcode.', 403, 'Login Gagal');
		} else {
			$this->session->set_flashdata('error', 'Username atau password salah!');
			redirect('auth/login_scan_page');
		}
	}

	public function login_scan_page()
	{
		$this->load->view('adidas/barcode/login_scan');
	}

	public function logout_scan()
	{
		// Hapus semua session login
		$this->session->sess_destroy();

		// Redirect ke halaman barcode login
		redirect('auth/login_scan_page');
	}

}
