<?php

class Usuario {

	private $id;
	private $login;
	private $senha;
	private $email;
	private $nome;
	private $bloqueado;
	private $data_cadastro;
	private $perfil;
	private $usuario_cadastro;
	private $batalhao;
	private $rpm;
	private $mp;

	public function getId(){
		return $this->id;
	}

	public function setId($value){
		$this->id = $value;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setLogin($value){
		$this->login = $value;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($value){
		$this->senha = $value;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($value){
		$this->email = $value;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($value){
		$this->nome = $value;
	}

	public function getBloqueado(){
		return $this->bloqueado;
	}

	public function setBloqueado($value){
		$this->bloqueado = $value;
	}

	public function getDatacadastro(){
		return $this->data_cadastro;
	}

	public function setDatacadastro($value){
		$this->data_cadastro = $value;
	}

	public function getPerfil(){
		return $this->perfil;
	}

	public function setPerfil($value){
		$this->perfil = $value;
	}

	public function getUsuariocadastro(){
		return $this->usuario_cadastro;
	}

	public function setUsuariocadastro($value){
		$this->usuario_cadastro = $value;
	}

	public function getBatalhao(){
		return $this->batalhao;
	}

	public function setBatalhao($value){
		$this->batalhao = $value;
	}

	public function getRpm(){
		return $this->rpm;
	}

	public function setRpm($value){
		$this->rpm = $value;
	}

	public function getMp(){
		return $this->mp;
	}

	public function setMp($value){
		$this->mp = $value;
	}

	public function loadById($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuarios WHERE id = :ID", array (
			":ID"=>$id
		));
	
		if (count($results) > 0) {

			$row = $results[0];

			$this->setId($row['id']);
			$this->setLogin($row['login']);
			$this->setSenha($row['senha']);
			$this->setEmail($row['email']);
			$this->setNome($row['nome']);
			$this->setBloqueado($row['bloqueado']);
			$this->setDatacadastro(new DateTime($row['data_cadastro']));
			$this->setPerfil($row['perfil']);
			$this->setUsuariocadastro($row['usuario_cadastro']);
			$this->setBatalhao($row['batalhao']);
			$this->setRpm($row['rpm']);
			$this->setMp($row['mp']);
		}


	}

	public function __toString(){

		return json_encode(array(
			"id"=>$this->getId(),
			"login"=>$this->getLogin(),
			"senha"=>$this->getSenha(),
			"email"=>$this->getEmail(),
			"nome"=>$this->getNome(),
			"bloqueado"=>$this->getBloqueado(),
			"data_cadastro"=>$this->getDatacadastro()->format("d/m/Y H:i:s"),
			"perfil"=>$this->getPerfil(),
			"usuario_cadastro"=>$this->getUsuariocadastro(),
			"batalhao"=>$this->getBatalhao(),
			"rpm"=>$this->getRpm(),
			"mp"=>$this->getMp(),
		));
	}

}



?>