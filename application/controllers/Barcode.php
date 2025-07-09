<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barcode extends CI_Controller {

  public function index($kode = null)
{
    if (!$kode) show_404();

    $this->load->model('m_transaksi');
    $report_no = $this->m_transaksi->get_reportno_by_kode($kode);

    if (!$report_no) show_error('Kode barcode tidak valid atau tidak ditemukan.');

    if (!$this->session->userdata('user_logged_in')) {
        // 🟢 INI WAJIB ADA
        $this->session->set_userdata('redirect_after_login', site_url('c_transaksi/index_bcKualitas/' . $report_no));
        

        // ⬅️ Login page untuk QR
        redirect('auth/login_scan_page');
    }

    // Sudah login → langsung ke bcKualitas
    redirect('c_transaksi/index_bcKualitas/' . $report_no);
}

}
