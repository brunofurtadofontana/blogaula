<?php
	
// Classe responsável por pegar a $URL e parametrizar

class Core{

	private $usuario;

	public function __construct(){

		if (isset($_SESSION['USUARIO'])) {

			$this->usuario = $_SESSION['USUARIO'];

		}else{

			$this->usuario = null;
		}
	}
	public function Start($urlGet){

		if(isset($urlGet['metodo'])){
			$acao = $urlGet['metodo'];
		}else{
			$acao = 'index';
		}

		if (isset($urlGet['pagina'])) {
			$controller = ucfirst($urlGet['pagina'].'Controller');
		}else{
			$controller = 'HomeController';
		}

		if($this->usuario){
			$pg_permission = ['AdminController'];

			if(!isset($controller) || in_array($controller,$pg_permission)){

				$controller = 'AdminController';
				$metodo = 'index';
			}
		}else{

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