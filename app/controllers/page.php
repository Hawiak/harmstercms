<?php
class Page extends Controller{
	
	public $layout = 'layout';
	
	public $restrictMethods = array(
		'edit' => 'admin', 
		'delete' => 'admin',
		'add' => 'admin',
		'store' => 'admin',
		'all' => 'admin'
	);
	
	public function index(){
		$page = $this->model('Page');
		$this->view("page/view", $page->get(1));
	}
	
	public function show($id){
		$model = $this->model('Page');
		$page = $model->get($id);
		if(isset($page->layout) && $page->layout != ''){
			$this->layout = $page->layout;
		}
		$this->view('page/view', $page);
	}

	public function edit($id){
		$this->layout = 'admin/home';
		$page = $this->model('Page');
		$this->view('admin/pages/edit', ['page' => $page->get($id)]);
	}
	
	public function add(){
		$this->layout = 'admin/home';
		if($this->restrictCall("post")) {
			$page = $this->model('Page');
			$titel = Post::_get('titel');
			$tekst = Post::_get('tekst');
			$sql = "INSERT INTO `" . $page->table . "` (titel, tekst)VALUES('" . $titel . "', '" . $tekst . "')";
			$page->insert($sql);
			return Helpers::redirectWithMessage('/harmstercms/user/all', 'Pagina is geupdate');
		}else{
			$this->view('admin/pages/add');
		}
	}
	

	public function store(){
		if($this->restrictCall("post")){
			$page = $this->model('Page');
			$id = Post::_get('id');
			$titel = Post::_get('titel');
			$tekst = Post::_get('tekst');
			$layout = Post::_get('layout');
			
			$sql = "UPDATE `" . $page->table . "` SET  `titel`='" . $titel . "', `tekst`='" . $tekst . "'";
			if($layout != ''){
				$sql .= ", `layout`='" . $layout . "' ";
			}
			$sql .= " WHERE `id`='" . $id . "'";
			$page->update($sql);
			return Helpers::redirectWithMessage('/harmstercms/admin', 'Pagina is geupdate');
		}
	}

	public function delete($id){
		if(isset($id)){
			$page = $this->model('Page');
			$page->delete($id);
			return Helpers::redirectWithMessage('/harmstercms/page/all', 'Pagina is verwijderd');
		}
	}

	public function all(){
		$this->layout = 'admin/home';
		$page = $this->model('Page');
		$pages = $page->getAll("SELECT * FROM " . $page->table);
		$this->view('admin/pages/list', ['pages' => $pages]);
	}
}