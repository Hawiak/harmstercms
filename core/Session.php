<?php
class Session{
	/** Set session var
	 * @param $var
	 * @return null
	 */
	static function get($var){
		if(isset($_SESSION[$var])){
			return $_SESSION[$var];
		}else{
			return null;
		}
	}
	static function hasMessages(){
		if(isset($_SESSION['session_message']) && $_SESSION['session_message'] != ''){
			return true;
		}else{
			return false;
		}
	}
	
	static function set($var, $val){
		$_SESSION[$var] = $val;
	}
	
	static function remove($var){
		unset($_SESSION[$var]);
	}
	
	static function setMessage($message){
		self::set("session_message", $message);
	}
	
	static function getMessage(){
		$message = self::get("session_message");
		self::remove("session_message");
		return $message;
	}
	
	static function csrfTokenGenerate(){
		$token = Acl::generateSalt();;
		Session::set('csrftoken', $token);
		return $token;
	}
	
	static function csrfTokenRemove(){
		self::remove('csrftoken');
	}
	
	static function csrfTokenGet(){
		return self::get('csrftoken');
	}
	
}