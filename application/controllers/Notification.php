<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // Your own constructor code
    $this->load->database();
    $this->load->helper('login_helper');
  }

  public function send()
  {
    if (_is_user_login($this)) {

      $this->load->model('school_model');
      $this->load->model("teacher_model");
      $this->load->model('school_model');

      $school_data = $this->school_model->get_school_profile();

      if (_get_current_user_type_id($this) == 1) {

        $school_id = $school_data->school_id;
      } elseif (_get_current_user_type_id($this) == 2) {

        $teacher_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));

        $school_id = $teacher_data->school_id;
        # code...
      }

      if ($_POST) {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('noti_title', 'noti_title', 'trim|required');
        $this->form_validation->set_rules('noti_description', 'noti_description', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
          if ($this->form_validation->error_string() != "") {
            $this->session->set_flashdata("message", '<div class="alert alert-warning alert-dismissible" role="alert">
                          <i class="fa fa-warning"></i>
                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          <strong>Warning!</strong> ' . $this->form_validation->error_string() . '
                          </div>');
          }
        } else {
          $message = array(
            "noti_title" => $this->input->post("noti_title"),
            "noti_description" => $this->input->post("noti_description"), "date" => date("Y-m-d h:i:s")
          );

          $noti_image = "";
          if (isset($_FILES["noti_image"]) && $_FILES["noti_image"]["size"] > 0) {
            $config['upload_path']          = './uploads/notification/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';

            if (!is_dir($config['upload_path'])) {
              mkdir($config['upload_path']);
            }
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('noti_image')) {
              $error = array('error' => $this->upload->display_errors());
            } else {
              $img_data = $this->upload->data();
              $noti_image = $img_data['file_name'];
            }
          }

          // $school_id = _get_current_user_id($this);


          // get shool id based on login


          $standard = $this->input->post("standard");
          $student_id = $this->input->post("student_id");


          $this->load->model("common_model");
          $this->common_model->data_insert(
            "notification",
            array(
              "noti_title" => $this->input->post("noti_title"),
              "noti_description" => $this->input->post("noti_description"),
              "noti_image" => $noti_image,
              "school_id" => $school_id,
              // "standard_id" => $standard,
              // "student_id" => $student_id,
              "date" => date("Y-m-d h:i:s")
            )
          );

          $message = array("message" => $this->input->post("noti_description"), "title" => $this->input->post("noti_title"), "image" => $noti_image, 'created_at' => date('Y-m-d h:i:s'));

          $this->load->helper("gcm_helper");
          $gcm = new GCM();

          if ($standard == 0 || $standard == "") {
            $result = $gcm->send_topics("/topics/" . $this->config->item("GCM_TOPIC") . "_" . $school_id, $message, "android");
          } else {

            if ($student_id == 0 || $student_id == "") {
              $result = $gcm->send_topics("/topics/" . $this->config->item("GCM_TOPIC") . "_" . $standard, $message, "android");
            } else {
              $this->load->model("student_model");
              $student = $this->student_model->get_school_student_by_id($student_id);
              if ($student->gcm_code != "") {
                $result = $gcm->send_notification(array($student->gcm_code), $message, "android");
              }
            }
          }


          $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                          <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <strong>Success!</strong> Your Attibute saved successfully...
                                      </div>');
        }
      }

      $this->load->model("standard_model");
      // $data["school_standard"] = $this->standard_model->get_school_standard();
      if (_get_current_user_type_id($this) == 1) {
        $data["school_standard"] = $this->standard_model->get_school_standard($school_data->school_id);
      } elseif (_get_current_user_type_id($this) == 2) {
        $teacher_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));

        $data["school_standard"] = $this->standard_model->get_school_standard($teacher_data->school_id);
        # code...
      }
      $this->load->view("notification/send", $data);
    }
  }

  public function manage_notification()
  {
    if (_is_user_login($this)) {
      $data["error"] = "";
      $this->load->model("standard_model");
      $this->load->model("teacher_model");
      $this->load->model('school_model');
      $this->load->model("notification_model");

      if (_get_current_user_type_id($this) == 1) {
        $school_data = $this->school_model->get_school_profile();
      } else if (_get_current_user_type_id($this) == 2) {
        $school_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));
      }

      $data["notification"] = $this->notification_model->get_notification($school_data->school_id);

      $this->load->view("notification/manage_notification", $data);
    }
  }
  function delete_notification($noti_id)
  {
    $this->db->query("Delete from notification where noti_id = '" . $noti_id . "'");
    redirect("notification/manage_notification");
  }
}