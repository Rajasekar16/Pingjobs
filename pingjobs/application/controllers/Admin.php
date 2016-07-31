<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Employer_model');
        $this->load->model('Employee_model');
        $this->load->model('Common_model');
        $this->load->model('Job_model');
        $this->load->helper('common');
		$this->load->library('encrypt');
    }

	public function index()
	{
		if(!@$this->session->userdata['loggedin_admin']) {
        	$this->load->view('admin-login');
        }
		else {
			redirect(base_url().'admin/dashboard');
		}
	}
	
	private function getMasterData($master=array())
	{
		$returnData = array();
		if(empty($master))
			return $returnData;
		
		foreach($master as $table)
		{
			$master_data=array();
			$master_data['table_name']=$table;
			$master_data['where']=' status=1 ';
			$returnData[$table]=$this->Common_model->get_master($master_data);
		}
		return $returnData;
	}
	
	public function _checkAdmin()
	{
		if(!@$this->session->userdata['loggedin_admin']) {
        	redirect(base_url().'admin');
        }
		return true;
	}
	
	public function _loadAdminView($page,$data)
	{
		$data['header']=$this->load->view('includes/admin-header', $data, true);
		$data['footer']=$this->load->view('includes/admin-footer', $data, true);
		$this->load->view($page,$data);
		return true;
	}
	
	public function login()
	{
		$config = array(
		   array( 'field' => 'username', 'label' => 'User name', 'rules' => 'trim|required|valid_email|xss_clean' ),
		   array( 'field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|xss_clean' )
		);
		
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please check the email id and password!</div>');
			redirect(base_url().'admin');
		}
		elseif(isset($_POST['login']))
		{
			$username=$this->input->post('username');
			$password=$this->input->post('password');
			$data=array();
			$data['email']=$username;
			$employer = $this->Employer_model->verify_login($data);
			if(isset($employer['id']))
			{
				$confirmPassword=$this->encrypt->decode($employer['password']);
				if($employer['status']==1 && $password == $confirmPassword)
				{
					$sessiondata = array(
						'id' => $employer['id'],
						'username' => $employer['email'],
						'user_type' => $employer['company_type'],	          
						'loginadmin' => TRUE
					);
					$this->session->set_userdata('loggedin_admin',$sessiondata);
					redirect(base_url().'dashboard');
				}
			}
		}
		$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Login Failed!</div>');
		redirect(base_url().'admin');
	}
	
    public function logout()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
	    $this->session->sess_destroy();
	    redirect(base_url().'admin');
	}
	
	public function employer()
	{
		$this->_checkAdmin();
		$data=array();
		$master_data=array();
		$master_data['table_name']='employer';
		#$master_data['where']=' status !=3';
		$record=$this->Common_model->get_master($master_data);
		if(!empty($record))
		{
			$locations=$this->getLocation();
			$locations=array_column($locations,"name","id");
			$list=array();
			foreach($record as $row)
			{
				//Waiting 
				if($row['status']==0)
				{
					$row['status_class'] = 'grey';	
					$row['status_code'] = 'Waiting';
				}
				//Approved 
				elseif($row['status']==1)
				{
					$row['status_class'] = 'green';
					$row['status_code'] = 'Approved';
				}
				//Approve 
				elseif($row['status']==2)
				{
					$row['status_class'] = 'red';
					$row['status_code'] = 'Approve';
				}
				//Deleted 
				elseif($row['status']==3)
				{
					$row['status_class'] = 'grey';	
					$row['status_code'] = 'Deleted';
				}
				$row['city'] = $locations[$row['city']];
				unset($row['password']);
				unset($row['company_type']);
				unset($row['about_company']);
				unset($row['company_emplyees']);
				unset($row['industry']);
				unset($row['website']);
				unset($row['pincode']);
				unset($row['base_url']);
				$list[]=$row;
			}
			$data['list']=json_encode($list);
		}
		$this->_loadAdminView('employer-master',$data);
	}

	public function getEmployerInputs()
	{
		$data=array();
		$masterData=$this->getMasterData(array('location','state','industry'));
		$data['industry_array']=$masterData['industry'];
		$data['state_array']=$masterData['state'];
		$data['location_array']=$masterData['location'];
		
		$master_data=array();
		$master_data['table_name']='company_type';
		if(!@$this->session->userdata['loggedin_admin'])
			$master_data['where']=' status=1';
		$data['company_type_array']=$this->Common_model->get_master($master_data);
		return $data;
	}
	
	public function addemployer()
	{
		$data=array();
		$data=$this->getEmployerInputs();
		$data['addBy']='admin';
		$this->_loadAdminView('employer-signup',$data);
	}
	
	public function viewemployerprofile($employer_id)
	{
		$this->_checkAdmin();
		
		$data=array();
		$data=$this->getEmployerInputs();
		
		$master_data=array();
		$master_data['table_name']='employer';
		$master_data['where']=' id='.$employer_id;
		$data['employer']=$this->Common_model->get_master($master_data);
		
		if(!empty($data['employer']))
		{
			$locations=array_column($data['location_array'],"state_id","id");
			foreach($data['employer'] AS $index=>$employers)
			{
				$data['employer'][$index]['state'] = $locations[$employers['city']];
			}
		}
		
		$data['addBy']='admin';
		$this->_loadAdminView('employer-signup',$data);
	}
	
	public function create_employee()
	{
		$config = array(
			   array( 'field' => 'company_type','label' => 'Company Type', 'rules'=> 'trim|required|integer|xss_clean' ),
			   array( 'field' => 'contact_person','label' => 'Contact Person', 'rules'=> 'trim|required|xss_clean'),
			   array( 'field' => 'company_name','label' => 'Company Name',  'rules'=> 'trim|required|xss_clean'	),
			   array( 'field' => 'industry','label' => 'Industry',  'rules'=> 'trim|required|integer|xss_clean'),
			   array( 'field' => 'website', 'label' => 'Website',  'rules'=> 'trim|xss_clean' ),
			   array( 'field' => 'company_employes','label' => 'Company Employes', 'rules' => 'trim|required|integer|xss_clean' ),
			   array( 'field' => 'address','label' => 'address',  'rules'=> 'trim|required|xss_clean' ),
			   array( 'field' => 'city','label' => 'city',  'rules'=> 'trim|required|integer|xss_clean' ),
			   array( 'field' => 'pincode','label' => 'pincode', 'rules'=> 'trim|required|numeric|xss_clean' ),
			   array( 'field' => 'contact_no','label' => 'Contact No', 'rules'=> 'trim|required|numeric|xss_clean' ),
			   array( 'field' => 'status','label' => 'status', 'rules'=> 'trim|required|integer|xss_clean' ),
			   array( 'field' => 'about_company','label' => 'About company', 'rules'=> 'trim|required|xss_clean' )
			);
		if($this->input->post('mode') == "create")
		{
			array_push($config,
				array( 'field' => 'email','label' => 'Email', 'rules'=> 'trim|required|valid_email|is_unique[employer.email]|xss_clean' ),
				array( 'field' => 'conf_password','label' => 'Password', 'rules'=> 'trim|required|xss_clean' )
			);
		}
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
			$data=array();
			$data=$this->getEmployerInputs();
			$data['employer']=array($this->input->post());
			$locations=array_column($data['location_array'],"state_id","id");
			$data['employer'][0]['state'] = $locations[$data['employer'][0]['city']];
			$data['addBy']='admin';
			$this->_loadAdminView('employer-signup',$data);
		}
		elseif(!empty($_POST))
		{
			$data = $this->input->post();
			unset($data['state']);
			unset($data['conf_password']);
			$data['password'] = $this->encrypt->encode($data['password']);
			$data['mode'] =trim($data['mode']);
			$success=$this->Employer_model->add_update($data);
			if($success>0)
			{
				if($data['mode']=='create')
				{
				 	$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Employer added successfully.</div>');
					redirect(base_url().'admin/addemployer');
				}
				else
				{
				 	$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Employer updated successfully!</div>');
					redirect(base_url().'admin/viewemployerprofile/'.$data['id']);
				}
			}
			else
			{
				if($data['mode']=='create')
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Sorry, Employer creation Failed!</div>');
					redirect(base_url().'admin/addemployer');
				}
				else
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Sorry, Employer Updated Failed!</div>');
					redirect(base_url().'admin/viewemployerprofile/'.$data['id']);
				}
			}
		}
		else
			redirect(base_url().'admin/addemployer');
	}
	
	public function add_update()
	{
		$this->_checkAdmin();

		$redirect_url='admin';
		if(!empty($_POST))
		{
			$redirect_url=$_POST['redirect_url'];
			unset($_POST['redirect_url']);

			$tableArr=$GLOBALS['tables'];
			$tableId=$_POST['tableId'];
			$tableDetail=$tableArr[$tableId];
			$_POST['table_name']=$tableDetail['tableName'];

			$success=$this->Common_model->add_update($_POST);
			if($success>0)
			{
				if($_POST['mode']=='create')
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Saved successfully!</div>');
				}else
				{
				 	$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Saved successfully!</div>');
				}
			}else
			{
				if($_POST['mode']=='create')
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Save Failed!</div>');
				}else
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Record not changed!</div>');
				}
			}
		}
	   	redirect($redirect_url);
	}

	public function approve_employer()
	{
		$this->_checkAdmin();
		
		$config = array(
			   array( 'field' => 'id','label' => 'Employer ID', 'rules'=> 'trim|required|integer|xss_clean' ),
			);
			
		$json=array();
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$json['status'] = 'err';
			$json['data'] = '';
		}
		elseif(!empty($_POST))
		{
			$sendData=array();
			$sendData['id']=$this->input->post('id');
			$sendData['status']=1;
			$list=$this->Employer_model->update_employer($sendData);	
			if($list>0) {
				$json['status']='ok';
				$json['data']='';
			}
		}
		echo json_encode($json);
	}

	public function postjob()
	{
		$this->_checkAdmin();

		$data=array();
		$data=$this->getMasterData(array('country','location','state','education','job_type','industry','functional','skills'));
		
		$data['json_skills'] = json_encode($data['skills']);
		
		$master_data=array();
		$master_data['table_name']='employer';
		$master_data['where']=' status=1 AND company_type <> 3 ';
		$data['employers']=$this->Common_model->get_master($master_data);
		
	  	$job_id = $this->uri->segment(3, 0);
		if($job_id >0){
			$master_data=array();
			$master_data['table_name']='job';
			$master_data['where']=' id='.$job_id;
			$data['job']=$this->Common_model->get_master($master_data);
		}

		$data['update_url'] = base_url().'admin/jobadd_update';
		$data['addBy']='admin';
		$this->_loadAdminView('postjob',$data);
	}
	
	public function jobadd_update()
	{
		$responseData=array();
		$responseData['status']=AJAX_ERROR;
		$responseData['msg']=AJAX_MSG;
		$responseData['data']=array();
		$sendData=array();
		$status=$msg=$data='';
		if(!empty($_POST))
		{
			$_POST['table_name'] ='job';

			foreach ($_POST as $key => $value)
			{
				$_POST[$key] = clean($value);
			}
			if(@$_POST['mode']=='create')
			{
				$_POST['employer_id'] = @(isset($_POST['employer_id'])) ? $_POST['employer_id'] : $this->session->userdata['loggedin_employer']['id'];
				$_POST['post_date'] = currentGMT('datetime');
			}
			unset($_POST['job_country_id']);
			$success=$this->Common_model->add_update($_POST);
			if($success>0)
			{
				$responseData['status']=AJAX_SUCCESS;
				if($_POST['mode']=='create')
				{
					$responseData['msg']='Job saved successfully!';
				}else
				{
					$responseData['msg']='Job updated successfully!';
				}
			}else
			{ 
				if($_POST['mode']=='create')
				{
				$responseData['msg']='Job save failed!';
				}else
				{
				$responseData['msg']='Job updated failed!';
				}   
			}
		}
		header('Content-Type: application/json');
		echo json_encode($responseData);
		exit;



		/*if(!@$this->session->userdata['loggedin_admin'])
        {
        	redirect('admin');

        }

		if(!empty($_POST))
		{
			$_POST['table_name'] ='job';
			if(@$_POST['mode']=='create')
			{
				$_POST['employer_id'] =@$this->session->userdata['loggedin_employer']['id'];
			}
			$success=$this->Common_model->add_update($_POST);
			if($success>0)
			{
				if($_POST['mode']=='create')
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Job Saved successfully!</div>');
				}else
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Job Saved successfully!</div>');
				}
			}else
			{ 
				if($_POST['mode']=='create')
				{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Job Save Failed!</div>');
				}else
				{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Job Updated Failed!</div>');
			}    
			}
		}
		redirect('admin/jobs'); */
	}
	
	public function jobs()
	{
		$this->_checkAdmin();

		$data=array();
		$sendData=array();
		$sendData['where']=' job_status!=3' ;
		$jobs = $this->Job_model->get_jobs($sendData);
		$record=array();
		if(!empty($jobs))
		{
			foreach($jobs as $row)
			{
				$job_status='Expired';
				$status_class='red';
				if($row['job_status']==1)
				{
					$job_status='Created';
					$status_class='gray';
				}else if($row['job_status']==2)
				{
					$job_status='Approved';
					$status_class='green';
				}else if($row['job_status']==3)
				{
					$job_status='Deleted';
					$status_class='red';
				}
				$row['status_str']=$job_status;
				$row['status_class']=$status_class;
				$row['job_desc'] ='';
				$record[]=$row;
			}
		}
		$data['jobs']=json_encode($record);
		$this->_loadAdminView('list-jobs',$data);
	}
	
	public function applied_job()
	{
		$this->_checkAdmin();      
		$data=array();
		$list = $this->Job_model->get_applied_jobs_for_approve();
		$data['list']=json_encode($list);
		$this->_loadAdminView('job-applied-approve',$data);	
	}
	
	public function approve_job_applied()
	{
		$this->_checkAdmin();

		$json=array();
		$json['status']='err';
		$json['data']='';
		$sendData=array();
		$sendData['id']=$_POST['id'];
		

		$list=$this->Job_model->approve_applied_job($sendData);	
		if($list>0)
		{
			$jobapp_info = $this->Job_model->get_job_applied_info($sendData);
			//print_r($jobapp_info);
			$jobapp_info = $jobapp_info[0];

			$to_mail = $jobapp_info['email'];
			$subject ='Candidate  Apply job the';
			$message =@$jobapp_info['employee_name'].' Has Apply job title '.@$jobapp_info['job_title'];

			$this->load->library('email');
			$this->email->set_mailtype("html");
			$this->email->from('support@ping.com', 'Admin');
			$this->email->to($to_mail);
			$this->email->bcc('sudalaimca87@gmail.com');
			if(strlen(@$jobapp_info['employee_resume_url'])>5)
			{
			$this->email->attach(base_url().'upload/'.@$jobapp_info['employee_resume_url']);
			}
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();
			$this->email->print_debugger();


			$json['data']=$list[0];
			$json['status']='ok';
		}
		echo json_encode($json);
	}
	
	public function employeenew()
	{
		$data=array();
		$this->_checkAdmin();
		$this->_loadAdminView('employee-master',$data);
	}
	
	public function get_allemplyee()
	{
		$this->_checkAdmin();

		$record=$this->Employee_model->get_emplyee();
		foreach($record as $key=>$row)
		{
			$record[$key]['expry'] = 'Exprience : '.$record[$key]['expry'].'.'. $record[$key]['exprm'].' Yrs <BR> Notice Period '.$record[$key]['employee_notice'].' Days <br>Salary : '.$record[$key]['employee_current_salary'].' (L/A)';
			$record[$key]['detail'] = $record[$key]['employee_email'].'<BR>'. $record[$key]['employee_mobile_no'].'<BR>Current :'.$record[$key]['employee_city'].'<BR>Preferred : '.$record[$key]['preferred_location'];

		}
		echo json_encode($record);
	}
	
	public function employee()
	{
		/*$data=array();
		$master_data=array();
		$master_data['table_name']='employee';
		$master_data['where']=' employee_status !=3';
		$record=$this->Common_model->get_master($master_data);		
		$list=array();
		foreach($record as $row)
		{
			$row['status_class']=($row['employee_status']==1)?'green':'grey';
			$row['status_title']=($row['employee_status']==1)?'Active':'In-active';
			$list[]=$row;
		}
		$data['list']=json_encode($list);
		$data['header']=$this->load->view('includes/admin-header', $data, true);
		$data['footer']=$this->load->view('includes/admin-footer', $data, true);
		$this->load->view('employee-master',$data);*/


		$data=array();		
		$this->_loadAdminView('employee-master',$data);
	}

	public function resume_search($type)
	{
		if($type ==1)
		{
			$this->_checkAdmin();
    	}
    	else
    	{
    		if(!@$this->session->userdata['loggedin_employer'])
    		{
    			redirect('login');
    		}
    	}

		$list=array();
		$record=array();
	 	$master_data['table_name']='location';
		$master_data['where']=' status=1 ';
		$data['location']=$this->Common_model->get_master($master_data);
	 	$master_data['table_name']='education';
		$master_data['where']=' status=1 ';
		$data['education']=$this->Common_model->get_master($master_data);

		if(isset($_POST['search']))
		{
			$sendData['skills']=$_POST['skills'];
			$sendData['exp_from']=$_POST['exp_from'];
			$sendData['exp_to']=$_POST['exp_to'];
			$sendData['salary_from']=$_POST['salary_from'];
			$sendData['salary_to']=$_POST['salary_to'];
			$sendData['notice']=$_POST['notice'];
			$sendData['education']=$_POST['education'];
			$sendData['location']=$_POST['location'];
			$sendData=array_filter($sendData);
			$record=$this->Employee_model->resume_search($sendData);
			/*echo $this->db->last_query();
			die();*/
			// echo "<pre>";
			//print_r($record);
			// die;
		}
		if(count($record))
		{
			foreach($record as $row)
			{
				$row['status_class']=($row['employee_status']==1)?'green':'grey';
				$row['status_title']=($row['employee_status']==1)?'Active':'In-active';
				$list[]=$row;
			}
		}
		//print_r($list);die();
		$data['type'] =$type;

		$data['list']=json_encode($list);
		if($type ==1)
		{
			$data['header']=$this->load->view('includes/admin-header', $data, true);
			$data['footer']=$this->load->view('includes/admin-footer', $data, true);
		}
		else
		{
			$data['header']=$this->load->view('includes/header', $data, true);
			$data['footer']=$this->load->view('includes/footer', $data, true);
		}
		$this->load->view('admin_resume_search',$data);
	}

	public function getLocation($location=0)
	{
		$data=array();
		$master_data=array();
		$master_data['table_name']='location';
		$master_data['where']=' status !=3';
		if($location > 0)
			$master_data['where']=' id = '.$location;
		return $this->Common_model->get_master($master_data);
	}
	
	public function location()
	{
		$record=$this->getLocation();
		$list=array();
		foreach($record as $row)
		{
			$row['status_class']=($row['status']==1)?'green':'grey';
			$list[]=$row;
		}
		$data['list']=json_encode($list);
		$this->_loadAdminView('location-master',$data);
	}
	
	public function education()
	{
		$data=array();
		$master_data=array();
		$master_data['table_name']='education';
		$master_data['where']=' status !=3';
		$record=$this->Common_model->get_master($master_data);		
		$list=array();
		foreach($record as $row)
		{
			$row['status_class']=($row['status']==1)?'green':'grey';
			$row['level_name']=($row['level']==1)?'Basic':'Master';
			$list[]=$row;
		}
		$data['list']=json_encode($list);
		$this->_loadAdminView('education-master',$data);
	}
	
	public function functional()
	{
		$data=array();
		$master_data=array();
		$master_data['table_name']='functional';
		$master_data['where']=' status !=3';
		$record=$this->Common_model->get_master($master_data);		
		$list=array();
		foreach($record as $row)
		{
			$row['status_class']=($row['status']==1)?'green':'grey';
			$list[]=$row;
		}
		$data['list']=json_encode($list);
		$this->_loadAdminView('functional-master',$data);
	}

	public function industry()
	{
		$data=array();
		$master_data=array();
		$master_data['table_name']='industry';
		$master_data['where']=' status !=3';
		$record=$this->Common_model->get_master($master_data);		
		$list=array();
		foreach($record as $row)
		{
			$row['status_class']=($row['status']==1)?'green':'grey';
			$list[]=$row;
		}
		$data['list']=json_encode($list);
		$this->_loadAdminView('industry-master',$data);
	}

	public function country()
	{
		$data=array();
		$master_data=array();
		$master_data['table_name']='country';
		$master_data['where']=' status !=3';
		$record=$this->Common_model->get_master($master_data);
		$list=array();
		foreach($record as $row)
		{
			$row['status_class']=($row['status']==1)?'green':'grey';
			$list[]=$row;
		}
		$data['list']=json_encode($list);
		$this->_loadAdminView('country-master',$data);
	}
	
}
?>