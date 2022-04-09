<?php

class LoginController{

	public function index(){

		try {

			$loader = new \Twig\Loader\FilesystemLoader('App/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('login.html');

			$conteudo = $template->render();

			echo $conteudo;
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function check(){
		try {

			$user = new Usuario;
			$user->setEmail($_POST['email']);
			$user->setSenha($_POST['senha']);
			$user->validateLogin();
			header('Location: ?pagina=admin');
			
		} catch (Exception $e) {

			header('Location: ?pagina=login');
			echo $e->getMessage();

		}
	}

}