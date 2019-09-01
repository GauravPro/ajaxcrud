<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function __construct(){
		parent::__construct();
	  $this->load->model('crud_model');

	   $config['upload_path']="./uploads";
        $config['allowed_types']='gif|jpg|png|jpeg';
        $this->load->library('upload',$config);

	}
   
    public function upload_file()
	{
	   //print_r($_FILES['file']);die;
	   if(!$this->upload->do_upload('file')){
          $filename="";
       }else{
       	   $data = $this->upload->data();
           $filename=$data['file_name'];
       }
       echo $filename;
	}

	public function index()
	{
		$data['user']=$this->crud_model->fetch_data('tbl_user');
		$this->load->view('crud',$data);
	}

	public function add_user()
	{
		$data=$this->input->post();
		
		$result=$this->crud_model->add_data('tbl_user',$data);
		if($result){
           echo json_encode(array("response"=>"success"));
		}else{
            echo json_encode(array("response"=>"failes"));
		}
	}

	public function delete_user(){
		$id=$this->input->post('id');
		//print_r($id);die;
		$result=$this->crud_model->delete_data('tbl_user','uid',$id);
		if($result){
           echo json_encode(array("response"=>"success"));
		}else{
            echo json_encode(array("response"=>"failes"));
		}
	}

	public function edit_form(){
		$id=$this->input->post('id');
		//print_r($id);die;
		$data['user'] =$this->crud_model->fetch_datawhere('tbl_user','uid',$id);
		//print_r($data['user']);die;
		$this->load->view('edit_crud',$data);
	}

	public function edit_user(){
		$id=$this->input->post('uid');
		$data=$this->input->post();
		//print_r($id);die;
		$result=$this->crud_model->edit_data('tbl_user',$data,'uid',$id);
		if($result){
           echo json_encode(array("response"=>"success"));
		}else{
            echo json_encode(array("response"=>"failes"));
		}
	}
}
