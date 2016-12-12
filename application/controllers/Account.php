<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->config('validation');
		$this->load->model('Company_model','company');
		$this->load->model('Account_model','account');
		$this->load->model('User_model','user');
		$this->load->helper('cookie');
		$this->salt = $this->config->item('salt_password');
	}

	private $salt;

	public function login(){
		$data['title'] = "Login";
		$data['body_css'] = 'login-page';
		$data['styles'] = array('login.css');
		$data['scripts'] = array('login.js');
		$this->layout->setLayout('frontend/layout/layout');

		// Count number of user, company
		$data['count_users'] = $this->account->get_count_users();
		$data['count_companies'] = $this->account->get_count_companies();

		if($this->input->post()){
			$validation = config_item('login_validation');
			$message = array(
				'required'=> '%sを入力してください。',
				'min_length'=>'パスワードは6文字以上です。',
				'max_length'=>'%sは50文字以内で入力してください。'
			);

			$this->form_validation->set_rules($validation);
			$this->form_validation->set_message($message);

			if($this->form_validation->run() == FALSE){
				$this->layout->view('frontend/account/login', $data);
			}
			else{
				$id_input = $this->input->post('id');
				$id = $this->get_login_id($id_input);
				$password = $this->input->post('password');
				$type = $this->get_login_type($id_input);
				$is_remember = $this->input->post('remember');

				if ($this->check_login_type($id_input) and $this->account->resolve_user_login($id, $password, $type)) {
					// Make session and cookie
					$this->account->create_session_cookie($id, $type, $is_remember);
					$this->session->set_flashdata('success', 'Welcome');
	                redirect('/');
					
				} else {
					$this->session->set_flashdata('error', 'IDまたはPASSが間違っています。');
					$this->layout->view('frontend/account/login', $data);
					
				}
			}
		}else{
			//Redirect to index when user logedin
			if($this->is_logged_in()) redirect('/');
			
			$this->layout->view('frontend/account/login',$data);
		}
	}

	// Validate login ID
	public function check_login_type($id){
		$type = substr($id,0,3);
		$id = substr($id,3);
		if(($type == 'JPC' or $type == 'JPU') and is_numeric($id)){
			return true;
		}
		return false;
	}

	private function get_login_type($id){
		$type = substr($id,0,3);
		if($type == 'JPC'){
			return 'company';
		}elseif($type == 'JPU'){
			return 'user';
		}

	}

	private function get_login_id($id){
		//return substr($id,3);
		return $id;
	}

	public function logout(){
		$session_data = $this->session->all_userdata();
		$id = $session_data['id'];
		$type = $session_data['type'];

		$session_remove = array('id','id_name','type','is_member','is_admin');

		$this->session->unset_userdata($session_remove);
		$this->session->sess_destroy();

		delete_cookie("remember_token_takeyani");

		$this->account->delete_remember_token($id, $type);

		$this->session->set_flashdata('success', 'Goodbye');
	    redirect('login');
	}

	public function reset_password(){
		$data['title'] = "パスワード再発行";
		$data['styles'] = array('reset_password.css');
		$data['scripts'] = array('reset_password.js');
		$this->layout->setLayout('frontend/layout/layout');

		$token = $this->input->get('token');

		if(!empty($token)){
			if($this->account->check_reset_token_exist($token) != false){
				$data['token'] = $token;
				$data['account'] = $this->account->get_account_by_reset_token($token);
				$this->layout->view('frontend/account/new_password',$data);
				//redirect('new-password?token='.$token);
			}else{
				$this->layout->view('frontend/account/token_not_found', $data);
			}
		}else{
			if($this->input->post()){
				$validation = config_item('reset_password');
				$message = array(
					'required'=> '%sを入力してください。',
					'max_length'=>'メールアドレスは255文字以内で入力してください。',
					'valid_email'=>'メールアドレスを正しく入力してください。（例：aaaa@aaa.com）',
					'check_exist_email'=> 'メールが見つかりません。',
				);

				$this->form_validation->set_rules($validation);
				$this->form_validation->set_message($message);

				if($this->form_validation->run() == FALSE){
					$this->layout->view('frontend/account/reset_password', $data);
				}
				else{
					$email_input = $this->input->post('email');

					// Check exist email
					$type = $this->account->check_exist_email($email_input);
					if($type != false){
						// Make reset password token
						$token = $this->account->make_reset_password_token($email_input);
						// Get name to add to Email reset password
						$name = $this->account->get_name_for_reset_email($email_input);
						// Sent mail reset
						$this->send_mail($email_input,'ログインパスワード再設定受付(CROSS INFINITY)',$this->reset_password_email_content($token, $name));
						$data['email'] = $email_input;
						$this->layout->view('frontend/account/sent_token_success',$data);
					}else{
						$data['email'] = $email_input;
						$this->session->set_flashdata('error', 'メールが見つかりません。');
						$this->layout->view('frontend/account/reset_password', $data);
					}
				}
			}else{
				$this->layout->view('frontend/account/reset_password',$data);
			}
		}
	}

	public function new_password(){
		$data['title'] = "パスワード再発行";
		$data['styles'] = array('reset_password.css');
		$data['scripts'] = array('reset_password.js');
		$this->layout->setLayout('frontend/layout/layout');

		if($this->input->post()){
			$token = $this->input->post('reset_token');

			$validation = config_item('new_password');
			$validation_user = config_item('new_password_user');
			$message = array(
				'required'=> '%sを入力してください。',
				'max_length' => '{field}は{param}文字以内で入力してください。',
				'min_length' => '{field}は{param}文字以内で入力してください。',
				'check_password_same' => '「新しいログインPASS」と「ログインPASSの再入力」が一致しません。',
				'check_val_password' => '%sは「半角英数字記号」8文字以上を入力してください。',
				'not_allow_japanese_chars' => '%sは「半角英数字記号」8文字以上を入力してください。',
				'check_password_same_two' => '「新しいログインPASS」と「新しい企業情報変更PASS」は同じものを使用出来ません。',
			);

			$account_validation = $this->account->get_account_by_reset_token($token);

			if($account_validation->type == "company"){
				$message = array(
					'check_password_same_two' => '「新しいログインPASS」と「新しい企業情報変更PASS」は同じものを使用出来ません。',
					'check_password_reward_same' => '「新しい企業情報変更PASS」と「企業情報変更PASSの再入力」が一致しません。',
				);
				$this->form_validation->set_rules($validation);
			}
			else{
				$this->form_validation->set_rules($validation_user);
				
			}
			$this->form_validation->set_message($message);

			if($this->form_validation->run() == FALSE){
				$data['token'] = $token;
				$this->layout->view('frontend/account/new_password', $data);
			}
			else{
				if($this->account->check_reset_token_exist($token) != false){
					$account = $this->account->get_account_by_reset_token($token);
					$md5_password = md5(mb_convert_encoding($this->input->post('password').$this->salt,"SJIS", "ASCII"));
					$password_length = strlen($this->input->post('password'));
					$this->account->update_password($account->id, $account->type, $md5_password, $password_length);

					//update password reward in company
					if($account->type == 'company'){
						$md5_password_reward = md5(mb_convert_encoding($this->input->post('password_reward').$this->salt,"SJIS", "ASCII"));
						$password_reward_length = strlen($this->input->post('password_reward'));
						$this->account->upload_password_reward($account->id, $md5_password_reward, $password_reward_length);
					}

					// Get name to add to Email reset password
					$name = $this->account->get_name_for_reset_email($account->email);

					// Send email completed
					$this->send_mail($account->email,'ログインパスワード再設定完了(CROSS INFINITY)',$this->success_reset_password_email_content($account->id_name, $name));

					//redirect('login');
					$this->layout->view('frontend/account/new_password_success',$data);
				}else{
					$this->layout->view('frontend/account/token_not_found', $data);
				}
			}
		}else{
			$this->layout->view('frontend/account/new_password', $data);
		}

	}


	private function reset_password_email_content($token,$name=""){
		$body = '<p>'.$name.' 様<p><br>';
		$body .= '<p>CROSS INFINITY</p><p>自動仮登録メールサービスです。</p><br>';
		$body .='<p>ログインパスワード再設定を受付ました。<br>以下のリンクからパスワード再設定を行ってください。</p>';
		$body .= '<a href="'.base_url('reset-password?token=').$token.'" target="_blank">'.base_url('reset-password?token=').$token.'</a>';
		$body .= '<br><p>※上記リンクからパスワード再設定を行うまでパスワードは設定されません。<br>※尚、本メールは自動発行の為、返信は出来ません。</p><br>';
		$body .= '<p>その他お問い合わせは以下に<br>ご連絡をお願いいたします。<br>qa@cross-infinity.com</p>';

		return $body;
	}

	private function success_reset_password_email_content($id_name,$name=""){
		$body = '<p>'.$name.' 様<p><br>';
		$body .= '<p>CROSS INFINITY</p><p>自動仮登録メールサービスです。</p><br>';
		$body .= '<p>ログインパスワード再設定が完了しました。<br>新たに設定したパスワードでログインして下さい。<br>ID：'.$id_name.'</p>';
		$body .= '<a href="'.base_url('login').'" target="_blank">'.base_url('login').'</a>';
		$body .= '<br><p>※尚、本メールは自動発行の為、返信は出来ません。</p><br>';
		$body .= '<p>その他お問い合わせは以下に<br>ご連絡をお願いいたします。<br>qa@cross-infinity.com</p>';

		return $body;
	}

	public function check_password_same() {
    	if($this->input->post('password') != '' && $this->input->post('confirm_password') != '') {
    		if($this->input->post('password') == $this->input->post('confirm_password')) {
    			return TRUE;
    		}
    	}
    	return FALSE;
    }

    public function check_password_reward_same() {
    	if($this->input->post('password_reward') != '' && $this->input->post('confirm_password_reward') != '') {
    		if($this->input->post('password_reward') == $this->input->post('confirm_password_reward')) {
    			return true;
    		}
    	}
    	return false;
    }

    public function check_exist_email() {
    	if($this->account->check_exist_email($this->input->post('email')) !=false){
    		return TRUE;
    	}
    	return FALSE;
    }

	function readCSV($csvFile){
		$file_handle = fopen($csvFile, 'r');
		while (!feof($file_handle) ) {
			$line_of_text[] = fgetcsv($file_handle, 1024);
		}
		fclose($file_handle);
		return $line_of_text;
	}


	public function not_allow(){
		$data['title'] = "Not allow";
		$this->layout->setLayout('frontend/layout/layout');
		$this->layout->view('frontend/account/not_allow',$data);
	}

	//check password contain number, character and special characters
	public function check_val_password($password){
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
		if(preg_match('/[一-龠]|[ぁ-ゔ]|[ァ-ヴー]|[ａ-ｚＡ-Ｚ０-９]|[々〆〤]/', $password)){
			return false;
		}
		return true;
	}

	 /**
	 * Check validation 2 password is same
	 **/
    public function check_password_same_two() {
    	if($this->input->post('password') != '' && $this->input->post('password_reward') != '') {
    		if($this->input->post('password') == $this->input->post('password_reward')) {
    			return false;
    		}
    	}
    	return true;
    }

}
