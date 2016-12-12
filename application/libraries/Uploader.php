<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
* 
*/
class Uploader
{

    var $config;

 	public function __construct()
    {
        $this->ci =& get_instance();
        $this->config =  array(
            'upload_path'     => "./application/upload/",
            'upload_url'      => base_url()."upload/",
            'allowed_types'   => "jpg|png|jpeg|pdf|doc|docx",
            'overwrite'       => FALSE,
            'max_size'        => "0",
            'encrypt_name'        => FALSE,
        );
    }
    public function do_upload($field = 'userfile'){

//        $this->remove_dir($this->config["upload_path"], false);
        $this->ci->load->library('upload', $this->config);
        $files = $_FILES;
        for($i=0; $i < count($files[$field]['name']); $i++)
        {
            $_FILES[$field]['name']= $files[$field]['name'][$i];
            $_FILES[$field]['type']= $files[$field]['type'][$i];
            $_FILES[$field]['tmp_name']= $files[$field]['tmp_name'][$i];
            $_FILES[$field]['error']= $files[$field]['error'][$i];
            $_FILES[$field]['size']= $files[$field]['size'][$i];
            if($this->ci->upload->do_upload($field)){
                $this->ci->data['status']->message = "File Uploaded Successfully";
                $this->ci->data['status']->success = TRUE;
                $this->ci->data["uploaded_file"] = $this->ci->upload->data();
            }else{
                $this->ci->data['status']->message = $this->ci->upload->display_errors();
                $this->ci->data['status']->success = FALSE;
            }
        }
    }

    function remove_dir($dir, $DeleteMe) {
        if(!$dh = @opendir($dir)) return;
        while (false !== ($obj = readdir($dh))) {
            if($obj=='.' || $obj=='..') continue;
            if (!@unlink($dir.'/'.$obj)) $this->remove_dir($dir.'/'.$obj, true);
        }

        closedir($dh);
        if ($DeleteMe){
            @rmdir($dir);
        }

    }

}
	