<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . "libraries/tcpdf/PDFMerger.php";
 
use PDFMerger\PDFMerger;

class Data extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->library('upload');
		$this->load->library('session');
		$this->load->library('user_agent');

		$this->layouts 	= 'layouts/v_backoffice';
		$this->data 	= array();
	}

	public function index(){
		$this->data['contents'] = 'merger_pdf/v_form';

		$this->load->view($this->layouts, $this->data);
	}

	public function multiple(){
		$this->data['contents'] = 'merger_pdf/v_form_multiple';

		$this->load->view($this->layouts, $this->data);
	}

	public function upload(){
		if($this->input->post()){

			// PREPARE UPLOAD TEMPORARY
	        $total      = count($_FILES['pdf_file']['name']);
	        $path       = './assets/uploads/';
	        $pdf_files  = array();

	        for($i=0; $i< $total; $i++){

	            if(!empty($_FILES['pdf_file']['name'][$i])){

	                $aext       = explode('.',$_FILES['pdf_file']['name'][$i]);
	                $ext        = '.'.end($aext); 
	                $filename   = md5(time().$_FILES['pdf_file']['name'][$i] . $i);
	                $file       = $filename . $ext;

	                $temp       = $_FILES['pdf_file']['tmp_name'][$i];
	                $dest       = $path . $file;

	                if(move_uploaded_file($temp, $dest)){
	                    $pdf_files[] = $file;
	                } else {
	                    $this->session->set_flashdata('error', TRUE);

	                    redirect('data');
	                }

	            } // END IF
	        } // END FOR

	        // MERGER FILES
	        $pdf = new PDFMerger;

	        if($pdf_files){
	            foreach($pdf_files as $file){
	                $pdf->addPDF('./assets/uploads/' . $file, 'all');
	            }

	            $new_file = md5(time().rand(1,10)) .'.pdf';
	            $pdf->merge('file', APPPATH . '../assets/uploads/'.$new_file);

	        } else {
	            $new_file = '';
	        }

	        // REMOVE TEMPORARY FILES
	        if($pdf_files){
	            foreach($pdf_files as $file){
	                @unlink('./assets/uploads/' . $file);
	            }
	        }

	        $this->session->set_flashdata('success', TRUE);
	        $this->session->set_userdata('pdf_file', $new_file);
		}

		redirect($this->agent->referrer());
	}
}
