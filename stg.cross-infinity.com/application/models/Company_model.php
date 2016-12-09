<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Company_model class.
 * 
 * @extends CI_Model
 */
class Company_model extends CI_Model
{
	
	function __construct() {
		$this->load->database();
	}

	/**
	 * Get prefecture name by id
	 * @param prefecture_id Id of prefecture
	 * @return Prefecture name
	 **/
	public function get_prefecture_name_by_id($prefecture_id) {
		$this->db->select('prefecture_name');
        $this->db->from('m_prefecture');
        $this->db->where('prefecture_id', $prefecture_id);
        return $this->db->get()->row('prefecture_name');
	}

	public function check_password_reward($cid){
		$this->db->select('password_reward');
        $this->db->from('t_company');
        $this->db->where('cid', $cid);
        return $this->db->get()->row('password_reward');
	}

	public function check_password_login($cid){
		$this->db->select('password_login');
        $this->db->from('t_company');
        $this->db->where('cid', $cid);
        return $this->db->get()->row('password_login');
	}

	/**
	 * Get introducer name by id
	 * @param introduce_uid Id of introducer
	 * @return Introducer name
	 **/
	public function get_introduce_name_by_id($introduce_uid) {
		$this->db->select('name');
		$this->db->from('t_user');
		$this->db->where('uid', $introduce_uid);
		return $this->db->get()->row('name');
	}

	/**
	 * Get category name by id
	 * @param category_id Id of category
	 * @return Category name
	 **/
	public function get_categoryname_by_id($category_id) {
		$this->db->select('category_name');
		$this->db->from('m_category');
		$this->db->where('category_id', $category_id);
		$this->db->where('delete_flg',0);
		return $this->db->get()->row('category_name');
	}


