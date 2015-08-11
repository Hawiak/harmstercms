<?php
class ValidationError{
	public $errors = [];

	public function add($error){
		$this->errors[] = $error;
		return $this->errors;
	}

	public function render(){
		return $this->errors;
	}
}