<?php
    
    class ApiController{
        private $endpoint;

        public function __construct(){
            $URL = $_GET['url'] ?? '';
            $URL_segments = explode('/', $URL);
            $this->endpoint = $URL_segments[1] ?? 'null';

            if(!$this->endpoint || $this->endpoint == null){
                $err = "The endpoint '{$endpoint}' is null";
                error_log($err);
                throw new Exception($err);
                exit();
            }
        }

        public function resolveEndpointHandler(){
            /* 
            * This checks if the endpoints is in the router and return the handler or method that maps with the endpoint
            *
            * @return string
            * @throws Exception If the route file or handler is not found.
            */
            $routesPath = "../apps/routes/urls.php";
            if (!file_exists($routesPath)) {
                error_log("Routes file not found: $routesPath");
                throw new Exception("Routes file not found: $routesPath");
            }

            $routes = require $routesPath;
            
            foreach( $routes as $route => $handler ){
                if($this->endpoint == $route){
                    $matchedHandler = $handler;
                }
            }

            if(!isset($matchedHandler)){
                $err = "Handler is not found for '{$this->endpoint}'";
                error_log($err);
                throw new Exception($err);
            }

            return $matchedHandler;
        }

        public function loadHandlerFunction(){
            /* 
            * This checksthe api folder for files, if a file have the handler, then it return the handler, if not it logs an error, and exit.
            */
            $handler = $this->resolveEndpointHandler();

             $api_file_path = __DIR__ . "/../api/apis.php"; // added DIR so i can tag with an identifier

            if(!file_exists( $api_file_path )){
                $err = "{$api_file_path} not found";
                error_log($err); 
                throw new Exception($err);
            }

            require_once $api_file_path;

            if (!function_exists($handler)){
                $err = "{$handler} is not found in apis folder";
                error_log($err);
                throw new Exception($err);
            }

            return $handler;

        }

        public function dispatch(){
            /* 
            * Simply run the api
            */
            $handler = $this->loadHandlerFunction();
            $handler();
        }
    }

