<?php
class Pagination{
	public $per_page;
	public $current_page;
	public $total_count;

	public function __construct($per_page=20,$current_page=0,$total_count){
		$this->per_page = (int)$per_page;
		$this->current_page = (int)$current_page;
		$this->total_count = (int)$total_count;

		}
		public function total_page(){
			return ceil($this->total_count/$this->per_page);
		}

		public function offset(){
			return $this->per_page * ($this->current_page -1);
		}

		public function previous_page(){
			return $this->current_page-1;
		}
		public function next_page(){
			return $this->current_page +1;
		}

		public function has_previous_page(){
			return $this->current_page > 1 ? true:false;
		}
		public function has_next_page(){
			return $this->current_page < $this->total_page() ? true:false;
		}
}

?>