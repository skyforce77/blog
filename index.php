<?php

define('ROOT', '');//A remplacer par $_SERVER['SCRIPT_NAME'] en cas de problème
define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

/*Inclure les fichier "model.php" et "contoller.php" avec require se trouvant dans "core/*/
require(ROOT.'core/config.php');
require_once(ROOT.'core/controller.php');

/* Récupération des paramètres de l'URL */
if(isset($_GET['p']) && !empty($_GET['p'])){
	$param = explode('/', $_GET['p']); 
	if (count($param)>1) {		
		$action = $param[1];
		$contoller = $param[0];
		
	}
}
else{
	$action = 'index';
	$contoller = 'index';
}

require_once('controllers/'.$contoller.'.php');
$contoller = new $contoller();
if(method_exists($contoller, $action))
	$contoller->$action();
/*
else
	require_once('404.html');
*/

?>