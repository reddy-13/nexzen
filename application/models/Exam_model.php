<?php
class Exam_model extends CI_Model{
   
    public function get_school_exam($school_id){
            $q = $this->db->query("select exam.*,standard.standard_title from exam
            inner join standard on standard.standard_id = exam.exam_standard
             where exam.school_id=".$school_id);
            return $q->result();
    }
          public function get_school_exam_by_id($id){
        $q = $this->db->query("select * from exam where  exam_id = '".$id."' limit 1");
        return $q->row();
    }
    
    
 public function get_school_exam_by_id_manage_result($id){
        $q = $this->db->query("select exam.*,standard.standard_title from exam 
        inner join standard on standard.standard_id = exam.exam_standard
         where  exam_id = '".$id."' limit 1");
        return $q->row();
    }
    
     
}
?>