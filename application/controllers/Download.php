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
	*/
	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Company_model');
		$this->salt = $this->config->item('salt_password');

		$this->load->library('ciqrcode');
	}

	public function index($cid,$filename)
	{
		//$name,$cid
		$this->generate_pdf($filename,$cid);
	}
	
	public function generate_qrcode($url = null){

		$params['data'] = $url;
		$params['level'] = 'H';
		$params['size'] = 5;
		$filename = 'qrcode-'.time().'.png';
		$params['savename'] = APPPATH.'upload/qrcode/'.$filename;
		$this->ciqrcode->generate($params);
		
		return $params['savename'];
	}

	public function generate_pdf($filename, $cid){
		$this->verify_auth();

		$session_data = $this->session->all_userdata();

		if($session_data['type'] != 'user' || $session_data['id_name'] == '') return;
		//Specify path to image. The image must have a 96 DPI resolution.
		$watermark = new PDFWatermark($this->generate_qrcode(base_url().'company/regist-purchase/'.$session_data['id_name'])); 

		//Set the position
		$watermark->setPosition('bottomright');

		//Place watermark behind original PDF content. Default behavior places it over the content.
		$watermark->setAsOverlay();

		//Specify the path to the existing pdf, the path to the new pdf file, and the watermark object
		$watermarker = new PDFWatermarker(APPPATH.'upload/'.$cid.'/'.$filename,APPPATH.'upload/'.$cid.'/'.'qrcode-'.$filename,$watermark); 

		//Set page range. Use 1-based index.
		$watermarker->setPageRange(1,5);
		 
		//Save the new PDF to its specified location
		$watermarker->savePdf();

		$href = base_url().'application/upload/'.$cid.'/'.'qrcode-'.$filename;
		header("Location:$href");

	}

}
