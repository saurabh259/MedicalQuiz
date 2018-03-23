<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
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

	public function index()
	{
		$this->load->view('login_view');
	}

	public function home(){

		if(!isset($_SESSION['username'])){
            redirect("Login");  

        }
        else
			$this->load->view('welcome_view');

	}

	public function process()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST"){

		$username = $password = "";
		$username_err = $password_err = "";
    	
		if(empty(trim($_POST["username"]))){
        	$username_err = 'Please enter username.';
        	$data['username_err'] = $username_err;
    	} else{
        	$username = trim($_POST["username"]);
    	}
    
	    // Check if password is empty
	    if(empty(trim($_POST['password']))){
	        $password_err = 'Please enter your password.';
	        $data['password_err'] = $password_err;
	    } else{
	        $password = trim($_POST['password']);
	    }

	    // Validate credentials
	    if(empty($username_err) && empty($password_err)){

	     	$query = $this->db->get_where("users",array("login"=>$username,"password"=>$password));

	     	if(sizeof($query->result_array())!=0){
	     		/* Password is correct, so start a new session and
	            save the username to the session */
              	$this->session->set_userdata(array('username'=>$username,'user_id'=>$query->result_array()[0]['user_id']));  
				$this->load->view('welcome_view');
	       	}
	     	else{
	        	$data['password_err'] = 'Please check your credentials.';
	            $this->load->view('login_view', $data);  
	     	}
	    }
	    
	    else{
	        $this->load->view('login_view', $data);
	    }

	}
	else
		$this->load->view('login_view');
}


    public function logout()  
    {  
        //removing session  
        $this->session->unset_userdata('username');  
        redirect("Login");  
    } 
}
