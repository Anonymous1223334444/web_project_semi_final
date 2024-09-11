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
            } if ($role == 'formateur') {
                $nom_table = 'formateur';
            } if ($role == 'concepteur_pedagogique') {
                $nom_table = 'concepteur_pedagogique';
            } if (empty($role)) {
                // Handle case when no role is selected (possible admin login)
                $nom_table = null;
            }

            $data = "&email=".$email;

            if(!Validation::email($email)) {
                $em = "Invalid Email";
                Util::redirect("../Login.php", "error", $em, $data);
            } else if(!Validation::password($password)) {
                $em = "Invalid Password";
                Util::redirect("../Login.php", "error", $em, $data);
            } else{
                $db = new Database();
                $conn = $db->connect();
                $user = new User($conn);

                if ($nom_table) {
                    $auth = $user->auth($email, $password, $role, $nom_table);
                } if (empty($nom_table)) {
                    // Special case for admin login
                    $auth = $user->auth_admin($email, $password);
                }
                if($auth) {
                    $user_data = $user->get_user();
                    $_SESSION['email'] = $user_data['email'];
                    $_SESSION['id'] = $user_data['id'];
                    $_SESSION['role'] = $role;
                    $_SESSION['prenom'] = $user_data['prenom'];
                    $_SESSION['nom'] = $user_data['nom'];
                    $_SESSION['nbr_cours_suivi'] = $user_data['nbr_cours_suivi'];
                    $sm = "Welcome!";
                    Util::redirect("../Home.php", "success", $sm, $data);
                } else{
                    $em = "Incorrect account selection, password or email address";
                    Util::redirect("../Login.php", "error", $em, $data);
                }
            }

        } else {
            $em = "An error has occurred";
            Util::redirect("../Login.php", "error", $em, $data);
        }

    ?>
