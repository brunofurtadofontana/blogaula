<?php

class Postagem{

	public static function seleciona(){
		
		$con = Connection::getConn();

		$sql = "SELECT *FROM postagem ORDER BY id DESC";
		$sql = $con->prepare($sql);
		$sql->execute();

		$res = array();

		while($row = $sql->fetchObject('Postagem')) {
			
			$res[] = $row;
		}
		if(!$res){
			throw new Exception("Nenhum registro no banco de dados");
		}
		return $res;
	}	
	
	public static function consultaId($idPost){

		$con = Connection::getConn();

		$sql = "SELECT *FROM postagem WHERE id = :id";
		$sql = $con->prepare($sql);
		$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
		$sql->execute();

		$res = $sql->fetchObject('Postagem');

		if(!$res) {
			
			throw new Exception("Nenhum registro no BD");
			
		}else{

			$res->comentarios = Comentario::selecionaComentario($res->id);
		}
		
		return $res;
	}

	public static function insert($dadosPost){

		$con = Connection::getConn();
		$sql = "Insert into postagem(titulo,conteudo)VALUES(:tit, :cont)";
		$sql = $con->prepare($sql);
		$sql->bindValue(':tit', $dadosPost['titulo']);
		$sql->bindValue(':cont', $dadosPost['conteudo']);
		$res = $sql->execute();
		if(!$res){
			throw new Exception("Falha ao inserir a publicação");
			return false;
		}
		return true;
	}
	public static function delete($idPost){

		$con = Connection::getConn();
		$sql = "DELETE FROM postagem WHERE id = :id";
		$sql = $con->prepare($sql);
		$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
		$res = $sql->execute();
		if(!$res){
			throw new Exception("Falha ao deletar a publicação");
			return false;
		}
		return true;

	}
	public static function update($params){
		
		$con = Connection::getConn();
		$sql = "UPDATE postagem SET titulo = :tit, conteudo = :cont WHERE id = :id";
		$sql = $con->prepare($sql);
		$sql->bindValue(':id', $params['id']);
		$sql->bindValue(':tit', $params['titulo']);
		$sql->bindValue(':cont', $params['conteudo']);
		$res = $sql->execute();

		if ($res == false) {
			
			throw new Exception("Falha ao atualizar a publicação");
			return false;
			
		}else{
			return true;
		}
	}

}