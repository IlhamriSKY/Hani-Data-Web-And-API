<?php
class Hani_model extends CI_Model {

    //-- insert function
	public function insert($data,$table){
		$this->db->insert($table,$data);      
        return $this->db->insert_id();
    }

    //-- edit function
    function edit_option($action, $no, $table){
        $this->db->where('no',$no);
        $this->db->update($table,$action);
        return;
    } 

    //-- update function
    function update($action, $no, $table){
        $this->db->where('no',$no);
        $this->db->update($table,$action);
        return;
    } 

    //-- delete function
    function delete($no,$table){
        $this->db->delete($table, array('no' => $no));
        return;
    }

    //-- select function
    function select($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- select by id
    function select_option($id,$table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    } 

	//-- INFO LOKER
    //-- get single Loker info
    function get_single_loker_info($no){
        $this->db->select('loker.*');
        $this->db->from('info_loker loker');
        $this->db->where('loker.no',$no);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    //-- get all Lokers
    function get_all_lokers(){
        $this->db->select('loker.*');
        $this->db->from('info_loker loker');
        $this->db->order_by('loker.no','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- get Accept or Not lokers
    function get_all_loker_bystatus($status){
        $this->db->select('loker.*');
        $this->db->from('info_loker loker');
        $this->db->where('status',$status);
        $this->db->order_by('loker.no','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
	}

	//-- IDEA FOUNDING
	//-- get single Loker info
	function get_single_idea_funding($no){
		$this->db->select('idea.*');
		$this->db->from('idea_funding idea');
		$this->db->where('idea.no',$no);
		$query = $this->db->get();
		$query = $query->row();  
		return $query;
	}

	//-- get all Ideas
	function get_all_ideas(){
		$this->db->select('idea.*');
		$this->db->from('idea_funding idea');
		$this->db->order_by('idea.no','DESC');
		$query = $this->db->get();
		$query = $query->result_array();  
		return $query;
	}

    //-- get Accept or Not Idea Funding
    function get_all_idea_bystatus($status){
        $this->db->select('idea.*');
        $this->db->from('idea_funding idea');
        $this->db->where('status',$status);
        $this->db->order_by('idea.no','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
	}

    //-- get all Lokers
    function get_all_kontaks(){
        $this->db->select('loker.*');
        $this->db->from('kontak loker');
        $this->db->order_by('loker.no','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- Count Info Loker
    function get_loker_total(){
        $this->db->select('*');
        $this->db->select('count(*) as total');
        // LOKER
        $this->db->select('(SELECT count(info_loker.no)
                            FROM info_loker 
                            ) AS total_loker',TRUE);
        // LOKER ACCEPT
        $this->db->select('(SELECT count(info_loker.no)
                            FROM info_loker
                            WHERE (info_loker.status = "accept")
                            ) AS total_loker_accept',TRUE);
        // LOKER PENDING
        $this->db->select('(SELECT count(info_loker.no)
                            FROM info_loker
                            WHERE (info_loker.status = "pending")
							) AS total_loker_pending',TRUE);
							
		// IDEA
        $this->db->select('(SELECT count(idea_funding.no)
                            FROM idea_funding 
							) AS total_idea_funding',TRUE);
							
		// KONTAK / PESAN
        $this->db->select('(SELECT count(kontak.no)
                            FROM kontak 
							) AS total_kontak',TRUE);
							
		// USER
        $this->db->select('(SELECT count(user.id)
							FROM user
							) AS total_user',TRUE);
                            
        $this->db->from('user');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
	}
}
