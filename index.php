<?php

/**********************************************************************************
 * 
 * 
╔═══╗────╔╗─────────╔═╗╔═╗
║╔═╗║────║║─────────║║╚╝║║
║╚═╝╠══╦═╝╠═╦╦══╦══╗║╔╗╔╗╠══╦═╗╔══╦═╦══╗
║╔╗╔╣╔╗║╔╗║╔╬╣╔╗║╔╗║║║║║║║╔╗║╔╗╣╔╗║╔╣╔╗║
║║║╚╣╚╝║╚╝║║║║╚╝║╚╝║║║║║║║╔╗║║║║╔╗║║║╔╗║
╚╝╚═╩══╩══╩╝╚╩═╗╠══╝╚╝╚╝╚╩╝╚╩╝╚╩╝╚╩╝╚╝╚╝
─────────────╔═╝║
─────────────╚══╝

──────────────────────╔╗────────────────────────────────────╔╗
──────────────────────║║────────────────────────────────────║║
╔╗╔╗╔╦╗╔╗╔╦╗╔╗╔╦═╦══╦═╝╠═╦╦══╦══╦╗╔╦══╦═╗╔══╦═╦══╗╔══╦══╗╔╗╔╣║╔╗
║╚╝╚╝║╚╝╚╝║╚╝╚╝║╔╣╔╗║╔╗║╔╬╣╔╗║╔╗║╚╝║╔╗║╔╗╣╔╗║╔╣╔╗║║╔═╣╔╗║║║║║╚╝╝
╚╗╔╗╔╩╗╔╗╔╩╗╔╗╔╣║║╚╝║╚╝║║║║╚╝║╚╝║║║║╔╗║║║║╔╗║║║╔╗╠╣╚═╣╚╝╠╣╚╝║╔╗╗
─╚╝╚╝─╚╝╚╝─╚╝╚╩╩╝╚══╩══╩╝╚╩═╗╠══╩╩╩╩╝╚╩╝╚╩╝╚╩╝╚╝╚╩╩══╩══╩╩══╩╝╚╝
──────────────────────────╔═╝║
──────────────────────────╚══╝

 * Sistema Desenvolvido por Rodrigo Manara
 * Muita luta e dedicacao para conseguir chegar ate este nivel de programao.
 * Tenho muito que aprender mas mesmo assim creio que sempre estaremos aprendendo algo novo
 * 
 * Dedico este programa a minha familia.
 * 
 * 
 */

ob_start();
 
/*********************************************************
 * 
 * 
 * 
 * setting up de header 
 */

header("content-type:text/html");
header("X-Content-Type-Options: nosniff");
header('Access-Control-Allow-Origin:' . $_SERVER['HTTP_HOST']);
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods:GET,POST'); 
header('Access-Control-Max-Age: 86400');

/*************************************************
 * 
 * 
 * Database configuration
 * 
 * 
 * 
 * 
 */
$ini_array = parse_ini_file("config.ini" , true);


if($_SERVER['HTTP_HOST'] === 'localhost'){
    $var = 'local_';
    $nome_local = '/consultorio/';
}else{
    $var = 'remote_'; 
    $nome_local = '/';
}
$path = __DIR__ . "/";

$hostname = $ini_array[$var.'db']['db_host'];
$username = $ini_array[$var.'db']['db_user'];
$password = $ini_array[$var.'db']['db_pass'];
$database = $ini_array[$var.'db']['db_name'];

define("localhost", $hostname);
define("user", $username);
define("pass", $password);
define("db_name", $database);
 

/********************************************
 * 
 * 
 * Configuration for define
 * 
 * 
 */


 
 

session_start(); 
define('PUBLIC_KEY_CAPTCHA', '6LeXR-USAAAAADcOZqqxXV8s3GRS3AX_Um8LoFs_');
define('PRIVATE_KEY_CAPTCHA', '6LeXR-USAAAAAJ7NQjpy873xMn8EhfyOo1lao5pj');
define("__system", "{$nome_local}");  
define("__root", $path);
define("__view",__root ."/view/default/");
define("__controller",__root ."/");
define("__model",__root ."/");
define("__image__template",__root ."/images/template/");
define("__cache" , __root . "/cache/" );
define("__portal", __root . "/portal/");


/*************************************************
 * 
 * 
 * 
 * Start the program and load start class
 * 
 */


include_once __root.'application/start.php';
include_once __root.'configuracao.php';


/* set errors to be viewed */

if(!isset($_SESSION['compania'])){
    setcookie("compania", 0 , time() + 60 * 60  * 24, "/",$_SERVER['HTTP_HOST']."/rh");
}            
unset($_SESSION['id']);

ini_set('display_errors', 1);
new start();

?> 