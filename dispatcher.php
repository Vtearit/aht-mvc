<?php

namespace mvc;
use mvc\request;
use mvc\router;

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        
        Router::parse($this->request->url, $this->request);
        
        $controller = $this->loadController();

        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {
        $name = $this->request->controller . "Controller";
        $file = 'mvc\\Controllers\\' . $name;
        // require($file);
        // $controller = new mvc\Controllers\taskController();
        $controller = new $file();
        return $controller;
    }

}
?>