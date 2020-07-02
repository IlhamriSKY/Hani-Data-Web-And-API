<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('hani_model');
    }

    
    public function index()
    {
        if ($this->session->userdata('role') == 'admin' || check_power(2)) {
            $data = array();
            $data['page_title'] = 'Dashboard';
            $data['count'] = $this->hani_model->get_loker_total();
            // $data['users'] = $this->hani_model->get_command_high_low();

            $dayQuery = $this->db->query("SELECT month, SUM(id) as idea_funding, SUM(loker) as info_loker

            FROM
            (
                SELECT MONTH(t.create_date) AS monthnum, MONTHNAME(t.create_date) AS Month, 1 AS id, 0 AS loker
                FROM idea_funding t
                WHERE YEAR(t.create_date) = YEAR(CURRENT_TIMESTAMP) 
                AND MONTH(t.create_date) < 12 
            
                UNION ALL
            
                SELECT MONTH(t.create_date) AS monthnum, MONTHNAME(t.create_date) AS Month, 0 AS id, 1 AS loker
                FROM info_loker t
                WHERE YEAR(t.create_date) = YEAR(CURRENT_TIMESTAMP) 
                AND MONTH(t.create_date) < 12
            ) q
            GROUP BY monthnum, month
            ORDER BY MONTH(STR_TO_DATE(month, '%M'))");
            
            $record = $dayQuery->result();
            $data['day_wise'] = json_encode($record);

            $data['main_content'] = $this->load->view('admin/home', $data, true);
            $this->load->view('admin/index', $data);
        }
        else{
            redirect(base_url('admin/hani/sambutan/'));
        }
    }

    /**
     * backup database
     *
     * @param string $fileName nama file tidak dengan extension
     * @return void
     */
    public function backup($fileName='db_backup_')
    {
        $extension = ".zip";
        $fileName .= date("d_m_Y").$extension;
        $this->load->dbutil();
        $backup =& $this->dbutil->backup();
        $this->load->helper('file');
        write_file(FCPATH.'/downloads/'.$fileName, $backup);
        $this->load->helper('download');
        force_download($fileName, $backup);
    }
}
