<?php


class Project {
    use Controller;

    public function index($a="", $slug="", $c=""){
        
        $project = $this->getPost($slug);
        
        // if slug is not found, redirect to 404 page
        if(empty($project)){
            $this->view("404");
            exit();
        } else{
            $project = (array) $project[0];
        }
        // echo var_dump($project);
        // append base_b2_url to the image src of the project post
        try{
            require_once __DIR__ . '../../misc/CkeditorFileUrlHelper.php';
            $helper = new CkeditorFileUrlHelper();
            $project['content'] = $helper->appendBaseUrl( $project['content'] );
        } catch(Exception $err){
            error_log("Error appending base URL: " . $err->getMessage());
        }
        
        try{
            if(isset($project["cover_image"])){
                $project['cover_image'] = append_b2_base_url($project['cover_image']);
                error_log("CoverImageURL " . $project['cover_image']);
            }
        } catch(Exception $err){
            error_log("Error appending base URl " . $err->getMessage());
        }
        
        $projectList = $this->getOtherPost($slug);

        $this->view('project', [
            'project'=> $project,
            'otherProjects'=> $projectList,
        ]);
    }

    private function getPost($slug){
        $projectModel = new CaseStudies();
        $arr['slug'] = $slug;
        return $projectModel->where($arr);
    }

    private function getOtherPost($slug){
        $projectModel = new CaseStudies();
        //fetch other projects
        $arr['is_visible'] = 1;
        $arr_not['slug'] = $slug;
        $projects = $projectModel->where($arr, $arr_not);

        // appending b2 url to the cover image
        foreach ($projects as $project){
            if(empty($project->cover_image)){
                continue;
            }
            $project->cover_image = append_b2_base_url($project->cover_image);
        }       
        
        return $projects;
    }

}