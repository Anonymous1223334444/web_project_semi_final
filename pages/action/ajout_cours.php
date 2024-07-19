<?php
        session_start();
        include '../../public/database/db_connection.php';
        include '../utils/Validation.php';
        include '../utils/Util.php';
        include '../models/User.php';

// Check if image file is uploaded
if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $validation = new Validation();
    $img_upload_path=null;
    $titre = $validation->clean($_POST["titre"]);
    $categorie = $validation->clean($_POST["categorie"]);
    $id_formateur = $validation->clean((int)$_POST["id_formateur"]);
    $prix = $validation->clean((int)$_POST["prix"]);
    $desc = $validation->clean($_POST["desc"]);
    
    $data = "titre=".$titre."&categorie=".$categorie."&id_formateur=".$id_formateur;

        if(!$titre) {
            $em = "Un titre est requis";
            Util::redirect("../ajout_cours.php", "error", $em, $data);
        } else if(!Validation::categorie($categorie)) {
            $em = "Entrez la categorie";
            Util::redirect("../ajout_cours.php", "error", $em, $data);
        } else if(!Validation::isInteger($id_formateur)) {
            $em = "Choisir un id";
            Util::redirect("../ajout_cours.php", "error", $em, $data);
        } else if(!Validation::isInteger($prix)) {
            $em = "Le prix doit être constitué de chiffres";
            Util::redirect("../ajout_cours.php", "error", $em, $data);
        } else if(!$desc) {
            $em = "Entrez une description";
            Util::redirect("../ajout_cours.php", "error", $em, $data);
        } else{
            $db = new Database();
            $conn = $db->connect();
            $user = new User($conn);

            if($user->is_title_unique($titre)) {
                if (isset($_FILES['cours_img']['name']) AND !empty($_FILES['cours_img']['name'])) {
         
                    $img_name = $_FILES['cours_img']['name'];
                    $tmp_name = $_FILES['cours_img']['tmp_name'];
                    $error = $_FILES['cours_img']['error'];

                    if($error === 0){
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_to_lc = strtolower($img_ex);
            
                        $allowed_exs = array('jpg', 'jpeg', 'png');
                        if(in_array($img_ex_to_lc, $allowed_exs)){
                            $new_img_name = uniqid($titre, true).'.'.$img_ex_to_lc;
                            $img_upload_path = '../../public/uploads/cours/'.$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);

                            $user = new User($conn);

                            $user_data = [$titre, $categorie, $new_img_name, doubleval($prix), (int)$id_formateur, $desc];
                            $res = $user->insertcours($user_data);
                            if($res) {
                                $sm = "Le cours est ajouté !!!";
                                Util::redirect("../Home.php", "success", $sm, $data);
                            } else {
                                $em = "Une erreur est survenue" . doubleval($prix) . intval($id_formateur);
                                Util::redirect("../ajout_cours.php", "error", $em, $data);
                            }
                        }
                    }
                } else{
                    $user_data = [$titre, $categorie, $new_img_name, $prix, $id_formateur, $desc];
                    $res = $user->insertcours($user_data);
                    header("Location: ../Home.php?success=Le cours est ajouté");
   	                exit;
                }
                
            } else {
                $em = "Ce titre ($titre) existe déjà";
                Util::redirect("../ajout_cours.php", "error", $em, $data);
            }


        }

    } else {
        $em = "Une erreur est survenue...";
        Util::redirect("../ajout_cours.php", "error", $em, $data);
    }
?>

<!--  -->