<?php
class Admin extends Controller{
	
	public $restrictionRole = ['admin'];
	
	public $layout = 'admin/home';
	
	public function index(){
		$this->view('admin/index');
	}
	
}