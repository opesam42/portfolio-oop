<?php

trait Controller{
    
    public function view($name, $data=[]){
        // $uri = $_SERVER["REQUEST_URI"];
        // $parsedURI = parse_url($uri, PHP_URL_PATH);
        // $parsedURI = trim($parsedURI, "/");
        

        // $isAPIHandled = link_api_to_url($parsedURI);
        // if ($isAPIHandled) return;

        $data = extract($data);
        $directories = [
            '../apps/views/',
            '../apps/views/admin/'
        ];
        
        $viewFound = false;

        foreach ($directories as $directory){
            $filename = $directory . $name . ".view.php";
            // check if view file exist
            if(file_exists($filename)){
                require $filename;
                $viewFound = true;
                break;
            }
        }
        
        // if view file is not found
        if(! $viewFound){
            require "../apps/views/404.view.php";
        }
    }
}