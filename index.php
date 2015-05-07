<?php

define('ROOT', '');//A remplacer par $_SERVER['SCRIPT_NAME'] en cas de problème
define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

$action = 'main';
$controller = 'Index';

/* Récupération des paramètres de l'URL */
if(isset($_GET['p']) && !empty($_GET['p'])){
	$param = explode('/', $_GET['p']); 
	if (count($param)>1) {		
		$action = $param[1];
		$controller = $param[0];		
	}
}


require_once(ROOT.'core/model.php');
require_once(ROOT.'core/controller.php');
require_once(ROOT.'core/helper.php');
require_once(ROOT.'controllers/'.$controller.'.php');

$instance = new $controller();
if(method_exists($controller, $action))
	$instance->$action();
else
	require_once(ROOT.'404.html');


?>