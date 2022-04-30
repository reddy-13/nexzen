<?php
class Users_model extends CI_Model{
  /*  public function get_users(){
        
        $this->db->select();
            $this->db->from('users');
            $this->db->where_not_in('user_id',_get_current_user_id($this));
            $q = $this->db->get();
            return $q->result();
    }  */


    /// old
    //  public function get_users(){
        
    //     $this->db->select('users.*, ifnull(student.count, 0) as student_count');
    //         $this->db->from('users');
    //         // $this->db->join('school_detail as school','users.user_id=school.school_id',"left")
    //         $this->db->join('(Select count(student_id) as count,school_id from student_detail group by school_id ) as student', 'student.school_id = users.user_id',"left");
    //         // $this->db->join('school_detail as school','student.school_id = school.user_id','left');
    //         $this->db->where('users.user_type_id',1);
    //         $this->db->where_not_in('user_id',_get_current_user_id($this));
    //         $q = $this->db->get();
    //         return $q->result();
    // }
    public function get_users(){
        
        $this->db->select('usr.user_id as user_id,usr.user_name as user_name,usr.user_password as user_password,usr.password as password,usr.user_type_id as user_type_id,usr.user_status as user_status,usr.user_image as user_image,usr.on_date as on_date,ifnull(count(su.student_id),0) as student_count');
        // $this->db->from('school_detail as sch');
        $this->db->from('users as usr');
        $this->db->join('school_detail as sch','usr.user_id=sch.user_id','left');
        $this->db->join('student_detail as su','sch.school_id=su.school_id','left');
        $this->db->group_by('su.school_id'); 
        $this->db->where('usr.user_type_id',1);
        $this->db->where_not_in('usr.user_id',_get_current_user_id($this));
        $q = $this->db->get();
        return $q->result();
    }
    public function get_user_by_id($id){
        $q = $this->db->query("select * from users where  user_id = '".$id."' limit 1");
        return $q->row();
    }
    public function get_user_type(){
        $q = $this->db->query("select * from user_types");
        return $q->result();
    }
    public function get_user_type_id($id){
        $q = $this->db->query("select * from user_types where user_type_id = '".$id."'");
        return $q->row();
    }
    public function get_user_type_access($type_id){
        $q = $this->db->query("select * from user_type_access where user_type_id = '".$type_id."'");
        return $q->result();
    }
}
?>