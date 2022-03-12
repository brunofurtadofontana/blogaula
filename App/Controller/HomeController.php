<?php

class HomeController{

	public function index(){
		try {

			$postagens = Postagem::seleciona();
		
			$loader = new \Twig\Loader\FilesystemLoader('App/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('home.html');

			
			$parametros = array();
			$parametros['postagem'] = $postagens;

			$conteudo = $template->render($parametros);
			echo $conteudo;

		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}