<?php

/*
 Набор функции
 */

/*
 * Для преобразования имён (Перевод имени класса в имя файла)
 */
function className2fileName( $className ) {
		$fromSimple = array(
				'_A', '_B', '_C', '_D', '_E', '_F', '_G', '_H', '_I', '_J', '_K', '_L', '_M',
				'_N', '_O', '_P', '_Q', '_R', '_S', '_T', '_U', '_V', '_W', '_X', '_Y', '_Z' ) ;
		$fromCompound = array(
				'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
				'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
				'1', '2', '3', '4', '5', '6', '7', '8', '9', '0' ) ;
		$toSimple = array(
				DS . 'a', DS . 'b', DS . 'c', DS . 'd', DS . 'e', DS . 'f', DS . 'g', DS . 'h', DS . 'i', DS . 'j', DS . 'k', DS . 'l', DS . 'm',
				DS . 'n', DS . 'o', DS . 'p', DS . 'q', DS . 'r', DS . 's', DS . 't', DS . 'u', DS . 'v', DS . 'w', DS . 'x', DS . 'y', DS . 'z' ) ;
		$toCompound = array(
				'_a', '_b', '_c', '_d', '_e', '_f', '_g', '_h', '_i', '_j', '_k', '_l', '_m',
				'_n', '_o', '_p', '_q', '_r', '_s', '_t', '_u', '_v', '_w', '_x', '_y', '_z',
				'_1', '_2', '_3', '_4', '_5', '_6', '_7', '_8', '_9', '_0' ) ;
		$from = array_merge( $fromSimple, $fromCompound ) ;
		$to = array_merge( $toSimple, $toCompound ) ;
		$fileName = ltrim( str_replace( $from, $to, $className ), '_' ) ;		
		return $fileName ;

                }
  /**
   * 
   * Front Controller
   */
function dispatch ($route)
{
 if(empty ($route))   
     exit ('acce');//erro page 404 выводить если нет такой страницы
 
 $controllerClass = 'Controller_'.$route['controller'];//формируем имя контролер
$controllerFile = //realpath(
                        APP_PATH.DS.'classes'.DS.
                        str_replace('.',' ', className2fileName($controllerClass)).'.php'
                            //)
                            ; 
/*
$refl = new ReflectionMethod($controllerClass,$route['action']);

$reqParamsNo= $refl->getNumberOfRequiredParameters();
if (count($route['params'])<$reqParamsNo)
    {
    exit('Wroms params umbors');
    }*/
$refl = new ReflectionClass($controllerClass);

if ($refl->hasMethod($route['action']) )
    
    {
        $controller = $refl->newInstance();
        $action = $refl->getMethod($route['action']);
        if ($action->getNumberOfRequiredParameters()>count ($route['params']))
            exit ('Wrong page');
        else {
            $action->invokeArgs($controller, $route['params']);
        }
      
    }
 else {
        exit('Wrong page');
       }

 
}
function errorReporting ()
{
    $conf =Config::instance();
   
    if ($conf->get('dev_mode')==1)
    {
        ini_set('display_errors', 'On');
        ini_set('log_errors', 'Off');
    }  
    else {
        ini_set('display_errors', 'Off');
        ini_set('error_log', APP_PATH.DS.'temp'.DS.'logs'.DS.'errors'.  
                        date('Y_m_d').'.log');
        ini_set('log_errors', 'On');
    }
}