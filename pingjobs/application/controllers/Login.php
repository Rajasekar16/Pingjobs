<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	public function index()
	{
		$this->load->model('Common_model');
		$data=array();
		$master_data=array();
		$master_data['table_name']='location';
		$master_data['where']=' status=1 ';
		$data['location']=$this->Common_model->get_master($master_data);
		
		//To get the industry / Category
		$master_data=array();
		$master_data['table_name']='industry';
		$master_data['where']=' status=1 ';
		$data['industry']=$this->Common_model->get_master($master_data);

		$data['header']=$this->load->view('includes/header', $data, true);
		$data['top_search']=$this->load->view('includes/top-search', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
		$this->load->view('login',$data);
	}
}
