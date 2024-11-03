<?php

trait Controller{
    public function view($name, $data=[]){

        $data = extract($data);
        $directories = [
            '../apps/views/',
            '../apps/views/admin/'
        ];
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
            require "../apps/view/404.view.php";
        }
    }
}