<?php
class Database {
	protected $username;
	protected $host;
	protected $password;
	protected $pdo;
	protected $db_name;
	protected $engine;

	public function __construct($host='127.0.0.1', $db_name='gestion_universitaire_2;charset=utf8', $username='root', $password='', $engine = 'mysql') {
		$this->host = $host;
		$this->db_name = $db_name;
		$this->username = $username;
		$this->password = $password;
		$this->engine = $engine;
	}

	public function get_pdo() {
		$this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, $this->username, $this->password);
		return $this->pdo;
	}

}