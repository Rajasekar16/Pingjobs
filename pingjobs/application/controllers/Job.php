<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

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
      	$this->load->model('Employee_model');
      	$this->load->model('Common_model');
      	$this->load->model('Job_model');
      	$this->load->helper('common');
    }
	public function index()
	{
		/*$data=array();
		$data['header']=$this->load->view('includes/header', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
		$this->load->view('Post-job',$data);*/
	}
	public function postjob()
	{
		$data=array();
		$master_data=array();
		  $master_data['table_name']='country';
		  $master_data['where']=' status=1 ';
		  $data['country']=$this->Common_model->get_master($master_data);

		  $master_data['table_name']='location';
		  $master_data['where']=' status=1 ';
		  $data['location']=$this->Common_model->get_master($master_data);

		  $master_data=array();
		  $master_data['table_name']='industry';
		  $master_data['where']=' status=1 ';
		  $data['industry']=$this->Common_model->get_master($master_data);

		   $master_data=array();
		  $master_data['table_name']='education';
		  $master_data['where']=' status=1 ';
		  $data['education']=$this->Common_model->get_master($master_data);


		  $master_data=array();
		  $employer_id =$this->session->userdata['loggedin_employer']['id'];
		  $master_data['table_name']='employer';
		  $master_data['where']=' id='.$employer_id.' ';
		  $data['employer']=$this->Common_model->get_master($master_data);


		  $master_data=array();
		  $master_data['table_name']='functional';
		  $master_data['where']=' status=1 ';
		  $data['functional']=$this->Common_model->get_master($master_data);

	  	$job_id = $this->uri->segment(3, 0);
		if($job_id >0){
			$master_data=array();
			$master_data['table_name']='job';
			$master_data['where']=' id='.$job_id;
			$data['job']=$this->Common_model->get_master($master_data);
		}


		$data['header']=$this->load->view('includes/header', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
		$data['update_url'] = base_url().'job/add_update';
		$this->load->view('postjob',$data);

	}


	public function add_update()
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
				$_POST['employer_id'] =@$this->session->userdata['loggedin_employer']['id'];
				$_POST['post_date'] = currentGMT('datetime');
			}
			$success=$this->Common_model->add_update($_POST);
			if($success>0)
			{
				$responseData['status']=AJAX_SUCCESS;
				if($_POST['mode']=='create')
				{
					$responseData['msg']='Job posted successfully!';
				}else
				{
					$responseData['msg']='Job updated successfully!';
				}
			}else
			{ 
				if($_POST['mode']=='create')
				{
				$responseData['msg']='Job posted failed!';
				}else
				{
				$responseData['msg']='Job updated failed!';
				}   
			}
		}
		header('Content-Type: application/json');
		echo json_encode($responseData);
		exit;
	}

