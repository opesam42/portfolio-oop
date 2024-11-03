<?php


class Project {
    use Controller;

    public function index($a="", $slug="", $c=""){
        
        $project = $this->getPost($slug);
        
        // if slug is not found, redirect to 404 page
        if(empty($project)){
            $this->view("404");
            exit();
        }
        $projectList = $this->getOtherPost($slug);

        $this->view('project', [
            'project'=> (array) $project[0],
            'otherProjects'=> $projectList,
        ]);
    }

    private function getPost($slug){
        $projectModel = new CaseStudies();
        // fetch project
        // $arr['slug'] = 'yale-school-of-arts';
        $arr['slug'] = $slug;
        return $projectModel->where($arr);
    }

    private function getOtherPost($slug){
        $projectModel = new CaseStudies();
        //fetch other projects
        $arr['is_visible'] = 1;
        $arr_not['slug'] = $slug;
        return $projectModel->where($arr, $arr_not);
    }

}