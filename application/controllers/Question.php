<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {
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

   //Ajax function
    public function getQuestions()
    {
        $ansFilter =  $this->uri->segment(3); 
        if($ansFilter==1){
            $param_array['answered'] = $_SESSION["user_id"];
        }
        else if($ansFilter==2){
            $param_array['unanswered'] = $_SESSION["user_id"];
        }
        else
            $param_array=[];
     	$this->load->model('question_model');
     	$records = $this->question_model->getAllQuestions($param_array);
     	print_r(json_encode($records));
     	return $records;
	}

   //Ajax function
    public function searchQuestions()
    {
    	// print_r(parse_str($_SERVER['QUERY_STRING'], $_GET));
        $ansFilter = $this->uri->segment(3); 
    	$keyword =  $this->uri->segment(4); 

        if($ansFilter==1){
            $param_array['answered'] = $_SESSION["user_id"];
        }
        else if($ansFilter==2){
            $param_array['unanswered'] = $_SESSION["user_id"];
        }
     	$this->load->model('question_model');
        $param_array['keyword'] = $keyword;
     	$records = $this->question_model->searchQuestions($param_array);
     	print_r(json_encode($records));
     	return json_encode($records);

	}

    //Ajax function
    public function getfilteredQuestions()
    {
        $ansFilter = $this->uri->segment(3); 
        parse_str($_SERVER['QUERY_STRING'], $filter_array);

        $this->load->model('question_model');

        $param_array['filter_array'] = $filter_array;
        
        if($ansFilter==1){
            $param_array['answered'] = $_SESSION["user_id"];
        }
        else if($ansFilter==2){
            $param_array['unanswered'] = $_SESSION["user_id"];
        }

        $records = $this->question_model->getFilteredQuestions($param_array);
        print_r(json_encode($records));
        return json_encode($records);

    }

	public function loadQuestionPage()
	{
        if(!isset($_SESSION['username'])){
            redirect("Login");  

        }
        $this->load->model('question_model');


        $ansFilter =  $this->uri->segment(3); 
    	$id =  $this->uri->segment(4);

        //Load Question
    	$questionObj = $this->getQuestionById($id)[0];
    	$data['questionObj'] = $questionObj;

        //Load Options
    	$optionsArray = $this->getOptionByQuestionId($questionObj->question_id);
    	$data['optionsArray'] = $optionsArray;

    	foreach($optionsArray as $option){
    		$optionIds[]=$option->option_id;
    	}

    	$data['correctOption'] = array_search($questionObj->answer, $optionIds);


        //Calculate next and prev question Ids
        parse_str($_SERVER['QUERY_STRING'], $query_string);
        $npId = $this->getPreNextQuestionIds($id,$ansFilter,$query_string);
        $data['pId'] = $npId['pId'];
        $data['nId'] = $npId['nId'];
        $data['appendUrl'] = '?'.$_SERVER['QUERY_STRING'];
        $data['questionNo'] = $npId['questionNo'];
        $data['ansFilter'] = $ansFilter;

        $this->load->view('question_view', $data);
	
	}

	public function getQuestionById()
	{	
    	$id =  $this->uri->segment(4);
    	$this->load->model('question_model');
     	$records = $this->question_model->getQuestionById($id);
     	return $records; 

	}

	public function getOptionByQuestionId()
	{	
    	$id =  $this->uri->segment(4);
    	$this->load->model('question_model');
     	$records = $this->question_model->getOptionById($id);
     	return $records; 

	}

    public function getPreNextQuestionIds($id,$ansFilter,$query_string){

        //If search filter present 
        if(array_key_exists("search", $query_string)){
            $keyword = $query_string['search'];
            unset($query_string['search']);
            $param_array['keyword'] = $keyword;
        }

        //If answered/unasnwered filter present
        if($ansFilter==1){
            $param_array['answered'] = $_SESSION["user_id"];
        }
        else if($ansFilter==2){
            $param_array['unanswered'] = $_SESSION["user_id"];
        }


        //If drop down filter present
        if($query_string!="" || !empty($query_string)){
            $param_array['filter_array'] = $query_string;
        }

        $idObjs = $this->question_model->getIds($param_array);

        foreach($idObjs as $idObj){
            $ids[]=$idObj->question_id;
        }
        $len = sizeof($ids);
        
        //Next question id
        $searchIdx = array_search($id, $ids);
        
        //If this not the last question
        if($searchIdx!=$len-1)
            $nextId = $ids[$searchIdx+1];
        
        else
            $nextId = -1;

        $result['nId'] = $nextId;

        //Prev queestion id
        if($searchIdx==0)
            $preId = -1;
        else
            $preId = $ids[$searchIdx-1];

        $result['pId'] = $preId;
        $result['questionNo'] = $searchIdx+1;

        return $result;

    }

    //Ajax call
    public function getQuestionsFinal(){

        $array_params=[];
        $ansFilter =  $this->uri->segment(3); 
        if($ansFilter==1){
            $array_params['answered'] = $_SESSION["user_id"];
        }
        else if($ansFilter==2){
            $array_params['unanswered'] = $_SESSION["user_id"];
        }

        parse_str($_SERVER['QUERY_STRING'], $query_string);

        if(array_key_exists("search", $query_string)){
            $keyword = $query_string['search'];
            unset($query_string['search']);
            $array_params['keyword'] = $keyword;
        }

        if(!empty($query_string))
            $array_params['filter_array'] = $query_string;

        $this->load->model('question_model');
        $records = $this->question_model->getQuestionsFinal($array_params);
        print_r(json_encode($records));

    }
//https://drive.google.com/file/d/0B9vU1_awvyixXzl3UGNlTzNfUE0/edit?pli=1
    public function test(){
        echo "<iframe src='https://drive.google.com/open?id=0B9vU1_awvyixbm1rWVFuZmVOZ1E'>";
    }


}
