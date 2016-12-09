<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Model user
*/
class User_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// private $user = "t_user";
	//remove value null in array
	public function remove_value_null($array){
		foreach ($array as $key => $value) {
			$check_number =  preg_match('/^\d+$/', $value);
			if($value == NULL && $check_number == false){
				unset($array[$key]);
			}
		}
		return $array;
	}

	//create new user
	public function create($data){
		// $data = $this->remove_value_null($data);
		$query = $this->db->insert("t_user",$data);
		if($query){
			return $this->db->insert_id();
		}
		else{
			return false;
		}
	}

	//update user
	public function update_user($data,$uid){
		if(isset($data['company_tel']) || isset($data['introduce_uid'])){
			$array_special = array('company_tel'=>$data['company_tel'],'introduce_uid'=>$data['introduce_uid']);

			$data = $this->remove_value_null(array_diff_key($data, $array_special ));
			$data = $data + $array_special;
		}
		$this->db->where(
			array(
				'uid'=>$uid,
				'delete_flg'=>0
			));
		$this->db->update("t_user",$data);
		return true;
	}

	//get user 
	public function get_user($uid){
		$this->db->select("*")->from("t_user");
		$this->db->where(
			array(
				'uid'=>$uid,
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

	//get user to uid_name
	public function get_user_by_uid_name($uid_name){
		$this->db->select("*")->from("t_user");
		$this->db->where(
			array(
				'uid_name'=>$uid_name,
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

	//check user by email
	public function check_user_by_mail($mail){
		$this->db->select("*")->from("t_user");
		$this->db->where(
			array(
				'mail'=>$mail,
				'delete_flg'=>0
			));
		if($this->session->userdata('is_member') == TRUE && $this->session->userdata('type') == 'user'){
			$this->db->where('uid !=',$this->session->userdata('id'));
		}
		$query = $this->db->get();
		return $query->num_rows() > 0 ? true : false;
	}

	//check company by email
	public function check_company_by_mail($mail){
		$this->db->select("*")->from("t_company");
		$this->db->where(
			array(
				'mail'=>$mail,
				'delete_flg'=>0
			));
		if($this->session->userdata('id') && $this->session->userdata('type') == 'company'){
			$this->db->where('cid !=',$this->session->userdata('id'));
		}
		$query = $this->db->get();
		return $query->num_rows() > 0 ? true : false;
	}

	//get list company in payment
	public function get_company_payment($uid,$limit, $start){
		$this->db->select('t_company.name as name,introduce_point_company1,
							t_purchase.buy_time as buy_time,t_payment.point_add as point_add');
		$this->db->from('t_purchase');
		$this->db->limit($limit, $start);
		//0 $this->db->where('t_purchase.introduce_uid',$uid);
		//1 $this->db->where('t_payment.uid',$uid);
		$this->db->where('t_company.introduce_uid',$uid);
		$this->db->join('t_payment','t_payment.buy_id = t_purchase.buy_id');
		$this->db->join('t_company','t_payment.cid = t_company.cid');
		$this->db->group_by('t_purchase.buy_id');
		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->result_object() : false;
	}	

	//get count introduce_point_user in t_payment
	public function get_introduce_point_user($uid){
		$this->db->select('SUM(introduce_point_user1) as introduce_point_user1,SUM(introduce_point_user2) as introduce_point_user2 ');
		$this->db->from('t_payment');
		$this->db->where('t_payment.uid',$uid);
		$this->db->where('t_payment.point_add',1);
		$query = $this->db->get();
		// print_r($this->db->get_compiled_select());exit();
		return $query->num_rows() > 0 ? $query->row_object() : false;
	}

	//get country_abbreviation in m_country
	public function get_country_abbreviation($country_abbreviation) {
		$this->db->select('country_abbreviation');
		$this->db->from('m_country');
		$this->db->where('country_abbreviation', $country_abbreviation);
		return $this->db->get()->row();
	}

	//get list category 
	public function get_category(){
		$this->db->select('category_name,category_id')->from('m_category');
		$this->db->where('delete_flg',0);
		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->result_object() : false;
	}

	//get id category
	public function get_category_id($id){
		$this->db->select('category_name,category_id')->from('m_category');
		$this->db->where('delete_flg',0);
		$this->db->where('category_id',$id);
		$query = $this->db->get();
		return $query->num_rows() > 0 ? $query->row_object() : false;	
	}

	//function check date NULL and exist
	public function check_date($datatime){
		if(date('Y/m/d', strtotime($datatime)) == '-0001/11/30' or 
			date('Y/m/d', strtotime($datatime)) == '1970/01/01')
			return false;
		return true;
	}
	
	public function make_remember_token($uid, $remember_token){
		$data = array(
			'remember_token' => $remember_token
		);
		$this->db->where('uid', $uid);
		$this->db->update('t_user', $data);
		return $remember_token;
	}

	public function check_remember_token($token){
		$this->db->select('remember_token');
        $this->db->from('t_user');
        $this->db->where('remember_token', $token);
        $remember_token = $this->db->get()->row('remember_token');
        if(!empty($remember_token)){
        	return true;
        }

        return false;
	}

	public function get_user_by_remember_token($token){
		$this->db->select('*');
        $this->db->from('t_user');
        $this->db->where('remember_token', $token);
        return $this->db->get()->row();
	}

	public function delete_remember_token($uid){
		$data = array(
			'remember_token' => null
		);
		$this->db->where('uid', $uid);
		$this->db->update('t_user', $data);
		return true;
	}

	public function delete_reset_token($email){
		$data = array(
			'reset_password_token' => null
		);
		$this->db->where('mail', $email);
		$this->db->update('t_user', $data);
		return true;
	}

	public function make_reset_token($email, $reset_token){
		$data = array(
			'reset_password_token' => $reset_token
		);
		$this->db->where('mail', $email);
		$this->db->update('t_user', $data);
		return true;
	}
}
?>