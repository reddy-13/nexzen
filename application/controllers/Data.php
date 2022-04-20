<?php 
/**
 * Data fetching from fiferent table
 */
class Data extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->database();

       	//loading model
       	$this->load->model('data_model');
	}

	public function index()
	{
		$data = $this->data_model->get_data();
		echo "<pre>";
		print_r($data);
	}
}


 ?>