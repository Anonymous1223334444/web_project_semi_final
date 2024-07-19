<?php
    if(isset($_GET["id"]) ) {
        $id = $_GET["id"];

        $host = "localhost";
        $uName = "project";
        $pass = "1223334444";
        $dbName = "web_project";
    
        // Create connection
        $conn = new mysqli($host, $uName, $pass, $dbName);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM apprenant WHERE id=$id";
        $conn->query($sql);
    }

header("location: ../Home.php");
exit;
?>