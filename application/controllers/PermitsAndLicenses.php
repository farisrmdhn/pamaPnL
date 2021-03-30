<?php
class PermitsAndLicenses extends CI_Controller {
	public function index(){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}

		$data['title'] = 'Matrix Permit & License Identification ';
		$data['pl_matrixes'] = $this->pl_model->get_all_pl_matrix();
		if($this->session->userdata('user_type') == 0){
			$data['fulfillment_bar'] = $this->pl_model->get_fulfillment_bar_data($this->session->userdata('id'));
			$data['exp_bar'] = $this->pl_model->get_avg_exp_bar_data($this->session->userdata('id'));
		}
		$this->load->view('templates/header');
		$this->load->view('permitsAndLicenses/index', $data);
		$this->load->view('templates/footer');
	}

	public function pl_site_detail($id){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}

		$data['fulfillment_bar'] = $this->pl_model->get_fulfillment_bar_data($id);
		$data['pl_site_details'] = $this->pl_model->get_all_pl_site_detail($id);
		$data['exp_bar'] = $this->pl_model->get_avg_exp_bar_data($id);
		$info = $this->user_model->get_user_info($id);
		if($this->session->userdata('user_type') == 2){
			$data['title'] = 'Permits & Licenses Detail : '.$info['name'];
		}else{
			$data['title'] = $this->session->userdata('name').' Permits & Licenses Detail';
		}

		$this->load->view('templates/header');
		$this->load->view('permitsAndLicenses/pl_site_detail', $data);
		$this->load->view('templates/footer');
	}

	public function pl_site_details_by_status($id, $status){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$data['details'] = $this->pl_model->get_pl_site_details_by_status($id, $status);
		$status_name = 'Not yet started';

		if($status != 0){
			if($status == 1 || $status == 2){
				$status_name = "Done";
			}elseif($status == 4){
				$status_name = "Proses Perpanjangan";
			}else{
				$status_name = "Expired";
			}
		}


		$info = $this->user_model->get_user_info($id);
		if($this->session->userdata('user_type') == 2){
			$data['title'] = 'Permits & Licenses Detail : '.$info['name'].' -> '.$status_name;
		}else{
			$data['title'] = $this->session->userdata('name').' Permits & Licenses Detail : '.$status_name;
		}

		$this->load->view('templates/header');
		$this->load->view('permitsAndLicenses/pl_site_details_by_status', $data);
		$this->load->view('templates/footer');

	}

	public function detail($id_pl, $id_site = FALSE){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		if(!$id_site){
			$id_site = $this->session->userdata('id');
		}

		$data['id_site'] = $id_site;
		$data['pl_matrixes'] = $this->pl_model->get_pl_matrix($id_pl);
		$data['detail'] = $this->pl_model->get_pl_site_detail($id_site, $id_pl);
		$data['exp_bar'] = $this->pl_model->get_exp_bar_data($id_site, $id_pl);

		$this->load->view('templates/header');
		$this->load->view('permitsAndLicenses/detail', $data);
		$this->load->view('templates/footer');
	}

	public function all_pl_details($id_pl){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		if($this->session->userdata('user_type') == 0){
			redirect('dashboard/'.$this->session->userdata('id'));
		}
		
		$data['pl_matrixes'] = $this->pl_model->get_pl_matrix($id_pl);
		$data['details'] = $this->pl_model->get_all_pl_detail($id_pl);

		$this->load->view('templates/header');
		$this->load->view('permitsAndLicenses/all_pl_details', $data);
		$this->load->view('templates/footer');
	}

	public function all_details_by_status($status){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		if($this->session->userdata('user_type') == 0){
			redirect('dashboard/'.$this->session->userdata('id'));
		}
		$data['title'] = "P&L: Not yet started";
		$data['details'] = $this->pl_model->get_all_details_by_status($status);

		if($status != 0){
			if($status == 1 || $status == 2){
				$data['title'] = "P&L: Done";
			}elseif($status == 4){
				$data['title'] = "P&L: Proses Perpanjangan";
			}else{
				$data['title'] = "P&L: Expired";
			}
		}


		$this->load->view('templates/header');
		$this->load->view('permitsAndLicenses/all_details_by_status', $data);
		$this->load->view('templates/footer');
	}


	public function select_pl($id_user = FALSE){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}

		if(!$id_user){
			$id_user = $this->session->userdata('id');
		}

		$data['title'] = 'Input Permit/License Details';
		$data['details'] = $this->pl_model->get_select_pl($id_user);
		if($id_user){
			$data['user'] = $this->user_model->get_user_info($id_user);
		}
		$this->load->view('templates/header');
		$this->load->view('permitsAndLicenses/select_pl', $data);
		$this->load->view('templates/footer');
	}

	public function edit_details(){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}

		$data['title'] = 'Input Permit/License Details';
		$id_pl = $this->input->post('id');
		if($this->session->userdata('user_type') == 2){
			$id_site = $this->input->post('id_site');
		}else{
			$id_site = $this->session->userdata('id');
		}
		$data['detail'] = $this->pl_model->get_edit_detail($id_site, $id_pl);
		$data['id_site'] = $id_site;
		$this->load->view('templates/header');
		$this->load->view('permitsAndLicenses/edit_details', $data);
		$this->load->view('templates/footer');
	}

	public function update_details(){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}

		//upload image
		$config['upload_path'] = './assets/dokumen';
		$config['allowed_types'] = 'jpeg|png|jpg|webp';
		$config['max_size'] = '100000';
		$config['file_name'] = url_title($_FILES['image']['name'],'-', TRUE);

		$this->load->library('upload', $config);

		//if fail to upload, replace with default (noimage.png)
		if(!$this->upload->do_upload('image')){
			$error = array('error' => $this->upload->display_errors());
			$image = "noimage.png";
		} else {
			$data = array('upload_data' => $this->upload->data());
			$image = $this->upload->data('file_name');
		}

		//Update the startup's data to db via model
		$this->pl_model->update_details($image);

		//Set Message
		$this->session->set_flashdata('input_success', 'Permit/License Details has ben updated');

		//ganti dgn dokumen
		if($this->session->userdata('user_type') == 2){
			redirect('permitsAndLicenses/detail/'.$this->input->post('id_pl').'/'.$this->input->post('id_site'));
		}
		redirect('permitsAndLicenses/detail/'.$this->input->post('id_pl'));
	}

	public function perpanjangan(){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$id_pl = $this->input->post('id');
		$id_site = $this->input->post('id_site');

		$data['title'] = 'Perpanjangan Izin / Lisensi';
		$data['detail'] = $this->pl_model->get_pl_site_detail($id_site, $id_pl);
		$this->form_validation->set_rules('due_date', 'Due Date', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('permitsAndLicenses/perpanjangan', $data);
			$this->load->view('templates/footer');
		}else{
			$this->pl_model->perpanjang();
			if($this->session->userdata('user_type') == 2){
				redirect('permitsAndLicenses/detail/'.$id_pl.'/'.$id_site);
			}
			redirect('permitsAndLicenses/detail/'.$id_pl);
		}

	}

	public function edit_na($id){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		if($this->session->userdata('user_type') == 0){
			redirect('dashboard/'.$this->session->userdata('id'));
		}

		$data['id_site'] = $id;
		$data['title'] = 'Select Available Matrix';
		$data['details'] = $this->pl_model->get_edit_na($id);

		$this->load->view('templates/header');
		$this->load->view('permitsAndLicenses/edit_na', $data);
		$this->load->view('templates/footer');
	}

	public function update_na(){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		if($this->session->userdata('user_type') == 0){
			redirect('dashboard/'.$this->session->userdata('id'));
		}
		
		$this->pl_model->update_na();
		redirect('users/site_detail/'.$this->input->post('id_site'));

	}

	//BOT untuk Edit Detail
	// public function add_detail(){
	// 	$this->pl_model->add_detail();
	// 	die('done');
	// }
}