<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		// $this->verify_auth();
		// $this->is_user_login();
		$this->load->config('validation');
		$this->load->model('User_model');
		$this->load->model('Company_model');
		$this->load->model('Prefecture_model');
		$this->load->model('Support_model');
        $this->load->library("app/uploader");
		$this->salt = $this->config->item('salt_password');
	}
	/*
	QUI ƯỚC CHUNG
	- Tên biến ghi thường, gạch ngang nối và dễ hiểu không dùng k,l,m,n. Ví dụ: user_list, created_at.
	- Toàn bộ query để ở Model và danh sách trả về Object (db->get()->result_object();).
	- Biến ghi giống tên cột trong DB. Ví dụ: uid, username.
	- Nên tách các thành phần trong funcs bằng 1 dòng trống và 1 funcs không nên quá dài.

	Nói chung dễ đọc dễ hiểu là được, ai cũng có thể làm tiếp code của mình mà không la làng là được.
	*/

	public function index()
	{
		

		//$this->is_user_login();
		$data['title'] = "Index";
		$data['body_css'] = 'user-index';
		$data['styles'] = array('style_name.css');
		$data['scripts'] = array('js_name.js');

		$this->layout->setLayout('frontend/layout/layout');
		$this->layout->view('frontend/user/index',$data);
	}

	public function show_menu(){
		//$this->is_user_login();
		$this->verify_auth();
		$data['title'] = "Main Menu";
		$this->layout->setLayout('frontend/layout/layout');
		$this->layout->view('frontend/user/main_menu',$data);
	}

	//user registration  UC13
	public function registration(){
		$data['title'] = "ユーザー登録";
		$data['body_css'] = 'user-register';
		$data['styles'] = array('user.css');
		$data['scripts'] = array('registration.js');
		$this->layout->setLayout('frontend/layout/layout');

		//load data in view
		$data['prefecture'] = $this->Prefecture_model->get_prefecture();

		//submit form
		if( isset($_POST['submit']) ){

			// Validate all field
			$validation = config_item('user_validation');
			$message = array(
                'required'=> '%s を入力してください。',
				'numeric'=> '%s入力してください。',
				'valid_email'=>'メールアドレスを正しく入力してください。',
				'max_length' => '{field}は{param}文字以内で入力してください。',
				'min_length' => '{field}は{param}文字以内で入力してください。',
				'exact_length' => '{field}は{param}文字以内で入力してください。',
				'accept'=>"利用規約への同意は必須です。",
				'not_equalTo_password'=>'ポイント使用パスワードとログインパスワードは同じものを使用出来ません。',
				'email_user_unique'=>'既に登録されているメールアドレスです。',
				'check_required_company_tel'=>'法人連絡先を入力してください。',
				'check_val_password'=>'%sは「半角英数字記号」8文字以上を入力してください。',
				'not_allow_japanese_chars'=>'%sは「半角英数字記号」8文字以上を入力してください。',
				'check_exist_introducer'=>'紹介者IDが見つかりません。',
				'check_nospace'=>'空白文字またはスペースは利用できません。'
            );
			$this->form_validation->set_rules($validation);
			$this->form_validation->set_message($message);
			if($this->form_validation->run() == FALSE){
				$this->layout->view('frontend/user/registration',$data);
			}
			else{
				if($this->input->post('accept') == "on"){
					$data['data_form'] = array(
						'name'=>$this->input->post('name'),
						'name_kana'=>$this->input->post('name_kana'),
						'post_code_left'=>$this->input->post('post_code_left'),
						'post_code_right'=>$this->input->post('post_code_right'),
						'prefecture_id'=>$this->input->post('prefecture'),
						'city'=>$this->input->post('city'),
						'mail'=>$this->input->post('mail'),
						'tel_left'=>$this->input->post('tel_left'),
						'tel_center'=>$this->input->post('tel_center'),
						'tel_right'=>$this->input->post('tel_right'),
						'introduce_uid'=>$this->input->post('introduce_uid'),
						'company_name'=>$this->input->post('company_name'),
						'company_address'=>$this->input->post('company_address'),
						'company_tel_left'=>$this->input->post('company_tel_left'),
						'company_tel_center'=>$this->input->post('company_tel_center'),
						'company_tel_right'=>$this->input->post('company_tel_right'),
						'password_point'=>$this->input->post('password_point'),
						'password_login'=>$this->input->post('password_login')
					);

					$this->layout->view('frontend/user/confirm',$data);
				}
				else{
					$this->layout->view('frontend/user/registration',$data);
				}
			}
		}
		else{
			if(isset($_POST['goback'])){
				$data['data_form'] = array(
					'name'=>$this->input->post('name'),
					'name_kana'=>$this->input->post('name_kana'),
					'post_code_left'=>$this->input->post('post_code_left'),
					'post_code_right'=>$this->input->post('post_code_right'),
					'prefecture_id'=>$this->input->post('prefecture_id'),
					'city'=>$this->input->post('city'),
					'mail'=>$this->input->post('mail'),
					'tel_left'=>$this->input->post('tel_left'),
					'tel_center'=>$this->input->post('tel_center'),
					'tel_right'=>$this->input->post('tel_right'),
					'introduce_uid'=>$this->input->post('introduce_uid'),
					'company_name'=>$this->input->post('company_name'),
					'company_address'=>$this->input->post('company_address'),
					'company_tel_left'=>$this->input->post('company_tel_left'),
					'company_tel_center'=>$this->input->post('company_tel_center'),
					'company_tel_right'=>$this->input->post('company_tel_right'),
					'password_point'=>$this->input->post('password_point'),
					'password_login'=>$this->input->post('password_login')
				);
				$this->layout->view('frontend/user/registration',$data);
			}

			else{
			$this->layout->view('frontend/user/registration',$data);
			}
		}
	}

	//user registration check
	public function confirm(){
		$data['title'] = "ユーザー登録";
		$data['styles'] = array('user.css');
		$this->layout->setLayout('frontend/layout/layout');
		if( isset($_POST['confirm']) ){
			
			//check company tel
			$company_tel = "";
			if(!empty($this->input->post('company_tel_left')) && 
				!empty($this->input->post('company_tel_center')) &&
				!empty($this->input->post('company_tel_right'))){
				$company_tel = $this->input->post('company_tel_left')."-".$this->input->post('company_tel_center')."-".$this->input->post('company_tel_right');
			}

			//check introduce_uid
			$introducer = $this->User_model->get_user_by_uid_name($this->input->post('introduce_uid'));
			if($introducer != false){
				$introduce_uid = $introducer['uid'];
			}
			else{
				$introduce_uid = NULL;
			}
			$password_point_length = strlen($this->input->post('password_point'));
			$password_login_length = strlen($this->input->post('password_login'));
			$data['data_form'] = array(
				'name'=>$this->input->post('name'),
				'name_kana'=>$this->input->post('name_kana'),
				'post_code'=>$this->input->post('post_code_left')."-".$this->input->post('post_code_right'),
				'prefecture_id'=>$this->input->post('prefecture_id'),
				'city'=>$this->input->post('city'),
				'mail'=>$this->input->post('mail'),
				'tel'=>$this->input->post('tel_left')."-".$this->input->post('tel_center')."-".$this->input->post('tel_right'),
				'introduce_uid'=>$introduce_uid,
				'company_name'=>$this->input->post('company_name'),
				'company_address'=>$this->input->post('company_address'),
				'company_tel'=>$company_tel,
				'password_point'=>md5(mb_convert_encoding($this->input->post('password_point').$this->salt,"SJIS", "ASCII")),
				'password_login'=>md5(mb_convert_encoding($this->input->post('password_login').$this->salt,"SJIS", "ASCII")),
				'create_date'=>date("Y-m-d H:i:s"),
				'create_user'=>0,
				'update_date'=>date("Y-m-d H:i:s"),
				'uid_name'=>'JPU000000000',
				'country_id'=>1,
				'delete_flg'=>0,
				'password_point_length'=>$password_point_length,
				'password_login_length'=>$password_login_length
			);
			$uid = $this->User_model->create($data['data_form']);
			$data['view_uid'] = array('uid'=>$uid);
			//send mail
			$this->send_mail($this->input->post('mail'),'仮登録通知(CROSS INFINITY)',$this->send_mail_user($data['data_form']));

			// Create cid name and get bank info to display at complete screen
        	$uid_name = '';
        	$user = $this->User_model->get_user($uid);
        	$country_name = $this->Company_model->get_country_abbreviation($user['country_id']);
        	$uid_name .= $country_name->country_abbreviation.'U';
        	$length_uid = strlen($uid);
        	$number_zero_add = 9 - $length_uid;
        	for($i = 0; $i < $number_zero_add; $i++) {
        		$uid_name .= '0';
        	}
        	$uid_name .= $uid;
			$this->User_model->update_user(array('create_user'=>$uid,'uid_name'=>$uid_name,'update_user'=>$uid),$uid);
		}
		$this->layout->view('frontend/user/success',$data);

	}

	//user registration success
	public function success(){
		$data['title'] = "ユーザー登録";
		$data['styles'] = array('user.css');
		$data['body_css'] = 'user-success';
		// $data['styles'] = array('style_name.css');
		// $data['scripts'] = array('js_name.js');
	}

	//user detail 
	public function detail(){
		$this->is_user_login();
		$data['title'] = "マイページ";
		$data['styles'] = array('user.css');
		$data['body_css'] = 'user-success';
		$data['user'] = $this->User_model->get_user($this->session->userdata['id']);
		$this->layout->setLayout('frontend/layout/layout');
		$this->layout->view('frontend/user/detail',$data);
	}
	
	//account_information
	public function edit(){
		$this->is_user_login();
		$data['title'] = "マイページ編集";
		$data['styles'] = array('user.css');
		$data['body_css'] = 'user-success';
		$data['user'] = $this->User_model->get_user($this->session->userdata['id']);
		$uid = $data['user']['uid'];
		$data['prefecture'] = $this->Prefecture_model->get_prefecture();
		// $data['styles'] = array('style_name.css');
		$data['scripts'] = array('registration.js');
		if(isset($_POST['submit'])){
			// Validate all field
			$validation = config_item('edit_user_validation');
			$message = array(
                'required'=> '%s を入力してください。',
				'numeric'=> '%s入力してください。',
				'valid_email'=>'メールアドレスを正しく入力してください。',
				'max_length' => '{field}は{param}文字以内で入力してください。',
				'min_length' => '{field}は「半角英数字記号」{param}文字以上を入力してください。',
				'exact_length' => '{field}は{param}文字以内で入力してください。',
				'not_equalTo_password'=>'ポイント使用パスワードとログインパスワードは同じものを使用出来ません。',
				'email_user_unique'=>'既に登録されているメールアドレスです。',
				'check_required_company_tel'=>'法人連絡先を入力してください。',
				'check_exist_introducer'=>'紹介者IDが見つかりません。',
				'check_val_password'=>'%sは「半角英数字記号」8文字以上を入力してください。',
				'not_allow_japanese_chars'=>'%sは「半角英数字記号」8文字以上を入力してください。',
				'my_own'=>'自分のIDは入力できません。',
				'check_introduce_create_date'=>'紹介者IDは紹介して頂いた人しか登録できません。',
				'check_nospace'=>'空白文字またはスペースは利用できません。'
            );
			$this->form_validation->set_rules($validation);
			$this->form_validation->set_message($message);
			if($this->form_validation->run() == FALSE){
				
				$data['user'] = array(
					'name'=>$this->input->post('name'),
					'name_kana'=>$this->input->post('name_kana'),
					'post_code'=>$this->input->post('post_code_left')."-".$this->input->post('post_code_right'),
					'prefecture_id'=>$this->input->post('prefecture'),
					'city'=>$this->input->post('city'),
					'mail'=>$this->input->post('mail'),
					'tel'=>$this->input->post('tel_left')."-".$this->input->post('tel_center')."-".$this->input->post('tel_right'),
					'introducer_name'=>$this->input->post('introduce_uid'),
					'company_name'=>$this->input->post('company_name'),
					'company_address'=>$this->input->post('company_address'),
					'company_tel'=>$this->input->post('company_tel_left')."-".$this->input->post('company_tel_center')."-".$this->input->post('company_tel_right'),
					'password_point_length'=>$this->input->post('password_point_length'),
					'password_login_length'=>$this->input->post('password_login_length'),
					'password_point'=>$this->input->post('password_point'),
					'password_login'=>$this->input->post('password_login')
				);

			}
			else{

				//check introduce_uid
				$introducer_name_uid = "";
				if($this->input->post('introduce_uid_name') == $this->input->post('introduce_uid')){
					$introducer_name_uid = $this->input->post('introduce_uid_name');
				}
				else{
					if(empty($this->input->post('introduce_uid'))){
						// print_r("Dung tai day");exit();
						$introducer_name_uid = NULL;
					}
					else{
						$subs_name_uid = substr($this->input->post('introduce_uid'),0,2);
						$count_abbreviation = count($this->User_model->get_country_abbreviation($subs_name_uid));
						if($count_abbreviation > 0){
							$introducer_name_uid = $this->input->post('introduce_uid');
						}
						else{
							$introducer_name_uid = $this->input->post('introduce_uid_name');
						}
					}
					
				}
				$introducer = $this->User_model->get_user_by_uid_name($introducer_name_uid);
				if($introducer != false){
					$introduce_uid = $introducer['uid'];
				}
				else{
					$introduce_uid = NULL;
				}
				//password
				$password_point = NULL;
				$password_login = NULL;
				if(!empty($this->input->post('password_point'))){
					$password_point = md5(mb_convert_encoding($this->input->post('password_point').$this->salt,"SJIS", "ASCII"));
				}
				if(!empty($this->input->post('password_login'))){
					$password_login = md5(mb_convert_encoding($this->input->post('password_login').$this->salt,"SJIS", "ASCII"));
				}
				$password_point_length = !empty($this->input->post('password_point')) ? strlen($this->input->post('password_point')) : NULL;
				$password_login_length = !empty($this->input->post('password_login')) ? strlen($this->input->post('password_login')) :NULL;
				
				//check company tel
				$company_tel = "";
				if((!empty($this->input->post('company_tel_left')) || $this->input->post('company_tel_left') == 0) && 
					(!empty($this->input->post('company_tel_center')) || $this->input->post('company_tel_center') == 0 ) &&
					(!empty($this->input->post('company_tel_right')) || $this->input->post('company_tel_right') == 0)){
					$company_tel = $this->input->post('company_tel_left')."-".$this->input->post('company_tel_center')."-".$this->input->post('company_tel_right');
				}
				if($company_tel == "--"){
					$company_tel = "";
				}
				// var_dump($introduce_uid == NULL ? NULL : $introduce_uid);exit();
				$data['data_form'] = array(
					'name'=>$this->input->post('name'),
					'name_kana'=>$this->input->post('name_kana'),
					'post_code'=>$this->input->post('post_code_left')."-".$this->input->post('post_code_right'),
					'prefecture_id'=>$this->input->post('prefecture'),
					'city'=>$this->input->post('city'),
					'mail'=>$this->input->post('mail'),
					'tel'=>$this->input->post('tel_left')."-".$this->input->post('tel_center')."-".$this->input->post('tel_right'),
					'introduce_uid'=>$introduce_uid == NULL ? NULL : $introduce_uid,
					'company_name'=>$this->input->post('company_name'),
					'company_address'=>$this->input->post('company_address'),
					'company_tel'=>$company_tel,
					'password_point'=>$password_point,
					'password_login'=>$password_login,
					'update_date'=>date("Y-m-d H:i:s"),
					'update_user'=>$uid,
					'password_point_length'=>$password_point_length,
					'password_login_length'=>$password_login_length,
				);

				$this->User_model->update_user($data['data_form'],$uid);
				redirect('/user');
			}
		}
		$this->layout->setLayout('frontend/layout/layout');
		$this->layout->view('frontend/user/edit',$data);
	}

	//user detail 
	public function point_detail(){
		$this->is_user_login();
		$data['title'] = "ポイント詳細";
		$data['styles'] = array('user.css');
		$data['body_css'] = 'user-success';
		$data['scripts'] = array('paging.js');

		$uid = $this->session->userdata['id'];
		$data['user'] = $this->User_model->get_user($uid);
		$data['introduce_point_user'] = $this->User_model->get_introduce_point_user($uid);

		//config paging list
		$data['total'] = count($this->User_model->get_company_payment($uid,NULL,NULL));
		$url = base_url().'user/point-detail';
		$this->paging($data['total'],$url);
		$page = !empty($this->input->get('page')) ? $this->input->get('page') : 1;
        $data['list_company'] = $this->User_model->get_company_payment($uid,RECORD_PER_PAGE, ($page-1)*RECORD_PER_PAGE);
        $to_page = ($page > 1) ? (($page-1)*RECORD_PER_PAGE + 1).'-' : '';
        $from_page = ($data['total'] < $page*RECORD_PER_PAGE) ? $data['total'] : $page*RECORD_PER_PAGE;
		$data['per_page'] = $to_page.$from_page;
		$this->layout->setLayout('frontend/layout/layout');
		$this->layout->view('frontend/user/point_detail',$data);
	}

	//get enterprise support service list
	public function enterprise_support_service_list(){
		$this->is_user_login();
		$data['title'] = "企業応援サービス一覧";
		$data['styles'] = array('swiper.css','user.css');
		$data['scripts'] = array('paging.js');
		$data['body_css'] = 'user-success';
		$data['category'] = $this->User_model->get_category();
		
		//config paging list
		$data['total'] = count($this->Support_model->get_support_company(NULL,NULL));
		$url = base_url().'user/service';
		$this->paging($data['total'],$url);
		$data['page'] = !empty($this->input->get('page')) ? $this->input->get('page') : 1;
        $data['list_support'] = $this->Support_model->get_support_company(RECORD_PER_PAGE, ($data['page']-1)*RECORD_PER_PAGE);
        $to_page = ($data['page'] > 1) ? (($data['page']-1)*RECORD_PER_PAGE + 1).'-' : '';
        $from_page = ($data['total'] < $data['page']*RECORD_PER_PAGE) ? $data['total'] : $data['page']*RECORD_PER_PAGE;
		$data['per_page'] = $to_page.$from_page;


  		$this->layout->setLayout('frontend/layout/layout');
		$this->layout->view('frontend/user/enterprise_support_service_list',$data);
	}

	//get enterprise support service detail
	public function enterprise_support_service_detail(){
		$this->is_user_login();
		$data['title'] = "企業応援サービス詳細";
		$data['body_css'] = 'user-success';
		$data['styles'] = array('swiper.css','user.css');
		$data['scripts'] = array('paging.js');
		$data['category'] = $this->User_model->get_category();

		$company_reward_id = $this->uri->segment(4);
		$data['detail_support'] = $this->Support_model->get_detail_support($company_reward_id);
        $dataFile = $this->uploader->get_all_file($data['detail_support']->cid);
        $data['data_file'] = $dataFile;
		$url = base_url().'user/service/?'.$_SERVER['QUERY_STRING'];
		if($this->input->get('category') != ""){
			$url = base_url().'user/search?'.$_SERVER['QUERY_STRING'];
		}
		if(!empty($this->input->get('address'))){
			$url = base_url().'user/search?'.$_SERVER['QUERY_STRING'];
		}
		if(!empty($this->input->get('station'))){
			$url = base_url().'user/search?'.$_SERVER['QUERY_STRING'];
		}
		if(!empty($this->input->get('company'))){
			$url = base_url().'user/search?'.$_SERVER['QUERY_STRING'];
		}
		if(!empty($this->input->get('reward-point'))){
			$url = base_url().'user/search?'.$_SERVER['QUERY_STRING'];
		}
		$data['url'] = $url;
		$this->layout->setLayout('frontend/layout/layout');
		$this->layout->view('frontend/user/enterprise_support_service_detail',$data);
	}

	//search support 
	public function search(){
		$this->is_user_login();
		$data['title'] = "企業応援サービス一覧";
		$data['styles'] = array('swiper.css','user.css');
		$data['scripts'] = array('paging.js');
		$data['body_css'] = 'user-success';
		$data['category'] = $this->User_model->get_category();

		//tab search category
		if($this->input->get('category') != ""){
			$category = $this->input->get('category');
			$data['search_category'] = $this->User_model->get_category_id($category);
			//config paging list
			$data['total'] = count($this->Support_model->get_search_category($category,NULL,NULL));
			$url = base_url().'/user/search?category='.$category;

			$this->paging($data['total'],$url);
			$data['page'] = !empty($this->input->get('page')) ? $this->input->get('page') : 1;
	        $data['list_category'] = $this->Support_model->get_search_category($category,RECORD_PER_PAGE, ($data['page']-1)*RECORD_PER_PAGE);
	        $to_page = ($data['page'] > 1) ? (($data['page']-1)*RECORD_PER_PAGE + 1).'-' : '';
	        $from_page = ($data['total'] < $data['page']*RECORD_PER_PAGE) ? $data['total'] : $data['page']*RECORD_PER_PAGE;
			$data['per_page'] = $to_page.$from_page;

		}

		//tab search address
		if(!empty($this->input->get('address'))){
			$address = $this->input->get('address');

			//config paging list
			$data['total'] = count($this->Support_model->get_search_address($address,NULL,NULL));
			$url = base_url().'/user/search?address='.$address;

			$this->paging($data['total'],$url);
			$data['page'] = !empty($this->input->get('page')) ? $this->input->get('page') : 1;
	        $data['list_address'] = $this->Support_model->get_search_address($address,RECORD_PER_PAGE, ($data['page']-1)*RECORD_PER_PAGE);
	        $to_page = ($data['page'] > 1) ? (($data['page']-1)*RECORD_PER_PAGE + 1).'-' : '';
	        $from_page = ($data['total'] < $data['page']*RECORD_PER_PAGE) ? $data['total'] : $data['page']*RECORD_PER_PAGE;
			$data['per_page'] = $to_page.$from_page;
		}

		//tab search station
		if(!empty($this->input->get('station'))){
			$station = $this->input->get('station');

			//config paging list
			$data['total'] = count($this->Support_model->get_search_station($station,NULL,NULL));
			$url = base_url().'/user/search?station='.$station;

			$this->paging($data['total'],$url);
			$data['page'] = !empty($this->input->get('page')) ? $this->input->get('page') : 1;
	        $data['list_station'] = $this->Support_model->get_search_station($station,RECORD_PER_PAGE, ($data['page']-1)*RECORD_PER_PAGE);
	        $to_page = ($data['page'] > 1) ? (($data['page']-1)*RECORD_PER_PAGE + 1).'-' : '';
	        $from_page = ($data['total'] < $data['page']*RECORD_PER_PAGE) ? $data['total'] : $data['page']*RECORD_PER_PAGE;
			$data['per_page'] = $to_page.$from_page;

		}

		//tab search company
		if(!empty($this->input->get('company'))){
			$company = $this->input->get('company');

			//config paging list
			$data['total'] = count($this->Support_model->get_search_company($company,NULL,NULL));
			$url = base_url().'/user/search?company='.$company;

			$this->paging($data['total'],$url);
			$data['page'] = !empty($this->input->get('page')) ? $this->input->get('page') : 1;
	        $data['list_company'] = $this->Support_model->get_search_company($company,RECORD_PER_PAGE, ($data['page']-1)*RECORD_PER_PAGE);
	        $to_page = ($data['page'] > 1) ? (($data['page']-1)*RECORD_PER_PAGE + 1).'-' : '';
	        $from_page = ($data['total'] < $data['page']*RECORD_PER_PAGE) ? $data['total'] : $data['page']*RECORD_PER_PAGE;
			$data['per_page'] = $to_page.$from_page;

		}

		//tab search reward point
		if(!empty($this->input->get('reward-point'))){
			$reward_point = $this->input->get('reward-point');
			$reward = $this->input->get('reward');

			//config paging list
			$data['total'] = count($this->Support_model->get_search_reward_point($reward_point,NULL,NULL,$reward));
			$url = base_url().'/user/search?reward-point='.$reward_point.'';

			$this->paging($data['total'],$url);
			$data['page'] = !empty($this->input->get('page')) ? $this->input->get('page') : 1;
	        $data['list_reward_point'] = $this->Support_model->get_search_reward_point($reward_point,RECORD_PER_PAGE, ($data['page']-1)*RECORD_PER_PAGE,$reward);
	        $to_page = ($data['page'] > 1) ? (($data['page']-1)*RECORD_PER_PAGE + 1).'-' : '';
	        $from_page = ($data['total'] < $data['page']*RECORD_PER_PAGE) ? $data['total'] : $data['page']*RECORD_PER_PAGE;
			$data['per_page'] = $to_page.$from_page;
		}

		$this->layout->setLayout('frontend/layout/layout');
		$this->layout->view('frontend/user/enterprise_support_service_list',$data);
	}


	//send mail user
	public function send_mail_user($array){
		$message = "";
		$message .=$array['name']."様<br/></br/><br/>";
		$message .= "CROSS INFINITY<br/>自動仮登録メールサービスです。<br/><br/><br/>";
		$message .="仮登録の受付が完了しました。<br/><br/><br/>";
		$message .="個人証明書として以下のいずれか画像を<br/>メールで送付いただけますと本登録が完了します。<br/><br/><br/>";
		$message .="・免許証<br/>・保険証<br/>・パスポート<br/><br/><br/>";
		$message .="送付メール先：add@cross-infinity.com<br/><br/><br/>" ;
		$message .="その他お問い合わせは以下に<br/>ご連絡をお願いいたします。<br/>qa@cross-infinity.com";

		return $message;
	}
	
	//function paging 
	public function paging($total,$url){
		$data['total'] = $total;
        
        // Config paging
        $config['base_url'] = $url;
        $config['total_rows'] = $data['total'];
        $config['per_page'] = RECORD_PER_PAGE;
        $config['first_url'] = $url;
        $config['num_links'] = 2;

        $config['full_tag_open'] = '<nav class="pagenation">';
        $config['full_tag_close'] = '</nav>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['prev_link'] = '前へ';
        $config['next_link'] = '次へ';

        $config['cur_tag_open'] = '<a class="no1 active">';
        $config['cur_tag_close'] = '</a>';
        $config['display_prev_link'] = TRUE;
        $config['display_next_link'] = TRUE;
        $config['uri_segment']  =  2;

        $config['constant_num_links'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['enable_query_strings'] = TRUE;
        $config['use_page_numbers'] = TRUE;

        // $config['suffix'] = http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);
	}

	//function validation of form user
	public function accept() {
	    if (!empty($this->input->post('accept'))) return true;
	    return false;
	}

	//custom method password point and password login
	public function not_equalTo_password($password){
		$password_login = $this->input->post('password_login');
		$password_point = $this->input->post('password_point');
		$array_point = array($password_login);
		$array_login = array($password_point);

		if($password != ""){
			if( $password == $password_point){
				if( in_array($password, $array_point) ) {
					return false;
				}
			}
			if( $password == $password_login){
				if( in_array($password, $array_login) ) {
					return false;
				}
			}
		}
		return true;
	}

	//function validition email user unique
	public function email_user_unique($mail){
		$user_mail = $this->User_model->check_user_by_mail($mail);
		$company_mail = $this->User_model->check_company_by_mail($mail);
		if($user_mail){
			return false;
		}
		if($company_mail){
			return  false;
		}
		return true;
	}

	//check tel and company_tel enter full 3 textbox
	public function check_required_company_tel($company_tel){
		$company_tel_left = $this->input->post('company_tel_left');
		$company_tel_center = $this->input->post('company_tel_center');
		$company_tel_right = $this->input->post('company_tel_right');
		if(($company_tel == $company_tel_left && $company_tel_left != "")){
			if($company_tel_center == "" || $company_tel_right == ""){
				return false;
			}
		}
		if(($company_tel == $company_tel_center && $company_tel_center != "")){
			if($company_tel_left == "" || $company_tel_right == ""){
				return false;
			}
		}
		if(($company_tel == $company_tel_right && $company_tel_right != "")){
			if($company_tel_center == "" || $company_tel_left == ""){
				return false;
			}
		}
		return true;
	}

	//check password contain number, character and special characters
	public function check_val_password($password){
		// var_dump(preg_match('/[\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]/u',$password));
		switch ($password) {
			case !preg_match('/[a-z]/',$password):
				return false;
				break;
			case !preg_match('/[!@#$%^&*()_=\[\]{};\':"\\|,.<>\/?+-]/',$password):
				return false;
				break;
			case !preg_match('/[0-9]/',$password):
				return false;
				break;
			default:
				return true;
				break;
		}
	}

	// Not allow Japanese chars
	public function not_allow_japanese_chars($password){
		if(preg_match('/[一-龠]+|[ぁ-ゔ]+|[ァ-ヴー]+|[ａ-ｚＡ-Ｚ０-９]+|[々〆〤]+/', $password)){
			return false;
		}
		return true;
	}

	//check exist introducer
	public function check_exist_introducer($introducer){
		if(!empty($introducer)){
			$introduce_uid =  $this->User_model->get_user_by_uid_name($introducer);
			if($introduce_uid == false){
				return false;
			}
			else{
				return true;
			}
		}
		else{
			return true;
		}
	}

	//check id of my own
	public function my_own($id){
		$introduce_uid = $this->User_model->get_user_by_uid_name($id);
		$uid = $this->session->userdata('id');
		if($uid == $introduce_uid['uid']){
			return false;
		}
		else{
			return true;
		}
	}

	//check introduce have create greater than
	public function check_introduce_create_date($uid){

		$introduce_uid = $this->User_model->get_user_by_uid_name($uid);
		$id = $this->session->userdata('id');
		$current_uid = $this->User_model->get_user($id);

		$create_date_introduce = $introduce_uid['create_date'];
		$create_date_current = $current_uid['create_date'];
		if(strtotime($create_date_current) <= strtotime($create_date_introduce)){
			return false;
		}
		else{
			return true;
		}	
	}

	// check no space
	public function check_nospace($item){
		$str = preg_split('//u',$item,null, PREG_SPLIT_NO_EMPTY);
		foreach ($str as $key => $value) {
			if($value ==  "　" || $value == " "){
				return false;
			}
		}
		return true;
	}
}
