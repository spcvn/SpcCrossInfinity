<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
require_once(APPPATH.'libraries/pdfwatermarker/pdfwatermarker.php');
require_once(APPPATH.'libraries/pdfwatermarker/pdfwatermark.php');

class Download extends MY_Controller 
{
	/*
	* Controller Download file png, jpeg, pdf
	* Createdate : 20-03-2017
	* By : Unotrung
	* Require : php-5.6 +gd extention
	*/
	function __construct()
	{
		parent::__construct();

		$this->load->library('ciqrcode');
		$this->load->library('image_lib');
	}

	public function index($cid,$filename)
	{
		/*
		* If login type company will be view file NOT HAS QRcode
		*/
		$this->verify_auth();
		$session_data = $this->session->all_userdata();
		$uid = $session_data['id_name'];
		if($session_data['type'] == 'user'){
			if($this->_filetype($filename) != false){
				if($this->_filetype($filename) === 'pdf'){
					$this->_generate_pdf(urldecode($filename),$cid);
				}else{
					$this->_generate_image($cid,$filename);
				}
			}
			
		}else{
			$href = base_url().'application/upload/'.$cid.'/'.$filename;
			redirect($href);
		}
	}
	
	/*
	* Function create QRcode _generate_qrcode
	* @param : 
	*  	$url : content of qrcode
	*	$uid : uid_name of user
	* @return URL | string
	*/
	private function _generate_qrcode($url = null,$uid){

		$params['data'] = $url;
		$params['level'] = 'H';
		$params['size'] = 3;
		$filename = 'qrcode-'.$uid.'.png';
		if (!file_exists(APPPATH.'upload/qrcode/')) {
		    mkdir(APPPATH.'upload/qrcode/', 0777, true);
		}

		//Check exist QRcode file 
		$params['savename'] = APPPATH.'upload/qrcode/'.$filename;
		if(!file_exists($params['savename'])){
			$this->ciqrcode->generate($params);
		}
		return $params['savename'];
	}

	/*
	* Function add watermask _generate_pdf
	* @param : 
	*  	$filename : name of file
	*	$cid : cid of user | #album 
	* @return redirect to pdf | browser has support pdf viewer
	*/
	private function _generate_pdf($filename, $cid){

		$session_data = $this->session->all_userdata();

		if($session_data['type'] != 'user' || $session_data['id_name'] == '') return;
		//Specify path to image. The image must have a 96 DPI resolution.

		$watermark = new PDFWatermark($this->_generate_qrcode(base_url().'company/regist-purchase/'.$session_data['id_name'],$session_data['id_name'])); 

		//Set the position
		$watermark->setPosition('bottomright');

		//Place watermark behind original PDF content. Default behavior places it over the content.
		$watermark->setAsOverlay();

		//Specify the path to the existing pdf, the path to the new pdf file, and the watermark object
		if (!file_exists(APPPATH.'upload/'.$cid.'/tmp/')) {
		    mkdir(APPPATH.'upload/'.$cid.'/tmp/', 0777, true);
		}

		/*
		* Save file as APPPATH.'upload/'.$cid.'/tmp/'.'qrcode-'.$filename
		*/
		$watermarker = new PDFWatermarker(APPPATH.'upload/'.$cid.'/'.$filename,APPPATH.'upload/'.$cid.'/tmp/'.'qrcode-'.$filename,$watermark); 

		//Set page range. Use 1-based index.
		$watermarker->setPageRange(1,1);
		 
		//Save the new PDF to its specified location
		//Redirect show file pdf
		$watermarker->savePdf();

	}

	/*
	* Function filter file and file type _filetype
	* @param : 
	*  	$filename : name image ex: abc.png
	* @return type of file
	*/
	private function _filetype($filename = null){
		if($filename!= null){
			list($f, $e) = explode('.', $filename);
			if( in_array(strtolower($e),['jpg','jpeg','pdf','png','gif']) ) {
                return strtolower($e);
            }
		}
		return false;
	}

	/*
	* Function add watermask for image _generate_image
	* @param : 
	*	$cid : cid of user | #album 
	*  	$img_src : name image ex: abc.png
	* @return redirect to image | browser has support image viewer
	*/
	private function _generate_image($cid,$img_src)
    {
		$session_data = $this->session->all_userdata();
		$uid = $session_data['id_name'];
    	$qrcode_src = $this->_generate_qrcode(base_url().'company/regist-purchase/'.$uid,$uid);

        $config['image_library'] = 'gd2';
        $config['source_image'] = APPPATH.'upload/'.$cid.'/'.$img_src;
        $config['wm_type'] = 'overlay';
        $config['wm_overlay_path'] = $qrcode_src;
        //the overlay image
        $config['wm_opacity'] = 100;
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'right';
        //show direct image
        $config['dynamic_output'] = TRUE;
        $this->image_lib->initialize($config);
        $this->image_lib->watermark();
    }

}
