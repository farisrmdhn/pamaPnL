<?php
class Pl_model extends CI_Model{
	public function get_all_pl_matrix(){
		$sql = 'SELECT * FROM pl_matrix ;';
		return $this->db->query($sql)->result_array();
	}

	public function get_pl_matrix($id){
		$sql = 'SELECT * FROM pl_matrix WHERE id = "'.$id.'" ;';
		return $this->db->query($sql)->row_array();
	}

	public function get_export_detail(){
		
	}

	public function get_all_pl_detail($id){
		$sql = 'SELECT u.id as id_site , m.id as id_pl, u.name, d.tgl_terbit, d.tgl_expired, d.no_izin, d.atas_nama, d.atas_nama_2, d.atas_nama_3, d.atas_nama_4, d.atas_nama_5, d.image FROM pl_detail d INNER JOIN users u ON d.id_site=u.id INNER JOIN pl_matrix m ON d.id_pl=m.id WHERE m.id = "'.$id.'" AND d.isna = 0';
		return $this->db->query($sql)->result_array();
	}

	public function get_all_pl_site_detail($id){
		$sql = 'SELECT u.name, m.id , m.nama, m.kategori, m.ho, m.site, m.plc, m.divisi_1, m.divisi_2, m.keterangan, d.id_site, d.tgl_terbit, d.tgl_expired, d.no_izin, d.atas_nama, d.atas_nama_2, d.atas_nama_3, d.atas_nama_4, d.atas_nama_5, d.image, d.status, d.due_date, d.isna FROM pl_detail d INNER JOIN users u ON d.id_site=u.id INNER JOIN pl_matrix m ON d.id_pl=m.id WHERE u.id = "'.$id.'" AND d.isna = 0;';
		return $this->db->query($sql)->result_array();
	}

	public function get_all_pl_site_detail_2($id){
		$sql = 'SELECT u.name, m.id , m.nama, m.kategori, m.ho, m.site, m.plc, m.divisi_1, m.divisi_2, m.keterangan, d.id_site, d.tgl_terbit, d.tgl_expired, d.no_izin, d.atas_nama, d.atas_nama_2, d.atas_nama_3, d.atas_nama_4, d.atas_nama_5, d.image, d.status, d.due_date, d.isna FROM pl_detail d INNER JOIN users u ON d.id_site=u.id INNER JOIN pl_matrix m ON d.id_pl=m.id WHERE u.id = "'.$id.'" ;';
		return $this->db->query($sql)->result_array();
	}

	public function get_all_permits_and_licenses(){
		$sql = 'SELECT nama FROM pl_matrix';
		return $this->db->query($sql)->result_array();
	}

	public function get_status(){
		$sql = 'SELECT id, status, isna FROM pl_detail';
		return $this->db->query($sql)->result_array();

	}

	public function get_edit_na($id){
		$sql = 'SELECT d.id as "id_detail", u.name, m.id as "pl_no" , m.nama, m.kategori, d.id_site, d.tgl_terbit, d.tgl_expired, d.status, d.due_date, d.isna FROM pl_detail d INNER JOIN users u ON d.id_site=u.id INNER JOIN pl_matrix m ON d.id_pl=m.id WHERE u.id = "'.$id.'";';
		return $this->db->query($sql)->result_array();
	}

	public function update_na(){

		//inputnya isna_1 - isna_25
		//iterasi semua input buat di masukin ke id site yang dipilih
		for($i = 1; $i < 26; $i++){
			$sql = 'UPDATE pl_detail SET isna = '.$this->input->post('isna_'.$i).' WHERE id_pl = '.$i.' AND id_site = '.$this->input->post('id_site').' ;';
			$this->db->query($sql);
		}

		return 0;
	}

