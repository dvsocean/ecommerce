<?php 
class Extras extends Object {
public $pic_id;
public $title;
public $filename;
public $type;
public $extra_pics_folder= "user_images";
protected static $where_clause= "pic_id";
protected static $db_table= "profile_pics";
protected static $db_table_fields= array('title', 'type', 'filename');
public $user_errors= array();



	public function dynamic_extras_path(){
		return $this->extra_pics_folder . DS . $this->filename;
	}






	public static function display_extras(){

	}







}//End of class



?>