<?php
/**
 * Подключения файла с функциями
 */

include_once CORE_PATH.DS.'functions.php';
//errorReporting ();
/*
 * Добовляются пути к include_path
 */
$includePath= array (
    APP_PATH.DS.'classes',
    CORE_PATH.DS.'classes',
    get_include_path()
);
$includePath = implode(PATH_SEPARATOR, $includePath);
set_include_path($includePath);
/**
 * 
 * автолод для подключения классов
 */
function __autoload ($class){
  $file = className2fileName ($class).'.php';
  include_once $file;
    
}

include_once APP_PATH.DS.'config'.DS.'app_config.php'; // фаил конфигурации приложения
$config = Config::instance();

include_once APP_PATH.DS.'config'.DS.'routes.php';



$router=  Route::instance(); //подключаем роут
$route = $router->getRoute( $_SERVER[ 'REQUEST_URI' ] ) ; //текущий роут

errorReporting ();//вывод ошибок



dispatch($route);//фронт контроллер