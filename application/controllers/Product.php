<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public  function __construct($foo = null)
    {
      parent::__construct();
      $this->load->model('product_model');
    }

    public function index()
	{
		
    $this->load->view('product');
	}

	
    function add_product()
    {
       $data=$this->input->post();
       $result=$this->product_model->add_data('tbl_product',$data);
       if($result){
        echo 'success';
       }else{
        echo "failed";
       }
    }

     function uplaod_image()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

      $filesCount = count($_FILES['file']['name']);
            for($i = 0; $i < $filesCount; $i++){

                $_FILES['file[]']['name']     = $_FILES['file']['name'][$i];
                $_FILES['file[]']['type']     = $_FILES['file']['type'][$i];
                $_FILES['file[]']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                $_FILES['file[]']['error']     = $_FILES['file']['error'][$i];
                $_FILES['file[]']['size']     = $_FILES['file']['size'][$i];
              
              if (!$this->upload->do_upload('file[]')) {
                 echo $filename = '';
              } else {
                
                 $data = $this->upload->data();
                 $file[]=$data['file_name'];
                
                }  
                
          }
            $string_version = implode(',',$file);
                  echo $string_version;
    }


    function delete_product(){
       // print_r($this->input->post('id'));die;
      $result=$this->product_model->delete_data('tbl_product','prodcut_id',$this->input->post('id'));
      if($result){
        echo "success";
      }else{
         echo "failed";
      }
    }

    function editform(){
      $data['product']=$this->product_model->get_productwhere($this->input->post('id'));
        $this->load->view('edit_product',$data);
    }

    function edit_product(){
       
      $id=$this->input->post('prodcut_id');
      $data=$this->input->post();
       //print_r($data);die;
      $result=$this->product_model->edit_data('tbl_product','prodcut_id',$data,$id);
      if($result){
        echo "success";
      }else{
         echo "failed";
      }
    }

  }  