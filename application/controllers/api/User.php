<?php
require APPPATH . 'libraries/REST_Controller.php';
class User extends REST_Controller{


        public function __construct(){
            parent::__construct();
        }

        public function user_get(){

            $this->set_response("this is test",REST_Controller::HTTP_OK);

        }

        public function create_post(){
           //registers user= 
                //validates if accounts already exist 
                //if not create
                //else
                //throw error

            //update fields :  add auth_type after facebook integration
            $allowedPostDetails = array('firstName','lastName','email','username','password','interests');

            $inputData = $this->post();
           //check for allowed fields;
            if(!(count($inputData) == count($allowedPostDetails))){
                $this->response("nehi");
            }
            

            //just incase post send one that is not in the allowed list
            $newData =array();            
            $notAllowedFlag = false;
            foreach($inputData as $key => $value){
                
                if(!in_array($key,$allowedPostDetails)){
                    //$this->response($key);
                    $notAllowedFlag = true;
                    break;
                }
              
              $newKey = "userClient_" . $key;
              $newData[$newKey] = $value;
            
            }

            if($notAllowedFlag){
                $this->response(array("error"=>true,"msg"=>"Invalid Post Data"));
            }
                
           // $this->set_response(array("This is a test post"));
           //$this->set_response($this->input->request_headers()['Authorization']);
           $checkUser = $this->user_model->hasUser($newData['userClient_username'],$newData['userClient_email']);
           
           if(isset($checkUser['error'])){
               $this->response($checkUser);
           }

           if($checkUser['has']){
               $this->response($checkUser);
           }

            //if username and email does not exist
            if(!$checkUser['has']){

                //md5 password
                $newData['userClient_password'] = md5($newData['userClient_password']);
                
                $createResponse = $this->user_model->registerUser($newData);
                $this->response($createResponse);

            }



        }

       
}


?>