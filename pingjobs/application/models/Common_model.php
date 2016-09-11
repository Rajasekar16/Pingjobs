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
        $order_by=isset($data['order_by'])?$data['order_by']:'';
        if($table_name!='')
        {
            if($where!='')
            {   
                $this->db->where($where);
            }
            if($order_by!='')
            {
                $this->db->order_by($order_by);
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

    public function mappingTable($data)
    {
        $table_name=$data['table_name'];
        unset($data['table_name']);
        if($table_name!='')
        {
            if(!empty($data))
            {
				$getData = array();
				$getData['table_name'] = $table_name;
				$getData['where'] = $data['primary_id']." = ".$data['primary_value'];
				$result = $this->get_master($getData);
				
				$primary_id = $data['primary_id'];
				$primary_value = $data['primary_value'];
				unset($data['primary_id']);
				unset($data['primary_value']);
				if(empty($result))
                {
					foreach($data AS $key=>$values)
					{
						foreach($values as $rowData)
						{
							$this->db->set($primary_id,$primary_value);
							$this->db->set($key,$rowData);
							$this->db->insert($table_name);
						}
					}
                    return 1;         
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
    
	public function  get_captcha()
	{
		$this->load->helper('captcha');

		$vals = array(
			'word_length'=>6,
		    'img_path' => './captcha/',
		    'img_url' => base_url().'captcha/',
			'font_path' => './fonts/MuseoSansRounded-900-webfont.ttf',
			'img_width' => '150',
			'img_height' => 30,
			'expiration' => 3600
		    );
		
		$cap = create_captcha($vals);
		
		$data = array(
		    'captcha_time' => $cap['time'],
		    'ip_address' => $this->input->ip_address(),
		    'word' => $cap['word']
		    );
		
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
		
		$str = '';
		$str = '<div class="form-group required">
					<label class="col-md-5 control-label" for="captcha">Enter captcha:</label>  
					<div class="col-md-4">'.
						$cap['image'].'
					</div>
					<div class="col-md-3 pad-lt-0">
						<input class="form-control" placeholder="Enter captcha" maxlength="'.strlen($cap['word']).'" type="text" name="captcha" id="captcha" value="" required="required" />
					</div>
				</div>';
		return $str;
	}
	
	public function check_captcha($captcha='')
	{
		// First, delete old captchas
		$expiration = time()-3600; // one hour limit
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
		
		$captcha = ($captcha=='') ? $this->input->post('captcha') : $captcha;
		
		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		
		if ($row->count == 0)
		{
			return false;
		}
		return true;
	}
	
}

?>