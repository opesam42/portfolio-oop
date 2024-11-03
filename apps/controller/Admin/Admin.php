<?php

class Admin{
    use Controller;
    use ImageUpload;

    function index(){
        $this->submitForm();
        $projects = $this->getProjects();

        $adminSession = $_SESSION['admin'] ?? null;
        $this->view("admin", [
            'admin' => $adminSession,
            'projects' => $projects,
        ]);
    }

    public function submitForm(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $result = $this->handleFormSubmission();

            if($result){
                $_SESSION['admin'] = $result[0]->id;
            }
            header("Location: " . getURL());
            exit();
        }
    }

    private function handleFormSubmission(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $adminModel = new AdminModel();
        $arr['username'] = $username;
        $arr['password'] = $password;
        return $adminModel->where($arr);
    }

    private function getProjects(){
        // get info from case studies
        $projectModel = new CaseStudies();
        // fetch all projects
        return $projectModel->findAll();
    }

    public function logout(){
        unset($_SESSION['admin']);

        header('Location: '. ROOT . "/admin");
    }


    // adding project
    public function add(){
        $adminSession = $_SESSION['admin'] ?? null; // save admin
        if(empty($adminSession)){
            redirect(ROOT . "admin"); //if admin session is not present, redirect to login
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $check = $this->handleAddForm();
             
            // if submitted to database, redirect to the admin page
             if($check){
                redirect(ROOT . "admin");
            }
        }

        $this->view('add');
    }

    public function handleAddForm() {

        // pass needed parameters for coverimage upload
        $this->targetdir = 'uploads/cover/';
        // $this->existingImage = $postDetails['cover_image'];

        $data = [
            'title' => $_POST['title'],
            'date_posted' => date('Y-m-d H:i:s'),
            'description' => $_POST['descr'],
            'cover_image' => $this->upload(),
            'is_visible' => $_POST['visibility'],
            'project_type' => $_POST['proj_type'],
            'live_site_link' => $_POST['live_site_link'],
            'design_link' => $_POST['design_link'],
            'github_link' => $_POST['github_link'],
            'content' => $_POST['content'],
        ];
        $projectModel = new CaseStudies();
        return $projectModel->add($data);
        
    }

    // for edit page
    public function edit($a=null, $b=null, $slug=""){
        
        $adminSession = $_SESSION['admin'] ?? null; // save admin
        if(empty($adminSession)){
            redirect(ROOT . "admin"); //if admin session is not present, redirect to login
        }

        $projectModel = new CaseStudies();
        $arr['slug'] = $slug;
        $result = $projectModel->where($arr);
        $postDetails = (array) $result[0];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $check = $this->handleEditForm($postDetails);
            // if submitted to database, redirect to the admin page
            if($check){
                redirect(ROOT . "admin");
            }
        }

        
        // imageUpload class image is given the directory of the original image

        // pass to views
        $this->view('edit', [
            'row' => $postDetails,
        ] );
        // echo $result[0]->title;
        return $postDetails;
        
    }

    public function handleEditForm($postDetails) {

        // pass needed parameters for coverimage upload
        $this->targetdir = 'uploads/cover/';
        $this->existingImage = $postDetails['cover_image'];

        $data = [
            'title' => $_POST['title'],
            'date_modified' => date('Y-m-d H:i:s'),
            'description' => $_POST['descr'],
            'cover_image' => $this->upload(),
            'is_visible' => $_POST['visibility'],
            'project_type' => $_POST['proj_type'],
            'live_site_link' => $_POST['live_site_link'],
            'design_link' => $_POST['design_link'],
            'github_link' => $_POST['github_link'],
            'content' => $_POST['content'],
        ];
        $projectModel = new CaseStudies();
        $id = $postDetails['id'];
        return $projectModel->update($data, $id);
        
    }

    // delete function
    public function delete($a=null, $b=null, $slug=""){
        $adminSession = $_SESSION['admin'] ?? null; // save admin
        if(empty($adminSession)){
            redirect(ROOT . "admin"); //if admin session is not present, redirect to login
        }

        // fetch the post to be deleted base on the slug
        $projectModel = new CaseStudies();
        $arr['slug'] = $slug;
        $result = $projectModel->where($arr);
        $postDetails = (array) $result[0];
        $id = $postDetails['id'];
        echo $postDetails['title'] . " has been deleted.";
        // delete post
        return $projectModel->delete($id);

    }
}
