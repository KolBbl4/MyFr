<?php
class Controller_Test {
    
     public function main ()
     {
         $cache = Cache::instance();
         $cache->set ('test',array ('helo','boy', array (1,2,3,'hellowMy')));
         echo 'testing controller';
         
     }
}
?>
