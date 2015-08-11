<?php
class Blog extends Controller{

	public $layout = 'layout';

	public $restrictMethods = array(
		'edit' => 'admin',
		'delete' => 'admin',
		'add' => 'admin',
		'store' => 'admin',
		'all' => 'admin'
	);

	public function index(){
		$this->view('admin/index');
	}

	public function add(){
		$this->layout = 'admin/home';
		if($this->restrictCall("post")) {
			$page = $this->model('Blog');
			$titel = Post::_get('titel');
			$tekst = Post::_get('tekst');
			$today = date('Y-m-d H:i:s');
			$user_id = Session::get('user_id');
			$sql = "INSERT INTO `" . $page->table . "` (titel, tekst, gebruiker_id, datetime)VALUES('" . $titel . "', '" . $tekst . "', '" . $user_id . "','" . $today . "')";
			$page->insert($sql);
			return Helpers::redirectWithMessage('/harmstercms/blog/all', 'Blog is toegevoegt');
		}else{
			$this->view('admin/blog/add');
		}
	}

	public function edit($id){
		$this->layout = 'admin/home';
		$blog = $this->model('Blog');
		$this->view('admin/blog/edit', ['blog' => $blog->get($id)]);
	}

	public function store(){
		if($this->restrictCall("post")){
			$blog = $this->model('Blog');
			$id = Post::_get('id');
			$titel = Post::_get('titel');
			$tekst = Post::_get('tekst');
			$sql = "UPDATE `" . $blog->table . "` SET  `titel`='" . $titel . "', `tekst`='" . $tekst . "' WHERE `id`='" . $id . "'";
			$blog->update($sql);
			return Helpers::redirectWithMessage('/harmstercms/admin', 'Blog is geupdate');
		}
	}

	public function all(){
		$this->layout = 'admin/home';
		$blog = $this->model('Blog');
		$blogposts = $blog->getAll("SELECT * FROM " . $blog->table . " ORDER BY `datetime` DESC");
		$this->view('admin/blog/list', ['blogposts' => $blogposts]);
	}
	
	public function delete($id){
		if(isset($id)){
			$blog = $this->model('Blog');
			$blog->delete($id);
			return Helpers::redirectWithMessage('/harmstercms/blog/all', 'Blogpost is verwijderd');
		}
	}

}