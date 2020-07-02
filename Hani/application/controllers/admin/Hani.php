<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hani extends CI_Controller {

    public function __construct(){
        parent::__construct();
        check_login_user();
		$this->load->model('hani_model');
		$this->load->model('login_model');
    }
    
    public function index(){
        $data = array();
        $data['page_title'] = 'Dashboard';
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data);
	}
	
    public function sambutan(){
        $data = array();
        $data['page_title'] = 'Sambutan';
        $data['main_content'] = $this->load->view('admin/user/hani/sambutan', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function entrylevel(){
        $data = array();
        $data['page_title'] = 'Entrylevel';
        $data['main_content'] = $this->load->view('admin/user/news/entrylevel', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function midlevel(){
        $data = array();
        $data['page_title'] = 'Midlevel';
        $data['main_content'] = $this->load->view('admin/user/news/midlevel', $data, TRUE);
        $this->load->view('admin/index', $data);
	}

    public function campushiring(){
        $data = array();
        $data['page_title'] = 'Campushiring';
        $data['main_content'] = $this->load->view('admin/user/news/campushiring', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
	
    public function unikanews(){
        $data = array();
        $data['page_title'] = 'Unikanews';
        $data['main_content'] = $this->load->view('admin/user/news/unikanews', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function ikasopera(){
        $data = array();
        $data['page_title'] = 'Ikasopera';
        $data['main_content'] = $this->load->view('admin/user/news/ikasopera', $data, TRUE);
        $this->load->view('admin/index', $data);
	}
	
    public function metamorfosa(){
        $data = array();
        $data['page_title'] = 'Metamorfosa';
        $data['main_content'] = $this->load->view('admin/user/news/metamorfosa', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

	public function video(){
        $data = array();
        $data['page_title'] = 'Video';
        $data['main_content'] = $this->load->view('admin/user/news/video', $data, TRUE);
        $this->load->view('admin/index', $data);
	}
}
