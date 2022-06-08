<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    public function __construct()
    {
                parent::__construct();
                // Your own constructor code
                $this->load->database();
                
                $this->load->model("punch_model");
    }

    public function index()
    {
        if(!is_cli()){
            echo "This script can only be accessd via command line".PHP_EOL;
            return;
        }
        $punch_data = $this->punch_model->getTodayPunchData();
        if (count($punch_data) > 0) {

            $attendance_data = $this->punch_model->getTodatAttendance();
             if (count( $attendance_data ) == 0 ) {
                //echo "<pre>";
                // print_r($punch_data);
                foreach ($punch_data as $p_data) {
                    $school_id_data = $this->punch_model->getSchoolIdbyCardId($p_data->Tid);
                    $student_data = $this->punch_model->getStudentByCardId($p_data->punchingcode);
                    $punch_date = $date =Date('Y-m-d',strtotime( $p_data->Dateime1));
                 
                    $school_id = $school_id_data[0]->school_id;

                    $machine_id = $p_data->Tid;
                    $card_no = $p_data->punchingcode;
                    $student_id = $student_data[0]->student_id;
                    $standard_id = $student_data[0]->student_standard;
                    $insert_data = array(
                        'school_id' => $school_id,
                        'standard_id' => $standard_id,
                        'student_id' => $student_id,
                        'punch_machine_id' => $machine_id,
                        'punch_card_id' => $card_no,
                        'attendence_date' => $punch_date,
                        'attended' => '1'
                    );


                  if($this->db->insert('attendence',$insert_data)){
                    $last_in_id = $this->db->insert_id();
                        $data = ['last_inserted_id' => $last_in_id];
                    $this->db->insert('punch_data',$data);
                    echo "Attendence insertedd on ".Date("Y-m-d H:i:s");
                  }else{
                    echo "Failed";
                  }
                
                    
                }//loop ends
             }else{

             }
          
        }


    }

  
  
     
 
 	public function list_punchdata()
	{
	
		  
            $data = array();
            $punch_data = $this->punch_model->getPunchData();
            echo "<pre>";
            echo "Today :".Date('Y-m-d H:i:s');
            echo "<br>";
            print_r($punch_data);
        
    }
    
    public function gettodaySQLData()
    {
        $punch_data = $this->punch_model->getTodayPunchData();
          echo "<pre>";

        print_r($punch_data);
    }
    

    public function gettodayMysqlData()
    {
        $data = $this->punch_model->getTodatAttendance();

        var_dump($data);
        if (count( $data ) > 0 ) {
            echo "Hello";
        }else{
            echo "Ttitit";
        }
    }


    public function getrowData()
    {
        $this->load->model("school_model");
        $school_data = $this->school_model->get_school_profile();
        print_r($school_data->school_id);
    }
    
 
       
}
?>