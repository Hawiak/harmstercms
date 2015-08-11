<?php
class Get{
	static function _get($var){
		if(isset($_GET[$var])){
			return $_GET[$var];
		}else{
			return null;
		}
	}
}