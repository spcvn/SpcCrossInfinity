<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Company Screen Helpers
 *
 * @author	TamPT
 */

	/**
	 * Format number
	 * @param $number Number input
	 */
	function my_number_format($number)
	{
		$number_string = (string) $number;
		$length = strlen($number_string);
		$counter = 0;
		$point = ',';
		$result = '';
		for($i = ($length - 1); $i >= 0; $i--) {
			$counter++;
			$result .= $number_string[$i];
			if($counter == 3 AND $i > 0 ) {
				$result .= ',';
				$counter = 0;
			}
		}
		return strrev($result);
		
	}

	/**
	* Check support active flag in current company
	**/
	function check_support($cid){
		// Get a reference to the controller object
	    $CI =& get_instance();
	    // You may need to load the model if it hasn't been pre-loaded
	    $CI->load->model('Support_model');
	    // Call a function of the model
	    $query = $CI->Support_model->check_support_company_active($cid);
		return $query;
	}