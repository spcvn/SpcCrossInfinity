<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Model prefecture
*/
class Prefecture_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	private $prefecture = "m_prefecture";

	//get prefecture
	public function get_prefecture(){
		$this->db->select("*")->from($this->prefecture);
		$this->db->where('delete_flg',0);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_object();
		}
		else{
			return false;
		}
	}

	//get item prefecture
	public function get_item_prefecture($pid){
		$this->db->select("*")->from($this->prefecture);
		$this->db->where(
			array(
				'prefecture_id'=>$pid,
				'delete_flg'=>0
			));
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		}
		else{
			return false;
		}
	}
}
?>