<?php
class Database{
	public $connection;
	
	public function __construct($config_array){
		$this->connection = mysqli_connect($config_array['host'], $config_array['user'], $config_array['pass'], $config_array['database']);	
	}
	
	public function raw($query){
		if(isset($this->connection)){
			$result = $this->connection->query($query) or die(mysqli_error($this->connection));
			return $result;
		}
	}
	
	public function query($query){
		if(isset($this->connection)){
			$result = $this->connection->query($query) or die(mysqli_error($this->connection));
			return mysqli_fetch_object($result);
		}
	}

	public function getAll($query){
		if(isset($this->connection)){
			$arr= [];
			$result = $this->connection->query($query) or die(mysqli_error($this->connection));
			while($row = $result->fetch_assoc()){
				$arr[] = $row;
			}
			return $arr;
		}
	}
}