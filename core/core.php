<?php
include('Autoload.php');
class Core{
	
	private $database;
	private $config;

	/**
	 * @return mixed
	 */
	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * @param mixed $config
	 */
	public function setConfig($config)
	{
		$this->config = $config;
	}

	/**
	 * @return mixed
	 */
	public function getDatabase()
	{
		return $this->database;
	}

	/**
	 * @param mixed $database
	 */
	public function setDatabase($database)
	{
		$this->database = $database;
	}	
}