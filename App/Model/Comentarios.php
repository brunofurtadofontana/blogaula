<?php

class Comentario{

	public static function selecionaComentario($idPost){

		$con = Connection::getConn();

		$sql = "SELECT *FROM comentario WHERE id_post = :id";
		$sql = $con->prepare($sql);
		$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
		$sql->execute();

		$res = array();

		while($row = $sql->fetchObject('Comentario')) {
			
			$res[] = $row;

		}
		return $res;
	}
}