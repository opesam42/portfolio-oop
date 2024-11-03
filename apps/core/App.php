<?php

class App{
    protected $controller = "Home";
    protected $method = "index";

    // if URL is not set , return home else return full URL
    private function splitURL(){
        $URL = $_GET['url'] ?? 'home';
        $URL = explode('/', $URL);
        return $URL;
    }

    public function loadController(){
        $URL = $this->splitURL();
        $directories = [
            '../apps/controller/',
            '../apps/controller/Admin/',
        ];
        foreach ($directories as $directory){
            $filename = $directory . ucfirst($URL[0]) . ".php";
            // check if file exist
            if(file_exists($filename)){
                require $filename;
                $this->controller = ucfirst($URL[0]);
                $controllerFound = true;
                break;
            }
        }
        
        // if controller is not found
        if(!isset($controllerFound)){
            require "../apps/controller/_404.php";
            $this->controller = "_404";
        }
        
        if(!empty($URL[1])){
            if(method_exists($this->controller, $URL[1])){
                $this->method = $URL[1];
            }
        }

        $controller = new $this->controller;
        call_user_func_array([$controller, $this->method], $URL);
    }
    
}

