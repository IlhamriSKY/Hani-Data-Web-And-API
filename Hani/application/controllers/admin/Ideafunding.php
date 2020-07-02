<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ideafunding extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
		$this->load->model('common_model');
		$this->load->model('hani_model');
		$this->load->model('login_model');
		$this->load->model('GambarModel');
	   	$this->load->helper(array('form', 'url'));
    }

	// -- CRUD
	//-- INFO IDEA
	// -- Index idea funding for User
    public function index()
    {
		$data = array();
        $data['page_title'] = 'Idea Funding List';
        $data['idea_funding'] = $this->hani_model->get_all_idea_bystatus("accept");
        $data['count'] = $this->hani_model->get_loker_total();
        $data['main_content'] = $this->load->view('admin/user/hani/ideafunding_index', $data, TRUE);
        $this->load->view('admin/index', $data);
	}

	// -- ADD IDEA
	public function add(){
		$data = array();
		
		if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
			// lakukan upload file dengan memanggil function upload yang ada di GambarModel.php
			$upload = $this->GambarModel->upload_idea();
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				 // Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
				$this->GambarModel->save_idea($upload);
				$this->session->set_flashdata('msg', 'Idea added Successfully, Menunggu Konfirmasi');
				redirect(base_url('admin/ideafunding/'));
			}else{ // Jika proses upload gagal
				$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}

		$data['page_title'] = 'Idea Funding Add';
        $data['main_content'] = $this->load->view('admin/user/hani/ideafunding_add', $data, TRUE);
        $this->load->view('admin/index', $data);
	}
}
