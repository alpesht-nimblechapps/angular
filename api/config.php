<?php

/**
 * Database configuration
 */
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'angular');
} else {
    define('DB_USERNAME', 'alpesh');
    define('DB_PASSWORD', ',v;J@%x[%Z]6');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'angular');
}

define('DOMAIN_URL','http://'.$_SERVER['HTTP_HOST'].'/angular/');
define('ROOT_DIR',$_SERVER['DOCUMENT_ROOT'].'/angular/');
define('DIR_UPD',ROOT_DIR.'upload/');
define('UPD_URL',DOMAIN_URL.'upload/');


?>
