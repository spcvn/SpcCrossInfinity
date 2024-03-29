<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
*@category   Uploader
*@author     Son Nguyen <son.nguyen@spc-vn.com>
*/
class Uploader
{

    var $config;

 	public function __construct()
    {
        $this->ci =& get_instance();
        $this->config =  array(
            'root_path'     => "./application/upload/",
            'upload_path'     => "./application/upload/",
            'upload_url'      => base_url()."upload/",
            'allowed_types'   => "gif|jpg|png|jpeg|pdf|txt",
            'overwrite'       => FALSE,
            'max_size'        => "0",
            'encrypt_name'        => FALSE,
        );
    }
    public function do_upload($field = 'userfile',$album = ''){

        // create an album if not already exist in uploads dir
        // wouldn't make more sence if this part is done if there are no errors and right before the upload ??
        $this->config['upload_path'] = $this->config['root_path'] . $album . '/' ;
        if (!is_dir($this->config['upload_path']))
        {
            mkdir($this->config['upload_path'], 0755, true);

        }
//        $this->remove_dir($this->config["upload_path"], false);
        $this->ci->load->library('upload', $this->config);
//        $files = $_FILES;
//        print_r($_FILES);exit;
        foreach($_FILES[$field]['tmp_name'] as $key => $tmp_name) {
            $tmp_name = $_FILES[$field]["tmp_name"][$key];
            $name = basename($_FILES[$field]["name"][$key]);
            if(move_uploaded_file($tmp_name, $this->config['upload_path'] . $name)){
                $this->ci->data['status']->message = "File Uploaded Successfully";
                $this->ci->data['status']->success = TRUE;
            }else{
                $this->ci->data['status']->message = "There was an error uploading the file, please try again!";
                $this->ci->data['status']->success = FALSE;
            }
        }
//        for($i=0; $i < count($files[$field]['name']); $i++)
//        {
//            $_FILES[$field]['name']= $files[$field]['name'][$i];
//            $_FILES[$field]['type']= $files[$field]['type'][$i];
//            $_FILES[$field]['tmp_name']= $files[$field]['tmp_name'][$i];
//            $_FILES[$field]['error']= $files[$field]['error'][$i];
//            $_FILES[$field]['size']= $files[$field]['size'][$i];
//            if($_FILES[$field]['size'] > 0){
//                if($this->ci->upload->do_upload($field)){
//                    $this->ci->data['status']->message = "File Uploaded Successfully";
//                    $this->ci->data['status']->success = TRUE;
//                    $this->ci->data["uploaded_file"] = $this->ci->upload->data();
//                }else{
//                    $this->ci->data['status']->message = $this->ci->upload->display_errors();
//                    $this->ci->data['status']->success = FALSE;
//                }
//            }
//        }
        return true;
    }
    function setDir($dir = false) {
        $this->config['upload_path'] = $this->config['root_path'] . $dir . '/' ;
        if (is_dir($this->config['upload_path'])) {
            return true;
        }
        return false;
    }
    function get_all_file($album = ''){
        $arrFile = [];
        if ($this->setDir($album)) {
            $handle = @opendir($this->config['upload_path']);
            if ($handle) {
                while (false !== ($file = readdir($handle))) {

                    if ($file != "." && $file != "..") {
                        $fullFile =  $this->config['upload_path'] . $file;
                        if (is_file($fullFile)) {
                            $fileinfo = pathinfo($fullFile);
                            $t['file'] = $fullFile;
                            $t['modified'] = filemtime($fullFile);
                            list($f, $e) = explode('.', $file);
                            if( in_array(strtolower($e),['jpg','jpeg']) ) {
                                $t['logo'] = 'jpg.png';
                            }elseif ( strtolower($e) === 'pdf'){
                                $t['logo'] = 'pdf.png';
                            }elseif ( strtolower($e) === 'png'){
                                $t['logo'] = 'png.png';
                            }elseif ( strtolower($e) === 'gif'){
                                $t['logo'] = 'gif.png';
                            }
                            else{
                                $t['logo'] = 'txt.png';
                            }
                            $t['title'] = str_replace('_', ' ', ucfirst($f));
                            array_push($arrFile, $t);
                    }
                    }
                }
                closedir($handle);
                return ($arrFile);
            }
        }
        return false;
    }
    function refactor_dir($album, $currentFiles = null) {
        if ($this->setDir($album)) {
            $handle = @opendir($this->config['upload_path']);
            if ($handle) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        $fullFile =  $this->config['upload_path'] . $file;
                        if (is_file($fullFile) && !in_array($fullFile,$currentFiles)){
                            chmod($fullFile,755);
                            unlink($fullFile);
                        }
                    }
                }
                closedir($handle);
            }
        }
        return true;
    }

}
	