<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        // $this->load->model('Master_model');
        $this->load->model('Common_model');
    }
	
	public function index()
	{

	}
	public function  move()
	{
		$filename = $this->input->post('fname');
		$remote_file_url = 'http://www.asterhr.com/ping/upload/'.$filename;
		/* New file name and path for this file */
		$local_file = 'upload/'.$filename;
		/* Copy the file from source url to server */
		$copy = copy( $remote_file_url, $local_file );
		/* Add notice for success/failure */
		if( !$copy ) {
		//echo "error";
		}
		else{
		//echo "ok";
		}
	}
	
	public function deleteRecord()
	{
		$json=array();
		$json['status']='err';

		$tableArr=$GLOBALS['tables'];

		$tableId=$_POST['tableId'];
		$tableDetail=$tableArr[$tableId];
		if(!empty($tableDetail))
		{
			$sendData['tableName']=$tableDetail['tableName'];
			$sendData['whereFiled']=$tableDetail['whereFiled'];
			$sendData['ids']=json_decode($_POST['ids']);
			$result=0;
			if($tableDetail['deleteType']=='deleteUpdate')
			{
				$sendData['updateFiled']=$tableDetail['updateFiled'];			
				$result=$this->Common_model->deleteUpdate($sendData); 
			}
			else if($tableDetail['deleteType']=='deleteRemove')
			{
				$result=$this->Common_model->deleteRemove($sendData);
				
			}
			if($result>0)
			{
				$json['status']='ok';
			}
		}
			echo json_encode($json);
	}
	public function getDetail()
	{
		$json=array();
		$json['status']='err';
		$json['data']='';

		$tableArr=$GLOBALS['tables'];		
		$tableId=$_POST['tableId'];
		$tableDetail=$tableArr[$tableId];

		$master_data=array();
		$master_data['table_name']=$tableDetail['tableName'];
		$master_data['where']=' id ='.$_POST['id'];
		$list=$this->Common_model->get_master($master_data);	

		if(!empty($list))
		{
			$json['data']=$list[0];
			$json['status']='ok';
		}
		echo json_encode($json);	
	}

}
