<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  for cecking already data is availabel ofr not
 * Coded by G.Goutham Reddy // email // G.Goutham Reddy
 */
class Check extends CI_Controller
{
	
	public function __construct()
     {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                
                header('Content-type: text/json');
     }



     public function check_machine_id()
     {
     	if($_REQUEST['punch_machine_id'] != ""){

     		$punch_machine_id = $_REQUEST['punch_machine_id'];

     		$query = $this->db->where('punch_machine_id',$punch_machine_id)->get('school_detail');
     		if($query->num_rows() > 0){
     			echo json_encode(["status" => 0 , "msg" => "This machine id is already assigned"]);
     		}else{
     			echo json_encode(["status" => 1, "msg" => "ok "]);
     		}
     	}
     }

     public function check_school_email()
     {
     	if($_REQUEST['school_email'] != ""){

     		$school_email = $_REQUEST['school_email'];

     		$query = $this->db->where('school_email',$school_email)->get('school_detail');
     		if($query->num_rows() > 0){
     			echo json_encode(["status" => 0 , "msg" => "This school_email id is already taken."]);
     		}else{
     			echo json_encode(["status" => 1, "msg" => "ok "]);
     		}
     	}
     }

     //check_teacher_email

     public function check_teacher_email()
     {
     	if($_REQUEST['teacher_email'] != ""){

     		$teacher_email = $_REQUEST['teacher_email'];

     		$query = $this->db->where('teacher_email',$teacher_email)->get('teacher_detail');
     		if($query->num_rows() > 0){
     			echo json_encode(["status" => 0 , "msg" => "This teacher_email id is already taken."]);
     		}else{
     			echo json_encode(["status" => 1, "msg" => "ok "]);
     		}
     	}
     }
}
 ?>