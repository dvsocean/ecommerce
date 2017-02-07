<?php 
require_once "../setup/init.php";



if (isset($_POST['username']) && isset($_POST['password'])) {
	$username= $database->escape_string($_POST['username']);
	$password= $database->escape_string($_POST['password']);

	$result= User::verify_user($username, $password);

	if ($result) {
		$session->login($result);
		echo $result->user_id;
	} else {
		return false;
	}
} 

?>