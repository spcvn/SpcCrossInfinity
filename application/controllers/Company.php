<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {

	public $cid;

	public function __construct()
	{
		parent::__construct();
		//$this->is_company_login();
		$this->load->config('validation');
		$this->load->model('Company_model');
		$this->load->model('Support_model');
		$this->load->model('Purchase_model');
		$this->load->model('Cross_infinty_model');
		$this->load->helper(array('company_helper') );
        $this->load->library("app/uploader");
		$this->salt = $this->config->item('salt_password');
		if(!empty($this->session->userdata('id'))) $this->cid = $this->session->userdata('id');
	}

	private $salt;

	function list_prefecture(){
		$return[''] = '';
		$this->db->order_by('prefecture_id', 'asc');
		$this->db->where('delete_flg',0);
		$query = $this->db->get('m_prefecture'); 
		foreach($query->result_array() as $row){
			$return[$row['prefecture_id']] = $row['prefecture_name'];
		}
		return $return;

	}

	function list_category(){
		$return[''] = '';
		$this->db->order_by('category_id', 'asc'); 
		$this->db->where('delete_flg',0);
		$query = $this->db->get('m_category'); 
		foreach($query->result_array() as $row){
			$return[$row['category_id']] = $row['category_name'];
		}
		return $return;
	}

	public function create_account() {
		$this->layout->setLayout('frontend/layout/layout');
		$data['scripts'] =  array('create_account_company.js');
		$data['prefecture']= $this->list_prefecture();
		$data['category']= $this->list_category();
		if($this->input->post()){
			$data['name'] = $this->input->post('name');
			$data['post_code_1'] = $this->input->post('post_code_1');
			$data['post_code_2'] = $this->input->post('post_code_2');
			$data['prefecture_id'] = $this->input->post('prefecture_id');
			$data['prefecture_name'] = $this->Company_model->get_prefecture_name_by_id($this->input->post('prefecture_id'));
			$data['city'] = $this->input->post('city');
			$data['street_address'] = $this->input->post('street_address');
			$data['station'] = $this->input->post('station');
			$data['tel_1'] = $this->input->post('tel_1');
			$data['tel_2'] = $this->input->post('tel_2');
			$data['tel_3'] = $this->input->post('tel_3');
			$data['tel'] = $data['tel_1'].'-'.$data['tel_2'].'-'.$data['tel_3'];
			$data['mail'] = $this->input->post('mail');
			$data['outside_url'] = $this->input->post('outside_url');
			$data['public_relations'] = $this->input->post('public_relations');
			$data['representative'] = $this->input->post('representative');
			$data['rep_tel_1'] = $this->input->post('rep_tel_1');
			$data['rep_tel_2'] = $this->input->post('rep_tel_2');
			$data['rep_tel_3'] = $this->input->post('rep_tel_3');
			$data['rep_tel'] = $data['rep_tel_1'].'-'.$data['rep_tel_2'].'-'.$data['rep_tel_3'];
			$data['rep_address'] = $this->input->post('rep_address');
			$data['introduce_uid'] = $this->input->post('introduce_uid');
			$data['introduce_name'] = $this->Company_model->get_introduce_name_by_id($this->input->post('introduce_uid'));
			$data['category_id'] = $this->input->post('category_id');
			$data['category_name'] = $this->Company_model->get_categoryname_by_id($this->input->post('category_id'));
			$data['bank_name'] = $this->input->post('bank_name');
			$data['bank_branch_number'] = $this->input->post('bank_branch_number');
			$data['bank_type'] = $this->input->post('bank_type');
			$data['bank_number'] = $this->input->post('bank_number');
			$data['bank_holder'] = $this->input->post('bank_holder');
			$data['password_login'] = $this->input->post('password_login');
			$data['password_reward'] = $this->input->post('password_reward');
			$data['reward_group'] = $this->input->post('reward_group');
			$data['reward_from_data'] = $this->input->post('reward_from_data');
			$data['reward_to_data'] = $this->input->post('reward_to_data');
			$data['reward_from_time'] = $this->input->post('reward_from_time');
			$data['reward_to_time'] = $this->input->post('reward_to_time');
			$data['applied_lowest_price'] = $this->input->post('applied_lowest_price');
			$data['discount_price'] = $this->input->post('discount_price');
			$data['discount_rate'] = $this->input->post('discount_rate');
			$data['reward_point'] = $this->input->post('reward_point');
			$data['reward_point_rate'] = $this->input->post('reward_point_rate');
			$data['reward_content'] = $this->input->post('reward_content');
			$this->layout->view('frontend/company/create',$data);
		}else{
			$this->layout->view('frontend/company/create',$data);
		}
		
	}

	/**
	 * Display confirm create company account screen 
	 **/
	public function show_confirm() {
		$this->layout->setLayout('frontend/layout/layout');
		$data['styles'] = array('company.css');
		$data['scripts'] =  array('create_account_company.js');
		if($this->input->post()) {
			$data['name'] = $this->input->post('name');
			$data['prefecture']= $this->list_prefecture();
			$data['category']= $this->list_category();
			$data['post_code_1'] = $this->input->post('post_code_1');
			$data['post_code_2'] = $this->input->post('post_code_2');
			$data['prefecture_id'] = $this->input->post('prefecture_id');
			$data['prefecture_name'] = $this->Company_model->get_prefecture_name_by_id($this->input->post('prefecture_id'));
			$data['city'] = $this->input->post('city');
			$data['street_address'] = $this->input->post('street_address');
			$data['station'] = $this->input->post('station');
			$data['tel_1'] = $this->input->post('tel_1');
			$data['tel_2'] = $this->input->post('tel_2');
			$data['tel_3'] = $this->input->post('tel_3');
			$data['tel'] = $data['tel_1'].'-'.$data['tel_2'].'-'.$data['tel_3'];
			$data['mail'] = $this->input->post('mail');
			$data['outside_url'] = $this->input->post('outside_url');
			$data['public_relations'] = $this->input->post('public_relations');
			$data['representative'] = $this->input->post('representative');
			$data['rep_tel_1'] = $this->input->post('rep_tel_1');
			$data['rep_tel_2'] = $this->input->post('rep_tel_2');
			$data['rep_tel_3'] = $this->input->post('rep_tel_3');
			$data['rep_tel'] = $data['rep_tel_1'].'-'.$data['rep_tel_2'].'-'.$data['rep_tel_3'];
			$data['rep_address'] = $this->input->post('rep_address');
			$data['introduce_uid'] = $this->input->post('introduce_uid');
			$data['introduce_name'] = $this->Company_model->get_introduce_name_by_id($this->input->post('introduce_uid'));
			$data['category_id'] = $this->input->post('category_id');
			$data['category_name'] = $this->Company_model->get_categoryname_by_id($this->input->post('category_id'));
			$data['bank_name'] = $this->input->post('bank_name');
			$data['bank_branch_number'] = $this->input->post('bank_branch_number');
			$data['bank_type'] = $this->input->post('bank_type');
			$data['bank_number'] = $this->input->post('bank_number');
			$data['bank_holder'] = $this->input->post('bank_holder');
			$data['password_login'] = $this->input->post('password_login');
			$data['password_reward'] = $this->input->post('password_reward');
			$data['reward_group'] = $this->input->post('reward_group');
			$data['reward_from_data'] = $this->input->post('reward_from_data');
			$data['reward_to_data'] = $this->input->post('reward_to_data');
			$data['reward_from_time'] = $this->input->post('reward_from_time');
			$data['reward_to_time'] = $this->input->post('reward_to_time');
			$data['applied_lowest_price'] = $this->input->post('applied_lowest_price');
			$data['discount_price'] = $this->input->post('discount_price');
			$data['discount_rate'] = $this->input->post('discount_rate');
			$data['reward_point'] = $this->input->post('reward_point');
			$data['reward_point_rate'] = $this->input->post('reward_point_rate');
			$data['reward_content'] = $this->input->post('reward_content');
			$data['agree'] = $this->input->post('agree');

			// Modify content display of password
			$length_password_login = mb_strlen($data['password_login']);
			$length_password_reward = mb_strlen($data['password_reward']);
			$data['password_login_edit'] = '';
			$data['password_reward_edit'] = '';
			for($i = 0; $i < $length_password_login; $i++) {
				$data['password_login_edit'] .= '＊';
			}

			for($i = 0; $i < $length_password_reward; $i++) {
				$data['password_reward_edit'] .= '＊';
			}
			// Validate all field
			$validation = config_item('company_validation');
			$message = array(
                'required' => '%sを入力してください。',
	            'max_length' => '{field}は{param}文字以内で入力してください。',
	            'min_length' => '{field}は「半角英数字記号」{param}文字以上を入力してください。',
	            'check_valid_discount' => '購入者割引の「円」か「％」のいずれかを入力してください。',
	            'check_valid_discount_input' => '購入者割引は「円」か「％」のいずれかを入力してください。',
	            'check_valid_reward_point' =>  '販売促進費の「円」か「％」のいずれかを入力してください。',
	            'check_valid_reward_point_input' => '販売促進費は「円」か「％」のいずれかを入力してください。',
	            'valid_email' => "メールアドレスを正しく入力してください。",
	            'valid_url_format' => "%sを正しく入力してください。",
	            'numeric' => "%sを正しく入力してください。",
	            'accept_terms' => "利用規約への同意は必須です。",
	            'check_password_same' => 'ログインパスワードと企業情報変更パスワードは同じものを使用出来ません。',
	            'check_valid_introducer_id' => '紹介者IDが見つかりません。',
	            'check_exist_email_regist' => '既に登録されているメールアドレスです。',
	            'exact_length' => '%sは7文字です。（例：000-0000）',
	            'check_valid_reward_group' => '現在は通常応援以外は選択できません。',
	            'check_format_password' => '%sは「半角英数字記号」8文字以上を入力してください。',
	            'check_format_time_support' => '%sを正しく入力してください。 (HH:mm)',
	            'check_format_date_support' => '%sを正しく入力してください。（例：1990/01/01）',
	            'not_allow_japanese_chars' => '%sは「半角英数字記号」8文字以上を入力してください。',
	            'check_required_category' => 'カテゴリを選択してください。',
	            'check_max_length' => '応援内容説明は2,000文字以内で入力してください。',
	            'check_max_length_tel' => '%sは15文字以内で入力してください。',
	            'check_valid_date_from' => '%sは今日以降を入力してください。',
	            'check_nospace' => '空白文字またはスペースは利用できません',
	            'time24' => '時間を正しく入力してください。 （例：00:00）。'
            );
            $this->form_validation->set_rules($validation);
            $this->form_validation->set_message($message);

            if($this->form_validation->run() == FALSE) {
            	$this->layout->view('frontend/company/create',$data);
            } else {
            	$this->layout->view('frontend/company/confirm',$data);
            }
		} else {
			redirect('company/create_account');
		}
		
	}

	public function pdf(){
		$this->load->view('frontend/company/pdf');
	}

	/**
	 * Regist company account and transit to complete screen
	 **/
	public function regist_account() {
		$this->layout->setLayout('frontend/layout/layout');
		if($this->input->post()){			
			$data['name'] = $this->input->post('name');
			$data['prefecture']= $this->list_prefecture();
			$data['category']= $this->list_category();
			$data['post_code_1'] = $this->input->post('post_code_1');
			$data['post_code_2'] = $this->input->post('post_code_2');
			$data['prefecture_id'] = $this->input->post('prefecture_id');
			$data['prefecture_name'] = $this->Company_model->get_prefecture_name_by_id($this->input->post('prefecture_id'));
			$data['city'] = $this->input->post('city');
			$data['street_address'] = $this->input->post('street_address');
			$data['station'] = $this->input->post('station');
			$data['tel_1'] = $this->input->post('tel_1');
			$data['tel_2'] = $this->input->post('tel_2');
			$data['tel_3'] = $this->input->post('tel_3');
			$data['tel'] = $data['tel_1'].'-'.$data['tel_2'].'-'.$data['tel_3'];
			$data['mail'] = $this->input->post('mail');
			$data['outside_url'] = $this->input->post('outside_url');
			$data['public_relations'] = $this->input->post('public_relations');
			$data['representative'] = $this->input->post('representative');
			$data['rep_tel_1'] = $this->input->post('rep_tel_1');
			$data['rep_tel_2'] = $this->input->post('rep_tel_2');
			$data['rep_tel_3'] = $this->input->post('rep_tel_3');
			$data['rep_tel'] = $data['rep_tel_1'].'-'.$data['rep_tel_2'].'-'.$data['rep_tel_3'];
			$data['rep_address'] = $this->input->post('rep_address');
			$data['introduce_uid'] = $this->input->post('introduce_uid');
			$data['introduce_name'] = $this->Company_model->get_introduce_name_by_id($this->input->post('introduce_uid'));
			$data['category_id'] = $this->input->post('category_id');
			$data['category_name'] = $this->Company_model->get_categoryname_by_id($this->input->post('category_id'));
			$data['bank_name'] = $this->input->post('bank_name');
			$data['bank_branch_number'] = $this->input->post('bank_branch_number');
			$data['bank_type'] = $this->input->post('bank_type');
			$data['bank_number'] = $this->input->post('bank_number');
			$data['bank_holder'] = $this->input->post('bank_holder');
			$data['password_login'] = $this->input->post('password_login');
			$data['password_reward'] = $this->input->post('password_reward');
			$data['reward_group'] = $this->input->post('reward_group');
			$data['reward_from_data'] = $this->input->post('reward_from_data');
			$data['reward_to_data'] = $this->input->post('reward_to_data');
			$data['reward_from_time'] = $this->input->post('reward_from_time');
			$data['reward_to_time'] = $this->input->post('reward_to_time');
			$data['applied_lowest_price'] = $this->input->post('applied_lowest_price');
			$data['discount_price'] = $this->input->post('discount_price');
			$data['discount_rate'] = $this->input->post('discount_rate');
			$data['reward_point'] = $this->input->post('reward_point');
			$data['reward_point_rate'] = $this->input->post('reward_point_rate');
			$data['reward_content'] = $this->input->post('reward_content');
			$validation = config_item('company_validation');
			$message = array(
	            'required' => '%sを入力してください。',
	            'max_length' => '{field}は{param}文字以内で入力してください。',
	            'min_length' => '{field}は「半角英数字記号」{param}文字以上を入力してください。',
	            'check_valid_discount' => '購入者割引の「円」か「％」のいずれかを入力してください。',
	            'check_valid_discount_input' => '購入者割引は「円」か「％」のいずれかを入力してください。',
	            'check_valid_reward_point' =>  '販売促進費の「円」か「％」のいずれかを入力してください。',
	            'check_valid_reward_point_input' => '販売促進費は「円」か「％」のいずれかを入力してください。',
	            'valid_email' => "メールアドレスを正しく入力してください。",
	            'valid_url_format' => "%sを正しく入力してください。",
	            'numeric' => "%sを正しく入力してください。",
	            'accept_terms' => "利用規約への同意は必須です。",
	            'check_password_same' => 'ログインパスワードと企業情報変更パスワードは同じものを使用出来ません。',
	            'check_valid_introducer_id' => '紹介者IDが見つかりません。',
	            'check_exist_email_regist' => '既に登録されているメールアドレスです。',
	            'exact_length' => '%sは7文字です。（例：000-0000）',
	            'check_valid_reward_group' => '現在は通常応援以外は選択できません。',
	            'check_format_password' => '%sは「半角英数字記号」8文字以上を入力してください。',
	            'check_format_time_support' => '%sを正しく入力してください。 (HH:mm)',
	            'check_format_date_support' => '%sを正しく入力してください。（例：1990/01/01）',
	            'not_allow_japanese_chars' => '%sは「半角英数字記号」8文字以上を入力してください。',
	            'check_required_category' => 'カテゴリを選択してください。',
	            'check_max_length' => '応援内容説明は2,000文字以内で入力してください。',
	            'check_max_length_tel' => '%sは15文字以内で入力してください。',
	            'check_valid_date_from' => '%sは今日以降を入力してください。',
	            'check_nospace' => '空白文字またはスペースは利用できません',
	            'time24' => '時間を正しく入力してください。 （例：00:00）。'
	        );
	        $this->form_validation->set_rules($validation);
	        $this->form_validation->set_message($message);

	        // Validate all field
	        if($this->form_validation->run() == FALSE) {
	        	$this->layout->view('frontend/company/create');
	        } else {
	        	$prefecture = $this->Company_model->get_prefecture_by_id($data['prefecture_id']);
	        	$prefecture_name = $prefecture == FALSE ? '' : $prefecture;
	        	$data_company = array(
	        		'name' => $data['name'],
	        		'post_code' => $data['post_code_1'].'-'.$data['post_code_2'],
	        		'prefecture_id' => $data['prefecture_id'],
	        		'city' => $data['city'],
	        		'street_address' => $data['street_address'],
	        		'station' => $data['station'],
	        		'tel' => $data['tel'],
	        		'mail' => $data['mail'],
	        		'outside_url' => $data['outside_url'],
	        		'public_relations' => $data['public_relations'],
	        		'representative' => $data['representative'],
	        		'rep_tel' => $data['rep_tel'],
	        		'rep_address' => $data['rep_address'],
	        		'introduce_uid' => $this->Company_model->get_uid_by_uid_name($data['introduce_uid']),
	        		'bank_name' => $data['bank_name'],
	        		'bank_branch_number' => $data['bank_branch_number'],
	        		'bank_type' => $data['bank_type'],
	        		'bank_number' => $data['bank_number'],
	        		'bank_holder' => $data['bank_holder'],
	        		'password_login' => md5(mb_convert_encoding($data['password_login'].$this->salt,"SJIS", "ASCII")),
	        		'password_reward' => md5(mb_convert_encoding($data['password_reward'].$this->salt,"SJIS", "ASCII")),
	        		'address' => $prefecture_name.$data['city'].$data['street_address'],
	        		'category_id' => $data['category_id'],
	        		'country_id' => '1',
	        		'update_date' => date('Y-m-d H:i:s'),
	        		'create_date' => date('Y-m-d H:i:s'),
	        		'create_user' => 0,
	        		'update_user' => 0,
	        		'introduction_count' => 0,
	        		'delete_flg' => 0,
	        		'cid_name' => 'JPC',
	        		'password_login_length' => mb_strlen($data['password_login']),
	        		'password_reward_length' => mb_strlen($data['password_reward'])
	        	);
	        	$cid = $this->Company_model->regist_company_account($data_company);
	        	// Insert into support table
	        	$data_support = array(
					'reward_group' => $data['reward_group'],
					'reward_from_data' => date("Y-m-d", strtotime($data['reward_from_data'])),
					'reward_to_data' => empty($data['reward_to_data']) ? null : date("Y-m-d", strtotime($data['reward_to_data'])),
					'reward_from_time' => $data['reward_from_time'],
					'reward_to_time' => $data['reward_to_time'],
					'applied_lowest_price' => $data['applied_lowest_price'],
					'discount_price' => empty($data['discount_price']) ? 0 : $data['discount_price'],
					'discount_rate' => empty($data['discount_rate']) ? 0 : $data['discount_rate'],
					'reward_point' => empty($data['reward_point']) ? 0 : $data['reward_point'],
					'reward_point_rate' => empty($data['reward_point_rate']) ? 0 : $data['reward_point_rate'],
					'reward_content' => $data['reward_content'],
					'update_date' => date('Y-m-d H:i:s'),
					'create_date' => date('Y-m-d H:i:s'),
					'create_user' => $cid,
	        		'update_user' => $cid,
					'cid' => $cid,
					'delete_flg' => 0,
					'active_flag' => 0
				);
	        	$this->Company_model->regist_support_company_account($data_support);

	        	// Create cid name and get bank info to display at complete screen
	        	$cid_name = '';
	        	$data_complete['company_info'] = $this->Company_model->get_company_info($cid);
	        	$data_complete_display['crossinfinity'] = $this->Company_model->get_crossinfinity();
	        	$country_name = $this->Company_model->get_country_abbreviation($data_complete['company_info']->country_id);
	        	$cid_name .= $country_name->country_abbreviation.'C';
	        	$length_cid = strlen($cid);
	        	$number_zero_add = 9 - $length_cid;
	        	for($i = 0; $i < $number_zero_add; $i++) {
	        		$cid_name .= '0';
	        	}
	        	$cid_name .= $cid;
	        	$this->Company_model->update_update_user($cid, $cid_name);
	        	$this->send_mail($data_complete['company_info']->mail, '仮登録通知(CROSS INFINITY)', $this->send_mail_company($data_complete['company_info']->representative));
	        	$this->layout->view('frontend/company/complete', $data_complete_display);
	        }
    	} else {
    		redirect('company/create_account');
    	}
	}

	/**
	 * Check validation not input discount 
	 **/
	public function check_valid_discount() {
		if((($this->input->post('discount_price') == '') && ($this->input->post('discount_rate') == ''))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * Check validation both input discount 
	 **/
	public function check_valid_discount_input() {
		if((($this->input->post('discount_price') != '') && ($this->input->post('discount_rate') != ''))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function accept_terms() {
    if (isset($_POST['agree'])) return TRUE;
    	return FALSE;
	}

	/**
	 * Check validation not input reward point
	 **/
	public function check_valid_reward_point() {
		if((($this->input->post('reward_point') == '') && ($this->input->post('reward_point_rate') == ''))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * Check validation both input reward point
	 **/
	public function check_valid_reward_point_input() {
		if((($this->input->post('reward_point') != '') && ($this->input->post('reward_point_rate') != ''))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
     * Validate URL format
     * @param   string
     * @return  boolean
     */
    public function valid_url_format($url){
    	if($url != '') {
    		$pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
	        if (!preg_match($pattern, $url)) {
	            return FALSE;
	        }
    	}
        return TRUE;
        
    } 

    /**
	 * Check validation 2 password is same
	 **/
    public function check_password_same() {
    	if($this->input->post('password_login') != '' && $this->input->post('password_reward') != '') {
    		if($this->input->post('password_login') == $this->input->post('password_reward')) {
    			return FALSE;
    		}
    	}
    	return TRUE;
    }

    /**
	 * Check introducer id valid (exist)
	 **/
    public function check_valid_introducer_id($introduce_uid) {
    	$result = $this->Company_model->check_exist_introduce_uid($introduce_uid);
    	if($result == FALSE) {
    		return FALSE;
    	}
    	return TRUE;
    }

    /**
	 * Check exist email when regist
	 **/
    public function check_exist_email_regist() {
    	$email = $this->input->post('mail');
    	if($this->Company_model->check_exist_email($email)) {
    		return FALSE;
    	}
    	return TRUE;
    }

    /**
	 * Check exist email when update company
	 **/
    public function check_exist_email_update() {
    	$email = $this->input->post('mail');
    	if($this->session->userdata('type') == 'user') {
    		if($email == $this->Company_model->get_email_user($this->session->userdata('id'))) {
    			return TRUE;
    		} else {
    			if($this->Company_model->check_exist_email($email)){
		    		return FALSE;
		    	}
		    	return TRUE;
    		}
    	} else {
    		if($email == $this->Company_model->get_email_company($this->session->userdata('id'))) {
    			return TRUE;
    		} else {
    			if($this->Company_model->check_exist_email($email)) {
		    		return FALSE;
		    	}
		    	return TRUE;
		    }
    	}
    }

	/**
	 * Body email
	 * @param data_sendmail Data to send mail
	 * @return message in body email
	 **/
	public function send_mail_company($name) {
		$information_name = $this->Cross_infinty_model->get_information_name(7);
		$information_content = $information_name->information_content != false ? $information_name->information_content : "";
		$month = $information_content/12;
		$vat = '（月額'.number_format($month).'×12か月分）='.number_format($information_content).'(税別)';

		$message = "";
		$message .= "<p>".$name." 様</p>";
		$message .= "<br/>";
		$message .= "<p>CROSS INFINITY</p>";
		$message .= "<p>自動仮登録メールサービスです。</p>";
		$message .= "<br/>";
		$message .= "<p>仮登録の受付が完了しました。</p>";
		$message .= "<br/>";
		$message .= "<p>下記口座へ年会費の入金を</p>";
		$message .= "<p>お願いいたします。</p>";
		$message .= "<br/>";
		$message .= "<p>金融機関名:三井住友銀行</p>";
		$message .= "<p>支店名:京橋支店</p>";
		/*if ($data_sendmail->bank_type == 0) {
			$bank_type = '普通預金';
		} else {
			$bank_type = '当座預金';
		}*/
		$message .= "<p>預金種目:普通預金</p>";
		$message .= "<p>口座番号:8423985</p>";
		$message .= "<p>口座名義人:カ）タケヤニ</p>";
		$message .= "<br/>";

		//add follow spec 17/2
		$message .= "<p>上記口座へ年会費";
		$message .= "<p>".$vat."</p>";
		$message .= "<p>の振込が確認出来次第</p>";
		$message .= "<p>IDをメールで送信致します。</p>";
		$message .= "<p>そのIDからログインを行ってください！</p>";
		
		$message .= "<br/>";
		$message .= "<p>その他お問い合わせは以下に</p>";
		$message .= "<p>ご連絡をお願いいたします。</p>";
		$message .= "<p>qa@cross-infinity.com</p>";
		return $message;
	}

	/*
	 * Display detail company and support infomation screen	
	 */
	public function show_detail() {

		$this->is_company_login();
		$this->layout->setLayout('frontend/layout/layout');
        $dataFile = $this->uploader->get_all_file($this->cid);
		$cid = $this->session->userdata('id');
		$data_detail['styles'] = array('company.css');
		$company_info =  $this->Company_model->get_company_information($cid);
		$company_info->uid_name = $this->Company_model->get_uid_name_by_uid($company_info->introduce_uid);
		$data_detail['company_info'] = $company_info;
//        print_r($dataFile);exit;
		$data_detail['data_file'] = $dataFile;
		$this->layout->view('frontend/company/detail', $data_detail);
	}

	/*
	 * Display and update company infomation screen
	 */
	public function update_company_info() {
		$this->is_company_login();

		$this->layout->setLayout('frontend/layout/layout');
		$data_company['styles'] = array('company.css');
		$data_company['scripts'] = array('update_account_company.js');
		$cid = $this->session->userdata('id');
		$company_info = $this->Company_model->get_company_information($cid);
		$data_company['prefecture']= $this->list_prefecture();
		$data_company['category']= $this->list_category();
		$data_company['company_info'] = $company_info;
	
		if($this->input->post()){
			$validation = config_item('update_company_validation');
			$message = array(
                'required' => '%sを入力してください。',
                'max_length' => '{field}は{param}文字以内で入力してください。',
	            'min_length' => '{field}は「半角英数字記号」{param}文字以上を入力してください。',
	            'valid_email' => "メールアドレスを正しく入力してください。",
	            'valid_url_format' => "%sを正しく入力してください。",
	            'numeric' => "%sを正しく入力してください。",
	            'check_valid_introducer_id' => '紹介者IDが見つかりません。',
	            'exact_length' => '%sは7文字です。（例：000-0000）',
	            'not_allow_japanese_chars' => '%sは「半角英数字記号」8文字以上を入力してください。',
	            'check_required_category' => 'カテゴリを選択してください。',
	            'check_max_length_tel' => '%sは15文字以内で入力してください。',
	            'check_nospace' => '空白文字またはスペースは利用できません'
            );
            $this->form_validation->set_rules($validation);
            $this->form_validation->set_message($message);

            if($this->form_validation->run() == FALSE) {
            	$data_company['company_info'] = (object) array(
	        		'name' => $this->input->post('name'),
	        		'post_code' => $this->input->post('post_code_1').'-'.$this->input->post('post_code_2'),
	        		'prefecture_id' => $this->input->post('prefecture_id'),
	        		'city' => $this->input->post('city'),
	        		'street_address' => $this->input->post('street_address'),
	        		'station' => $this->input->post('station'),
	        		'tel' => $this->input->post('tel_1').'-'.$this->input->post('tel_2').'-'.$this->input->post('tel_3'),
	        		'outside_url' => $this->input->post('outside_url'),
	        		'public_relations' => $this->input->post('public_relations'),
	        		'representative' => $this->input->post('representative'),
	        		'rep_tel' => $this->input->post('rep_tel_1').'-'.$this->input->post('rep_tel_2').'-'.$this->input->post('rep_tel_3'),
	        		'rep_address' => $this->input->post('rep_address'),
	        		'introduce_uid' => $this->Company_model->get_uid_name_by_uid($this->input->post('introduce_uid')),
	        		'bank_name' => $this->input->post('bank_name'),
	        		'bank_branch_number' => $this->input->post('bank_branch_number'),
	        		'bank_type' => $this->input->post('bank_type'),
	        		'bank_number' => $this->input->post('bank_number'),
	        		'bank_holder' => $this->input->post('bank_holder'),
	        		'category_id' => $this->input->post('category_id')
            	);

            	$this->layout->view('frontend/company/edit_company', $data_company);
            } else {
            	$cid = $this->session->userdata('id');
            	$prefecture = $this->Company_model->get_prefecture_by_id($this->input->post('prefecture_id'));
	        	$prefecture_name = $prefecture == FALSE ? '' : $prefecture;
            	$data_update = array(
	        		'name' => $this->input->post('name'),
	        		'post_code' => $this->input->post('post_code_1').'-'.$this->input->post('post_code_2'),
	        		'prefecture_id' => $this->input->post('prefecture_id'),
	        		'city' => $this->input->post('city'),
	        		'street_address' => $this->input->post('street_address'),
	        		'station' => $this->input->post('station'),
	        		'tel' => $this->input->post('tel_1').'-'.$this->input->post('tel_2').'-'.$this->input->post('tel_3'),
	        		'outside_url' => $this->input->post('outside_url'),
	        		'public_relations' => $this->input->post('public_relations'),
	        		'representative' => $this->input->post('representative'),
	        		'rep_tel' => $this->input->post('rep_tel_1').'-'.$this->input->post('rep_tel_2').'-'.$this->input->post('rep_tel_3'),
	        		'rep_address' => $this->input->post('rep_address'),
	        		'introduce_uid' => $this->Company_model->get_uid_by_uid_name($this->input->post('introduce_uid')),
	        		'bank_name' => $this->input->post('bank_name'),
	        		'bank_branch_number' => $this->input->post('bank_branch_number'),
	        		'bank_type' => $this->input->post('bank_type'),
	        		'bank_number' => $this->input->post('bank_number'),
	        		'bank_holder' => $this->input->post('bank_holder'),
	        		'address' => $prefecture_name.$this->input->post('city').$this->input->post('street_address'),
	        		'category_id' => $this->input->post('category_id'),
	        		'update_date' => date('Y-m-d H:i:s'),
	        		'update_user' => $cid
	        	);
				$this->Company_model->update_company_info($data_update, $cid);
            	redirect('company/detail');
            }
		} else {
			$company_info->uid_name = $this->Company_model->get_uid_name_by_uid($company_info->introduce_uid);
			$this->layout->view('frontend/company/edit_company', $data_company);
		}
	}

	public function check_valid_discount_add() {

		if( !isset($_POST['tmp_discount_price']) && !isset($_POST['tmp_discount_rate']) ) return true;

		if((($this->input->post('tmp_discount_price') == '') && ($this->input->post('tmp_discount_rate') == '')) ) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function check_valid_discount_input_add() {

		if( !isset($_POST['tmp_discount_price']) && !isset($_POST['tmp_discount_rate']) ) return true;


		if((($this->input->post('tmp_discount_price') != '') && ($this->input->post('tmp_discount_rate') != '')) ) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function check_valid_reward_point_add() {

		if( !isset($_POST['tmp_reward_point']) && !isset($_POST['tmp_reward_point_rate']) ) return true;

		if((($this->input->post('tmp_reward_point') == '') && ($this->input->post('tmp_reward_point_rate') == '')) ) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function check_valid_reward_point_input_add(){

		if( !isset($_POST['tmp_reward_point']) && !isset($_POST['tmp_reward_point_rate']) ) return true;

		if((($this->input->post('tmp_reward_point') != '') && ($this->input->post('tmp_reward_point_rate') != '')) ) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function compareDate(){
		if( !isset($_POST['reward_from_data']) || !isset($_POST['reward_to_data']) ) return true;

		$startDate = strtotime($_POST['reward_from_data']);
		$endDate = strtotime($_POST['reward_to_data']);
		if($endDate != null){			
				if ($endDate >= $startDate)
					return TRUE;
				else{
					$this->form_validation->set_message('compareDate', '応援対象年月日Toは応援対象年月日Fromよりも後の日付を指定してください。');
					return FALSE;
				}
				//$this->Support_model->get_support_second($this->cid,$_POST['tmp_reward_to_data']$support_first['company_reward_id']);
		}else{
		return TRUE;
		}
	}

	public function checkIssetTo(){
		if( !isset($_POST['reward_to_time']) || !isset($_POST['reward_to_data']) ) return true;
		
		if($_POST['reward_to_time'] != null){
			if($_POST['reward_to_data'] == null){
				$this->form_validation->set_message('checkIssetTo', '応援対象年月日Toを入力してください。');
				return false;
			}
		}

		return true;
	}

	public function checkIssetToAdd(){
		
		if(!isset($_POST['tmp_reward_to_time'])) return true;

		if($_POST['tmp_reward_to_time'] != null){
			if($_POST['tmp_reward_to_data'] == null){
				$this->form_validation->set_message('checkIssetToAdd', '応援対象年月日Toを入力してください。');
				return false;
			}
		}

		return true;
	}

	public function compareDate_add(){
		
		if( !isset($_POST['tmp_reward_from_data']) && !isset($_POST['tmp_reward_to_data']) ) return true;
		
		$startDate = strtotime($_POST['tmp_reward_from_data']);
		$endDate = strtotime($_POST['tmp_reward_to_data']);
		if($endDate != null){			
				if ($endDate >= $startDate)
					return TRUE;
				else{
					$this->form_validation->set_message('compareDate_add', '%sは"応援対象年月日From"よりも後の日付を指定してください。');
					return FALSE;
				}
				//$this->Support_model->get_support_second($this->cid,$_POST['tmp_reward_to_data']$support_first['company_reward_id']);
		}else{
		return TRUE;
		}
	}

	public function compareDate_greater(){

		if(!isset($_POST['tmp_reward_from_data'])) return true;
		
		if($_POST['reward_to_time'] != null){
			$start_date_second = strtotime($_POST['tmp_reward_from_data']);
			$start_date_first = strtotime($_POST['reward_from_data']);
		
			if ($start_date_second >= $start_date_first)
			{
				return TRUE;
			}else{
				$this->form_validation->set_message('compareDate_greater', '%sは、既存の応援条件の応援対象年月日Fromよりも後の日付を指定してください。');
				return FALSE;
			}
		}else{
			return TRUE;
		}
	}

	public function checkGreaterThanTen(){

		if(!isset($_POST['tmp_reward_from_data'])) return true;

		$current = strtotime('+10 days');
	  	$day = strtotime($_POST['tmp_reward_from_data']);
	  	if($day < $current){
	  		$this->form_validation->set_message('checkGreaterThanTen', '新規応援条件は本日から10日後の日付から指定可能です。');
			return FALSE;
	  	}else{
	  		return TRUE;
	  	}
	}

	public function valid_support_update($name){
		$validation = config_item($name);
       	$message = array(
	            'required' => '%sを入力してください。',
	            'max_length' => '{field}は{param}文字以内で入力してください。',
	            'min_length' => '{field}は「半角英数字記号」{param}文字以上を入力してください。',
	            'check_valid_discount' => '購入者割引の「円」か「％」のいずれかを入力してください。',
	            'check_valid_discount_input' => '購入者割引は「円」か「％」のいずれかを入力してください。',
	            'check_valid_reward_point' =>  '購入者割引の「円」か「％」のいずれかを入力してください。',
	            'check_valid_reward_point_input' => '販売促進費は「円」か「％」のいずれかを入力してください。',
	            'valid_email' => "メールアドレスを正しく入力してください。",
	            'valid_url_format' => "URLを正しく入力してください。",
	            'numeric' => "%sを正しく入力してください。",
	            'check_format_time_support' => '%sを正しく入力してください。 (HH:mm)',
	            'check_format_date_support' => '%sを正しく入力してください。（例：1990/01/01）',
	            //'check_valid_time_support' => '応援対象時間Toは応援対象時間Fromよりも後の日付を指定してください。',
	            'check_valid_reward_group' => '現在は通常応援以外は選択できません。',
	            'check_max_length' => '応援内容説明は2,000文字以内で入力してください。',
	            'check_nospace' => '空白文字またはスペースは利用できません',
	            'check_exist_email_update' => '既に登録されているメールアドレスです。',
	            'check_format_password' => '%sは「半角英数字記号」8文字以上を入力してください。',
	            'not_allow_japanese_chars' => '%sは「半角英数字記号」8文字以上を入力してください。',
	            'check_password_same' => 'ログインパスワードと企業情報変更パスワードは同じものを使用出来ません。',
	            'check_isset_password_reward' => 'ログインパスワードと企業情報変更パスワードは同じものを使用出来ません。',
	            'check_isset_password_login'=>'ログインパスワードと企業情報変更パスワードは同じものを使用出来ません。'
	        );
        $this->form_validation->set_rules($validation);
        $this->form_validation->set_message($message);
        if($this->form_validation->run() == FALSE){
        	return FALSE;
        }else{
        	return TRUE;
        }
	}

	public function valid_support_add($name){
		$this->form_validation->set_message('required', '%sを入力してください');
		$validation = config_item($name);
		$message = array(
	            'required' => '%sを入力してください。',
	            'max_length' => '{field}は{param}文字以内で入力してください。',
	            'min_length' => '{field}は「半角英数字記号」{param}文字以上を入力してください。',
	            'check_valid_discount_add' => '購入者割引の「円」か「％」のいずれかを入力してください。',
	            'check_valid_discount_input_add' => '購入者割引は「円」か「％」のいずれかを入力してください。',
	            'check_valid_reward_point_add' =>  '購入者割引の「円」か「％」のいずれかを入力してください。',
	            'check_valid_reward_point_input_add' => '販売促進費は「円」か「％」のいずれかを入力してください。',
	           	'valid_email' => "メールアドレスを正しく入力してください。",
    			'valid_url_format' => "URLを正しく入力してください。",
	            'numeric' => "%sを正しく入力してください。",
	            'check_format_time_support' => '%sを正しく入力してください。 (HH:mm)',
	            'check_format_date_support' => '%sを正しく入力してください。（例：1990/01/01）',
	            'check_valid_time_support_add' => '応援対象時間Toは応援対象時間Fromよりも後の日付を指定してください。',
	            'check_valid_reward_group_add' => '現在は通常応援以外は選択できません。',
	            'check_max_length' => '応援内容説明は2,000文字以内で入力してください。',
	            'check_nospace' => '空白文字またはスペースは利用できません',
	            'check_exist_email_update' => '既に登録されているメールアドレスです。',
	            'check_format_password' => '%sは「半角英数字記号」8文字以上を入力してください。',
	            'not_allow_japanese_chars' => '%sは「半角英数字記号」8文字以上を入力してください。',
	            'check_password_same' => 'ログインパスワードと企業情報変更パスワードは同じものを使用出来ません。',
	            'check_isset_password_reward' => 'ログインパスワードと企業情報変更パスワードは同じものを使用出来ません。',
	            'check_isset_password_login'=>'ログインパスワードと企業情報変更パスワードは同じものを使用出来ません。'
			);
		$this->form_validation->set_rules($validation);
        $this->form_validation->set_message($message);
        if($this->form_validation->run() == FALSE){
        	return FALSE;
        }else{
        	return TRUE;
        }
	}  

	public function valid_all_support($name){
		$this->form_validation->set_message('required', '%sを入力してください');
		$validation = config_item($name);
		$message = array(
	            'required' => '%sを入力してください。',
	            'max_length' => '{field}は{param}文字以内で入力してください。',
	            'min_length' => '{field}は「半角英数字記号」{param}文字以上を入力してください。',
	            'check_valid_discount_add' => '購入者割引の「円」か「％」のいずれかを入力してください。',
	            'check_valid_discount_input_add' => '購入者割引は「円」か「％」のいずれかを入力してください。',
	            'check_valid_reward_point_add' =>  '購入者割引の「円」か「％」のいずれかを入力してください。',
	            'check_valid_reward_point_input_add' => '販売促進費は「円」か「％」のいずれかを入力してください。',
	            'check_valid_discount' => '購入者割引の「円」か「％」のいずれかを入力してください。',
	            'check_valid_discount_input' => '購入者割引は「円」か「％」のいずれかを入力してください。',
	            'check_valid_reward_point' =>  '購入者割引の「円」か「％」のいずれかを入力してください。',
	            'check_valid_reward_point_input' => '販売促進費は「円」か「％」のいずれかを入力してください。',
	           	'valid_email' => "メールアドレスを正しく入力してください。",
    			'valid_url_format' => "URLを正しく入力してください。",
	            'numeric' => "%sを正しく入力してください。",
	            'check_format_time_support' => '%sを正しく入力してください。 (HH:mm)',
	            'check_format_date_support' => '%sを正しく入力してください。（例：1990/01/01）',
	            //'check_valid_time_support' => '応援対象時間Toは応援対象時間Fromよりも後の日付を指定してください。',
	            'check_valid_reward_group_all' => '現在は通常応援以外は選択できません。',
	            'check_valid_time_support_add' => '応援対象時間Toは応援対象時間Fromよりも後の日付を指定してください。',
	            'check_valid_reward_group_add' => '現在は通常応援以外は選択できません。',
	            'check_max_length' => '応援内容説明は2,000文字以内で入力してください。',
	            'check_nospace' => '空白文字またはスペースは利用できません',
	            'check_exist_email_update' => '既に登録されているメールアドレスです。',
	            'check_format_password' => '%sは「半角英数字記号」8文字以上を入力してください。',
	            'not_allow_japanese_chars' => '%sは「半角英数字記号」8文字以上を入力してください。',
	            'check_password_same' => 'ログインパスワードと企業情報変更パスワードは同じものを使用出来ません。',
	            'check_isset_password_reward' => 'ログインパスワードと企業情報変更パスワードは同じものを使用出来ません。',
	            'check_isset_password_login'=>'ログインパスワードと企業情報変更パスワードは同じものを使用出来ません。'
		);
		
		$this->form_validation->set_rules($validation);
        $this->form_validation->set_message($message);
        if($this->form_validation->run() == FALSE){
        	return FALSE;
        }else{
        	return TRUE;
        }
	}

	public function count_data_empty($data_update){
		$tmp = array();
		$i = 0;
		foreach($data_update as $k => $v){
			if($i < 13){
			$tmp[$k] = $v;
		}
		$i++;
		}
		unset($tmp['active_flag']);
		unset($tmp['form_has_data']);
		return count(array_filter($tmp)); 
	}

	public function update_support_empty(){
		if($this->input->post()){
			$data['scripts'] = array('update_support_company.js');
			$company_info = $this->Company_model->get_company_information($this->cid);
			$data['company_info'] = $company_info;
			$this->layout->setLayout('frontend/layout/layout');
			/* CHECK VALID FORM */
          	
        	$count = $this->count_data_empty($this->input->post());
        if($count > 1){
        	$update = $this->valid_support_update('update_support_validation');
        	if($update === FALSE) {
        		$this->layout->view('frontend/company/edit_support_no_active',$data);
        	}
        	else{/* IF NOT HAVE ERROR UPDATE */

        			$this->check_update_company_email(); // Update email
			        $this->check_update_company_password_login(); // Update password login
			        $this->check_update_company_password_reward(); // Update password reward

					$data_update = $this->input->post();
					/* CHECK IF HAVE EVENT ADD DATA SUPPORT SECOND */					
					$current = $this->count_all_field_empty($data_update); 
					
					// -3 là các input hidden
					if($this->input->post('password_login') || $this->input->post('password_reward')){
								$total_data = count(array_filter($data_update)) - 5;
							}else{
								$total_data = count(array_filter($data_update)) - 6;
							}

					/* IF HAVE DATA EVENT ADD SUPPORT */ 	
					if($total_data > $current){
						if($this->valid_all_support('all_support_validation') === FALSE)
						{
							$this->layout->view('frontend/company/edit_support_no_active',$data);
					}else{
							$data_first = $this->data_support_first($data_update);
							$this->update_support_event($data_first,1);  
							$data_second = $this->data_support_second($data_update);
							$this->add_support_event($data_second,NULL,0);
							redirect('company/detail');	
						}	
					}
					else{
						$this->update_support_event($data_update,1);
						redirect('company/detail');    
					}
	        }/* END NOT HAVE ERROR UPDATE */
	     }else{ /*NOT INPUT THEN UPDATE EMAIL COMPANY*/

	     	$update_empty = $this->valid_support_update('update_support_empty');
	        	if($update_empty === FALSE) {
	        		$this->layout->view('frontend/company/edit_support_no_active',$data);
	        	}else{
		        	$this->check_update_company_email(); // Update email
					$this->check_update_company_password_login(); // Update password login
					$this->check_update_company_password_reward(); // Update password reward
					redirect('company/detail');	
	        	}
        	
        }				
	}

	}

	public function check_update_company_email(){
		if(!empty($this->input->post('mail'))){
			$data = ['mail'=>$this->input->post('mail')];
			$this->Company_model->update_email($data,$this->cid);
		}
		return TRUE;

	}

	public function check_isset_password_reward(){
		if(!empty($this->input->post('password_login')) && empty($this->input->post('password_reward'))){
			$password_reward = $this->Company_model->check_password_reward($this->cid);
			$password_login  = md5(mb_convert_encoding($this->input->post('password_login').$this->salt,"SJIS", "ASCII")); 
			if($password_reward == $password_login){
				return FALSE;
			}else{
				return TRUE;
			}
		}
		return TRUE;
	}

	public function check_isset_password_login(){
		if(!empty($this->input->post('password_reward')) && empty($this->input->post('password_login'))){
			$password_login = $this->Company_model->check_password_login($this->cid);
			$password_reward  = md5(mb_convert_encoding($this->input->post('password_reward').$this->salt,"SJIS", "ASCII")); 
			if($password_reward == $password_login){
				return FALSE;
			}else{
				return TRUE;
			}
		}
		return TRUE;
	}

	public function check_update_company_password_login(){
		if(!empty($this->input->post('password_login'))){
			$data_password_login = md5(mb_convert_encoding($this->input->post('password_login').$this->salt,"SJIS", "ASCII")); 
			$data_password_login_length = mb_strlen($this->input->post('password_login'));
			$data = ['password_login'=>$data_password_login,'password_login_length'=>$data_password_login_length];
			$this->Company_model->update_password_login($data,$this->cid);
		}
		return TRUE;
	}

	public function check_update_company_password_reward(){
		if(!empty($this->input->post('password_reward'))){
			$data_password_reward = md5(mb_convert_encoding($this->input->post('password_reward').$this->salt,"SJIS", "ASCII")); 
			$data_password_reward_length = mb_strlen($this->input->post('password_reward'));
			$data = ['password_reward'=>$data_password_reward,'password_reward_length'=>$data_password_reward_length];
			$this->Company_model->update_password_login($data,$this->cid);
		}
		return TRUE;
	}

	public function update_support(){

		$this->is_company_login();
		if($this->input->post('is_check_password')) {
			if($this->check_password()) {
				redirect('company/support');
			}

		} else {
			if($this->session->flashdata('check_password_session')) {
				$this->session->keep_flashdata('check_password_session');
				// code
				$data['scripts'] =  array('update_support_company.js');
				$company_info = $this->Company_model->get_company_information($this->cid);
				$data['company_info'] = $company_info;
				
				$this->layout->setLayout('frontend/layout/layout');
				
				if($this->Support_model->count_support($this->cid) == 1)
				{
					
					$support_active  =   $this->Support_model->get_support_active($this->cid);
					$support_next    =   $this->Support_model->support_next($this->cid,$support_active['reward_from_data']);
					$count  = ($support_next) ? 1 : 0;
					if((1 + $count) == 1){
						$data['flag'] = 0;
						$data['data'] = $support_active;
					}else{
						$data['flag'] = 1;
						$data['data'] = $support_active;
						$data['second_support'] = $support_next;
					}
					$active_flag_first = $support_active['active_flag'];
					$active_flag_second = (isset($data['second_support']['active_flag'])) ? $data['second_support']['active_flag'] : 0 ;
					$active_flag = $active_flag_first + $active_flag_second;
				}else{
					$support_first = $this->Support_model->get_support_first($this->cid,date('Y-m-d'));
					
					$support_second  = ($support_first) ? $this->Support_model->support_next($this->cid,$support_first['reward_from_data']) : "";
					$count  = ($support_second) ? 1 : 0;
					if((1 + $count) == 1){

						$data['flag'] = 0;
						$data['data'] = $support_first;
					}else{

						$data['flag'] = 1;
						$data['data'] = $support_first;
						$data['second_support'] = $support_second;
					}
					$active_flag_first = (isset($support_second['active_flag'])) ? $support_second['active_flag'] : 0 ;
					$active_flag_second = (isset($data['second_support']['active_flag'])) ? $data['second_support']['active_flag'] : 0 ;
					$active_flag = $active_flag_first + $active_flag_second;
				}
				if($this->input->post()){

					/* CHECK VALID FORM */
		          	$update = $this->valid_support_update('update_support_validation');
		        	if($update === FALSE) {
		        	/* IF HAVE ERROR UPDATE */
			        	/* OUTPUT ERROR UPDATE*/	
			        		if(set_value('applied_lowest_price') == ""){
								$data['flag_applied_lowest_price'] = 1;
							}
							if(set_value('reward_from_data') == ""){
								$data['flag_reward_from_data'] = 1;
							}
							if(set_value('reward_to_data') == ""){
								$data['flag_reward_to_data'] = 1;
							}
							if(set_value('reward_from_time') == ""){
								$data['flag_reward_from_time'] = 1;
							}
							if(set_value('reward_to_time') == ""){
								$data['flag_reward_to_time'] = 1;
							}
							if(set_value('discount_price') == ""){
								$data['flag_discount_price'] = 1;
							}
							if(set_value('reward_point') == ""){
								$data['flag_reward_point'] = 1;
							}
							if(set_value('reward_content') == ""){
								$data['flag_reward_content'] = 1;
							}				
			        		$data[set_value('applied_lowest_price')] = set_value('applied_lowest_price');
			        		$data[set_value('reward_from_data')] = set_value('reward_from_data');
			        		$data[set_value('reward_to_data')] = set_value('reward_to_data');
			        		$data[set_value('reward_from_time')] = set_value('reward_from_time');
			        		$data[set_value('reward_to_time')] = set_value('reward_to_time');      	
			        		$data[set_value('discount_price')] = set_value('discount_price');
			        		$data[set_value('reward_point')] = set_value('reward_point');
			        		$data[set_value('reward_content')] = set_value('reward_content');
				        	$this->layout->view('frontend/company/edit_support',$data);
			        	/* OUTPUT ERROR UPDATE*/
			        }else{
			        	/* IF NOT HAVE ERROR UPDATE */


			        		$this->check_update_company_email(); // Update email

			        		$this->check_update_company_password_login(); // Update password login
			        		$this->check_update_company_password_reward(); // Update password reward

							$data_update = $this->input->post();
							$flag = $data_update['flag']; //0 or 1
							/* CHECK IF HAVE EVENT ADD DATA SUPPORT SECOND */					
							$current = $this->count_all_field($data_update);
							// -3 là các input hidden
							
							if($this->input->post('password_login') || $this->input->post('password_reward')){
								$total_data = count(array_filter($data_update)) - 5;
							}else{
								$total_data = count(array_filter($data_update)) - 6;
							}
							//update by son
                            //add files
							/* IF HAVE DATA EVENT ADD SUPPORT */
							if($total_data > $current){
                                $this->uploader->do_upload('companyfile',$this->cid);
								$data['has_error'] = "Errors";
								if($flag == 0){
									//INSERT DATA SUPPORT SECOND
									$this->add_support_event($data_update,$data,0);
								}else{
									// UPDATE DATA BOTH SUPPORT
									if($this->valid_all_support('all_support_validation') === FALSE) {
										$this->layout->view('frontend/company/edit_support',$data);
									}else{
										//UPDATE DATA FIRST SUPPORT
										$data_first = $this->data_support_first($data_update);
										$this->update_support_event($data_first,0);
										
										//UPDATE IF TO NULL
										$tmp_day = date('Y-m-d',strtotime('-1 day',strtotime($data_update['tmp_reward_from_data'])));
										$this->Support_model->update_to_null($tmp_day,$this->cid,$data_update['company_reward_id']);  
										
										//UPDATE DATA SECOND SUPPORT
										$data_second = $this->data_support_second($data_update);
										$this->add_support_event($data_second,$data,1);
										redirect('company/detail');
									}							
								}
							}
							/* ELSE UPDATE SUPPORT CURRENT */ 	
							else{

								$this->update_support_event($data_update,0);
								redirect('company/detail');    
							}
				        }/* END NOT HAVE ERROR UPDATE */	

				}else
				{			
					
					if($active_flag == 0 &&  $this->Support_model->check_any_from($this->cid) == 0){
						$this->layout->view('frontend/company/edit_support_no_active',$data);	
					}else{
						$this->layout->view('frontend/company/edit_support',$data);	
					}				
				}
			}else {
				redirect('company/detail');
			}
		}
	}
	
	public function count_all_field_empty($data_update){
		$tmp = array();
		$i = 0;
		foreach($data_update as $k => $v){
			if($i < 13){
			$tmp[$k] = $v;
		}
		$i++;
		}
		unset($tmp['active_flag']);
		unset($tmp['form_has_data']);
		return count(array_filter($tmp));  
	}

	public function count_all_field($data_update){

		$tmp = array();
		$i = 0;
		foreach($data_update as $k => $v){
			if($i < 14){
			$tmp[$k] = $v;
		}
		$i++;
		}
		unset($tmp['active_flag']);
		unset($tmp['form_has_data']);
		
		return count(array_filter($tmp));  
	}

	public function data_support_first($data_update){
		$tmp = array();
		$i = 0;
		foreach($data_update as $k => $v){
			if($i < 14){
			$tmp[$k] = $v;
		}
		$i++;
		}
		unset($tmp['active_flag']);
		unset($tmp['form_has_data']);
		return $tmp;  
	}

	public function data_support_second($data_update){
		$tmp = array();
		$i = 0;
		foreach($data_update as $k => $v){
		if($i >= 14 && $i < 27 && $k != 'flag' && $k != 'active_flag' && $k != 'form_has_data'){		
			$tmp[$k] = $v;
		}
		$i++;
		}
		
		return $tmp;
		
	}	

	public function update_support_event($data_update,$flag){
		$tmp_update_array = array();
		// Phuc update
		unset($data_update['tmp_reward_group'],$data_update['form_has_data'],$data_update['active_flag'],$data_update['mail'],$data_update['password_reward'],$data_update['password_login']);
		foreach($data_update as $k_update => $v_update)
		{
			if(!empty($v_update))
			{
				$tmp_update_array[$k_update] = $v_update;
			}
		}

		if($tmp_update_array['reward_from_data']){
			$tmp_update_array['reward_from_data'] = date("Y-m-d", strtotime($tmp_update_array['reward_from_data']));
		}
		if($tmp_update_array['reward_to_data']){
			$tmp_update_array['reward_to_data'] = date("Y-m-d", strtotime($tmp_update_array['reward_to_data']));
		}
		if($data_update['discount_price'] == null){
			$tmp_update_array['discount_price'] = 0;
		}
		if($data_update['discount_rate'] == null){
			$tmp_update_array['discount_rate'] = 0;	
		}
		if($data_update['reward_point'] == null){
			$tmp_update_array['reward_point'] = 0;
		}
		if($data_update['reward_point_rate'] == null){
			$tmp_update_array['reward_point_rate'] = 0;
		}
		if($data_update['reward_to_data'] == null){
			$tmp_update_array['reward_to_data'] = NULL;
		}
		if($data_update['reward_to_time'] == null){
			$tmp_update_array['reward_to_time'] = NULL;
		}
		
		$tmp_update_array['update_date'] = date('Y-m-d H:i:s');
    	$tmp_update_array['update_user'] = $this->cid;

    	if($flag == 1){
			$tmp_update_array['delete_flg'] = 0;	
			$tmp_update_array['active_flag'] = 0;	
        	$tmp_update_array['create_date'] = date('Y-m-d H:i:s');
        	$tmp_update_array['create_user'] = $this->cid;
			$tmp_update_array['cid'] = $this->cid;
			unset($data_update['company_reward_id']);
    		$this->Support_model->insert_support_infor($tmp_update_array);
    		//redirect('company/show_detail');
    	}else{
			$this->Support_model->update_support_infor($tmp_update_array,$this->cid,$data_update['company_reward_id']);
			//redirect('company/show_detail');
    	}
		return TRUE;
	}

	public function add_support_event($data_update,$data,$flag){
			
			if($this->valid_support_add('add_support_validation') === FALSE) {
				$this->layout->view('frontend/company/edit_support',$data);
			}else{
	        	$data_add = array();
	        	$data_add['cid'] = $this->cid;
				$data_add['reward_group'] = $data_update['tmp_reward_group'];
				$data_add['reward_from_data'] = $data_update['tmp_reward_from_data'];
				$data_add['reward_to_data'] = empty($data_update['tmp_reward_to_data']) ? null : $data_update['tmp_reward_to_data'];
				$data_add['reward_from_time'] = $data_update['tmp_reward_from_time'];
				$data_add['reward_to_time'] = $data_update['tmp_reward_to_time'];
				$data_add['applied_lowest_price'] = $data_update['tmp_applied_lowest_price'];
				$data_add['discount_price'] = $data_update['tmp_discount_price'] == null ? 0 : $data_update['tmp_discount_price'] ;
				$data_add['discount_rate'] = $data_update['tmp_discount_rate'] == null ? 0 : $data_update['tmp_discount_rate'] ;
				$data_add['reward_point'] = $data_update['tmp_reward_point'] == null ? 0 : $data_update['tmp_reward_point'] ;
				$data_add['reward_point_rate'] = $data_update['tmp_reward_point_rate'] == null ? 0 : $data_update['tmp_reward_point_rate'] ;
				$data_add['reward_content'] = $data_update['tmp_reward_content'];		
				$data_add['delete_flg'] = 0;	
				$data_add['active_flag'] = 0;	
				$data_add['update_date'] = date('Y-m-d H:i:s');
	        	$data_add['update_user'] = $this->cid;
	        	$data_add['create_date'] = date('Y-m-d H:i:s');
	        	$data_add['create_user'] = $this->cid;
				if($flag == 0){	
					//Update if to null
					$tmp_day = date('Y-m-d',strtotime('-1 day',strtotime($data_update['tmp_reward_from_data'])));
					$this->Support_model->update_to_null($tmp_day,$this->cid,$data_update['company_reward_id']);
					//
					$this->Support_model->insert_support_infor($data_add);
					redirect('company/detail');
				}else{
					$this->Support_model->update_support_infor($data_add,$this->cid,$data_update['tmp_company_reward_id']);
				}
				
				//redirect('company/detail');
			}
			return TRUE;
		}

	/**
	 * Display regist support service screen (UC-05)
	 **/
	public function show_regist_support_service() {
		$this->is_company_login();
		if(check_support($this->session->userdata['id']) == 1){
			$data_regist['scripts'] = array('footerFixed.js', 'regist_support_service.js');
			$this->layout->setLayout('frontend/layout/layout');
			if($this->input->post()) {
				$data_regist['introduce_uid'] = $this->input->post('introduce_uid');
				$data_regist['buy_price'] = $this->input->post('buy_price');
				$data_regist['point'] = $this->input->post('point');
				$data_regist['password_point'] = $this->input->post('password_point');
				$this->layout->view('frontend/company/regist_support_service', $data_regist);
			} else {
				$this->layout->view('frontend/company/regist_support_service', $data_regist);
			}
		}
		else{
			redirect('company/detail');
		}
	}


	/**
	 * Display confirm support service screen (UC-06)
	 **/
	public function show_confirm_regist_support_service() {
		$this->is_company_login();

		$data['scripts'] = array('footerFixed.js', 'regist_support_service.js');
		$this->layout->setLayout('frontend/layout/layout');
		if($this->input->post()) {
			$validator = config_item('regist_support_service_validation');
			$message = array(
				'required' => '%sを入力してください。',
	            'max_length' => '{field}は{param}文字以内で入力してください。',
	            'numeric' => '%sを正しく入力してください。',
	            'check_exist_user' => '紹介者IDが間違っています。',
	            'check_required_password_point' => '%sを入力してください。',
	            'check_valid_password_point' => 'ポイント使用パスワードが間違っております。',
	            'check_valid_buy_price' => '%sを正しく入力してください。',
	            'check_valid_point' => '%sを正しく入力してください。',
	            'check_valid_user_point' => 'ポイントが不足しています。',
	            'check_point_greater_buy_price' => '利用ポイントが購入金額を上回っています。',
	            'check_purchase_price_minimum' => '適用最低金額に達していません。'
			);
			$this->form_validation->set_rules($validator);
			$this->form_validation->set_message($message);
			if($this->form_validation->run() == FALSE) {
				$this->layout->view('frontend/company/regist_support_service', $data);
			} else {
				$data['introduce_uid'] = $this->input->post('introduce_uid');
				$data['buy_price'] = $this->input->post('buy_price');
				$data['point'] = $this->input->post('point');
				$data['password_point'] = $this->input->post('password_point');
				$this->layout->view('frontend/company/confirm_support_service', $data);
			}
		} else {
			redirect('company/regist-purchase');
		}
	}

	/**
	 * Check exist user (UC-05)
	 **/
	public function check_exist_user($introduce_uid_name) {
		$result = $this->Company_model->check_exist_user($introduce_uid_name);
		if( ! $result) {
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Check required input item password point when item point enter (UC-05)
	 **/
	public function check_required_password_point() {
		if($this->input->post('point')) {
			if($this->input->post('password_point') == '') {
				return FALSE;
			}
		}
		return TRUE;
	}

	/**
	 * Check password is valid (UC-05)
	 **/
	public function check_valid_password_point($password_point = '') {
		$password_point = md5(mb_convert_encoding($password_point.$this->salt,"SJIS", "ASCII"));
		$uid_name = $this->input->post('introduce_uid');
		$password_point_user = $this->Company_model->get_password_point_by_uid_name($uid_name);
		if($password_point != $password_point_user) {
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Check valid reward group UC-02
	 **/
	public function check_valid_reward_group() {
		if($this->input->post('reward_group') != 1) {
			return FALSE;
		}
		return TRUE;
	}

	public function check_valid_reward_group_add() {
		if($this->input->post('tmp_reward_group') != 1) {
			return FALSE;
		}
		return TRUE;
	}

	public function check_valid_reward_group_all() {
		if($this->input->post('tmp_reward_group') != 1 && $this->input->post('reward_group') != 1) {
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Check buy price is greater than 0 or not
	 **/
	public function check_valid_buy_price() {
		if($this->input->post('buy_price') <= 0) {
			return FALSE;
		}
		return TRUE;
	}

	public function check_valid_point() {
		if( ! empty($this->input->post('point')) && $this->input->post('point') < 0) {
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Show complete regist support service screen (UC-07)
	 **/
	public function show_complete_regist_support_service() {
		$this->is_company_login();
		
		$data['scripts'] = array('footerFixed.js', 'regist_support_service.js');
		$this->layout->setLayout('frontend/layout/layout');
		if($this->input->post()) {
			$validator = config_item('regist_support_service_validation');
			$message = array(
				'required' => '%sを入力してください。',
	            'max_length' => '{field}は{param}文字以内で入力してください。',
	            'numeric' => '%sを正しく入力してください。',
	            'check_exist_user' => '紹介者IDが間違っています。',
	            'check_required_password_point' => '%sを入力してください。',
	            'check_valid_password_point' => 'ポイント使用パスワードが間違っております。',
	            'check_valid_buy_price' => '%sを正しく入力してください。',
	            'check_valid_point' => '%sを正しく入力してください。',
	            'check_valid_user_point' => 'ポイントが不足しています。',
	            'check_point_greater_buy_price' => '利用ポイントが購入金額を上回っています。',
	            'check_purchase_price_minimum' => '適用最低金額に達していません。'
			);
			$this->form_validation->set_rules($validator);
			$this->form_validation->set_message($message);
			if($this->form_validation->run() == FALSE) {
				$this->layout->view('frontend/company/regist_support_service', $data);
			} else {
				// Regist purchase from UC-06 screen
				$data_regist_purchase = array(
					'introduce_uid' => $this->Company_model->get_uid_by_uid_name($this->input->post('introduce_uid')),
					'buy_price' => $this->input->post('buy_price'),
					'point_use' => empty($this->input->post('point')) ? 0 : $this->input->post('point'),
					'buy_time' => date('Y-m-d H:i:s'),
					'company_reward_id' => $this->Company_model->get_support_id_by_cid($this->session->userdata('id')),
					'sales_company_id' => $this->session->userdata('id'),
					'update_date' => date('Y-m-d H:i:s'),
					'update_user' => $this->session->userdata('id'),
					'create_date' => date('Y-m-d H:i:s'),
					'create_user' => $this->session->userdata('id'),
					'delete_flg' => 0
				);

				$buy_id = $this->Company_model->regist_support_service($data_regist_purchase);
				$this->Company_model->update_introduction_count($this->session->userdata('id'));

				// Update user point if use point 
				if($this->input->post('point') != '') {
					$this->Company_model->update_user_point($this->input->post('point'), $this->input->post('introduce_uid'));
				}
				
				// Get information purchase just insert
				$data_purchase = $this->Company_model->get_purchase_by_buy_id($buy_id);
				$data_purchase->introduce_uid_name = $this->Company_model->get_uid_name_by_uid($data_purchase->introduce_uid);

				if($this->input->post('password_point') && $this->input->post('password_point') != '') {
					$leng_password_point = strlen($this->input->post('password_point'));
					$password_point = '';
					for($i = 0; $i < $leng_password_point; $i++) {
						$password_point .= '*';
					}
					$data_purchase->password_point = $password_point;
				}

				$data['data_purchase'] = $data_purchase;
				$this->layout->view('frontend/company/complete_support_service', $data);
			}
		} else {
			redirect('company/regist-purchase');
		}
	}

	/**
	 * Validate format password regist and update company
	 **/
	public function check_format_password($password) {
		if(strlen($password) > 0) {
			$regEx = '/[a-z]/u';
		    $regEx_2 = '/[0-9]/u';
		    $regEx_3 = '/[!@#$%^&*()_=\[\]{};\':"\\|,.<>\/?+-]/u';
		    
			if(preg_match($regEx_2, $password) && preg_match($regEx, $password) && preg_match($regEx_3, $password)) {
	        	return TRUE;
	        }
	        return FALSE;
		}
		return TRUE;
		
	}

	/**
	 * Validate format time support
	 **/
	public function check_format_time_support($time) {
		if($time != '') {
			$regEx = '/^(0[0-9]|[0-9]|1[0-9]|2[0-3]):(0[0-9]|[0-9]|[0-5][0-9])$/u';
			if( ! preg_match($regEx, $time)) {
	        	return FALSE;
	        }
		}
		return TRUE;
	}

	/**
	 * Validate format date support
	 **/
	public function check_format_date_support($date) {
		$empty = '/^\s*$/u';
		$date1 = '/^(0[1-9]|[1-9]|1[0-2])\/(1[0-9]|2[0-9]|0[1-9]|[1-9]|3[01])\/(19|20)\d{2}$/u'; // mm/dd/yyyy
		$date2 = '/^(19|20)\d{2}\/(0[1-9]|[1-9]|1[0-2])\/(1[0-9]|2[0-9]|0[1-9]|[1-9]|3[01])$/u'; // yyyy/mm/dd
		$date3 = '/^(0[1-9]|1[0-2]|[1-9])-(1[0-9]|2[0-9]|0[1-9]|[1-9]|3[01])-(19|20)\d{2}$/u'; // mm-dd-yyyy
		$date4 = '/^(19|20)\d{2}-(0[1-9]|1[0-2]|[1-9])-(1[0-9]|2[0-9]|0[1-9]|[1-9]|3[01])$/u'; // yy-mm-dd

		if($date == null || $date == ''){
			return TRUE;
		} else {
			if(preg_match($date1, $date) || preg_match($date2, $date) || preg_match($date3, $date) || preg_match($date4, $date)){
	        	return TRUE;
	        }
		}
        return FALSE;
	}

	/**
	 * Validate valid time support
	 **/
	public function check_valid_time_support($value_submit, $label) {
		$labels = preg_split('/,/', $label);
	    $time1 = $labels[0];
	    $time2 = $labels[1];
	    $compare = $labels[2];

		$reward_from_data = date("Y-m-d", strtotime($this->input->post('reward_from_data')));
		$reward_to_data = !empty($this->input->post('reward_to_data')) ? date("Y-m-d", strtotime($this->input->post('reward_to_data'))) : NULL;

		$reward_from_time = date("H:i:s", strtotime($this->input->post('reward_from_time')));
		$reward_to_time = !empty($this->input->post('reward_to_time')) ? date("H:i:s", strtotime($this->input->post('reward_to_time'))) : NULL;

		if($reward_from_data == $reward_to_data || $reward_to_data == NULL) {
			if($reward_to_time != NULL) {
				if($reward_from_time >= $reward_to_time) {
					$this->form_validation->set_message('check_valid_time_support',$time1.'は'.$time2.'よりも'.$compare.'の時間を指定してください。');
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	public function check_valid_time_support_add() {
		$reward_from_data = date("Y-m-d", strtotime($this->input->post('tmp_reward_from_data')));
		$reward_to_data = !empty($this->input->post('tmp_reward_to_data')) ? date("Y-m-d", strtotime($this->input->post('tmp_reward_to_data'))) : NULL;

		$reward_from_time = date("H:i:s", strtotime($this->input->post('tmp_reward_from_time')));
		$reward_to_time = !empty($this->input->post('tmp_reward_to_time')) ? date("H:i:s", strtotime($this->input->post('tmp_reward_to_time'))) : NULL;

		if($reward_from_data == $reward_to_data || $reward_to_data == NULL) {
			if($reward_to_time != NULL) {
				if($reward_from_time >= $reward_to_time) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	/**
	 * Not allow Japanese chars
	 **/
	public function not_allow_japanese_chars($password) {
		if(strlen($password) > 0) {
			if(preg_match('/[一-龠]|[ぁ-ゔ]|[ァ-ヴー]|[ａ-ｚＡ-Ｚ０-９]|[々〆〤]/u', $password)) {
				return FALSE;
			}
		}	
		return TRUE;
	}

	/** 
		* Company Billing History By Month	
	**/

	public function billing_history_by_day(){

		$this->is_company_login();
		$this->layout->setLayout('frontend/layout/layout');
		//paginate
        $config = array();
        $params_next = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; 
        $params_prev = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; 
        $url_next  = base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.++$params_next;
        $url_prev  = base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.--$params_prev;
        $config["base_url"] = base_url(). "company/billing-history-by-day/";
        $config["total_rows"] = $this->Purchase_model->count_list_buy($this->cid);
        $config['first_url'] = base_url().'company/billing-history-by-day/1';
        $config["per_page"] = RECORD_PER_PAGE;
        $config["uri_segment"] = 3;       
        if($this->uri->segment(3) == 1 || $this->uri->segment(3) == NULL){
	        $config['full_tag_open'] = '<nav class="pagenation"><a class="forward null" href="">前へ</a>';
	        $config['full_tag_close'] = '<a class="next" href="'.$url_next.'">次へ</a></nav>';		
        }elseif($this->uri->segment(3) == ceil($this->Purchase_model->count_list_buy($this->cid)/RECORD_PER_PAGE)){
			$config['full_tag_open'] = '<nav class="pagenation"><a class="next" href="'.$url_prev.'">前へ</a>';
	    	$config['full_tag_close'] = '<a class="forward null" href="'.$url_prev.'">次へ</a></nav>';
        }else{
        	$config['full_tag_open'] = '<nav class="pagenation"><a class="next" href="'.$url_prev.'">前へ</a>';
	    	$config['full_tag_close'] = '<a class="next" href="'.$url_next.'">次へ</a></nav>';
        }                
         if($this->uri->segment(3) == ceil($this->Purchase_model->count_list_buy($this->cid)/RECORD_PER_PAGE) || $this->uri->segment(3) == NULL || $this->uri->segment(3) == 1){
        	$config['num_links'] = 2;
        } else{
        	$config['num_links'] = 1;
        }   
        $config['prev_link'] = false;
        $config['next_link'] = false;
        $config['first_link'] = false;
   		$config['last_link'] = false;
        $config['display_pages'] = TRUE;
        $config['cur_tag_open'] = '<a class="no1 active">';
        $config['cur_tag_close'] = '</a>';
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;     
        $data['results']= $this->Purchase_model->get_buy_purchase($config["per_page"], ($page-1)*RECORD_PER_PAGE,$this->cid);
        $data["links"] = $this->pagination->create_links();
        $data['total'] = $this->Purchase_model->count_list_buy($this->cid);
		$this->layout->view('frontend/company/billing_history',$data);
	}

	public function billing_history_by_month(){
		$this->is_company_login();
		$this->layout->setLayout('frontend/layout/layout');
        $config = array();
        $params_next = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; 
        $params_prev = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; 
        $url_next  = base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.++$params_next;
        $url_prev  = base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.--$params_prev;
        $config["base_url"] = base_url() . "company/billing-history-by-month/";
        $config["total_rows"] = $this->Purchase_model->count_list_buy_month($this->cid);
        $config['first_url'] = base_url().'company/billing-history-by-month/1';
        $config["per_page"] = RECORD_PER_PAGE;
        $config["uri_segment"] = 3;       
        if($this->uri->segment(3) == 1 || $this->uri->segment(3) == NULL){
	        $config['full_tag_open'] = '<nav class="pagenation"><a class="forward null" href="">前へ</a>';
	        $config['full_tag_close'] = '<a class="next" href="'.$url_next.'">次へ</a></nav>';		
        }elseif($this->uri->segment(3) == ceil($this->Purchase_model->count_list_buy_month($this->cid)/RECORD_PER_PAGE)){
			$config['full_tag_open'] = '<nav class="pagenation"><a class="next" href="'.$url_prev.'">前へ</a>';
	    	$config['full_tag_close'] = '<a class="forward null" href="'.$url_prev.'">次へ</a></nav>';
        }else{
        	$config['full_tag_open'] = '<nav class="pagenation"><a class="next" href="'.$url_prev.'">前へ</a>';
	    	$config['full_tag_close'] = '<a class="next" href="'.$url_next.'">次へ</a></nav>';
        }                
         if($this->uri->segment(3) == ceil($this->Purchase_model->count_list_buy_month($this->cid)/RECORD_PER_PAGE) || $this->uri->segment(3) == NULL || $this->uri->segment(3) == 1){
        	$config['num_links'] = 2;
        } else{
        	$config['num_links'] = 1;
        }           $config['prev_link'] = false;
        $config['next_link'] = false;
        $config['first_link'] = false;
   		$config['last_link'] = false;
        $config['display_pages'] = TRUE;
        $config['cur_tag_open'] = '<a class="no1 active">';
        $config['cur_tag_close'] = '</a>';
        $config['use_page_numbers'] = TRUE;
        //$config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;     
        $data['results']= $this->Purchase_model->get_buy_purchase_month($config["per_page"], ($page-1)*RECORD_PER_PAGE,$this->cid);
        $data["links"] = $this->pagination->create_links();
        $data['total'] = $this->Purchase_model->count_list_buy_month($this->cid);
		$this->layout->view('frontend/company/billing_history_month',$data);
	}

	public function billing_history_where_month(){
		$this->is_company_login();
		$this->layout->setLayout('frontend/layout/layout');
        $config = array();
        $params_next = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; 
        $params_prev = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; 
        $url_next  = base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.++$params_next.'?month='.$_GET['month'];
        $url_prev  = base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.--$params_prev.'?month='.$_GET['month'];
        $config["base_url"] = base_url() . "company/billing-history-month/";
        $config["total_rows"] = $this->Purchase_model->count_list_buy_where_month($_GET['month'],$this->cid);
        $config['first_url'] = base_url().'company/billing-history-month/1'.'?'.http_build_query($_GET, '', "&");
        $config["per_page"] = RECORD_PER_PAGE;
        $config["uri_segment"] = 3;       
        if($this->uri->segment(3) == 1 || $this->uri->segment(3) == NULL){
	        $config['full_tag_open'] = '<nav class="pagenation"><a class="forward null" href="">前へ</a>';
	        $config['full_tag_close'] = '<a class="next" href="'.$url_next.'">次へ</a></nav>';		
        }elseif($this->uri->segment(3) == ceil($this->Purchase_model->count_list_buy_where_month($_GET['month'],$this->cid)/RECORD_PER_PAGE)){
			$config['full_tag_open'] = '<nav class="pagenation"><a class="next" href="'.$url_prev.'">前へ</a>';
	    	$config['full_tag_close'] = '<a class="forward null" href="'.$url_prev.'">次へ</a></nav>';
        }else{
        	$config['full_tag_open'] = '<nav class="pagenation"><a class="next" href="'.$url_prev.'">前へ</a>';
	    	$config['full_tag_close'] = '<a class="next" href="'.$url_next.'">次へ</a></nav>';
        }                
         if($this->uri->segment(3) == ceil($this->Purchase_model->count_list_buy_where_month($_GET['month'],$this->cid)/RECORD_PER_PAGE) || $this->uri->segment(3) == NULL || $this->uri->segment(3) == 1){
        	$config['num_links'] = 2;
        } else{
        	$config['num_links'] = 1;
        }               
        
        $config['prev_link'] = false;
        $config['next_link'] = false;
        $config['first_link'] = false;
   		$config['last_link'] = false;
        $config['display_pages'] = TRUE;
        $config['cur_tag_open'] = '<a class="no1 active">';
        $config['cur_tag_close'] = '</a>';
        $config['use_page_numbers'] = TRUE;
        $config['suffix'] = '?'.http_build_query($_GET, '', "&");
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;     
        $data['results']= $this->Purchase_model->get_buy_purchase_where_month($config["per_page"], ($page-1)*RECORD_PER_PAGE,$_GET['month'],$this->cid);
        $data["links"] = $this->pagination->create_links();
        $data['total'] = $this->Purchase_model->count_list_buy_where_month($_GET['month'],$this->cid);
		$this->layout->view('frontend/company/billing_history_where_month',$data);
	}

	public function detail_billing_history_by_day(){
		$this->is_company_login();
		$this->layout->setLayout('frontend/layout/layout');
        $config = array();
        $params_next = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; 
        $params_prev = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; 
        $url_next  = base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.++$params_next.'?day='.$_GET['day'];
        $url_prev  = base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.--$params_prev.'?day='.$_GET['day'];
        $config["base_url"] = base_url() . "company/detail-billing-history-by-day/";
        $config["total_rows"] = $this->Purchase_model->count_detail_list_buy($_GET['day'],$this->cid);
        $config['first_url'] = base_url().'company/detail-billing-history-by-day/1'.'?'.http_build_query($_GET, '', "&");
        $config["per_page"] = RECORD_PER_PAGE;
        $config["uri_segment"] = 3;       
        if($this->uri->segment(3) == 1 || $this->uri->segment(3) == NULL){
	        $config['full_tag_open'] = '<nav class="pagenation"><a class="forward null" href="">前へ</a>';
	        $config['full_tag_close'] = '<a class="next" href="'.$url_next.'">次へ</a></nav>';		
        }elseif($this->uri->segment(3) == ceil($this->Purchase_model->count_detail_list_buy($_GET['day'],$this->cid)/RECORD_PER_PAGE)){
			$config['full_tag_open'] = '<nav class="pagenation"><a class="next" href="'.$url_prev.'">前へ</a>';
	    	$config['full_tag_close'] = '<a class="forward null" href="'.$url_prev.'">次へ</a></nav>';
        }else{
        	$config['full_tag_open'] = '<nav class="pagenation"><a class="next" href="'.$url_prev.'">前へ</a>';
	    	$config['full_tag_close'] = '<a class="next" href="'.$url_next.'">次へ</a></nav>';
        }
        if($this->uri->segment(3) == ceil($this->Purchase_model->count_detail_list_buy($_GET['day'],$this->cid)/RECORD_PER_PAGE) || $this->uri->segment(3) == NULL || $this->uri->segment(3) == 1){
        	$config['num_links'] = 2;
        } else{
        	$config['num_links'] = 1;
        }               
        
        $config['prev_link'] = false;
        $config['next_link'] = false;
        $config['first_link'] = false;
   		$config['last_link'] = false;
        $config['display_pages'] = TRUE;
        $config['cur_tag_open'] = '<a class="no1 active">';
        $config['cur_tag_close'] = '</a>';
        $config['use_page_numbers'] = TRUE;
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;     
        $data['results']= $this->Purchase_model->get_detail_list_buy($config["per_page"], ($page-1)*RECORD_PER_PAGE,$_GET['day'],$this->cid);
        $data["links"] = $this->pagination->create_links();
        $data['total'] = $this->Purchase_model->count_detail_list_buy($_GET['day'],$this->cid);
        //$this->output->enable_profiler();
		$this->layout->view('frontend/company/detail_billing_history_by_day',$data);
	}
	public function delete_billing_history(){
		$this->Purchase_model->delete_billing($_POST['buy_id']);
		redirect('company/detail-billing-history-by-day/'.$_POST['page'].'?day='.$_POST['get_day']);
	}

	/**
	 * Check user point greater than point input
	 **/
	public function check_valid_user_point() {
		if($this->input->post('point') != '') {
			$user_point = $this->Company_model->get_point_user($this->input->post('introduce_uid'));
			if($user_point != FALSE) {
				if($user_point < $this->input->post('point')) {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		}
		return TRUE;
	}

	/**
	 * Check point input greater than buy price input
	 **/
	public function check_point_greater_buy_price() {
		if($this->input->post('point') != '' && ($this->input->post('point') > $this->input->post('buy_price'))) {
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Check required select category at UC-02 and UC-11
	 **/
	public function check_required_category($category_id) {
		if($category_id == '') {
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Check maxlength item reward content at UC-02
	 **/
	public function check_max_length($reward_content) {
		if(mb_strlen($reward_content) > 2000) {
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Check maxlength item tel and  at UC-02 and UC-11
	 **/
	public function check_max_length_tel($tel) {
		return (mb_strlen($tel) <= 5);
	}

	/**
	 * Check date from greater or equal than current date at UC-02 screen
	 **/
	public function check_valid_date_from($from_date) {
		$from_date = date("Y-m-d", strtotime($from_date));
		$current_date = date("Y-m-d", strtotime(date("Y-m-d")));
		if($from_date < $current_date) {
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Check date from greater than date to at UC-02
	 **/
	public function check_date_from_greater_than_date_to($date_submit, $label_array) {
		if($this->input->post('reward_to_data') != '' && $this->input->post('reward_to_time') != '') {
			$labels = preg_split('/,/', $label_array);
		    $time1 = $labels[0];
		    $time2 = $labels[1];
		    $compare = $labels[2];

		    $reward_from_data = date("Y-m-d", strtotime($this->input->post('reward_from_data')));
			$reward_to_data = date("Y-m-d", strtotime($this->input->post('reward_to_data')));

			$reward_from_time = date("H:i:s", strtotime($this->input->post('reward_from_time')));
			$reward_to_time = date("H:i:s", strtotime($this->input->post('reward_to_time')));

			if($reward_from_data == $reward_to_data && $reward_from_time == $reward_to_time) {
				$this->form_validation->set_message('check_date_from_greater_than_date_to',$time1.'は'.$time2.'よりも'.$compare.'の日付を指定してください。');
				return FALSE;
			}
		}
		return TRUE;
	}

	/**
	 * Check no space at UC-02 and UC-11
	 **/
	public function check_nospace($item){
		$str = preg_split('//u',$item,null, PREG_SPLIT_NO_EMPTY);
		foreach ($str as $key => $value) {
			if($value ==  "　" || $value == " "){
				return FALSE;
			}
		}
		return TRUE;
	}


	/*
		Check validate time format HH:ii
	*/
	public function time24($time){
		if($time == null || $time == ''){
				return true;
		}
		if(!preg_match('/^\d{2}:\d{2}$/u', $time)) {
			return false;
		}
		$parts = explode(":",$time);

		if($parts[0] > 23 || $parts[1] > 59) return false;
	    return true;
	}

	
	/**
	 * Check password confirm at UC-11
	 **/
	public function check_password() {
		$validation = config_item('password_confirm_validation');
		$message = array(
                'required' => '企業情報変更パスワードが間違っています。',
                'check_password_confirm' => '企業情報変更パスワードが間違っています。' 
            );
		$this->form_validation->set_rules($validation);
		$this->form_validation->set_message($message);
		if($this->form_validation->run() == FALSE) {
			$cid = $this->session->userdata('id');
			$data_detail['styles'] = array('company.css');
			$company_info =  $this->Company_model->get_company_information($cid);
			$company_info->uid_name = $this->Company_model->get_uid_name_by_uid($company_info->introduce_uid);
			$company_info->check_pass = '';
			$data_detail['company_info'] = $company_info;
			$this->layout->setLayout('frontend/layout/layout');
			$this->layout->view('frontend/company/detail', $data_detail);
		} else {
			$this->session->set_flashdata('check_password_session', 'exist');
			return TRUE;
		}
	}

	/**
	 * Check password confirm at UC-11
	 **/
	public function check_password_confirm() {
		if(mb_strlen($this->input->post('password_confirm')) > 0) {
			$cid = $this->session->userdata('id');
//			$password_input = md5(mb_convert_encoding($this->input->post('password_confirm').$this->salt,"SJIS", "ASCII"));
			$password_input = md5($this->input->post('password_confirm').$this->salt);
			$password_reward = $this->Company_model->get_password_reward_by_id($cid);
			if($password_input != $password_reward) {
				return FALSE;
			}
		}
		return TRUE;
	}

	/**
	 * Check purchase price minimum at UC-05
	 **/
	public function check_purchase_price_minimum($purchase_price) {
		$applied_lowest_price = $this->Company_model->get_applied_lowest_price_by_cid($this->session->userdata('id'));
		if($applied_lowest_price) {
			if($purchase_price < $applied_lowest_price) {
				return FALSE;
			}
		}
		return TRUE;
	}

}

?>