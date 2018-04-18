<?php

namespace App;

use \PDO;

class Database {
	
	protected $PDO;
	private $dsn = 'mysql:host=localhost;dbname=kalendarz';
	private $login = 'root';
	private $pass = '';
	private $pdoOptions = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );
	
	public function __construct()
	{
		$this->PDO = new PDO( $this->dsn, $this->login, $this->pass, $this->pdoOptions );
		$this->PDO->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
	}
	
	public function pdo()
	{
		return $this->PDO;
	}
}