<?php
    class Cache {
         private static $_instance;
        private function __clone() {}
        private function __construct() {}
        
         public static function instance ()
 {
     if (empty(self::$_instance))
         self::$_instance = new self ();
        return self::$_instance;
 }
 /**
  * Перенос данных в кеш
  * @param type $id идентификатор кеша
  * @param type $data даные
  * @param type $lifetime кол-во секунд жизни кеша
  */
 public function set ($id,$data, $lifetime =3600)
 {
     $cacheDir= APP_PATH.DS.'temp'.DS.'cache';//путь до папки с кешем
     $cacheFile =$cacheDir.DS.rawurlencode($id).'.cahe'; //файил с кешем
     file_put_contents($cacheFile, serialize($data));//запись инфо в файл
     touch($cacheFile,(time()+intval($lifetime))); // время жизни кеша
 }
 
}