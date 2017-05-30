<?php
	require_once('config.php');

	class MySQLDatabase{

		private $connection;
		public $last_query;
		function __construct(){
			$this->open_connection();
		}
		//..........connecting to DB
		public function open_connection(){
			$this->connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
			if(!$this->connection){
				die("DB connection fail!".mysqli_error($this->connection));
			}
		}
		//.........closing connection
		public function close_connection(){
			if(isset($this->connection)){
				mysqli_close($this->connection);
				unset($this->connection);
			}
		}

		//..........performing query
		public function query($sql){
			$this->last_query = $sql;
			$result = mysqli_query($this->connection,$sql);
			if(!$result){
				die("Database query fail!.".mysqli_error($this->connection));
			}else{
				return $result;
			}
		}
		//.........escaping value
		public function escape_value( $value ) {
			$magic_quotes_active = get_magic_quotes_gpc();
			$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
			if( $new_enough_php ) { // PHP v4.3.0 or higher
				// undo any magic quote effects so mysql_real_escape_string can do the work
				if( $magic_quotes_active ) { $value = stripslashes( $value ); }
				$value = mysql_real_escape_string( $value );
			} else { // before PHP v4.3.0
				// if magic quotes aren't already on then add slashes manually
				if( !$magic_quotes_active ) { $value = addslashes( $value ); }
				// if magic quotes are active, then the slashes already exist
			}
			return $value;
		}

		//.........fething result
		public function fetch_array($result){
			return mysqli_fetch_assoc($result);
		}

		public function insert_id(){
			return mysqli_insert_id($this->connection);
		}

		public function num_rows($result){
			return mysqli_num_rows($result);
		}

	}

	$database = new MySQLDatabase();

?>