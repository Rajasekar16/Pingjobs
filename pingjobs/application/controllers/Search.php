<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

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
      	//print_r($this->session->userdata['loggedin_employer']);
      	//print_r($this->session->userdata['loggedin_admin']);
      	if(!@$this->session->userdata['loggedin_employer'] && !@$this->session->userdata['loggedin_admin'])
		{

			redirect('login');
		}
		

    }
public function index()
	{
		
		$data = array();
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
		$data['job_id']=0;
		
		$master_data=array();
		$master_data['table_name']='education';
		$master_data['where']=' status=1 ';
		$data['education']=$this->Common_model->get_master($master_data);
		
		$this->load->view('resume_search_new',$data);
	}
public function resume_search()
	{
		$responseData=array();
		$responseData['status']=AJAX_ERROR;
		$responseData['msg']=AJAX_MSG;
		$responseData['data']=array();
	    $list=array();
		$record=array();
		$record = array();
		if(!empty($_GET))
		{
			if(!empty($this->session->userdata['loggedin_admin']))
			{
				$sendData['user_type']=1;
				$sendData['user_id']=2;
			}
			elseif(!empty($this->session->userdata['loggedin_employer']))
			{
				$sendData['user_type']=2;
				$sendData['user_id']= $this->session->userdata['loggedin_employer']['id'];
			}
			$sendData['skills']=$this->input->get('skills');
			$sendData['employee_name']=$this->input->get('employee_name');
			$sendData['employee_current_company']=$this->input->get('employee_current_company');
			$sendData['exp_from']=$this->input->get('exp_from');
			$sendData['exp_to']=$this->input->get('exp_to');
			$sendData['salary_from']=$this->input->get('salary_from');
			$sendData['salary_to']=$this->input->get('salary_to');
			$sendData['notice']=$this->input->get('notice');
			$sendData['education']=$this->input->get('education');
			$sendData['location']=$this->input->get('location');
			$sendData['job']=$this->input->get('job');
			if($this->input->get('from_date') !='')
			{
				$sendData['from_date']=  date('Y-m-d', strtotime($this->input->get('from_date')));
				$sendData['to_date']=  date('Y-m-d', strtotime($this->input->get('to_date')));
			}
			$sendData=array_filter($sendData);
			$record=$this->Employee_model->resume_search($sendData);
			//echo $this->db->last_query();
			if(!empty($record))
			{
				$master_data=array();
				$master_data['table_name']='education';
				$master_data['where']=' status=1 ';
				$education=$this->Common_model->get_master($master_data);
				$educations = array_column($education, "name","id");
				
				foreach($record as $key=>$row)
				{
					$record[$key]['education'] = 'Basic : '.$educations[$record[$key]['employee_edu_basic']].'<br>Master : '. $educations[$record[$key]['employee_edu_master']];
					$record[$key]['expry'] = 'Exprience : '.$record[$key]['employee_exp_year'].'.'. $record[$key]['employee_exp_month'].' Yrs <BR> Notice Period '.$record[$key]['employee_notice'].' Days <br>Salary : '.$record[$key]['employee_current_salary'].' (L/A)';
					$record[$key]['detail'] = $record[$key]['employee_email'].'<BR>'. $record[$key]['employee_mobile_no'].'<BR>Current :'.$record[$key]['employee_city_name'].'<BR>Preferred : '.($record[$key]['preferred_location']|'Any');
					$record[$key]['created_date'] = common_date_format($record[$key]['created_date']);
				}

				$responseData['status']=AJAX_SUCCESS;
				$responseData['data']=$record;
			}
			else
			{
				$responseData['status']=AJAX_SUCCESS;
			    $responseData['msg']='No records Found';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($responseData);
		exit;

	}

	public function export()
	{
		$responseData=array();
		$responseData['status']=AJAX_ERROR;
		$responseData['msg']=AJAX_MSG;
		$responseData['data']=array();
	    $list=array();
		$record=array();
		$record = array();
		$type = $this->input->get('type');
		//echo "haiii".$this->input->get['skills'];	 
		$form_html ='';	
		if(!empty($_GET))
		{
			$sendData['ids']=$this->input->get('id');			
			$sendData=array_filter($sendData);
			//print_r($sendData);
			$record=$this->Employee_model->get_employee_export($sendData);
			//echo $this->db->last_query();
			if(!empty($record))
			{				
				$form_html .='<table><tr>';
				$form_html .='<th>ID </th>';
				$form_html .='<th>Name </th>';
				$form_html .='<th>Email </th>';
				$form_html .='<th>Contact No</th>';
				$form_html .='<th>Exprience</th>';
				$form_html .='<th>Skills</th>';  
				$form_html .='<th>Job Apply For</th>';   
				$form_html .='<th>Current Company</th>';
				$form_html .='<th>Notice Period(Days)</th>';
				$form_html .='<th>Current Location</th>';
				$form_html .='<th>Preferred Location</th>';
				$form_html .='<th>Current CTC</th>';
				$form_html .='<th>Linkedin URLC</th>';				
				$form_html .='</tr>';
				//echo $form_html;die();
				foreach($record as $val)
				{
				$form_html .='<tr>';
				$form_html .=$this->writeRow($val['id']); 
				$form_html .=$this->writeRow($val['employee_name']); 
				$form_html .=$this->writeRow($val['employee_email']);  
				$form_html .=$this->writeRow($val['employee_mobile_no']);  
				$exprience = $val['employee_exp_year'].':'.$val['employee_exp_month'];
				$form_html .=$this->writeRow($exprience);
				$form_html .=$this->writeRow($val['employee_skills']); 
				$form_html .=$this->writeRow($val['employee_job_title']); 
				$form_html .=$this->writeRow($val['employee_current_company']);
				$form_html .=$this->writeRow($val['employee_notice']);  
				$form_html .=$this->writeRow($val['employee_city']);  
				$form_html .=$this->writeRow($val['preferred_location']); 
				$form_html .=$this->writeRow($val['employee_current_salary']);  
				$form_html .=$this->writeRow($val['linkedin_url']);  
				$form_html .='</tr>';
		     	}
		    	$form_html .='</table>';  
				}
			else
			{
				/*$responseData['status']=AJAX_SUCCESS;
			    $responseData['msg']='No records Found';*/
			}
		}

		if($type =="export")
		{
			    $filename ="employee_".currentGMT('timestamp').'.xls';;
				header('Content-Disposition: attachment; filename='.$filename);
				header('Content-type: application/force-download');
				header('Content-Transfer-Encoding: binary');
				header('Pragma: public');
				print "\xEF\xBB\xBF"; // UTF-8 BOM
				$h = array();
		    	echo $form_html;
		    	die(); 


		}
		else
		{
		$email = $this->input->get('email');
		$msg = $this->input->get('msg');
			//echo "insidee";die();

			 $filename ="employee_".currentGMT('timestamp').'.xls';
				header('Content-Disposition: attachment; filename='.$filename);
				header('Content-type: application/force-download');
				header('Content-Transfer-Encoding: binary');
				header('Pragma: public');
				print "\xEF\xBB\xBF"; // UTF-8 BOM
				$h = array();
		    	//echo $form_html;
		    $path='/pathOfFile/';	
			//$csv_handler = fopen (base_url().EXCELL_PATH.$filename,'w');
			$FName =EXCELL_PATH.$filename;
			$csv_handler = fopen($FName,'w');
			fwrite ($csv_handler,$form_html);
			fclose ($csv_handler);			
			$data['to_mail']=$email; //'sudalaimca87@gmail.com';
    		$data['subject']='Send Resume'; //'Thanks for registering';
    		$data['message']=$msg; //'Thank you!';
    		$data['attachement']=$FName; //'Thank you!';
    		send_mail($data);
			if(!unlink($FName))
			{
			//return true;
			}			
    		//return true;
    		$responseData['status']=AJAX_SUCCESS;
			$responseData['msg']='Email Send successfully';
		}
		header('Content-Type: application/json');
		echo json_encode($responseData);
		exit;


		

	}


function writeRow($val) {
    return  '<td>'.$val.'</td>';              
}



	}