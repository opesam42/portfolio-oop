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


function slugGenerator($title){
    // change to lowercase
    $slug = strtolower( $title );
    $slug = preg_replace('/\s+/', '-', $slug);
    $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
    $slug = trim($slug, '-');

    return $slug;
}