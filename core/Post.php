<?php
class Post{
	static function _get($var){
		if(isset($_POST[$var])){
			return $_POST[$var];
		}else{
			return null;
		}
	}
}