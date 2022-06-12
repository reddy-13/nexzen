<?php

/**
 * Leaves model
 */
class Leave_model extends CI_Model
{
	
	public function get_student_leaves($school_id){
            // $q = $this->db->query("select * from all_leave where school_id='".$school_id."' and student_id IS NOT NULL");
            // return $q->result();
        $this->db->select("leave.id as id, student.student_name as student_name, leave.subject, leave.description, leave.documents, leave.from_date, leave.to_date, leave.status");
        $this->db->from("all_leave as leave");
        $this->db->join("student_detail as student","student.student_id=leave.student_id","left");
        $this->db->where("leave.school_id", $school_id);
        
        $this->db->where("student.student_id IS NOT NULL",NULL,FALSE);
        $q = $this->db->get();
        return $q->result();
    }
    public function get_teacher_leaves($school_id){
            // $q = $this->db->query("select * from all_leave where school_id='".$school_id."' and student_id IS NOT NULL");
            // return $q->result();
        $this->db->select("leave.id as id, teacher.teacher_name as teacher_name, leave.subject, leave.description, leave.documents, leave.from_date, leave.to_date, leave.status");
        $this->db->from("all_leave as leave");
        $this->db->join("teacher_detail as teacher","teacher.teacher_id=leave.teacher_id","left");
        $this->db->where("leave.school_id", $school_id);
        $this->db->where("teacher.teacher_id IS NOT NULL",NULL,FALSE);
        $q = $this->db->get();
        return $q->result();
    }

     public function total_due($school_id)
    {
        #total due by school id
        $this->db->select("sum(fee.base_amount) as total_amount, sum(su.pay_fee_amount) - sum(fee.base_amount) as total_due");
        $this->db->from("student_detail as student");
        $this->db->join("fee_types as fee", "student.school_id=fee.school_id", "left");
        $this->db->join("student_fees as su", "student.school_id=su.school_id", "left");
        $this->db->where("student.school_id", $school_id);

        $q = $this->db->get();

        return $q->result();
    }



}