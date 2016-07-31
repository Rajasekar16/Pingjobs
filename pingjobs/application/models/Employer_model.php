<?php
class Employer_model extends CI_Model
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
    public function verify_login($data)
    {
        $result=array();
        $this->db->where('email',$data['email']);
		if(isset($data['password']))
			$this->db->where('password',$data['password']);
        $query=$this->db->get('employer');
        if($query->num_rows()>0)
        {
            $res=$query->result_array();
            $result=$res[0];
        }
        return $result;
    }
    public function add_update($data)
    {
        $table_name='employer';
        if(!empty($data))
        {
            $mode=$data['mode'];
            unset($data['mode']);

            if($mode=='create')
            {
                $this->db->insert($table_name,$data);
                return $this->db->insert_id();             
            }else
            {
                $id=$data['id'];
                unset($data['id']);
                if($id!='')
                {
                    $this->db->where('id',$id);
                    $this->db->update($table_name,$data);
                }
                return $this->db->affected_rows();
            }
        }
    }
    public function verify_employer_email($data)
    {
        $this->db->where('email',$data['email']);
        $query=$this->db->get('employer');
        return $query->num_rows();
    }
    public function update_employer($data)
    {       
        $this->db->where('id',$data['id']);
        unset($data['id']);
        $this->db->update('employer',$data);
        return $this->db->affected_rows();
    }
    public function get_employer_id($data)
    {
       $id='';
        $this->db->where('email',$data['employer_email']);
        $query=$this->db->get('employer');
        if($query->num_rows()>0)
        {
            $res= $query->result_array();
            $id=$res[0]['id'];
        }
        return $id;        
    }
    public function save_password($data)
    {
        $update_data['password']=$data['password'];
        $this->db->trans_start();
        $this->db->where('id',$data['id']);
        $this->db->update('employer',$update_data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return 0;
        }
        return 1;
    }
}

?>
