<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cross_infinty_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_cross_infinty($type="user"){
    	$this->db->select('*');
    	$this->db->from('m_crossinfinity');
        $this->db->where('ci_id <',17);
        if($type == "user"){
            $this->db->where_not_in('ci_id',array(12,13,14,15,16));
        }else{
            $this->db->where_not_in('ci_id',array(11,12,13,14,15));
        }

    	$this->db->where('delete_flg',0);
    	$query = $this->db->get();
    	return $query->num_rows() > 0 ? $query->result_object() : false;
    }

    //get m_CrossInfinity.information_name="年会費" 
    public function get_information_name($ci_id = 7){
        $this->db->select('information_content');
        $this->db->from('m_crossinfinity');
        $this->db->where('ci_id',$ci_id);
        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->row_object() : false;
    }
}