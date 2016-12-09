<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	DAILY BATCH RUN AT BEGIN OF DAY 00:00:00
*/

class Daily_batch extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->input->is_cli_request()) {
			echo "Not allow this request".PHP_EOL;
			exit;
		}
		$this->load->model('Batch_model','batch');
		$this->today = date('Y-m-d 00:00:00');
		$this->tomorrow =  date('Y-m-d 00:00:00',strtotime("+1 days"));
		$this->yesterday = date('Y-m-d 00:00:00',strtotime("-1 days"));
	}

	private $today;
	private $tomorrow;
	private $yesterday;

	public function run(){
		$this->check_support();

		$this->point_calculator();

		$this->point_additional();
		return TRUE;
	}

	/*
	------BEGIN FOR (1) ACTIVE SUPPORT--------
	*/

	public function check_support(){
		echo "---SUPPORT CHECKING---".PHP_EOL;
		// Active support
		echo "Active: ".PHP_EOL;

		$support_active_available = $this->batch->get_all_not_active_support_today();
		foreach ($support_active_available as $support) {
			echo $support->company_reward_id.PHP_EOL;
			$this->batch->active_support($support->company_reward_id);
		}

		echo "-------------".PHP_EOL;

		// Deactive support
		echo "Deactive: ".PHP_EOL;

		$support_end_available = $this->batch->get_all_active_support_end_today();
		foreach ($support_end_available as $support) {
			echo $support->company_reward_id.PHP_EOL;
			$this->batch->deactivate_support($support->company_reward_id);
		}

		echo "-------------".PHP_EOL;
	}

	/*
	------BEGIN FOR (2) POINT CALCULATOR--------
	*/
	// (2)Calculator point of all payment in this day
	public function point_calculator(){
		$purchase_yesterday = $this->batch->get_all_purchase_yesterday();
		echo '---CREATE PAYMENT---'.PHP_EOL;
		if(empty($purchase_yesterday)){ 
			echo "Not have purchase.".PHP_EOL;
			return false;
		}
	
		$this->batch->create_payment_for_yesterday($purchase_yesterday);
		echo "-------------".PHP_EOL;
	}


	/*
	------BEGIN FOR (3) POINT ADDITIONAL--------
	*/
	// (3)Process point for user have done payment
	public function point_additional(){
		$payment_yesterday = $this->batch->get_all_payment_available();
		echo '---POINT ADDITIONAL---'.PHP_EOL;

		if(empty($payment_yesterday)){ 
			echo "Not have available payment.".PHP_EOL;
			return false;
		}

		foreach ($payment_yesterday as $payment) {
			$this->batch->update_point_for_user($payment);
		}
		echo "-------------".PHP_EOL;
	}

}
