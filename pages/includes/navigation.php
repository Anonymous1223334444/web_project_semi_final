<?php
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
?>
<body>
    
    <style>
        
        <?php
            include '../public/css/navigation.css';
            
        ?>  
    </style>
    
    <nav class="main-nav">
        <style>
            .search-bar input {
                text-indent: 3rem;
            }
            .search-bar input:focus{
                font-weight: 700;
            }

            .main-nav {
                background-color: #000000;
            }
        </style>
        <button class="btn-mobile-nav">
            <ion-icon class="icon-mobile-nav menu-icon" name="menu-outline"></ion-icon>
            <ion-icon class="icon-mobile-nav close-icon" name="close-outline"></ion-icon>
        </button>
        <?php
            if(isset($_SESSION['email']) && isset($_SESSION['prenom']) && $_SESSION["role"] === "apprenant") {
        ?>
        <a href="http://localhost/web_dev_3/pages/Home.php">
            <h2 class="logo"><img src="http://localhost/web_dev_3/public/img/logo-dark.png" style="width: 5rem;" alt="skillUpNow"></h2>
        </a>
        <ul class="main-nav-list">
            <li>
                <form action="action/search_result.php" class="search-bar" method="POST">
                    <input type="text" placeholder="Faites une recherche" name="search">
                    <button><img src="http://localhost/web_dev_3/public/img/search.png" alt="recherche"></button>
                </form>
            </li>
            <li>
                <div class="dropdown">
                    <span>Catégorie</span>
                    <div class="dropdown-content">
                        <a class="main-nav-link" href="#">Design</a>
                        <a class="main-nav-link" href="#">Architecture</a>
                        <a class="main-nav-link" href="#">Marketing</a>
                        <a class="main-nav-link" href="#">Développement web</a>
                        <a class="main-nav-link" href="#">Mathématiques</a>
                        <a class="main-nav-link" href="#">Physique</a>
                        <a class="main-nav-link" href="#">Communication</a>
                        <a class="main-nav-link" href="#">Développement Personnel</a>
                        <a class="main-nav-link" href="#">Cuisine</a>
                    </div>
                </div>
            </li>
            <li>
                <div class='dropdown'>
                    <strong class='prenom'>
                        Bonjour <i><?= $_SESSION['prenom'] ?></i> <i class="fa-solid fa-chevron-down"></i>
                    </strong>
                    <div class='dropdown-content'>
                        <a class="main-nav-link" href='dashboard.php'>Tableau de bord</a>
                        <a class="main-nav-link" style="text-decoration: none;" href='#'>Mes certificats</a>
                        <a class="main-nav-link" style="text-decoration: none;" href='#'>Mes cours</a>
                        <a class="main-nav-link" style="text-decoration: none;" href='#'>Mes évolutions</a>
                        <a class="main-nav-link" style="text-decoration: none;" href="Logout.php">Se deconnecter</a>
                    </div>
                </div>
            </li>
            <li><a href="Forum/Forum.php" style="color: white;">Forum</a></li>
            <li><a href="#" style="color: white;">Noter la plateforme</a></li>
            <li>
                <img src="http://localhost/web_dev_3/public/img/moon.png" alt="Moon logo" class="dark-mode" style="width: 30px; cursor: pointer; color: black;">
            </li>
        </ul>

            <?php } elseif (isset($_SESSION['email']) && isset($_SESSION['prenom']) && $_SESSION["role"] === "administrateur") { ?>
                <style>
                    .main-nav {
                        background-color: #000000;
                        color: #ffffff;
                    }
                </style>
                    <a href="/web_dev_3/pages/Home.php">
                        <h2 class="logo"><img src="http://localhost/web_dev_3/public/img/logo-dark.png" style="width: 5rem;" alt="skillUpNow"></h2>
                    </a>
                    <ul class="main-nav-list">
                        <li><a href="#" style="color: white;">Voir le rapport du mois</a></li>
                        <li><a href="ajout_cours.php" style="color: white;">Ajouter un cours</a></li>
                        <li></li>
                        <li><a href="Logout.php" style="color: white;">Se déconnecter</a></li>
                    </ul>
            
            <?php } elseif (isset($_SESSION['email']) && isset($_SESSION['prenom']) && $_SESSION["role"] === "formateur") { ?>
                    <style>
                        .main-nav {
                            background-color: #000000;
                            color: #ffffff;
                        }
                    </style>
                <?php 
                    $sql = "SELECT * FROM formateur where id>16";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc()
                ?>
                <a href="http://localhost/web_dev_3/pages/Home.php">
                    <h2 class="logo"><img src="http://localhost/web_dev_3/public/img/logo-dark.png" style="width: 5rem;" alt="skillUpNow"></h2>
                 </a>
                <ul class="main-nav-list">
                    <li>
                        <form action="action/search_result.php" class="search-bar" method="POST">
                            <input type="text" placeholder="Faites une recherche" name="search">
                            <button><img src="http://localhost/web_dev_3/public/img/search.png" alt="recherche"></button>
                        </form>
                    </li>
                    
                    <li></li>
                    <li><a href="ajout_cours.php" style="display: flex; justify-content: center; color: white;">Ajouter un cours</a></li>
                    <li>
                        <div class="dropdown">
                            <span style="height: 5rem; width: 5rem;">
                                <img src="../public/uploads/form_profile/<?= $row["photo_profile"] ?>" style="height: 100%; width: 100%; object-fit: cover; border-radius: 50%;" alt="">
                            </span>
                            <div class="dropdown-content">
                                <a class="main-nav-link" href="dashboard.php">Tableau de bord</a>
                                <a class="main-nav-link" href="#">Voir les offres</a>
                                <a class="main-nav-link" href="#">Commentaires</a>
                                <a class="main-nav-link" href="Logout.php">Se deconnecter</a>
                            </div>  
                        </div>
                    </li>
                    <li><a href="Forum/Forum.php" style="display: flex; justify-content: center; color: white;">Forum</a></li>
                    <li>
                        <img src="http://localhost/web_dev_3/public/img/moon.png" alt="Moon logo" class="dark-mode" style="width: 30px; cursor: pointer; color: black;">
                    </li>
                </ul>

                <?php } elseif (isset($_SESSION['email']) && isset($_SESSION['prenom']) && $_SESSION["role"] === "concepteur_pedagogique") { ?>
                    <style>
                        .main-nav {
                            background-color: #000000;
                            color: #ffffff;
                        }
                    </style>
                    <a href="http://localhost/web_dev_3/pages/Home.php">
                        <h2 class="logo"><img src="http://localhost/web_dev_3/public/img/logo-dark.png" style="width: 5rem;" alt="skillUpNow"></h2>
                    </a>
                    <ul class="main-nav-list">
                        <li>
                            <form action="action/search_result.php" class="search-bar" method="POST">
                                <input type="text" placeholder="Faites une recherche" name="search">
                                <button><img src="http://localhost/web_dev_3/public/img/search.png" alt="recherche"></button>
                            </form>
                        </li>
                        <li></li>
                        <li><a href="Forum/Forum.php" style="color: white;">Forum</a></li>
                        <li>
                            <a class="main-nav-link" style="color: #ffffff;" href="Logout.php">Se deconnecter</a>
                        </li>
                        <li>
                            <img src="http://localhost/web_dev_3/public/img/moon.png" alt="Moon logo" class="dark-mode" style="width: 30px; cursor: pointer; color: black;">
                        </li>
                    </ul>
                <?php } else { ?>
                    <a href="/web_dev_3/pages/Home.php">
                        <h2 class="logo"><img src="http://localhost/web_dev_3/public/img/logo-dark.png" style="width: 5rem;" alt="skillUpNow"></h2>
                    </a>
                    <ul class="main-nav-list">
                        <form action="action/search_result.php" class="search-bar main-nav-link" method="POST">
                            <input type="text" placeholder="Faites une recherche" name="search">
                            <button><img src="http://localhost/web_dev_3/public/img/search.png" alt="recherche"></button>
                        </form>
                        <li>
                            <div class="dropdown">
                                <span>Catégorie</span>
                                <div class="dropdown-content">
                                    <a class="main-nav-link" href="#">Design</a>
                                    <a class="main-nav-link" href="#">Architecture</a>
                                    <a class="main-nav-link" href="#">Marketing</a>
                                    <a class="main-nav-link" href="#">Développement web</a>
                                    <a class="main-nav-link" href="#">Mathématiques</a>
                                    <a class="main-nav-link" href="#">Physique</a>
                                    <a class="main-nav-link" href="#">Communication</a>
                                    <a class="main-nav-link" href="#">Développement Personnel</a>
                                    <a class="main-nav-link" href="#">Cuisine</a>
                                </div>
                            </div>
                        </li>
                        <li><button class='login main-nav-link' id='btn_connect'>Se connecter</button></li>
                        <li><button class='signup main-nav-link' id='btn_create'>Créer un compte</button></li>
                        <li>
                            <a href='' class='main-nav-link' style="color: #ffffffff;" onclick="window.location.href = 'http://localhost/web_dev_3/pages/formateur/signup.php';">Devenir Formateur</a>
                        </li>
                        <li>
                            <img src="http://localhost/web_dev_3/public/img/moon.png" alt="Moon logo" class="dark-mode" style="width: 30px; cursor: pointer;">
                        </li>
                    </ul>

            <?php } ?>
        </ul>   
    </nav> 
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            var icon_dark = document.querySelectorAll(".dark-mode");
            icon_dark.forEach(function(el) {
                el.onclick = function() {
                    document.body.classList.toggle("dark-theme");
                    if (document.body.classList.contains("dark-theme")) {
                        el.src = "http://localhost/web_dev_3/public/img/sun.png";
                    } else {
                        el.src = "http://localhost/web_dev_3/public/img/moon.png";
                    }
                }
            });

        });
        const btnMobileNav = document.querySelector('.btn-mobile-nav');
        const mainNavList = document.querySelector('.main-nav-list');

        btnMobileNav.addEventListener('click', () => {
            mainNavList.classList.toggle('show');
            btnMobileNav.classList.toggle('active');
        });
    </script>
    
</body>
