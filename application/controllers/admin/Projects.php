<?php

//implement with angularjs for the backend , not jQuery for ajaxiying;


class Projects extends CI_Controller{

    public function index(){

        $this->load->view("templates/header");
        
        $projects = $this->project_model->getAllProjects();
        if(!$projects['success']){
            die($projects['msg']);
        }else{
            $this->load->view("mainViews/projectListing",array("projects"=>$projects));
        }

        $this->load->view("templates/footer");
    }

    public function create(){
        //redirect to login page if not logged in
        if(!$this->session->has_userdata('loggedIn')){
            redirect("admin/login");
        }

        $this->form_validation->set_rules('name','Project Name',"required");
        $this->form_validation->set_rules('timeline','Timeline');
        $this->form_validation->set_rules('fields','Field',"required");
        $this->form_validation->set_rules('location','Location');

        
        $this->load->view("templates/header");
        if($this->form_validation->run()== false){
        $fields = array('projectFields'=>$this->project_model->getFieldsList());
        
        $this->load->view("mainViews/createProject",$fields);
        }else{
            $data = $this->input->post();
            $sendData =array();
            foreach($data as $key => $value){
                $key = "project_" . $key;
                $sendData[$key] =$value;
            }
            
            //adding the admin details
            $sendData['created_by'] = $this->session->userdata('admin_id');
            //return name of the field choosen
            $sendData['project_fields'] = $this->project_model->getFieldById($sendData['project_fields']);
            $response = $this->project_model->createProject($sendData);

            if($response['success']){
                redirect("/admin/projects/");
            }else{
                echo $response['msg']; 
            }
            //error handle here
        }

    }

    //function that handles the updating thumbnails
    public function projectimage($id){


            $uploadResponse = array();

            $config['upload_path'] = "./data/thumbs";
            $config['allowed_types'] = "png|jpg|jpeg";
            $config['max_size'] = "5120";
            $config['encrypt_name'] = true;

            $this->load->library("upload",$config);
            
            if(!$this->upload->do_upload()){
                //if upload fails
                $uploadResponse['success'] = false;
                $uploadResponse['msg']= "Upload Failed : " . $this->upload->display_errors();
            }else{

                $filePath=$this->upload->data("file_name");
                $update = $this->project_model->updateProjectImage($id,$filePath);

                if($update){
                    $uploadResponse['success'] = true;
                    $uploadResponse['msg'] = $update['msg'];
                    
                }else{
                    $uploadResponse['success'] = false;
                    $uploadResponse['msg'] = $update['msg'];
                }

            }
            
            $this->session->set_flashdata('uploadInfo',$uploadResponse);
            redirect("/admin/projects/edit/" . $id);

    }



    //handles editing Project Meta Data and Viewing Per Project
    public function edit($id){
        if(!isset($id)){
            redirect("/admin/projects");
        }

        $hasProject = $this->project_model->hasProject($id);
        if(!$hasProject){
            redirect("/admin/projects");
        }

        if($hasProject){
        
        $projectData = $this->project_model->getProjectByID($id);
        
        //If success false , means there is usually a Internal Error
        if(!$projectData['success']){
            die($projectData['msg']);
        }

        $viewResponse['projectInfoData'] = $projectData['data']['projectData'];

        /* start of flash data handling*/
        if(isset($projectData['data']['partData'])){
            $viewResponse['projectParts'] =$projectData['data']['partData'];
        }

        $viewResponse['projectFields'] = $this->project_model->getFieldsList();

        if($this->session->flashdata("uploadInfo")){
            $viewResponse['uploadInfo'] = $this->session->flashdata("uploadInfo");
        }

        if($this->session->flashdata('updateStatus')){
            $viewResponse['updateStatus'] = $this->session->flashdata('updateStatus');
        }

        if($this->session->flashdata('partCreated')){
            $viewResponse['partCreated'] = $this->session->flashdata('partCreated');
        }


        /**end of flash data handling*/



        $this->load->view("templates/header");
        
        $this->form_validation->set_rules('name','Project Name',"required");
        $this->form_validation->set_rules('timeline','Timeline');
        $this->form_validation->set_rules('fields','Field',"required");
        $this->form_validation->set_rules('location','Location');
        $this->form_validation->set_rules('description','Description',"required");

        if($this->form_validation->run()== false){

            $fields = array('projectFields'=>$this->project_model->getFieldsList());
            $this->load->view("projectViews/projectPage",$viewResponse);

        }else{
            
            //Get all the updates

            $data = $this->input->post();
            $updateData =array();
            foreach($data as $key => $value){
                $key = "project_" . $key;
                $updateData[$key] =$value;
            }
            
            $updateData['project_fields'] = $this->project_model->getFieldById($updateData['project_fields']);
            $response = $this->project_model->updateProject($id,$updateData);

            $this->session->set_flashdata('updateStatus',$response);
            redirect('/admin/projects/edit/'.$id);

        }

        
        $this->load->view("templates/footer");


        }
    
    }

    //redirect to the parts
    public function parts(){
        redirect("/admin/projects/parts");
    }
    




}