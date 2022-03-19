<?php

class AdminController{

	public function index(){
		try {

			$loader = new \Twig\Loader\FilesystemLoader('App/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('admin.html');
			
			$objPostagem = Postagem::seleciona();
			$parametros = array();
			$parametros['postagens'] = $objPostagem;

			$conteudo = $template->render($parametros);
			echo $conteudo;

		} catch (Exception $e) {

			echo $e->getMessage();
		}
	}
	public function insert(){
		try {

			Postagem::insert($_POST);
			header("Location:?pagina=admin");

		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function delete($paramId){
		try {

			Postagem::delete($paramId);
			header("Location:?pagina=admin");

		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}