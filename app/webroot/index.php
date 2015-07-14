<?php
	
define( 'DS', DIRECTORY_SEPARATOR ); /**  Разделитель директорий ( '/', '\' )*/

define('APP_PATH', realpath('../'));/*ПОЛНЫЙ ПУТЬ ДО ПРИЛОЖЕНИЯ*/

define('CORE_PATH', realpath('../../core'));/*ПУТЬ ДО ЯДРА*/

include_once APP_PATH.DS.'config'.DS.'bootstrap.php';


