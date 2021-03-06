<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // Your own constructor code
    $this->load->database();
    $this->load->helper(['login_helper','form','url']);
    $this->load->model("school_model");
    $this->load->model("teacher_model");
    // $this->load->library('upload');
  }

  public function check_student_username()
  {

    $username = $this->input->get('username');

    if ($username != '') {
      $students_data = $this->db->where('student_user_name', $username)->get('student_detail')->result();

      if (sizeof($students_data) > 0) {
        echo json_encode(["status" => "error", "msg" => "Username already taken"]);
      } else {
        echo json_encode(["status" => "success", "msg" => "Username available"]);
      }
    }
  }

  public function check_student_card_id()
  {
    header('Content-type: text/json');
    $card_id = $this->input->post('punch_card_id');
    $school_id = $this->input->post('school_id');

    if ($card_id != '' && $school_id != '') {

      $data = ['punch_card_id' => $card_id, 'school_id' => $school_id];
      $students_data = $this->db->where($data)->get('student_detail')->result();

      if (sizeof($students_data) > 0) {
        echo json_encode(["status" => "0", "msg" => "card id is already assigned."]);
      } else {
        echo json_encode(["status" => "1", "msg" => "ok"]);
      }
    }
  }

  function add_student()
  {
    if (_is_user_login($this)) {

      $this->load->model("standard_model");
      // $school_data = $this->school_model->get_school_profile();
      $this->load->model('school_model');
      $school_data = $this->school_model->get_school_profile();
      /* get school standard */
      $this->load->model("standard_model");
      if (_get_current_user_type_id($this) == 1) {
        $data["school_standard"] = $this->standard_model->get_school_standard($school_data->school_id);
      } elseif (_get_current_user_type_id($this) == 2) {
        $teacher_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));

        $data["school_standard"] = $this->standard_model->get_school_standard($teacher_data->school_id);
        # code...
      }
      // $data["school_standard"] = $this->standard_model->get_school_standard($school_data->school_id);
      $data["error"] = "";
      function passGen($name, $dob)
      {
        $name = strtolower($name);
        $name = str_replace(' ', '', $name);
        $name = substr($name, 0, 6);
        $dob =  str_replace('-', '', $dob);

        return $name . $dob;
      }
      if (isset($_REQUEST["savestudent"])) {
        // echo "<pre>";
        // print_r($_POST);
        // exit;
        // function passGen($name){
        //     $name = strtolower($name);
        //     $name = str_replace(' ','',$name);
        //     return $name.'123';
        // }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('student_name', 'Student Name', 'trim|required');
        $this->form_validation->set_rules('student_birthdate', 'Student Birthdate', 'required');
        // $this->form_validation->set_rules('student_username', 'Student Login User Name', 'trim|required|is_unique[student_detail.student_user_name]');
        $this->form_validation->set_rules('student_roll_no', 'Student Roll No', 'trim|required');
        $this->form_validation->set_rules('punch_card_id', 'Student Card ID', 'required');
        // $this->form_validation->set_rules('student_password', 'Student Password', 'trim|required');
        $this->form_validation->set_rules('student_address', 'Student Address', 'trim|required');
        $this->form_validation->set_rules('student_city', 'Student City', 'trim|required');
        $this->form_validation->set_rules('student_phone', 'Student Phone', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
          $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <strong>Warning!</strong> ' . $this->form_validation->error_string() . '
          </div>';
        } else {
          $q = $this->db->query("select * from student_detail where student_standard=" . $this->input->post('student_standard') . " AND student_roll_no='" . $this->input->post('student_roll_no') . "'");
          $duplicate_check =  $q->row();
          if (isset($duplicate_check)) {
            $this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <strong>Warning!</strong> Student Roll No Already Exist With Selected Standard.Please Enter Another Roll No.
              </div>');
            return redirect("student/add_student");
          } else {
            $roll_no = $this->input->post("student_phone")."".$this->input->post("student_roll_no");

            $file_name = "";
            $config['upload_path'] = './uploads/studentphoto/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 10000;
            $config['max_width']            = 5048;
            $config['max_height']           = 4012;
            $config['file_name'] = $roll_no.".jpg";
            $this->load->library('upload', $config);

            if ($_FILES["student_photo"]["size"] > 0) {
              if (!$this->upload->do_upload('student_photo')) {
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('student/add_student', $error);
              } else {
                $file_data = $this->upload->data();
                $file_name = $file_data["file_name"];
                // $student_profile["student_photo"] = $file_name;
              }
              $this->load->model("common_model");
              if (_get_current_user_type_id($this) == 1) {
                $teacher_data = $this->school_model->get_school_profile();
              } else if (_get_current_user_type_id($this) == 2) {
                $teacher_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));
              }
              //
              $this->common_model->data_insert(
                "student_detail",
                array(
                  "student_name" => $this->input->post("student_name"),
                  "student_father_name" => $this->input->post("student_father_name"),
                  "student_birthdate" => $this->input->post("student_birthdate"),
                  "student_unique_no" => $this->input->post("student_unique_no"),
                  "student_roll_no" => $this->input->post("student_roll_no"),
                  "punch_card_id" => $this->input->post("punch_card_id"),
                  "student_user_name" => passGen($this->input->post("student_name"), $this->input->post("student_birthdate")),
                  "student_password" => md5(passGen($this->input->post("student_name"), $this->input->post("student_birthdate"))),
                  "student_orgpassword" => passGen($this->input->post("student_name"), $this->input->post("student_birthdate")),
                  "student_standard" => $this->input->post("student_standard"),
                  "student_address" => $this->input->post("student_address"),
                  "student_city" => $this->input->post("student_city"),
                  "student_blood_group" => $this->input->post("student_blood_group"),
                  "student_phone" => $this->input->post("student_phone"),
                  "student_parent_phone" => $this->input->post("student_parent_phone"),
                  // "student_enr_no" => $this->input->post("student_enr_no"),
                  "student_email" => $this->input->post("student_email"),
                  "student_branch" => $this->input->post("student_branch"),
                  "student_semester" => $this->input->post("student_semester"),
                  // "student_division" => $this->input->post("student_division"),
                  "student_batch" => $this->input->post("student_batch"),
                  "student_photo" => $file_name,
                  "school_id" => $teacher_data->school_id
                )
              );
              $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Success!</strong> Student Data Added Successfully
                </div>');
              return redirect("student/add_student");
            } else {
              $this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Warning!</strong> Studen Photo is required
                </div>');
              return redirect("student/add_student");
            }
          }
        }
      }


      $this->load->view("student/add_student", $data);
    }
  }

  public function import_csv()
  { 
    function passGen($name, $dob)
      {
        $name = strtolower($name);
        $name = str_replace(' ', '', $name);
        $name = substr($name, 0, 6);
        $dob =  str_replace('-', '', $dob);

        return $name . $dob.rand(10,100);
      }

             $this->load->model("common_model");
            echo "<pre>";
            $file = fopen(base_url('uploads/')."data.csv","r");
            print_r(fgetcsv($file));

                $i = 0;
                $numberOfFields = 28 ; // colums number
                $csvArr = array();
                // exit;
                
                while (($filedata = fgetcsv($file, 2000, ",")) !== FALSE) {
                    $num = count($filedata);

                    if($i > 0 && $num == $numberOfFields){ 
                        $csvArr[$i]['school_id'] = $filedata[1];
                        $csvArr[$i]['punch_machine_id'] = $filedata[3];
                        $csvArr[$i]['student_name'] = $filedata[9];
                        $csvArr[$i]['student_blood_group'] = $filedata[10];
                        $csvArr[$i]['student_father_name'] = $filedata[11];
                        $csvArr[$i]['student_birthdate'] = $filedata[12];
                        $csvArr[$i]['student_roll_no'] = $filedata[13];
                        $csvArr[$i]['student_standard'] = $filedata[14];
                        $csvArr[$i]['student_address'] = $filedata[15];
                        $csvArr[$i]['student_city'] = $filedata[16];
                        $csvArr[$i]['student_phone'] = $filedata[17];
                        $csvArr[$i]['student_parent_phone'] = $filedata[18];
                        $csvArr[$i]['student_branch'] = $filedata[22];
                      // print_r($filedata);

                        // $csvArr[$i]['email'] = $filedata[1];
                        // $csvArr[$i]['phone'] = $filedata[2];
                        // $csvArr[$i]['created_at'] = $filedata[3];
                    }
                    $i++;
                }
                // print_r($csvArr);
                 fclose($file);
                    $count = 0;
                    $data = [];
                      foreach($csvArr as $userdata){
                        // print_r($userdata);
                          // $students = new StudentModel();
                          // $findRecord = $students->where('email', $userdata['email'])->countAllResults();
                          // if($findRecord == 0){
                          //     if($students->insert($userdata)){
                          //         $count++;
                          //     }

                
                          array_push($data , [
                          "student_name" => $userdata["student_name"],
                          "student_father_name" => $userdata["student_father_name"],
                          "student_birthdate" => $userdata["student_birthdate"],
                          "student_roll_no" => $userdata["student_roll_no"],
                          // "punch_card_id" => $userdata["punch_card_id"],
                          "student_user_name" => passGen($userdata["student_name"], $userdata["student_roll_no"]),
                          "student_password" => md5(passGen($userdata["student_name"], $userdata["student_roll_no"])),
                          "student_orgpassword" => passGen($userdata["student_name"], $userdata["student_roll_no"]),
                          "student_standard" => $userdata["student_standard"],
                          "student_address" => $userdata["student_address"],
                          "student_city" => $userdata["student_city"],
                          "student_blood_group" => $userdata["student_blood_group"],
                          "student_phone" => $userdata["student_phone"],
                          "student_parent_phone" => $userdata["student_parent_phone"],
                          // "student_enr_no" => $userdata["student_enr_no"],
                          // "student_email" => $userdata["student_email"],
                          "student_branch" => $userdata["student_branch"],
                          "school_id" => 1,
                          "punch_machine_id" => 2,
                          ]);
                          $count++;
                    }
              
              print_r($data);
              $this->db->insert_batch('student_detail', $data);
              // $this->load->model("student_model");

              //  $this->student_model->insert_student('student_detail', $data);

  }
  // public function add_bulk()
  // {
  //   if ($this->input->post('submit')) {
  //     $path = 'uploads/csvdata';
  //     require_once APPPATH . "/third_party/PHPExcel.php";
  //     $config['upload_path'] = $path;
  //     $config['allowed_types'] = 'xlsx|xls|csv';
  //     $config['remove_spaces'] = TRUE;
  //     $this->load->library('upload', $config);
  //     $this->upload->initialize($config);            
  //     if (!$this->upload->do_upload('uploadFile')) {
  //       $error = array('error' => $this->upload->display_errors());
  //     } else {
  //       $data = array('upload_data' => $this->upload->data());
  //     }
  //     if(empty($error)){
  //       if (!empty($data['upload_data']['file_name'])) {
  //         $import_xls_file = $data['upload_data']['file_name'];
  //       } else {
  //         $import_xls_file = 0;
  //       }
  //       $inputFileName = $path . $import_xls_file;
  //       try {
  //         $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
  //         $objReader = PHPExcel_IOFactory::createReader($inputFileType);
  //         $objPHPExcel = $objReader->load($inputFileName);
  //         $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
  //         $flag = true;
  //         $i=0;
  //         foreach ($allDataInSheet as $value) {
  //           if($flag){
  //             $flag =false;
  //             continue;
  //           }
  //           $inserdata[$i]['first_name'] = $value['A'];
  //           $inserdata[$i]['last_name'] = $value['B'];
  //           $inserdata[$i]['email'] = $value['C'];
  //           $inserdata[$i]['contact_no'] = $value['D'];
  //           $i++;
  //         }               
  //         $result = $this->import->insert($inserdata);   
  //         if($result){
  //           echo "Imported successfully";
  //         }else{
  //           echo "ERROR !";
  //         }             
  //       } catch (Exception $e) {
  //         die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
  //           . '": ' .$e->getMessage());
  //       }
  //     }else{
  //       echo $error['error'];
  //     }
  //   }
  //   $this->load->view('import');
  // }



