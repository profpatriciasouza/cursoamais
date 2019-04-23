<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
ob_start();

// Enable Rest for client
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');

if(array_key_exists('HTTP_ACCESS_CONTROL_REQUEST_HEADERS', $_SERVER)) {
    header('Access-Control-Allow-Headers: ' . $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']);
} else {
    header('Access-Control-Allow-Headers: *');
}

if($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    exit(0);
}

// Timezone
setlocale(LC_ALL, 'ptb', 'portuguese-brazil', 'pt-br', 'bra', 'brazil');
date_default_timezone_set('America/Sao_Paulo');

// Enable access directories
define('ACCESS_PATCH', true);

// Return json data
require("Utility/DataReturn.class.php");

$dataReturn = new \Utility\DataReturn();

// Database
try {

	$database = new PDO(
		'mysql:host=db_app_alunos.mysql.dbaas.com.br;dbname=db_app_alunos;charset=utf8',
		'db_app_alunos',
		'amais@2018',
		array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
		)
	);

} catch (PDOException $e) {

	global $dataReturn;

	$dataReturn->json(false, 'Erro ao conectar no banco de dados: ' . $e->getMessage());

}

// Core
require('Slim/Slim.php');

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// Authentications verified
require("Utility/Authentication.class.php");

$authentication = new \Utility\Authentication();

// Routes
require("Routes/authentication.php");
require("Routes/users.php");
require("Routes/chat.php");

// Run system
$app->run();

// Necessary
$database = null;

?>