public function listjobs()
{
		$data=array();		
		$employer_id=@$this->session->userdata['loggedin_employer']['id'];
		//echo $employer_id;//die();
		
		$jobs=array();
		if($employer_id>0)
		{
			$sendData=array();
			$sendData['employer_id']=' employer_id='.$employer_id.' and job_status!=3' ;
			$jobs = $this->Job_model->get_jobs($sendData);
		}else
		{
			redirect('login');
		}

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
				$record[]=$row;
			}
		}

		$data['jobs']=json_encode($record);
		// echo "<pre>";
		// print_r($data['job']);die;

		$data['header']=$this->load->view('includes/header', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
		$this->load->view('list-jobs',$data);

	}
	public function delete_job()
	{
		$data=array();
		$data['status']='error';
		$data['data']=array();

		$id=@$_POST['id'];
		if($id>0)
		{
			$dataSend=array();
			$dataSend['id']=$id;
			$dataSend['soft_delete']=1;

			$job=$this->Job_model->delete_job($dataSend);
			if($job>0)
			{
				$data['status']='ok';
			}
		}
		echo json_encode($data);
	}
	public function jobApprove()
	{
		$data=array();
		$data['status']='error';
		$data['data']=array();
		$sendData=array();
		$ids=$_POST['ids'];
		if(count($ids)>0)
		{
			$sendData['ids']=json_decode($ids);
			$job=$this->Job_model->jobApprove($sendData);
			if($job>0)
			{
				$data['status']='ok';
			}
		}
		echo json_encode($data);
	}
	public function job_ajax()
	{
		$total_record=0;
		$limit=2;
		$group_number = filter_var($_POST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		
		//throw HTTP error if group number is not valid
		if(!is_numeric($group_number)){
			header('HTTP/1.1 500 Invalid number!');
			exit();
		}
		
		//get current starting point of records
		$start = ($group_number * $limit);

		$sendData=array();
		$sendData['start']=$start;
		$sendData['limit']=$limit;

		$_POST['search']=1;
		$skills=@$_POST['skills'];
		$location=@$_POST['location'];
		$industry=@$_POST['industry'];
		$experience=@$_POST['experience'];
		$orderby=@$_POST['orderby'];
		$last_days=@$_POST['last_days'];
		$salary=@$_POST['salary'];
		if($skills!='')
		{
			$where_skill='';
			$skills=explode(',', $skills);
			if(count($skills)>0)
			{
				$skill_like=array();
				foreach($skills as $skill)
				{
					$skill_like[]=' job_key_skill like "%'.$skill.'%" ';
				}
				if(count($skill_like)>0)
				{
					$where_skill='('.implode(' OR ', $skill_like).' )';
				}
			}
			if($where_skill!='')
			{
				$sendData['skills']=$where_skill;
			}
		}
		if($location!='' && $location!=0)
		{
			$where_location='';
			$locations=explode(',', $location);
			if(count($locations)>0)
			{
				$location_like=array();
				foreach($locations as $location)
				{
					$location_like[]=' job_location_id ="'.$location .'"';
				}
				if(count($location_like)>0)
				{
					$where_location='('.implode(' OR ', $location_like).' )';
				}
			}
			if($where_location!='')
			{
				$sendData['location']=$where_location;
			}
		}
		if($industry!='' && $industry!=0)
		{
			$where_industry='';
			$industrys=explode(',', $industry);
			if(count($industrys)>0)
			{
				$industry_like=array();
				foreach($industrys as $industry)
				{
					$industry_like[]=' job_industry_id ="'.$industry.'"' ;
				}
				if(count($industry_like)>0)
				{
					$where_industry=' ('.implode(' OR ', $industry_like).' ) ';
				}
			}
			if($where_industry!='')
			{
				$sendData['industry']=$where_industry;
			}
		}
		if($salary!='')
		{
			$where_salary='';
			$salarys=explode(',', $salary);
			if(count($salarys)>0)
			{
				$salary_like=array();
				foreach($salarys as $salary)
				{
					$sal=explode('-', $salary);
					$from=$sal[0];
					$to=$sal[1];
					$salary_like[]=' ( job_salary_from >="'.$from .'" OR job_salary_to <="'.$to .'")';
				}
				if(count($salary_like)>0)
				{
					$where_salary=' ('.implode(' OR ', $salary_like).' ) ';
				}
			}
			if($where_salary!='')
			{
				$sendData['salary']=$where_salary;
			}
		}

		if($experience!='' && $experience>0)
		{
			$sendData['experience']=' ( job_experience_from >="'.$experience .'" OR job_experience_to <= "'.$experience .'") ';
		}

		if($last_days!='' && $last_days>0)
		{
			$last_date=date("Y-m-d H:i:s", strtotime("-".$last_days." days"));
			$sendData['last_days']=' ( job.post_date >="'.$last_date .'" ) ';
		}
		if($orderby!='')
		{
			$sendData['orderby']=$orderby;
		}

		$jobs = $this->Job_model->get_jobs($sendData);
		$job_list=array();
		foreach ($jobs as $job) {

			$job['about_company']=(strlen($job['about_company'])>180 ? substr($job['about_company'], 0,175).'...':$job['about_company']);
			$job['days_ago']=days_ago($job['post_date']);
			$job['days_ago_str']=time_elapsed_string($job['post_date']);
			$job_list[]=$job;
		}
		// echo "<pre>";
		// print_r($job_list);
		// echo $this->db->last_query();	

		if(isset($_POST['get_total_group']))
		{
			$total_record = $this->Job_model->get_total_job($sendData);
		}

		$jsonData['job']=$job_list;
		$jsonData['total_group']=ceil($total_record/$limit);
		echo json_encode($jsonData);
	}

	public function jobSearch()
	{
		$data=array();
		$data['searchSkills']='';
		$data['searchOrderby']='';
		$data['searchLocation']='';
		$data['searchIndustry']='';
		$data['searchExperience']='';
		if(isset($_POST['skills']))
		{
			$data['searchSkills']=@$_POST['skills'];
		}
		//Load the job by location
		if($this->uri->segment(4))
		{
			$jobSearch = explode("-",$this->uri->segment(3));
			if(count($jobSearch) > 1)
			{
				if(strtoupper($jobSearch[0]) == "JOBS")
				{
					$data['searchLocation']=$this->uri->segment(4);
				}
				else
				{
					$data['searchIndustry']=$this->uri->segment(4);
				}
			}
		}
		if(isset($_POST['location']))
		{
			$data['searchLocation']=@$_POST['location'];
		}
		if(isset($_POST['experience']))
		{
			$data['searchExperience']=@$_POST['experience'];
		}
		$sendData=array();
		$jobs = $this->Job_model->get_jobs($sendData);
		$job_list=array();
		foreach ($jobs as $job) {

			$job['about_company']=(strlen($job['about_company'])>180 ? substr($job['about_company'], 0,175).'...':$job['about_company']);
			$job['days_ago']=days_ago($job['post_date']);
			$job['days_ago_str']=time_elapsed_string($job['post_date']);
			$job_list[]=$job;
		}
		// $total_record = $this->Job_model->get_total_job($sendData);
		
		// echo "<pre>";
		// print_r($job_list);
		// die;
		$master_data['table_name']='location';
		$master_data['where']=' status=1 ';
		$data['location']=$this->Common_model->get_master($master_data);

		$master_data['table_name']='industry';
		$master_data['where']=' status=1 ';
		$data['industry']=$this->Common_model->get_master($master_data);

		// $data['list']=json_encode($job_list);
		// $data['total_group']=$total_record/$limit;
		$data['header']=$this->load->view('includes/header', $data, true);
		$data['top_search']=$this->load->view('includes/top-search', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
		$this->load->view('job-search',$data);
	}
	public function jobdetails($id=0)
	{
		$data=array();
		$sendData=array();
		if($id>0)
		{
			$sendData['where']=' job_status!=3 and job.id='.$id ;
			$jobs = $this->Job_model->get_jobs($sendData);
			$data['data']=$jobs[0];
			$user_id='';
			if(isset($this->session->userdata['loggedin_user']['user_id']))
			{
				$user_id=$this->session->userdata['loggedin_user']['user_id'];
			}
			$applied=0;
			if($user_id>0)
			{
				$sendData=array();
				$sendData['job_id']=$id;
				$sendData['user_id']=$user_id;
				$applied=$this->Job_model->isApplied($sendData);
			}
			$master_data['table_name']='location';
			$master_data['where']=' status=1 ';
			$data['location']=$this->Common_model->get_master($master_data);

			$data['already_applied']=$applied;
			$data['user_id']=$user_id;
			$data['header']=$this->load->view('includes/header', $data, true);
			$data['top_search']=$this->load->view('includes/top-search', $data, true);
			$data['footer']=$this->load->view('includes/footer', $data, true);
			$this->load->view('job-details',$data);
		}else
		{
			redirect('job/jobSearch');
		}
	}
	public function apply_job()
	{	
		$jsonData=array();
		$data=array();
		$jsonData['status']='err';	
		$jsonData['msg']='';	
		$data['job_id']=$_POST['job_id'];
		$data['user_id']=$_POST['user_id'];
		$result=$this->Job_model->apply_job($data);
		if($result>0)
		{
			$jsonData['status']='ok';
			$jsonData['msg']='success';
		}
		echo json_encode($jsonData);
	}

	public function applied_employee()
	{
		/*$data=array();
		$sendData=array();
		$sendData['job_id']=$_POST['job_id'];
		$record=$this->Employee_model->applied_employee($sendData);
		$list=array();
		if(@$this->session->userdata['loggedin_admin']['username'])
		{
			foreach($record as $row)
			{
				$row['status_class']=($row['admin_approve']==1)?'green':'grey';
				$row['status_title']=($row['admin_approve']==1)?'Approved':'Approve';
				$list[]=$row;
			}
		}
		else{
			foreach($record as $row)
			{
				if($row['admin_approve']==1)
				{
					$row['status_class']=($row['admin_approve']==1)?'green':'grey';				
					$list[]=$row;
				}
			}
		}	
		$data['list']=json_encode($list);
		$data['header']=$this->load->view('includes/admin-header', $data, true);
		$data['footer']=$this->load->view('includes/admin-footer', $data, true);
		$this->load->view('applied-employee',$data);*/

		$data = array();
		$data['job_id']=$_POST['job_id'];//die();
		if(!empty($this->session->userdata['loggedin_employer']))
		{		
			$data['header']=$this->load->view('includes/header', $data, true);
			$data['footer']=$this->load->view('includes/footer', $data, true);
		}
		if(!empty($this->session->userdata['loggedin_admin']))
		{	
		$data['header']=$this->load->view('includes/admin-header', $data, true);
		$data['footer']=$this->load->view('includes/admin-footer', $data, true);
		}
		$this->load->view('resume_search_new',$data);
	}

	public function delete_all_job()
	{
		$this->db->query('ALTER TABLE `job` CHANGE `job_title` `job_title` VARCHAR(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;');
		$this->db->query('ALTER TABLE `job` ADD `job_education_id` INT NOT NULL AFTER `job_desc`, ADD `job_education_spe` VARCHAR(50) NOT NULL AFTER `job_education_id`;');
	}
}
