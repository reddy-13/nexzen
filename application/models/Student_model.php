<?php
class Student_model extends CI_Model{
     
    public function get_school_student($filter=array(),$school_id){
           
            $filter_text = "";
             
                if(!empty($filter)){
                    if(key_exists("student_standard",$filter)){
                        $filter_text .= " and  `student_detail`.student_standard = '".$filter['student_standard']."' ";
                    }
                   
                }
                
                 else{

                        if(_get_current_user_type_id($this) == 2){
                            $filter_text .= " and  `student_detail`.school_id = ".$school_id;
                        }else if(_get_current_user_type_id($this) == 1){
                            $filter_text .= " and  `student_detail`.school_id = ".$school_id;
                        }
                        
                    
                }
            //$q = $this->db->query("select student_detail.*, standard.standard_title from student_detail 
            //inner join standard on standard.standard_id = student_detail.student_standard
            //where student_detail.school_id="._get_current_user_id($this));
            
             $sql = "select student_detail.*, standard.standard_title,standard.standard_id from student_detail 
            left join standard on standard.standard_id = student_detail.student_standard
            where 1 ".$filter_text;
            
            $q = $this->db->query($sql);
            return $q->result();
    }

    public function get_due_fee($standard, $fee_type, $school_id)
    {
        # getting student due fee...
        $this->db->select("student.student_user_name as student_name,student.student_id as student_id, st.standard_title as standard_title,fee.title as fee_title,fee.base_amount as fee_amount, ifnull(su_fee.pay_fee_amount,0) as pay_amount ");
        $this->db->from("student_detail as student");
        $this->db->join("standard as st","student.student_standard=st.standard_id","left");
        $this->db->join("fee_types as fee","st.standard_id=fee.standard_id","left");
        $this->db->join("student_fees as su_fee","student.student_id=su_fee.student_id","left");
        $this->db->where("student.school_id='$school_id'");

        $this->db->where("student.student_standard='$standard'");
        $this->db->where("fee.id='$fee_type'");
        $this->db->where("fee.id='$fee_type'");

        $this->db->where("fee.base_amount != su_fee.pay_fee_amount");

        // $this->db->join();

        $q = $this->db->get();
        return $q->result();
    }

    public function total_due($school_id)
    {
        #total due by school id
        $this->db->select("sum(fee.base_amount) as total_amount, sum(su.pay_fee_amount) - sum(fee.base_amount) as total_due");
        $this->db->from("student_detail as student");
        $this->db->join("fee_types as fee","student.school_id=fee.school_id","left");
        $this->db->join("student_fees as su", "student.school_id=su.school_id","left");
        $this->db->where("student.school_id",$school_id);

        $q = $this->db->get();

        return $q->result();
    }

    public function get_school_student_by_id($id){
        $q = $this->db->query("select * from student_detail where student_id = '".$id."' limit 1");
        return $q->row();
    }     
    public function get_school_student_detail($student_id){
            $q = $this->db->query("select student_detail.*, standard.standard_title from student_detail 
            inner join standard on standard.standard_id = student_detail.student_standard
           
            where student_detail.student_id=".$student_id);
            return $q->row();
    } 
/* this function are use in manage result  and exam result controller */  
  public function get_school_standard_student_manage_result($standardid){
            $q = $this->db->query("select * from student_detail where student_detail.student_standard=".$standardid);
            return $q->result();
    } 
  /* this function are use in manage student attendence  */    
public function get_school_standard_student_add_attendence($standard,$school_id){
         
            $this->db->select('student_detail.*, standard.standard_title, standard.standard_id');
            $this->db->from('student_detail');
            $this->db->join('standard', 'standard.standard_id = student_detail.student_standard');
                        
            if(isset($standard) && $standard!="")
            $this->db->where('student_detail.student_standard',$standard);
            $this->db->where('student_detail.school_id',$school_id);
            $this->db->order_by('student_detail.student_id','asc');
            $q = $this->db->get();
            return $q->result();

        }
        
  /* this function are use in manage student rank  */    
public function get_school_standard_student_add_rank($standard){
         
            $this->db->select('student_detail.*, standard.standard_title, standard.standard_id');
            $this->db->from('student_detail');
            $this->db->join('standard', 'standard.standard_id = student_detail.student_standard');
                        
            if(isset($standard) && $standard!="")
            $this->db->where('student_detail.student_standard',$standard);
            
            $q = $this->db->get();
            return $q->result();

        }          
        
        

       

}


 