<?php
class Route {
    private static $_instance;
    
    /**
     *
     * Контроллер
     */
    private $_controller='';
    /*
     * Экшен
     */
    private $_action = '';
    /*
     * Параметры
     */
    private $_params = array ();




    private  function __construct() {}
    private function __clone() { }
 
    private $_routes = array ();



 public static function instance () {
        if (empty (self::$_instance))  
            self::$_instance=new self ();
        
        return self::$_instance;
        
    }
    /**
     * "Соеденяет" паттерн урла с роутером
     *  $urlPattern = паттерн урла
     *  $route =массив с параметрам урала
     * 
     */
    public function connect ($urlPattern,$route)
    {
        $this->_routes[$urlPattern] = $route;
    }
    /**
     * Получаем роутер по теукещему uri
     * $uri текущий uri
     */
    public function getRoute ($uri)
    {
        $routes = $this->_routes;
        $route = NULL;
        $baseUri = trim(Config::instance()->get('base_uri'), '/');
       
      
        $uri = trim($uri,'/');
  
        
         foreach ($routes  as $rUri => $rRoute)
        { 
            
            $pattern ='`^'.$rUri.'$`i';
            
            
            if (preg_match($pattern, $uri))
            {
                $route = preg_replace($pattern, $rRoute, $uri);
                break;
                
            }
               
        }
    
          if (!isset($route))
          {
              return FALSE;  
          }
           else 
              $route = explode ('/', $route);
              $this->_controller=ucfirst(array_shift($route));
               $this->_action= ucfirst (array_shift($route));
               $this->_params=$route;
               return array('controller'=>  $this->_controller,
                            'action'=>  $this->_action,
                             'params'=>  $this->_params
                            );
         
     
    }
    
    /*
     * Возвращает текущий контроллер
     */
    public function controller ()
    {
        return $this->_controller;
    }
    
    /*
     * Возвращает текущий экшен
     */
     public function action ()
    {
        return $this->_action;
    }
    
    /*
     * Возвращает текущие параметры
     */
     public function params ()
    {
        return $this->_params;
    }
}
