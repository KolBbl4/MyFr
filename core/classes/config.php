<?php
class Config {
    private static $_instance;
   
    /**
     *
     * Массив с настройкоми класса
     */
    private $_configs = array ();
    
    private function __construct() { }
    private function __clone() { }
    
    /**
     * 
     * Синглтон. Инициализирующий метод.
     */
 public static function instance ()
 {
     if (empty(self::$_instance))
         self::$_instance = new self ();
        return self::$_instance;
 }
    /**
     * Установка настроек
     * @param type $name - имя настройки
     * @param type $value - значение настроек
     */
 public function  set ($name, $value) {
     
     $this->_configs[$name] = $value;
 }
   /**
    * Получение настроек
    * @param type $name - имя настройки которая необходима
    * 
    */
 public function  get ($name){
     return $this->_configs[$name];
 }
}