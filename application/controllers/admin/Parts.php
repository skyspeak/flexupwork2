<?php

class Parts extends CI_Controller{


        public function index(){
            echo "this is a test to see the parts page";
        }

    //id of the project :  need to implement checks later on;
    public function create($id){
        //create part 
        //after part is created goes to part view page (project_part is the table)
        //when in edit part can add reading list and tasks (project_part_reading  | project_part_task  all in two table)
        //when deleting part (delete by  getting part  and project id)

        if(!isset($id)){
            redirect("/admin/projects");
        }

        if(!$this->project_model->hasProject($id)){
            redirect("/admin/projects/");
        }

        $viewReponse =array();
        $viewReponse['project_id'] = $id;
        $this->form_validation->set_rules('part_name','Part Title',"required");
        $this->form_validation->set_rules('part_description','Part Description');


        if($this->form_validation->run()){
            $data = $this->input->post();
            $data['project_id'] = $id;
            $response =$this->projectpart_model->createPart($data);
            if($response['success']){
                $partCreate = $response;
                $this->session->set_flashdata('partCreated' , $partCreate);
                redirect("/admin/projects/edit/".$id);
            }else{
                $viewReponse['createError'] = $response;
            }

        }


            //show the page
            $this->load->view("templates/header");

            $this->load->view("projectPartsView/createPart",$viewReponse);

            $this->load->view("templates/footer");




    
    }

    //edits the part details 
    //$id here and all is project id
    public function edit($project_id,$part_id = null){
            $viewReponse = array();
            
            if($part_id == null){
                redirect("/admin/projects/edit/" . $project_id);
            }
            
            if(!$this->project_model->hasProject($project_id)){
                redirect("/admin/projects/");
            }

            if(!$this->projectpart_model->hasProjectPart($part_id,$project_id)){
                redirect("/admin/projects/edit/" . $project_id);
            }

                $this->form_validation->set_rules("part_name" , "Task Name" , "required");
                $this->form_validation->set_rules("part_description" , "Task Details" , "required");

                if($this->form_validation->run()){

                    $data = $this->input->post();
                    
                    if(empty($data)){
                        die("Internal Error");
                    }
                    
                    $editResponse = $this->projectpart_model->editPart($data,$project_id,$part_id);
                    $viewReponse['editPart'] = $editResponse;

                }

                $partDetails = $this->projectpart_model->getProjectPartByID($part_id,$project_id);

                $viewReponse['project_id'] = $project_id;
                $viewReponse['part_id'] = $part_id;
                $viewReponse['partDetails'] = $partDetails['data'];
                print_r($partDetails['data']);
                //print_r($partDetails);
                
                //Loading all the files
                $this->load->view("templates/header");
                $this->load->view("projectPartsView/partPage",$viewReponse);
                $this->load->view("templates/footer");

            


    }

    public function delete($id){




    }


    //Add reading list and task  :  based on the [type] in the POST Array
    public function add($project_id,$part_id=null,$post_type=null){

        // If project is not there
        if(!$this->project_model->hasProject($project_id)){
            redirect("/admin/admin/");
        }

        if(!$this->projectpart_model->hasProjectPart($part_id,$project_id)){
            redirect("/admin/projects/edit/" . $project_id );
        }

        // Redirect if post type not specified
        if($post_type == null){
            redirect("/admin/projects/". $project_id);
        }


        $viewReponse =array();

        $viewReponse['project_id'] = $project_id;
        $viewReponse['part_id'] = $part_id;

        if($post_type == "task"){


                // Setting Up the Task
                 $this->form_validation->set_rules("task_name" , "Task Name" , "required");
                $this->form_validation->set_rules("task_details" , "Task Details" , "required");
               
                
                $viewReponse['post_type'] = $post_type;
                if($this->form_validation->run()){

                    $taskDetails = $this->input->post();
                    $taskCreate = $this->projectpart_model->createTask($project_id,$part_id,$taskDetails);
                    $viewReponse['taskDetails'] =  $taskCreate;
                    if($taskCreate['success']){
                        $this->session->set_flashdata("taskCreated",$taskCreate);
                        redirect("/admin/projects/parts/edit/".$project_id. "/" .$part_id );
                    }else{
                        $viewReponse['createError'] = $response;
                    }
                }

                $this->load->view("templates/header");
                $this->load->view("projectPartsView/createTask",$viewReponse);
                $this->load->view("templates/footer");




        }else if($post_type == "reading"){


               // Setting Up the Task
                 $this->form_validation->set_rules("readingList_name" , "Reading List Name" , "required");
                $this->form_validation->set_rules("readingList_link" , "Reading List Link" , "required");
               
                
                $viewReponse['post_type'] = $post_type;
                if($this->form_validation->run()){

                    $readDetails = $this->input->post();
                    $readCreate = $this->projectpart_model->createReading($project_id,$part_id,$readDetails);
                    $viewReponse['taskDetails'] =  $readCreate;
                    if($readCreate['success']){
                        $this->session->set_flashdata("taskCreated",$readCreate);
                        redirect("/admin/projects/parts/edit/".$project_id. "/" .$part_id );
                    }else{
                        $viewReponse['createError'] = $response;
                    }
                }

                $this->load->view("templates/header");
                $this->load->view("projectPartsView/createReading",$viewReponse);
                $this->load->view("templates/footer");


        }else{
            //Invalid Post Type
            redirect("/admin/projects/"/$project_id);
        }
        
               

    }



}