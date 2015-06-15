<?php
session_start();
define('ROOT', '');
define('WEBROOT', str_replace('index.php', '', $_SERVER['PHP_SELF']));

$action = 'view';
$controller = 'Index';
$get = null;

/* Récupération des paramètres de l'URL */
if(isset($_GET['p']) && !empty($_GET['p'])){
	$param = explode('/', $_GET['p']); 
	if (count($param)>1) {		
		$action = $param[1];
		$controller = $param[0];
		if(isset($param[2]) && !empty($param[2])){
			$get = $param[2];
		}		
	}
}

if(!file_exists(ROOT.'core/config.php') || !file_exists(ROOT.'.htaccess')){
	$controller = 'Index';
	$action = 'config';
}else{	
	require_once(ROOT.'core/model.php');
}

require_once(ROOT.'core/controller.php');
require_once(ROOT.'core/helper.php');


if(file_exists(ROOT.'controllers/'.$controller.'.php')){
	require_once(ROOT.'controllers/'.$controller.'.php');
	$instance = new $controller();
}

function __autoload($class) {
	if(file_exists(ROOT.'models/'.$class.'.php'))
    	include ROOT.'models/'.$class.'.php';
}

controller::check_session();

if(method_exists($controller, $action)){
	if($get == null)
		$instance->$action();
	else
		$instance->$action($get);
}else{
	require('views/errors/404.html');
}
?>
