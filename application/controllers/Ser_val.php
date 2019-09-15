<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ser_val extends CI_Controller {

	public function index()
	{
	    $this->load->helper(array('form'));
        $this->load->library('form_validation');
		
		if($this->input->post()){
                $this->form_validation->set_rules('firstname', 'Username', 'required');
                $this->form_validation->set_rules('lastname', 'Lastname', 'required');
                 $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required',
                        array('required' => 'You must provide a %s.')
                );
                 
              
              if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('validation',array('error' =>''));
                }
                else
                {
				     // print_r($_FILES['user_image']['name']);die;

				        $config['upload_path']          = './uploads/';
		                $config['allowed_types']        = 'gif|jpg|png';
		                $config['max_size']             = 1024;
		                $config['max_width']            = 1024;
		                $config['max_height']           = 768;

		                $this->load->library('upload', $config);

		                  if ( !$this->upload->do_upload('user_image'))
		            {
		                    $error = array('error' => $this->upload->display_errors());

		                    $this->load->view('validation', $error);
		            }
		            else
		            {
		                    $data = array('upload_data' => $this->upload->data());
		                    print_r($data);die; 

                  }
             }
            }
             else{   
		      $this->load->view('validation',array('error' =>''));

	         }
	}
}
