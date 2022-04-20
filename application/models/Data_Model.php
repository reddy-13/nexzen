<?php 

/**
 * Data model for testing all the from 
 */
class Data_Model extends CI_Model
{
	
	public function get_data()
	{
		 $this->db->select('schl.school_name as school_name,stdnt.student_name as student_name');
		 $this->db->from('attendence at');
		 $this->db->join('school_detail as schl', 'at.school_id= schl.school_id','left');
		 $this->db->join('student_detail as stdnt', 'at.student_id=stdnt.student_id','left');
		 $this->db->where('at.school_id','1');


		return  $this->db->get()->result();
	}
}

 ?>