	public function get_all_details_by_status($status){
		if($status == 1 || $status == 2){
			$sql = 'SELECT u.name, m.id , m.nama, m.kategori, m.ho, m.site, m.plc, m.divisi_1, m.divisi_2, m.keterangan, d.id_site, d.tgl_terbit, d.tgl_expired, d.no_izin, d.atas_nama, d.atas_nama_2, d.atas_nama_3, d.atas_nama_4, d.atas_nama_5, d.image, d.status, d.due_date FROM pl_detail d INNER JOIN users u ON d.id_site=u.id INNER JOIN pl_matrix m ON d.id_pl=m.id WHERE (d.status = 1 OR d.status = 2) AND d.isna = 0; ';
			return $this->db->query($sql)->result_array();
		}else{
			$sql = 'SELECT u.name, m.id , m.nama, m.kategori, m.ho, m.site, m.plc, m.divisi_1, m.divisi_2, m.keterangan, d.id_site, d.tgl_terbit, d.tgl_expired, d.no_izin, d.atas_nama, d.atas_nama_2, d.atas_nama_3, d.atas_nama_4, d.atas_nama_5, d.image, d.status, d.due_date FROM pl_detail d INNER JOIN users u ON d.id_site=u.id INNER JOIN pl_matrix m ON d.id_pl=m.id WHERE d.status = "'.$status.'" AND d.isna = 0;';
			return $this->db->query($sql)->result_array();
		}
	}

	public function get_pl_site_details_by_status($id, $status){
		if($status == 1 || $status == 2){
			$sql = 'SELECT u.name, m.id , m.nama, m.kategori, m.ho, m.site, m.plc, m.divisi_1, m.divisi_2, m.keterangan, d.id_site, d.tgl_terbit, d.tgl_expired, d.no_izin, d.atas_nama, d.atas_nama_2, d.atas_nama_3, d.atas_nama_4, d.atas_nama_5, d.image, d.status, d.due_date FROM pl_detail d INNER JOIN users u ON d.id_site=u.id INNER JOIN pl_matrix m ON d.id_pl=m.id WHERE u.id = "'.$id.'" AND (d.status = 1 OR d.status = 2) AND d.isna = 0 AND d.image != "noimage.png";';
			return $this->db->query($sql)->result_array();
		}else{
			$sql = 'SELECT u.name, m.id , m.nama, m.kategori, m.ho, m.site, m.plc, m.divisi_1, m.divisi_2, m.keterangan, d.id_site, d.tgl_terbit, d.tgl_expired, d.no_izin, d.atas_nama, d.atas_nama_2, d.atas_nama_3, d.atas_nama_4, d.atas_nama_5, d.image, d.status, d.due_date FROM pl_detail d INNER JOIN users u ON d.id_site=u.id INNER JOIN pl_matrix m ON d.id_pl=m.id WHERE u.id = "'.$id.'" AND d.status = "'.$status.'" AND d.isna = 0;';
			return $this->db->query($sql)->result_array();
		}
	}

	public function get_pl_site_detail($id_site, $id_pl){
		$sql = 'SELECT d.*, m.nama, u.name FROM pl_detail d INNER JOIN users u ON d.id_site=u.id INNER JOIN pl_matrix m ON d.id_pl=m.id WHERE u.id = "'.$id_site.'" AND m.id = "'.$id_pl.'" AND d.isna = 0;';
		return $this->db->query($sql)->row_array();
	}

	public function get_select_pl($user_id){
		$sql = 'SELECT m.id, nama, isna FROM pl_matrix m INNER JOIN pl_detail d ON m.id = d.id_pl WHERE d.isna = 0 AND d.id_site = "'.$user_id.'";';
		return $this->db->query($sql)->result_array();
	}

	public function get_edit_detail($id_site, $id_pl){
		$sql = 'SELECT m.id as id_pl ,m.nama, m.kategori, d.* FROM pl_detail d INNER JOIN pl_matrix m ON d.id_pl = m.id WHERE id_site = '.$id_site.' AND id_pl = '.$id_pl.' AND d.isna = 0;';
		return $this->db->query($sql)->row_array();
	}

	public function get_routine_check_details(){
		$sql = 'SELECT d.id ,u.name, u.email, m.nama, d.no_izin, d.atas_nama, d.atas_nama_2, d.atas_nama_3, d.atas_nama_4, d.atas_nama_5, d.tgl_terbit, d.tgl_expired, d.masa_berlaku, d.status, d.alert_exp, d.alert1, d.alert3, d.alert6, d.alert_due_date, d.due_date FROM pl_detail d INNER JOIN pl_matrix m ON d.id_pl = m.id INNER JOIN users u ON d.id_site = u.id';
		return $this->db->query($sql)->result_array();
	}

