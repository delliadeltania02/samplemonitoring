<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent:: __construct();

		$this->load->model('m_login');
		$this->load->model('m_transaksi');
	}

	public function index()
	{
		$this->load->view('portal_menu');
	}

	public function login_adidas()
	{
		$this->load->view('adidas/login/login.php');
	}

	public function login_other()
	{
		$this->load->view('other/login/login.php');
	}

	public function d_adidas()
	{
		$data['report'] = $this->m_transaksi->getHistoryAll();
		//$data['report'] = $this->m_transaksi->get_detail_melebihi_timeline();
		//$data['report'] = $this->m_transaksi->get_detail_sesuai_timeline();
		$this->load->view('d_adidas', $data);
	}

public function ajax_d_adidas()
{
    $report = $this->m_transaksi->getHistoryAll();
    $data = [];
    $no = 1;

    foreach ($report as $row) {

        $jenis = strtolower(trim($row->jenis_report));
        $id    = $row->id_penerimaan;
        $noRep = $row->report_no;

        $mapUrl = [
            'fgt'  => "c_transaksi/fgt",
            'fgwt' => "c_transaksi/fgwt",
            'ftr'  => "c_transaksi/ftr",
            'ttr1' => "c_transaksi/ttr1",
            'ttr2' => "c_transaksi/ttr2",
            'ftrf' => "c_transaksi/ftrf",
            'swtr' => "c_transaksi/swtr",
            'ptr'  => "c_transaksi/ptr",
            'str'  => "c_transaksi/str",
            'pftr' => "c_transaksi/pftr",
            'str2' => "c_transaksi/str2"
        ];

        $mapCaption = [
            'fgt'  => "Finished Good Test (FGT)",
            'fgwt' => "Finished Garment Wash Test Report",
            'ftr'  => "Fabric Test Report",
            'ttr1' => "Trim Test Report",
            'ttr2' => "Trim Test Report + Color Fastness",
            'ftrf' => "Fabric Test Report Formaldehyde",
            'swtr' => "Sock Wash Test Report",
            'ptr'  => "Product Test Report",
            'str'  => "Sock Test Report",
            'pftr' => "pH + Formaldehyde Test Report",
            'str2' => "Sock Test Report"
        ];

        $url = isset($mapUrl[$jenis])
            ? site_url("{$mapUrl[$jenis]}/$id/$noRep")
            : '#';

        $caption = $mapCaption[$jenis] ?? 'View Report';

        $button = sprintf(
            '<a href="%s" target="_blank" rel="noopener noreferrer" class="btn btn-outline-info btn-sm">%s</a>',
            $url,
            htmlspecialchars($caption)
        );

        $data[] = [
            $no++,
            $row->applicant,
            $row->report_no,
            $row->order_number,
            $row->code_of_fabric,
            $row->batch_lot,
            $row->production_number,
            $button,
            $row->result_status
        ];
    }

    $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode(['data' => $data]));
}

}
