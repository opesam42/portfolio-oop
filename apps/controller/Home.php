<?php


class Home {
    use Controller;

    public function index(){
        $projects = $this->getProjects();
        
        // append b2_base_url to the cover image
        foreach ($projects as $project){
            if(empty($project->cover_image)){
                continue;
            }

            $project->cover_image = append_b2_base_url($project->cover_image);
        }        

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