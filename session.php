<?php 

class Session{
	private $signed_in= false;
	public $id;
	private $authorize= false;
	public $count;

	function __construct(){
		session_start();
		$this->visitor_count();
		$this->check_login();
	}

	private function check_login(){
		if (isset($_SESSION['user_id'])) {
			$this->id= $_SESSION['user_id'];
			$this->signed_in= true;
		} else {
			unset($this->id);
			$this->signed_in= false;
		}
	}



	public function visitor_count(){
		if (isset($_SESSION['count'])) {
			return $this->count= $_SESSION['count']++;
		} else {
			return $_SESSION['count'] = 1;
		}
	}




	public function is_signed_in(){
		return $this->signed_in;
	}

	public function authorized($user){
		if ($user->admin) {
			return true;
		} else {
			return false;
		}
	}

	public function login($user){
		if ($user) {
			$this->id= $_SESSION['user_id']= $user->user_id;
			$this->signed_in= true;
		}
	}

	public function logout($user){
		unset($_SESSION['user_id']);
		unset($this->id);
		$this->signed_in= false;
	}

	public static function set_message($msg){
		$_SESSION['message']= $msg;
	}

	public static function display_message(){
		if (isset($_SESSION['message'])) {
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		}
	}

}//End of class

$session= new Session();
?>