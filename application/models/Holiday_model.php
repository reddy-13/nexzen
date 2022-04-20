<?php
class Holiday_model extends CI_Model{
   
    public function get_school_upcomming_holiday($school_id){
            $q = $this->db->query("select * from holiday where school_id=".$school_id." order by holiday_date desc limit 5");
            return $q->result();
    }
        public function get_school_holiday_calender($school_id){
            $q = $this->db->query("select * from holiday where school_id=".$school_id);
            return $q->result();
    }
            public function get_school_holiday($school_id){
            $q = $this->db->query("select * from holiday where school_id=".$school_id);
            return $q->result();
    }
          public function get_school_holiday_by_id($id){
        $q = $this->db->query("select * from holiday where  holiday_id = '".$id."' limit 1");
        return $q->row();
    }
    
 


}
?>