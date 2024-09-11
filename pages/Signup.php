<?php 
    include 'utils/Validation.php';
    $firstName = $lastName = $email = "";
    if (isset($_GET["prenom"])) {
        $firstName = $_GET["prenom"];
    }

    if (isset($_GET["nom"])) {
        $lastName = $_GET["nom"];
    }

    if (isset($_GET["email"])) {
        $email = $_GET["email"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" type="text/css">
    <title>Sign Up</title>
</head>
<body>
    <style>
        <?php include '../public/css/signup.css'; ?> 
    </style>

    <div class="form_container">
        <div class="title_container">
            <h2>Fill out the registration form</h2>
        </div>

        <?php
            if (isset($_GET['error'])) { ?>
                <p class='error'><?=Validation::clean($_GET['error'])?></p>;
        <?php } ?>

        <?php
            if (isset($_GET['success'])) { ?>
                <p class='success'><?=Validation::clean($_GET['success'])?></p>;
        <?php } ?>
        
        <form method="POST" action="action/conf&log.php">
            <div class="input_field"> <span><i class="fa fa-user"></i></span>
                <input type="text" name="prenom" placeholder="First Name" value="<?=$firstName?>" >
            </div>

            <div class="input_field"> <span><i class="fa fa-user"></i></span>
                <input type="text" name="nom" placeholder="Last Name" value="<?=$lastName?>" />
            </div>

            <div class="input_field"> <span><i class="fa fa-envelope"></i></span>
                <input type="email" name="email" placeholder="Email" value="<?=$email?>" />
            </div>

            <div class="input_field"> <span><i class="fa fa-lock"></i></span>
                <input type="password" name="password" placeholder="Password" />
            </div>

            <div class="input_field"> <span><i class="fa fa-lock"></i></span>
                <input type="password" name="password2" placeholder="Re-enter Password" />
            </div>
                
            <div class="checkbox_option">
                <input type="checkbox" id="cb1" required>
                <label for="cb1">Accept the <a href="#">terms of use</a></label>
            </div>

            <input class="button" type="submit" value="Sign Up" />
        </form>

        <p class="login_option">Already have an account? <a href="Login.php">Log In</a></p>
    </div>

</body>
</html>
                