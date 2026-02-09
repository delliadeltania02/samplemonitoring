<?php

class M_transaksi extends CI_Model
{
   public function getTestRequiredByPenerimaan($id_penerimaan)
    {
        return $this->db
            ->where('id_penerimaan', $id_penerimaan)
            ->where_in('status', ['belum', 'kembali'])
            ->get('tbl_kualitas');
    }


    public function getAllOrders()
    {
        return $this->db->get('tbl_order'); // bisa ditambahkan order_by kalau perlu
    }

    public function orderById($where)
    {
        return $this->db->get_where('tbl_order', $where)->row(); // .row() menghasilkan object
    }

     public function input_order($data)
        {
            return $this->db->insert('tbl_order',$data);
        }

      public function get_order_data($limit, $start, $search = null)
        {
            $this->db->select('*');
            $this->db->from('tbl_order');

            if (!empty($search)) {
                $this->db->group_start();
                $this->db->like('working_number', $search);
                $this->db->or_like('item_name', $search);
                $this->db->or_like('brand', $search);
                $this->db->or_like('style', $search);
                $this->db->or_like('order_number', $search);
                $this->db->or_like('color', $search);
                $this->db->or_like('season', $search);
                $this->db->group_end();
            }

            $this->db->limit($limit, $start);
            $query = $this->db->get();
            return $query->result();
        }

        public function count_order_data($search = null)
        {
            $this->db->from('tbl_order');

            if (!empty($search)) {
                $this->db->group_start();
                $this->db->like('working_number', $search);
                $this->db->or_like('item_name', $search);
                $this->db->or_like('brand', $search);
                $this->db->or_like('style', $search);
                $this->db->or_like('order_number', $search);
                $this->db->or_like('color', $search);
                $this->db->or_like('season', $search);
                $this->db->group_end();
            }

            return $this->db->count_all_results();
        }

        public function get_rekap_per_bulan()
        {
            $this->db->select('rk.test_required, rk.date_test, rk.report_no, p.buyer, rk.id_penerimaan');
            $this->db->from('report_kualitas rk');
            $this->db->join('tbl_penerimaan p', 'p.id_penerimaan = rk.id_penerimaan');
            $this->db->where('YEAR(rk.date_test) >=', 2025);
            return $this->db->get()->result();
        }
        
