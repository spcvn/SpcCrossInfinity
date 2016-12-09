<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Model prefecture
*/
class Batch_model extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
		$this->today = date('Y-m-d 00:00:00');
		$this->tomorrow =  date('Y-m-d 00:00:00',strtotime("+1 days"));
		$this->yesterday = date('Y-m-d 00:00:00',strtotime("-1 days"));
	}

	private $today;
	private $tomorrow;
	private $yesterday;

	/////////////////////////////
	//       DAILY BATCH       //
	/////////////////////////////

	/*
	-------(1) FOR SUPPORT-------
	*/

	public function active_support($company_reward_id){
		$data = array(
               'active_flag' => 1,
               'update_date' => date('Y-m-d H:i:s'),
               'update_user' => 0
            );
		$this->db->where('company_reward_id', $company_reward_id);
		$this->db->update('t_support', $data); 

		return TRUE;
	}

	public function deactivate_support($company_reward_id){
		$data = array(
               'active_flag' => 0,
               'update_date' => date('Y-m-d H:i:s'),
               'update_user' => 0
            );
		$this->db->where('company_reward_id', $company_reward_id);
		$this->db->update('t_support', $data); 

		return TRUE;
	}

	public function get_all_not_active_support_today(){
		$this->db->select('t_company.cid as cid,t_support.company_reward_id as company_reward_id, t_support.cid as support_cid');
		$this->db->from('t_company');
		$this->db->join('t_support', 't_support.cid = t_company.cid');

		$this->db->where('t_support.reward_from_data >=',$this->today);
		$this->db->where('t_support.reward_from_data <',$this->tomorrow);
		$this->db->where('t_support.active_flag',0);
		$this->db->where('t_support.delete_flg',0);
		$this->db->where('t_company.delete_flg',0);

		return $this->db->get()->result_object();
	}

	public function get_all_active_support_end_today(){
		$this->db->select('*');
		$this->db->from('t_support');
		$this->db->where('active_flag',1);
		$this->db->where('delete_flg',0);
		$this->db->where('reward_to_data >=',$this->yesterday);
		$this->db->where('reward_to_data <',$this->today);
		//$this->db->where_in('cid',$this->get_available_company_ids);
		return $this->db->get()->result_object();
	}

	public function get_available_company_ids(){
		$this->db->select('cid');
		$this->db->from('t_company');
		$this->db->where('delete_flg',0);
		return $this->db->get()->result();
	}

	/*
	-------(2)-------
	*/

	/*
	- Get all Purchase in yesterday
	*/
	public function get_all_purchase_yesterday(){
		$this->db->select('buy_id, buy_time, sales_company_id, t_purchase.company_reward_id, t_purchase.introduce_uid, buy_price, t_purchase.point_use,
						   t_purchase.update_date, t_purchase.update_user, t_purchase.create_date, t_purchase.create_user,
						   t_support.reward_point as reward_point, t_support.reward_point_rate as reward_point_rate');
		$this->db->from('t_purchase');
		$this->db->join('t_support', 't_support.company_reward_id = t_purchase.company_reward_id','left');
		$this->db->where('buy_time >=',$this->yesterday);
		$this->db->where('buy_time <',$this->today);
		$this->db->where('t_purchase.delete_flg',0);
		return $this->db->get()->result_object();
	}

	/*
	- Create payment from purchase.
	*/
	public function create_payment_for_yesterday($purchases){
		echo 'Buy ID:';
		foreach ($purchases as $row) {
			if($row->reward_point != 0 or $row->reward_point_rate !=0){
				$this->create_sales_payment($row);
				echo $row->buy_id.' ';
			}elseif($row->reward_point == 0 and $row->reward_point_rate == 0 and $row->buy_price == $row->point_use){
				$this->create_normal_payment($row);
				echo $row->buy_id.' ';
			}

		}
		echo PHP_EOL;

	}

	public function create_normal_payment($purchases){
		$data = array(
			'cid' => $purchases->sales_company_id,
			'uid' => $purchases->introduce_uid,
			'reward_add_time' => $purchases->buy_time,
			'buy_id' => $purchases->buy_id,
			'point_use' => $purchases->point_use,
			'introduce_point_total' => 0,
			'introduce_point_company1' => 0,
			'introduce_point_company2' => 0,
			'introduce_point_user1' => 0,
			'introduce_point_user2' => 0,
			'introduce_point_takeyani' => 0,
			'point_add' => 1,
			'update_date' => date('Y-m-d H:i:s'),
			'update_user' => 0,
			'create_date' => date('Y-m-d H:i:s'),
			'create_user' => 0,
            'delete_flg' => 0,
            );
		$this->db->insert("t_payment",$data);

		return TRUE;
	}

	public function create_sales_payment($purchase){
		$introduce_point_total = $this->proccess_introduce_point_total($purchase->buy_price, $purchase->reward_point, $purchase->reward_point_rate);
		$introduce_point_company = $this->proccess_introduce_point_company($introduce_point_total);
		$introduce_point_user = $this->proccess_introduce_point_user($introduce_point_total);
		$introduce_point_takeyani = $this->proccess_introduce_point_takeyani($introduce_point_total,$introduce_point_company, $introduce_point_user);

		$data = array(
			'cid' => $purchase->sales_company_id,
			'uid' => $purchase->introduce_uid,
			'reward_add_time' => $purchase->buy_time,
			'buy_id' => $purchase->buy_id,
			'point_use' => $purchase->point_use,
			'introduce_point_total' => $introduce_point_total,
			'introduce_point_company1' => $introduce_point_company,
			'introduce_point_company2' => 0,
			'introduce_point_user1' => $introduce_point_user,
			'introduce_point_user2' => 0,
			'introduce_point_takeyani' => $introduce_point_takeyani,
			'point_add' => 0,
			'update_date' => date('Y-m-d H:i:s'),
			'update_user' => 0,
			'create_date' => date('Y-m-d H:i:s'),
			'create_user' => 0,
            'delete_flg' => 0,
            );
		$this->db->insert("t_payment",$data);

		return TRUE;
	}

	/*
		introduce_point_total = reward_point
		or
		introduce_point_total = buy_price * reward_point_rate
	*/
	private function proccess_introduce_point_total($buy_price, $reward_point, $reward_point_rate){
		if(!empty($reward_point) and empty($reward_point_rate)){
			return $reward_point;
		}elseif(empty($reward_point) and !empty($reward_point_rate)){
			$introduce_point = $buy_price * ($reward_point_rate/100);
			return $introduce_point > 0 ? ceil($introduce_point) : 0;
		}

		return ceil($reward_point + $buy_price * ($reward_point_rate/100));

	}

	private function proccess_introduce_point_company($introduce_point_total){
		return ceil($introduce_point_total * ($this->point_company_crossinfinity()/100));
	}

	private function proccess_introduce_point_takeyani($introduce_point_total, $introduce_point_company, $introduce_point_user){
		return $introduce_point_total - $introduce_point_company - $introduce_point_user;
	}

	private function proccess_introduce_point_user($introduce_point_total){
		return ceil($introduce_point_total * ($this->point_user_crossinfinity()/100));
	}

	private function point_company_crossinfinity(){
		// ((m_crossinfinity.information_name = 14)/100)
		$this->db->select('information_content');
        $this->db->from('m_crossinfinity');
        $this->db->where('ci_id',14);
        return $this->db->get()->row('information_content');
	}

	private function point_user_crossinfinity(){
		// ((m_crossinfinity.information_name = 13)/100)
		$this->db->select('information_content');
        $this->db->from('m_crossinfinity');
        $this->db->where('ci_id',13);
        return $this->db->get()->row('information_content');
	}

	private function point_takeyani_crossinfinity(){
		// introduce_point_total * ((m_crossinfinity.information_name = 12)/100)
		$this->db->select('information_content');
        $this->db->from('m_crossinfinity');
        $this->db->where('ci_id',12);
        return $this->db->get()->row('information_content');
	}


	/*
	----------(3)ポイント加算-----------------
	*/

	// public function get_completed_company_demand_ids(){
	// 	$this->db->select('cid');
	// 	$this->db->from('t_demand');
	// 	$this->db->where('payment_date IS NOT NULL', null, false);
	// 	$this->db->where('delete_flg',0);
	// 	return $this->db->get()->result_array();
	// }

	public function get_all_payment_available(){
		// $query =   'select t_payment.*, t_company.introduce_uid as introduce_uid
		// 			from t_payment 
		// 			INNER JOIN t_company on t_company.cid = t_payment.cid
		// 			INNER JOIN t_demand on t_demand.cid = t_payment.cid
		// 			WHERE t_company.delete_flg = 0
		// 			AND t_demand.delete_flg = 0
		// 			AND t_payment.delete_flg = 0
		// 			AND NOT ISNULL(t_demand.payment_date)
		// 			AND t_demand.payment_date = DATE_SUB(CURDATE(), INTERVAL 1 DAY)
		// 			AND t_payment.reward_add_time > DATE_SUB(t_demand.charge_month, INTERVAL 1 MONTH)
		// 			AND t_payment.reward_add_time < DATE_ADD(t_demand.charge_month, INTERVAL 1 MONTH)
		// 		';

		// New query update at 2016-02-02 changed at 2016-02-15
		$query =   "select t_payment.*, t_company.introduce_uid as introduce_uid
					from t_payment 
					INNER JOIN t_company on t_company.cid = t_payment.cid
					INNER JOIN t_demand on t_demand.cid = t_payment.cid
					AND t_demand.delete_flg = 0
					AND t_payment.delete_flg = 0
					AND NOT ISNULL(t_demand.payment_date)
					AND t_demand.payment_date = DATE_SUB(CURDATE(), INTERVAL 1 DAY)
					AND DATE_FORMAT(t_payment.reward_add_time, '%Y%m') = DATE_FORMAT(t_demand.charge_month, '%Y%m')
				";
		$result = $this->db->query($query)->result_object();
		return $result;
	}

	public function update_point_for_user($payment){

		$this->point_for_introducer_company($payment);

		$this->point_for_payment_user($payment);

		$this->point_for_takeyani_user($payment);

		$this->update_payment_status($payment);

	}

	public function point_for_introducer_company($payment){
	/*	
		point = point + introduce_point_company1																				
		update_date is current time																				
		update_user = 0	
	*/	
		$uid = $payment->introduce_uid;
		$point = $this->get_user_by_uid($uid)->point;		

		$data = array(
               'point' => $point + $payment->introduce_point_company1,
               'update_date' => date('Y-m-d H:i:s'),
               'update_user' => 0
            );
		$this->db->where('uid',$uid);
		$this->db->update('t_user', $data); 

		echo "Introduce Company User: ".$uid.' added '.$payment->introduce_point_company1.' => '.$point + $payment->introduce_point_company1.PHP_EOL;
		return TRUE;
		
	}

	public function point_for_payment_user($payment){
	/*
		point = point + introduce_point_user1																				
		update_date is current time																				
		update_user = 0																				
	*/
		$uid = $payment->uid;
		$point = $this->get_user_by_uid($uid)->point;	

		$data = array(
               'point' => $point + $payment->introduce_point_user1,
               'update_date' => date('Y-m-d H:i:s'),
               'update_user' => 0
            );
		$this->db->where('uid',$uid);
		$this->db->update('t_user', $data); 

		echo "Payment User: ".$uid.' added '.$payment->introduce_point_user1.' => '.$point + $payment->introduce_point_user1.PHP_EOL;
		return TRUE;
	}

	public function point_for_takeyani_user($payment){
	/*
		point = point + introduce_point_takeyani																				
		update_date is current time																				
		update_user = 0																				
	*/
		$uid = 0;
		$point = $this->get_user_by_uid($uid)->point;

		$data = array(
               'point' => $point + $payment->introduce_point_takeyani,
               'update_date' => date('Y-m-d H:i:s'),
               'update_user' => 0
            );
		$this->db->where('uid',$uid);
		$this->db->update('t_user', $data); 

		echo "TAKEYANI User: ".$uid.' added '.$payment->introduce_point_takeyani.' => '.$point + $payment->introduce_point_takeyani.PHP_EOL;
		return TRUE;
	}

	public function update_payment_status($payment){
	/*
		point_add = 1																				
		update_date is current time																				
		update_user = 0																				
	*/
		$data = array(
               'point_add' => 1,
               'update_date' => date('Y-m-d H:i:s'),
               'update_user' => 0
            );
		$this->db->where('reward_id',$payment->reward_id);
		$this->db->update('t_payment', $data); 

		echo "Updated Payment: ".$payment->reward_id.PHP_EOL;
		return TRUE;
	}

	public function get_user_by_uid($uid){
		$this->db->select("*")->from("t_user");
		$this->db->where(
			array(
				'uid'=>$uid,
				'delete_flg'=>0
			));
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row();
		}
		else{
			return false;
		}
	}

	/////////////////////////////
	//     MONTHLY BATCH       //
	/////////////////////////////
	
	//(SELECT SUM(t_point.addonly_point) FROM t_point WHERE t_point.uid = t_user.uid) AS addonly_point
	public function get_company_purchase_of_last_month(){
		$query =   'SELECT sales_company_id,SUM(t_purchase.buy_price) as buy_price,SUM(t_payment.introduce_point_total) as introduce_point_total
					FROM t_purchase
					LEFT JOIN t_payment ON t_purchase.buy_id = t_payment.buy_id
					WHERE YEAR(buy_time) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
					AND MONTH(buy_time) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) 
					GROUP BY sales_company_id';
		$result = $this->db->query($query)->result_object();
		return $result;
	}

	public function get_company_not_purchase_of_last_month(){
		$query =   'SELECT sales_company_id
					FROM t_purchase
					WHERE YEAR(buy_time) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
					AND MONTH(buy_time) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) 
					GROUP BY sales_company_id';
		$sales_company_ids = $this->db->query($query)->result_object();

		$company_ids = array();
		foreach ($sales_company_ids as $id) {
			$company_ids[] = $id->sales_company_id;
		}

		$this->db->select('cid');
        $this->db->from('t_company');
        $this->db->where_not_in('cid',$company_ids);
        $this->db->where('delete_flg',0);
        return $this->db->get()->result_object();
	}

	public function create_demand_have_purchase($purchase){
		/*
			--- >0 ---
			cid = sales_company_id
			total_sales = buy_price
			total_reward = introduce_point_total

			charge_month is previous month
			charge_date is null
			payment_date is null
			payment_confirm is null
			update_date is current time
			update_user = 0
			create_date is current time
			create_user = 0
			delete_flg = 0
		*/

		$data = array(
			'charge_month' => date('Y-m-01',strtotime("-1 months")),
			'cid' => $purchase->sales_company_id,
			'total_sales' => empty($purchase->buy_price) ? 0 : $purchase->buy_price,
			'total_reward' => empty($purchase->introduce_point_total) ? 0 : $purchase->introduce_point_total,		
			'charge_date' => "0000-00-00",
			'payment_date' => NULL,
			'payment_confirm' => NULL,
			'update_date' => date('Y-m-d H:i:s'),
			'update_user' => 0,
			'create_date' => date('Y-m-d H:i:s'),
			'create_user' => 0,
            'delete_flg' => 0,
            );
		$this->db->insert("t_demand",$data);

		echo 'Company ID: '.$purchase->sales_company_id.PHP_EOL;
		echo 'Total sales: '.$purchase->buy_price.PHP_EOL;
		echo 'Total reward: '.$purchase->introduce_point_total.PHP_EOL;
		echo '-------'.PHP_EOL;

		return $purchase->sales_company_id;
	}

	public function create_demand_no_purchase($sales_company_id){
		/*
			--- 0 ---
			cid = sales_company_id
			total_sales = 0
			total_reward = 0

			charge_month is previous month
			charge_date is null
			payment_date is null
			payment_confirm is null
			update_date is current time
			update_user = 0
			create_date is current time
			create_user = 0
			delete_flg = 0
		*/
		$data = array(
			'charge_month' => date('Y-m-d',strtotime("-1 months")),
			'cid' => $sales_company_id,
			'total_sales' => 0,
			'total_reward' => 0,	
			'charge_date' => "0000-00-00",
			'payment_date' => NULL,
			'payment_confirm' => NULL,
			'update_date' => date('Y-m-d H:i:s'),
			'update_user' => 0,
			'create_date' => date('Y-m-d H:i:s'),
			'create_user' => 0,
            'delete_flg' => 0,
            );
		$this->db->insert("t_demand",$data);

		echo 'Company ID: '.$sales_company_id.PHP_EOL;
		echo 'Total sales: 0'.PHP_EOL;
		echo 'Total reward: 0'.PHP_EOL;
		echo '-------'.PHP_EOL;

		return $sales_company_id;
	}

}
?>