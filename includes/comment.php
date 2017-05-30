<?php
	require_once('database.php');
 	class Comment extends DatabaseObject{
 		protected static $table_name = "comments";
		protected static $db_fields=array('id','photograph_id','author','body','time');
 		public $id;
 		public $photograph_id;
 		public $author;
 		public $body;
 		public $time;

 		public static function make($photograph_id,$author="Anonymous",$body=""){
 			global $database;
 			if(!empty($photograph_id) && !empty($body)){
 				$comment = new Comment();
 				$comment->photograph_id = $database->escape_value($photograph_id);
 				$comment->author = $database->escape_value($author);
 				$comment->body = $database->escape_value($body);
 				$comment->time = strftime("%Y-%m-%d %H:%M:%S",time());
 				return $comment;
 			}else{
 				return false;
 			}
 		}


 		public static function find_by_photograph_id($id=0){
			global $database;
			$sql = "SELECT * FROM ".self::$table_name." WHERE photograph_id = {$id} ORDER BY time DESC";
			$result_array =  self::find_by_sql($sql);
			return !empty($result_array)? $result_array : array();
		}
 	}
?>