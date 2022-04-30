<?php
class School_model extends CI_Model{
     
    public function get_school_profile(){
        $q = $this->db->query("select * from school_detail where  user_id = '"._get_current_user_id($this)."' limit 1");
        // $q = $this->db->query("select * from school_detail where  user_id = '24' limit 1");
        return $q->row();
    }

    public function get_school_profile_by_id($scool_id)
    {
    	$q = $this->db->query("select * from school_detail where  school_id = '".$scool_id."' limit 1");
        // $q = $this->db->query("select * from school_detail where  user_id = '24' limit 1");
        return $q->row();
    }


    
    
     

}
?>