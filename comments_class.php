<?php 
class Comment extends Object{

	protected static $db_table= "comments";
	protected static $where_clause= "photo_id";
	protected static $db_table_fields= array('id', 'photo_id', 'author', 'body');
	public $id;
	public $photo_id;
	public $author;
	public $body;

	public static function create_comment($photo_id, $author, $body){
		if (!empty($photo_id) && !empty($author) && !empty($body)) {
			$comment= new Comment();
				//assign object properties
				$comment->photo_id= $photo_id;
				$comment->author= $author;
				$comment->body= $body;

				return $comment;
		} else {
			return false;
		}
	}

	public static function find_comments_by_id($id){
		global $database;

		$sql="SELECT * FROM " . self::$db_table;
		$sql.=" WHERE " . self::$where_clause ."= " . $database->escape_string($id);

		return self::find_by_query($sql);
	}


	public static function save_comment($photo_id, $author, $body){
		global $database;

		$sql="INSERT INTO " . self::$db_table;
		$sql.=" (photo_id, author, body) VALUES('$photo_id', '$author', '$body')";

		if ($database->query($sql)) {
			return true;
		} else {
			return false;
		}
		
	}


	public function delete_from_comments_table($id){
		global $database;

		$sql="DELETE FROM " . static::$db_table . " WHERE id = " . $database->escape_string($id);
		if($database->query($sql)) {
			return true;
		} else {
			return false;
		}
	}



	public function delete_comment($id){
		if ($this->delete_from_comments_table($id)) {
			return true;
		} else {
			return false;
		}

	}


}//End of class



?>