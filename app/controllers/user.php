<?php
class User extends Controller{

	public $layout ='layout';
	
	public $restrictMethods = [
		'add' => 'admin',
		'all' => 'admin',
		'edit' => 'admin'
	];
	
	public function add(){
		$this->layout = 'admin/home';
		if($this->restrictCall("post")) {
			$user = $this->model('User');
			
			$naam = Post::_get('naam');
			$wachtwoord1 = Post::_get('wachtwoord1');
			$wachtwoord1 = Post::_get('wachtwoord2');
			$email = Post::_get('email');

			$result = Validator::password($wachtwoord1, $wachtwoord2);
			if($result != true){
				return $this->view('admin/users/add', ['error' => $result]);
			}
			
			$salt = Acl::generateSalt();
			$wachtwoord = Acl::doHash($wachtwoord1, $salt);
			$sql = "INSERT INTO `" . $user->table . "` (naam, wachtwoord, email)VALUES('" . $naam . "', '" . $wachtwoord . "', '" . $email . "')";
			$user->insert($sql);
			return Helpers::redirectWithMessage('/harmstercms/admin', 'Gebruiker is aangemaakt.');
		}else{
			$this->view('admin/users/add');
		}
	}	
	
	public function login(){
		$loggedin = $this->super->getAcl()->isLoggedin();
		
		if(!$loggedin){
			$this->view("user/login");
		}else{
			$this->view("error/error", ['error_message' => 'Already logged in']);
		}
	}
	
	public function dologin(){
		if($this->restrictCall("post")){
			$username = Post::_get("username");
			$model = $this->model('user');
			$user = $model->query("SELECT * FROM " . $model->table . " WHERE `naam`='". $username ."'");
			if(isset($user->id)) {
				// Controleer of dit de 3e keer is dat de gebruiker probeerd in te loggen onder een foutief wachtwoord.
				$salt = $user->salt;
				$password = Acl::doHash(Post::_get("password"), $salt);
				if($user->geblokkeerd == 1){
					return Helpers::redirectWithMessage('/harmstercms/user/login', 'Dit account is geblokeerd');
				}
				$rows = $model->query("SELECT * FROM " . $model->table . " WHERE `naam`='" . $username . "' AND `wachtwoord`='" . $password . "'");
				if (count($rows) == 1) {
					$this->super->getAcl()->login($rows->id);
					return Helpers::redirectWithMessage('/harmstercms/', 'Je bent ingelogd');
				} else {
					$nu = date('Y-m-d H:i:s');
					$this->super->getCore()->getDatabase()->raw("INSERT INTO `foutief_login_geschiedenis` (gebruiker_id, datetime) VALUES (" . $user->id . ", '" . $nu . "')");
					$foutief_poging = $this->super->getCore()->getDatabase()->getAll("SELECT * FROM `foutief_login_geschiedenis` WHERE gebruiker_id=" . $user->id . " AND `datetime` > NOW() - INTERVAL 15 MINUTE");
					if(count($foutief_poging) > 3){
						$model->update("UPDATE `gebruikers` SET geblokkeerd=1");
						return Helpers::redirectWithMessage('/harmstercms/user/login', 'Dit account is nu geblokkeerd');
					}else {
						// Er staat geen tijd bij, maar dat is 15 minuten.
						return Helpers::redirectWithMessage('/harmstercms/user/login', 'Verkeerde gebruikersnaam of wachtwoord, na 3 fouteive pogingen word het account geblokkeerd');
					}
				}
			}else{
				return Helpers::redirectWithMessage('/harmstercms/user/login', 'Verkeerde gebruikersnaam of wachtwoord');
			}
		}
	}
	
	public function logout(){
		if($this->super->getAcl()->isLoggedin()){
			Session::set("user_id", "");
			session_destroy();
			return Helpers::redirectWithMessage('/harmstercms/', 'Je bent uitegelogt');
		}else{
			return Helpers::redirectWithMessage('/harmstercms/', 'Je bent uitegelogt');

		}
	}

	public function all(){
		$this->layout = 'admin/home';
		$user = $this->model('User');
		$users = $user->getAll("SELECT * FROM " . $user->table);
		$this->view('admin/users/list', ['users' => $users]);
	}

	public function edit($id){
		$this->layout = 'admin/home';
		$user = $this->model('User');
		$this->view('admin/users/edit', ['user' => $user->get($id)]);
	}

	public function store(){
		if($this->restrictCall("post")){
			$pass = true;
			$user = $this->model('User');
			$id = Post::_get('id');
			
			$email = Post::_get('email');
			$sql = "UPDATE `" . $user->table . "` SET  `email`='" . $email . "' WHERE `id`='" . $id . "'";
			$user->update($sql);
			
			// Kijk of wachtwoord ook is ingevult.
			$password1 = Post::_get('password1');
			$password2 = Post::_get('password2');

			// Passwords wijzigen als dit is ingevult
			if(isset($password1) && isset($password2)){
				$result = Validator::password($password1, $password2);
				if($result != true){
					return $this->view('admin/users/edit', ['user' => $user->get($id),'error' => $result]);
				}else{
					$salt = Acl::generateSalt();
					$password = Acl::doHash($password1, $salt);
					$sql = "UPDATE `" . $user->table . "` SET  `wachtwoord`='" . $password. "', `salt`='" . $salt . "' WHERE `id`='" . $id . "'";
					$user->update($sql);
				}
			}
			
			//Rollen updaten
			$rollen = $this->super->getCore()->getDatabase()->getAll("SELECT * FROM `rollen`");
			$post_rollen = Post::_get('rollen');

			$this->super->getCore()->getDatabase()->raw("DELETE FROM `gebruiker_rollen` WHERE gebruiker_id=" . $id);
			
			foreach($rollen as $rol){
				if(in_array($rol['id'], $post_rollen)){
					$this->super->getCore()->getDatabase()->raw("INSERT INTO `gebruiker_rollen` (rol_id, gebruiker_id)VALUES(" . $rol['id'] . "," . $id .  ")");
				}
			}
			// Redirect maar admin homepagina
			return Helpers::redirectWithMessage('/harmstercms/admin', 'Gebruiker is geupdate');
		}else{
			return $this->view('error/error', ['error_message' => 'Page is post restricted']);
		}
	}

	public function delete($id){
		if(isset($id)){
			$user = $this->model('User');
			$user->delete($id);
			return Helpers::redirectWithMessage('/harmstercms/user/all', 'Gebruiker is verwijderd');
		}
	}
}