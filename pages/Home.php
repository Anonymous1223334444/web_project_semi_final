<?php
    session_start();
    // Disable error reporting
    error_reporting(0);

    // Or, disable only warnings
    error_reporting(E_ERROR | E_PARSE);
    $page_title = "Home Page";
    require_once "../index.php";
    include 'utils/Util.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web_Dev_Projet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script
      defer
      src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"
    ></script>
</head>
<body>
    <style>
        .main-nav {
            background-color: #000;
            color: #ffffff;
        }
        <?php include '../public/css/style.css' ?> 
    </style>

    <header class="header">
        <?php include 'includes/navigation.php';?>
            <button class="btn-mobile-nav">
                <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
                <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
            </button>
    </header>

    <main class="containers">
        <?php include 'Base.php';?>
    </main>

    <footer style="text-align: center;">
        <?php include 'includes/footer.php';?>
    </footer>

    <script type="text/javascript">
        <?php
            include "../public/js/script.js";
        ?>
        
    document.getElementById('btn_connect').addEventListener('click', function(event) {
            event.preventDefault();
            const content = document.querySelector('container');
            content.classList.remove('fade-in');
            content.classList.add('fade-out');

            setTimeout(() => {
                window.location.href = event.target.href;
            }, 500); // Match this duration with the fade-out animation duration
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>