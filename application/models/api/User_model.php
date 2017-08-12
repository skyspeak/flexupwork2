<?php 

class User_Model extends CI_Model{


        public function __construct(){
            $this->load->database();
        }


        public function hasUser($username,$email){

            $returnReponse = array();

            if(!isset($username)&& !isset($email)){
                $returnReponse['error'] = true;
                $returnReponse['msg'] = "Unauthorized Access";
                return $returnReponse;   
            }
            
            //check for both
            $bothCheck = $this->db->get_where("clientuser",array("userClient_username"=>$username,"userClient_email"=>$email));

            if(!empty($bothCheck->row_array())){
                $returnReponse['has'] = true;
                $returnReponse['msg'] = "Username and email already registered"; 
                return $returnReponse;
            }

            $usernameCheck = $this->db->get_where("clientuser",array("userClient_username"=>$username));

            if(!empty($usernameCheck->row_array())){
                $returnReponse['has'] = true;
                $returnReponse['msg'] = "Username already registered"; 
                return $returnReponse;
            }

            $emailCheck = $this->db->get_where("clientuser",array("userClient_email"=>$email));

            if(!empty($emailCheck->row_array())){
                $returnReponse['has'] = true;
                $returnReponse['msg'] = "Email already registered"; 
                return $returnReponse;
            }

            //returns the response
                //msg
                //has
            $returnReponse['has'] = false;
            $returnReponse['msg'] = "User Available"; 
            return $returnReponse;
        }


        public function registerUser($data){

            $returnReponse =array();

            if(empty($data)){
                $returnReponse['error'] = true;
                $returnReponse['msg'] = "Unauthorized Access";
                return $returnReponse;
            } 

            //Double check;
            //$checkUser = $this->hasUser($data['userClient_username'],$data['userClient_email']);

            $createUser = $this->db->insert("clientuser",$data);

            if(!$createUser){
                $returnReponse['error'] = true;
                $returnReponse['msg'] = "Fatal Internal Error";
                return $returnReponse;
            }

            if($this->db->affected_rows()>0){
                $returnReponse['success'] = true;
                $returnReponse['msg'] = "User Created";
                
            }else{
                $returnReponse['success'] = false;
                $returnReponse['msg'] = "Failed to create user";
                
                
            }

            return $returnReponse;

        }


}