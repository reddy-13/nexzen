<?php

/**
 * Leaves model
 */
class Leave_model extends CI_Model
{
	
	public function get_school_leaves($school_id){

            $q = $this->db->query("select * from all_leave where school_id='".$school_id."' and student_id IS NOT NULL");
            return $q->result();

        // $this->db->select("student_detail.student_name as student_name, teacher_detail.teacher_name as teacher_name");
        // $this->db->from("student_detail as student");
        // $this->db->from("teacher_details as teacher");
        // $this->db->join("student_");

    }



}