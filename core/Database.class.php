<?php
class Database {

	// Create private attribute

	private $sgbd;
	private $host;
	private $dbName;
	private $username;
	private $password;
	private $pdo;

	// Create a constructor function

	/**
	* [string] host (ex : localhost)
	* [string] database name (ex : mydb)
	* [string] username (ex : bouctou04)
	* [string] password (ex : 12345)
	* [string] manager database system (Default = mysql)
	**/

	public function __construct($host, $dbName, $username, $password, $sgbd = 'mysql') {

		if(is_string($host)) {
			$this->host = $host;
		} else {
			print('Error, host must be a string');
		}

		if(is_string($dbName)) {
			$this->dbName = $dbName;
		} else {
			print('Error, database name must be a string');
		}

		if(is_string($username)) {
			$this->username = $username;
		} else {
			print('Error, username must be a string');
		}

		if(is_string($password)) {
			$this->password = $password;
		} else {
			print('Error, password must be a string');
		}

		if(is_string($sgbd)) {
			$this->sgbd = $sgbd;
		} else {
			print('Error, manager database system must be a string');
		}

	}

	// Setter && Getter

	public function setSgbd($sgbd) {

		if(is_string($sgbd)) {
			$this->sgbd = $sgbd;
		} else {
			print('Error, manager database system must be a string');
		}

	}

	public function setHost($host) {

		if(is_string($host)) {
			$this->host = $host;
		} else {
			print('Error, host must be a string');
		}

	}

	public function setDbName($dbName) {

		if(is_string($dbName)) {
			$this->dbName = $dbName;
		} else {
			print('Error, database name must be a string');
		}

	}

	public function setUsername($username) {

		if(is_string($username)) {
			$this->username = $username;
		} else {
			print('Error, username must be a string');
		}

	}

	public function setPassword($password) {

		if(is_string($password)) {
			$this->password = $password;
		} else {
			print('Error, password must be a string');
		}

	}

	public function getSgbd() {
		return $this->sgbd;
	}

	public function getHost() {
		return $this->host;
	}

	public function getDbName() {
		return $this->dbName;
	}

	public function getUsername() {
		return $this->username;
	}

	public function getPassword() {
		return $this->password;
	}

	// Create protected pdo

	public function getPdo() {
		$this->pdo = new PDO($this->sgbd.':host='. $this->host .';dbname='. $this->dbName, $this->username , $this->password);
		return $this->pdo;
	}

}