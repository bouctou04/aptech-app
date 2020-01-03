<?php
require '../core/Database.class.php';
class Login extends Database {
	private $id;
	private $email;
	private $password1;

	public function __construct($email, $password) {
		if(is_string($email)) {
			$this->email = $email;
		} else {
			print('Error, email must be a string');
		}

		if(is_string($password)) {
			$this->password1 = $password;
		} else {
			print('Error, password must be a string');
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setId($id) {
		if(is_int($id)) {
			$this->id = $id;
		} else {
			print('Error, ID must be integer');
		}
	}

	public function setEmail($email) {
		if(is_string($email)) {
			$this->email = $email;
		} else {
			print('Error, email must be a string');
		}
	}

	public function setPassword1($password) {
		if(is_string($password)) {
			$this->password1 = $password;
		} else {
			print('Error, password must be a string');
		}
	}
}