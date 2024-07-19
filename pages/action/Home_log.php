<?php
        session_start();
        include '../../public/database/db_connection.php';
        include '../utils/Validation.php';
        include '../utils/Util.php';
        include '../models/User.php';
        
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $validation = new Validation();
            $email = $validation->clean($_POST["email"]);
            $password = $validation->clean($_POST["password"]);
            $role = $_POST["radio-group"];
            $nom_table = null;
            if ($role == 'apprenant') {
                $nom_table = 'apprenant';
            } else if ($role == 'formateur') {
                $nom_table = 'formateur';
            } else if ($role == 'administrateur') {
                $nom_table = 'administrateur';
            } else if ($role == 'concepteur_pedagogique') {
                $nom_table = 'concepteur_pedagogique';
            }

            $data = "&email=".$email;

            if(!Validation::email($email)) {
                $em = "Email invalide";
                Util::redirect("../Login.php", "error", $em, $data);
            } else if(!Validation::password($password)) {
                $em = "Mot de passe invalide";
                Util::redirect("../Login.php", "error", $em, $data);
            } else{
                $db = new Database();
                $conn = $db->connect();
                $user = new User($conn);

                $auth = $user->auth($email, $password, $role, $nom_table);
                if($auth) {
                    $user_data = $user->get_user();
                    $_SESSION['email'] = $user_data['email'];
                    $_SESSION['id'] = $user_data['id'];
                    $_SESSION['role'] = $role;
                    $_SESSION['prenom'] = $user_data['prenom'];
                    $_SESSION['nom'] = $user_data['nom'];
                    $_SESSION['nbr_cours_suivi'] = $user_data['nbr_cours_suivi'];
                    $sm = "Bienvenue!";
                    Util::redirect("../Home.php", "success", $sm, $data);
                } else{
                    $em = "Compte choisi, mot de passe ou email incorrecte";
                    Util::redirect("../Login.php", "error", $em, $data);
                }
            }

        } else {
            $em = "Une erreur est survenue";
            Util::redirect("../Login.php", "error", $em, $data);
        }

    ?>
