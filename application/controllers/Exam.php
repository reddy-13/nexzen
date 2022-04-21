<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exam extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // Your own constructor code
    $this->load->database();
    $this->load->helper('login_helper');
    $this->load->model('school_model');
    $this->load->model("teacher_model");
  }

  public function manage_exam()
  {
    if (_is_user_login($this)) {
      $data["error"] = "";
      $this->load->model("exam_model");


      // $this->load->model("standard_model");
      // $data["school_standard"] = $this->standard_model->get_school_standard();
      $this->load->model('school_model');
      $this->load->model("teacher_model");
      $school_data = $this->school_model->get_school_profile();
      /* get school standard */
      $this->load->model("standard_model");
      if (_get_current_user_type_id($this) == 1) {
        $data["school_standard"] = $this->standard_model->get_school_standard($school_data->school_id);
      } elseif (_get_current_user_type_id($this) == 2) {
        $school_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));


        $data["school_standard"] = $this->standard_model->get_school_standard($school_data->school_id);
        # code...
      }
      $data["exam"] = $this->exam_model->get_school_exam($school_data->school_id);
      if ($_POST) {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('exam_title', 'Exam Title', 'trim|required');
        $this->form_validation->set_rules('exam_description', 'Exam Description', 'trim|required');
        $this->form_validation->set_rules('start_date', 'Exam Date', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

          $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> ' . $this->form_validation->error_string() . '
                                </div>';
        } else {

          $exam_title = $this->input->post("exam_title");
          $exam_description = $this->input->post("exam_description");
          $exam_date = $this->input->post("start_date");
          $standard = $this->input->post("standard");

          $this->load->model("common_model");
          $this->common_model->data_insert(
            "exam",
            array(
              "exam_title" => $exam_title, "school_id" => $school_data->school_id,
              "exam_note" => $exam_description, "exam_date" => $exam_date,
              "exam_standard" => $standard
            )
          );
          $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Exam Added Successfully
                                </div>');
          redirect("exam/manage_exam");
        }
      }

      $this->load->view("exam/manage_exam", $data);
    }
  }
  public function edit_exam($exam_id)
  {
    if (_is_user_login($this)) {
      $data = array();
      $this->load->model('school_model');
      $school_data = $this->school_model->get_school_profile();
      $this->load->model("exam_model");
      $examid = $this->exam_model->get_school_exam_by_id($exam_id);
      $data["exam"] = $examid;

      $this->load->model("standard_model");

      // $data["school_standard"] = $this->standard_model->get_school_standard();
      if (_get_current_user_type_id($this) == 1) {
        $data["school_standard"] = $this->standard_model->get_school_standard($school_data->school_id);
      } elseif (_get_current_user_type_id($this) == 2) {
        $school_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));


        $data["school_standard"] = $this->standard_model->get_school_standard($school_data->school_id);
        # code...
      }
      if ($_POST) {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('exam_title', 'Exam Title', 'trim|required');
        $this->form_validation->set_rules('exam_description', 'Exam Description', 'trim|required');
        $this->form_validation->set_rules('start_date', 'Exam Date', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

          $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> ' . $this->form_validation->error_string() . '
                                </div>';
        } else {
          $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Warning!</strong> Standard Already Exist.Please Enter Another Name
                                        </div>');



          $exam_title = $this->input->post("exam_title");
          $exam_description = $this->input->post("exam_description");
          $exam_date = $this->input->post("start_date");
          $standard = $this->input->post("standard");


          $update_array = array(
            "exam_title" => $exam_title, "exam_note" => $exam_description,
            "exam_date" => $exam_date, "exam_standard" => $standard
          );

          $this->load->model("common_model");
          $this->common_model->data_update(
            "exam",
            $update_array,
            array("exam_id" => $exam_id)
          );
          $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Exam Update Successfully
                                </div>');
          redirect("exam/manage_exam");
        }
      }


      $this->load->view("exam/edit_exam", $data);
    }
  }
  function delete_exam($exam_id)
  {
    $this->db->query("Delete from exam where exam_id = '" . $exam_id . "'");
    redirect("exam/manage_exam");
  }
}