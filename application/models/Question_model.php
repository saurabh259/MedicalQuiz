<?php 
   Class Question_model extends CI_Model {
	
      Public function __construct() { 
         parent::__construct(); 
      }

      public function getQuestionById($id){

          $query = $this->db->get_where("questions",array("question_id"=>$id));
          $data = $query->result();
          return $data;

      }

      public function getOptionById($id){

          $question = $this->getQuestionById($id);
          $options = ($question[0]->options);
          $optionArray = explode(',', $options);

          $optionSet=[];
          
          foreach($optionArray as $optionId  ){
            $query = $this->db->get_where("options",array("option_id"=>$optionId));
            $data = $query->result();
            if(!empty($data))
              $optionSet[] = $data[0];
          }
          
          return $optionSet;
      }

      public function getQuestionIdsFilter($ansFilter,$filter_array){

          $param_array['filter_array'] = $filter_array;
          
          if($ansFilter==1){
              $param_array['answered'] = $_SESSION["user_id"];
          }
          else if($ansFilter==2){
              $param_array['unanswered'] = $_SESSION["user_id"];
          }

          $data = $this->getFilteredQuestions($param_array);
          $idSet = [];
          foreach ($data as $question){
            $idSet[]=$question->question_id;
          }

          return $idSet;

      }

      public function getQuestionIdsSearch($ansFilter,$keyword){

          if($ansFilter==1){
              $param_array['answered'] = $_SESSION["user_id"];
          }
          else if($ansFilter==2){
              $param_array['unanswered'] = $_SESSION["user_id"];
          }

          $param_array['keyword'] = $keyword;
          $data = $this->searchQuestions($param_array);
          $idSet = [];
          foreach ($data as $question){
            $idSet[]=$question->question_id;
          }

          return $idSet;

      }

      public function getQuestionIdsAll($ansFilter){

          if($ansFilter==1){
              $param_array['answered'] = $_SESSION["user_id"];
          }
          else if($ansFilter==2){
              $param_array['unanswered'] = $_SESSION["user_id"];
          }

          $data = $this->getAllQuestions($param_array);
          $idSet = [];
          foreach ($data as $question){
            $idSet[]=$question->question_id;
          }

          return $idSet;

      }


      //Get all questions
      public function getAllQuestions($array_params){

        if(isset($array_params['answered'])){
          $user_id = $array_params['answered'];
          $query = "SELECT * from questions WHERE questions.question_id IN (SELECT (responses.question_id) from responses where responses.user_id=$user_id)";
        }

        else if(isset($array_params['unanswered'])){
          $user_id = $array_params['unanswered'];
          $query = "SELECT * from questions WHERE questions.question_id NOT IN (SELECT (responses.question_id) from responses where responses.user_id=$user_id)";
        }
        else
          $query = "SELECT * from questions";

          $result = $this->db->query($query)->result();
        return $result;
      }


      //Get Filtered questions
      public function getFilteredQuestions($array_params){

        $filter_array = $array_params['filter_array'];
        
        if(isset($array_params['answered'])){       
          $user_id = $array_params['answered'];
          $query = "SELECT * from questions WHERE questions.question_id in (SELECT (responses.question_id) from responses where responses.user_id=$user_id)";
        }
        
        else if(isset($array_params['unanswered'])){
          $user_id = $array_params['unanswered'];
          $query = "SELECT * from questions WHERE questions.question_id not in (SELECT (responses.question_id) from responses where responses.user_id=$user_id)";
        }

        else
          $query = "SELECT * from questions WHERE 1=1 ";

        
        foreach($filter_array as $key => $value){
          $query = $query."and questions.".$key."='".$value."'";
        }
        $result = $this->db->query($query)->result();
        // print_r($result);
        return $result;
      }

      //Get searched questions
      public function searchQuestions($array_params){

        $keyword = $array_params['keyword'];        
        if(isset($array_params['answered'])){       
          $user_id = $array_params['answered'];     
          $query = "SELECT * from questions WHERE questions.question_id in (SELECT (responses.question_id) from responses where responses.user_id=$user_id) and questions.question Like '%$keyword%'";
        }

        else if(isset($array_params['unanswered'])){
          $user_id = $array_params['unanswered'];     
          $query = "SELECT * from questions WHERE questions.question_id not in (SELECT (responses.question_id) from responses where responses.user_id=$user_id) and questions.question Like '%$keyword%'";
        }

        else
          $query = "SELECT * from questions WHERE questions.question Like '%$keyword%'";

        $result = $this->db->query($query)->result();
        return $result;
      }

      //Merging all 3 functions for getting questions above
        public function getQuestionsFinal($array_params){
          $query = "SELECT * from questions WHERE 1=1 ";

          //Check if drop down filter is selected
          if( isset($array_params['filter_array'])){
            foreach($array_params['filter_array'] as $key => $value){
                $query = $query."and questions.".$key."='".$value."' ";
            }
          }

          //Check if search filter is selected
          if( isset($array_params['keyword'])){
            $keyword = $array_params['keyword'];
            $query = $query."and questions.question Like '%$keyword%'";
          }

          //Check if answered filter is selected
          if( isset($array_params['answered'])){
              $user_id = $array_params['answered'];     
              $query = $query."and questions.question_id in (SELECT (responses.question_id) from responses where responses.user_id=$user_id)";
          }

          //Check if unanswered filter is selected
          if( isset($array_params['unanswered'])){
              $user_id = $array_params['unanswered'];     
              $query = $query."and questions.question_id not in (SELECT (responses.question_id) from responses where responses.user_id=$user_id)";
          }

          $result = $this->db->query($query)->result();
          return $result;

      }

      public function getIds($array_params){

          $query = "SELECT question_id from questions WHERE 1=1 ";

          //Check if drop down filter is selected
          if( isset($array_params['filter_array'])){
            foreach($array_params['filter_array'] as $key => $value){
                $query = $query."and questions.".$key."='".$value."' ";
            }
          }

          //Check if search filter is selected
          if( isset($array_params['keyword'])){
            $keyword = $array_params['keyword'];
            $query = $query."and questions.question Like '%$keyword%'";
          }

          //Check if answered filter is selected
          if( isset($array_params['answered'])){
              $user_id = $array_params['answered'];     
              $query = $query."and questions.question_id in (SELECT (responses.question_id) from responses where responses.user_id=$user_id)";
          }

          //Check if unanswered filter is selected
          if( isset($array_params['unanswered'])){
              $user_id = $array_params['unanswered'];     
              $query = $query."and questions.question_id not in (SELECT (responses.question_id) from responses where responses.user_id=$user_id)";
          }
          $result = $this->db->query($query)->result();
          return $result;

      }


  }   
?>