<?php

/**
 * Base controllers for different purposes
 * 	- MY_Controller: 
 * 	- Admin_Controller: 
 * 	- API_Controller: 
 */
class MY_Controller extends CI_Controller{
	// Constructor
	public function __construct()
	{
        parent::__construct();
		$this->load->model('Account_model','account');
		$this->load->helper('cookie');
	}

	// Verify user authentication and redirect to URL
	protected function verify_auth($redirect_url = 'login')
	{
        if (!$this->is_logged_in()) {
            redirect($redirect_url);
        }
	}

    protected function is_user_login(){
        $this->verify_auth();
        $session_data = $this->session->all_userdata();

        if ($session_data['type'] == 'user') {
           return true;
        }else{
            redirect('login');
        }
    }

    protected function is_company_login(){
        $this->verify_auth();
        $session_data = $this->session->all_userdata();

        if ($session_data['type'] == 'company') {
           return true;
        }else{
            redirect('login');
        }
    }


    /*
       Session user login
      'id' => $id,
      'type'=>$type,
      'is_member' => TRUE,
      'is_admin' => FALSE
    */
	protected function is_logged_in()
    {
        $session_data = $this->session->all_userdata();
        //if (empty($session_data['id']) or $session_data['is_member'] != TRUE) {
        if (empty($session_data['type'])) {
        	if($this->is_remember() == false){
        		return FALSE;
        	}else{
        		return $this->account->login_with_remember_token($this->is_remember());
        	} 

            return false; 
        }
        return TRUE;
    }

    public function is_remember(){
    	$browser_cookie = $this->input->cookie('remember_token_takeyani', TRUE);
    	if(empty($browser_cookie)){
    		return false;
    	}

    	return $browser_cookie;
    }

    // For admin login check
    protected function is_admin_logged_in()
    {
        $session_data = $this->session->all_userdata();

        if (empty($session_data['uid'])) {
            return FALSE;
        }else{
        	if($session_data['loginuser'] == FALSE){
        		return TRUE;
        	}
        }
        return FALSE;
    }

	// Output JSON string
	protected function render_json($data, $code = 200)
	{
		$this->output
			->set_status_header($code)
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}


	//send mail
	public function send_mail($email,$subject,$body){
     //    $this->email->from('yeucaukhachhang@gmail.com');
	    // $this->email->to($email); 
	    // $this->email->subject($subject);
	    // $this->email->message($body);
	    // $this->email->send();

    	// return $this->email->print_debugger();
        mb_language("uni"); 
        mb_internal_encoding("utf-8"); 

        $headers = "From: ".mb_encode_mimeheader ("Cross Infinity")."<info@cross-infinity.com> \n";
        $headers .= "Reply-To: ".mb_encode_mimeheader ("Cross Infinity")."<info@cross-infinity.com> \n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\n";

        // mb_language("ja");
        // $body = mb_encode_mimeheader($body, "UTF-8","UTF-8");
        $body = $body;
		
		$to = $email;
		$from = $email;


		if(mail($to,$subject,$body,$headers)){
			$errorse =  "送信しました。<br>ご紹介のお友達に確認してね。";
		}
		else{
			$errorse =  "通信エラーです。<br>電波のいい場所でもう一度送信してね。";
		}
		return true;
	}


	// Convert Special char to 2 byte
	public function special_char_to_2byte($string){
		$replace_of = array('"','~','\\','\'',',','.','/','?','!','@','#','$','%','^','&','*','(',')','-','_','=','+','|','{','}','[',']','`',';',':','<','>');
        $replace_by = array('”','～','￥','’' ,'，','．','／','？','！','＠','＃','＄','％','＾','＆','＊','（','）','－','＿','＝','＋','｜','｛','｝','［','］','｀','；','：','＜','＞');									 
        $_result = str_replace($replace_of, $replace_by, $string);
        return $_result;
	}

	public function isLoggedIn() {
        if (!$this->session->userdata('log_in')) {
          redirect('admin_user/display_login_page', 'refresh');
        }
    }
}