public function edit_student($student_id)
{
  if (_is_user_login($this)) {
    $data = array();

    if ($_POST) {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('student_name', 'Student Name', 'trim|required');
      $this->form_validation->set_rules('student_birthdate', 'Student Birthdate', 'trim|required');
      $this->form_validation->set_rules('student_roll_no', 'Student Roll No', 'trim|required');
      $this->form_validation->set_rules('punch_card_id', 'Student Card ID', 'trim|required');
      $this->form_validation->set_rules('student_address', 'Student Address', 'trim|required');
      $this->form_validation->set_rules('student_city', 'Student City', 'trim|required');
      $this->form_validation->set_rules('student_phone', 'Student Phone', 'trim|required');

      if ($this->form_validation->run() == FALSE) {

        $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Warning!</strong> ' . $this->form_validation->error_string() . '
        </div>';
      } else {
        $update_array = array(
          "student_name" => $this->input->post("student_name"),
          "student_father_name" => $this->input->post("student_father_name"),
          "student_birthdate" => $this->input->post("student_birthdate"),
          "student_roll_no" => $this->input->post("student_roll_no"),
          "punch_card_id" => $this->input->post("punch_card_id"),
          "student_standard" => $this->input->post("student_standard"),
          "student_address" => $this->input->post("student_address"),
          "student_city" => $this->input->post("student_city"),
          "student_phone" => $this->input->post("student_phone"),
          "student_blood_group" => $this->input->post("student_blood_group"),
          "student_parent_phone" => $this->input->post("student_parent_phone"),
          "student_enr_no" => $this->input->post("student_enr_no"),
          "student_email" => $this->input->post("student_email"),
          "student_branch" => $this->input->post("student_branch"),
          "student_semester" => $this->input->post("student_semester"),
          "student_division" => $this->input->post("student_division"),
          "student_batch" => $this->input->post("student_batch")
        );



        if ($_FILES["student_photo"]["size"] > 0) {
          $roll_no = $this->input->post("student_phone")."".$this->input->post("student_roll_no");
          $config['upload_path'] = './uploads/studentphoto/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['file_name'] = $roll_no.".jpg";
          $config['max_size'] = 10000;
          $config['max_width']   = 5048;
          $config['max_height']   = 4012;
          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('student_photo')) {
            $error = array('error' => $this->upload->display_errors());

              // $this->load->view('upload_form', $error);
            $this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <strong>Upload failed!</strong> ' . $error['error'] . '
              </div>');
              // $this->load->view("student/edit_student".$student_id);
            redirect("student/edit_student/" . $student_id);
          } else {
            $file_data = $this->upload->data();
            $file_name = $file_data["file_name"];
            $update_array["student_photo"] = $file_name;
              //	$student_profile["student_photo"] = $file_name;
          }
        }
        $this->load->model("common_model");
        $this->common_model->data_update(
          "student_detail",
          $update_array,
          array("student_id" => $student_id)
        );
        $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <strong>Success!</strong> Student Update Successfully
          </div>');
          // redirect("student/list_student");

      }
    }

    $this->load->model("student_model");
    $studenttid = $this->student_model->get_school_student_by_id($student_id);
    $data["student"] = $studenttid;
      // $this->load->model("standard_model");


    $this->load->model('school_model');
    $school_data = $this->school_model->get_school_profile();
    /* get school standard */
    $this->load->model("standard_model");
    if (_get_current_user_type_id($this) == 1) {
      $data["school_standard"] = $this->standard_model->get_school_standard($school_data->school_id);
    } elseif (_get_current_user_type_id($this) == 2) {
      $teacher_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));

      $data["school_standard"] = $this->standard_model->get_school_standard($teacher_data->school_id);
        # code...
    }
      // $data["school_standard"] = $this->standard_model->get_school_standard();
    $this->load->view("student/edit_student", $data);
  }
}

