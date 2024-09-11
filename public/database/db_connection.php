<?php
    class Database {
        private $host = "localhost";
        private $uName = "project";
        private $pass = "1223334444";
        private $dbName = "web_project";
        private $conn;
       
        public function connect() {
            $this->conn = null;
            try{
                $this->conn = new PDO('mysql:host=' . $this->host . ';port=3306;dbname='. $this->dbName, $this->uName, $this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Erreur de connection a la base de donnée: " . $e->getMessage();
            }
            return $this->conn;
        }

    }

    

?>
