<?php
class Session{
	private $logged_in = false;
	public $operator_id;
	public $application;
	public $name;
	public $access_level;
	public $message;
	public $state;
	public $publication_name;
	public $publication_date;
	public $batch_id;
	public $action;
	public $job_number;
	public $start;
	public $end;
	public $page_no;
		
	function __construct(){
		session_start();
		$this->check_login();	
		$this->check_publication();
		$this->check_action();
		$this->check_message();
		$this->check_page();
		//$this->check_time();
	}
	public function check_message(){
		if(isset($_SESSION['message'])){
			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);
		} else {
			$this->message = "";
		}
	}
	public function set_message($msg=""){
		if(!empty($msg)){
			$_SESSION['message'] = $msg;
		} else {
			return $this->message;
		}
	}
	public function login($user,$application,$name,$access_level) {
    	if($user){
			$this->operator_id = $_SESSION['operator_id'] = $user;
			$this->application = $_SESSION['application'] = $application;
			$this->name = $_SESSION['name'] = $name;
			$this->access_level = $_SESSION['access_level'] = $access_level;
			$this->logged_in = true;
    	}
	}
	
	public function is_logged_in(){
		return $this->logged_in;
	}
	
	public function logout(){
		unset($_SESSION['operator_id']);
		unset($_SESSION['application']);
		unset($_SESSION['name']);
		unset($_SESSION['access_level']);
		unset($_SESSION['state']);
		unset($_SESSION['publication_name']);
		unset($_SESSION['publication_date']);
		unset($_SESSION['batch_id']);
		unset($_SESSION['job_number']);
		unset($_SESSION['action']);
		unset($_SESSION['start']);
		unset($_SESSION['page_no']);
		unset($this->operator_id);
		unset($this->application);
		unset($this->name);
		unset($this->access_level);
		unset($this->state);
		unset($this->publication_name);
		unset($this->publication_date);
		unset($this->batch_id);
		unset($this->job_number);
		unset($this->action);
		unset($this->start);
		unset($this->page_no);
		$this->logged_in = false;
	}	
	
	public function logout_newspaper(){
		unset($_SESSION['state']);
		unset($_SESSION['publication_name']);
		unset($_SESSION['publication_date']);
		unset($_SESSION['batch_id']);
		unset($_SESSION['job_number']);
		unset($_SESSION['action']);
		unset($_SESSION['start']);
		unset($this->state);
		unset($this->publication_name);
		unset($this->publication_date);
		unset($this->batch_id);
		unset($this->job_number);
		unset($this->action);
		unset($this->start);	
	}
	
	public function log_newspaper($state,$pubname,$pubdate,$batch_id,$jobnumber) {
		$this->state = $_SESSION['state'] = strtoupper($state);
    	$this->publication_name = $_SESSION['publication_name'] = strtoupper($pubname);
		$this->publication_date = $_SESSION['publication_date'] = strtoupper($pubdate);	
		$this->batch_id = $_SESSION['batch_id'] = strtoupper($batch_id);
		$this->job_number = $_SESSION['job_number'] = strtoupper($jobnumber);
	}
	
	public function log_action($action){
		$this->action = $_SESSION['action'] = $action;
	}
	
	public function log_start(){
		if(isset($_SESSION['start'])){
			$this->start = $_SESSION['start'];;
		} else {
			$this->start = $_SESSION['start'] = time();
		}
	}

	public function set_page($page=''){
		$this->page_no = $_SESSION['page_no'] = $page;
	}

	
	
	public function log_end(){
		unset($_SESSION['start']);
		unset($this->start);
	}
	
	
	public function check_time(){
		if(isset($_SESSION['start'])){
			$this->start = $_SESSION['start'];
		} else {
			unset($this->start);
		}
	
	}
	private function check_action(){
		if(isset($_SESSION['action'])){
			$this->action = $_SESSION['action'];
		} else {
			unset($this->action);
		}
	}
	
	private function check_page(){
		if(isset($_SESSION['page_no'])){
			$this->page_no = $_SESSION['page_no'];
		} else {
			unset($this->page_no);
		}
	}
	
	
	private function check_login(){
		if(isset($_SESSION['operator_id'])){
			$this->operator_id = $_SESSION['operator_id'];
			$this->application = $_SESSION['application'];
			$this->name = $_SESSION['name'];
			$this->access_level = $_SESSION['access_level'];
			$this->logged_in = true;
		} else {
			unset($this->operator_id);
			$this->logged_in = false;
		}
	}
		
	private function check_publication(){
		if (isset($_SESSION['publication_name'])){
			$this->state = $_SESSION['state'];
			$this->publication_name = $_SESSION['publication_name'];
			$this->publication_date = $_SESSION['publication_date'];
			$this->batch_id = $_SESSION['batch_id'];
			$this->job_number = $_SESSION['job_number'];
		} else {
			unset($this->state);
			unset($this->publication_name);
			unset($this->publication_date);
			unset($this->batch_id);
			unset($this->job_number);
		}
	}
}
$session = new Session();
$message = $session->set_message();
?>