<?php
class Standard_model extends CI_Model{
   
    public function get_school_standard($school_id){
            $q = $this->db->query("select * from standard where school_id='".$school_id."'");
            return $q->result(); 
    }
       public function get_school_standard_by_id($id){
        $q = $this->db->query("select * from standard where  standard_id = '".$id."' limit 1");
        return $q->row();
    }

}
?>