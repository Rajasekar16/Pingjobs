<?php
class Job_model extends CI_Model
{
    /**
     * Get all users whose activated status is 1.
     * @return array
     */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_total_job($data)
    {
        $this->db->select('id');
        $this->db->where('job_status!=',3);
        
        if(isset($data['skills']))
        {
            if($data['skills']!='')
            {
                $this->db->where($data['skills']);
            }
        }

        if(isset($data['experience']))
        {
            if($data['experience']!='')
            {
                $this->db->where($data['experience']);
            }
        }
        $query=$this->db->get('job');
        return $query->num_rows();
    }
    public function get_jobs($data)
    {
        $result=array();
        $this->db->select('job.id as id,
                            job.job_title,
                            job.job_desc,
                            job.job_key_skill,
                            job.job_experience_from,
                            job.job_experience_to,
                            job.job_salary_from,
                            job.job_salary_to,
                            job.job_no_postition,
                            job.job_gender_id,
                            job.job_status,
                            job.job_education_spe,
                            education.name as education_name,
                            industry.name as industry_name,
                            functional.name as functional_name,
                            location.name as location_name,
                            job.job_location_id as country_name,
                            employer.company_name as job_company_name,
                            employer.company_name as company_name,
                            employer.email as employer_email,
                            employer.website as employer_website,
                            employer.about_company as about_company,
                            job.post_date as post_date,
                            (select count(id) from job_applied where  job_id= job.id and admin_approve=1  ) as applied_count
                            ');
        $this->db->join('industry','industry.id=job.job_industry_id','left');
        $this->db->join('functional','functional.id=job.job_functional_id','left');
        $this->db->join('location','location.id=job.job_location_id','left');
        $this->db->join('employer','employer.id=job.employer_id','left');
        $this->db->join('education','education.id=job.job_education_id','left');
        $this->db->where('job_status!=',3);
        if(!@$this->session->userdata['loggedin_employer'] && !@$this->session->userdata['loggedin_admin'])
        {

            $this->db->where('job_status =',2);
        }


        if(isset($data['employer_id']))
        {
            if($data['employer_id']!='')
            {
                $this->db->where($data['employer_id']);
            }
        }
        
        if(isset($data['skills']))
        {
            if($data['skills']!='')
            {
                $this->db->where($data['skills']);
            }
        }

        if(isset($data['location']))
        {
            if($data['location']!='')
            {
                $this->db->where($data['location']);
            }
        }
        if(isset($data['industry']))
        {
            if($data['industry']!='')
            {
                $this->db->where($data['industry']);
            }
        }
        if(isset($data['experience']))
        {
            if($data['experience']!='')
            {
                $this->db->where($data['experience']);
            }
        }

        if(isset($data['last_days']))
        {
            if($data['last_days']!='')
            {
                $this->db->where($data['last_days']);
            }
        }
        if(isset($data['salary']))
        {
            if($data['salary']!='')
            {
                $this->db->where($data['salary']);
            }
        }

        if(isset($data['orderby']))
        {
            if($data['orderby']!='')
            {
                $order='ASC';
                if($data['orderby']=='post_date')
                {
                    $order='DESC';
                }
                $this->db->order_by($data['orderby'],$order);
            }
        }else
        {
                $this->db->order_by('job.id','DESC');
        }
        if(isset($data['start']) && isset($data['limit']))
        {
            $this->db->limit($data['limit'],$data['start']);
        }

        
        $query=$this->db->get('job');
        return $query->result_array();
    }
    public function delete_job($data)
    {
        if($data['id']>0)
        {
            if(isset($data['soft_delete']))
            {
                $update=array();
                $update['job_status']=3;

                $this->db->where('id',$data['id']);
                $this->db->update('job',$update);
                return $this->db->affected_rows();
            }else{
                $this->db->where('id',$data['id']);
                $this->db->delete('job');
                return $this->db->affected_rows();                
            }
        }
    }
    public function jobApprove($data)
    {
        $update=array();
        $update['job_status']=2;
        $this->db->where_in('id',$data['ids']);
        $this->db->update('job',$update);
        return $this->db->affected_rows();
    }
    public function apply_job($data)
    {
        $this->db->insert('job_applied',$data);
        return $this->db->insert_id();
    }
    public function isApplied($data)
    {
        $this->db->where('job_id',$data['job_id']);
        $this->db->where('user_id',$data['user_id']);
        $query=$this->db->get('job_applied');
        return $query->num_rows();
    }
    public function get_applied_jobs_for_approve()
    {
        $this->db->select('employer.company_name,employee_email,employee_name,job_applied.id');
        $this->db->join('job','job.id=job_applied.job_id');
        $this->db->join('employer','employer.id=job.employer_id');
        $this->db->join('employee','employee.id=job_applied.user_id');
        $this->db->where('admin_approve',0);
        $query=$this->db->get('job_applied');
        return $query->result_array();
    }
    public function approve_applied_job($data)
    {
        $update['admin_approve']=1;
        $this->db->where('id',$data['id']);
        $this->db->update('job_applied',$update);
        return $this->db->affected_rows();
    }

    public function get_job_applied_info($data)
    {
        $this->db->select('employer.email,employer.contact_person,employee.employee_name,employee.employee_resume_url,job.job_title');
        $this->db->join('job','job.id=job_applied.job_id');
        $this->db->join('employer','employer.id=job.employer_id');
        $this->db->join('employee','employee.id=job_applied.user_id');
        $this->db->where('job_applied.id',$data['id']);
        $query =$this->db->get('job_applied');
        return $query->result_array();

    }
}

?>
