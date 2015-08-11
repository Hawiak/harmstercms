<?php
class App extends Main{

	protected $controller = 'home';

	protected $method = 'index';

	protected $params = [];

	public $layout;

	public $result;

	public function __construct($super){
		parent::__construct($super);

		$this->controller = $super->core->getConfig()['site_config']['homecontroller'];
		$this->method = $super->core->getConfig()['site_config']['homemethod'];

		$url = $this->parseUrl();
		if(file_exists('app/controllers/' . $url[0]. '.php')) {
			$this->controller = $url[0];
			unset($url[0]);
		}
		require_once('/app/controllers/' . $this->controller . '.php');
		$this->controller = new $this->controller($this->super);

		if($this->controller->hasRestriction()){
			$rows =$this->super->getAcl()->hasRoleArr($this->controller->restrictionRole);
			if(count($rows) == 0 || !$this->super->getAcl()->isLoggedin()){
				// Geen toegang.
				Helpers::redirect('/harmstercms/');
			}
		}

		// try and set the layout
		if(isset($this->controller->layout)) {
			$this->layout = $this->controller->layout;
		}

		if(isset($url[1])){
			if(method_exists($this->controller, $url[1])){
				$this->method = $url[1];
				unset($url[1]);
			}
		}


		if(isset($this->controller->restrictMethods) && is_array($this->controller->restrictMethods)){
			if(array_key_exists($this->method, $this->controller->restrictMethods)){
				$restriction = $this->controller->restrictMethods[$this->method];
				if(!$this->super->getAcl()->hasRole($restriction)){
					var_dump($this->super->getAcl()->hasRole($restriction));
					echo 'Hij komt hier';
					//Helpers::redirect('/harmstercms/');
				}
			}
		}

		$this->params = $url  ? array_values($url) : [];

		$result = call_user_func_array([$this->controller, $this->method], $this->params);
		$this->result = $result;
	}

	public function parseUrl(){
		if(Get::_get('url') != null){
			return $url = explode('/',filter_var(rtrim(Get::_get('url'), '/'), FILTER_SANITIZE_URL));
		}
	}

	public function render(){
		if(isset($this->layout) && isset($this->controller->layout)){
			// try and set the layout
			if(isset($this->controller->layout)) {
				$this->layout = $this->controller->layout;
			}
			$super = $this->super;
			$layout = new Layout();
			$layout->super = $this->super;
			$data = $this->controller->data;
			require_once('/app/views/' . $this->controller->view . '.php');
			require_once("/app/layouts/" . $this->layout . ".php");
		}elseif(isset($this->controller->view)){
			$data = $this->controller->data;
			require_once('/app/views/' . $this->controller->view . '.php');
		}else{
			return $this->result;
		}
	}
}