<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                $this->load->helper('login_helper');
    }
 
    public function manage_notification(){
        if(_is_user_login($this)){
             $data["error"] = "";
              $this->load->model("standard_model");
           $this->load->model("teacher_model");
           $this->load->model('school_model');
            $this->load->model("notification_model");

            if(_get_current_user_type_id($this) == 1){
              $school_data = $this->school_model->get_school_profile();

            }else if(_get_current_user_type_id($this) == 2){
              $school_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));
            }
            
            $data["notification"] = $this->notification_model->get_notification($school_data->school_id);
            
            $this->load->view("notification/manage_notification",$data);
        }
    }
     function delete_notification($noti_id){
                $this->db->query("Delete from notification where noti_id = '".$noti_id."'");
                redirect("notification/manage_notification");
    
    } 
  
}