	public function update_details($image){
		//Create an array of new details data
		$data = array(
			'tgl_terbit' => $this->input->post('tgl_terbit'),
			'tgl_expired' => $this->input->post('tgl_expired'),
			'no_izin' => $this->input->post('no_izin'),
			'atas_nama' => $this->input->post('atas_nama'),
			'atas_nama_2' => $this->input->post('atas_nama_2'),
			'atas_nama_3' => $this->input->post('atas_nama_3'),
			'atas_nama_4' => $this->input->post('atas_nama_4'),
			'atas_nama_5' => $this->input->post('atas_nama_5'),
			'masa_berlaku' => $this->input->post('masa_berlaku'),
			'status' => $this->input->post('status'),
			'due_date' => $this->input->post('due_date'),
			'keterangan' => $this->input->post('keterangan'),
			'image' => $image,
			'alert_exp' => 0,
			'alert1' => 0,
			'alert3' => 0,
			'alert6' => 0,
			'created_by' => $this->session->userdata('id')
		);

		//Get the startup's data by id
		$this->db->where('id', $this->input->post('id'));
		//Change the data
		return $this->db->update('pl_detail', $data);
	}

	public function update_status_and_alert($id, $status, $alert1, $alert3, $alert6, $alert_exp){
		$data = array(
			'status' => $status,
			'alert1' => $alert1,
			'alert3' => $alert3,
			'alert6' => $alert6,
			'alert_exp' => $alert_exp 
		);

		//Get the startup's data by id
		$this->db->where('id', $id);
		//Change the data
		return $this->db->update('pl_detail', $data);
	}

	public function get_fulfillment_bar_data($id){
		$sql = 'SELECT image, status, isna FROM pl_detail WHERE id_site = '.$id.';';
		$results = $this->db->query($sql)->result_array();
		$count = 0;
		$na = 0;
		foreach ($results as $result) {
			if($result['isna'] == '1'){
				$na++;
			}
			if(($result['status'] == '1') || ($result['status'] == '2')){
				if($result['image'] != 'noimage.png' && $result['isna'] == 0){
					$count++;
				}
			}
		}
		//percentage
		$per = round($count/(25 - $na) * 100, 2);
		$color = 'bg-danger';
		$text_color = '#eb4f34';
		if($per != 0 && $per < 100){
			$text_color = '#ebcc34';
			$color = 'bg-warning';
		}else if($per == 100){
			$text_color = '#6eeb34';
			$color = 'bg-success';
		}

		$result = [$per, $color, $text_color];

		return $result;
	}

	public function get_total_fulfillment_bar_data(){
		$sql = 'SELECT image, status, isna FROM pl_detail;';
		$results = $this->db->query($sql)->result_array();
		$count = 0;
		$na = 0;
		$total = 25 * 20;
		foreach ($results as $result) {
			if($result['isna'] == 1){
				$na++;
			}
		}
		// $total = $total - $na;
		foreach ($results as $result) {
			if(($result['status'] == '1') || ($result['status'] == '2')){
				if($result['image'] != 'noimage.png' && $result['isna'] == 0){
					$count++;
				}
			}
		}
		//percentage
		$per = round(($count/($total - $na)) * 100, 2);
		$color = 'bg-danger';
		$text_color = '#eb4f34';
		if($per != 0 && $per < 100){
			$text_color = '#ebcc34';
			$color = 'bg-warning';
		}else if($per == 100){
			$text_color = '#6eeb34';
			$color = 'bg-success';
		}

		$result = [$per, $color, $text_color];

		return $result;
	}

