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
	public function __construct()
	{
        // Call the Model constructor
        parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Job_model');
	}
	
	public function index()
	{
		$data=array();

		$limit = $this->input->post('noOfJobs');
		//To get the employer
		$master_data=array();
		//When posting the job If admin set premium jobs and enable the below comments
		#$master_data['premium_jobs']=' premium_jobs = 1';
		$master_data['orderby']='post_date';
		$master_data['start']= ($limit) ? $limit : 0;
		$master_data['limit']=($limit) ? 1 : 3;
		$data['jobs']=$this->Job_model->get_jobs($master_data);
		
		if($limit) {
			echo json_encode(array('jobs' => $data['jobs']));
			exit;
		}
		
		$master_data=array();
		$master_data['table_name']='location';
		$master_data['where']=' status=1 ';
		$master_data['order_by']=' name ';
		$data['location']=$this->Common_model->get_master($master_data);
		
		$master_data=array();
		$master_data['table_name']='skills';
		$master_data['where']=' status=1 ';
		$master_data['order_by']=' name ';
		$data['skills']=$this->Common_model->get_master($master_data);
		
		//To get the employer
		$master_data=array();
		$master_data['table_name']='employer';
		$master_data['where']=' status=1 AND premium_employer = 1 ';
		$data['employer']=$this->Common_model->get_master($master_data);
		
		$data['header']=$this->load->view('includes/header', $data, true);
		$data['top_search']=$this->load->view('includes/top-search', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
		$this->load->view('login',$data);
	}
	
	public function subscribe()
	{
		$config = array(
		   array( 'field' => 'subscribe_email', 'label' => 'Email ID', 'rules' => 'trim|required|valid_email|xss_clean|is_unique[subscriber.email_id]' ),
		);
		$this->form_validation->set_message('is_unique', 'Email ID already exists');
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('msg', '<div class="alert-danger text-center">'.validation_errors().'</div>');
			redirect(base_url().'login');
		}
		elseif(isset($_POST['subscribe_email']))
		{
			$subscribeEmail=$this->input->post('subscribe_email');
			$data=array();
			$data['mode']="create";
			$data['table_name']='subscriber';
			$data['email_id']=$subscribeEmail;
			if($this->Common_model->add_update($data) > 0)
			{
				$this->session->set_flashdata('msg', '<div class="alert-success text-center">Subscribed successfully!</div>');
				redirect(base_url().'login');
			}
		}
		redirect(base_url().'login');
	}
}
