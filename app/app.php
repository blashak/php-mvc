<?php

date_default_timezone_set("Europe/Paris");

#################################
#	Cargamos la configuración	#
#################################

include 'system/config.php';

##############################
### auto carga de clases	##
##############################

function autoloadSystem($className) {
	$fileName = CURRENT_PATH.'/app/system/'. $className .'.php';
	if(is_readable($fileName))
	{
		require $fileName;
	}
}

function autoloadSystemDb($className) {
	$fileName = CURRENT_PATH.'/app/system/db/'. $className .'.php';
	if(is_readable($fileName))
	{
		require $fileName;
	}
}

function autoloadModel($className) {	
	$fileName = CURRENT_PATH.'/app/models/'. $className .'.php';
	if(is_readable($fileName))
	{
		require $fileName;
	}
}

function autoloadController($className) {
	$fileName = CURRENT_PATH.'/app/controllers/'. $className .'.php';
	if(is_readable($fileName))
	{
		require $fileName;
	}
}


function autoloadEntities($className) {
	$fileName = CURRENT_PATH.'/app/entities/'. $className .'.php';
	if(is_readable($fileName))
	{
		require $fileName;
	}
}




spl_autoload_register('autoloadSystem');
spl_autoload_register('autoloadSystemDb');
spl_autoload_register('autoloadModel');
spl_autoload_register('autoloadController');
spl_autoload_register('autoloadEntities');


$router = new Router();

?>