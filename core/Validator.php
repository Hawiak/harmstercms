<?php
class Validator{
	static function csrf($input){
		$token = Session::csrfTokenGet();
		if($input === $token){
			Session::csrfTokenRemove();
			return true;
		}else{
			return false;
		}
	}
	
	static function password($password1, $password2, $rules = []){
		$error = new ValidationError();
		if($password1 != $password2){
			$error->add('Wachtwoorden komen niet overeen');
		}
		
		if(!empty($rules)){
			if(isset($rules['min_length'])){
				if(strlen($password1) < $rules['min_length']){
					$error->add('Wachtwoord moet langer zijn dan ' . $rules['min_length']);
				}
			}
			if(isset($rules['special_chars'])){
				if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password1)){
					$error->add('Wachtwoord moet speciaale karakters hebben');
				}
			}
		}
		
		
		if(count($error->errors) == 0){
			return true;
		}else{
			return $error;
		}
	}
}

