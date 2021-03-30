<?php
class User_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function register($enc_password){
		// User data array
		$name = $this->input->post('name');
		$username = $this->input->post('username');
		$user_type = $this->input->post('user_type');
		//Insert user
		return $this->db->query("INSERT INTO users (name, username, password, user_type) VALUES ('".$name."', '".$username."', '".$enc_password."', '".$user_type."')");
	}

	public function login($username, $password){
		//Validate
		$sql = 'SELECT id, name, user_type, email FROM users WHERE username = "'.$username.'" AND password = "'.$password.'";';
		$result = $this->db->query($sql);
		//Validate
		if($result->num_rows() == 1){
			$login = $result->row_array();
			return $login;
		} else{
			return false;
		}
	}

	public function update($enc_password){
		$data = array(
			'name' => $this->input->post('name'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => $enc_password
		);

		//Get the startup's data by id
		$this->db->where('id', $this->input->post('id'));
		//Change the data
		return $this->db->update('users', $data);
	}

	public function input_email(){
		$data = array(
			'email' => $this->input->post('email')
		);

		//Get the startup's data by id
		$this->db->where('id', $this->input->post('id'));
		//Change the data
		return $this->db->update('users', $data);
	}

	public function get_admin_email(){
		$sql = 'SELECT email FROM users WHERE user_type= "2" ;';
		return $this->db->query($sql)->row_array();
	}


	public function get_user_info($id){
		$sql = 'SELECT id, password, username, name, last_login, user_type, email FROM users WHERE id="'.$id.'" ;';
		return $this->db->query($sql)->row_array();
	}

	public function get_all_users(){
		$sql = 'SELECT id, username, name, last_login FROM users ;';
		return [$this->db->query($sql)->result_array(), $this->pl_model->get_all_fulfillment_bar_data()];
	}

	public function get_all_site_by_status($status){
		$sql = 'SELECT id, username, name, last_login FROM users;';
		return [$this->db->query($sql)->result_array(), $this->pl_model->get_all_status_per($status)];
	}

	public function get_site_details_by_status($id, $status){
		if($status == 1 || $status == 2){
			$sql = 'SELECT u.name, m.id , m.nama, m.kategori, m.ho, m.site, m.plc, m.divisi_1, m.divisi_2, m.keterangan, d.id_site, d.tgl_terbit, d.tgl_expired, d.no_izin, d.atas_nama, d.atas_nama_2, d.atas_nama_3, d.atas_nama_4, d.atas_nama_5, d.image, d.status, d.due_date FROM pl_detail d INNER JOIN users u ON d.id_site=u.id INNER JOIN pl_matrix m ON d.id_pl=m.id WHERE u.id = "'.$id.'" AND (d.status = 1 OR d.status = 2);';
			return $this->db->query($sql)->result_array();
		}else{
			$sql = 'SELECT u.name, m.id , m.nama, m.kategori, m.ho, m.site, m.plc, m.divisi_1, m.divisi_2, m.keterangan, d.id_site, d.tgl_terbit, d.tgl_expired, d.no_izin, d.atas_nama, d.atas_nama_2, d.atas_nama_3, d.atas_nama_4, d.atas_nama_5, d.image, d.status, d.due_date FROM pl_detail d INNER JOIN users u ON d.id_site=u.id INNER JOIN pl_matrix m ON d.id_pl=m.id WHERE u.id = "'.$id.'" AND d.status = "'.$status.'";';
			return $this->db->query($sql)->result_array();
		}
	}

	public function get_all_sites(){
		$sql = 'SELECT id, name FROM users WHERE user_type = 0';
		return $this->db->query($sql)->result_array();
	}

	public function get_all_users2(){
		$sql = 'SELECT id, username, name, user_type, last_login FROM users ;';
		return $this->db->query($sql)->result_array();
	}

	public function update_last_login($id){
		$sql = 'UPDATE users SET last_login=CURRENT_TIMESTAMP WHERE id = "'.$id.'" ;';
		return $this->db->query($sql);
	}

	public function get_change_password_info($id){
		$sql = 'SELECT * FROM users WHERE id="'.$id.'" ;';
		return $this->db->query($sql)->row_array();
	}

	public function change_password($enc_password){
		return $this->db->query("UPDATE users SET password = '".$enc_password."' WHERE id = ".$this->session->userdata['id']." ;");
	}

	public function check_old_password($old_password){
		$result = $this->db->query("SELECT password FROM users WHERE id = ".$this->session->userdata['id']." AND password = '".$old_password."';");
		if($result->num_rows() == 1){
			return $result->row(0)->password;
		}else{
			return false;
		}
	}

	public function check_username_exist($username){
		$query = $this->db->query("SELECT * FROM users WHERE username = '".$username."'");
		if(empty($query->row_array())){
			return true;
		} else{
			return false;
		}
	}

	public function check_username_exist_edit($username){
		$query = $this->db->query("SELECT * FROM users WHERE username = '".$username."'");
		if(empty($query->row_array())){
			return true;
		}else{
			if($this->input->post('id') == $query->row_array()['id']){
				return true;
			}else{
				return false;
			}		
		}
	}
}