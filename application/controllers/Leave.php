<?php

defined("BASEPATH") or exit('No directed script access allowed');

/**
 * 
 */
class Leave extends CI_Controller
{
	
	function __construct()
	{
		// code...
		parent::__construct();
		$this->load->database();
		$this->load->helper('login_helper');
		$this->load->model("school_model");
		 $this->load->model("teacher_model");
		$this->load->library('session');
	}

	public function index(){
		if(_is_user_login($this)){
			
			$data = [];
			$school_data = $this->school_model->get_school_profile();
			if (_get_current_user_type_id($this) == 1) {
        		$school_id = $school_data->school_id;
      		} elseif (_get_current_user_type_id($this) == 2) {
        		$teacher_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));
		        $school_id = $teacher_data->school_id;
		        # code...
	      }

	      $this->load->model('leave_model');
	      // echo "<pre>";

	      // print_r($school_id);


	      $data['leaves'] = $this->leave_model->get_school_leaves($school_id);

	      $this->load->view('leave/list_leave',$data);
		}
	}

	
}