<?php
class M_login extends CI_Model
{
	public function login($username, $password) {
		// GUNAKAN QUERY BUILDER untuk keamanan
		$this->db->where('username', $username);
		$this->db->where('password', $password); // NOTE: gunakan password hash untuk keamanan
		$query = $this->db->get('tbl_login');

		if ($query->num_rows() > 0) {
			return $query->row_array(); // ✅ Return data user
		} else {
			return false;
		}
	}

	public function login_other($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('tbl_login');

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function current_user() {
		if (!$this->session->has_userdata('id_user')) {
			return null;
		}

		$user_id = $this->session->userdata('id_user');
		$query = $this->db->get_where('tbl_login', ['id' => $user_id]);
		return $query->row();
	}
}
