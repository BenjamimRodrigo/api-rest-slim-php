<?php

class Model {

	public $PDO;
	function __construct(){

		 // Conexão com o banco de dados
		$this->PDO = new \PDO('mysql:host=localhost;dbname=db_academia', 'root', '');
		$this->PDO->setAttribute( \PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION );
	}
	
}