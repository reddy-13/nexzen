<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookSection extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // Your own constructor code
    $this->load->database();
    $this->load->helper('login_helper');
  }

  public function manage_book()
  {
    if (_is_user_login($this)) {
      $data["error"] = "";
      $this->load->model("books_model");
      $this->load->model("standard_model");
      $this->load->model("teacher_model");
      $this->load->model('school_model');

      if (_get_current_user_type_id($this) == 1) {
        $school_data = $this->school_model->get_school_profile();
      } else if (_get_current_user_type_id($this) == 2) {
        $school_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));
      }


      $data["books"] = $this->books_model->get_school_books($school_data->school_id);

      // $this->load->model("standard_model");
      // $data["school_standard"] = $this->standard_model->get_school_standard();       
      $school_data = $this->school_model->get_school_profile();
      /* get school standard */
      if (_get_current_user_type_id($this) == 1) {
        $data["school_standard"] = $this->standard_model->get_school_standard($school_data->school_id);
      } elseif (_get_current_user_type_id($this) == 2) {
        $teacher_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));
        $data["school_standard"] = $this->standard_model->get_school_standard($teacher_data->school_id);
        # code...
      }
      if ($_POST) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('book_title', 'Book Title', 'trim|required');
        $this->form_validation->set_rules('book_author', 'Book Author', 'trim|required');
        $this->form_validation->set_rules('book_description', 'Book Description', 'trim|required');
        if ($this->form_validation->run() == FALSE) {

          $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> ' . $this->form_validation->error_string() . '
                                </div>';
        } else {

          $book_title = $this->input->post("book_title");
          $book_author = $this->input->post("book_author");
          $book_description = $this->input->post("book_description");
          $standard = $this->input->post("standard");

          /*** Thumb Image **/
          $file_name = "";
          $config['upload_path'] = './uploads/books_thum/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $this->load->library('upload', $config);

          if ($_FILES["thumbnail"]["size"] > 0)
            if (!$this->upload->do_upload('thumbnail')) {
              $error = array('error' => $this->upload->display_errors());
            } else {
              $file_data = $this->upload->data();
              $file_name = $file_data["file_name"];
            }
          /*** End Thumb Image **/

          /*** Pdf Upload  ***/
          $uploads_dir = "uploads/books_pdf";
          if (!is_dir($uploads_dir)) mkdir($uploads_dir, 0777, true);
          $tmp_name = $_FILES["uploadfile"]["tmp_name"];
          $name = $_FILES["uploadfile"]["name"];
          move_uploaded_file($tmp_name, "$uploads_dir/$name");
          $url = $name;

          /*** End Pdf Upload **/

          if (_get_current_user_type_id($this) == 1) {
            $school_data = $this->school_model->get_school_profile();
          } else if (_get_current_user_type_id($this) == 2) {
            $school_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));
          }

          $this->load->model("common_model");
          $this->common_model->data_insert(
            "books",
            array(
              "book_title" => $book_title, "school_id" => $school_data->school_id,
              "book_author" => $book_author, "book_description" => $book_description,
              "book_standard" => $standard, "book_thumb" => $file_name, "book_file" => $url
            )
          );
          $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Exam Added Successfully
                                </div>');
          redirect("booksection/manage_book");
        }
      }

      $this->load->view("booksec/manage_book", $data);
    }
  }
  public function edit_book($book_id)
  {
    if (_is_user_login($this)) {
      $data = array();
      $this->load->model("books_model");
      $examid = $this->books_model->get_school_exam_by_id($book_id);
      $data["books"] = $examid;

      $this->load->model("standard_model");
      // $data["school_standard"] = $this->standard_model->get_school_standard();
      // $this->load->model("standard_model");
      $this->load->model('school_model');
      $school_data = $this->school_model->get_school_profile();
      $this->load->model("teacher_model");
      if (_get_current_user_type_id($this) == 1) {
        $data["school_standard"] = $this->standard_model->get_school_standard($school_data->school_id);
      } elseif (_get_current_user_type_id($this) == 2) {
        $teacher_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));

        $data["school_standard"] = $this->standard_model->get_school_standard($teacher_data->school_id);
        # code...
      }
      if ($_POST) {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('book_title', 'Book Title', 'trim|required');
        $this->form_validation->set_rules('book_author', 'Book Author', 'trim|required');
        $this->form_validation->set_rules('book_description', 'Book Description', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

          $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> ' . $this->form_validation->error_string() . '
                                </div>';
        } else {


          $book_title = $this->input->post("book_title");
          $book_author = $this->input->post("book_author");
          $book_description = $this->input->post("book_description");
          $standard = $this->input->post("standard");


          if (_get_current_user_type_id($this) == 1) {
            $school_data = $this->school_model->get_school_profile();
          } else if (_get_current_user_type_id($this) == 2) {
            $school_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));
          }

          $update_array = array(
            "book_title" => $book_title, "school_id" => $school_data->school_id,
            "book_author" => $book_author, "book_description" => $book_description,
            "book_standard" => $standard
          );

          /*** Thumb Image **/

          $config['upload_path'] = './uploads/books_thum/';
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $this->load->library('upload', $config);

          if ($_FILES["thumbnail"]["size"] > 0)
            if (!$this->upload->do_upload('thumbnail')) {
              $error = array('error' => $this->upload->display_errors());
            } else {
              $file_data = $this->upload->data();
              $file_name = $file_data["file_name"];
              $update_array["book_thumb"] = $file_name;
            }
          /*** End Thumb Image **/

          /*** Pdf Upload  ***/
          if ($_FILES["uploadfile"]["size"] > 0) {
            $uploads_dir = "uploads/books_pdf";
            if (!is_dir($uploads_dir)) mkdir($uploads_dir, 0777, true);
            $tmp_name = $_FILES["uploadfile"]["tmp_name"];
            $name = $_FILES["uploadfile"]["name"];
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
            $url = $name;
            $update_array["book_file"] = $url;
          }
          /*** End Pdf Upload **/

          $this->load->model("common_model");
          $this->common_model->data_update(
            "books",
            $update_array,
            array("book_id" => $book_id)
          );

          $this->session->set_flashdata("message", '<div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Book Update Successfully
                                </div>');
          redirect("BookSection/edit_book/".$book_id);
        }
      }


      $this->load->view("booksec/edit_book", $data);
    }
  }
  function delete_book($book_id)
  {
    $this->db->query("Delete from books where book_id = '" . $book_id . "'");
    $this->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Success!</strong> Book Deleted Successfully
                                </div>');
    redirect("BookSection/manage_book");
  }
}