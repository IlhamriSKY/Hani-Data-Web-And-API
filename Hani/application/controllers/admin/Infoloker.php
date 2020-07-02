<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infoloker extends CI_Controller {

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
	//-- INFO LOKER
	// -- Index infoloker for User
    public function index()
    {
		$data = array();
        $data['page_title'] = 'Info Loker List';
        $data['info_loker'] = $this->hani_model->get_all_loker_bystatus("accept");
        $data['count'] = $this->hani_model->get_loker_total();
        $data['main_content'] = $this->load->view('admin/user/hani/infoloker_index', $data, TRUE);
        $this->load->view('admin/index', $data);
	}
	
	// -- Index infoloker for Admin
    public function list()
    {
		$data['info_loker'] = $this->hani_model->get_all_lokers();
        $data['count'] = $this->hani_model->get_loker_total();
        $data['main_content'] = $this->load->view('admin/user/hani/infoloker_list', $data, TRUE);
        $this->load->view('admin/index', $data);
	}

	// -- ADD LOKER
	public function add(){
		$data = array();
		
		if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
			// lakukan upload file dengan memanggil function upload yang ada di GambarModel.php
			$upload = $this->GambarModel->upload();
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				 // Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
				$this->GambarModel->save($upload);
				$this->session->set_flashdata('msg', 'Info Loker added Successfully, Menunggu Konfirmasi');
				redirect(base_url('admin/Infoloker/'));
			}else{ // Jika proses upload gagal
				$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}

		$data['page_title'] = 'Info Loker Add';
        $data['main_content'] = $this->load->view('admin/user/hani/infoloker_add', $data, TRUE);
        $this->load->view('admin/index', $data);
	}
    
    //-- Accept
    public function active($no) 
    {
        if ($this->session->userdata('role') == 'admin' || check_power(2)){
            $data = array(
				'status' => "accept",
				'update_date' => current_datetime()
            );
            $data = $this->security->xss_clean($data);
            $this->hani_model->update($data, $no,'info_loker');
            $this->session->set_flashdata('msg', 'Accept Successfully');
            redirect(base_url('admin/infoloker/list'));
        }
        else{
            redirect(base_url('admin/infoloker'));
        }

    }

    //-- Pending
    public function deactive($no) 
    {
        if ($this->session->userdata('role') == 'admin' || check_power(2)){
            $data = array(
				'status' => "pending",
				'update_date' => current_datetime()
            );
            $data = $this->security->xss_clean($data);
            $this->hani_model->update($data, $no,'info_loker');
            $this->session->set_flashdata('msg', 'Deactive Successfully');
            redirect(base_url('admin/infoloker/list'));
        }
        else{
            redirect(base_url('admin/infoloker'));
        }
    }

    //-- Delete
    public function delete($no)
    {
        if ($this->session->userdata('role') == 'admin' || check_power(3)){
			$this->hani_model->delete($no,'info_loker'); 
			$this->session->set_flashdata('msg', 'Deleted Successfully');
			redirect(base_url('admin/infoloker/list'));
        }
        else{
            redirect(base_url('admin/infoloker'));
        }
    }
}
