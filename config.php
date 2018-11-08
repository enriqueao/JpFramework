<?php
	date_default_timezone_set('America/Mexico_City');
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');

	define( 'URL' ,"http://localhost/".basename(getcwd())."/");

	define( 'CSS' , URL."static/css/");
	define( 'JS' , URL."static/js/" );
	define( 'IMG', URL."static/images/");
	define( 'LIB', URL."libs/");

	changeJsConfig(false);

	define( 'DB_HOST' , 'localhost');
	define( 'DB_USER' , 'root');
	define( 'DB_PASS' , '');
	define( 'DB_NAME' , 'test');

	define( 'DB_CHARSET' ,'utf8');

	define( 'ALGOR', 'sha512');
	define( 'KEY', 'dWVjbzIxNw==');
	define( 'ID_SESSION', 'ueco217');
?>
