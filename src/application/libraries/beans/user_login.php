<?php
	class User_login{
		private $email;
		private $senha;
		function __construct($params){
			$this->email=$params['email'];
			$this->senha=$params['senha'];
		}
		function getEmail(){
			return $this->email;
		}
		function setEmail($email){
			$this->email=$email;
		}
		function getSenha(){
			return $this->senha;
		}
		function setSenha($senha){
			$this->senha=$senha;
		}
	}
?>
