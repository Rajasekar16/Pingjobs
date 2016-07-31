<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee  extends CI_Controller {

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
      	$this->load->helper('common');
    }

	public function index()
	{
		$data=array();
		$master_data=array();
		$master_data['table_name']='education';
		$master_data['where']=' status=1 and level=1';
		$data['basic_education']=$this->Common_model->get_master($master_data);

		$master_data['table_name']='education';
		$master_data['where']=' status=1 and level=2 ';
		$data['master_education']=$this->Common_model->get_master($master_data);

		$master_data['table_name']='designation';
		$master_data['where']=' status=1';
		$data['designation']=$this->Common_model->get_master($master_data);


		$master_data['table_name']='salary';
		$master_data['where']=' status=1';
		$data['salary']=$this->Common_model->get_master($master_data);
		 $master_data=array();
		  $master_data['table_name']='industry';
		  $master_data['where']=' status=1 ';
		  $data['industry']=$this->Common_model->get_master($master_data);

		  $master_data=array();
		  $master_data['table_name']='functional';
		  $master_data['where']=' status=1 ';
		  $data['functional']=$this->Common_model->get_master($master_data);



		$data['header']=$this->load->view('includes/header', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
		$this->load->view('employee-signup',$data);
	}

	public function my_profile($emplyee_id)
	{

		$data=array();
		$master_data=array();
		$master_data['table_name']='education';
		$master_data['where']=' status=1 and level=1';
		$data['basic_education']=$this->Common_model->get_master($master_data);

		$master_data['table_name']='education';
		$master_data['where']=' status=1 and level=2 ';
		$data['master_education']=$this->Common_model->get_master($master_data);

		$master_data['table_name']='designation';
		$master_data['where']=' status=1';
		$data['designation']=$this->Common_model->get_master($master_data);


		$master_data['table_name']='salary';
		$master_data['where']=' status=1';
		$data['salary']=$this->Common_model->get_master($master_data);
		$master_data=array();
		  $master_data['table_name']='industry';
		  $master_data['where']=' status=1 ';
		  $data['industry']=$this->Common_model->get_master($master_data);

		  $master_data=array();
		  $master_data['table_name']='functional';
		  $master_data['where']=' status=1 ';
		  $data['functional']=$this->Common_model->get_master($master_data);


		  $master_data=array();
		  $master_data['table_name']='employee';
		  $master_data['where']=' id='.$emplyee_id;
		  $data['employee']=$this->Common_model->get_master($master_data);



		$data['header']=$this->load->view('includes/header', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
		$this->load->view('employee-signup',$data);

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
		$_POST['mode'] =trim($_POST['mode']);
			$_POST['employee_current_from_date'] = date('Y-m-d',strtotime($_POST['employee_current_from_date']));
			$_POST['employee_current_to_date'] = date('Y-m-d',strtotime($_POST['employee_current_to_date']));
			$success=$this->Employee_model->add_update($_POST);
			if($success>0)
			{
				$responseData['status']=AJAX_SUCCESS;
				if($_POST['mode']=='create')
				{
				 	$sendData=$_POST;
				 	$sendData['employee_id']=$success;
				 	$this->registration_mail($sendData);
					$responseData['msg']='Registration completed Activator link sent your email. Please click the link and activate your account!';
				}else
				{
					$responseData['msg']='Profile updated successfully!';
				}
			}
			else
			{
				if($_POST['mode']=='create')
				{
					$responseData['msg']='Registration Failed!';
				}else
				{
					$responseData['msg']='Updated Failed!';
				}				
			}
		}
		header('Content-Type: application/json');
		echo json_encode($responseData);
		exit;
	}

	public function verify_employee_email()
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
			$exists=$this->Employee_model->verify_employee_email($sendData);
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

	public function activate($id)
	{
		$sendData['id']=$id;
		$activate=$this->Employee_model->activate($sendData);
		if($activate>0)
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Activated successfully, Please Login!</div>');
		}else
		{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Acivated Failed. Please try again!</div>');
		}
		redirect(base_url());
	}

	public function registration_mail($data)
	{
	    $html='Dear '.$data['employee_email'].',<br>
    				Please click below link to activate your account.<a href="'.base_url().'employee/activate/'.$data['employee_id'].'">Click here</a>';
	    $sendData['message']=$html;//'Thank you!';
	    $sendData['to_mail']=$data['employee_email'];
	    $sendData['subject']='Thanks for registering';
	    send_mail($sendData);
	}


	public function send_automail()
	{
		$data['type'] = 'asterhrregister';
		$mail_list = $this->Employee_model->get_emplyee_automail();
		if(!empty($mail_list))
		{
			foreach($mail_list as $row)
			{
			$data['to_mail'] = $row['employee_email'];
			$data['subject']='Thanks for registering '.ASTER_APP_EMAIL_NAME; //'Thanks for registering';
			$data['message']=getEmailTemplate($data);
			//print_r($data);
			send_mail_byaster($data);
			$update_data = array();
			$update_data['id']=$row['id'];
			$update_data['send_mail']=1;
			$this->Employee_model->update_emplyee_automail($update_data);
			//die();
			}			
		}
		$job_list = $this->Employee_model->get_asterhr_job();
		if(!empty($job_list))
		{
			foreach($job_list as $row)
			{
				$job = array();
				$asterjob = array();
				$job['job_status']=2;
				$job['job_title']=$row['post_title'];
				$job['job_desc']=strip_tags($row['post_content']);
				$job['job_country_id']=1;
				$job['job_company_name']='Aster hr';
				$job['about_company']='Aster HR Solutions is a professionally managed HR outsourcing and Recruitment Based company in IT/ITES/ Non IT Fields. We are the fastest growing and the most innovative human resources consulting firm based at Chennai';
				$job['post_date']=$row['post_date_gmt'];
				$job['update_on']=$row['post_modified_gmt'];
				$job['employer_id']=1;
				$job['ext_post_id']=$row['ID'];
				$asterjob['ID']=$row['ID'];
				$asterjob['ext_post_id']=0;
				$asterjob['post_content']=str_replace("post-your-resume","post-your-resume/".$row['ID']."",$row['post_content']);
				//echo $this->db->last_query();
				$this->Employee_model->insert_asterhr_job($job,$asterjob);
				
			}	

		}
		
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
		$sendData['employee_email']=$_POST['employee_email'];
		$sendData['employee_password']=$_POST['employee_password'];
		$result = $this->Employee_model->verify_login($sendData);
		if(!empty($result))
		{
			if($result['employee_status'] == 1)
			{
				 $sessiondata = array(
			          'user_id' => $result['id'],
			          'employee_email' => $result['employee_email'],
			          'loginuser' => TRUE,
			          'user_type' => 3
			     );
			     $this->session->set_userdata('loggedin_user',$sessiondata);
			     //redirect(base_url().'job/listjobs');
				$responseData['status']=AJAX_SUCCESS;
				$responseData['data'] = base_url().'job/jobSearch';
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


		//echo "ahahah";die();
		/*if(isset($_POST['employee_login']))
		{
			$sendData=array();
			$sendData['employee_email']=$_POST['employee_email'];
			$sendData['employee_password']=$_POST['employee_password'];
			$result = $this->Employee_model->verify_login($sendData);
			if (count($result) > 0) 
			{
				if($result['employee_status'] == 2)
				{
					 $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">please activat.</div>');
			     	//die();
			    	 redirect(base_url());

				}
			     //set the session variables
			     $sessiondata = array(
			          'user_id' => $result['id'],
			          'employee_email' => $result['employee_email'],
			          'loginuser' => TRUE
			     );
			     $this->session->set_userdata('loggedin_user',$sessiondata);
			     redirect(base_url().'job/jobSearch');
			}
			else
			{
			     $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Login Unsuccessful. Please enter your correct email address and password.</div>');
			     //die();
			     redirect(base_url());
			}*/
		//}
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
	public function jobs()
	{
		echo "Login Successfull";
		echo "<pre>";
		print_r($this->session->userdata['loggedin_user']);
	}	


  public function reset_password()
  {
  	$data=array();
    if (isset($_POST['reset']))
    {
      	$email=$this->input->post("email");
        $sendData['employee_email']=$email;
        $id = $this->Employee_model->get_employee_id($sendData);
        if($id!='')
        {
          //send mail with link          
          $dateTime=strtotime(date('d-m-Y H:i')); 
          $link=base_url().'employee/change_password/'.$dateTime.'-'.$id;

          $data['to_mail']=$email;//'sudalaimca87@gmail.com';
          $data['subject']='Reset Password';
          $data['message']='Click below link and change your password '.$link;
          $this->send_mail($data);
          $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><p class="text-center">Password Request Successful!</p><p>An email has been sent with your password to your registered email address. Please check your mail.</p>  </div>');
          redirect('employee/reset_password');
        }
        else
        {
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Enter valid EmailId</div>');
          redirect('employee/reset_password');
        }
    }
	    $data['header']=$this->load->view('includes/header', $data, true);
		$data['footer']=$this->load->view('includes/footer', $data, true);
	 	$this->load->view('employee-reset-password',$data);
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
	  	$this->load->view('employee-change-password',$data);
    }
    else
    {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Your time expired.Please try again..</div>');
      redirect('employee/reset_password');
    }
  }
  public function save_password()
  {
    $password = $this->input->post("password");
    $id = $this->input->post("id");
    $sendData['password']=$password;
    $sendData['id']=$id;
    $result = $this->Employee_model->save_password($sendData);
    if($result>0)
    {
      $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Password changed successfully. Please login.</div>');
      redirect('login');
    }else
    {
      $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Link not valid.Please try again..</div>');
      redirect('employee/reset_password');
    }
  }
public function upload_resume()
  	{
  		header('Access-Control-Allow-Origin: *');
		$return_data=array();
		$return_data['status']='error';
		$return_data['data']=array();
		$msg='';
		if(!empty($_FILES))
		{
			$file_element_name='resume_upload';

			//set filename in config for upload
			$FileName = $_FILES['resume_upload']['name'];
			//echo $FileName;die();
			$name_arr=explode(".", $FileName);
			$fileExt = array_pop($name_arr);
			$newfilename = 'resume_'.time().'_'.$name_arr[0];
			$config['file_name'] = $newfilename;
			$config['upload_path'] = 'upload/';
			$config['allowed_types'] = 'docx|doc|pdf|txt';
			$config['encrypt_name'] = FALSE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload($file_element_name))
			{
				$status = 'error';
				$msg = $this->upload->display_errors('', '');
			}else
			{
				 $upload_data = $this->upload->data();		

				$return_data['status']='ok';
				$return_data['urlname']=$upload_data['file_name'];
				$return_data['filename']=$FileName;
			}
			$return_data['msg']=$msg;
		}
		echo json_encode($return_data);
		exit;
  	}
	public function getDetail()
  {
  		$json=array();
		$json['status']='err';
		$json['data']='';


		$master_data=array();
		$master_data['id']=$_POST['id'];
		$list=$this->Employee_model->get_employee($master_data);	

		if(!empty($list))
		{
			$list[0]['created_date'] = common_date_format($list[0]['created_date']);
			

			$json['data']=$list[0];
			$json['status']='ok';
		}
		echo json_encode($json);	

  }

  public function add_update_aster()
	{
		$status ='';
		$msg ='';
		$data ='';
		if(!empty($_POST))
		{
		    $_POST['mode'] ='create';
			//$_POST['employee_current_from_date'] = date('Y-m-d',strtotime($_POST['employee_current_from_date']));
			//$_POST['employee_current_to_date'] = date('Y-m-d',strtotime($_POST['employee_current_to_date']));
			
			$_POST = array_map('stripslashes', $_POST);
			
			$_POST['employee_current_salary'] = $_POST['employee_current_salary'].'.'.$_POST['employee_current_salary_thousan'];
			unset($_POST['employee_current_salary_thousan']);
			$success=$this->Employee_model->add_update($_POST);
			if($success>0)
			{
				if($_POST['mode']=='create')
				{
					$status ='ok';
					$msg = '';
					$data = $_POST;
					/*

					$html='Dear '.$data['employee_email'].',<br> your Resume has been submitted Successfully.';
				    $sendData['message']=$html;//'Thank you!';
				    $sendData['to_mail']=$data['employee_email'];
				    $sendData['subject']='Thanks for registering';
				    $this->send_mail($sendData); */


				    //$html='New resume sent from '.$data['employee_email'].',for the post of '.$data['employee_skills'];
				    if($data['employee_exp_month']<1){$data['employee_exp_month'] =0;}
				    $html ="<b>Skills : </b>".$data['employee_skills'];
				    $html .="<br><b>Exprience : </b>".$data['employee_exp_year'].'.'.$data['employee_exp_month'];
				    $html .="<br><b>current Location : </b>".$data['employee_city'];
				    $sendData['from']=$data['employee_email'];//'Thank you!';
				    $sendData['name']=$data['employee_name'];//'Thank you!';
				    $sendData['message']=$html;//'Thank you!';
				    $sendData['to_mail']='careers@asterhr.com';
					$sendData['attach'] ='http://asterhr.com/ping/upload/'.$data['employee_resume_url']; 
				    $subject=$data['employee_skills'].'|'.$data['employee_exp_year'].'.'.$data['employee_exp_month'].'|'.$data['employee_city'].'';
				    $sendData['subject']=$subject;
				    $this->send_mail($sendData);
					

				 	
				}else
				{
				 	$status ='error';
				}
			}
		}

		echo json_encode(array('status'=>$status,'msg'=>$msg,'data'=>''));
		
	}




}
