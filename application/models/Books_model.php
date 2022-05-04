<?php
class Books_model extends CI_Model
{

    public function get_school_books($id)
    {
        $q = $this->db->query("select books.*,standard.standard_title from books
            inner join standard on standard.standard_id = books.book_standard
             where books.school_id=" . $id);
        return $q->result();
    }
    public function get_school_exam_by_id($book_id)
    {
        $q = $this->db->query("select * from books where  book_id = '" . $book_id . "' limit 1");
        return $q->row();
    }


    public function get_school_exam_by_id_manage_result($book_id)
    {
        $q = $this->db->query("select exam.*,standard.standard_title from exam 
        inner join standard on standard.standard_id = exam.exam_standard
         where  exam_id = '" . $book_id . "' limit 1");
        return $q->row();
    }
}