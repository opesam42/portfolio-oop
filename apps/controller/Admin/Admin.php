<?php

class Admin{
    use Controller;
    use ImageUpload;

    private function submitForm(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $result = $this->handleFormSubmission();

            if($result){
                $_SESSION['admin'] = $result[0]->id;
            }  else {
                header("Location: " . getURL() . "?error=1"); // fail
                // header("Location: " . getURL());
                exit();
            }
            
        }
    }

    private function handleFormSubmission(){
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

         if (!$username || !$password) {
            error_log("Username or password field is empty");
            return null;
        }

        $adminModel = new AdminModel();
        $arr['username'] = $username;
        $adminInstance = $adminModel->where($arr);

        if (empty($adminInstance)) {
            error_log("user not found");
            return null; // user not found
        }

        $hashedPassword = $adminInstance[0]->password ?? null;
        if ($hashedPassword && password_verify($password, $hashedPassword)){
            return $adminInstance;
            error_log("Admin login successful: " . $username);
            return $adminInstance;
        }

        error_log("wrong password");
        return null; //wrong password
    }

    function index(){
        $this->submitForm();
        $projects = $this->getProjects();

        $adminSession = $_SESSION['admin'] ?? null;
        $this->view("admin", [
            'admin' => $adminSession,
            'projects' => $projects,
        ]);
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

        // get the project categories
        $projectCatModel = new ProjectCategory();
        $project_categories = $projectCatModel->findAll();
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $check = $this->handleAddForm();
             
            // if submitted to database, redirect to the admin page
             if($check){
                redirect(ROOT . "admin");
            }
        }

        $this->view('add', [
            'proj_cats' => $project_categories
        ]);
    }

    public function handleAddForm() {
        require_once __DIR__ . '../../../misc/CkeditorFileUrlHelper.php';
        $helper = new CkeditorFileUrlHelper();
        
        $data = [
            'title' => $_POST['title'],
            'date_posted' => date('Y-m-d H:i:s'),
            'date_modified' => date('Y-m-d H:i:s'),
            'description' => $_POST['descr'],
            'cover_image' => $this->uploadToB2($sub_folder="cover"),
            'is_visible' => $_POST['visibility'],
            'project_category_id' => $_POST['proj_type'],
            'live_site_link' => $_POST['live_site_link'],
            'design_link' => $_POST['design_link'],
            'github_link' => $_POST['github_link'],
            'content' => $helper->stripBaseUrl( $_POST['content'] ),
            'slug' => slugify($_POST['title']), 
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

        // get the project categories
        $projectCatModel = new ProjectCategory();
        $project_categories = $projectCatModel->findAll();

        $projectModel = new CaseStudies();
        $arr['slug'] = $slug;
        $result = $projectModel->where($arr);
        // error_log(print_r($result[0], true));
        if (!isset($result[0])){
            debug_log("No project found with slug: " . $slug);
            redirect(ROOT . "admin");
        }
    
        debug_log("slug" .$slug);
        $postDetails = (array) $result[0];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $check = $this->handleEditForm($postDetails);
            // if submitted to database, redirect to the admin page
            if($check){
                redirect(ROOT . "admin");
            }
        }
        
        // append base_b2_url to the image src of the project post
        require_once __DIR__ . '../../../misc/CkeditorFileUrlHelper.php';
        $helper = new CkeditorFileUrlHelper();
        
        // Safely handle content field
        if (isset($postDetails['content'])) {
            $postDetails['content'] = $helper->appendBaseUrl($postDetails['content']);
        } else {
            $postDetails['content'] = '';
        }
        
        if (isset($postDetails['cover_image']) && !empty($postDetails['cover_image'])) {
            $postDetails['cover_image'] = $helper->appendBaseUrl($postDetails['cover_image']);
        }

        // pass to view
        $this->view('edit', [
            'row' => $postDetails,
            'proj_cats' => $project_categories,
        ] );
        return $postDetails;
        
    }

    public function handleEditForm($postDetails) {
        $this->imageInput = 'cover_image';
        // Default to existing cover image
        $coverImage = $postDetails['cover_image'];

        // If a new file was uploaded, override it
        if (!empty($_FILES[$this->imageInput]['name'])) {
            $coverImage = $this->uploadToB2($sub_folder = "cover");
        }

        require_once __DIR__ . '../../../misc/CkeditorFileUrlHelper.php';
        $helper = new CkeditorFileUrlHelper();

        $data = [
            'title' => $_POST['title'],
            'date_modified' => date('Y-m-d H:i:s'),
            'description' => $_POST['descr'],
            'cover_image' => $coverImage,
            'is_visible' => $_POST['visibility'],
            'project_category_id' => $_POST['proj_type'],
            'live_site_link' => $_POST['live_site_link'],
            'design_link' => $_POST['design_link'],
            'github_link' => $_POST['github_link'],
            'content' => $helper->stripBaseUrl( $_POST['content'] ),
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
