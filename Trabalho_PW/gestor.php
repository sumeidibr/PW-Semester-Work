<?php 
class Gestor
{    
    private $db_server = 'localhost';
    private $db_name = 'newsletter';
    private $db_charset = 'utf8';
    private $db_username = 'root';
    PRIVATE $db_password = '';
    
    //==========================READ========================================
    public function EXE_QUERY($query, $parameters = null, $debug = true, $close_connection = true){
        //executes a query the the database (SELECT)
        $results = null;

        //connection
        $connection = new PDO(
            'mysql:host='.$this->db_server.
            ';dbname='.$this->db_name.
            ';charset='.$this->db_charset,
            $this->db_username,
            $this->db_password,
            array(PDO::ATTR_PERSISTENT => true));      
            
        if($debug){
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }

        //execution
        try {
            if ($parameters != null) {
                $gestor = $connection->prepare($query);
                $gestor->execute($parameters);
                $results = $gestor->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $gestor = $connection->prepare($query);
                $gestor->execute();
                $results = $gestor->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {        
            return false;
        }

        //close connection
        if ($close_connection) {
            $connection = null;
        }

        //returns results
        return $results;
    }

    //============================INSERT, UPDATE, DELETE======================================
    public function EXE_NON_QUERY($query, $parameters = null, $debug = true, $close_connection = true){
        //executes a query to the database (INSERT, UPDATE, DELETE)

        //connection
        $connection = new PDO(
            'mysql:host='.$this->db_server.
            ';dbname='.$this->db_name.
            ';charset='.$this->db_charset,
            $this->db_username,
            $this->db_password,
            array(PDO::ATTR_PERSISTENT => true));   

        if($debug){
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        
        //execution
        $connection->beginTransaction();
        try {
            if ($parameters != null) {
                $gestor = $connection->prepare($query);
                $gestor->execute($parameters);
            } else {
                $gestor = $connection->prepare($query);
                $gestor->execute();
            }
            $connection->commit();
        } catch (PDOException $e) {            
            $connection->rollBack();
            return false;
        }

        //close connection
        if ($close_connection) {
            $connection = null;
        }
        
        return true;
    }
}