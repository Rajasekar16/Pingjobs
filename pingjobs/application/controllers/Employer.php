<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer extends CI_Controller {

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
      	$this->load->model('Employer_model');
      	$this->load->model('Employee_model');
      	$this->load->model('Common_model');
      	$this->load->helper('common');
		$this->load->library('encrypt');
    }

	public function index()
	{
		$data=array();

		$master_data=array();
		$master_data['table_name']='location';
		$master_data['where']=' status=1';
		$data['location_array']=$this->Common_model->get_master($master_data);

		$master_data=array();
		$master_data['table_name']='state';
		$master_data['where']=' status=1';
		$data['state_array']=$this->Common_model->get_master($master_data);
		
		$master_data=array();
		$master_data['table_name']='industry';
		$master_data['where']=' status=1 ';
		$data['industry_array']=$this->Common_model->get_master($master_data);

		$master_data=array();
		$master_data['table_name']='company_type';
		if(!@$this->session->userdata['loggedin_admin'])
			$master_data['where']=' status=1';
		$data['company_type_array']=$this->Common_model->get_master($master_data);
		
		$data['header']=$this->load->view('includes/header', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
		$this->load->view('employer-signup',$data);
		

	}
	public function my_profile($employer_id)
	{
		$data=array();
		$master_data=array();
		$master_data['table_name']='state';
		$master_data['where']=' status=1';
		$data['state_array']=$this->Common_model->get_master($master_data);
		$master_data=array();
		$master_data['table_name']='location';
		$master_data['where']=' status=1';
		$data['location_array']=$this->Common_model->get_master($master_data);
		$master_data=array();
		$master_data['table_name']='industry';
		$master_data['where']=' status=1 ';
		$data['industry_array']=$this->Common_model->get_master($master_data);
		$master_data=array();
		$master_data['table_name']='employer';
		$master_data['where']=' id='.$employer_id;
		$data['employer']=$this->Common_model->get_master($master_data);
		$data['header']=$this->load->view('includes/header', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
		$this->load->view('employer-signup',$data);
	}

	public function add_update()
	{
		$data = $this->input->post();
		$config = array(
				array( 'field' => 'id', 'label' => 'ID', 'rules' => 'trim|xss_clean' ),
				array( 'field' => 'company_type', 'label' => 'company_type', 'rules' => 'trim|required|xss_clean' ),
				array( 'field' => 'contact_person', 'label' => 'contact_person', 'rules' => 'trim|required|xss_clean' ),
				array( 'field' => 'email', 'label' => 'email', 'rules' => 'trim|valid_email|required|xss_clean' ),
				array( 'field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|xss_clean' ),
				array( 'field' => 'company_name', 'label' => 'company_name', 'rules' => 'trim|valid_email|required|xss_clean' ),
				array( 'field' => 'industry', 'label' => 'industry', 'rules' => 'trim|valid_email|required|xss_clean' ),
				array( 'field' => 'contact_no', 'label' => 'contact_no', 'rules' => 'trim|valid_email|required|xss_clean' ),
				array( 'field' => 'company_employes', 'label' => 'company_employes', 'rules' => 'trim|valid_email|required|xss_clean' ),
				array( 'field' => 'address', 'label' => 'address', 'rules' => 'trim|valid_email|required|xss_clean' ),
				array( 'field' => 'state', 'label' => 'state', 'rules' => 'trim|valid_email|required|xss_clean' ),
				array( 'field' => 'city', 'label' => 'city', 'rules' => 'trim|valid_email|required|xss_clean' ),
				array( 'field' => 'pincode', 'label' => 'pincode', 'rules' => 'trim|valid_email|required|xss_clean' ),
				array( 'field' => 'website', 'label' => 'website', 'rules' => 'trim|valid_email|required|xss_clean' ),
				array( 'field' => 'about_company', 'label' => 'about_company', 'rules' => 'trim|valid_email|required|xss_clean' ),
		);
		if(!empty($data))
		{
			$data['mode'] =trim($data['mode']);
			$password = $data['conf_password'];
			unset($data['conf_password']);
			$data['password'] = $this->encrypt->encode($password);
			$success=$this->Employer_model->add_update($data);
			if($success>0)
			{
				if($data['mode']=='create')
				{
				 	$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Registration completed  Activator link sent your email. Please click the link and activate your account!</div>');
				 	$sendData=$data;
				 	$sendData['employer_id']=$success;
				 	$this->registration_mail($sendData);
				}else
				{
				 	$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Profile updated successfully!</div>');
				}
			}else
			{
				if($data['mode']=='create')
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Registration Failed!</div>');
				}else
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Updated Failed!</div>');
				}				
			}
		}

		if($data['mode']=='create')
		{
	   	redirect(base_url().'employer');
	   }
	   else
	   {
	   	redirect(base_url().'employer/my_profile/'.$data['id']);
	   }


	   	//redirect(base_url().'employer');
	}

	public function verify_employer_email()
	{
		$json=array();
		$json['status']='err';
		$json['data']='';
		$this->load->helper('email');
		$email=$_POST['email'];
		if(valid_email($email))
		{
			$sendData=array();
			$sendData['email']=$email;
			$exists=$this->Employer_model->verify_employer_email($sendData);
			$json['data']=$exists;
			if($exists==0)
			{
				$json['status']='ok';			
			}
		}else
		{
			$json['status']='notvalid';
		}
		echo json_encode($json);
	}


	public function registration_mail($data)
	{
	    $html='Dear '.$data['email'].',<br>
    				Please click below link to activate your account.<a href="'.base_url().'employer/activate/'.$data['employer_id'].'">Click here</a>';
	    $sendData['message']=$html;//'Thank you!';
	    $sendData['to_mail']=$data['email'];
	    $sendData['subject']='Thanks for registering';
	    $this->send_mail($sendData);
	}
	public function activate($id)
	{
		$sendData['id']=$id;
		$sendData['status']=2;
		$activate=$this->Employer_model->update_employer($sendData);
		if($activate>0)
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Activated successfully, Please Login!</div>');
		}else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Acivated Failed. Please try again!</div>');
		}
		redirect(base_url().'employer');
	}


	public function send_mail($data)
	{
		$to_mail=$data['to_mail']; //'sudalaimca87@gmail.com';
		$subject=$data['subject']; //'Thanks for registering';
		$message=$data['message']; //'Thank you!';

		$this->load->library('email');
		$this->email->set_mailtype("html");
		$this->email->from('support@ping.com', 'Admin');
		$this->email->to($to_mail);
		$this->email->bcc('sudalaimca87@gmail.com');
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
		$this->email->print_debugger();
	}
	public function verify_login()
	{
		$responseData=array();
		$responseData['status']=AJAX_ERROR;
		$responseData['msg']=AJAX_MSG;
		$responseData['data']=array();
		$sendData=array();
		$status=$msg=$data='';
		$sendData['email'] = $this->input->post('email');
		$result = $this->Employer_model->verify_login($sendData);
		$sendData['password'] = $this->input->post('password');
		if(!empty($result) && $this->encrypt->decode($result['password']) == $sendData['password'])
		{
			if($result['status'] == 1)
			{
				 $sessiondata = array(
			          'id' => $result['id'],
			          'email' => $result['email'],
			          'loginemployer' => TRUE,
			          'user_type' => 2
			     );
			     $this->session->set_userdata('loggedin_employer',$sessiondata);
			     //redirect(base_url().'job/listjobs');

				$responseData['status']=AJAX_SUCCESS;
				$responseData['data'] = base_url().'job/listjobs';
			}
			else
			{
			$responseData['msg']='Activate your account';
			}
		}
		else
		{
			$responseData['msg']='Invalid Credentials!';

		}
		header('Content-Type: application/json');
		echo json_encode($responseData);
		exit;




/*
		if(isset($_POST['employer_login']))
		{
			$sendData=array();
			$sendData['email']=$_POST['email'];
			$sendData['password']=$_POST['password'];

			$result = $this->Employer_model->verify_login($sendData);

			if (count($result) > 0)
			{

			if($result['status'] == 2)
				{
					 $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please activate your account.</div>');
			     	//die();
			    	 redirect(base_url());

				}
				else
				{
			     //set the session variables
			     $sessiondata = array(
			          'id' => $result['id'],
			          'email' => $result['email'],
			          'loginemployer' => TRUE
			     );
			     $this->session->set_userdata('loggedin_employer',$sessiondata);
			     redirect(base_url().'job/listjobs');
					
				}
			}
			else
			{
			     $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Login Unsuccessful. Please enter your correct email address and password.</div>');
			     redirect(base_url());
			}
		}*/
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
	    redirect('login');
	}
	/*public function jobs()
	{
		
		//$data = array();
		//echo "Login Successfull";
		//echo "<pre>";
		$data=array();
		$data['header']=$this->load->view('includes/header', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
		$this->load->view('postjob',$data);
		//print_r($this->session->userdata['loggedin_employer']);
	}*/

  public function reset_password()
  {
  	$data = array();
	    $data['header']=$this->load->view('includes/header', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
	 	$this->load->view('employer-reset-password',$data);
  }

  public function reset_password_update()
  {
  	$responseData=array();
	$responseData['status']=AJAX_ERROR;
	$responseData['msg']=AJAX_MSG;
	$responseData['data']=array();
	$sendData=array();
	$status=$msg=$data='';
	$email = $this->input->post('email');
	$sendData['employer_email']=$email;
    $id = $this->Employer_model->get_employer_id($sendData);
    //echo $this->db->last_query();
    if($id>0)
        {
          //send mail with link          admin
          $dateTime=strtotime(date('d-m-Y H:i')); 
          $link=base_url().'employer/change_password/'.$dateTime.'-'.$id;

          $data['to_mail']=$email;//'sudalaimca87@gmail.com';
          $data['subject']='Reset Password';
          $data['message']='Click below link and change your password '.$link;
          $this->send_mail($data);
			$responseData['status']=AJAX_SUCCESS;
			$responseData['msg']='Password Request Successful!</p><p>An email has been sent with your password to your registered email address. Please check your mail';
			
        }
        else
        {
        	$responseData['msg']='Enter valid Email Id';
          /*$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Enter valid EmailId</div>');
          redirect('employer/reset_password');*/
        }
        header('Content-Type: application/json');
		echo json_encode($responseData);
		exit;

  }

  public function change_password($arg)
  {
    $key=explode('-', $arg);
    $sendDateTime=$key[0];
    $data['id']=$key[1];
    $now=strtotime(date('d-m-Y H:i'));
    $time=$now-$sendDateTime;
    if($time<3600)//1 hour
    {
		$data['header']=$this->load->view('includes/header', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
	  	$this->load->view('employer-change-password',$data);
    }
    else
    {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Your time expired.Please try again..</div>');
      redirect('employer/reset_password');
    }
  }
  public function save_password()
  {
    $password = $this->input->post("password");
    $id = $this->input->post("id");
    $sendData['password']=$password;
    $sendData['id']=$id;
    $result = $this->Employer_model->save_password($sendData);
    if($result>0)
    {
      $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Password changed successfully. Please login.</div>');
      redirect('login');
    }else
    {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Link not valid.Please try again..</div>');
      redirect('employer/reset_password');
    }
  }

  public function resume_search($type)
	{
	
		if(!@$this->session->userdata['loggedin_employer'])
		{
			redirect('login');
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
		$data['header']=$this->load->view('includes/header', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);

		$this->load->view('resume_search',$data);
	}


}
