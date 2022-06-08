<?php

class Punch_model extends CI_Model
{
    var $mssql;

    function __construct()
    {
        parent::__construct();
         $this->mssql = $this->load->database('xamp',TRUE );
         
    }

    function getPunchData(){

        $query = $this->mssql->order_by('PK_id','DESC')->get('tblt_timesheet');

        $res = $query->result();

        return $res;    
    }

    public function getTodayPunchData()
    {
        $today_date = '2019-07-13'; //Date('Y-m-d');

        // print_r($this->mysql->last_query());    
        // $query = $this->mssql->where('CONVERT(VARCHAR(10), getdate(), 111);',$today_date)
        //                     ->order_by('Tran_MachineRawPunchId','DESC')
        //                     ->get('Tran_MachineRawPunch');
        $query = $this->mssql->query("select Tran_MachineRawPunchId,CardNo,MachineNo,Dateime1, CAST(Dateime1 as Date) as [PunchDay] from Tran_MachineRawPunch where CAST(Dateime1 as Date)='$today_date '");
        
        $res = $query->result();


        return $res;
    }

    public function getTodatAttendance()
    {
        $today_date = '2019-07-13';
        $query = $this->db->where('attendence_date', $today_date)->get('attendence');

        return $query->result();
    }

    public function getSchoolIdbyCardId($id)   
    {
        # school id
        $query = $this->db->select('school_id')->where('punch_machine_id',$id)->get('school_detail');
        return $query->result();
    }

    public function getStudentByCardId($card_id)
    {
        $query = $this->db->where('punch_card_id',$card_id)->get('student_detail');
        return $query->result();
    }
}





?>