<?php

trait ImageUpload{
    protected $targetdir;
    protected $imageInput = 'image';
    protected $existingImage;

    function upload(){
        if (!empty($_FILES[$this->imageInput]['name'])) {
            if (!is_dir($this->targetdir)) {
                mkdir($this->targetdir, 0777, true);
            }
            $file = $_FILES[$this->imageInput];
            $filename = basename($file['name']);
            $targetFilePath = $this->targetdir . $filename;
    
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png'];
    
            if (in_array($fileType, $allowedTypes)) {
                // Move file to target directory
                if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                    $existingImage = $filename; // Update image if a new one is uploaded
                    return $existingImage;
                }
            }
        }
        
    }
}