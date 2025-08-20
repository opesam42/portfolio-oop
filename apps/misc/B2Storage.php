<?php
require __DIR__ . '/../../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

require_once __DIR__ . '/../core/config.php'; //for loading env variables

class B2Storage {
    private $s3Client;
    private $bucketName;

    public function __construct() {
        $this->bucketName = B2_BUCKET_NAME;
        $this->s3Client = new S3Client([
            'version'     => 'latest',
            'region'      => B2_REGION,
            'endpoint'    => B2_ENDPOINT,
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => B2_ACCESS_KEY,
                'secret' => B2_SECRET_KEY,
            ],
        ]);
    }

    public function upload($filePath, $keyName = null) {
        if (!$keyName) {
            $keyName = basename($filePath);
        }

        try {
            $result = $this->s3Client->putObject([
                'Bucket' => $this->bucketName,
                'Key'    => $keyName,
                'Body'   => fopen($filePath, 'r'),
                'ACL'    => 'public-read',
                'ContentType' => mime_content_type($filePath),
                'ContentDisposition' => 'inline' 
            ]);
            error_log("File uploaded successfully!\n");
            error_log("File URL: {$result['ObjectURL']}\n");
            return $result['ObjectURL'];
        } catch (AwsException $e) {
            error_log("Error: " . $e->getAwsErrorMessage() . "\n");
            return false;
        }
    }
}
