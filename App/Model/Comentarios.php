<?php


/*
	Classe responsável por retornar tudo que for relativo a comentario do blog
*/
class Comentario{

	/*
		Método responsável fazer a consulta ao banco de dados e retornar comemtario de acordo com o ID passado por parâmetro
	*/

	public static function selecionaComentario($idPost){

		$con = Connection::getConn();//Classe que realiza a conexão com database

		$sql = "SELECT *FROM comentario WHERE id_post = :id"; //Consulta comentário
		$sql = $con->prepare($sql); //Prepara o SQL
		$sql->bindValue(':id', $idPost, PDO::PARAM_INT); //bindValue elimina chaces de SQL INJECTION
		$sql->execute();//Executa a query

		$res = array();// Array para armazenar os comentários, pode ter mais que um comentário

		while($row = $sql->fetchObject('Comentario')) { //Laço de repetição para popular os dados no array
			
			$res[] = $row;

		}
		return $res;
	}
}