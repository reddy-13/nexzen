<?php
class Noticeboard_model extends CI_Model{
   
    public function get_school_noticeboard($id){
            $q = $this->db->query("select * from notice_board where school_id=".$id);
            return $q->result();
    }
          public function get_school_noticeboard_by_id($id){
        $q = $this->db->query("select * from notice_board where notice_id = '".$id."' limit 1");
        return $q->row();
    }
    
 
     
}
?>