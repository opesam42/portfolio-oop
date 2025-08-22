<?php

class UpdateSlug{
    private function getPosts(){
        $projectModel = new CaseStudies();
        return $projectModel->findAll();
    }
    function updateSlug(){
        $posts = $this->getPosts();
        foreach ($posts as $post){
            $titleSlug = slugify($post->title);
            $arr['slug'] = $titleSlug;
            $id = $post->id;

            $projectModel = new CaseStudies();
            $updateSlug = $projectModel -> update($arr, $id);
        }
        
        /* foreach($posts as $post){
            
        } */
    }
}