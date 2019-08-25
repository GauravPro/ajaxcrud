<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	public function add_data($table,$data)
	{
		$result=$this->db->insert($table,$data);
		 if($result){
             return true;
		 }else{
           return false;
		 }
	}

	public function get_data($table)
	{
		$result=$this->db->get($table)->result();
           return $result;
	}

	public function delete_data($table,$column,$id)
	{
       $result=$this->db->where($column,$id)->delete($table);
                       
          if($result){
          	return true;
          } else{
          	return false;
          }              
	}

	public function get_productwhere($id){
       $result=$this->db->where('prodcut_id',$id)->get('tbl_product')->result();
	   return $result;
	}

	public function edit_data($table,$column,$data,$id)
	{
       $result=$this->db->where($column,$id)->update($table,$data);
                       
          if($result){
          	return true;
          } else{
          	return false;
          }              
	}
}