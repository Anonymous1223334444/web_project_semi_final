<?php
        session_start();
        include '../../../public/database/db_connection.php';
        include '../../utils/Validation.php';
        include '../../utils/Util.php';
        include '../../models/User.php';

// Check if image file is uploaded
if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $validation = new Validation();
    $img_upload_path=null;
    $prenom = $validation->clean($_POST["prenom"]);
    $nom = $validation->clean($_POST["nom"]);
    $email = $validation->clean($_POST["email"]);
    $password = $validation->clean($_POST["password"]);
    $portofolio = $validation->clean($_POST["portofolio"]);
    $bio = $validation->clean($_POST["bio"]);
    
    $data = "prenom=".$prenom."&nom=".$nom."&email=".$email."pp".$new_img_name;

        if(!Validation::prenom($prenom)) {
            $em = "Invalid First Name";
            Util::redirect("../../formateur/Signup.php", "error", $em, $data);
        } else if(!Validation::nom($nom)) {
            $em = "Invalid Last Name";
            Util::redirect("../../formateur/Signup.php", "error", $em, $data);
        } else if(!Validation::email($email)) {
            $em = "Invalid Email";
            Util::redirect("../../formateur/Signup.php", "error", $em, $data);
        } else if(!Validation::password($password)) {
            $em = "Invalid Password";
            Util::redirect("../../formateur/Signup.php", "error", $em, $data);
        } else{
            $db = new Database();
            $conn = $db->connect();
            $user = new User($conn);

            if($user->is_email_unique($email)) {
                $passwordhash = password_hash($password, PASSWORD_DEFAULT);
                if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name'])) {
         
                    $img_name = $_FILES['pp']['name'];
                    $tmp_name = $_FILES['pp']['tmp_name'];
                    $error = $_FILES['pp']['error'];

                    if($error === 0){
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_to_lc = strtolower($img_ex);
            
                        $allowed_exs = array('jpg', 'jpeg', 'png');
                        if(in_array($img_ex_to_lc, $allowed_exs)){
                            $new_img_name = uniqid($email, true).'.'.$img_ex_to_lc;
                            $img_upload_path = '../../../public/uploads/form_profile/'.$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);

                            
                            $user_data = [$nom, $prenom, $email, $portofolio, $new_img_name, $bio, $passwordhash];
                            $res = $user->insertformateur($user_data);
                            if($res) {
                                $sm = "Your (instructor) account is created 😁! You can connect 🤔😉😎";
                                Util::redirect("../../Login.php", "success", $sm, $data);
                            } else {
                                $em = "An error has occured";
                                Util::redirect("../../formateur/Signup.php", "error", $em, $data);
                            }
                        }
                    }
                } else{
                    $user_data = [$nom, $prenom, $email, $portofolio, $new_img_name, $bio, $passwordhash];
                    $res = $user->insertformateur($user_data);
                    header("Location: ../../Home.php?success=Your (instrutor) account has been created");
   	                exit;
                }
                
            } else {
                $em = "The mail ($email) is already taken";
                Util::redirect("../../formateur/Signup.php", "error", $em, $data);
            }


        }

    } else {
        $em = "An error has ocurred...";
        Util::redirect("../../formateur/Signup.php", "error", $em, $data);
    }
?>

<!--  -->