public function list_due()
{

  if (_is_user_login($this)) {
      //echo "hello "._is_user_login($this);
    $data["error"] = "";
    $filter = array();
    if (isset($_GET['standard'])) {
      $filter['student_standard'] = $_GET['standard'];
    }

    $this->load->model('school_model');
    $this->load->model("standard_model");
    $this->load->model("student_model");
      // $this->load->model('school_model');

    $school_data = $this->school_model->get_school_profile();
    $this->load->model("standard_model");
      // $data["students"] = $this->student_model->get_school_student($filter, $school_data->school_id);
    $data["school_standard"] = $this->standard_model->get_school_standard($school_data->school_id);
    if ($_POST) {
      $standar_id = $_POST['standard'];
      $fee_type_id = $_POST['fee_types'];

      $data['due'] = $this->student_model->get_due_fee($standar_id, $fee_type_id, $school_data->school_id);
        // echo "<pre>";
        // print_r($data);
    }

    $this->load->view("fee/view_due_fee", $data);
  }
}





public function get_due()
{

  if (_is_user_login($this)) {
      //echo "hello "._is_user_login($this);
    $data["error"] = "";
    $filter = array();
    if (isset($_GET['standard'])) {
      $filter['student_standard'] = $_GET['standard'];
    }

    $this->load->model('school_model');
    $this->load->model("standard_model");
    $this->load->model("student_model");
      // $this->load->model('school_model');

    $school_data = $this->school_model->get_school_profile();
    $this->load->model("standard_model");
      // $data["students"] = $this->student_model->get_school_student($filter, $school_data->school_id);
    $data["school_standard"] = $this->standard_model->get_school_standard($school_data->school_id);
    if ($_POST) {
      $standar_id = $_POST['standard'];
        // $fee_type_id = $_POST['fee_types'];

      $data['due'] = $this->student_model->get_due($standar_id, $school_data->school_id);
        // echo "<pre>";
        // print_r($data);
    }

    $this->load->view("fee/get_fee", $data);
  }
}



