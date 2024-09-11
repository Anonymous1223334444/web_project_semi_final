<?php
        include '../../public/database/db_connection.php';
        include '../utils/Validation.php';
        include '../utils/Util.php';
        include '../models/User.php';
        
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $validation = new Validation();
            $prenom = $validation->clean($_POST["prenom"]);
            $nom = $validation->clean($_POST["nom"]);
            $email = $validation->clean($_POST["email"]);
            $password = $validation->clean($_POST["password"]);
            $password2 = $validation->clean($_POST["password2"]);

            $data = "prenom=".$prenom."&nom=".$nom."&email=".$email;

            if(!Validation::prenom($prenom)) {
                $em = " Invalid Prenom";
                Util::redirect("../Signup.php", "error", $em, $data);
            } else if(!Validation::nom($nom)) {
                $em = "Invalid Nom";
                Util::redirect("../Signup.php", "error", $em, $data);
            } else if(!Validation::email($email)) {
                $em = "Invalid Email";
                Util::redirect("../Signup.php", "error", $em, $data);
            } else if(!Validation::password($password)) {
                $em = "Invalid password";
                Util::redirect("../Signup.php", "error", $em, $data);
            } else if(!Validation::match($password, $password2)) {
                $em = "The 2 passwords do not match";
                Util::redirect("../Signup.php", "error", $em, $data);
            } else{
                $db = new Database();
                $conn = $db->connect();
                $user = new User($conn);

                if($user->is_email_unique($email)) {
                    $passwordhash = password_hash($password, PASSWORD_DEFAULT);
                    $user_data = [$nom, $prenom, $email, $passwordhash];
                    $res = $user->insertapprenant($user_data);
                    if($res) {
                        $sm = "You are registered 😁! Login 🤔😉😎";
                        Util::redirect("../Login.php", "success", $sm, $data);
                    } else {
                        $em = "An error has occured";
                        Util::redirect("../Signup.php", "error", $em, $data);
                    }
                } else {
                    $em = "The email ($email) is already taken";
                    Util::redirect("../Signup.php", "error", $em, $data);
                }


            }

        } else {
            $em = "An error has occured";
            Util::redirect("../Signup.php", "error", $em, $data);
        }

    ?>