<?php

class Model extends Database{
    protected $table = "case_studies";
    protected $limit = 10;
    protected $order_type = "DESC";
    protected $order_column = "id";

    public function findAll(){
        $query = "SELECT * FROM {$this->table}";
        $result = $this->query($query);
        // show ($result);
        return $result;
    }

    public function where($data=[], $data_not=[]){

        $query = "SELECT * FROM {$this->table} WHERE ";
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        // loop through the key
        foreach($keys as $key){
            $query .= $key . " = :" . $key . " AND ";
        }
        foreach($keys_not as $key){
            $query .= $key . " != :" . $key . " AND ";
        }
        //trim query statement
        $query = trim($query, " AND ");
        
        // add limit 
        $query .= " ORDER BY {$this->order_column} {$this->order_type} LIMIT {$this->limit}";

        // merge the two data
        $data = array_merge($data, $data_not);
        $result = $this->query( $query, $data );
        // $result = $this->fetch($stmt);
        return $result;
    }

    public function add($data){

        // remove unwanted data
        if(!empty($this->allowedColumns)){
            foreach($data as $key => $value){
                if(!in_array($key, $this->allowedColumns)){
                    unset( $data[$key] );
                }
            }
        }

        $keys = array_keys($data);
        $query = "INSERT INTO {$this->table} (" . implode(", ", $keys) . ") VALUES (:" . implode(", :", $keys) . ") ";
        return $this->insertQuery( $query, $data );

    }

    /* public function update($data, $id_column = 'id'){

        // remove unwanted data
        if(!empty($this->allowedColumns)){
            foreach($data as $key => $value){
                if(!in_array($key, $this->allowedColumns)){
                    unset( $data[$key] );
                }
            }
        }
        $keys = array_keys($data);
        $query = "UPDATE {$this->table} SET ";
        foreach($keys as $key){
            $query .=  $key . " = " . ":" . $key . ", " ;
        }
        $query = trim($query, ", ");
        $query .= " WHERE id= :id";
        $data[$id_column] = $id_column;
        $result = $this->insertQuery( $query, $data );
        // show($query);
    }
 */

    public function update($data, $id, $id_column = 'id') {

        // Remove unwanted data if needed
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        // Build the SQL query
        $keys = array_keys($data);
        $query = "UPDATE {$this->table} SET ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }
        $query = rtrim($query, ", ");
        $query .= " WHERE {$id_column} = :{$id_column}";

        // Assign the `id` parameter to the data array
        $data[$id_column] = $id;

        // Execute the query
        $result = $this->insertQuery($query, $data);

        return $result;
    }


    public function delete($id, $id_column = 'id'){
        // $sql = "DELETE FROM case_studies WHERE id = " . $validproj . ";";
        $query = "DELETE FROM {$this->table} WHERE {$id_column} = :{$id_column}" ;
        $data[$id_column] = $id;
        
        $result = $this->query( $query, $data );
        // show($query);
    }
}
