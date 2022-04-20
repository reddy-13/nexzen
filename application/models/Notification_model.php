<?php
class Notification_model extends CI_Model{
   
     
          public function get_notification($id){
        $q = $this->db->query("select * from notification where school_id=".$id);
        return $q->result();
    }
    

}
?>