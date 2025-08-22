<?php

require_once __DIR__ . '../../core/config.php';

class CkeditorFileUrlHelper{

    private $b2_url = B2_BASE_URL;
    
    public function stripBaseUrl(string $content){
        return str_replace($this->b2_url, '', $content);
    }


    public function appendBaseUrl(string $content){
        return preg_replace_callback(
                '/src="([^"]+)"/',
                function ($matches) {
                    $src = $matches[1];
                    // Only prepend if not already absolute
                    if (strpos($src, 'http') === 0) {
                        return 'src="' . $src . '"';
                    }
                    return 'src="' . $this->b2_url . ltrim($src, '/') . '"';
                },
                $content
            );
    }

}
