<?php

class Usuario{

	private $id;
	private $email;
	private $senha;
	private $nome;

	public function validateLogin(){

		$email = $this->email;
		$senha = $this->senha;

		$con = Connection::getConn();
		$sql = "SELECT *FROM usuario WHERE email = :email";
		$res = $con->prepare($sql);
		$res->bindValue(':email',$email);
		$res->execute();

		if ($res->rowCount()) { //retorna a quantidade de registro
			
			$result = $res->fetch();
			if($result['senha'] == $senha){
				$_SESSION['USUARIO'] = array('id_user' => $result['id'], 'name_user' => $result['nome']);
				return true;
			}

		}
		throw new Exception("Login inválido!");
	}
	public function setEmail($email){
		$this->email = $email;
	}
	public function setSenha($senha){
		$this->senha = $senha;
	}
	public function setNome($nome){
		$this->nome = $nome;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getSenha(){
		return $this->senha;
	}
	public function getNome(){
		return $this->nome;
	}
}