<?php
class Home extends Controller{
	
	public $layout = "layout";
	
	
	public function index(){
		$model = $this->model('home');
		return 'Stone cold killa';
	}
}