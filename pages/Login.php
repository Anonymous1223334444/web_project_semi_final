<?php 
    include 'utils/Validation.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" type="text/css">
    <title>Page de connexion</title>
</head>
<body>
    <style>
        <?php include '../public/css/login.css'; ?> 
    </style>
    <div class="login-container">
        
        <?php
            if(isset($_GET['error'])) { ?>
                <p class='error'><?=Validation::clean($_GET['error'])?></p>;
        <?php } ?>

        <?php
            if(isset($_GET['success'])) { ?>
                <p class='success'><?=Validation::clean($_GET['success'])?></p>;
        <?php } ?>

        <form action="action/Home_log.php" method="POST">
            <p style='margin-bottom: 1rem; font-size: 1.8rem; font-weight: 700;' >Choisir un type de compte</p>
            <div class="account-type">
                <div class='radio-container'>
                    <input type="radio" id="radio1" class="radio-input" name="radio-group" value="administrateur" required>
                    <label for="radio1" class="radio-label">
                        <i class="fa-solid fa-user-tie icon" style='font-size: 4rem;'></i>
                        <p>Administrateur</p>
                    </label>
                </div>

                <div class='radio-container'>
                    <input type="radio" id="radio2" class="radio-input" name="radio-group" value="apprenant" required>
                    <label for="radio2" class="radio-label">
                        <i class="fa-solid fa-graduation-cap icon" style='font-size: 4rem;'></i>
                        <p>Apprenant</p>
                    </label>
                </div>

                <div class='radio-container'>
                    <input type="radio" id="radio3" class="radio-input" name="radio-group" value="formateur" required>
                    <label for="radio3" class="radio-label">
                        <i class="fa-solid fa-person-chalkboard icon" style='font-size: 4rem;'></i>
                        <p>Formateur</p>
                    </label>
                </div>

                <div class='radio-container'>
                    <input type="radio" id="radio4" class="radio-input" name="radio-group" value="concepteur_pedagogique" required>
                    <label for="radio4" class="radio-label">
                        <i class="fa-solid fa-handshake-angle icon" style='font-size: 4rem;'></i>
                        <p>Planificateur Pédagogique</p>
                    </label>
                </div>
            </div>
            <label for="email" style="font-size: 1.2rem; font-weight: 700;">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter votre email" required>

            <label for="password" style="font-size: 1.2rem; font-weight: 700;">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>


            <button type="submit">Se connecter</button>
        </form>

        <p class="signup_option">Pas de compte? <a href="Signup.php">Créer un compte</a></p>
    </div>

    
</body>
</html>