<?php
class Employee_model extends CI_Model
{
    /**
     * Get all users whose activated status is 1.
     * @return array
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->library('encrypt');
    }

    public function get_emplyee_automail()
    {             
        $this->db->order_by('id','DESC');
        $this->db->where('send_mail',0);
        $this->db->limit(30);
        $query=$this->db->get('employee');
        $result=$query->result_array();
        return $result;
    }
    public function get_asterhr_job()
    {             
        $this->db->order_by('id','DESC');
        $this->db->where('ext_post_id',0);
        $this->db->where('post_parent',0);
        $this->db->where('post_type','post');
        $this->db->where('post_status','publish');
        $this->db->limit(30);
        $query=$this->db->get('9cdw4s6_posts');
        $result=$query->result_array();
        return $result;
    }
    public function insert_asterhr_job($data,$asterdata)
    {
        $this->db->insert('job',$data);
        $asterdata['ext_post_id'] =  $this->db->insert_id();
        //echo $this->db->last_query();
        $this->db->where('ID',$asterdata['ID']);
        unset($asterdata['ID']);
        $this->db->update('9cdw4s6_posts',$asterdata);
        //echo $this->db->last_query();
    }

    public function update_emplyee_automail($data)
    {
        $this->db->where('id',$data['id']);
        $this->db->update('employee',$data);
    }

    public function get_emplyee()
    { 
        $this->db->select('id,employee_notice,employee_name,employee_email,
            employee_mobile_no,employee_skills,employee_city,employee_exp_year as expry,
            employee_exp_month as exprm,preferred_location,employee_current_salary,linkedin_url');  
            
            $this->db->order_by('id','DESC');
            //$this->db->limit(30);
            $query=$this->db->get('employee');
            //echo $this->db->last_query();

            $result=$query->result_array();
        //}
        return $result;
    }
    public function verify_login($data)
    {
        $return_data = array();
        $result=array();
        $this->db->where('employee_email',$data['employee_email']);
        $query=$this->db->get('employee');
        if($query->num_rows()>0)
        {
            $result=$query->row_array();
            $data['user_hash'] = $this->encrypt->decode($result['employee_password']);
            $data['user_pass'] = $data['employee_password'];
            //if(compare_lsa_pass($data))
            if($data['user_hash'] == $data['user_pass'])
            {
				$return_data = $result;
            }
        }
        return $return_data;
    }
    public function add_update($data)
    {
        $table_name='employee';
        $empolyee_id =0;
        
        if(!empty($data))
        {
            $mode=trim($data['mode']);
            unset($data['mode']);
            if(trim($mode) == 'create')
            {
                if(@$data['employee_password'] != '')
                {
                	$data['employee_password'] = $this->encrypt->encode(trim($data['employee_password']));
                }
                $this->db->insert($table_name,$data);
                // echo $this->db->last_query(); die();          
                $empolyee_id =  $this->db->insert_id();  
            }else
            {
                $id=$data['id'];
                $empolyee_id = $id;
                unset($data['id']);
                if(@$data['employee_password'])
                {
                unset($data['employee_password']);                    
                }
                if($id!='')
                {
                    $this->db->where('id',$id);
                    $this->db->update($table_name,$data);
                } 
            }
            return $empolyee_id;
        }
        return false;
    }
    public function verify_employee_email($data)
    {
        $this->db->where('employee_email',$data['email']);
        $query=$this->db->get('employee');
        return $query->num_rows();
    }
    public function activate($data)
    {
        $update_data['employee_status']=1;
        $this->db->where('id',$data['id']);
        $this->db->update('employee',$update_data);
        return $this->db->affected_rows();
    }
    public function applied_employee($data)
    {
       if(isset($data['job_id']))
        {
            if($data['job_id']!='')
            {
                $this->db->select('job_applied.id as job_applied_id, job_applied.admin_approve,employee.id,employee_address,employee_city,employee_current_company,employee_current_desig,employee_current_from_date,
                        employee_current_salary,employee_current_to_date,employee_edu_basic,employee_edu_master,employee_email,employee_exp_month,
                        employee_exp_year,employee_expected_salary,employee_functional,employee_industry,employee_mobile_no,employee_name,
                        employee_password,employee_pincode,employee_resume_name,employee_resume_url,employee_skills,employee_status,job_id');
                $this->db->group_by('employee.id');
                $this->db->join('job_applied','job_applied.user_id=employee.id and job_applied.job_id='.$data['job_id']);
            }
        }
        $query=$this->db->get('employee');
        return $query->result_array();
    }
    public function get_employee_id($data)
    {
       $id='';
        $this->db->where('employee_email',$data['employee_email']);
        $query=$this->db->get('employee');
        if($query->num_rows()>0)
        {
            $res= $query->result_array();
            $id=$res[0]['id'];
        }
        return $id;        
    }
    public function save_password($data)
    {
        $update_data['employee_password']=$data['password'];
        $this->db->trans_start();
        $this->db->where('id',$data['id']);
        $this->db->update('employee',$update_data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return 0;
        }
        return 1;
    }

    public function resume_search($data)
    {
         if(isset($data['job']))
         {
            unset($data['from_date']);
           // $data['from_date']

         }
        if(isset($data['skills']))
        {
            $skills=explode(',', $data['skills']);
            $skills=array_filter($skills);
            foreach($skills as $skill)
            {
                $this->db->or_like('employee_skills',trim($skill));
            }
        }

        if(isset($data['employee_name']))
        {
             $this->db->or_like('employee_name',trim($data['employee_name']));
        }
         if(isset($data['employee_current_company']))
        {
             $this->db->or_like('employee_current_company',trim($data['employee_current_company']));
        }

        if(isset($data['exp_from']))
        {
            $this->db->where('employee_exp_year >=',$data['exp_from']);
        }
        if(isset($data['exp_to']))
        {
            $this->db->where('employee_exp_year <=',$data['exp_to']);
        }
        if(isset($data['salary_from']))
        {
            $this->db->where('employee_current_salary >=',$data['salary_from']);
        }
        if(isset($data['salary_to']))
        {
            $this->db->where('employee_current_salary <=',$data['salary_to']);
        }
        if(isset($data['education']))
        {
            $this->db->where('(employee_edu_basic='.$data['education'].' or employee_edu_master='.$data['education'].')');
        }
        if(isset($data['notice']))
        {
            $this->db->where('employee_notice <=',$data['notice']);
        }
        if(isset($data['location']))
        {
            $this->db->like('employee_city ',$data['location']);
        }

        if(isset($data['from_date']) &&  isset($data['to_date']))
        {
           $this->db->where('DATE(created_date) >=',$data['from_date']);
           $this->db->where('DATE(created_date) <=',$data['to_date']);
        }
        if( isset($data['user_type'])) 
        {
            if(($data['user_type'] ==2))
            {
                $this->db->select('employee.*');
                $this->db->order_by('employee.id','DESC');
                $this->db->join('job_applied','job_applied.admin_approve=1  and job_applied.job_id=job.id');
                $this->db->join('employee','job_applied.user_id=employee.id','left join');
                $this->db->where('job.employer_id ',$data['user_id']);
                $this->db->group_by('employee.id');
                $query=$this->db->get('job');
                return $query->result_array();
            }
            else if($data['user_type'] ==1)
            {

                if(isset($data['job']))
                {
                $this->db->join('job_applied','job_applied.admin_approve=1  and job_applied.job_id='.$data['job'].' and  job_applied.user_id = employee.id');
                //$this->db->join('employee','job_applied.user_id=employee.id','left join');
                /*$this->db->where('DATE(created_date) >=',$data['from_date']);
                $this->db->where('DATE(created_date) <=',$data['to_date']);*/
                }
                else 
                	$this->db->join('job_applied','job_applied.admin_approve=1  and job_applied.user_id = employee.id');
                $this->db->join('job','job_applied.job_id= job.id','left join');
                $this->db->join('location','location.id= employee.employee_city','left join');
                $this->db->select('employee.*,job.job_title as employee_job_title,location.name as employee_city_name');
                $this->db->order_by('id','DESC');
                $query=$this->db->get('employee');
                return $query->result_array();

            }

        }      
        
    }

    public function get_employee($data)
    {
        $this->db->select('employee.*,master.name as master,basic.name as basic,industry.name as industry,functional.name as functional');
        if(isset($data['id']))
        {
            $this->db->where('employee.id',$data['id']);
        }
        $this->db->join('education as master','master.id=employee_edu_master','left');
        $this->db->join('education as basic','basic.id=employee_edu_basic','left');
        $this->db->join('industry','industry.id=employee_industry','left');
        $this->db->join('functional','industry.id=employee_functional','left');
        // $this->db->join('functional','industry.id=employee_functional','left');
        $query=$this->db->get('employee');
        return $query->result_array();
    }


    public function get_employee_export($data)
    {
          $this->db->select('employee.*,
            master.name as master,
            basic.name as basic,
            industry.name as industry,
            functional.name as functional');

       if(isset($data['ids']))
        {
            $ids=explode(',', $data['ids']);
            $ids=array_filter($ids);
            foreach($ids as $emp_id)
            {
                $this->db->or_where('employee.id',trim($emp_id));
            }
        }
        $this->db->join('education as master','master.id=employee_edu_master','left');
        $this->db->join('education as basic','basic.id=employee_edu_basic','left');
        $this->db->join('industry','industry.id=employee_industry','left');
        $this->db->join('functional','functional.id=employee_functional','left');
        // $this->db->join('functional','industry.id=employee_functional','left');
        $query=$this->db->get('employee');
        return $query->result_array();
    }
}

?>
