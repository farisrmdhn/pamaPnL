<?php
class Users extends CI_Controller {
	public function login(){
		$data['title'] = 'Sign In';

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE){
			$this->load->view('users/login', $data);
		}else{
			//Get Username
			$username = $this->input->post('username');
			//Get and encrypt the password
			$password = md5($this->input->post('password'));

			//Checks Username and Password
			$login = $this->user_model->login($username, $password);

			if($login){
				//Create session
				$user_data = array(
					'id' => $login['id'], 
					'name' => $login['name'],
					'user_type' => $login['user_type'],
					'email' => $login['email'], 
					'logged_in' => true
				);

				$this->session->set_userdata($user_data);

				//Set Message
				$this->session->set_flashdata('login_success', 'You are now logged in');

				if(!$login['email']){
					redirect('users/input_email');
				}

				if($login['user_type'] == '2'){
					redirect('admin_dashboard');
				}

				redirect('dashboard/'.$login['id']);
			} else{
				//Set Message
				$this->session->set_flashdata('login_failed', 'Login is invalid');

				redirect('login');
			}

			
		}
	}

	public function input_email(){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		if($this->session->userdata('email')){
			redirect('dashboard/'.$login['id']);
		}

		$data['title'] = 'Input Email';

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('email2', 'Confirm Email', 'matches[email]');

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('users/input_email', $data);
			$this->load->view('templates/footer');
		}else{
			$this->user_model->input_email();

			if($this->session->userdata('user_type') == '2'){
				redirect('admin_dashboard');
			}

			redirect('dashboard/'.$this->session->userdata('id'));
		}
	}

	public function routine_check(){
		$details = $this->pl_model->get_routine_check_details();
		$date_now = new DateTime(date('Y-m-d'));
		$admin_email = $this->user_model->get_admin_email();
		$admin_email = $admin_email['email'];

		foreach ($details as $detail) {
			$date_exp = new DateTime($detail['tgl_expired']);
			$id = $detail['id'];
			$email = $detail['email'];
			$status = $detail['status'];
			$alert_exp = $detail['alert_exp'];
			$alert1 = $detail['alert1'];
			$alert3 = $detail['alert3'];
			$alert6 = $detail['alert6'];
			$alert_due_date = $detail['alert_due_date'];
			$due_date = $detail['due_date'];
			//0 buat no izin, 1 buat atas nama
			$tipe = 0;
			$no_izin = '';
			$atas_nama = '';
			if($detail['no_izin']){
				$no_izin = $detail['no_izin'];
			}else{
				$tipe = 1;
				$atas_nama = $detail['atas_nama'];
			}

			if($status == 1 || $status == 2){
				if($date_now > $date_exp){
					$status = 3;
					$alert6 = 0;
					$alert3 = 0;
					$alert1 = 0;
					$subject = '';
					if($alert_exp == 0){
						if($tipe == 0){
							$subject = $detail['nama'].' di '.$detail['name'].' telah habis';
							$isi = $detail['nama'].' dengan nomor izin '.$no_izin.' telah habis. Untuk memperpanjang izin silahkan klik tombol "Perpanjang izin / Lisensi" pada link detail perizinan';
							$this->send_alert_email($email, $subject, $isi);
							//Kirim ke admin
							$this->send_alert_email($admin_email, $subject, $isi);
						}else{
							$subject = 'Lisensi '.$detail['nama'].' di '.$detail['name'].' telah habis';
							$isi = 'Lisesnsi '.$detail['nama'].' atas nama '.$atas_nama.' telah habis. Untuk memperpanjang lisensi silahkan klik tombol "Perpanjang izin / Lisensi" pada link detail lisensi';
							$this->send_alert_email($email, $subject, $isi);
							//Kirim ke admin
							$this->send_alert_email($admin_email, $subject, $isi);
						}
						$alert_exp = 1;
					}
				}else{
					$diff = $date_now->diff($date_exp);
					$month = ($diff->format('%y') * 12) + $diff->format('%m');
					if($month < 6){
						$status = 2;
						if($month < 1){
							if($alert1 == 0){
								if($tipe == 0){
									$subject = $detail['nama'].' di '.$detail['name'].' akan segera habis';
									$isi = $detail['nama'].' dengan nomor izin '.$no_izin.' akan habis dalam waktu '.$diff->days.' hari.  Untuk memperpanjang izin silahkan klik tombol "Perpanjang izin / Lisensi" pada link detail perizinan';
									$this->send_alert_email($email, $subject, $isi);
									//Kirim ke admin
									$this->send_alert_email($admin_email, $subject, $isi);
								}else{
									$subject = 'Lisensi '.$detail['nama'].' di '.$detail['name'].' akan segera habis';
									$isi = 'Lisesnsi '.$detail['nama'].' atas nama '.$atas_nama.' akan habis dalam waktu '.$diff->days.' hari. Untuk memperpanjang lisensi silahkan klik tombol "Perpanjang izin / Lisensi" pada link detail lisensi';
									$this->send_alert_email($email, $subject, $isi);
									//Kirim ke admin
									$this->send_alert_email($admin_email, $subject, $isi);
								}
								$alert1 = 1;
							}
						}elseif($month < 3){
							if($alert3 == 0){
								if($tipe == 0){
									$subject = $detail['nama'].' di '.$detail['name'].' akan segera habis';
									$isi = $detail['nama'].' dengan nomor izin '.$no_izin.' akan habis dalam waktu '.$month.' bulan.  Untuk memperpanjang izin silahkan klik tombol "Perpanjang izin / Lisensi" pada link detail perizinan';
									$this->send_alert_email($email, $subject, $isi);
									//Kirim ke admin
									$this->send_alert_email($admin_email, $subject, $isi);
								}else{
									$subject = 'Lisensi '.$detail['nama'].' di '.$detail['name'].' akan segera habis';
									$isi = 'Lisesnsi '.$detail['nama'].' atas nama '.$atas_nama.' akan habis dalam waktu '.$month.' bulan.  Untuk memperpanjang lisensi silahkan klik tombol "Perpanjang izin / Lisensi" pada link detail lisensi';
									$this->send_alert_email($email, $subject, $isi);
									//Kirim ke admin
									$this->send_alert_email($admin_email, $subject, $isi);
								}
								$alert3 = 1;
							}
						}else{
							if($alert6 == 0){
								if($tipe == 0){
									$subject = $detail['nama'].' di '.$detail['name'].' akan segera habis';
									$isi = $detail['nama'].' dengan nomor izin '.$no_izin.' akan habis dalam waktu '.$month.' bulan.  Untuk memperpanjang izin silahkan klik tombol "Perpanjang izin / Lisensi" pada link detail perizinan';
									$this->send_alert_email($email, $subject, $isi);
									//Kirim ke admin
									$this->send_alert_email($admin_email, $subject, $isi);
								}else{
									$subject = 'Lisensi '.$detail['nama'].' di '.$detail['name'].' akan segera habis';
									$isi = 'Lisesnsi '.$detail['nama'].' atas nama '.$atas_nama.' akan habis dalam waktu '.$month.' bulan.  Untuk memperpanjang lisensi silahkan klik tombol "Perpanjang izin / Lisensi" pada link detail lisensi';
									$this->send_alert_email($email, $subject, $isi);
									//Kirim ke admin
									$this->send_alert_email($admin_email, $subject, $isi);
								}
								$alert6 = 1;
							}
						}
					}
				}
			}elseif($status == 4){
				//Harusnya ada date saat dia ngeset due date perizinannya!!!!
				// $diff = $date_now->diff($due_date);
				// $days = ($diff->format('%y') * 12) + $diff->format('%m');
			}
			//update detail-nya
			$this->pl_model->update_status_and_alert($id, $status, $alert1, $alert3, $alert6, $alert_exp);
		}
	}

	public function send_alert_email($email, $subject, $isi){
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'pamapnl@gmail.com',
		    'smtp_pass' => 'kmRM3Zi5Ah8Rrt3',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);
		$this->load->library('email', $config);

		$this->email->set_newline("\r\n");
		$this->email->from('pamapnl@gmail.com', 'PT.PAMAPERSADA NUSANTARA : Permits & Licenses');
		$this->email->to($email);

		$this->email->subject($subject);
		$this->email->message($isi);
		if($this->email->send()){

		}else{
			echo 'gagal :(';
			die();
		}
	}

	public function add_user(){
		if($this->session->userdata['logged_in'] != true && $this->session->userdata['user_type'] != 2){
			redirect('login');
		}
		if($this->session->userdata['logged_in'] == true && $this->session->userdata['user_type'] != 2){
			redirect('dashboard/'.$this->session->userdata('id'));
		}

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('user_type', 'User Type', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exist');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('users/add_user');
			$this->load->view('templates/footer');
		}else{
			// Encrypt password
			$enc_password = md5($this->input->post('password'));

			$this->user_model->register($enc_password);

			redirect('users/manage_user');
		}
	}
	public function edit_user($id){
		if($this->session->userdata['logged_in'] != true && $this->session->userdata['user_type'] != 2){
			redirect('login');
		}
		if($this->session->userdata['logged_in'] == true && $this->session->userdata['user_type'] != 2){
			redirect('dashboard/'.$this->session->userdata('id'));
		}

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exist_edit');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'callback_check_password_matches');

		$data['info'] = $this->user_model->get_user_info($id);

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('users/edit_user', $data);
			$this->load->view('templates/footer');
		}else{
			$enc_password = $this->input->post('default_password');

			if($this->input->post('password') != NULL){
				$enc_password = md5($this->input->post('password'));
			}

			$this->user_model->update($enc_password);

			
			redirect('users/manage_user');
		
		}
	}

	public function admin_dashboard(){
		if($this->session->userdata['logged_in'] != true && $this->session->userdata['user_type'] != 2){
			redirect('login');
		}
		if($this->session->userdata['logged_in'] == true && $this->session->userdata['user_type'] != 2){
			redirect('dashboard/'.$this->session->userdata('id'));
		}

		$data['title'] = 'Admin Dashboard';
		$data['info'] = $this->user_model->get_user_info($this->session->userdata('id'));
		$data['fulfillment_bar'] = $this->pl_model->get_total_fulfillment_bar_data();
		$data['donut_data'] = json_encode($this->pl_model->get_donut_data());


		$permits_and_licenses = $this->pl_model->get_status();

		$this->load->view('templates/header');
		$this->load->view('users/admin_dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function export(){
		if($this->session->userdata['logged_in'] != true && $this->session->userdata['user_type'] != 2){
			redirect('login');
		}
		if($this->session->userdata['logged_in'] == true && $this->session->userdata['user_type'] != 2){
			redirect('dashboard/'.$this->session->userdata('id'));
		}
		include APPPATH.'third_party/PHPExcel.php';
		$excel = new PHPExcel();

		$excel->getProperties()->setCreator('Admin PAMA PnL')->setLastModifiedBy('Admin PAMA PnL')->setTitle("PnL full report");

		$style_col = array(
			'font' => array('bold' => true),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			)
		);

		$style_row = array(
			'font' => array('bold' => true),
			'alignment' => array( 
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			)
		);

		//Judul di kolom A1
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Permits and License Full Report");
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);

		//Header pada row ke 3
		$sites = $this->user_model->get_all_sites();
		$permits_and_licenses = $this->pl_model->get_all_permits_and_licenses();
		$status = $this->pl_model->get_status();
		$alphabet = ['A', 'B','C','D','E','F','G','H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
		$etc = ['No', 'Permit / License'];

		for($i = 0; $i < sizeof($etc); $i++){
			$excel->setActiveSheetIndex(0)->setCellValue($alphabet[$i].'3', $etc[$i]);
			$excel->getActiveSheet()->getStyle($alphabet[$i].'3')->applyFromArray($style_col);
		}

		for($i = 0; $i < sizeof($sites); $i++){
			$excel->setActiveSheetIndex(0)->setCellValue($alphabet[$i + 2].'3', $sites[$i]['name']);
			$excel->getActiveSheet()->getStyle($alphabet[$i + 2].'3')->applyFromArray($style_col);
		}

		//Iterasi mengisi status matrix 1 - 23, 24&25 belom karena dimasukinnya telat
		$k = 0;
		for($i = 0; $i < 23; $i++){
			$excel->setActiveSheetIndex(0)->setCellValue('A'.($i + 4), $i+1);
			$excel->getActiveSheet()->getStyle('A'.($i + 4))->applyFromArray($style_row);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.($i + 4), $permits_and_licenses[$i]['nama']);
			$excel->getActiveSheet()->getStyle('B'.($i + 4))->applyFromArray($style_row);
			$m = $k * 23;
			if($m > 437){
				$m = 437;
			}
			for($j = 0; $j < 23; $j++){
				$stat = $status[$j + $m]['status'];
				$isna = $status[$j + $m]['isna'];
				$warna = '808080';
				if($isna == 1){
					if($i < 20){
						$excel->setActiveSheetIndex(0)->setCellValue($alphabet[$i + 2].($j+4), 'N/A');	
						// $excel->setActiveSheetIndex(0)->setCellValue($alphabet[$i + 2].($j+4), $status[$j + $m]['status']);	
						$excel->getActiveSheet()->getStyle($alphabet[$i + 2].($j + 4))->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle($alphabet[$i + 2].($j + 4))->applyFromArray(
						    array(
						        'fill' => array(
						        'type' => PHPExcel_Style_Fill::FILL_SOLID,
						        'color' => array('rgb' => 'FFFFFF')
						        )
						    )
						);
					}
				}else{
					if($stat == 1 || $stat == 2){
						$warna = '00FF00';
					}elseif($stat == 0){
						$warna = '696969';
					}elseif($stat == 3){
						$warna = 'FF0000';
					}elseif($stat == 4){
						$warna = 'FFFF00';
					}
					if($i < 20){
						$excel->setActiveSheetIndex(0)->setCellValue($alphabet[$i + 2].($j+4), ' ');	
						// $excel->setActiveSheetIndex(0)->setCellValue($alphabet[$i + 2].($j+4), $status[$j + $m]['status']);	
						$excel->getActiveSheet()->getStyle($alphabet[$i + 2].($j + 4))->applyFromArray($style_row);
						$excel->getActiveSheet()->getStyle($alphabet[$i + 2].($j + 4))->applyFromArray(
						    array(
						        'fill' => array(
						        'type' => PHPExcel_Style_Fill::FILL_SOLID,
						        'color' => array('rgb' => $warna)
						        )
						    )
						);
					}
				}	
			}
			$k++;
		}

		// iterasi matriks 24&25 (POM & POU)
		for($i = 23; $i < 25; $i++){
			// Ngisi nomer dan nama matriks
			$excel->setActiveSheetIndex(0)->setCellValue('A'.($i + 4), $i+1);
			$excel->getActiveSheet()->getStyle('A'.($i + 4))->applyFromArray($style_row);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.($i + 4), $permits_and_licenses[$i]['nama']);
			$excel->getActiveSheet()->getStyle('B'.($i + 4))->applyFromArray($style_row);
		}

		$in_pompou = 0;
		for($i = 0; $i < 20; $i++){
			for($j = 0; $j < 2; $j++){
				$stat = $status[460 + $in_pompou]['status'];
				$isna = $status[460 + $in_pompou]['isna'];
				$warna = 'FFFFFF';
				if($isna == 1){
					$excel->setActiveSheetIndex(0)->setCellValue($alphabet[$i + 2].($j + 27), 'N/A');
					$excel->getActiveSheet()->getStyle($alphabet[$i + 2].($j + 27))->applyFromArray($style_row);
					$excel->getActiveSheet()->getStyle($alphabet[$i + 2].($j + 27))->applyFromArray(
					    array(
					        'fill' => array(
					        'type' => PHPExcel_Style_Fill::FILL_SOLID,
					        'color' => array('rgb' => $warna)
					        )
					    )
					);
				}else{
					if($stat == 1 || $stat == 2){
						$warna = '00FF00';
					}elseif($stat == 0){
						$warna = '696969';
					}elseif($stat == 3){
						$warna = 'FF0000';
					}elseif($stat == 4){
						$warna = 'FFFF00';
					}
					$excel->setActiveSheetIndex(0)->setCellValue($alphabet[$i + 2].($j + 27), ' ');
					$excel->getActiveSheet()->getStyle($alphabet[$i + 2].($j + 27))->applyFromArray($style_row);
					$excel->getActiveSheet()->getStyle($alphabet[$i + 2].($j + 27))->applyFromArray(
					    array(
					        'fill' => array(
					        'type' => PHPExcel_Style_Fill::FILL_SOLID,
					        'color' => array('rgb' => $warna)
					        )
					    )
					);
				}

				$in_pompou++;
			}
		}

		//Set Judul
		$excel->getActiveSheet(0)->setTitle("PnL full report");
		$excel->setActiveSheetIndex(0);

		//Proses File
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="PnL full report.xlsx"');
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function dashboard($id){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}

		$id = $this->session->userdata('id');
		$name = $this->session->userdata('name');

		if($this->session->userdata('user_type') == 0){
			$data['title'] = 'Dashboard '.$name;
			$data['info'] = $this->user_model->get_user_info($id);
			$data['fulfillment_bar'] = $this->pl_model->get_fulfillment_bar_data($id);
			$data['donut1_data'] = json_encode($this->pl_model->get_donut1_data($id));
			$data['donut2_data'] = json_encode($this->pl_model->get_donut2_data($id));
			$data['exp_bar'] = $this->pl_model->get_avg_exp_bar_data($id);
		}else{
			$data['title'] = 'Welcome '.$name;
			$data['info'] = $this->user_model->get_user_info($id);
		}
		

		$this->load->view('templates/header');
		$this->load->view('users/dashboard', $data);
		$this->load->view('templates/footer');
	}

	public function sitelist(){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		if($this->session->userdata('user_type') == 0){
			redirect('dashboard/'.$this->session->userdata('id'));
		}

		$data['title'] = 'Site List ';
		$data['users'] = $this->user_model->get_all_users();
		$this->load->view('templates/header');
		$this->load->view('users/sitelist', $data);
		$this->load->view('templates/footer');
	}

	public function sites_by_status($status){

		// INI DIGANTI JADI ADA BARCHART BERISIKAN SEMUA SITE
		
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		if($this->session->userdata('user_type') == 0){
			redirect('dashboard/'.$this->session->userdata('id'));
		}
		$data['title'] = "Sites: Not yet started";
		$data['all_status'] = json_encode($this->pl_model->get_all_status_per($status));
		$data['sites'] = $this->user_model->get_all_sites();
		$data['status'] = $status;

		$site_names = [];

		foreach ($data['sites'] as $site) {
			array_push($site_names, $site['name']);
		}

		$data['site_names'] = json_encode($site_names);

		if($status != 0){
			if($status == 1 || $status == 2){
				$data['title'] = "Sites: Done";
			}elseif($status == 4){
				$data['title'] = "Sites: Proses Perpanjangan";
			}else{
				$data['title'] = "Sites: Expired";
			}
		}

		$this->load->view('templates/header');
		$this->load->view('users/sites_by_status', $data);
		$this->load->view('templates/footer');
	}

	public function site_details_by_status($id, $status){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		if($this->session->userdata('user_type') == 0){
			redirect('dashboard/'.$this->session->userdata('id'));
		}
		$data['details'] = $this->user_model->get_site_details_by_status($id,$status);
		$data['title'] = "Sites : Not yet started";
		$data['status'] = $status;

		if($status != 0){
			if($status == 1 || $status == 2){
				$data['title'] = "Sites: Done";
			}elseif($status == 4){
				$data['title'] = "Sites: Proses Perpanjangan";
			}else{
				$data['title'] = "Sites: Expired";
			}
		}


		$this->load->view('templates/header');
		$this->load->view('users/site_details_by_status', $data);
		$this->load->view('templates/footer');
	}

	public function manage_user(){
		if((!$this->session->userdata('logged_in')) && ($this->session->userdata('user_type') != 2)){
			redirect('login');
		}
		if($this->session->userdata('user_type') != 2){
			redirect('dashboard/'.$this->session->userdata('id'));
		}

		$data['title'] = 'Manage User';
		$data['users'] = $this->user_model->get_all_users2();
		$this->load->view('templates/header');
		$this->load->view('users/manage_user', $data);
		$this->load->view('templates/footer');
	}

	public function site_detail($id){
		if((!$this->session->userdata('logged_in')) && ($this->session->userdata('user_type') != '2')){
			redirect('login');
		}
		if($this->session->userdata('user_type') == 0){
			redirect('dashboard/'.$this->session->userdata('id'));
		}

		$data['info'] = $this->user_model->get_user_info($id);
		$data['fulfillment_bar'] = $this->pl_model->get_fulfillment_bar_data($id);
		$data['donut1_data'] = json_encode($this->pl_model->get_donut1_data($id));
		$data['donut2_data'] = json_encode($this->pl_model->get_donut2_data($id));
		$data['exp_bar'] = $this->pl_model->get_avg_exp_bar_data($id);
		$data['title'] = 'Site Detail : '.$data['info']['name'];

		$this->load->view('templates/header');
		$this->load->view('users/site_detail', $data);
		$this->load->view('templates/footer');
	}

	public function change_password(){
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$data['title'] = 'Change your password';
		$this->form_validation->set_rules('old_password', 'Password', 'required|callback_check_old_password');
		$this->form_validation->set_rules('new_password', 'New password', 'required');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'matches[new_password]');

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('users/change_password', $data);
			$this->load->view('templates/footer');
		}else{
			$enc_password = md5($this->input->post('new_password'));

			$this->user_model->change_password($enc_password);

			//Set Message
			$this->session->set_flashdata('change_password', 'You successfully changed your password');

			if($this->session->userdata('user_type') == 2){
				redirect('admin_dashboard');
			}

			redirect('dashboard/'.$this->session->userdata('id'));
		}

		

	}

	public function logout(){
		// Unset user data
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('username');

		//Update Last Login
		$this->user_model->update_last_login($this->session->userdata('id'));

		//Set Message
		$this->session->set_flashdata('logout', 'You are now logged out');

		redirect('login');
	}

	public function check_old_password($old_password){
		$old_password = md5($old_password);
		$this->form_validation->set_message('check_old_password', 'That is not your old password. Please enter the right one');
		if($old_password === $this->user_model->check_old_password($old_password)){
			return true;
		}else{
			return false;
		}
	}

	public function check_username_exist($username){
		$this->form_validation->set_message('check_username_exist', 'That username is already taken. Please choose a diffrent one');

		if($this->user_model->check_username_exist($username)){
			return true;
		} else{
			return false;
		}
	}

	public function check_username_exist_edit($username){
		$this->form_validation->set_message('check_username_exist_edit', 'That username is already taken. Please choose a diffrent one');

		if($this->user_model->check_username_exist_edit($username)){
			return true;
		} else{
			return false;
		}
	}

	public function check_password_matches($password2){
		if($this->input->post('password2') == null){
			return true;
		}

		$this->form_validation->set_message('check_password_matches', 'Password did not match');
		if($this->input->post('password2') === $this->input->post('password')){
			return true;
		}else{
			return false;
		}
	}

	public function export_per_site($id) {
		if((!$this->session->userdata('logged_in')) && ($this->session->userdata('user_type') != '2')){
			redirect('login');
		}
		if($this->session->userdata('user_type') == 0){
			redirect('dashboard/'.$this->session->userdata('id'));
		}

		$info = $this->user_model->get_user_info($id);

		include APPPATH.'third_party/PHPExcel.php';
		$excel = new PHPExcel();

		$excel->getProperties()->setCreator('Admin PAMA PnL')->setLastModifiedBy('Admin PAMA PnL')->setTitle("PnL Site Report: ".$info['name']);

		$style_col = array(
			'font' => array('bold' => true),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			)
		);

		$style_row = array(
			'font' => array('bold' => true),
			'alignment' => array( 
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			)
		);

		$style_row_not_bold = array(
			'font' => array('bold' => false),
			'alignment' => array( 
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			)
		);

		//Judul di kolom A1
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Permits and License Site Report : ".$info['name']);
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);

		//Header pada row ke 3
		$permits_and_licenses = $this->pl_model->get_all_pl_site_detail_2($id);
		$alphabet = ['A', 'B','C','D','E','F','G','H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
		$etc = ['No', 'Permit / License', 'Tgl. Terbit', 'Tgl. Expired', 'Nomor Izin', 'Atas Nama', 'Status', 'Availability'];

		// Mengisi kolom dengan ETC
		for($i = 0; $i < sizeof($etc); $i++){
			$excel->setActiveSheetIndex(0)->setCellValue($alphabet[$i].'3', $etc[$i]);
			$excel->getActiveSheet()->getStyle($alphabet[$i].'3')->applyFromArray($style_col);
		}
		$k = 0;
		for($i = 0; $i < sizeof($permits_and_licenses); $i++){
			// Isi Nomor
			$excel->setActiveSheetIndex(0)->setCellValue('A'.($i + 4), $i+1);
			$excel->getActiveSheet()->getStyle('A'.($i + 4))->applyFromArray($style_row);
			
			// Isi nama P&L
			$excel->setActiveSheetIndex(0)->setCellValue('B'.($i + 4), $permits_and_licenses[$i]['nama']);
			$excel->getActiveSheet()->getStyle('B'.($i + 4))->applyFromArray($style_row);
			
			// Isi Tgl Terbit
			$excel->setActiveSheetIndex(0)->setCellValue('C'.($i + 4), $permits_and_licenses[$i]['tgl_terbit']);
			$excel->getActiveSheet()->getStyle('C'.($i + 4))->applyFromArray($style_row_not_bold);

			// Isi Tgl Expired
			$excel->setActiveSheetIndex(0)->setCellValue('D'.($i + 4), $permits_and_licenses[$i]['tgl_expired']);
			$excel->getActiveSheet()->getStyle('D'.($i + 4))->applyFromArray($style_row_not_bold);

			// Isi No. Izin
			$excel->setActiveSheetIndex(0)->setCellValue('E'.($i + 4), $permits_and_licenses[$i]['no_izin']);
			$excel->getActiveSheet()->getStyle('E'.($i + 4))->applyFromArray($style_row_not_bold);

			// Isi Atas Nama
			$excel->setActiveSheetIndex(0)->setCellValue('F'.($i + 4), $permits_and_licenses[$i]['atas_nama']);
			$excel->getActiveSheet()->getStyle('F'.($i + 4))->applyFromArray($style_row_not_bold);

			// Isi Status
			if($permits_and_licenses[$i]['status'] == 0) {
				$excel->setActiveSheetIndex(0)->setCellValue('G'.($i + 4), '-');
				$excel->getActiveSheet()->getStyle('G'.($i + 4))->applyFromArray($style_row);
			}elseif ($permits_and_licenses[$i]['status'] == 1) {
				$excel->setActiveSheetIndex(0)->setCellValue('G'.($i + 4), 'Done');
				$excel->getActiveSheet()->getStyle('G'.($i + 4))->applyFromArray($style_row);
			}elseif ($permits_and_licenses[$i]['status'] == 2) {
				$excel->setActiveSheetIndex(0)->setCellValue('G'.($i + 4), 'Proses Perpanjangan');
				$excel->getActiveSheet()->getStyle('G'.($i + 4))->applyFromArray($style_row);
			}else {
				$excel->setActiveSheetIndex(0)->setCellValue('G'.($i + 4), 'Expired');
				$excel->getActiveSheet()->getStyle('G'.($i + 4))->applyFromArray($style_row);
			}

			// Isi Availibility
			if ($permits_and_licenses[$i]['isna'] == 0) {
				$excel->setActiveSheetIndex(0)->setCellValue('H'.($i + 4), 'Available');
				$excel->getActiveSheet()->getStyle('H'.($i + 4))->applyFromArray($style_row);
			}else {
				$excel->setActiveSheetIndex(0)->setCellValue('H'.($i + 4), 'N/A');
				$excel->getActiveSheet()->getStyle('H'.($i + 4))->applyFromArray($style_row);
			}
		}


		//Set Judul
		$excel->getActiveSheet(0)->setTitle("PnL site report");
		$excel->setActiveSheetIndex(0);

		//Proses File
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="PnL Site Report.xlsx"');
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
}