public function list_student()
{

  if (_is_user_login($this)) {
      // $data = array(); 
    

    $filter = array();
    if (isset($_GET['standard'])) {
      $filter['student_standard'] = $_GET['standard'];
    }
    $this->load->model("standard_model");
    $this->load->model("student_model");
    $this->load->model('school_model');
    $data = [];
    $school_data = $this->school_model->get_school_profile();
    if (_get_current_user_type_id($this) == 1) {

      $school_id = $school_data->school_id;
    } elseif (_get_current_user_type_id($this) == 2) {

      $teacher_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));
      $school_id = $teacher_data->school_id;
        # code...
    }
    // pagination
    $this->load->library('pagination');
    $config = [
      "base_url" => base_url('index.php/student/list_student'),
      "per_page" => 10,
      "total_rows" => $this->student_model->get_school_student_count($filter, $school_id),
      "full_tag_open"=> "<ul class='pagination'>",
      "full_tag_close"=> "</ul>",
      "next_tag_open" => "<li>",
      "first_tag_open" => "<li>",
      "first_tag_close" => "</li>",
      "next_tag_close" => "</li>",
      "prev_tag_open" => "<li>",
      "prev_tag_close" => "</li>",
      "num_tag_open" => "<li>",
      "num_tag_close" => "</li>",
      "cur_tag_open" => "<li class='active'><a>",
      "cur_tag_close" => "</a></li>",

    ];
    $this->pagination->initialize($config);
     
    $data["student"] = $this->student_model->get_school_student($filter, $school_id,$config['per_page'], $this->uri->segment(3, 0));
    /* get school standard */
    if (_get_current_user_type_id($this) == 1) {

      $data["school_standard"] = $this->standard_model->get_school_standard($school_data->school_id);
        //
    } elseif (_get_current_user_type_id($this) == 2) {
        # code...
      $teacher_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));

      $data["school_standard"] = $this->standard_model->get_school_standard($teacher_data->school_id);
    }
    $this->load->view("student/list_student", $data);
  }
}

  // list id card

