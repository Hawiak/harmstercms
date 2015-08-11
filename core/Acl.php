<?php
class Acl extends Main{
	
	public function isLoggedin(){
		if(Session::get('user_id')){
			return true;
		}else{
			return false;
		}
	}
	
	public function login($user_id){
		Session::set('user_id', $user_id);
	}
	
	public function hasRole($role_name){
		if($this->isLoggedin() == true) {
			$rows = $this->super->getCore()->getDatabase()->query("SELECT * FROM rollen WHERE naam='$role_name' LIMIT 1");
			if (count($rows) > 0) {
				$user_id = Session::get('user_id');
				$role_id = $rows->id;
				$rows = $this->hasRoleById($user_id, $role_id);
				if($rows = true){
					return true;
				}elseif($rows == false){
					return false;
				}else{
					return false;
				}
			} else {
				return false;
			}
		}else{
			return false;
		}
	}
	  
	public function hasRoleById($user_id, $role_id){
		if($this->isLoggedin()){
			$rows = $this->super->getCore()->getDatabase()->raw("SELECT * FROM gebruiker_rollen WHERE gebruiker_id=". $user_id ." AND rol_id=" . $role_id);
			if($rows->num_rows > 0 && $rows != false){
				return true;
			}elseif($rows == false){
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function hasRoleArr($roles){
		$roles = implode("','", $roles);
		$query = "
		SELECT * FROM gebruiker_rollen AS gr
		JOIN rollen AS r ON gr.rol_id = r.id
		WHERE r.naam IN('$roles')
		";
		
		return $rows = $this->super->getCore()->getDatabase()->raw($query);

	}
	
	static function doHash($word, $salt){
		// Het kan veiliger. Ik weet het.
		return sha1($word + $salt);
	}
	
	static function generateSalt(){
		return $salt = uniqid(mt_rand(), true);
	}
	
	static function logout(){
		unset($_SESSION);
	}
	
	
}