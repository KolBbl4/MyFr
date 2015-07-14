<?php
class Controller_Pages_FirstPage
{
    public  function index ($param1, $params)
    {
       $view = new View();
       $view->set('name','coool');
       $view->render();
    }
    
}
?>
