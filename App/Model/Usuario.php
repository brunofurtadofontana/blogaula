<?php


/*
	Classe responsável por verificar se os dados digitados na view login.html são compativeis com os dados cadastrados no banco de dados
*/


class Usuario{

	private $id;
	private $email;
	private $senha;
	private $nome;


	/*
		Método responsável por validar os dados email e senha comparando com os quais estão no banco de dados
	*/

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

	/*
		Métodos GET E SETTERS para que possamos manipular as variáveis os dados que são privates
	*/
		
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