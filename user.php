<?php 
class User extends Object {

	protected static $db_table= "gallery_users";
	protected static $where_clause= "user_id";
	protected static $db_table_fields= array('username', 'password', 'first_name', 'last_name', 'email', 'bio', 
		'who_are_you', 'user_image', 'shipping_address', 'shipping_space', 'shipping_city', 'shipping_state', 'shipping_zipcode', 
		'user_image');
	public $user_id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $email;
	public $bio;
	public $who_are_you;
	public $user_image;
	public $shipping_address;
  	public $shipping_space;
  	public $shipping_city;
  	public $shipping_state;
  	public $shipping_zipcode;
  	public $admin;
  	public $upload_directory= "user_images";
  	public $image_placeholder= "../user_profile_uploads/PLHOLD.jpg";
  	

  	public function delete_user_ajax($data){
  		global $database;
  		foreach ($data as $id) {
  			$sql= "DELETE FROM gallery_users WHERE user_id=".$id;
			$database->query($sql);
  		}
  	}


  	public function dynamic_user_image(){
		return $this->upload_directory . DS . $this->user_image;
	}


  	public function user_image(){
  		return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory. DS .$this->user_image;
  	}

	
	public static function user_login($username, $password){
		global $database;
		$result= $database->query("SELECT * FROM gallery_users WHERE username= '$username' AND password='$password'");
		$user_row= mysqli_fetch_array($result);
		return $user_row;
	}


	public function set_user_image($file){

		if (empty($file) || !$file || !is_array($file)) {
			$this->user_errors[]= "There was an error with the USER IMAGE file upload DANIKA";
			return false;
		} elseif ($file['error'] != 0) {
			$this->user_errors[]= $this->error_array[$file['error']];
			return false;
		} else {
			$this->user_image= basename($file['name']);
			$this->temp_path= $file['tmp_name'];
			return true;
		}		
	}


	public function save_user_image(){
			if (!empty($this->user_errors)) {
				return false;
			}
			if (empty($this->user_image) || empty($this->temp_path)) {
				$this->user_errors[]= "The file was not available DANIKA";
				return false;
			}
			$target_path= SITE_ROOT . DS . $this->upload_directory . DS . $this->user_image;
	
		if (move_uploaded_file($this->temp_path, $target_path)) {
			if ($this->create_account()) {
				unset($this->temp_path);
				return true;
			}
		} else { 
			$this->errors[]= "There was a problem with file permissions DANIKA";
			return false;
		}
	}




	public static function verify_user($username, $password){
		global $database;
		$username= $database->escape_string($username);
		$password= $database->escape_string($password);
		$sql="SELECT * FROM " . self::$db_table . " WHERE username='{$username}' AND password='{$password}'";

		$result_array= self::find_by_query($sql);
		if (!empty($result_array)) {
			$first_item= array_shift($result_array);
		} else{
			return false;
		}
		return $first_item;
	}

}//End class
?>