        public function get_monthly_test_summary()
        {
            $query = $this->db->query("
                SELECT 
                    rk.test_required AS test_name,
                    p.buyer,
                    COUNT(DISTINCT CONCAT(rk.id_penerimaan, rk.report_no)) AS total
                FROM report_kualitas rk
                JOIN tbl_penerimaan p ON rk.id_penerimaan = p.id_penerimaan
                WHERE YEAR(rk.date_test) >= 2025
                GROUP BY rk.test_required, p.buyer
                ORDER BY rk.test_required, p.buyer
            ");
            $raw = $query->result_array();

            // Ubah hasil jadi format pivot
            $pivot = [];
            $buyers = [];

            foreach ($raw as $row) {
                $buyers[$row['buyer']] = true;
                $pivot[$row['test_name']][$row['buyer']] = $row['total'];
            }

            // Buat array akhir untuk view
            $buyers = array_keys($buyers);
            $result = [];
            foreach ($pivot as $test_name => $cols) {
                $row = ['test_name' => $test_name];
                foreach ($buyers as $b) {
                    $row[$b] = isset($cols[$b]) ? $cols[$b] : '';
                }
                $result[] = $row;
            }

            return ['buyers' => $buyers, 'data' => $result];
        }

        public function get_summary_by_buyer()
        {
            $sql = "
                SELECT 
                    p.buyer,
                    COUNT(*) AS total_sample,
                    SUM(CASE 
                            WHEN stat.belum_selesai = 0 AND TIMESTAMPDIFF(DAY, p.datetime_received, stat.date_final) <= 3 
                            THEN 1 ELSE 0 
                        END) AS sesuai_timeline,
                    SUM(CASE 
                            WHEN stat.belum_selesai = 0 AND TIMESTAMPDIFF(DAY, p.datetime_received, stat.date_final) > 3 
                            THEN 1 ELSE 0 
                        END) AS melebihi_timeline
                FROM (
                    SELECT 
                        id_penerimaan,
                        MAX(date_final) AS date_final,
                        SUM(CASE WHEN date_final IS NULL OR date_final = '0000-00-00' THEN 1 ELSE 0 END) AS belum_selesai
                    FROM report_handlingsample
                    GROUP BY id_penerimaan
                ) stat
                JOIN tbl_penerimaan p ON p.id_penerimaan = stat.id_penerimaan
                GROUP BY p.buyer
                ORDER BY p.buyer ASC
            ";

            return $this->db->query($sql)->result();
        }

        public function get_detail_semua_timeline()
        {
            $sql = "
                SELECT 
                    p.*,
                    stat.date_final,
                    stat.jumlah_pengujian,
                    stat.selesai,
                    stat.belum_selesai,
                    stat.hasil_akhir,
                    GROUP_CONCAT(DISTINCT k.status) AS semua_status,
                    TIMESTAMPDIFF(DAY, p.datetime_received, stat.date_final) AS selisih_hari
                FROM (
                    SELECT 
                        id_penerimaan,
                        MAX(date_final) AS date_final,
                        COUNT(*) AS jumlah_pengujian,
                        SUM(CASE WHEN date_final IS NULL OR date_final = '0000-00-00' THEN 1 ELSE 0 END) AS belum_selesai,
                        SUM(CASE WHEN date_final IS NOT NULL AND date_final != '0000-00-00' THEN 1 ELSE 0 END) AS selesai,
                        CASE 
                            WHEN SUM(CASE WHEN result_status = 'fail' THEN 1 ELSE 0 END) > 0 THEN 'fail'
                            ELSE 'pass'
                        END AS hasil_akhir
                    FROM report_handlingsample
                    GROUP BY id_penerimaan
                ) stat
                JOIN tbl_penerimaan p ON p.id_penerimaan = stat.id_penerimaan
                LEFT JOIN tbl_kualitas k ON k.id_penerimaan = stat.id_penerimaan
                GROUP BY stat.id_penerimaan
                ORDER BY p.datetime_received DESC
            ";

            return $this->db->query($sql)->result();
        }

        public function get_detail_melebihi_timeline()
        {
            $sql = "
                SELECT 
                    p.*,
                    stat.date_final,
                    stat.jumlah_pengujian,
                    stat.selesai,
                    stat.belum_selesai,
                    stat.hasil_akhir,
                    GROUP_CONCAT(DISTINCT k.status) AS semua_status,
                    TIMESTAMPDIFF(DAY, p.datetime_received, stat.date_final) AS selisih_hari
                FROM (
                    SELECT 
                        id_penerimaan,
                        MAX(date_final) AS date_final,
                        COUNT(*) AS jumlah_pengujian,
                        SUM(CASE WHEN date_final IS NULL OR date_final = '0000-00-00' THEN 1 ELSE 0 END) AS belum_selesai,
                        SUM(CASE WHEN date_final IS NOT NULL AND date_final != '0000-00-00' THEN 1 ELSE 0 END) AS selesai,
                        CASE 
                            WHEN SUM(CASE WHEN result_status = 'fail' THEN 1 ELSE 0 END) > 0 THEN 'fail'
                            ELSE 'pass'
                        END AS hasil_akhir
                    FROM report_handlingsample
                    GROUP BY id_penerimaan
                ) stat
                JOIN tbl_penerimaan p ON p.id_penerimaan = stat.id_penerimaan
                LEFT JOIN tbl_kualitas k ON k.id_penerimaan = stat.id_penerimaan
                WHERE stat.belum_selesai = 0
                AND TIMESTAMPDIFF(DAY, p.datetime_received, stat.date_final) > 3
                GROUP BY stat.id_penerimaan
                ORDER BY p.datetime_received DESC
            ";

            return $this->db->query($sql)->result();
        }

        public function get_detail_sesuai_timeline()
        {
            $sql = "
                SELECT 
                    p.*,
                    stat.date_final,
                    stat.jumlah_pengujian,
                    stat.selesai,
                    stat.belum_selesai,
                    stat.hasil_akhir,
                    GROUP_CONCAT(DISTINCT k.status) AS semua_status,
                    TIMESTAMPDIFF(DAY, p.datetime_received, stat.date_final) AS selisih_hari
                FROM (
                    SELECT 
                        id_penerimaan,
                        MAX(date_final) AS date_final,
                        COUNT(*) AS jumlah_pengujian,
                        SUM(CASE WHEN date_final IS NULL OR date_final = '0000-00-00' THEN 1 ELSE 0 END) AS belum_selesai,
                        SUM(CASE WHEN date_final IS NOT NULL AND date_final != '0000-00-00' THEN 1 ELSE 0 END) AS selesai,
                        CASE 
                            WHEN SUM(CASE WHEN result_status = 'fail' THEN 1 ELSE 0 END) > 0 THEN 'fail'
                            ELSE 'pass'
                        END AS hasil_akhir
                    FROM report_handlingsample
                    GROUP BY id_penerimaan
                ) stat
                JOIN tbl_penerimaan p ON p.id_penerimaan = stat.id_penerimaan
                LEFT JOIN tbl_kualitas k ON k.id_penerimaan = stat.id_penerimaan
                WHERE stat.belum_selesai = 0
                AND TIMESTAMPDIFF(DAY, p.datetime_received, stat.date_final) <= 3
                GROUP BY stat.id_penerimaan
                ORDER BY p.datetime_received DESC
            ";

            return $this->db->query($sql)->result();
        }

    public function getAllTestMethodByReport($id_reportkualitas)
    {
        return $this->db
            ->select('report_kualitas.*, tbl_testmatrix.*, tbl_testmethod.*')
            ->from('report_kualitas')
            ->join('tbl_testmatrix', 'report_kualitas.id_testmatrix = tbl_testmatrix.id_testmatrix', 'left')
            ->join('tbl_testmethod', 'tbl_testmatrix.id_testmethod = tbl_testmethod.id_testmethod', 'left')
            ->where('report_kualitas.id_reportkualitas', $id_reportkualitas)
            ->get()
            ->result();
    }



    public function getTestMatrixByMethodGroup($id_methodgroup)
    {
        return $this->db
            ->select('tbl_testmatrix.*, tbl_testmethod.method_code')
            ->from('tbl_testmatrix')
            ->join('tbl_testmethod', 'tbl_testmatrix.id_testmethod = tbl_testmethod.id_testmethod', 'left')
            ->where('tbl_testmethod.id_methodgroup', $id_methodgroup)
            ->get()
            ->result();
    }

    public function getTestMatrixDetail($id_testmatrix)
    {
        return $this->db
            ->select('
                tbl_testmatrix.*, 
                tbl_testmethod.id_testmethod AS testmethod_id,
                tbl_testmethod.id_methodgroup AS methodgroup_id,
                m_methodgroup.method_group,
                m_methodgroup.id_methodgroup AS group_id
            ')
            ->from('tbl_testmatrix')
            ->join('tbl_testmethod', 'tbl_testmatrix.id_testmethod = tbl_testmethod.id_testmethod', 'left')
            ->join('m_methodgroup', 'm_methodgroup.id_methodgroup = tbl_testmethod.id_methodgroup', 'left')
            ->where('tbl_testmatrix.id_testmatrix', $id_testmatrix)
            ->get()
            ->row();
    }

    public function getTestRequiredName($id_kualitas, $id_penerimaan = null) {
        $this->db->select('test_required');
        $this->db->from('tbl_kualitas');
        $this->db->where('id_kualitas', $id_kualitas);
        if ($id_penerimaan !== null) {
            $this->db->where('id_penerimaan', $id_penerimaan);
        }
        $row = $this->db->get()->row();
        return $row->test_required ?? '';
    }



    public function getTestRequired($id_penerimaan, $id_reportkualitas)
    {
        return $this->db
                    ->where('id_penerimaan', $id_penerimaan)
                    ->where('id_reportkualitas', $id_reportkualitas)
                    ->get('report_kualitas')
                    ->row();
    }

    public function getKualitasById($id_kualitas)
    {
        $this->db->where('id_kualitas', $id_kualitas);
        return $this->db->get('tbl_kualitas')->row(); // hanya ambil satu baris
    }

    public function getByIdPenerimaan($where, $table)
    {
        $this->db->select('
            tbl_penerimaan.*,
            m_applicant.id AS applicant_id,
            m_applicant.email,
            m_applicant.no_tlp,
            m_applicant.id_department,
            m_department.department AS department,
            m_supplier.*,
            m_care.*,
            m_stages.*
        ');
        $this->db->from($table); // alias: tbl_penerimaan
        $this->db->join('m_applicant', 'tbl_penerimaan.applicant = m_applicant.applicant', 'left');
        $this->db->join('m_department', 'm_applicant.id_department = m_department.id_department', 'left');
        $this->db->join('m_supplier', 'tbl_penerimaan.supplier_name = m_supplier.supplier_name','left');
        $this->db->join('m_care','tbl_penerimaan.washing = m_care.id_care', 'left');
        $this->db->join('m_stages','tbl_penerimaan.stage = m_stages.id_stages','left');
        $this->db->where($where);
        return $this->db->get();
    }


    public function getKualitasByPenerimaan($id_penerimaan, $report_no = null)
        {
            $this->db->from('tbl_kualitas');
            $this->db->where('id_penerimaan', $id_penerimaan);
            if ($report_no !== null) {
                $this->db->where('report_no', $report_no);
            }

            
            return $this->db->get()->result();
        }

    public function updatePenerimaan($id_penerimaan, $data)
    {
        $this->db->where('id_penerimaan', $id_penerimaan);
        return $this->db->update('tbl_penerimaan', $data);
    }

    public function deleteKualitasByPenerimaan($id_penerimaan)
    {
        $this->db->where('id_penerimaan', $id_penerimaan);
        return $this->db->delete('tbl_kualitas');
    }

    // getColorsByPenerimaan dan getTestsByPenerimaan disesuaikan dengan struktur tabel kamu.


    public function getAllColors()
    {
        $this->db->distinct();
        $this->db->select('color');
        return $this->db->get('tbl_kualitas')->result(); // atau tabel referensi
    }

    public function getAllTestMatrix()
    {
        $this->db->distinct();
        $this->db->select('test_required');
        return $this->db->get('tbl_kualitas')->result(); // atau tabel referensi
    }

    public function getReportSampleByReportNo($report_no, $status = null)
    {
        $this->db->select('
            report_handlingsample.*, 
            MAX(report_handlingsample.personil) AS personil, 
            report_kualitas.*, 
            tbl_penerimaan.*, 
            tbl_kualitas.*'
        );
        $this->db->from('report_handlingsample');
        $this->db->join('report_kualitas', 'report_kualitas.id_reportkualitas = report_handlingsample.id_reportkualitas');
        $this->db->join('tbl_penerimaan', 'tbl_penerimaan.id_penerimaan = report_handlingsample.id_penerimaan');
        $this->db->join('tbl_kualitas', 'tbl_kualitas.id_kualitas = report_handlingsample.id_kualitas');

        // 🛠️ Ganti ke filter report_no dari tbl_penerimaan
        $this->db->where('tbl_penerimaan.report_no', $report_no);

        if (!empty($status)) {
            $this->db->where('tbl_kualitas.status', $status);
        }

        $this->db->group_by('report_handlingsample.id_handlingsample');

        return $this->db->get()->result();
    }


    public function get_penerimaan_by_reportno($report_no)
    {
        return $this->db
            ->where('report_no', $report_no)
            ->get('tbl_penerimaan')
            ->row(); // Mengembalikan 1 baris (bukan array)
    }

    // Menyimpan data barcode ke tabel barcode_redirect
    public function insert_barcode_redirect($kode_unik, $report_no)
    {
        // Cek apakah sudah ada
        $this->db->where('report_no', $report_no);
        $cek = $this->db->get('barcode_redirect')->row();

        if (!$cek) {
            $this->db->insert('barcode_redirect', [
                'kode_unik' => $kode_unik,
                'report_no' => $report_no
            ]);
        }
    }

    // Mengambil report_no dari kode barcode
    public function get_reportno_by_kode($kode_unik)
    {
        $this->db->where('kode_unik', $kode_unik);
        $query = $this->db->get('barcode_redirect'); // atau nama tabel yang kamu pakai
        return $query->num_rows() > 0 ? $query->row()->report_no : false;
    }
// Menampilkan semua data assign (list)
public function get_assign() {
    $sql = "
        SELECT 
            p.*,
            stat.id_penerimaan,
            stat.report_no,
            stat.date_final,
            stat.jumlah_pengujian,
            stat.selesai,
            stat.belum_selesai,
            stat.hasil_akhir,
            GROUP_CONCAT(DISTINCT k.status) AS semua_status
        FROM (
            SELECT 
                id_penerimaan,
                report_no,
                MAX(date_final) AS date_final,
                COUNT(*) AS jumlah_pengujian,
                SUM(CASE WHEN date_final IS NULL OR date_final = '0000-00-00' THEN 1 ELSE 0 END) AS belum_selesai,
                SUM(CASE WHEN date_final IS NOT NULL AND date_final != '0000-00-00' THEN 1 ELSE 0 END) AS selesai,
                CASE 
                    WHEN SUM(CASE WHEN result_status = 'fail' THEN 1 ELSE 0 END) > 0 THEN 'fail'
                    ELSE 'pass'
                END AS hasil_akhir
            FROM report_handlingsample
            GROUP BY id_penerimaan, report_no
        ) stat
        JOIN tbl_penerimaan p 
            ON p.id_penerimaan = stat.id_penerimaan
        LEFT JOIN tbl_kualitas k 
            ON k.id_penerimaan = stat.id_penerimaan
        GROUP BY stat.id_penerimaan, stat.report_no
        ORDER BY stat.id_penerimaan ASC, stat.report_no ASC
    ";
    return $this->db->query($sql)->result();
}

// Menampilkan data berdasarkan id_penerimaan dan report_no (mode edit)
public function get_assign_by_id($id_penerimaan, $report_no)
{
    $sql = "
        SELECT 
            p.*,                            -- ambil semua data penerimaan (termasuk report_no)
            stat.date_final,
            stat.jumlah_pengujian,
            stat.selesai,
            stat.belum_selesai,
            stat.hasil_akhir,
            GROUP_CONCAT(DISTINCT k.status) AS semua_status
        FROM (
            SELECT 
                id_penerimaan,
                MAX(date_final) AS date_final,
                COUNT(*) AS jumlah_pengujian,
                SUM(CASE WHEN date_final IS NULL OR date_final = '0000-00-00' THEN 1 ELSE 0 END) AS belum_selesai,
                SUM(CASE WHEN date_final IS NOT NULL AND date_final != '0000-00-00' THEN 1 ELSE 0 END) AS selesai,
                CASE 
                    WHEN SUM(CASE WHEN result_status = 'fail' THEN 1 ELSE 0 END) > 0 THEN 'fail'
                    ELSE 'pass'
                END AS hasil_akhir
            FROM report_handlingsample
            WHERE id_penerimaan = '$id_penerimaan'
            GROUP BY id_penerimaan
        ) stat
        JOIN tbl_penerimaan p 
            ON p.id_penerimaan = stat.id_penerimaan
           AND p.report_no = '$report_no'
        LEFT JOIN tbl_kualitas k 
            ON k.id_penerimaan = stat.id_penerimaan
        GROUP BY stat.id_penerimaan
    ";

    return $this->db->query($sql)->row();
}


public function get_pengujian_selesai()
{
    $sql = "
        SELECT 
            tbl_penerimaan.*,
            stat_sub.date_final,
            stat_sub.jumlah_pengujian,
            stat_sub.selesai,
            stat_sub.belum_selesai,
            stat_sub.hasil_akhir,
            GROUP_CONCAT(DISTINCT tbl_kualitas.status) AS semua_status
        FROM (
            SELECT 
                report_handlingsample.id_penerimaan,
                MAX(report_handlingsample.date_final) AS date_final,
                COUNT(*) AS jumlah_pengujian,
                SUM(
                    CASE 
                        WHEN (report_handlingsample.date_final IS NULL OR report_handlingsample.date_final = '0000-00-00') 
                             AND NOT EXISTS (
                                 SELECT 1
                                 FROM tbl_kualitas
                                 WHERE tbl_kualitas.id_penerimaan = report_handlingsample.id_penerimaan
                                   AND tbl_kualitas.status = 'kembali'
                             )
                        THEN 1
                        ELSE 0
                    END
                ) AS belum_selesai,
                SUM(
                    CASE 
                        WHEN report_handlingsample.date_final IS NOT NULL 
                             AND report_handlingsample.date_final != '0000-00-00' 
                        THEN 1 
                        ELSE 0 
                    END
                ) AS selesai,
                CASE 
                    WHEN SUM(CASE WHEN report_handlingsample.result_status = 'fail' THEN 1 ELSE 0 END) > 0 
                    THEN 'fail'
                    ELSE 'pass'
                END AS hasil_akhir
            FROM report_handlingsample
            GROUP BY report_handlingsample.id_penerimaan
        ) stat_sub
        JOIN tbl_penerimaan 
            ON tbl_penerimaan.id_penerimaan = stat_sub.id_penerimaan
        LEFT JOIN tbl_kualitas 
            ON tbl_kualitas.id_penerimaan = stat_sub.id_penerimaan
        
        -- 🔥 Tambahkan ini: hanya tampilkan data yang date_final-nya tidak kosong
        WHERE stat_sub.date_final IS NOT NULL 
          AND stat_sub.date_final != '' 
          AND stat_sub.date_final != '0000-00-00'

        GROUP BY stat_sub.id_penerimaan
    ";

    return $this->db->query($sql)->result();
}



      public function get_personal()
    {
        $this->db->select('report_handlingsample.*');
        
    }

    public function getReportFinal()
    {
        $this->db->select('report_finalhandling.*, tbl_penerimaan.buyer, tbl_penerimaan.datetime_received');
        $this->db->from('report_finalhandling');
        $this->db->join('tbl_penerimaan', 'tbl_penerimaan.id_penerimaan = report_finalhandling.id_penerimaan');
        $this->db->order_by('report_finalhandling.date_final', 'DESC');

        return $this->db->get();
    }

    public function getReportRilis()
    {
        $this->db->select('report_finalhandling.*');
    }

    public function getDetailSesuaiTimeline()
    {
        $sql = "
            SELECT 
                p.*,
                MAX(rhs.date_final) AS date_final,
                COUNT(rhs.id) AS total_test,
                SUM(IF(rhs.date_final IS NULL OR rhs.date_final = '0000-00-00', 1, 0)) AS belum_selesai
            FROM report_handlingsample rhs
            JOIN tbl_penerimaan p ON p.id_penerimaan = rhs.id_penerimaan
            WHERE p.buyer = 'adidas'
            GROUP BY p.id_penerimaan
            HAVING belum_selesai = 0
            AND TIMESTAMPDIFF(DAY, p.datetime_received, MAX(rhs.date_final)) <= 3
            ORDER BY p.datetime_received DESC
        ";

        return $this->db->query($sql)->result();
    }


   public function getTimelineStatus()
{
    $sql = "
        SELECT 
            p.id_penerimaan,
            p.datetime_received,
            MAX(rhs.date_final) AS date_final,
            SUM(IF(rhs.date_final IS NULL OR rhs.date_final = '0000-00-00', 1, 0)) AS belum_selesai
        FROM report_handlingsample rhs
        JOIN tbl_penerimaan p ON p.id_penerimaan = rhs.id_penerimaan
        WHERE p.buyer = 'adidas'
        GROUP BY p.id_penerimaan
    ";

    $rows = $this->db->query($sql)->result();

    $statusCount = [
        'Sesuai Timeline' => 0,
        'Melebihi Timeline' => 0,
        'Belum Selesai' => 0
    ];

    foreach ($rows as $row) {
        if ($row->belum_selesai > 0) {
            $statusCount['Belum Selesai']++;
        } else {
            if (!empty($row->date_final) && !empty($row->datetime_received)) {
                $selisih_hari = round((strtotime($row->date_final) - strtotime($row->datetime_received)) / (60 * 60 * 24));
                if ($selisih_hari <= 3) {
                    $statusCount['Sesuai Timeline']++;
                } else {
                    $statusCount['Melebihi Timeline']++;
                }
            } else {
                $statusCount['Belum Selesai']++;
            }
        }
    }

    // Kembalikan dalam format array of object
    $result = [];
    foreach ($statusCount as $status => $total) {
        $result[] = (object)[
            'status' => $status,
            'total' => $total
        ];
    }

    return $result;
    }

        public function getPenerimaanPerBulan()
        {
            $sql = "
                SELECT 
                    DATE_FORMAT(datetime_received, '%Y-%m') AS bulan,
                    COUNT(*) AS total
                FROM tbl_penerimaan
                WHERE buyer = 'adidas'
                AND datetime_received IS NOT NULL
                AND datetime_received <> '0000-00-00'
                GROUP BY bulan
                ORDER BY bulan DESC
                LIMIT 12
            ";

            return $this->db->query($sql)->result();
        }


    public function getTotalPenerimaan()
    {
        return $this->db->count_all('tbl_penerimaan');
    }

    public function getBuyerChart()
    {
        $query = $this->db->query("
            SELECT buyer, COUNT(*) as total
            FROM tbl_penerimaan
            GROUP BY buyer
        ");

        return $query->result();
    }

    public function indexSupplier()
    {
        $this->db->select("*");
        $this->db->from("m_supplier");
        
        return $this->db->get();
    }

    public function insertSupplier($data)
    {
        return $this->db->insert('m_supplier', $data);
    
    }

    public function getByIdSupplier($where)
    {
        return $this->db->get_where('m_supplier', $where);
    }

    public function updateSupplier($id_supplier, $data)
    {
         $this->db->where('id_supplier', $id_supplier);
         $this->db->update('m_supplier', $data);
    }

    public function deleteSupplier($id_supplier)
    {
        $this->db->delete('m_supplier',['id_supplier' => $id_supplier]);
    }


    public function get_kualitas_reportno($report_no = null, $status = null)
    {
        // Pilih semua kolom dari kedua tabel
        $this->db->select('tbl_penerimaan.*, tbl_kualitas.*');
        $this->db->from('tbl_kualitas');

        // Join dengan tabel penerimaan
        $this->db->join('tbl_penerimaan', 'tbl_penerimaan.id_penerimaan = tbl_kualitas.id_penerimaan');

        // Filter data test_required yang valid
        $this->db->where('tbl_kualitas.test_required !=', '-');
        $this->db->where('tbl_kualitas.test_required IS NOT NULL');
        $this->db->where('tbl_kualitas.test_required !=', '');

        // Filter data color yang valid
        $this->db->where('tbl_kualitas.color !=', '-');
        $this->db->where('tbl_kualitas.color IS NOT NULL');
        $this->db->where('tbl_kualitas.color !=', '');

        // Filter berdasarkan report_no jika diberikan
        if (!is_null($report_no)) {
            $this->db->where('tbl_kualitas.report_no', $report_no);
        }

        // Filter berdasarkan status jika diberikan
        if (!is_null($status)) {
            $this->db->where('tbl_kualitas.status', $status);
        }

        // Jalankan query dan kembalikan hasil
        return $this->db->get()->result();
    }

    public function get_report_data_all($id_penerimaan, $new_report_no)
    {
        $this->db->select('
            report_kualitas.*,
            tbl_kualitas.*,
            report_handlingsample.*,
            tbl_penerimaan.*,
            m_material.id_material,
            m_material.item_no AS material_item_no,
            m_material.deskripsi,
            tbl_testmatrix.*,
            tbl_testmethod.*,
            tbl_order.*,

            report_finalhandling.jenis_report,
            report_finalhandling.report_no,
            report_finalhandling.new_report_no AS no_final,
            report_finalhandling.date_sending,
            report_finalhandling.signature,
            report_finalhandling.review,
            report_finalhandling.authorized,
            report_finalhandling.comment_final,
            report_finalhandling.remarks_final,

            m_supplier.supplier_name,
            m_supplier.supplier_code,

            m_stages.id_stages,
            m_stages.testing_stages,

            ttd_sig.nama AS signature_name,
            ttd_sig.jabatan AS signature_jabatan,
            ttd_sig.tanda_tangan AS signature_file,

            ttd_rev.nama AS review_name,
            ttd_rev.jabatan AS review_jabatan,
            ttd_rev.tanda_tangan AS review_file,

            ttd_auth.nama AS authorized_name,
            ttd_auth.jabatan AS authorized_jabatan,
            ttd_auth.tanda_tangan AS authorized_file,

            care_wash.simbol_care AS washing_symbol,
            care_bleach.simbol_care AS bleach_symbol,
            care_dry.simbol_care AS drying_symbol,
            care_iron.simbol_care AS ironing_symbol,
            care_press.simbol_care AS pressing_symbol
        ');

        $this->db->from('report_kualitas');

        $this->db->join('report_handlingsample',
            'report_handlingsample.id_reportkualitas = report_kualitas.id_reportkualitas');

        $this->db->join('tbl_kualitas',
            'tbl_kualitas.id_kualitas = report_handlingsample.id_kualitas');

        $this->db->join('tbl_penerimaan',
            'tbl_penerimaan.id_penerimaan = report_handlingsample.id_penerimaan');

        $this->db->join('m_material',
            'm_material.item_no = tbl_penerimaan.item_no', 'left');

        $this->db->join('tbl_testmatrix',
            'tbl_testmatrix.id_testmatrix = report_kualitas.id_testmatrix', 'left');

        $this->db->join('tbl_testmethod',
            'tbl_testmethod.id_testmethod = tbl_testmatrix.id_testmethod', 'left');

        $this->db->join('tbl_order',
            'tbl_order.order_number = tbl_penerimaan.order_number','left');
        /* ===============================
        JOIN FINAL HANDLING (FILTER!)
        ================================ */
        
        if (!empty($new_report_no)) {
            $this->db->join(
                'report_finalhandling',
                'report_finalhandling.id_penerimaan = tbl_penerimaan.id_penerimaan
                AND report_finalhandling.new_report_no = '.$this->db->escape($new_report_no),
                'left'
            );
        } else {
            $this->db->join(
                'report_finalhandling',
                'report_finalhandling.id_penerimaan = tbl_penerimaan.id_penerimaan',
                'left'
            );
        }
        
        
        //    $this->db->join( 'report_finalhandling', 'report_finalhandling.id_penerimaan = tbl_penerimaan.id_penerimaan AND report_finalhandling.new_report_no = '.$this->db->escape($new_report_no), 'left' );

        $this->db->join('m_stages',
            'm_stages.id_stages = tbl_penerimaan.stage', 'left');

        $this->db->join('m_supplier',
            'm_supplier.supplier_name = tbl_penerimaan.supplier_name', 'left');

        $this->db->join('m_ttd ttd_sig',
            'ttd_sig.id_ttd = report_finalhandling.signature', 'left');

        $this->db->join('m_ttd ttd_rev',
            'ttd_rev.id_ttd = report_finalhandling.review', 'left');

        $this->db->join('m_ttd ttd_auth',
            'ttd_auth.id_ttd = report_finalhandling.authorized', 'left');

        $this->db->join('m_care care_wash',
            'care_wash.id_care = tbl_penerimaan.washing', 'left');

        $this->db->join('m_care care_bleach',
            'care_bleach.id_care = tbl_penerimaan.bleach', 'left');

        $this->db->join('m_care care_dry',
            'care_dry.id_care = tbl_penerimaan.drying', 'left');

        $this->db->join('m_care care_iron',
            'care_iron.id_care = tbl_penerimaan.ironing', 'left');

        $this->db->join('m_care care_press',
            'care_press.id_care = tbl_penerimaan.profess', 'left');

        $this->db->where('tbl_penerimaan.id_penerimaan', $id_penerimaan);

        return $this->db->get()->result();
    }

    public function get_report_data_adidas($id_handlingsample)
    {
    // Pilih kolom yang diperlukan
    $this->db->select('tbl_penerimaan.*, 
                       tbl_kualitas.*, 
                       report_kualitas.*, 
                       report_handlingsample.*, 
                       m_material.id_material, 
                       m_material.item_no AS material_item_no, 
                       m_material.deskripsi, 
                       tbl_testmatrix.*,
                       tbl_testmethod.*,
                       m_stages.*,
                       m_supplier.*'
                        );
        
    
    // Gabungkan tabel yang diperlukan
    $this->db->join('report_kualitas', 'report_kualitas.id_reportkualitas = report_handlingsample.id_reportkualitas');
    $this->db->join('tbl_kualitas', 'tbl_kualitas.id_kualitas = report_handlingsample.id_kualitas');
    $this->db->join('tbl_penerimaan', 'tbl_penerimaan.id_penerimaan = report_handlingsample.id_penerimaan');
    $this->db->join('m_material', 'm_material.item_no = tbl_penerimaan.item_no', 'left'); // LEFT JOIN untuk menghindari error jika tidak ada data di m_material    
    $this->db->join('tbl_testmatrix','tbl_testmatrix.id_testmatrix = report_kualitas.id_testmatrix','left');
    $this->db->join('tbl_testmethod','tbl_testmethod.id_testmethod = tbl_testmatrix.id_testmethod','left');
    $this->db->join('m_stages','tbl_penerimaan.stage = m_stages.id_stages');
    $this->db->join('m_supplier','m_supplier.supplier_name = tbl_penerimaan.supplier_name');

    // Filter berdasarkan ID yang diberikan
    return $this->db->get_where('report_handlingsample', ['id_handlingsample' => $id_handlingsample])->row();
    }

/*public function get_reportmethod_adidasAll($id_penerimaan)
{
    $this->db->select('rkh.*, rh.*, tm.*, tsm.*');
    $this->db->from('report_kualitas rkh');
    $this->db->join('report_handlingsample rh', 'rh.id_reportkualitas = rkh.id_reportkualitas');
    $this->db->join('tbl_testmatrix tm', 'tm.id_testmatrix = rkh.id_testmatrix', 'left');
    $this->db->join('tbl_testmethod tsm', 'tsm.id_testmethod = tm.id_testmethod', 'left');
    $this->db->where('rh.id_penerimaan', $id_penerimaan);
    $this->db->order_by('rkh.id_reportkualitas', 'ASC');

    return $this->db->get()->result_array();
}*/
public function get_reportmethod_adidasAll($id_penerimaan, $new_report_no)
{
    /* ===============================
       AMBIL BASE + MAX VERSION
    ================================ */

    // ambil angka versi dari new_report_no (A1, A2, dst)
    preg_match('/A(\d+)/', $new_report_no, $m);
    $max_version = isset($m[1]) ? (int)$m[1] : 0;

    $this->db->select('rkh.*, rh.*, tm.*, tsm.*');
    $this->db->from('report_kualitas rkh');

    $this->db->join(
        'report_handlingsample rh',
        'rh.id_reportkualitas = rkh.id_reportkualitas'
    );

    $this->db->join(
        'tbl_testmatrix tm',
        'tm.id_testmatrix = rkh.id_testmatrix',
        'left'
    );

    $this->db->join(
        'tbl_testmethod tsm',
        'tsm.id_testmethod = tm.id_testmethod',
        'left'
    );

    /* ===============================
       FILTER ID PENERIMAAN
    ================================ */
    $this->db->where('rh.id_penerimaan', $id_penerimaan);

    /* ===============================
       FILTER VERSI (PENTING)
    ================================ */
    if ($max_version > 0) {
        // base (rilis 0) + A1..Ax
        $this->db->where('rkh.rilis <=', $max_version);
    } else {
        // base saja
        $this->db->where('(rkh.rilis IS NULL OR rkh.rilis = 0)', null, false);
    }

    $this->db->order_by('rkh.id_reportkualitas', 'ASC');

    return $this->db->get()->result_array();
}

/*public function get_reportmethod_adidasAll($id_penerimaan, $new_report_no)
{
    // deteksi adding (A1, A2, ...)
    preg_match('/A(\d+)-AF$/', $new_report_no, $m);
    $is_adding   = isset($m[1]);
    $max_version = $is_adding ? (int)$m[1] : 0;

    $this->db->select('rkh.*, rh.*, tm.*, tsm.*');
    $this->db->from('report_kualitas rkh');

    $this->db->join(
        'report_handlingsample rh',
        'rh.id_reportkualitas = rkh.id_reportkualitas'
    );

    $this->db->join(
        'tbl_testmatrix tm',
        'tm.id_testmatrix = rkh.id_testmatrix',
        'left'
    );

    $this->db->join(
        'tbl_testmethod tsm',
        'tsm.id_testmethod = tm.id_testmethod',
        'left'
    );

    // 🔑 ID penerimaan
    $this->db->where('rh.id_penerimaan', $id_penerimaan);

    // 🔑 HANYA YANG SUDAH PUNYA new_report_no
    $this->db->where('rkh.new_report_no IS NOT NULL', null, false);

    // 🔑 FILTER RILIS SESUAI KONSEP
    if ($is_adding) {
        // BASE + A1..Ax
        $this->db->where('rkh.rilis <=', $max_version);
    } else {
        // BASE SAJA
        $this->db->where('(rkh.rilis IS NULL OR rkh.rilis = 0)', null, false);
    }

    $this->db->order_by('rkh.id_reportkualitas', 'ASC');

    return $this->db->get()->result_array();
}*/






public function get_reportmethod_checklist($id_penerimaan)
{
    $this->db->select('
        report_kualitas.*, 
        report_kualitas.new_report_no,
        report_handlingsample.*, 
        tbl_testmatrix.*, 
        tbl_testmethod.*
    ');

    $this->db->from('report_kualitas');

    $this->db->join(
        'report_handlingsample',
        'report_handlingsample.id_reportkualitas = report_kualitas.id_reportkualitas'
    );

    $this->db->join('tbl_testmatrix', 'tbl_testmatrix.id_testmatrix = report_kualitas.id_testmatrix');
    $this->db->join('tbl_testmethod', 'tbl_testmethod.id_testmethod = tbl_testmatrix.id_testmethod');

    $this->db->where('report_handlingsample.id_penerimaan', $id_penerimaan);

    return $this->db->get()->result_array();
}


    public function get_reportmethod_shrinkage($id_penerimaan)
    {
        $this->db->select('report_kualitas.*, 
                        report_handlingsample.*, 
                        tbl_testmatrix.*, 
                        tbl_testmethod.*');

        $this->db->from('report_kualitas');

        $this->db->join('report_handlingsample', 'report_handlingsample.id_reportkualitas = report_kualitas.id_reportkualitas');
        $this->db->join('tbl_testmatrix', 'tbl_testmatrix.id_testmatrix = report_kualitas.id_testmatrix');
        $this->db->join('tbl_testmethod', 'tbl_testmethod.id_testmethod = tbl_testmatrix.id_testmethod');

        $this->db->where('report_handlingsample.id_penerimaan', $id_penerimaan);

        // Tambahkan filter measurement
        $this->db->like('tbl_testmatrix.measurement', 'dimensional change: measuring point', 'both');

        return $this->db->get()->result_array();
    }


    public function get_reportmethod_adidas($id_handlingsample)
    {
        $this->db->select('
            report_handlingsample.*,
            report_kualitas.*,
            report_kualitas.result AS kualitas_result,
            report_kualitas.statement AS kualitas_statement,
            tbl_testmatrix.*,
            tbl_testmethod.*
        ');
        $this->db->join('report_kualitas', 'report_kualitas.id_reportkualitas = report_handlingsample.id_reportkualitas');
        $this->db->join('tbl_testmatrix', 'tbl_testmatrix.id_testmatrix = report_kualitas.id_testmatrix');
        $this->db->join('tbl_testmethod', 'tbl_testmethod.id_testmethod = tbl_testmatrix.id_testmethod');
        
        return $this->db->get_where('report_handlingsample', array('id_handlingsample' => $id_handlingsample))->result_array();
    }


    public function get_suhu()
    {
        $this->db->select('tbl_penerimaan.*, m_care.*');
        $this->db->join('tbl_penerimaan','tbl_penerimaan.washing = m_care.id_care');
      
        return $this->db->get('m_care')->result();
    }

    public function get_deskripsi_item()
    {
        // Pilih kolom yang diperlukan
        $this->db->select('tbl_penerimaan.*, m_material.*');
        
        // Gabungkan tabel yang diperlukan
        $this->db->join('tbl_penerimaan', 'tbl_penerimaan.item_no = m_material.item_no');
        
        // Ambil data dari m_material dan tbl_penerimaan
        return $this->db->get('m_material')->result(); // Menampilkan hasil sebagai array
    }

    public function GetByIdUser($where)
    {
        return $this->db
            ->get_where('tbl_login', $where)
            ->row();
    }

    public function insertColor($data)
    {
        return $this->db->insert_batch('tbl_color', $data);
    }

    public function insertColorOf($data)
    {
        return $this->db->insert_batch('tbl_color_of', $data);
    }
    
    public function insertKualitas($data)
    {
        return $this->db->insert_batch('tbl_kualitas', $data);
    }

    public function saveKualitas($test_required, $color, $color_of, $id_kualitas, $color_of_name, $id_penerimaan, $report_no)
    {
    $data = [
            'test_required' => $test_required,
            'color' => $color,
            'color_of' => $color_of,
            'id_kualitas' => $id_kualitas,
            'color_of_name' => $color_of_name,
            'id_penerimaan' => $id_penerimaan,
            'report_no' => $report_no
    ];

    return $this->db->insert('tbl_kualitas', $data);
    }
    
    public function replaceKualitasByPenerimaan($id_penerimaan, $report_no, $data_kualitas_list)
    {
        // Hapus semua yang lama
        $this->db->where('id_penerimaan', $id_penerimaan)
                ->where('report_no', $report_no)
                ->delete('tbl_kualitas');

        // Insert ulang semua data kualitas yang baru
        foreach ($data_kualitas_list as $data) {
            $this->db->insert('tbl_kualitas', $data);
        }
    }


    
    public function insertReport($data)
    {
        return $this->db->insert_batch('tbl_report', $data);
    }

    public function insert_handlingsample($data)
    {
        if ($this->db->insert('report_handlingsample', $data)) {
            return true;
        } else {
            // Log error jika insert gagal
            log_message('error', 'Insert failed for report_handlingsample: ' . $this->db->last_query());
            return false;
        }
    }
    
    public function insertPenerimaan($data)
    {
          // Gunakan transaksi
            $this->db->trans_start();

            // Pastikan data['id_penerimaan'] sudah terisi sebelum fungsi dipanggil
            $this->db->insert('tbl_penerimaan', $data);

            $this->db->trans_complete();
            return $this->db->trans_status();
    }
    



    
    public function getPenerimaan()
    {
       $query = $this->db->query("SELECT * FROM tbl_penerimaan Where buyer = 'adidas'");

       return $query;
    }

    public function editPenerimaan($id_penerimaan, $data)
    {
        $this->db->where('id_penerimaan', $id_penerimaan);
        $this->db->update('tbl_penerimaan', $data);
    }

    public function editReport($id_reportkualitas, $id_handlingsample, $data)
    {
        // Gunakan where dengan dua kondisi untuk menentukan data yang akan diupdate
        $this->db->where('id_reportkualitas', $id_reportkualitas);
        $this->db->where('id_handlingsample', $id_handlingsample);
        $this->db->update('report_handlingsample', $data);
    
        // Debugging: Periksa apakah query berhasil dijalankan
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            // Jika tidak ada baris yang diperbarui, cetak query untuk debugging
            echo $this->db->last_query();
            return false;
        }
    }
    

    public function getKualitas()
    {
        return $this->db->get('tbl_kualitas');
    }

public function joinKualitasByPenerimaan()
{
    $this->db->select('
        tbl_penerimaan.*,
        tbl_kualitas.*,
        
        COUNT(tbl_kualitas.id_kualitas) AS total_test,
        SUM(CASE WHEN tbl_kualitas.status = "belum" THEN 1 ELSE 0 END) AS jumlah_belum,
        SUM(CASE WHEN tbl_kualitas.status = "kembali" THEN 1 ELSE 0 END) AS jumlah_kembali,

        GROUP_CONCAT(DISTINCT tbl_kualitas.test_required) AS test_required_list,
        GROUP_CONCAT(DISTINCT tbl_kualitas.color) AS color_list,

        MAX(report_kualitas.id_reportkualitas) AS id_reportkualitas
    ');

    $this->db->from('tbl_penerimaan');
    $this->db->join(
        'tbl_kualitas',
        'tbl_kualitas.id_penerimaan = tbl_penerimaan.id_penerimaan',
        'left'
    );
    $this->db->join(
        'report_kualitas',
        'report_kualitas.id_kualitas = tbl_kualitas.id_kualitas',
        'left'
    );

    // status yang dihitung
    $this->db->where_in('tbl_kualitas.status', ['belum', 'kembali']);

    // filter test_required valid
    $this->db->where('tbl_kualitas.test_required IS NOT NULL');
    $this->db->where('tbl_kualitas.test_required !=', '');
    $this->db->where('tbl_kualitas.test_required !=', '-');

    // filter color valid
    $this->db->where('tbl_kualitas.color IS NOT NULL');
    $this->db->where('tbl_kualitas.color !=', '');
    $this->db->where('tbl_kualitas.color !=', '-');

    $this->db->group_by('tbl_penerimaan.id_penerimaan');

    return $this->db->get();
}

public function joinKualitas() {
    $this->db->select('
        tbl_penerimaan.*, 
        tbl_kualitas.*, 
        MAX(report_kualitas.id_reportkualitas) as id_reportkualitas
    ');
    $this->db->from('tbl_kualitas');
    $this->db->join('tbl_penerimaan', 'tbl_penerimaan.id_penerimaan = tbl_kualitas.id_penerimaan');
    $this->db->join('report_kualitas', 'report_kualitas.id_kualitas = tbl_kualitas.id_kualitas', 'left');

    // Filter test_required yang valid
    $this->db->where('tbl_kualitas.test_required !=', '-');
    $this->db->where('tbl_kualitas.test_required IS NOT NULL');
    $this->db->where('tbl_kualitas.test_required !=', '');

    // Filter color yang valid
    $this->db->where('tbl_kualitas.color !=', '-');
    $this->db->where('tbl_kualitas.color IS NOT NULL');
    $this->db->where('tbl_kualitas.color !=', '');

    // Tampilkan status 'belum' dan 'kembali'
    $this->db->where_in('tbl_kualitas.status', ['belum', 'kembali']);

    $this->db->group_by('tbl_kualitas.id_kualitas');

    return $this->db->get();
}

public function delete_reportkualitas_by_id($id_reportkualitas)
{
    $this->db->where('id_reportkualitas', $id_reportkualitas);
    $this->db->delete('report_kualitas');
}

public function update_handlingsample($data, $id_reportkualitas)
{
    $this->db->where('id_reportkualitas', $id_reportkualitas);
    $this->db->update('report_handlingsample', $data);
}


    public function joinKualitas_index() {
        $this->db->select('tbl_penerimaan.*, tbl_kualitas.*'); 
        $this->db->from('tbl_kualitas');
        $this->db->join('tbl_penerimaan', 'tbl_penerimaan.id_penerimaan = tbl_kualitas.id_penerimaan');

        // Filter test_required yang valid
        $this->db->where('tbl_kualitas.test_required !=', '-');
        $this->db->where('tbl_kualitas.test_required IS NOT NULL');
        $this->db->where('tbl_kualitas.test_required !=', '');

        // Filter color yang valid
        $this->db->where('tbl_kualitas.color !=', '-');
        $this->db->where('tbl_kualitas.color IS NOT NULL');
        $this->db->where('tbl_kualitas.color !=', '');

        // Tampilkan status 'belum' dan 'kembali'
        $this->db->where_in('tbl_kualitas.status', ['belum', 'kembali']);

        return $this->db->get();
    }



    

    public function tampil_testmethod()
    {
        $this->db->select('tbl_testmethod.*, m_methodgroup.*');
    
        $this->db->join('m_methodgroup','m_methodgroup.id_methodgroup = tbl_testmethod.id_methodgroup');
       
        $this->db->order_by('time',"DESC");

        return $this->db->get('tbl_testmethod');
    }

    public function kode_method()
    {
        $this->db->select('RIGHT(report_method.id_reportmethod, 3) as id_reportmethod', FALSE);
        $this->db->order_by('id_reportmethod','DESC');
        $this->db->limit(1);

        $query = $this->db->get('report_method');
        if($query->num_rows()<>0){
            $data = $query->row();
            $kode = intval($data->id_reportmethod) + 1;
        }else{
            $kode = 1;
        }
            $tgl = date('dmY');
            $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
            $kodeTampil = "MTF".$tgl.$batas; // format kode
            return $kodeTampil;
    }

    public function get_test_result($report_no) {
        $this->db->where('report_no', $report_no);
        $query = $this->db->get('tbl_kualitas');
        return $query->result(); // array semua baris
    }

    public function getByIdKualitas($where)
    {
        return $this->db->get_where('tbl_kualitas', $where);
    }


    // non - adidas
    public function getPenerimaanOther()
    {
        $query = $this->db->query("SELECT * FROM tbl_penerimaan Where buyer != 'adidas'");

        return $query;
    }

    public function get_report($report_no) {
        $this->db->select('tbl_penerimaan.*, tbl_kualitas.*');
        $this->db->from('tbl_kualitas'); // Pastikan 'tbl_kualitas' adalah tabel utama
        $this->db->join('tbl_penerimaan', 'tbl_penerimaan.id_penerimaan = tbl_kualitas.id_penerimaan');
        $this->db->where('tbl_kualitas.report_no', $report_no); // Pastikan kondisi where tepat
        return $this->db->get()->row(); // Mengembalikan satu baris data
    }

    public function lihat_nama_method($id_testmatrix) {
        $this->db->select('m_methodgroup.method_group, tbl_testmethod.*, tbl_testmatrix.*');
        $this->db->from('tbl_testmatrix');
        
        // Join tabel test_method ke test_matrix
        $this->db->join('tbl_testmethod', 'tbl_testmatrix.id_testmethod = tbl_testmethod.id_testmethod', 'left');
        
        // Join tabel method_group ke test_method
        $this->db->join('m_methodgroup', 'tbl_testmethod.id_methodgroup = m_methodgroup.id_methodgroup', 'left');
        
        // Kondisi untuk id_testmatrix
        $this->db->where('tbl_testmatrix.id_testmatrix', $id_testmatrix);
        
        $query = $this->db->get();
        return $query->row();  // Mengembalikan hasil
    }
    
       // Ambil daftar Method Group
       public function get_method_groups() {
        $this->db->select('id_methodgroup, method_group');
        $query = $this->db->get('m_methodgroup');
        return $query->result();
    }

    /*public function get_test_matrices_by_method_group($id_method_group) {
        $this->db->select('tbl_testmatrix.id_testmatrix, tbl_testmatrix.method_code');
        $this->db->from('tbl_testmethod');
        $this->db->join('tbl_testmatrix', 'tbl_testmethod.id_testmethod = tbl_testmatrix.id_testmethod');
        $this->db->where('tbl_testmethod.id_methodgroup', $id_method_group);
        return $this->db->get()->result();
    }*/

    public function get_test_matrices_by_method_group($id_method_group){
        $this->db->select('tbl_testmatrix.*, ');
        $this->db->from('tbl_testmatrix');
        $this->db->where('tbl_testmatrix.id_methodgroup', $id_method_group);
        return $this->db->get()->result();
    }
    
    //kode
    public function kodePenerimaan()
    {
        $tgl = date('dmY'); // Format tanggal hari ini (ddMMyyyy)
    
        // Mulai transaksi untuk memastikan atomisitas
        $this->db->trans_start();
    
        // Ambil kode terakhir dengan prefix tanggal hari ini
        $this->db->select('id_penerimaan');
        $this->db->like('id_penerimaan', "PNR{$tgl}", 'after'); // Prefix sesuai tanggal
        $this->db->order_by('id_penerimaan', 'DESC');
        $this->db->limit(1);
    
        $query = $this->db->get('tbl_penerimaan');
    
        if ($query->num_rows() > 0) {
            $lastId = $query->row()->id_penerimaan;
    
            // Ekstrak angka terakhir dari kode
            preg_match('/PNR\d{8}(\d{3})$/', $lastId, $matches);
            $kode = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
        } else {
            // Jika tidak ada kode pada tanggal ini, mulai dari 1
            $kode = 1;
        }
    
        // Format angka menjadi 3 digit
        $kodeBaru = str_pad($kode, 3, "0", STR_PAD_LEFT);
    
        // Gabungkan dengan prefix tanggal
        $kodePenerimaan = "PNR" . $tgl . $kodeBaru;
    
        // Commit transaksi
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === FALSE) {
            throw new Exception("Gagal menghasilkan kode penerimaan baru.");
        }
    
        return $kodePenerimaan;
    }
    
    public function kodeKualitas()
    {
        $this->db->select('RIGHT(tbl_kualitas.id_kualitas, 3) as id_kualitas', FALSE);
        $this->db->order_by('id_kualitas', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('tbl_kualitas');
        if ($query->num_rows()<>0){
            $data = $query->row();
            $kode = intval($data->id_kualitas) + 1;
        }else{
            $kode = 1;
        }

        $tgl = date('dmY');
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodeTampil = "KUL".$tgl.$batas;
        return $kodeTampil;
    }

    public function kodeReportKualitas()
    {
        $tgl = date('dmY'); // Tanggal dalam format ddmmyyyy
        
        // Ambil ID terakhir untuk tanggal yang sama
        $this->db->select('RIGHT(id_reportkualitas, 3) as id_reportkualitas', FALSE);
        $this->db->like('id_reportkualitas', 'REKUL' . $tgl, 'after');
        $this->db->order_by('id_reportkualitas', 'DESC');
        $this->db->limit(1);
    
        $query = $this->db->get('report_kualitas');
    
        if ($query->num_rows() != 0) {
            $data = $query->row();
            $kode = intval($data->id_reportkualitas) + 1;
        } else {
            $kode = 1; // Mulai dari 001 jika belum ada data untuk tanggal tersebut
        }
    
        // Format kode menjadi tiga digit
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodeTampil = "REKUL" . $tgl . $batas;
    
        return $kodeTampil;
    }
    

    // master data

    public function insertDepartment($data)
    {
        return $this->db->insert('m_department', $data);
    }

    public function getDepartment()
    {
        return $this->db->get('m_department');
    }

    public function getSupplier()
    {
        return $this->db->get('m_supplier');
    }

    public function updateDepartment($id_department, $data)
    {
         $this->db->where('id_department', $id_department);
         $this->db->update('m_department', $data);
    }

    public function getByIdDepartment($where)
    {
        return $this->db->get_where('m_department', $where);
    }

    public function deleteDepartment($id_department)
    {
        $this->db->delete('m_department',['id_department' => $id_department]);
    }

    public function insertEmail($data)
    {
        return $this->db->insert('m_applicant', $data);
    }

    public function getEmail()
    {
        return $this->db->get('m_applicant');
    }

    public function updateEmail($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('m_applicant', $data);
    }

    public function getByIdEmail($where)
    {
        return $this->db->get_where('m_applicant', $where);
    }
   
    public function insertMaterial($data)
    {
        return $this->db->insert('m_material', $data);
    }

    public function getMaterial()
    {
        return $this->db->get('m_material');
    }

    public function updateMaterial($id_material, $data)
    {
        $this->db->where('id_material',$id_material);
        $this->db->update('m_material', $data);
    }

    public function getByIdMaterial($where)
    {
        return $this->db->get_where('m_material', $where);
    }

    public function insertBrand($data)
    {
        return $this->db->insert('m_brand', $data);
    }

    public function getBrand()
    {
        return $this->db->get('m_brand');
    }

    public function updateBrand($id_brand, $data)
    {
        $this->db->where('id_brand', $id_brand);
        $this->db->update('m_brand', $data);
    }

    public function getByIdBrand($where)
    {
        return $this->db->get_where('m_brand', $where);
    } 

    public function insertOekotex($data)
    {
        return $this->db->insert('m_oekotex', $data);
    }

    public function getOekotex()
    {
        return $this->db->get('m_oekotex');
    }

    public function udpateOekotex($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('m_oekotex', $data);
    }

    public function getByIdOekotex($where)
    {
        return $this->db->get_where('m_oekotex', $where);
    }

    public function insertSizecategory($data)
    {
        return $this->db->insert('m_age', $data);
    }

    public function getSizecategory()
    {
        return $this->db->get('m_age');
    }

    public function updateSizecategory($id_age, $data)
    {
        $this->db->where('id_age', $id_age);
        $this->db->update('m_age', $data);
    }

    public function getByIdSizecategory($where)
    {
        return $this->db->get_where('m_age', $where);
    }

    public function insertStages($data)
    {
        return $this->db->insert('m_stages', $data);
    }

    public function getStages()
    {
        return $this->db->get('m_stages');
    }

    public function updateStages($id_stages, $data)
    {
        $this->db->where('id_stages', $id_stages);
        $this->db->update('m_stages', $data);
    }

    public function getByIdStages($where)
    {
        return $this->db->get_where('m_stages', $where);
    }
  
    public function tambahCare($data)
    {
        return $this->db->insert('m_care', $data);
    }
    

    public function insertCare($upload_data)
    {
        $data = array(
            'kategori_care' => $this->input->post('kategori_care'),
            'simbol_care' => $upload_data,
            'deskripsi' => $this->input->post('deskripsi')
        );

       return $this->db->insert('m_care', $data);
    }

    
    public function upload()
    {
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['remove_space'] = TRUE;

        $this->load->library('upload', $config);
        if($this->upload->do_upload('simbol_care')){
            $return = array('array' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        }else{
            $return = array('result' => 'failed','file' => '','error' => $this->upload->display_errors());
            return $return;
        }
    }

    public function getCare()
    {
        return $this->db->get('m_care');
    }

    public function updateCare($id_care, $data)
    {
        $this->db->where('id_care', $id_care);
        $this->db->update('m_care', $data);
    }

    public function getByIdCare($where)
    {
        return $this->db->get_where('m_care', $where);
    }

    public function getCareWashing()
    {
        $this->db->select('m_care.*');
        $this->db->where('m_care.kategori_care','Washing Process');
    
        return $this->db->get_where('m_care')->result();
      
    }

    public function getCareBleching()
    {

        $this->db->select('m_care.*');
        $this->db->where('m_care.kategori_care','Bleching Process');
    
        return $this->db->get_where('m_care')->result();
      
    }

    public function getCareDrying()
    {
        $this->db->select('m_care.*');
        $this->db->where('m_care.kategori_care','Tumble Drying Process');
    
        return $this->db->get_where('m_care')->result();
      
    }

    public function getCareIroning()
    {
        $this->db->select('m_care.*');
        $this->db->where('m_care.kategori_care','Ironing Process');
    
        return $this->db->get_where('m_care')->result();
    }

    public function getCareProfess()
    {
        $this->db->select('m_care.*');
        $this->db->where('m_care.kategori_care','Professional Textile Care Process');
    
        return $this->db->get_where('m_care')->result();
    }

    public function joinDeptEmail()
    {
        $this->db->select('m_applicant. *, m_department.department');
        $this->db->join('m_department','m_department.id_department = m_applicant.id_department');
        return $this->db->get('m_applicant');
    }
    
    public function materialFill($item_no)
    {
        $query = $this->db->select('*');
        $query = $this->db->where(['item_no' => $item_no]);
        $query = $this->db->get('m_material');
        return $query->row();
    }

    public function supplierFill($supplier_name)
    {
        $query = $this->db->select('*');
        $query = $this->db->where(['supplier_name' => $supplier_name]);
        $query = $this->db->get('m_supplier');
        return $query->row();
    }

    public function applicantFill($applicant)
    {
        $query = $this->db->select('m_applicant. *, m_department.*');
        $query = $this->db->join('m_department','m_department.id_department = m_applicant.id_department');
        $query = $this->db->where(['applicant' => $applicant]);
        $query = $this->db->get('m_applicant');
        return $query->row();
        
    }
    public function tampil_testmatrix()
    {
        $this->db->select('tbl_testmatrix.*, tbl_testmethod.*, m_methodgroup.*');
        $this->db->from('tbl_testmatrix');
        $this->db->join('tbl_testmethod','tbl_testmethod.id_testmethod = tbl_testmatrix.id_testmethod');
        $this->db->join('m_methodgroup','m_methodgroup.id_methodgroup = tbl_testmethod.id_methodgroup');
        $this->db->order_by('tbl_testmatrix.time',"DESC");
      
        return $this->db->get();
    }
    
    public function insert_reportKualitas($data)
    {
        $this->db->insert_batch('report_kualitas', $data);
    }

    public function getReportKualitas()
    {
        $this->db->select('tbl_penerimaan.*, tbl_kualitas.*, report_kualitas.*');
        $this->db->from('report_kualitas');
        $this->db->join('tbl_kualitas','tbl_kualitas.id_kualitas = report_kualitas.id_kualitas');
        $this->db->join('tbl_penerimaan','tbl_penerimaan.id_penerimaan = tbl_kualitas.id_penerimaan');

        return $this->db->get();
    }

    public function getReportSample()
        {
            $this->db->select('
                report_handlingsample.*, 
                MAX(report_handlingsample.personil) AS personil, 
                report_kualitas.*, 
                tbl_penerimaan.*, 
                tbl_kualitas.*'
            );
            $this->db->from('report_handlingsample');
            $this->db->join('report_kualitas', 'report_kualitas.id_reportkualitas = report_handlingsample.id_reportkualitas');
            $this->db->join('tbl_penerimaan', 'tbl_penerimaan.id_penerimaan = report_handlingsample.id_penerimaan');
            $this->db->join('tbl_kualitas', 'tbl_kualitas.id_kualitas = report_handlingsample.id_kualitas');
            $this->db->where('tbl_kualitas.status', 'selesai'); // ✅ Tambahkan ini
            $this->db->group_by('report_handlingsample.id_handlingsample');

            $query = $this->db->get();
            return $query;
        }

    
   public function getKualitasRevisi($id_reportkualitas, $id_penerimaan)
    {
        $this->db->select('report_kualitas.*, tbl_penerimaan.*, tbl_kualitas.*, report_handlingsample.*');
        $this->db->from('report_kualitas');
        $this->db->join('tbl_penerimaan', 'tbl_penerimaan.id_penerimaan = report_kualitas.id_penerimaan');
        $this->db->join('tbl_kualitas', 'tbl_kualitas.id_kualitas = report_kualitas.id_kualitas');
        $this->db->join('report_handlingsample', 'report_handlingsample.id_reportkualitas = report_kualitas.id_reportkualitas');

        $this->db->where('report_kualitas.id_reportkualitas', $id_reportkualitas);
        $this->db->where('report_kualitas.id_penerimaan', $id_penerimaan);

        return $this->db->get();
    }

   
    public function getReportUpdate($id_reportkualitas, $id_handlingsample)
    {
        $this->db->select('report_handlingsample.*, report_kualitas.*, tbl_penerimaan.*, tbl_kualitas.*');
        $this->db->from('report_handlingsample');
        $this->db->join('report_kualitas', 'report_kualitas.id_reportkualitas = report_handlingsample.id_reportkualitas');
        $this->db->join('tbl_penerimaan', 'tbl_penerimaan.id_penerimaan = report_handlingsample.id_penerimaan');
        $this->db->join('tbl_kualitas', 'tbl_kualitas.id_kualitas = report_handlingsample.id_kualitas');
        
        // Tambahkan kondisi filter berdasarkan kedua ID
        $this->db->where('report_handlingsample.id_reportkualitas', $id_reportkualitas);
        $this->db->where('report_handlingsample.id_handlingsample', $id_handlingsample);
        
        return $this->db->get();
    }

    public function getReportMethod($id_reportkualitas)
    {
        $this->db->select('report_kualitas.*,    report_kualitas.statement AS statement_rk, tbl_testmatrix.*, tbl_testmethod.*');
        $this->db->join('tbl_testmatrix', 'tbl_testmatrix.id_testmatrix = report_kualitas.id_testmatrix');
        $this->db->join('tbl_testmethod', 'tbl_testmethod.id_testmethod = tbl_testmatrix.id_testmethod');
        $query = $this->db->get_where('report_kualitas', array('id_reportkualitas' => $id_reportkualitas));
        
        return $query->result_array();
    }

    public function tampil_data()
    {
        $this->db->select("tbl_login.*, tbl_level.*");
        $this->db->from("tbl_login");
        $this->db->join("tbl_level","tbl_level.id_level = tbl_login.id_level");
        return $this->db->get();
    }

    public function get_level(){
        $this->db->select("*");
        $this->db->from("tbl_level");
        
        return $this->db->get();
    }

    public function insert_user($data){
        $this->db->insert('tbl_login',$data);
    }

    function delete_user($id_user)
    {
        $this->db->delete('tbl_login',['id_user' => $id_user]);
    }

    function edit_data($where, $table)
    {
        $this->db->get_where($table, $where);
        return TRUE;
    }
    
    public function tampil_producttype()
     {
         return $this->db->get('m_producttype');
     }

    public function get_regulation(){
          $this->db->select("*");
          $this->db->from("m_testingregulation");
          return $this->db->get();
    }
    
    public function tampil_ttd()
    {
        return $this->db->get('m_ttd');
    }
    
    public function getHistoryNo($id_penerimaan)
    {
        $this->db->select('
            rf.*,
            hs.*,
            tp.*
        ');

        $this->db->from('report_finalhandling rf');

        // Subquery untuk handlingsample
        $sub_hs = "(SELECT * FROM report_handlingsample WHERE id_penerimaan = " .
                $this->db->escape($id_penerimaan) . " LIMIT 1)";
        $this->db->join($sub_hs . " hs", "hs.id_penerimaan = rf.id_penerimaan", "left", false);

        // Subquery untuk tbl_penerimaan
        $sub_tp = "(SELECT * FROM tbl_penerimaan WHERE id_penerimaan = " .
                $this->db->escape($id_penerimaan) . " LIMIT 1)";
        $this->db->join($sub_tp . " tp", "tp.id_penerimaan = rf.id_penerimaan", "left", false);

        // Fokus tetap ke report_finalhandling
        $this->db->where('rf.id_penerimaan', $id_penerimaan);
        $this->db->order_by('rf.id_final', 'DESC');

        return $this->db->get()->result();
    }

    public function getHistoryAll()
    {
        $this->db->select('
            rf.*,
            hs.*,
            tp.*
        ');
        $this->db->from('report_finalhandling rf');
        $this->db->join('report_handlingsample hs', 'hs.id_penerimaan = rf.id_penerimaan', 'left');
        $this->db->join('tbl_penerimaan tp', 'tp.id_penerimaan = rf.id_penerimaan', 'left');

        // Kelompokkan berdasarkan id_penerimaan → ambil yang terbaru
        $this->db->group_by('rf.id_penerimaan');
        $this->db->order_by('rf.date_sending', 'DESC');

        return $this->db->get()->result();
    }


    public function deleteReportHandling($id_handlingsample)
    {
        $this->db->trans_start();

        // Ambil id_kualitas dari report_handlingsample
        $data = $this->db->select('id_kualitas')
            ->from('report_handlingsample')
            ->where('id_handlingsample', $id_handlingsample)
            ->get()
            ->row();

        if (!$data) {
            return false;
        }

        $id_kualitas = $data->id_kualitas;

        // ❌ DELETE tabel report
        $this->db->where('id_handlingsample', $id_handlingsample)
                ->delete('report_handlingsample');

        $this->db->where('id_kualitas', $id_kualitas)
                ->delete('report_kualitas');

        $this->db->where('id_kualitas', $id_kualitas)
                ->delete('report_finalhandling');

        // ✅ UPDATE status master kualitas
        $this->db->where('id_kualitas', $id_kualitas)
                ->update('tbl_kualitas', ['status' => 'belum']);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    
public function getTestRequiredDropdown($id_penerimaan, $report_no)
{
    $this->db->select('tbl_kualitas.test_required');
    $this->db->from('tbl_kualitas');
    $this->db->join(
        'report_kualitas',
        'report_kualitas.id_kualitas = tbl_kualitas.id_kualitas',
        'left'
    );

    // Filter penerimaan dan report_no
    $this->db->where('tbl_kualitas.id_penerimaan', $id_penerimaan);
    $this->db->where('report_kualitas.id_reportkualitas', $report_no);

    // Filter test_required valid
    $this->db->where('tbl_kualitas.test_required !=', '-');
    $this->db->where('tbl_kualitas.test_required IS NOT NULL');
    $this->db->where('tbl_kualitas.test_required !=', '');

    // Hanya status yang bisa diproses
    $this->db->where_in('tbl_kualitas.status', ['belum', 'kembali']);

    $this->db->group_by('tbl_kualitas.test_required');
    $this->db->order_by('tbl_kualitas.test_required', 'ASC');

    return $this->db->get()->result();
}



}
?>