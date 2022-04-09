<?php

session_start();//add

require_once('App/Core/Core.php');
require_once('lib/Connection.php');
require_once('App/Controller/HomeController.php');
require_once('App/Controller/PostController.php');
require_once('App/Controller/ErroController.php');
require_once('App/Controller/AdminController.php');
require_once('App/Controller/LoginController.php');//add
require_once('App/Model/Postagem.php');
require_once('App/Model/Comentarios.php');
require_once('App/Model/Usuario.php');//add

require_once('vendor/autoload.php');

$template = file_get_contents('App/Template/estrutura.html');

ob_start();

	$core = new Core;
	$core->Start($_GET);
	$saida = ob_get_contents();

ob_end_clean();

$tpl_pronto = str_replace('{{conteudo_dinamico}}',$saida, $template);

echo $tpl_pronto;