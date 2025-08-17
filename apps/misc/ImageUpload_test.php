<?php


require_once __DIR__ . '/ImageUpload.php';

class ImageUploadTest {
    use ImageUpload;

    public function run() {
        // Simulate $_FILES for testing (using an image from assets)
        $testImage = __DIR__ . '/../../public/assets/display-pic.jpg';
        if (!file_exists($testImage)) {
            echo "Test image not found: $testImage\n";
            return;
        }

        $_FILES[$this->imageInput] = [
            'name' => 'display-pic.jpg',
            'type' => 'image/jpeg',
            'tmp_name' => $testImage,
            'error' => 0,
            'size' => filesize($testImage),
        ];

        try {
            $result = $this->uploadToB2($sub_folder="test");
            if ($result) {
                echo "Test passed: File uploaded to $result\n";
            } else {
                echo "Test failed: Upload did not succeed.\n";
            }
        } catch (Exception $e) {
            echo "Exception: " . $e->getMessage() . "\n";
        }
    }
}

// Run the test
$test = new ImageUploadTest();
$test->run();