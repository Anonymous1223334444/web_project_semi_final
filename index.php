<?php
    
    $url = isset($_GET['url']) ? $_GET['url'] : '/';
    $routes = [
        '/' => 'pages/Home.php',
        '/login' => 'pages/Login.php',
    ];

    if (array_key_exists($url, $routes)) {
        include($routes[$url]);
    } else {
        http_response_code(404);
        include "pages/404.php";
        echo "Page inexistant";
    }
    define ('_IMAGES_', 'public/img');
    define ('_STYLE_', 'public/css');
?>