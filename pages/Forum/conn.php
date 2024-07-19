<?php
    session_start();
    $db_username = 'project';
    $db_password = '1223334444';
    $conn = new PDO( 'mysql:host=localhost;dbname=web_project', $db_username, $db_password );
    if(!$conn){
        die("Fatal Error: Connection Failed!");
    }
?>