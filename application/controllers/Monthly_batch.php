<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monthly_batch extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->input->is_cli_request()) {
			echo "Not allow this request".PHP_EOL;
			exit;
		}
		$this->load->model('Batch_model','batch');
	}

	public function run(){
		return $this->get_purchase_and_create_demand();
	}

	public function get_purchase_and_create_demand(){
		$company_purchases = $this->batch->get_company_purchase_of_last_month();

		echo '---CREATE DEMAND---'.PHP_EOL;
		foreach ($company_purchases as $purchase) {
			// Make demand
			$this->batch->create_demand_have_purchase($purchase);
		}

		$company_not_purchases = $this->batch->get_company_not_purchase_of_last_month();
		foreach ($company_not_purchases as $company) {
			// Make demand
			$this->batch->create_demand_no_purchase($company->cid);
		}
		echo "-------------".PHP_EOL;
		return TRUE;
	}
}
