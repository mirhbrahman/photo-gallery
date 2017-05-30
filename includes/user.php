<?php
	require_once('database.php');

	class User extends DatabaseObject{
		protected static $table_name = "users";
		protected static $db_fields=array('id', 'username', 'password', 'first_name', 'last_name');
		public $id;
		public $username;
		public $password;
		public $first_name;
		public $last_name;

	
		public static function athunticate($username="",$password=""){
			global $database;
			$username = $database->escape_value($username);
			$password = $database->escape_value($password);

			$sql = "SELECT * FROM users WHERE username = '{$username}' LIMIT 1";
			$result_array =  self::find_by_sql($sql); 
			$user =  !empty($result_array)? array_shift($result_array):false;

			if(count($user)){
				if(self::password_check($password,$user->password)){
					return $user;
				}else{
					return false;
				}
			}else{
				return false;
			}

		}
		
		public function full_name(){
			if(isset($this->first_name) && isset($this->last_name)){
				return $this->first_name." ".$this->last_name;
			}else{
				return "";
			}
		}

		public static function password_hash($password){
			return password_hash($password,PASSWORD_BCRYPT,['cost'=>10]);
		}

		private static function password_check($password,$existing_hash){
			if(password_verify($password,$existing_hash)){
				return true;
			}else{
				return false;
			}
		}

		public static function valid_email($email=""){
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return true;   
			} else {
				return false;  
			}
		}

		
	}
?>