<?php 

class Object{

	public $errors= array();
	public $error_array= array(
		UPLOAD_ERR_OK => "There are no errors",
		UPLOAD_ERR_INI_SIZE => "File exceeds UPLOAD_MAX_FILESIZE limit",
		UPLOAD_ERR_FORM_SIZE => "File exceeds MAX_FILE_SIZE limit",
		UPLOAD_ERR_PARTIAL => "The file was partially uploaded",
		UPLOAD_ERR_NO_FILE => "No file was uploaded",
		UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
		UPLOAD_ERR_CANT_WRITE => "Failed to write to disk",
		UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload"
	);




	public static function find_all(){
		return static::find_by_query("SELECT * FROM " . static::$db_table . " ");
	}



	public static function find_by_id($id){
		global $database;
		$result_array= static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE " . 
			static::$where_clause . "= '$id'");
		if (!empty($result_array)) {
			$first_item= array_shift($result_array);
		} else{
			return false;
		}
		return $first_item;
	}



	public static function find_by_query($sql){
		global $database;
		$result= $database->query($sql);
		$object_array= array();
		while($row= mysqli_fetch_array($result)){
			$object_array[]= static::assign_properties($row);
		}
		return $object_array;
	}



	public static function assign_properties($arr){
		$child_class= get_called_class();
		$object= new $child_class;

		foreach ($arr as $prop => $value) {
			if ($object->has_property($prop)) {
				$object->$prop= $value;
			}
		}

		return $object;
	}



	private function has_property($attr){
		$object_properties= get_object_vars($this);
		return array_key_exists($attr, $object_properties);
	}

	

	private function class_properties(){
		$properties= array();
		foreach (static::$db_table_fields as $db_field) {
			if (property_exists($this, $db_field)) {
				$properties[$db_field]= $this->$db_field;
			}
		}
		return $properties;
	}




	protected function clean_properties(){
		global $database;

		$clean_properties= array();
		foreach ($this->class_properties() as $key => $value) {
			$clean_properties[$key]= $database->escape_string($value);
		}
		return $clean_properties;
	}



	public function create_account(){
		global $database;
		$properties= $this->clean_properties();

		$sql="INSERT INTO " . static::$db_table . "(".implode(", ", array_keys($properties)).")";
		$sql.="VALUES('" .implode("', '", array_values($properties)). "')";

		if ($database->query($sql)) {
			$this->user_id= $database->auto_id();
			$_SESSION['user_id']= $this->user_id;
			return true;
		} else {
			return false;
		}
	}



	public function update_by_id($id){
		global $database;

		$properties= $this->clean_properties();
		$property_pairs= array();

		foreach ($properties as $key => $value) {
			$property_pairs[]= "{$key}='{$value}'";
		}

		$sql="UPDATE " . static::$db_table . " SET ";
		$sql.= implode(", ", $property_pairs);
		$sql.=" WHERE " . static::$where_clause . " = " . $database->escape_string($id);

		$database->query($sql);
		return (mysqli_affected_rows($database->conn) == 1) ? true: false;
	}




	public function delete($id){
		global $database;

		$sql="DELETE FROM " . static::$db_table . " WHERE " . 
		static::$where_clause . "= " . $database->escape_string($id);
		if($database->query($sql)) {
			return true;
		} else {
			return false;
		}
	}



	public function save($id){
		return isset($this->user_id) ? $this->update_by_id($id) : $this->create_account();
	}


	public static function count_all(){
		global $database;

		$sql="SELECT COUNT(*) FROM " . static::$db_table;
		$result= $database->query($sql);
		$row= mysqli_fetch_array($result);
		
		return array_shift($row);
	}


}//End of class


?>