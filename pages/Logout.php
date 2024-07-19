<?php
    session_start();
    include 'utils/Util.php';
    
    session_unset();
    session_destroy();

    $em = "Déconnecté";
    Util::redirect("Home.php", "error", $em, $data);
?>