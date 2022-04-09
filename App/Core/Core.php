<?php
	
// Classe responsável por pegar a $URL e parametrizar

class Core{

	private $usuario;

	public function __construct(){ // método mágico que sempre vai carregar junto com a class Core

		if (isset($_SESSION['USUARIO'])) {//Verifica se existe a SESSÃO

			$this->usuario = $_SESSION['USUARIO']; //Caso exista armazena na variavel private $usuario

		}else{//Caso não exista a variavel private $usuario recebe null

			$this->usuario = null;
		}
	}

	/*
		Método responsável Checar o que tem na URL e criar as rotas para acesso as páginas
	*/

	public function Start($urlGet){

		if(isset($urlGet['metodo'])){//Verifica que foi setado algum método via URL

			$acao = $urlGet['metodo'];//armazena qual o metodo passado na url via GET

		}else{//Caso não exista a URL GET metodo, força para o metodo index

			$acao = 'index';
		}

		if (isset($urlGet['pagina'])) {//Verifica que foi setado alguma página via URL

			$controller = ucfirst($urlGet['pagina'].'Controller');//Pega o nome da página e concatena com a palavra Controller ex. ?pagina=login vira 'LoginController'
 
		}else{//Caso não exista a página, será forçado para ir ao homeController

			$controller = 'HomeController';
		}

		if($this->usuario){//Verifica se existe um usuario logado na SESSION

			$pg_permission = ['AdminController'];//Página que será liberada apos login

			if(!isset($controller) || in_array($controller,$pg_permission)){//Caso não exista um controllador, força para o AdminController

				$controller = 'AdminController';
				$metodo = 'index';
			}

		}else{//Caso não tenha usuario logado na SESSION é feito o bloqueio das páginas

			$pg_permission = ['LoginController','HomeController','AdminController'];

			if(!isset($controller) || in_array($controller,$pg_permission)){
				
				$controller = 'LoginController';
				$metodo = 'index';
			}
		}

		if (!class_exists($controller)) {
			$controller = 'ErroController';
		}

		if (isset($urlGet['id']) && $urlGet['id'] != null) {
			$id = $urlGet['id'];

		}else{
			$id = null;
		}

		
		call_user_func_array(array(new $controller, $acao), array($id));

	}

}