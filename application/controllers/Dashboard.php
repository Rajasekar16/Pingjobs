<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard  extends CI_Controller {

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
      	$this->load->model('Dashboard_model');
      	$this->load->model('Common_model');
      	$this->load->helper('common');
    }
	
	public function index()
	{
		if(!@$this->session->userdata['loggedin_admin']) {
        	redirect(base_url().'admin');
        }

		$data=array();
		$data['count'] = $this->Dashboard_model->get_dashboard();
		$inputdata['type'] ='date';
		$data['countdata'] = json_encode($this->Dashboard_model->get_dashboard_by_date($inputdata));
		
		$inputdata['type'] ='location_combain';
		$data['locationdata'] = json_encode($this->Dashboard_model->get_dashboard_by_date($inputdata));
		
		$inputdata['type'] ='skill_combain';	
		$data['skilldata'] = json_encode($this->Dashboard_model->get_dashboard_by_date($inputdata));

		$inputdata['type'] ='exprience';	
		$data['expriencedata'] = json_encode($this->Dashboard_model->get_dashboard_by_date($inputdata));
		
		$data['header']=$this->load->view('includes/admin-header', $data, true);
		$data['footer']=$this->load->view('includes/admin-footer', $data, true);
		$this->load->view('dashboard',$data);
	}
}