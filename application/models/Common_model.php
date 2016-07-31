<?php
class Common_model extends CI_Model
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

    public function get_master($data)
    {
        $result=array();
        $table_name=$data['table_name'];
        $where=isset($data['where'])?$data['where']:'';
        if($table_name!='')
        {
            if($where!='')
            {   
                $this->db->where($where);
            }
            $query=$this->db->get($table_name);

            $result=$query->result_array();
        }
        return $result;
    }
    public function add_update($data)
    {
        $table_name=$data['table_name'];
        unset($data['table_name']);
        if(isset($data['tableId']))
        {
            unset($data['tableId']);
        }
        if($table_name!='')
        {
            if(!empty($data))
            {
                $mode=$data['mode'];
                unset($data['mode']);

                if($mode=='create')
                {
                    if(isset($data['editId']))
                    {
                        unset($data['editId']);
                    }
                    $this->db->insert($table_name,$data);
                    return $this->db->insert_id();             
                }else
                {
                    $editId=$data['editId'];
                    unset($data['editId']);
                    if($editId!='')
                    {
                        $this->db->trans_start();
                        $this->db->where('id',$editId);
                        $this->db->update($table_name,$data);
                        $this->db->trans_complete();
                        if($this->db->trans_status())
                        {
                            return 1;
                        }
                    }
                    return $this->db->affected_rows();
                }
            }
        }
    }

    public function deleteRemove($data)
    {
        if($data['whereFiled'] !='' && !empty($data['ids']))
        {
            $this->db->where_in($data['whereFiled'],$data['ids']);
            $this->db->delete($data['tableName']);
            return $this->db->affected_rows();
        }
    }

    public function deleteUpdate($data)
    {
        if($data['whereFiled'] !='' && !empty($data['ids']))
        {
            $updateData[$data['updateFiled']]=3;
            $this->db->where_in($data['whereFiled'],$data['ids']);
            $this->db->update($data['tableName'],$updateData);
            return $this->db->affected_rows();
        }
    }
    public function verify_login($data)
    {
    $type =$data['type'];
    if($type == 'employee')
    {
        $result=array();
        $return_data=array();
        $this->db->where('employee_email',$data['email']);       
        //$this->db->join('country','country.con_id=user.usr_con_id','left');
        $query=$this->db->get('employee');
        if($query->num_rows()>0)
        {
            $result=$query->row_array();
             $data['user_hash'] = $result['usr_password'];
             $data['user_pass'] = $data['usr_password'];
             if(compare_lsa_pass($data))
             {
                $return_data = $result;
             }
        }
        return $return_data;

        }
        
    }
}

?>