	//hny dipanggil di user_model
	public function get_all_fulfillment_bar_data(){
		$final_res = [];
		for($i = 1; $i < 22; $i++){
			$sql = 'SELECT id, id_site, id_pl, image, status, isna FROM pl_detail WHERE id_site = '.$i.';';
			$results = $this->db->query($sql)->result_array();
			$count = 0;
			$na = 0;
			foreach ($results as $result) {
				if($result['isna'] == '1'){
					$na++;
				}
				if(($result['status'] == '1') || ($result['status'] == '2')){
					if($result['image'] != 'noimage.png' && $result['isna'] == 0){
						$count++;
					}
				}
			}
			//percentage
			$per = round(($count/(25 - $na)) * 100, 2);
			$color = 'bg-danger';
			$text_color = '#eb4f34';
			if($per != 0 && $per < 100){
				$text_color = '#ebcc34';
				$color = 'bg-warning';
			}else if($per == 100){
				$text_color = '#6eeb34';
				$color = 'bg-success';
			}

			$result = [$per, $color, $text_color];

			array_push($final_res, $result) ;
		}

		return $final_res;
		
	}

	public function get_all_status_per($status){
		$all_counts = [];
		for($i = 1; $i < 8; $i++){
			$sql = 'SELECT status, isna, image FROM pl_detail WHERE id_site = '.$i.';';
			$results = $this->db->query($sql)->result_array();
			$count = 0;
			$na = 0;
			foreach ($results as $result) {
				if($result['isna'] == '1'){
					$na++;
				}
				if($status == 1 || $status == 2){
					if($result['status'] == 1 || $result['status'] == 2){
						if($result['image'] != 'noimage.png' && $result['isna'] == 0){
							$count++;
						}
					}
				}else{
					if($result['status'] == $status){
						$count++;
					}
				}
			}

			$per = round((($count / (25 - $na)) * 100), 2);

			array_push($all_counts, $per) ;
		}
		for($i = 9; $i < 22; $i++){
			$sql = 'SELECT status,isna, image FROM pl_detail WHERE id_site = '.$i.';';
			$results = $this->db->query($sql)->result_array();
			$count = 0;
			$na = 0;
			foreach ($results as $result) {
				if($result['isna'] == '1'){
					$na++;
				}
				if($status == 1 || $status == 2){
					if($result['status'] == 1 || $result['status'] == 2){
						if($result['image'] != 'noimage.png' && $result['isna'] == 0){
							$count++;
						}
					}
				}else{
					if($result['status'] == $status){
						$count++;
					}
				}
			}

			$per = round((($count / (25 - $na)) * 100), 2);

			array_push($all_counts, $per) ;
		}

		return $all_counts;
	}

	public function get_exp_bar_data($id_site, $id_pl){
		$sql = 'SELECT status, tgl_terbit, tgl_expired, due_date FROM pl_detail WHERE id_site = '.$id_site.' AND id_pl = '.$id_pl.' AND isna = 0;';
		$result = $this->db->query($sql)->row_array();

		if($result['status'] == '0'){
			return 0;
		}elseif($result['status'] == '3'){
			return 0;
			//Jika Expired

			//Ini yang tadinya warning
			// $due_date = new DateTime($result['due_date']);
			// $date_now = new DateTime(date('Y-m-d'));
			// $diff = $due_date->diff($date_now);
			// $diff = $diff->days;
			// return $diff;
		}else{
			//Jika Done atau Warning
			$date_now = new DateTime(date('Y-m-d'));
			$tgl_terbit = new DateTime($result['tgl_terbit']);
			$tgl_expired = new DateTime($result['tgl_expired']);

			//now - exp
			$diff1 =$date_now->diff($tgl_expired);
			//days differnece
			$diff1 = $diff1->days;
			//exp - terbit
			$diff2 = $tgl_terbit->diff($tgl_expired);
			$diff2 = $diff2->days;

			if($diff2 == 0){
				$diff2 = 1;
			}

			// return $diff1;
			return (round((($diff1/$diff2) * 100), 2));
		}
	}

