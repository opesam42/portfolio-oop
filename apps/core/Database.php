<?php

class Database{
    private function connect(){
        try{
            $str = "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME;
            $conn = new PDO($str, DB_USER, DB_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e){
            die("Connection fail: " . $e->getMessage());
        }
    }

    public function test(){
        $conn = $this->connect();
        if($conn){
            echo "Yeah";
        } else{
            echo "No";
        }
    }


    public function query($query, $data=[]){
        $conn = $this->connect();
        //prepared statement
        $stmt = $conn->prepare($query);
        $check = $stmt->execute($data);

        if($check){
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            //if result is an arrray and its more than one
            if(is_array($result) && count($result)){
                return $result;
            }
        } 
        return null;
    }

    public function insertQuery($query, $data=[]){
        $conn = $this->connect();
        //prepared statement
        $stmt = $conn->prepare($query);
        $check = $stmt->execute($data);
        return $check;
    }
    
}
