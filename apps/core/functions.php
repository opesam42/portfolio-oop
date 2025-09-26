<?php

function show($stuff){
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function redirect($url) {
    header("Location: " . $url);
    exit(); // Stop further execution
}

function getURL($action=null){
    
    $relURL = $_GET['url'];
    $absURL = ROOT . $relURL;
    if($action){
        $absURL = $absURL .'/'. $action;
    }
    return $absURL;
}

function relURL() {
    // Get the URL parameter from the query string, defaulting to 'home' if not set
    $url = isset($_GET['url']) ? strtolower($_GET['url']) : 'home';
    
    // Split the URL by '/' and return the first segment
    $urlSegments = explode('/', $url);
    return $urlSegments[0];
}


function slugify($str){
    // slugify string 
    $slug = strtolower( $str );
    $slug = preg_replace('/\s+/', '-', $slug);
    $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
    $slug = trim($slug, '-');

    return $slug;
}

function append_b2_base_url($path){
    /**
     * Concatenates the B2 base URL with the given object path, ensuring proper formatting.
     *
     * @param string $path The object key or relative path in the B2 bucket.
     * @return string The full public URL to the object in the B2 bucket.
     */

    if(empty($path)){
        error_log("The url path is empty");
    }

    return rtrim(B2_BASE_URL, '/') . '/' . ltrim($path, '/');
}


function debug_log($message){
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
    $file = isset($trace['file']) ? basename($trace['file']) : 'unknown file';
    $line = $trace['line'] ?? 'unknown line';

    error_log("[$file:$line] $message");
}

function isAdminPage(){
    if (relURL() === 'admin') {
        return true;
    }
    return false;
}

