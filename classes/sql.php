<?php 
    class sql extends PDO{
        private $conn;

        public function __construct(){
            $this->conn = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "");
        }

        function setParams($statment, $parameter = array()){
         
            
            foreach ($parameter as $key => $value){
                $this->setParam($parameter, $value);
            }        
        }

        function setParam($statment, $key, $value){
            
            $statment->bindParam($key, $value);
        }

        function execQuery($rawQuery, $params = array()){
            $stmt = $this->conn->prepare($rawQuery);

        
                $this->setParams($stmt, $params);
                
                $stmt->execute();
                
                
                return $stmt;
            }
        

        public function execSelect($rawQuery, $params = array()):array{
            $stmt = $this->execQuery($rawQuery, $params);
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        }

    
    }

?>