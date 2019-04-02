<?php

class Model {
	public $PDO;
	function __construct(){
		 // Conexão com o banco de dados
		$this->PDO = new \PDO('mysql:host=localhost;dbname=db_academia', 'root', '', array('charset'=>'utf8'));
		$this->PDO->query("SET CHARACTER SET utf8");
		$this->PDO->setAttribute( \PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION );
	}
}