<?php 
//Initialize all classes
require_once "../setup/init.php"; 


if (isset($_POST['user_id'])) {
	//a user class function deletes selected users
	$user->delete_user_ajax($_POST['user_id']);
}
?>