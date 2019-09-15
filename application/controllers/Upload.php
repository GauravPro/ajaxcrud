<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function __construct(){

	   parent::__construct();
  	   $config['upload_path']="./uploads";
       $config['allowed_types']='gif|jpg|png|jpeg';
       $config['max_size']             = 1024;
       $this->load->library('upload',$config);
       $this->load->model('user_model');
       $this->load->library('form_validation');
	}
	
	public function index()
	{
		if($this->input->post())
    {
            $this->form_validation->set_rules('firstname', 'Username', 'required');
            $this->form_validation->set_rules('lastname', 'Lastname', 'required', array('required' => 'Plz Enter Lastname.'));
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required',
                    array('required' => 'You must provide a %s.')
            );


            if ($this->form_validation->run() == FALSE)
              {
                    // $error = array('status' =>validation_errors());
                    $error = array(
                                'form_error'=>1, 
                                'firstname_error' => form_error('firstname'),
                                'lastname_error' => form_error('lastname'),
                                'email_error' => form_error('email'),
                                'password_error' => form_error('password')
                               );
                              echo json_encode($error);   
              }
              else
              {
                      if ( !$this->upload->do_upload('user_image'))
                      {
                        $error = array('form_error'=>2,'status' => $this->upload->display_errors());
                        echo json_encode($error);   
                  }else
                      {
                        $data = array('upload_data' => $this->upload->data());
                        print_r($data);die; 
                     }
                    }
       }
   
    else
       {
         $this->load->view('upload_data');
       }
   
	}

}