	public function get_avg_exp_bar_data($id){
		$sql = 'SELECT status, tgl_terbit, tgl_expired, due_date FROM pl_detail WHERE id_site = '.$id.' AND isna = 0;';
		$results = $this->db->query($sql)->result_array();
		$tot1=  0;
		$tot2= 0;

		foreach ($results as $result){
			if(($result['status'] == '1') || ($result['status'] == '2')){
				$date_now = new DateTime(date('Y-m-d'));
				$tgl_terbit = new DateTime($result['tgl_terbit']);
				$tgl_expired = new DateTime($result['tgl_expired']);

				//now - exp
				$diff1 =$date_now->diff($tgl_expired);
				//days differnece
				$diff1 = $diff1->days;
				//exp - terbit
				$diff2 = $tgl_terbit->diff($tgl_expired);
				$diff2 = $diff2->days;


				$tot1 = $tot1 + $diff1;
				$tot2 = $tot2 + $diff2;
				
			}
		}

		if($tot2 == 0){
			$tot2 = 1;
		}

		// return $total;
		return round((($tot1/$tot2) * 100), 2);
	}

	public function get_donut1_data($id){
		$sql = 'SELECT image, status, isna FROM pl_detail WHERE id_site = '.$id.' AND isna = 0;';
		$results = $this->db->query($sql)->result_array();
		$count = 0;
		$na = 0;
		foreach ($results as $result) {
			if($result['isna'] == 1){
				$na++;
			}
			if(($result['status'] == '1') || ($result['status'] == '2')){
				if($result['image'] != 'noimage.png' && $result['isna'] == 0){
					$count++;
				}
			}
		}

		$not_ready = 23 - $na - $count;

		return [$count, $not_ready];
	}

	public function get_donut2_data($id){
		$sql = 'SELECT status, image, isna FROM pl_detail WHERE id_site = '.$id.' AND isna = 0;';
		$results = $this->db->query($sql)->result_array();

		$not_yet_started = 0;
		$done = 0;
		$perpanjangan = 0;
		$expired = 0;

		foreach ($results as $result) {
			if($result['status'] == '0'){
				$not_yet_started++;
			}elseif($result['status'] == '1' || $result['status'] == '2') {
				if($result['image'] != 'noimage.png' && $result['isna'] == 0){
					$done++;
				}
			}elseif($result['status'] == '4'){
				$perpanjangan++;
			}else{
				$expired++;
			}
		}

		return [$not_yet_started, $done, $perpanjangan, $expired];

	}

	public function get_donut_data(){
		$sql = 'SELECT status, image, isna FROM pl_detail;';
		$results = $this->db->query($sql)->result_array();

		$not_yet_started = 0;
		$done = 0;
		$perpanjangan = 0;
		$expired = 0;

		foreach ($results as $result) {
			if($result['status'] == '0'){
				$not_yet_started++;
			}elseif($result['status'] == '1' || $result['status'] == 2) {
				if($result['image'] != 'noimage.png' && $result['isna'] == 0){
					$done++;
				}
			}elseif($result['status'] == '4'){
				$perpanjangan++;
			}else{
				$expired++;
			}
		}

		return [$not_yet_started, $done, $perpanjangan, $expired];
	}

	public function perpanjang(){
		//Create an array of new details data
		$data = array(
			'due_date' => $this->input->post('due_date'),
			'keterangan' => $this->input->post('keterangan'),
			'status' => 4,
			//mungkin tambah alert
			'created_by' => $this->session->userdata('id')
		);

		//Get the startup's data by id
		$this->db->where('id', $this->input->post('id_detail'));
		//Change the data
		return $this->db->update('pl_detail', $data);
	}


	//BOT Untuk input pl detail
	// public function add_detail(){
	// 	$id = 21;
	// 	for($i = 1; $i < 24; $i++){
	// 		if($i>3 && $i < 21){
	// 			$data = array(
	// 				'id_site' => $id,
	// 				'id_pl' => $i,
	// 				'tgl_terbit' => '0000-00-00',
	// 				'tgl_expired' => '0000-00-00',
	// 				'created_by' => 21
	// 			);
	// 		}else{
	// 			$data = array(
	// 				'id_site' => $id,
	// 				'id_pl' => $i,
	// 				'tgl_terbit' => '0000-00-00',
	// 				'tgl_expired' => '0000-00-00',
	// 				'created_by' => 21
	// 			);
	// 		}
				

	// 		$this->db->insert('pl_detail', $data);
	// 	}

	// 	return 0;
	// }
}