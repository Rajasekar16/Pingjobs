<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobdetails extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
        parent::__construct();
      	//$this->load->model('Employee_model');
      	$this->load->model('Common_model');
      	$this->load->model('Job_model');
    }
	public function index()
	{
		$data=array();
		$data['header']=$this->load->view('includes/header', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
		$this->load->view('job-details',$data);
	}
}
