<?php

require_once __DIR__ . '/B2Storage.php';

trait ImageUpload {
    protected $imageInput = 'image';
    protected $existingImage;
    protected $b2Folder = 'gbenga_portfolio';

    function uploadToB2($sub_folder = null, $targetKey = null) {
        if (!empty($_FILES[$this->imageInput]['name'])) {
            $file = $_FILES[$this->imageInput];
            $filename = basename($file['name']);
            $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png'];

            if (!in_array($fileType, $allowedTypes)) {
                $err = "{$fileType} is not allowed";
                error_log($err);
                throw new Exception($err);
                exit();
            }
            
            $b2 = new B2Storage();
            $keyName = $targetKey ?? $filename;
            
            if ($sub_folder) {
                $keyName = $this->b2Folder . '/' . $sub_folder . '/' . $keyName;
            } else {
                $keyName = $this->b2Folder . '/' . $keyName;
            }

            $result = $b2->upload($file['tmp_name'], $keyName);
            if ($result) {
                $this->existingImage = $result; 
                return $result;
            }
        }
    }
}