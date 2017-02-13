<?php 
class User extends Object {

	protected static $db_table= "users";
	protected static $where_clause= "user_id";
	protected static $db_table_fields= array('username', 'password', 'first_name', 'last_name', 'email', 'bio', 
		'who_are_you', 'user_image', 'shipping_address', 'shipping_space', 'shipping_city', 'shipping_state', 
	'shipping_zipcode', 'admin');

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
  	public $temp_path;
  	public $upload_directory= "user_uploads";
  	public $image_placeholder= "../PLACEHOLDER/PLACEHOLDER.JPG";
  	

  	public static function delete_users_ajax($data){
  		global $database;
  		foreach ($data as $id) {
  			$sql= "DELETE FROM users WHERE user_id=".$id;
			$database->query($sql);
  		}
  	}


  	public function dynamic_user_image(){
		return $this->upload_directory . DS . $this->user_image;
	}


  	public function user_image(){
  		return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
  	}

	
	public static function user_login($username, $password){
		global $database;
		$result= $database->query("SELECT * FROM users WHERE username= '$username' AND password='$password'");
		$user_row= mysqli_fetch_array($result);
		return $user_row;
	}



	public function set_user_image($file){

		if (!is_array($file)){
			Session::set_message("<h3 class='bg-danger text-center curves'>NO IMAGE WAS FOUND</h3>");
			return false;
		} elseif ($file['error'] != 0) {
			Session::set_message("<h3 class='bg-primary text-center curves'>".$this->error_array[$file['error']]."</h3>");
			return false;
		} else {
			$this->user_image= $file['name'];
			$this->temp_path= $file['tmp_name'];
			return true;
		}		
	}


	public function save_user_and_image(){
	
		$target_path= SITE_ROOT . DS . $this->upload_directory . DS . $this->user_image;

		if (file_exists($target_path) || empty($this->user_image)) {
			Session::set_message("<h3 class='bg-primary text-center curves'>You may upload a new profile image anytime</h3>");
			$this->user_image= null;
			$this->create();
		} else {
			move_uploaded_file($this->temp_path, $target_path);
			$this->create();
			unset($this->temp_path);
		}
		
	}




	public function update_profile_image($image, $user_id){
		global $database;
	
		$sql="UPDATE users SET user_image='{$image}' WHERE user_id='{$user_id}'";

		if ($database->query($sql)) {
			return true;
		} else {
			return false;
		}	
	}





	public static function verify_user($username, $password){
		global $database;
		$username= $database->escape_string($username);
		$password= md5($database->escape_string($password), $username);
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