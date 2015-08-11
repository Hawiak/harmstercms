<?php
class Controller{	
	protected $super;
	public $data;
	public $view;
	public $layout;
	
	public function __construct($super){
		$this->super = $super;
	}
	
	public function model($model){
		$model = ucfirst($model); 
		require_once('/app/models/' . $model . 'Model.php');
		$model = $model . 'Model';
		return new $model($this->super);
	}
	
	public function view($view, $data = []){
		//require_once('/app/views/' . $view . '.php');
		$this->data = $data;
		$this->view = $view;
		return true;
	}

	public function hasRestriction(){
		if(isset($this->restrictionRole) && $this->restrictionRole != ''){
			return true;
		}else{
			return false;
		}
	}

	public function restrictCall($call_type){
		switch($call_type){
			case "post":
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					return true;
				}else{
					return false;
				}
			break;

			case "get":
				if($_SERVER['REQUEST_METHOD'] == 'GET'){
					return true;
				}else{
					return false;
				}
				break;
			
		}
	}

}