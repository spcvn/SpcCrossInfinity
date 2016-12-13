<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Company_model class.
 * 
 * @extends CI_Model
 */
class Support_model extends CI_Model
{
	
	function __construct() {
		$this->load->database();
	}
	private $support = "t_support";

	public function get_support_active($cid){
		$this->db->select("*")->from($this->support);
		$this->db->where(
			array(
				'cid'=>$cid,
				'delete_flg'=>0,
				'active_flag'=>1,
			));
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		}
		else{
			return false;
		}
	}

	public function get_support_first($cid,$current){
		$this->db->where('cid', $cid);
		$this->db->where("reward_from_data >= ", $current);
		$this->db->order_by("reward_from_data", "asc");
		$this->db->from($this->support);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->first_row('array');
		}
		else{
			return false;
		}
	}

	public function get_support_infor_active($cid){
		$this->db->select("*")->from($this->support);
		$this->db->where(
			array(
				'cid'=>$cid,
				'delete_flg'=>0,
				'active_flag'=>1,
			));
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		}
		else{
			return false;
		}
	}

	public function get_support_infor_latest($cid){
		$this->db->select("*")->from($this->support);
		$this->db->where(
			array(
				'cid'=>$cid,
				'delete_flg'=>0
			));
		$this->db->order_by("company_reward_id", "desc");
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		}
		else{
			return false;
		}
	}

	public function get_support_second($cid,$company_reward_id_first){
		$this->db->select("*")->from($this->support);
		$this->db->where(
			array(
				'cid'=>$cid,
				'delete_flg'=>0,
				'company_reward_id !=' =>$company_reward_id_first
			));
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		}
		else{
			return false;
		}
	}

	public function update_support_infor($data,$cid,$company_reward_id){
		$this->db->where(array('cid'=>$cid,'company_reward_id'=>$company_reward_id));
		$this->db->update($this->support, $data);
		return TRUE;
	}
	public function update_to_null($data,$cid,$company_reward_id){
		$this->db->where(array('cid'=>$cid,'company_reward_id'=>$company_reward_id));
		$this->db->update($this->support, array('reward_to_data'=>$data));
		return TRUE;
	}


	public function insert_support_infor($data){
		$this->db->insert($this->support,$data);
		return TRUE;
	}
	public function count_support($cid){
		$this->db->where('cid', $cid);
		$this->db->where('active_flag', 1);
		$this->db->from($this->support);
		return $this->db->count_all_results();
	}

	public function check_any_from($cid){
		$this->db->where('cid', $cid);		
		$this->db->where("reward_from_data >= ", date('Y-m-d'));
		$this->db->from($this->support);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return 1;
		}
		else{
			return 0;
		}
	}

	public function support_next($cid,$reward_from){
		$this->db->where('cid', $cid);		
		$this->db->where("reward_from_data >= ", date('Y-m-d'));
		$this->db->where("reward_from_data > ", $reward_from);
		$this->db->order_by("reward_from_data", "asc");
		$this->db->from($this->support);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->first_row('array');
		}
		else{
			return false;
		}
	}

	/**
	* Check support active flag in current company
	**/
	public function check_support_company_active($cid){
		$this->db->select('*')->from('t_support');
		$this->db->where(array(
			'cid'=>$cid,
			'active_flag'=>1,
			'delete_flg '=>0
			));
		$query = $this->db->get();
		return ($query->num_rows() > 0) ? true : false;
	}

	/**
	*Get list support company 
	**/
	public function get_support_company($limit, $start){
		$this->db->select("t_company.name as company, m_category.category_name as category,t_support.company_reward_id as company_reward_id");
		$this->db->from("t_support");
		$this->db->join("t_company","t_company.cid = t_support.cid");
		$this->db->join("m_category","m_category.category_id = t_company.category_id");
		$this->db->limit($limit, $start);
		$this->db->where(" t_support.delete_flg",0);
		$this->db->where(" t_support.active_flag",1);
		$this->db->where(" t_company.delete_flg",0);
		$query = $this->db->get();
		// print_r($query);exit();
		return $query->num_rows() > 0 ? $query->result_object() : false;
	}

	/**
	* Get detail support company
	**/
	public function get_detail_support($company_reward_id){
		$this->db->select('t_company.cid, t_company.name as company,address,post_code,m_category.category_name as category,
							reward_from_data,reward_to_data,reward_from_time,reward_to_time,
							applied_lowest_price,reward_content,outside_url,public_relations,
							representative,rep_tel,discount_rate,discount_price,reward_group,reward_point_rate,reward_point');
		$this->db->from("t_support");
		$this->db->join("t_company","t_company.cid = t_support.cid");
		$this->db->join("m_category","m_category.category_id = t_company.category_id");
		$this->db->where(array(
			'company_reward_id'=>$company_reward_id,
			't_support.delete_flg'=>0,
			'active_flag'=>1
		));
		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->row_object() : false;
	}

	/**
	* Search company category
	**/
	public function get_search_category($category,$limit, $start){
		$this->db->select("t_company.name as company, m_category.category_name as category,t_support.company_reward_id as company_reward_id");
		$this->db->from("t_support");
		$this->db->join("t_company","t_company.cid = t_support.cid");
		$this->db->join("m_category","m_category.category_id = t_company.category_id");
		$this->db->limit($limit, $start);
		$this->db->where('m_category.category_id',$category);
		$this->db->where(" t_support.delete_flg",0);
		$this->db->where(" t_support.active_flag",1);
		$this->db->where(" t_company.delete_flg",0);
		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->result_object() : false;
	}

	/**
	* Search company address
	**/
	public function get_search_address($address,$limit, $start){
		$this->db->select("t_company.name as company, m_category.category_name as category,t_support.company_reward_id as company_reward_id");
		$this->db->from("t_support");
		$this->db->join("t_company","t_company.cid = t_support.cid");
		$this->db->join("m_category","m_category.category_id = t_company.category_id");
		// $this->db->like('t_company.address',$address);
		$this->db->where('t_company.address LIKE BINARY "%'.$address.'%"');
		$this->db->limit($limit, $start);
		$this->db->where(" t_support.delete_flg",0);
		$this->db->where(" t_support.active_flag",1);
		$this->db->where(" t_company.delete_flg",0);
		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->result_object() : false;
	}

	/**
	* Search company station
	**/
	public function get_search_station($station,$limit, $start){
		$this->db->select("t_company.name as company, m_category.category_name as category,t_support.company_reward_id as company_reward_id");
		$this->db->from("t_support");
		$this->db->join("t_company","t_company.cid = t_support.cid");
		$this->db->join("m_category","m_category.category_id = t_company.category_id");
		// $this->db->like('t_company.station',$station);
		$this->db->where('t_company.station LIKE BINARY "%'.$station.'%"');
		$this->db->limit($limit, $start);
		$this->db->where(" t_support.delete_flg",0);
		$this->db->where(" t_support.active_flag",1);
		$this->db->where(" t_company.delete_flg",0);
		$query = $this->db->get();
		// $query = $this->db->get_compiled_select();
		// print_r($query);exit();
		return $query->num_rows() > 0 ? $query->result_object() : false;
	}

	/**
	* Search company name
	**/
	public function get_search_company($company,$limit, $start){
		$this->db->select("t_company.name as company, m_category.category_name as category,t_support.company_reward_id as company_reward_id");
		$this->db->from("t_support");
		$this->db->join("t_company","t_company.cid = t_support.cid");
		$this->db->join("m_category","m_category.category_id = t_company.category_id");
		// $this->db->like('t_company.name',$company);
		$this->db->where('t_company.name LIKE BINARY "%'.$company.'%"');
		$this->db->limit($limit, $start);
		$this->db->where(" t_support.delete_flg",0);
		$this->db->where(" t_support.active_flag",1);
		$this->db->where(" t_company.delete_flg",0);
		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->result_object() : false;
	}

	/**
	* Search company reward point
	**/
	public function get_search_reward_point($reward_point,$limit, $start,$reward = 'pt'){
		$this->db->select("t_company.name as company, m_category.category_name as category,t_support.company_reward_id as company_reward_id");
		$this->db->from("t_support");
		$this->db->join("t_company","t_company.cid = t_support.cid");
		$this->db->join("m_category","m_category.category_id = t_company.category_id");
		$this->db->limit($limit, $start);
		if($reward == 'rate'){
			$this->db->where('t_support.reward_point_rate >=',($reward_point*2));//result display in UC-17 ->t_support.reward_point 50%	
		}
		else{
			$this->db->where('t_support.reward_point >=',($reward_point*2));//result display in UC-17 ->t_support.reward_point 50%
		}
		
		$this->db->where(" t_support.delete_flg",0);
		$this->db->where(" t_support.active_flag",1);
		$this->db->where(" t_company.delete_flg",0);
		// var_dump($this->db->get_compiled_select());exit();
		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->result_object() : false;
	}
}
?>