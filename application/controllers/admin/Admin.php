<?php

class  Admin extends CI_Controller{


    public function index(){
    
    }

    public function register(){

        $this->form_validation->set_rules("name","Full Name","required");
        $this->form_validation->set_rules("username","Username","required|callback_check_username_exists");
        $this->form_validation->set_rules("email","Email","required|valid_email|callback_check_email_exists");
        $this->form_validation->set_rules("password","Password","required");

        $this->load->view("templates/header");

        if($this->form_validation->run() == false){
            $this->load->view("mainViews/register");
        }else{
            $data = array(
                'username'=> $this->input->post("username"),
                'password'=>md5($this->input->post("password")),
                'name'=> $this->input->post("name"),
                'email'=>$this->input->post("email")
                );

            $response = $this->admin_model->registerAdmin($data);
            if($response){
                echo "registered";
            }else{
                echo "error occured";
            }

        }

        $this->load->view("templates/footer");

    }

        //Login Code for Admin
        public function login(){

        $this->form_validation->set_rules("username","Username","required");
        $this->form_validation->set_rules("password","Password","required");

        $this->load->view("templates/header");

        if($this->form_validation->run() == false){
            $this->load->view("mainViews/login");
        }else{
            $data = array(
                'username'=> $this->input->post("username"),
                'password'=>md5($this->input->post("password")),
                 );

            $response = $this->admin_model->loginAdmin($data);
            if(!empty($response)){
                if($response['success']){
                    echo  $response['msg'];
                    print_r($response['data']);
                    $sessionData = $response['data'];
                    $sessionData['loggedIn'] = true;
                    $this->session->set_userdata($sessionData);
                    print($this->session->userdata("loggedIn"));
                    redirect("/admin/projects");
                }else{
                    echo $response['msg'];
                }
            }else{
                echo "Internal Error";
            }

        }

        $this->load->view("templates/footer");

    }

    //Form Custom Validations
    public function check_username_exists($username){
        $this->form_validation->set_message("check_username_exists","That username is already taken");

        if($this->admin_model->isAdminExists($username,'username')){
            return true;
        }else{
            return false;
        }
    }
    
    public function check_email_exists($email){
        $this->form_validation->set_message("check_email_exists","That email is already in use");

        if($this->admin_model->isAdminExists($email,'email')){
            return true;
        }else{
            return false;
        }
    }
}