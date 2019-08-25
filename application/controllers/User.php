<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){

	   parent::__construct();
	   $config['upload_path']="./uploads";
       $config['allowed_types']='gif|jpg|png|jpeg';
       $this->load->library('upload',$config);

       $this->load->model('user_model');
	}
	
	public function index()
	{
		$data['user']=$this->user_model->get_data('tbl_user');
		$this->load->view('user',$data);
	}

	public function upload_file()
	{
       if(!$this->upload->do_upload("file"))
       {
	        $file_name='';
	   }
	  else
	  {
	  	 $data =$this->upload->data();
	     $file_name=$data['file_name']; 
	  }
	    echo $file_name;
}

   public function add_user(){

   	$data=$this->input->post();
   	//print_r($data);die;
   	$result=$this->user_model->add_data('tbl_user',$data);
   	if($result){
   		echo "success";
   	}
   	else{
   		echo "failed";
   	}
   }


   public function user_delete(){
   	
   	 $result=$this->user_model->delete_data('tbl_user','uid',$this->input->post('id'));
     if($result){
     	echo "success";
     }else{
     	echo "failed";
     }

   }

    public function user_editform(){
   	 
   	 $data['user']=$this->user_model->get_datawhere('tbl_user','uid',$this->input->post('id'));
    
     $this->load->view('edit_user',$data);

   }

    public function edit_user(){
   	 //print_r($this->input->post());die;
   	 $id=$this->input->post('uid');
   	 $data=$this->input->post();
   	 $result=$this->user_model->edit_data('tbl_user','uid',$id,$data);
     if($result){
     	echo "success";
     }else{
     	echo "failed";
     }

   }


}