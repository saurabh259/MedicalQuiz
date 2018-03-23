<?php 
   Class Response_model extends CI_Model {
	
      Public function __construct() { 
         parent::__construct(); 
      }

      public function insertUserResponse($data){
        print_r($this->db->insert('responses',$data));
      }
  }   
?>