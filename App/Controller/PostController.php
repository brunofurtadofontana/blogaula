<?php

class PostController{

	public function index($params){
		try {

			$postagens = Postagem::consultaId($params);
		
			$loader = new \Twig\Loader\FilesystemLoader('App/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('single.html');

			
			$parametros = array();
			$parametros['id'] = $postagens->id;
			$parametros['titulo'] = $postagens->titulo;
			$parametros['conteudo'] = $postagens->conteudo;
			$parametros['comentarios'] = $postagens->comentarios;

			$conteudo = $template->render($parametros);
			echo $conteudo;

		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}