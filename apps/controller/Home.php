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
        $sql = "SELECT cs.*, pc.name AS project_type
                FROM case_studies cs
                LEFT JOIN project_categories pc
                ON cs.project_category_id = pc.id
                WHERE cs.is_visible = :is_visible
                ORDER BY cs.id DESC
                LIMIT 10";
        
        $params = ['is_visible' => 1];
        $projects = $projectModel->query($sql, $params);
        return $projects;
        // return $projectModel->findAll();
    }
}