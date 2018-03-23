<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() { 
 		parent::__construct(); 
		$this->load->helper('url'); 
 		$this->load->database();
		$this->load->library('session');
 
      } 

   //Ajax function $user_id,$question_id,$option_id,$confidence
    public function submitResponse()
    {
        $this->load->database();
        $user_id = $this->input->post('user_id');
        $question_id = $this->input->post('question_id');
        $optionId = $this->input->post('option_id');
        $confidence = $this->input->post('confidence');



        $data = array(
          'user_id'=>$user_id,
          'question_id'=>$question_id,
          'option_id'=>$optionId,
          'confidence'=>$confidence
        );

     	$this->load->model('response_model');
     	$this->response_model->insertUserResponse($data);
	}

}
