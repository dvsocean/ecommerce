<?php 

class Photo extends Object{
	


	protected static $db_table= "photos";
	protected static $where_clause= "photo_id";
	protected static $db_table_fields= array('title', 'description', 'caption', 'filename', 'type', 
		'size');
	public $photo_id;
	public $title;
	public $description;
	public $caption;
	public $filename;
	public $type;
	public $size;
	public $temp_path;
	public $image_directory= "gbo_images";




	//This function is recieving data from the $_FILE['image'] superglobal and doing some error checking
	public function set_file($file){

		if (empty($file) || !$file || !is_array($file)) {
			$this->errors[]= "There was an error with the file upload DANIKA";
			return false;
		} elseif ($file['error'] != 0) {
			$this->errors[]= $this->error_array[$file['error']];
			return false;
		} else {
			$this->filename= basename($file['name']);
			$this->temp_path= $file['tmp_name'];
			$this->type= $file['type'];
			$this->size= $file['size'];
			return true;
		}		
	}

	


	public function dynamic_path(){
		return $this->image_directory . DS . $this->filename;
	}



	public function move_photo(){
		$target_path= SITE_ROOT . DS . $this->image_directory . DS . $this->filename;
		if (move_uploaded_file($this->temp_path, $target_path)) {
			return true;
		} else {
			return false;
		}
		
	}


	public function insert_photo_db(){
		global $database;
		$this->move_photo();
		$sql="INSERT INTO photos (" . implode(", ", self::$db_table_fields).")";
		$sql.= " VALUES('$this->title', '$this->description', '$this->caption', '$this->filename', '$this->type', 
		'$this->size')";

		if ($database->query($sql)) {
			return true;
		} else {
			return false;
		}
	}




	public function save(){
		if ($this->photo_id) {
			$this->update_by_id();
		} else {
			if (!empty($this->errors)) {
				return false;
			}
			if (empty($this->filename) || empty($this->temp_path)) {
				$this->errors[]= "The file was not available DANIKA";
				return false;
			}
			$target_path= SITE_ROOT . DS . $this->image_directory . DS . $this->filename;
		}
		if (file_exists($target_path)) {
			$this->errors[]= "The file {$this->filename} already exists";
			return false;
		}
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






	public function delete_photo($id){
		if ($this->delete($id)) {
			$target_path= SITE_ROOT . DS . $this->dynamic_path();
			unlink($target_path);
		} else {
			return false;
		}
	}
}//End of class

$photo= new Photo();

?>