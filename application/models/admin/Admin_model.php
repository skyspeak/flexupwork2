<?php

class Admin_Model extends CI_Model{

    public function __construct(){
        $this->load->database();
    }


    public function registerAdmin($data){
        if(!empty($data)){
            if($this->db->insert("adminuser",$data)){
                return true;
            }
        }

        return false;

    }

    public function loginAdmin($data){

        if(!empty($data)){
            $response = $this->db->get_where("adminuser",$data);
            if($response->num_rows() == 1){
                $data = $response->row_array();
                unset($data['password']);
                return array('success'=>true,'data' =>$data,'msg'=>"Login Successful"); 
            }else{
                return array('success'=>false,'msg'=>"Incorrect/Password");
            }
        }else{
            return array('success'=>false,'msg'=>"Internal Error");
        }


    }

    public function isAdminExists($data,$field){

        $response = $this->db->get_where("adminuser",array($field=>$data));
        ///print_r($response->row_array());
        if(empty($response->row_array())){
            return true;
        }else{
            return false;
        }


    }

}