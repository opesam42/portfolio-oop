<?php

function getProjects(){
    header('Content-Type: application/json; charset=utf-8');
    $projectModel = new CaseStudies();
    $projects = $projectModel->findAll();
    echo json_encode($projects);
}