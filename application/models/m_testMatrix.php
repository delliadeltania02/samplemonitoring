<?php
class m_testMatrix extends CI_Model
{
    public function tampil_testmethod()
    {
        return $this->db->get('tbl_testmethod');
    }
     
    public function tampil_methodgroup()
    {
        return $this->db->get('m_methodgroup');
    }

    public function getLevel()
    {
        return $this->db->get('m_level');
    }

    public function getByIdMethod($where)   
    {
        return $this->db->get_where('tbl_testmethod', $where);
    }

    public function editaksiMethod($id_testmethod, $data)
    {
        $this->db->where('id_testmethod', $id_testmethod);
        $this->db->update('tbl_testmethod', $data);
    }
    public function inputMethod($data)
    {
        return $this->db->insert('tbl_testmethod', $data);
    }

    public function tampil_testmatrix()
    {
        $this->db->select('tbl_testmatrix.*, tbl_testmethod.*');
        $this->db->from('tbl_testmatrix');
        $this->db->join('tbl_testmethod','tbl_testmethod.id_testmethod = tbl_testmatrix.id_testmethod');
        //$this->db->join('m_methodgroup','m_methodgroup.id_methodgroup = tbl_testmethod.id_methodgroup');
        $this->db->order_by('tbl_testmatrix.time',"DESC");
      
         return $this->db->get('');
    }

    public function tampil_stages()
    {
        return $this->db->get('m_stages');
    }
    public function tampil_brand()
    {
        return $this->db->get('m_brand');
    }
    
    public function tampil_shrinkage()
    {
        return $this->db->get('m_shrinkage');
    }
    
    public function tampil_producttype()
    {
        return $this->db->get('m_producttype');
    }
    
    public function tampil_age()
    {
        return $this->db->get('m_age');
    }

    public function getByIdMatrix($where)
    {
        return $this->db->get_where('tbl_testmatrix', $where);
    }
}