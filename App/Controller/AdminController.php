<?php

/*
* Arquivo responsavel por pegar as requisições da view e realizar as chamadas do /model
* Podendo receber argumentos como insert, delete, update
*/

class AdminController{

	public function index(){
		try {
			/*
			* Função que renderiza a view utilizando o framework TWIG podendo passar dados por parametros para a página html
			*/
			$loader = new \Twig\Loader\FilesystemLoader('App/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('admin.html');
			
			$objPostagem = Postagem::seleciona(); //Pega dados de retorno do banco de dados e renderiza na página admin.html
			$parametros = array();
			$parametros['postagens'] = $objPostagem;

			$conteudo = $template->render($parametros);
			echo $conteudo;

		} catch (Exception $e) {

			echo $e->getMessage();
		}
	}
	public function insert(){ //Função que controla o insert no banco de dados 
		try {

			Postagem::insert($_POST);//manda os dados da view para o método insert dentro do /model/postagem
			header("Location:?pagina=admin");//retorna para a página admin

		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function delete($paramId){//função que controla a deleção de um registro passando o Id por parametro
		try {

			Postagem::delete($paramId);//manda os dados para o método delete dentro do /model/postagem
			header("Location:?pagina=admin");

		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function update(){//função que controla a atualização de um registro passando os dados por parametro
		try {

			Postagem::update($_POST);//manda os dados da view para o método insert dentro do /model/postagem
			header("Location:?pagina=admin");

		} catch (Exception $e) {
			
			echo $e->getMessage();
		}
	}
	public function logout(){

		unset($_SESSION['USUARIO']);
		session_destroy();
		header("Location:?pagina=login");
	}
}