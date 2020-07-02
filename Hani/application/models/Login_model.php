<?php
class Login_model extends CI_Model {

    public function edit_option_md5($action, $id, $table){
        $this->db->where('md5(id)',$id);
        $this->db->update($table,$action);
        return;
    }

    //-- check post email
    public function check_email($email){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }


    // check valid user by id
    public function validate_id($id){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('md5(id)', $id); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query -> num_rows() == 1){                 
            return $query->result();
        }
        else{
            return false;
        }
    }



    //-- check valid user
    function validate_user(){            
        
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $this->input->post('user_name')); 
		// $this->db->where('password', md5($this->input->post('password')));
		$sampleDate = $this->input->post('password');
		$convertDate = date("Y-m-d", strtotime($sampleDate));
		// $this->db->where('tanggal_lahir', ($convertDate));

		$where = '(tanggal_lahir="'.$convertDate.'" or password = "'.md5($this->input->post('password')).'")';
		$this->db->where($where);

        $this->db->limit(1);
		$query = $this->db->get();

		// Login Api
		//$url = 'https://haniapi.mooo.com/login/'.$this->input->post('user_name').'/'.$sampleDate; // path to your JSON file
		//$data = file_get_contents($url); // put the contents of the file into a variable
		//$characters = json_decode($data); // decode the JSON feed
		//$status = $characters->status;
        
        if($query->num_rows() == 1){                 
		   return $query->result();
		}
        else{
            return false;
        }
    }



}
