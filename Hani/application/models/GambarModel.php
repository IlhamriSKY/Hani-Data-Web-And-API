<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GambarModel extends CI_Model {
	// Fungsi untuk menampilkan semua data gambar
	public function view(){
		return $this->db->get('gambar')->result();
	}
	
	// Fungsi untuk melakukan proses upload file
	public function upload(){
		$config['upload_path'] = './assets/images/loker';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']	= '3000';
		$config['remove_space'] = TRUE;
	
		$this->load->library('upload', $config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('input_gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}

	// Fungsi untuk melakukan proses upload file
	public function upload_idea(){
		$config['upload_path'] = './assets/images/idea';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']	= '3000';
		$config['remove_space'] = TRUE;
	
		$this->load->library('upload', $config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('input_gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
	
	// Fungsi untuk menyimpan data ke database
	public function save($upload){
		$data = array(
			'create_by' => $this->session->userdata('email'),
			'image' => $upload['file']['file_name'],
			'text' =>$this->input->post('input_deskripsi'),
			'status' => 'pending',
			'create_date' => current_datetime(),
			'update_date' => current_datetime(),
		);
		$data = $this->security->xss_clean($data);	
		$this->db->insert('info_loker', $data);
	}

	// Fungsi untuk menyimpan data ke database
	public function save_idea($upload){
		$data = array(
			'create_by' => $this->session->userdata('email'),
			'title' =>$this->input->post('input_title'),
			'image' => $upload['file']['file_name'],
			'text' =>$this->input->post('input_description'),
			'status' => 'accept',
			'create_date' => current_datetime(),
			'update_date' => current_datetime(),
		);
		$data = $this->security->xss_clean($data);	
		$this->db->insert('idea_funding', $data);
	}
}
