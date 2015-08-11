<?php
class Model{
	
	public $super;
	public $table;
		
	public function __construct($super){
		$this->super = $super;
	}
	
	public function query($query){
		// Voer query uit
		return $this->super->core->getDatabase()->query($query);
	}

	public function get($id){
		if(isset($this->table) && $this->table != ''){
			$result = $this->super->getCore()->getDatabase()->connection->query("SELECT * FROM " . $this->table . " WHERE `id`=" . $id);
			$obj = mysqli_fetch_object($result);
			return $obj;
		}
	}
	
	public function getAll($query){
		return $this->super->core->getDatabase()->getAll($query);
	}
	
	public function update($query){
		return $this->super->core->getDatabase()->raw($query);
	}

	public function delete($id){
		$sql = "DELETE FROM `" . $this->table . "` WHERE `id`='" . $id . "'";
		return $this->super->getCore()->getDatabase()->raw($sql);
	}

	public function insert($query){
		return $this->super->core->getDatabase()->raw($query);
	}

}