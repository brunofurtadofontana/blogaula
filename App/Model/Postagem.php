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

}