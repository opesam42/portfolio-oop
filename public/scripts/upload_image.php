<?php
// require "../../apps/core/config.php";

// Set the target directory for uploads (relative to this script's location)
// $targetDir = '../../uploads/';

$targetDir = __DIR__ . '/../uploads/';

// Check if the upload directory exists; if not, create it
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0755, true);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if an image file is uploaded
    if (isset($_FILES['upload']) && $_FILES['upload']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['upload'];

        // Sanitize and generate a unique file name
        $fileName = preg_replace("/[^a-zA-Z0-9\._-]/", "_", basename($file['name']));
        $fileName = uniqid() . '_' . $fileName; // Add unique ID prefix
        $targetFilePath = $targetDir . $fileName;

        // Validate the file type (allow only specific image types)
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowedTypes)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                // Construct the URL dynamically based on the server's base URL
                $baseUrl = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
                $fileUrl = $baseUrl . '/projects/portfolio2/uploads/' . $fileName;

                // Return the image URL in JSON format
                $response = [
                    'url' => $fileUrl
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                // Handle the error in case the image upload fails
                echo json_encode(['error' => 'Failed to move uploaded file.']);
            }
        } else {
            // Return an error message for invalid file type
            echo json_encode(['error' => 'Invalid file type. Only JPG, JPEG, PNG & GIF files are allowed.']);
        }
    } else {
        // Handle case where no file is uploaded or an error occurred
        echo json_encode(['error' => 'No image uploaded or upload error.']);
    }
} else {
    // Return an error message for invalid request method
    echo json_encode(['error' => 'Invalid request method.']);
}
