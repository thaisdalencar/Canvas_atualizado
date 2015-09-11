<?php
	class Member{
		private $nome;
		private $lattesLink;
		private $login;
		private $foto;
		private $privilegio;
		private $nivel;
		private $area;
		function __construct($params){
			$this->nome=$params['nome'];
			$this->lattesLink=$params['lattesLink'];
			$this->login=$params['login'];
			$this->foto=$params['foto'];
			$this->privilegio=$params['privilegio'];
			$this->nivel=$params['nivel'];
			$this->area=$params['area'];
		}
		
		function getNome(){
			return $this->nome;
		}
		function setNome($nome){
			$this->nome=$nome;
		}
		function getLattesLink(){
			return $this->lattesLink;
		}
		function setLattesLink($lattesLink){
			$this->lattesLink=$lattesLink;
		}
		function getLogin(){
			return $this->login;
		}
		function setLogin($login){
			$this->login=$login;
		}
		function getFoto(){
			return $this->foto;
		}
		function setFoto($foto){
			$this->foto=$foto;
		}
		function getPrivilegio(){
			return $this->privilegio;
		}
		function setPrivilegio($privilegio){
			$this->privilegio=$privilegio;
		}
		function getNivel(){
			return $this->nivel;
		}
		function setNivel($nivel){
			$this->nivel=$nivel;
		}
		function getArea(){
			return $this->area;
		}
		function setArea($area){
			$this->area=$area;
		}
		
		
	}
?>
