<?php
	date_default_timezone_set('America/Mexico_City');
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');

	define( 'URL' ,"http://localhost/".basename(getcwd())."/");

	define( 'CSS' , URL."static/css/");
	define( 'JS' , URL."static/js/" );
	define( 'IMG', URL."static/images/");
	define( 'LIB', URL."libs/");

	//Crean el archivo de config.js
	changeJsConfig(false);

	//Constantes de la base de datos
	define( 'DB_HOST' , '148.220.52.120');
	define( 'DB_USER' , 'prueba_jp');
	define( 'DB_PASS' , base64_decode('cHJ1ZWJhX2pw'));
	define( 'DB_NAME' , 'cd_unesco');

	// define( 'DB_HOST' , 'localhost');
	// define( 'DB_USER' , 'root');
	// define( 'DB_PASS' , '');
	// define( 'DB_NAME' , 'cd_unesco');

	define( 'DB_CHARSET' ,'utf8');

	define( 'ALGOR', 'sha512');
	define( 'KEY', 'dWVjbzIxNw==');
	define( 'ID_SESSION', 'ueco217');
?>
