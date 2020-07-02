<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontak extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
	   $this->load->model('login_model');
	   $this->load->model('hani_model');
    }
	
	//-- COMMANDS
	// -- Index Userlist
    public function list()
    {
        $data['kontak'] = $this->hani_model->get_all_kontaks();
        $data['count'] = $this->hani_model->get_loker_total();
        $data['main_content'] = $this->load->view('admin/user/hani/kontak_list', $data, TRUE);
        $this->load->view('admin/index', $data);
	}

    //-- Add
    public function index()
    {   
		if ($_POST) {
			$data = array(
			'create_by' => $this->session->userdata('email'),
			'title' => $_POST['title'],
			'pesan' => $_POST['pesan'],
			'create_date' => current_datetime()
		);

			$data = $this->security->xss_clean($data);
			$user_id = $this->hani_model->insert($data, 'kontak');
			$this->session->set_flashdata('msg', 'Pesan Berhasil Dikirim');
			redirect(base_url('admin/kontak'));
		}
		$data['page_title'] = 'Kontak Add';
		$data['main_content'] = $this->load->view('admin/user/hani/kontak_add', $data, TRUE);
		$this->load->view('admin/index', $data);
	}
}
