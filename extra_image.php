<?php 
class Extras extends Object {
public $title;
public $filename;
public $type;
public $extra_pics_folder= "user_images";
protected static $db_table= "profile_pics";
protected static $db_table_fields= array('title', 'type', 'filename');
public $user_errors= array();



	public function dynamic_extras_path(){
		return $this->extra_pics_folder . DS . $this->filename;
	}




	public function upload_new_profile_image($file){
		global $database;
		if (empty($file) || !$file || !is_array($file)) {
			$this->user_errors[]= "There was an error with the USER IMAGE file upload DANIKA";
			return false;
		}

		if ($file['error'] == 0) {
			$target_path= SITE_ROOT . DS . $this->extra_pics_folder . DS . $this->filename;
			$temp_name= $file['tmp_name'];

			if (move_uploaded_file($temp_name, $target_path)) {
				$sql="INSERT INTO profile_pics(" .  implode(", ", self::$db_table_fields). ")";
				$sql.=" VALUES('$this->title', '$this->type', '$this->filename')";

				if ($database->query($sql)) {
					return true;
				} else {
					return false;
				}
			} else {
				$this->user_errors[]= "Unable to move uploaded file";
			}
		}
	}



	public static function display_extras(){

	}







}//End of class



?>