<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qad extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
       if (!$this->session->userdata('logincek')) {
            redirect('auth/login_other');
        }

		$this->load->library('form_validation');
        $this->load->helper(array('url','form'));
		$this->load->model('m_login');
		
    }

    // ==================================
    // Bar Chart: Total Wash per WO
    // ==================================
        public function get_total_wash()
        {
            $sql = "
               SELECT
                working_number,
                SUM(CEILING(po_quantity / 30000)) AS total_wash
            FROM tbl_order
            GROUP BY working_number
            HAVING total_wash > 0
            ORDER BY total_wash DESC
            LIMIT 10;

            ";

            $result = $this->db->query($sql)->result_array();

            $labels = [];
            $data   = [];

            foreach ($result as $row) {
                $labels[] = $row['working_number'];
                $data[]   = (int)$row['total_wash'];
            }

            echo json_encode([
                'labels' => $labels,
                'data'   => $data
            ]);
        }

    // ==================================
    // Stacked Bar: WO + Article
    // ==================================
    public function get_total_wash_article()
    {
        $sql = "
            SELECT
                working_number,
                article_no,
                SUM(CEILING(po_quantity / 30000)) AS total_wash
            FROM tbl_order
            GROUP BY working_number, article_no
            ORDER BY working_number, article_no
        ";

        $rows = $this->db->query($sql)->result_array();

        $chart = [];

        foreach ($rows as $r) {
            $wo  = $r['working_number'];
            $art = $r['article_no'];

            if (!isset($chart[$art])) {
                $chart[$art] = [];
            }

            $chart[$art][$wo] = (int)$r['total_wash'];
        }

        echo json_encode($chart);
    }

public function get_fgt_chart()
{
    $sql = "
        SELECT
            SUM(fgt_status = 'GOING')  AS going_to_be_test,
            SUM(fgt_status = 'TESTED') AS tested,
            SUM(fgt_status = 'PASS')   AS pass,
            SUM(fgt_status = 'FAIL')   AS fail
        FROM (
            SELECT
                p.id_penerimaan,
                CASE 
                    WHEN k.id_penerimaan IS NULL THEN 'GOING'
                    WHEN h.id_penerimaan IS NULL THEN 'TESTED'
                    WHEN MAX(h.result_status = 'FAIL') = 1 THEN 'FAIL'
                    WHEN MAX(h.result_status = 'PASS') = 1 THEN 'PASS'
                    ELSE 'TESTED'
                END AS fgt_status
            FROM tbl_penerimaan p
            LEFT JOIN tbl_kualitas k 
                ON k.id_penerimaan = p.id_penerimaan
            LEFT JOIN report_handlingsample h 
                ON h.id_penerimaan = p.id_penerimaan
            GROUP BY p.id_penerimaan
        ) x
    ";

    echo json_encode($this->db->query($sql)->row_array());
}
}
