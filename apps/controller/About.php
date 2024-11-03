<?php

class About{
    use Controller;

    public function index(){
        $updateSlug = new UpdateSlug();
        $posts = $updateSlug->updateSlug();
        $this->view('about', []);
    }
}