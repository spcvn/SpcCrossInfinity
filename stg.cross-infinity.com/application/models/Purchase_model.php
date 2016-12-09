<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_model extends CI_Model {
	
	function __construct() {
		$this->load->database();
	}

	public function count_list_buy($cid){
        $query = $this->db->query(" SELECT  t_purchase.buy_price,
                                            t_purchase.buy_time,
                                            t_purchase.buy_id,
                                            t_purchase.delete_flg,
                                            t_purchase.company_reward_id
                                    FROM t_purchase
                                    WHERE t_purchase.sales_company_id = $cid
                                    AND t_purchase.delete_flg = 0
                                    GROUP BY DATE(buy_time) 
                                    ORDER BY t_purchase.buy_id DESC
                                    ");
		return count($query->result_array());
    }
    public function count_list_buy_month($cid){
        $this->db->select('charge_month,total_sales,total_reward');
        $this->db->from('t_demand');
        $this->db->where('t_demand.delete_flg', 0);
        $this->db->where('t_demand.cid', $cid);
        $query = $this->db->get()->result();
        $count = count($query);
        return $count;
    }

    public function get_buy_purchase($limit, $start,$cid){
		if($start < 0){
            $start = 0;
        }
        $query = $this->db->query(" SELECT  t_purchase.buy_price,
                                            t_purchase.buy_time,
                                            t_purchase.buy_id,
                                            t_purchase.delete_flg,
                                            t_purchase.company_reward_id,
                                            SUM(buy_price)
                                    FROM t_purchase
                                    WHERE t_purchase.sales_company_id = $cid
                                    AND t_purchase.delete_flg = 0
                                    GROUP BY DATE(buy_time) 
                                    ORDER BY t_purchase.buy_id DESC
                                    LIMIT $start , $limit
                                    ");
        return $query->result_array();
    }
    public function get_buy_purchase_month($limit, $start,$cid){
        $this->db->select('charge_month,total_sales,total_reward');
        $this->db->from('t_demand');
        $this->db->where('t_demand.delete_flg', 0);
        $this->db->where('t_demand.cid', $cid);
        $this->db->order_by('t_demand.charge_id', 'ASC');
        if($start < 0){
            $start = 0;
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get()->result();
        return  $query;
    }
    public function get_buy_purchase_where_month($limit,$start,$condition,$cid){
        if($start < 0){
            $start = 0;
        }
         $query = $this->db->query(" SELECT t_purchase.buy_price,
                                            t_purchase.buy_time,
                                            t_purchase.buy_id,
                                            t_purchase.delete_flg,
                                            t_purchase.company_reward_id
                                    FROM t_purchase
                                    WHERE t_purchase.sales_company_id = $cid
                                    AND t_purchase.delete_flg = 0 
                                    AND  MONTH(t_purchase.buy_time) = $condition
                                    ORDER BY t_purchase.buy_id DESC
                                    LIMIT $start , $limit
                                    ");
        return $query->result_array();
    }
    
    public function count_list_buy_where_month($condition,$cid)
    {
        $query = $this->db->query(" SELECT  t_purchase.buy_price,
                                            t_purchase.buy_time,
                                            t_purchase.buy_id,
                                            t_purchase.delete_flg,
                                            t_purchase.company_reward_id
                                    FROM t_purchase
                                    WHERE t_purchase.sales_company_id = $cid
                                    AND t_purchase.delete_flg = 0 
                                    AND  MONTH(t_purchase.buy_time) = $condition
                                    ORDER BY t_purchase.buy_id DESC
                                    ");
        $count = count($query->result_array());
        return $count;
    }

    public function count_detail_list_buy($condition,$cid)
    {
        $query = $this->db->query(" SELECT  t_purchase.buy_price,
                                            t_purchase.buy_time,
                                            t_purchase.buy_id,
                                            t_purchase.delete_flg,
                                            t_purchase.sales_company_id,
                                            t_purchase.introduce_uid,
                                            t_user.uid,
                                            t_user.uid_name
                                    FROM t_purchase
                                    INNER JOIN t_user
                                    ON t_user.uid = t_purchase.introduce_uid
                                    WHERE t_purchase.sales_company_id = $cid
                                    AND t_purchase.delete_flg = 0 
                                    AND  DAY(t_purchase.buy_time) = $condition
                                    ORDER BY t_purchase.buy_id DESC
                                    ");
        $count = count($query->result_array());
        return $count;
    }

    public function get_detail_list_buy($limit,$start,$condition,$cid)
    {
        if($start < 0){
            $start = 0;
        }
        $query = $this->db->query(" SELECT  t_purchase.buy_price,
                                            t_purchase.buy_time,
                                            t_purchase.buy_id,
                                            t_purchase.delete_flg,
                                            t_purchase.sales_company_id,
                                            t_purchase.introduce_uid,
                                            t_user.uid,
                                            t_user.uid_name
                                    FROM t_purchase
                                    INNER JOIN t_user
                                    ON t_user.uid = t_purchase.introduce_uid
                                    WHERE t_purchase.sales_company_id = $cid
                                    AND t_purchase.delete_flg = 0 
                                    AND  DAY(t_purchase.buy_time) = $condition
                                    ORDER BY t_purchase.buy_id DESC
                                    LIMIT $start , $limit
                                    ");
        return $query->result_array();
    }

    public function delete_billing($id){
        $data = array(
               'delete_flg' => 1,
               'update_date' => date('Y-m-d H:i:s')
            );

        $this->db->where('buy_id', $id);
        $this->db->update('t_purchase', $data); 
    }

}