<?php
class Helpers{
	
	static function redirect($link){
		return header('Location: ' . $link);
	}
	
	static function redirectWithMessage($link, $message){
		Session::setMessage($message);
		Helpers::redirect($link);
	}
	
	static function stylesheet($name){
		return '<link rel="stylesheet" type="text/css" href="/harmstercms/source/css/' . $name . '.css">';
	}
	
	static function csrfToken(){
		$token = Session::csrfTokenGenerate();
		return '<input type="hidden" name="csrftoken" value="' . $token . '">';
	}
}