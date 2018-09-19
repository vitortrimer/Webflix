<?php 
ob_start();
session_start();

define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','webflix');

$db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


function __autoload($class) {
   
   $class = strtolower($class);

   $classpath = 'class/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
    }     

   $classpath = '../class/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
    }

    $classpath = '../../class/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	} 		
        
     
}


$admin = new Admin($db); 
$user = new Usuario($db); 

 ?>

