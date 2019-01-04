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

			$this->setData($results[0]);
		}


	}


	public static function getList(){
		
		$sql = new Sql();
	
		return $sql->select("SELECT * FROM usuarios ORDER BY id;");

	}

	
	public static function search($login){

		$sql = new Sql();

		return $sql->select("SELECT * FROM usuarios WHERE login LIKE :SEARCH ORDER BY login", array(
			':SEARCH'=>"%".$login."%"
		)); 
	}


	public function login($login, $password){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuarios WHERE login = :LOGIN AND senha = :PASSWORD", array (
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));
	
		if (count($results) > 0) {

			$this->setData($results[0]);

			
	} else {

		throw new Exception("Login e/ou senha invalidos.");
		
	}
	}


	public function setData($data){

			$this->setId($data['id']);
			$this->setLogin($data['login']);
			$this->setSenha($data['senha']);
			$this->setEmail($data['email']);
			$this->setNome($data['nome']);
			$this->setBloqueado($data['bloqueado']);
			$this->setDatacadastro(new DateTime($data['data_cadastro']));
			$this->setPerfil($data['perfil']);
			$this->setUsuariocadastro($data['usuario_cadastro']);
			$this->setBatalhao($data['batalhao']);
			$this->setRpm($data['rpm']);
			$this->setMp($data['mp']);

	}


	public function insert(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD, :EMAIL, :NOME, :BLOQUEADO, :PERFIL, :USUARIOCADASTRO, :BATALHAO, :RPM, :MP)", array(

			':LOGIN'=>$this->getLogin(),
			':PASSWORD'=>$this->getSenha(),
			':EMAIL'=>$this->getEmail(),
			':NOME'=>$this->getNome(),
			':BLOQUEADO'=>$this->getBloqueado(),
			':PERFIL'=>$this->getPerfil(),
			':USUARIOCADASTRO'=>$this->getUsuariocadastro(),
			':BATALHAO'=>$this->getBatalhao(),
			':RPM'=>$this->getRpm(),
			':MP'=>$this->getMp()
		));

		if (count($results) > 0) {

			$this->setData($results[0]);
		}
	}


	public function update($login, $password, $bloqueado, $perfil, $batalhao, $rpm, $mp){

		$this->setLogin($login);
		$this->setSenha($password);
		$this->setBloqueado($bloqueado);
		$this->setPerfil($perfil);
		$this->setBatalhao($batalhao);
		$this->setRpm($rpm);
		$this->setMp($mp);

		$sql = new Sql();

		$sql->query("UPDATE usuarios SET login = :LOGIN, senha = :PASSWORD, bloqueado = :BLOQUEADO, perfil = :PERFIL, batalhao = :BATALHAO, rpm = :RPM, mp = :MP WHERE id = :ID", array(

			':LOGIN'=>$this->getLogin(),
			':PASSWORD'=>$this->getSenha(),
			':BLOQUEADO'=>$this->getBloqueado(),
			':PERFIL'=>$this->getPerfil(),
			':BATALHAO'=>$this->getBatalhao(),
			':RPM'=>$this->getRpm(),
			':MP'=>$this->getMp(),
			':ID'=>$this->getId()
		));
	}

	
	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM usuarios WHERE id = :ID", array(
			':ID'=>$this->getId()
		));
	
		$this->setId(0);
		$this->setLogin("");
		$this->setSenha("");
		$this->setEmail("");
		$this->setNome("");
		$this->setBloqueado("");
		$this->setDatacadastro(new DateTime());
		$this->setPerfil("");
		$this->setUsuariocadastro("");
		$this->setBatalhao("");
		$this->setRpm("");
		$this->setMp("");

	}



	public function __construct($login = "", $password = "", $email = "", $nome = "", $bloqueado = "", $perfil = "", $usuario_cadastro = "", $batalhao = "", $rpm = "", $mp = ""){

			$this->setLogin($login);
			$this->setSenha($password);
			$this->setEmail($email);
			$this->setNome($nome);
			$this->setBloqueado($bloqueado);
			$this->setPerfil($perfil);
			$this->setUsuariocadastro($usuario_cadastro);
			$this->setBatalhao($batalhao);
			$this->setRpm($rpm);
			$this->setMp($mp);

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