public function list_cards($student_id='')

{
  if($student_id ==='')
    echo "sorry no url found";
  else
    if (_is_user_login($this)) {
      $data = array();
      $this->load->model("student_model");
       $data['school_details'] = $this->school_model->get_school_profile();
      $data["student_detail"] = $this->student_model->get_school_student_detail($student_id);


      $this->load->model("growth_model");
      $data["student_growth"] = $this->growth_model->get_school_standard_student_growth($student_id);

      $this->load->view("student/list_id_card", $data);
    }

  }

  public function student_excel_download()
  {
    if (_is_user_login($this)) {


      // print_r($company);

      error_reporting(E_ALL);
      ini_set('display_errors', TRUE);
      ini_set('display_startup_errors', TRUE);
      date_default_timezone_set('Europe/London');
      $this->load->library('PHPExcel');
      if (PHP_SAPI == 'cli')
        die('This example should only be run from a Web Browser');


      // Create new PHPExcel object
      $objPHPExcel = new PHPExcel();

      // Set document properties
      $objPHPExcel->getProperties()->setCreator("Fedenaa")
      ->setLastModifiedBy("Fedenaa")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
      ->setDescription("School Student List")
      ->setKeywords("office 2007 openxml php")
      ->setCategory("Fedenaa");

      //$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:G1');

      // Add some data
      $objPHPExcel->setActiveSheetIndex(0)
      ->setCellValue('A1', 'ID')
      ->setCellValue('B1', 'Student Name')
      ->setCellValue('C1', 'Student Roll No')
      ->setCellValue('D1', 'Standard')
      ->setCellValue('E1', 'Birthdate')
      ->setCellValue('F1', 'Student Address')
      ->setCellValue('G1', 'Student City')
      ->setCellValue('H1', 'Student Mobile No')
      ->setCellValue('I1', 'Parent Mobile No');

      $q = $this->db->query("select student_detail.*, standard.standard_title from student_detail
        inner join standard on standard.standard_id = student_detail.student_standard where student_detail.school_id=" . _get_current_user_id($this));
      $stud_item = $q->result();

      $row_index = 2;
      foreach ($stud_item as $item) {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $row_index, $item->student_id)
        ->setCellValue('B' . $row_index, $item->student_name)
        ->setCellValue('C' . $row_index, $item->student_roll_no)
        ->setCellValue('D' . $row_index, $item->standard_title)
        ->setCellValue('E' . $row_index, $item->student_birthdate)
        ->setCellValue('F' . $row_index, $item->student_address)
        ->setCellValue('G' . $row_index, $item->student_city)
        ->setCellValue('H' . $row_index, $item->student_phone)
        ->setCellValue('I' . $row_index, $item->student_parent_phone);

        $row_index++;
      }


      $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:I1')
      ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()
      ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
      ->getStartColor()->setARGB('E5E5E5');
      for ($i = 1; $i <= $row_index; $i++) {
        for ($j = 'A'; $j <= 'I'; $j++) {


          $objPHPExcel->getActiveSheet()->getStyle($j . $i)
          ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
          $objPHPExcel->getActiveSheet()->getStyle($j . $i)
          ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
          $objPHPExcel->getActiveSheet()->getStyle($j . $i)
          ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
          $objPHPExcel->getActiveSheet()->getStyle($j . $i)
          ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        }
      }

      // Rename worksheet
      $objPHPExcel->getActiveSheet()->setTitle('Student Data');


      // Set active sheet index to the first sheet, so Excel opens this as the first sheet
      $objPHPExcel->setActiveSheetIndex(0);


      // Redirect output to a client???s web browser (Excel2007)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="StudentData.xlsx"');
      header('Cache-Control: max-age=0');
      // If you're serving to IE 9, then the following may be needed
      header('Cache-Control: max-age=1');

      // If you're serving to IE over SSL, then the following may be needed
      header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
      header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header('Pragma: public'); // HTTP/1.0

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      $objWriter->save('php://output');
      exit;
    }
  }
  public function student_print()
  {
    if (_is_user_login($this)) {



      $this->load->model("student_model");
      $this->load->model("standard_model");
      // $this->load->model("student_model");
      $this->load->model('school_model');

      $filter = array();
      if (isset($_GET['standard'])) {
        $filter['student_standard'] = $_GET['standard'];
      }



      $school_data = $this->school_model->get_school_profile();
      if (_get_current_user_type_id($this) == 1) {

        $school_id = $school_data->school_id;
      } elseif (_get_current_user_type_id($this) == 2) {

        $teacher_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));

        $school_id = $teacher_data->school_id;
        # code...
      }
      $data["student"] = $this->student_model->get_school_student($filter, $school_id);

      $this->load->view("student/student_print", $data);
    }
  }

  public function change_status()
  {
    $table = $this->input->post("table");
    $id = $this->input->post("id");
    $on_off = $this->input->post("on_off");
    $id_field = $this->input->post("id_field");
    $status = $this->input->post("status");

    $this->db->update($table, array("$status" => $on_off), array("$id_field" => $id));
  }

  // student details
  public function student_detail($student_id)
  {
    if (_is_user_login($this)) {
      $data = array();
      $this->load->model("student_model");
      
      $data["student_data"] = $this->student_model->get_school_student_detail($student_id);
      // echo "<pre>";
      // print_r($data);
      // print_r($student_id);
      // exit;

      $this->load->model("growth_model");
      $data["student_growth"] = $this->growth_model->get_school_standard_student_growth($student_id);

      $this->load->view("student/student_detail", $data);
    }
  }

  // delete student
  function delete_student($student_id)
  {
    $data = array();
    $this->load->model("student_model");
    $id  = $this->student_model->get_school_student_by_id($student_id);
    if ($id) {
      $this->db->query("Delete from student_detail where student_id = '" . $id->student_id . "'");

      // remove uploaded student image
      unlink("uploads/studentphoto/" . $id->student_photo);

      $this->db->query("Delete from student_growth where student_id = '" . $id->student_id . "'");
      redirect("student/list_student");
    }
  }
}
