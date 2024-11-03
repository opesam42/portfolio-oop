<?php

class _404{
    use Controller;

    public function index(){
        // $controller = new Controller;
        // $controller->view("404");
        $this->view("404");
    }
}