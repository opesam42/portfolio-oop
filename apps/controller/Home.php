<?php


class Home {
    use Controller;

    public function index(){
        $projects = $this->getProjects();
        $this->view('home', ['projects'=>$projects]);
    }
    private function getProjects(){
        // get info from case studies
        $projectModel = new CaseStudies();
        // fetch project that are not drafts
        $arr['is_visible'] = 1;
        return $projectModel->where($arr);
        // return $projectModel->findAll();
    }
}