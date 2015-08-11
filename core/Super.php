<?php
class Super {
	public $core;
	public $helpers;
	public $app;
	public $acl;

	/**
	 * @return mixed
	 */
	public function getAcl()
	{
		return $this->acl;
	}

	/**
	 * @param mixed $acl
	 */
	public function setAcl($acl)
	{
		$this->acl = $acl;
	}

	/**
	 * @return mixed
	 */
	public function getApp()
	{
		return $this->app;
	}

	/**
	 * @param mixed $app
	 */
	public function setApp($app)
	{
		$this->app = $app;
	}

	/**
	 * @return mixed
	 */
	public function getCore()
	{
		return $this->core;
	}

	/**
	 * @param mixed $core
	 */
	public function setCore($core)
	{
		$this->core = $core;
	}

	/**
	 * @return mixed
	 */
	public function getHelpers()
	{
		return $this->helpers;
	}

	/**
	 * @param mixed $helpers
	 */
	public function setHelpers($helpers)
	{
		$this->helpers = $helpers;
	}
	
	
	
}