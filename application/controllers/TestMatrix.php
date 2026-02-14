<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestMatrix extends CI_Controller {

   	public function __construct()
	{
		parent::__construct();

		 if (!$this->session->userdata('logincek')) {
            redirect('auth/login_other');
        }

		$this->load->library('form_validation');
        $this->load->helper(array('url','form'));
		$this->load->model('m_login');
		$this->load->model('m_testMatrix');
		//$this->load->library('upload');

	}

    public function indexMethod()
    {
        $data['testmethod'] = $this->m_testMatrix->tampil_testmethod()->result();
        $data['methodgroup'] = $this->m_testMatrix->tampil_methodgroup()->result();
        $this->template->load('layout/template','masterData/testMatrix/testMethod/index.php', $data);
    }

    public function tambahMethod()
    {
        $data['level'] = $this->m_testMatrix->getLevel()->result();
        $data['testmethod'] = $this->m_testMatrix->tampil_testmethod()->result();
        $data['methodgroup'] = $this->m_testMatrix->tampil_methodgroup()->result();
        $this->template->load('layout/template','masterData/testMatrix/testMethod/tambah.php', $data);
    }

    public function tambahaksiMethod()
    {
        $data = array(
            'method_id' => $this->input->post('method_id'),
            'method_name' => $this->input->post('method_name'),
            'id_methodgroup' => $this->input->post('id_methodgroup'),
            'ma_testmethod' => $this->input->post('ma_testmethod'),
            'fashion_casual' => $this->input->post('fashion_casual'),
            'hybrid_performance' => $this->input->post('hybrid_performance'),
            'remakrs' => $this->input->post('remakrs'),
        );

        $this->m_testMatrix->inputMethod($data, 'tbl_testmethod');

        redirect('testMatrix/indexMethod');
    }
    public function hapus_testmethod($id_testmethod)
    {
        $this->db->where('id_testmethod', $id_testmethod);
        $this->db->delete('tbl_testmethod');
        redirect('testMatrix/indexMethod');
        }

    public function editMethod($id_testmethod)
    {
       
        $data['level'] = $this->m_testMatrix->getLevel()->result();
        $where = array('id_testmethod' => $id_testmethod);
        $data['editmethod'] = $this->m_testMatrix->getByIdMethod($where,'tbl_testmethod')->result();
        $data['testmethod'] = $this->m_testMatrix->tampil_testmethod()->result();
        $data['methodgroup'] = $this->m_testMatrix->tampil_methodgroup()->result(); 

        $this->template->load('layout/template','masterData/testMatrix/testMethod/edit.php', $data);
    }

    
    public function editaksiMethod()
    {
        $id_testmethod = $this->input->post('id_testmethod');
        $method_id = $this->input->post('method_id');
        $method_name = $this->input->post('method_name');
        $id_methodgroup = $this->input->post('id_methodgroup');
        $ma_testmethod = $this->input->post('ma_testmethod');
        $fashion_casual = $this->input->post('fashion_casual');
        $hybrid_performance = $this->input->post('hybrid_performance');
        $remakrs = $this->input->post('remakrs');   

        $data = array(
            'id_testmethod' => $id_testmethod,
            'method_id' => $method_id,
            'method_name' => $method_name,
            'id_methodgroup' => $id_methodgroup,
            'ma_testmethod' => $ma_testmethod,
            'fashion_casual' => $fashion_casual,
            'hybrid_performance' => $hybrid_performance,
            'remakrs' => $remakrs
        );

        $this->m_testMatrix->editaksiMethod($id_testmethod, $data);
        redirect('testMatrix/indexMethod');
    }

    public function indexMatrix()
    {
        $data['testmethod'] = $this->m_testMatrix->tampil_testmethod()->result();
        $data['testmatrix'] = $this->m_testMatrix->tampil_testmatrix()->result();
        $data['brand'] = $this->m_testMatrix->tampil_brand()->result();
        $data['producttype'] = $this->m_testMatrix->tampil_producttype()->result();
        $data['shrinkage'] = $this->m_testMatrix->tampil_shrinkage()->result();
        $data['age'] = $this->m_testMatrix->tampil_age()->result();
        $this->template->load('layout/template','masterData/testMatrix/testMatrix/index.php', $data);
    }
    
    public function tambahMatrix()
    {
        $data['testmethod'] = $this->m_testMatrix->tampil_testmethod()->result();
        $data['testmatrix'] = $this->m_testMatrix->tampil_testmatrix()->result();
        $data['brand'] = $this->m_testMatrix->tampil_brand()->result();
        $data['producttype'] = $this->m_testMatrix->tampil_producttype()->result();
        $data['shrinkage'] = $this->m_testMatrix->tampil_shrinkage()->result();
        $data['age'] = $this->m_testMatrix->tampil_age()->result();
         $this->template->load('layout/template','masterData/testMatrix/testMatrix/tambah.php', $data);
    }
    public function tambahaksiMatrix(){
        $data = array(
        'id_testmethod'       => $this->input->post('id_testmethod'),
        'title'               => $this->input->post('title'),
        'method_code'         => $this->input->post('method_code'),
        'measurement'         => $this->input->post('measurement'),
        'brand'               => $this->input->post('brand'),
        'product_type'        => implode(',', (array)$this->input->post('product_type')),
        'age'                 => $this->input->post('age'),
        'dry'                 => $this->input->post('dry'),
        'test_level'          => $this->input->post('test_level'),
        'technology_concept'  => $this->input->post('technology_concept'),
        'fabric_tech'         => $this->input->post('fabric_tech'),
        'composition'         => $this->input->post('composition'),
        'result_type'         => $this->input->post('result_type')
    );
    $this->db->insert('tbl_testmatrix', $data);
    redirect('testMatrix/indexMatrix');
    }


    public function editMatrix($id_testmatrix)
    {
        $where = array ('id_testmatrix' => $id_testmatrix);
        $data['editmatrix'] = $this->m_testMatrix->getByIdMatrix($where,'tbl_testmatrix')->result();

        $data['testmethod'] = $this->m_testMatrix->tampil_testmethod()->result();
        $data['testmatrix'] = $this->m_testMatrix->tampil_testmatrix()->result();
        $data['brand'] = $this->m_testMatrix->tampil_brand()->result();
        $data['producttype'] = $this->m_testMatrix->tampil_producttype()->result();
        $data['shrinkage'] = $this->m_testMatrix->tampil_shrinkage()->result();
        $data['age'] = $this->m_testMatrix->tampil_age()->result();
     
        $this->template->load('layout/template','masterData/testMatrix/testMatrix/edit',$data);
    }

    public function editaksiMatrix()
    {
        $id_testmatrix = $this->input->post('id_testmatrix');
        $id_testmethod = $this->input->post('id_testmethod');
        $title = $this->input->post('title');
        $method_code = $this->input->post('method_code');
        $brand = $this->input->post('brand');
        $product_type = implode(',',$this->input->post('product_type'));
        $age = $this->input->post('age');
        $dry = $this->input->post('dry');
        $test_level = $this->input->post('test_level');
        $technology_concept = $this->input->post('technology_concept');
        $value_from = $this->input->post('value_from');
        $value_to = $this->input->post('value_to');
        $uom = $this->input->post('uom');
        $weight_from = $this->input->post('weight_from');
        $weight_to = $this->input->post('weight_to');
        $fabric_tech = $this->input->post('fabric_tech');
        $composition = $this->input->post('composition');
        $pass_fail = $this->input->post('pass_fail');
        $statement = $this->input->post('statement');
        $result_type = $this->input->post('result_type');
        $measurement = $this->input->post('measurement');

        $data = array(
            'id_testmatrix' => $id_testmatrix,
            'id_testmethod' => $id_testmethod,
            'title' => $title,
            'method_code' => $method_code,
            'brand' => $brand,
            'product_type' => $product_type,
            'age' => $age,
            'dry' => $dry,
            'test_level' => $test_level,
            'technology_concept' => $technology_concept,
            'value_from' => $value_from,
            'value_to' => $value_to,
            'uom' => $uom,
            'weight_from' => $weight_from,
            'weight_to' => $weight_to,
            'fabric_tech' => $fabric_tech,
            'composition' => $composition,
            'pass_fail' => $pass_fail,
            'statement' => $statement,
            'result_type' => $result_type,
            'measurement' => $measurement,
        );

        $this->db->where('id_testmatrix', $id_testmatrix);
        $this->db->update('tbl_testmatrix', $data);

        redirect('testMatrix/indexMatrix');
    }

    public function hapus_testmatrix($id_testmatrix)
    {
        $this->db->where('id_testmatrix', $id_testmatrix);
        $this->db->delete('tbl_testmatrix');

        redirect('testMatrix/indexMatrix');
    }
}
