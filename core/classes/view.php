<?php
/**
 * Объект класса вид
 */
class View {
    
    /**
     *
     * Конфигурация
     */
    private $_conf;
    
    /**
     * 
     * Имя layout-а
     * @param type $_layout
     * 
     */
    private $_layout='';
     /**
     * 
     *  Имя вида
     *  $_view
     * 
     */
    private $_view='';
    /**
     * 
     * Хранение переменных вида
     * 
     */
    private $_views = array();
    
    /**
     * Если истина то выводится, лож - не выводится
     * @var bool
     */
    private $_render;

    /*
     * Конструктор 
     * вид view
     * 
     */

    public function __construct($layout = '',$view = '') {
        $this->_conf =  Config::instance();
        
        if (!empty($layout))
        {
            $this->_layout = $layout;
        }
        else
        {
            $this->_layout = $this->_conf->get('default_layout');
        }
        if (!empty($view))
        {
            $this->_view=$view;
        }else 
         {
            $router = Route::instance();
            $this->_view = className2fileName($router->controller()).DS
                           .$router->action()  ;      
         } 
        
                
    }
    
    /**
     * 
     * Назначает переменные вида благодаря функции __set
     * 
     */
 public function set ($var,$value='')
 {
     if (is_array($var)) //array ('var1'=>'value1', 'var2'=>'value2')
     {
         $keys = array_keys($var);//array ('var1', 'var2')
         $values = array_values($var); //array ('value1', 'value2')
         
         $this->_views = array_merge($this->_views ,
                                                array_combine($keys, $values)) ; 
     }  else {
         $this->_views[$var] = $value;
     }
     
    
 }
 /**
  * Callback метод для назначения вида
  * 
  */
 public function __set($key, $value) {
     $this->_views[$key]=$value;
 }
 
 /**
  * функция работы с браузером, сжатия данных и вывода вида
  * 
  * принимает параметр и если false то вид не выводится
  */
 
 public  function render ($render=true)
 {
     if ($render==FALSE)
     {
         $this->_render =false;
     }
     if ($this->_render===FALSE)
     return FALSE;
     
     $ext = $this->_conf->get('view_ext');
     $this->_layout = APP_PATH.DS.'view'.DS.'_layout'.DS.
                    $this->_layout.$ext;

     $this->_view = APP_PATH.DS.'view'.DS.$this->_view.$ext;
     unset($render,$ext);
     
     extract($this->_views, EXTR_OVERWRITE);
     
     ob_start(); 
     include $this->_view;
     $content_for_layout = ob_get_clean();
     if ($this->_conf->get('gzip_output')==1)
     {
        ob_start('ob_gzhandler') or ob_start();//сжатие веб-странички
     }
    else {
         ob_start();   
     }
     include $this->_layout;
     header('Content-length'.  ob_get_length());
    
     $this->_render= FALSE;
     //ob_end_flush();
     
 }
 
 /**
  * 
  * добавление пути к виду
  */
 public function view ($view)
 {
     $this->_view = $view;
 }
 
  /**
  * 
  * добавление пути к лэйауту
  */
  public function layout ($layout)
 {
     $this->_layout = $layout;
 }
}


