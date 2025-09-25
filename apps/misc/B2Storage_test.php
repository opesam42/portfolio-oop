<?php
require_once __DIR__ . '/B2Storage.php';

// Test upload
$file = __DIR__ . '/color.jpg'; // Make sure this file exists in the misc folder
$b2 = new B2Storage();
$result = $b2->upload($file);

if ($result) {
    echo "Test passed: File uploaded to $result\n";
} else {
    echo "Test failed: Upload did not complete\n";
}