	// Create company data
	public function create($data){
		$query = $this->db->insert('t_company',$data);
		if($query){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * Regist company account
	 * @param data_company Data of company table
	 **/
	public function regist_company_account($data_company) {
		$this->db->insert('t_company', $data_company);
		$cid = $this->db->insert_id();

		// Update create_user
		$this->db->where('cid', $cid);
		$this->db->update('t_company', array('create_user' => $cid));
		return $cid;
	}

	/**
	 * Regist company account
	 * @param data_support Data of support table
	 **/
	public function regist_support_company_account($data_support) {
		$this->db->insert('t_support', $data_support);
	}

	/**
	 * Update update user company table and support table
	 * @param cid Id of company latest insert
	 * @param cid_name Id name of company latest insert
	 **/
	public function update_update_user($cid, $cid_name) {
		$data = array(
			'update_user' => $cid
		);

		$data_company = array(
			'update_user' => $cid,
			'cid_name' => $cid_name
		);

		$this->db->where('cid', $cid);
		$this->db->update('t_company', $data_company);

		$this->db->where('cid', $cid);
		$this->db->update('t_support', $data);
	}

	/**
	 * Get company information to display complete screen and insert company id name
	 * @param cid Id of company latest insert
	 **/
	public function get_company_info($cid) {
		$this->db->select('mail, country_id, bank_name, bank_branch_number, bank_type, bank_number, bank_holder, representative');
		$this->db->from('t_company');
		$this->db->where('cid', $cid);
		return $this->db->get()->row();
	}

	public function make_remember_token($cid, $remember_token){
		$data = array(
			'remember_token' => $remember_token
		);
		$this->db->where('cid', $cid);
		$this->db->update('t_company', $data);
		return $remember_token;
	}

	public function check_remember_token($token){
		$this->db->select('remember_token');
        $this->db->from('t_company');
        $this->db->where('remember_token', $token);
        $remember_token = $this->db->get()->row('remember_token');
        if(!empty($remember_token)){
        	return true;
        }

        return false;
	}

	public function get_company_by_remember_token($token){
		$this->db->select('*');
        $this->db->from('t_company');
        $this->db->where('remember_token', $token);
        return $this->db->get()->row();
	}

	public function delete_remember_token($cid){
		$data = array(
			'remember_token' => null
		);
		$this->db->where('cid', $cid);
		$this->db->update('t_company', $data);
		return true;
	}


	public function delete_reset_token($email){
		$data = array(
			'reset_password_token' => null
		);
		$this->db->where('mail', $email);
		$this->db->update('t_company', $data);
		return true;
	}

	public function make_reset_token($email, $reset_token){
		$data = array(
			'reset_password_token' => $reset_token
		);
		$this->db->where('mail', $email);
		$this->db->update('t_company', $data);
		return true;
	}

	/**
	 * Get country abbreviation to create country id name
	 * @param country_id Id of country (JP = 1)
	 **/
	public function get_country_abbreviation($country_id) {
		$this->db->select('country_abbreviation');
		$this->db->from('m_country');
		$this->db->where('country_id', $country_id);
		return $this->db->get()->row();
	}

	/**
	 * Get information to display complete regist acount screen
	 **/
	public function get_crossinfinity() {
		$ci_id = array('2', '3', '4', '5', '6', '7', '8');
		$this->db->select('ci_id, information_name, information_content');
		$this->db->from('m_crossinfinity');
		$this->db->where_in('ci_id', $ci_id);
		$this->db->where('delete_flg',0);
		return $this->db->get()->result();
	}

	/**
	 * Get information to display at detail screen and update company informatin screen
	 **/
	public function get_company_information($cid) {
		$current_date =  date("Y/m/d");
		$current_time =  date("H:i");
		$query = "SELECT *, t_support.delete_flg AS delete_flg_support FROM t_company
				LEFT JOIN t_support ON t_company.cid = t_support.cid
					AND t_support.cid = $cid
					AND (t_support.active_flag = 1
						 OR (t_support.active_flag = 0 AND t_support.reward_from_data >= '$current_date')
						)
				LEFT JOIN m_category ON t_company.category_id = m_category.category_id
				LEFT JOIN m_prefecture ON t_company.prefecture_id = m_prefecture.prefecture_id
				WHERE t_company.delete_flg = 0 AND t_company.cid = $cid
				ORDER BY t_support.active_flag DESC, t_support.reward_from_data ASC, t_support.reward_from_time ASC
				";
		$result = $this->db->query($query);
		return $result->row();
	}

	/**
	 * Update company information at update company informatin screen UC-11
	 **/
	public function update_company_info($data_update, $cid) {
		$this->db->where('cid', $cid);
		$this->db->update('t_company', $data_update);
	}

	public function update_email($data_update, $cid) {
		$this->db->where('cid', $cid);
		$this->db->update('t_company', $data_update);
	}

	public function update_password_login($data_update, $cid) {
		$this->db->where('cid', $cid);
		$this->db->update('t_company', $data_update);
	}
	
	public function update_password_reward($data_update, $cid) {
		$this->db->where('cid', $cid);
		$this->db->update('t_company', $data_update);
	}

	/**
	 * Check exist introduce_uid
	 **/
	public function check_exist_introduce_uid($introduce_uid) {
		$this->db->select('*');
		$this->db->from('t_user');
		$this->db->where('uid_name', $introduce_uid);
		$this->db->where('delete_flg', 0);
		$query = $this->db->get();
		return $query->num_rows() > 0 ? TRUE : FALSE; 
	}

	/**
	 * Get uid by uid name
	 **/
	public function get_uid_by_uid_name($introduce_uid_name) {
		$this->db->select('uid');
		$this->db->from('t_user');
		$this->db->where('uid_name', $introduce_uid_name);
		return $this->db->get()->row('uid');
	}

	/**
	 * Get uid name by uid
	 **/
	public function get_uid_name_by_uid($introduce_uid) {
		$this->db->select('uid_name');
		$this->db->from('t_user');
		$this->db->where('uid', $introduce_uid);
		return $this->db->get()->row('uid_name');
	}

	/**
	 * Check exist email when regist
	 **/
	public function check_exist_email($email) {
		$this->db->select('mail');
		$this->db->from('t_company');
		$this->db->where('mail', $email);
		$this->db->where('delete_flg', 0);
		$num_mail_company = $this->db->get()->num_rows();

		$this->db->select('mail');
		$this->db->from('t_user');
		$this->db->where('mail', $email);
		$this->db->where('delete_flg', 0);
		$num_mail_user = $this->db->get()->num_rows();

		$num_mail = $num_mail_company + $num_mail_user;
		return $num_mail > 0 ? TRUE : FALSE;
	}

	/**
	 * Get email company
	 **/
	public function get_email_company($cid) {
		$this->db->select('mail');
		$this->db->from('t_company');
		$this->db->where('cid', $cid);
		$this->db->where('delete_flg', 0);
		return $this->db->get()->row('mail');
	}

	/**
	 * Get email user
	 **/
	public function get_email_user($uid) {
		$this->db->select('mail');
		$this->db->from('t_user');
		$this->db->where('uid', $uid);
		$this->db->where('delete_flg', 0);
		return $this->db->get()->row('mail');
	}
	/**
	 * Get password point by uid name
	 **/
	public function get_password_point_by_uid_name($uid_name) {
		$this->db->select('password_point');
		$this->db->from('t_user');
		$this->db->where('uid_name', $uid_name);
		$this->db->where('delete_flg', 0);
		return $this->db->get()->row('password_point');
	}

	/**
	 * Check exist user (UC-05)
	 **/
	public function check_exist_user($introduce_uid_name) {
		$this->db->select('uid');
		$this->db->from('t_user');
		$this->db->where('uid_name', $introduce_uid_name);
		$this->db->where('delete_flg', 0);
		$num_user = $this->db->get()->num_rows();
		return $num_user > 0 ? TRUE : FALSE;
	}

	/**
	 * Regist support service (UC-05)
	 **/
	public function regist_support_service($data_regist) {
		$this->db->insert('t_purchase', $data_regist);
		$buy_id = $this->db->insert_id();
		return $buy_id;
	}

	/**
	 * Get purchase insert lastest (UC-05)
	 **/
	public function get_purchase_by_buy_id($buy_id) {
		$this->db->select('introduce_uid, buy_price, point_use');
		$this->db->from('t_purchase');
		$this->db->where('buy_id', $buy_id);
		$result = $this->db->get();
		return $result->row();
	}

	/**
	 * Update introduction_count when regist support service  (UC-05)
	 **/
	public function update_introduction_count($cid) {
		$this->db->set('introduction_count', 'introduction_count + 1', FALSE);
		$this->db->where('cid', $cid);
		$this->db->update('t_company');
	}

	/**
	 * Get company_reward_id by cid (UC-05)
	 * @param $cid Company Id
	 * @return company_reward_id OR 0
	 **/
	public function get_support_id_by_cid($cid) {
		$this->db->select('company_reward_id');
		$this->db->from('t_support');
		$this->db->where('delete_flg', 0);
		$this->db->where('active_flag', 1);
		$this->db->where('cid', $cid);
		$result = $this->db->get();
		return $result->num_rows() > 0 ? $result->row('company_reward_id') : 0;
	}

	/**
	 * Get point user by uid_name (UC-05)
	 * @param $uid_name Uid Name
	 * @return point user OR FALSE
	 **/
	public function get_point_user($uid_name) {
		$this->db->select('point');
		$this->db->from('t_user');
		$this->db->where('delete_flg', 0);
		$this->db->where('uid_name', $uid_name);
		$result = $this->db->get();
		return $result->num_rows() > 0 ? $result->row('point') : FALSE;
	}

	/**
	 * Update user point (UC-06)
	 * @param $point_use Point use
	 * @param $uid_name Uid name
	 **/
	public function update_user_point($point_use, $uid_name) {
		$this->db->set('point', "point - $point_use", FALSE);
		$this->db->where('uid_name', $uid_name);
		$this->db->update('t_user');
	}

	/**
	 * Get prefecture by id
	 * @param $prefecture_id Prefecture Id
	 * @return Prefecture name
	 **/
	public function get_prefecture_by_id($prefecture_id) {
		$this->db->select('prefecture_name');
		$this->db->from('m_prefecture');
		$this->db->where('delete_flg', 0);
		$this->db->where('prefecture_id', $prefecture_id);
		$result = $this->db->get();
		return $result->num_rows() > 0 ? $result->row('prefecture_name') : FALSE;
	}

	/**
	 * Get password reward of company
	 * @param $cid Company Id
	 * @return Password reward
	 **/
	public function get_password_reward_by_id($cid) {
		$this->db->select('password_reward');
		$this->db->from('t_company');
		$this->db->where('cid', $cid);
		$result = $this->db->get();
		return $result->row('password_reward');
	}

	/**
	 * Get applied lowest price
	 * @param $cid Company Id
	 * @return Applied lowest price
	 **/
	public function get_applied_lowest_price_by_cid($cid) {
		$query = "SELECT applied_lowest_price FROM t_support
				INNER JOIN t_company ON t_support.cid = t_company.cid
				WHERE t_company.delete_flg = 0 AND t_support.delete_flg = 0 AND t_support.active_flag = 1 AND t_support.cid = $cid
			";
		$result = $this->db->query($query);
		return empty($result) ? FALSE : $result->row('applied_lowest_price');
	}
}