<?php 

require_once __DIR__ . '/../misc/ImageUpload.php';
require_once __DIR__ .'/../core/functions.php';

class CkeditorImageUpload{
    use ImageUpload;
    
    public function __construct(){
        $this->imageInput = 'upload'; // 'upload' is the classname of ckeditor image input
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode(['error' =>  ['message' => 'This must be a POST request']]);
            error_log('This must be a POST request');
            exit;
        }

        if (!isset($_FILES['upload']) || $_FILES['upload']['error'] != UPLOAD_ERR_OK) {
            echo json_encode(['error' => ['message' => 'Image not found']]);
            error_log('Image not found');
            exit;
        }

    }
}

function uploadCKEditorImage(){
    $imageUpload = new CkeditorImageUpload();
    try{
        // Start measuring time
        $start = microtime(true);

        $keyName = $imageUpload->uploadToB2($sub_folder='project/');
        if (!$keyName) {
            echo json_encode(['error' => ['message' => 'Upload failed. - Keyname not found']]);
            error_log('Upload failed. - Keyname not found');
            exit;
        }

        $fullURL = append_b2_base_url($keyName);
        
        $response = ['url' => $fullURL];
        error_log('Uploaded - ' . $fullURL);

        // End measuring time
        $end = microtime(true);
        $executionTime = $end - $start;
        error_log('⏱ uploadCKEditorImage() took ' . $executionTime . ' seconds.');

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;

    } catch(Exception $err){
        echo json_encode(['error' => ['message' => 'Failed to upload file: ' . $err->getMessage()]]);
        error_log('Failed to upload file: ' . $err->getMessage());
        exit;
    }
}
