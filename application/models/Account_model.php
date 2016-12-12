<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->salt = $this->config->item('salt_password');

        $this->load->model('Company_model','company');
        $this->load->model('User_model','user');
        $this->load->helper('cookie');
    }

    private $salt;

    public function resolve_user_login($id,$password,$type='user') {

        if($type == 'company'){
            $this->db->select('password_login');
            $this->db->from('t_company');
            $this->db->where('cid_name', $id);

            $md5_password = $this->db->get()->row('password_login');
        }else{
            $this->db->select('password_login');
            $this->db->from('t_user');
            $this->db->where('uid_name', $id);
            $md5_password = $this->db->get()->row('password_login');
        }

        if(empty($md5_password)) return false;

        return $this->verify_password_md5($password, $md5_password);
    }

    // Make MD5 string
    private function md5_password($password) {
        return md5(mb_convert_encoding($password.$this->salt,"SJIS", "ASCII"));
    }

    // Compare password MD5
    private function verify_password_md5($password, $md5_password) {
//        $password = mb_convert_encoding($password.$this->salt,"SJIS", "ASCII");
        if (md5($password) == $md5_password){
            return true;
        }else{
            return false;
        }
    }

    // Auto login if have remember_token
    public function login_with_remember_token($token){
        if($this->user->check_remember_token($token)){
            $user = $this->user->get_user_by_remember_token($token);
            if(empty($user)) return false;

            return $this->create_session_cookie($user->uid_name,'user', true); 
        }

        if($this->company->check_remember_token($token)){
            $company = $this->company->get_company_by_remember_token($token);
            if(empty($company)) return false;

            return $this->create_session_cookie($company->cid_name,'company',true);
        }
        return false;
    }

    // Create session and cookie when login success
    public function create_session_cookie($id, $type, $is_remember){
        $sessiondata = array(
                          'id' => $this->get_id($id),
                          'id_name' => $id,
                          'type'=>$type,
                          'is_member' => TRUE,
                          'is_admin' => FALSE
                        );
        $this->session->set_userdata($sessiondata);
        $this->make_remember_login($id, $type, $is_remember);
        return true;
    }

    private function get_id($id_name){
        return (int)substr($id_name,3);
    }

    // Create remember cookie if check remember_me
    public function make_remember_login($id,$type,$is_remember = false){
        if($is_remember == '1' or $is_remember == true){
            $remember_token = $this->generate_random_string(20);

            $cookie = array(
                'name'   => 'remember_token_takeyani',
                'value'  => $remember_token,
                'expire' => 604800*5,  //5 weeks
            );
            set_cookie($cookie);

            if($type == 'user'){
                $this->user->make_remember_token($this->get_id($id),$remember_token);
            }

            if($type == 'company'){
                $this->company->make_remember_token($this->get_id($id),$remember_token);
            }
            return true;
        }else{
            return false;
        }
    }

    // Delete remember_token in DB
    public function delete_remember_token($id, $type){
        if($type == 'user'){
            $this->user->delete_remember_token($id);
        }

        if($type == 'company'){
            $this->company->delete_remember_token($id);
        }
        return true;
    }

    // Generate random string
    public function generate_random_string($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Get total count users
    public function get_count_users(){
        $this->db->select('uid');
        $this->db->from('t_user');
        $this->db->where('delete_flg', 0);
        //$this->db->where('uid >', 20);
        return $this->db->get()->num_rows();
    }

    // Get total count companies
    public function get_count_companies(){
        $this->db->select('cid');
        $this->db->from('t_company');
        $this->db->where('delete_flg', 0);
        //$this->db->where('cid >', 20);
        return $this->db->get()->num_rows();
    }

    // Create reset password token and save DB
    public function make_reset_password_token($email){
        $reset_token = $this->generate_random_string(20);
        $this->company->make_reset_token($email,$reset_token);
        $this->user->make_reset_token($email,$reset_token);     
        return $reset_token;     
        //return false;
    }

    public function delete_reset_token($email){
        $this->user->delete_reset_token($email);
        $this->company->delete_reset_token($email);
        return true;
    }

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

        if($num_mail_company > 0){
            return 'company';
        }
        if($num_mail_user > 0){
            return 'user';
        }
        return false;
    }

    public function check_reset_token_exist($token){
        $this->db->select('cid');
        $this->db->from('t_company');
        $this->db->where('reset_password_token', $token);
        $this->db->where('delete_flg', 0);
        $_company_rows = $this->db->get();

        if($_company_rows->num_rows() > 0){
            return true;
        }

        $this->db->select('uid');
        $this->db->from('t_user');
        $this->db->where('reset_password_token', $token);
        $this->db->where('delete_flg', 0);
        $_user_rows = $this->db->get();

        if($_user_rows->num_rows() > 0){
            return true;
        }

        return false;
    }


    public function get_account_by_reset_token($token){
        $result = (object)array();

        $this->db->select('*');
        $this->db->from('t_company');
        $this->db->where('reset_password_token', $token);
        $this->db->where('delete_flg', 0);
        $_company_rows = $this->db->get();

        if($_company_rows->num_rows() > 0){
            $result->id = $_company_rows->row()->cid;
            $result->id_name = $_company_rows->row()->cid_name;
            $result->type = 'company';
            $result->email = $_company_rows->row()->mail;
            return $result;
        }

        $this->db->select('*');
        $this->db->from('t_user');
        $this->db->where('reset_password_token', $token);
        $this->db->where('delete_flg', 0);
        $_user_rows = $this->db->get();

        if($_user_rows->num_rows() > 0){
            $result->id = $_user_rows->row()->uid;
            $result->id_name = $_user_rows->row()->uid_name;
            $result->type = 'user';
            $result->email = $_user_rows->row()->mail;
            return $result;
        }

        return false;
    }

    

    public function update_password($id, $type, $md5_password, $password_length = 0){
        $data = array(
            'reset_password_token' => null,
            'password_login' => $md5_password,
            'update_date' => date("Y-m-d H:i:s"),
            'password_login_length' => $password_length
        );

        if($type == 'user'){
            $this->db->where('uid', $id);
            $this->db->update('t_user', $data);
            return true;
        }
        if($type == 'company'){
            $this->db->where('cid', $id);
            $this->db->update('t_company', $data);
            return true;
        }
        return false;
    }

    //upload password reward of company
    public function upload_password_reward($id,$md5_password_reword,$password_reward_length = 0){
        $data = array(
            'password_reward' => $md5_password_reword,
            'password_reward_length' => $password_reward_length
        );
        $this->db->where('cid',$id);
        $this->db->update('t_company', $data);
        return true;
    }

    public function get_name_for_reset_email($email){
        $this->db->select('representative');
        $this->db->from('t_company');
        $this->db->where('mail', $email);
        $this->db->where('delete_flg', 0);
        $name = $this->db->get()->row();
        $name = !empty($name) ? $name->representative : '';

        $this->db->select('name');
        $this->db->from('t_user');
        $this->db->where('mail', $email);
        $this->db->where('delete_flg', 0);
        $name_2 = $this->db->get()->row();

        $name = !empty($name_2) ? $name_2->name : $name;

        return $name;
    }
}