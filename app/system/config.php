<?php

#########################################################
#	INI: Definicion de rutas, directorios y archivos	#
#########################################################

### Ruta actual completa ###
define("CURRENT_URL", $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);

### Ruta actual sin el el nombre del fichero ###
define("CURRENT_URLDIR", dirname(CURRENT_URL));

### Pagina actual ###
define("CURRENT_PAGE", explode('.', basename(CURRENT_URL))[0]);

define("CURRENT_PATH", $_SERVER['DOCUMENT_ROOT']);

define("ENVIROMENT", "development");

### Ruta donde se almacenan las sessiones ###
define("SESSION_PATH", CURRENT_PATH.'/tmp/sessions');

switch (ENVIROMENT) {
	
	case 'development':
		
		//Path absoluto
		define("ABSOLUTE_URL", "http://localhost");
		//define("DOMAIN", "");
		
		break;
}


#########################################################
#	FIN: Definicion de rutas, directorios y archivos	#
#########################################################
?>
