<?php

class Layout {
	
	public $blocks = [];
	
	public $texts = [];
	
	public $super;

	public function setBlock($name, $text){
		$this->blocks[$name] = $text;
 	}

	public function setText($name, $text){
		$this->texts[$name] = $text; 
	}
	
	public function renderBlock($blockname){
		if(isset($this->blocks[$blockname])) {
			return $this->blocks[$blockname];
		}else{
			return '';
		}
	}

	public function renderText($textname){
		if(isset($this->texts[$textname])){
			return $this->texts[$textname];
		}else{
			return '';
		}
	}
	
	public function renderComponent($componentName){
		$super = $this->super;
		if(file_exists('app/components/' . $componentName . '.php')){
			require_once('app/components/' . $componentName . '.php');
		}else{
			echo '';
		}
	}
}