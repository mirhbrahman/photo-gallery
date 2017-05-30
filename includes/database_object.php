<?php 
	require_once('database.php');
	class DatabaseObject{
		protected static $table_name = "";
		protected static $db_fields=array();
		public static function find_all(){
			$sql = "SELECT * FROM ".static::$table_name;
			return static::find_by_sql($sql);
		}

		public static function find_by_id($id=0){
			global $database;
			$sql = "SELECT * FROM ".static::$table_name." WHERE id = {$id} LIMIT 1";
			$result_array =  static::find_by_sql($sql);
			return !empty($result_array)? array_shift($result_array):false;
		}

		public static function find_by_sql($sql=""){
			global $database;
			$result_set = $database->query($sql);
			$object_array = array();

			while ($row=$database->fetch_array($result_set)) {
				$object_array[] = static::instantiate($row);
			}
			return $object_array;
		}

		public static function unique_email($email=""){
			global $database;
			$sql = "SELECT * FROM ".static::$table_name." WHERE username = '{$email}' LIMIT 1";
			$result_array =  static::find_by_sql($sql);
			return count($result_array)? true:false;
		
		}

		public static function count_all(){
			global $database;

			$sql = "SELECT COUNT(*) FROM ".static::$table_name;
			$result_set = $database->query($sql);
			$row = $database->fetch_array($result_set);
			return array_shift($row);
		}

		private static function instantiate($record){
			$class_name = get_called_class();
			$object = new $class_name;

			foreach ($record as $attribute => $value) {
				if($object->has_attribute($attribute)){
					$object->$attribute = $value;
				}
			}

			return $object;
		}

		private function has_attribute($attribute){
			$object_vars = $this->get_attributes();

			return array_key_exists($attribute, $object_vars);
		}


		public  function get_attributes(){
			$object_vars = array();
			foreach(static::$db_fields as $field) {
			    if(property_exists($this, $field)) {
			      $object_vars[$field] = $this->$field;
			    }
			  }
		  return $object_vars;
		}



		public function save(){
			return isset($this->id) ? $this->update() : $this->create();
		}

		public function create(){
			global $database;

			$sql = "INSERT INTO ".static::$table_name;
			$sql .= "(".join(",",array_keys($this->get_attributes())).") ";
			$sql .= "VALUES( ";
			$sql .= "'".join("', '",array_values($this->get_attributes()))."')";


			if($database->query($sql)){
				$this->id = $database->insert_id();
				return true;
			}else{
				return false;
			}
		}

		public function update(){
			global $database;

			$attributes_pair = array();

			foreach ($this->get_attributes() as $key => $value) {
				$attributes_pair[] = "{$key} = '{$value}'";
			}

			$sql = "UPDATE ".static::$table_name." SET ";
			$sql .= join(", ", $attributes_pair);
			$sql .= " WHERE id = ".$database->escape_value($this->id);
			
			if($database->query($sql)){
				return true;
			}else{
				return false;
			}
		
		}

		public function delete(){
			global $database;
			$sql = "DELETE FROM ".static::$table_name;
			$sql .= " WHERE id = ".$this->id;
			$sql .= " LIMIT 1";

			if($database->query($sql)){
				return true;
			}else{
				return false;
			}

		}
	}
?>