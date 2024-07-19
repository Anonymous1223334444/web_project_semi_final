<?php
    class User {
        private $nom_table1;
        private $nom_table2;
        private $nom_table3;
        private $conn;

        private $id;
        private $nom;
        private $prenom;
        private $email;
        private $password;
        private $nbr_cours_suivi;

        function __construct($db_conn) {
            $this->conn = $db_conn;
            $this->nom_table1 = "apprenant";
            $this->nom_table2 = "formateur";
            $this->nom_table3 = "cours";
        }
        function insertapprenant($data) {
            try {
                $sql = 'INSERT INTO ' . $this->nom_table1 . ' (nom, prenom, email, password) VALUES(?, ?, ?, ?)';
                $stmt = $this->conn->prepare($sql);
                $res = $stmt->execute($data);
                return $res;
            } catch (PDOException $e){
                return 0;
            }
        }

        function insertformateur($data) {
            try {
                $sql = 'INSERT INTO ' . $this->nom_table2 . ' (nom, prenom, email, portofolio, photo_profile, biographie, password) VALUES (?, ?, ?, ?, ?, ?, ?)';
                $stmt = $this->conn->prepare($sql);
                $res = $stmt->execute($data);
                return $res;
            } catch (PDOException $e){
                return 0;
            }
        }

        function insertcours($data) {
            try {
                $sql = 'INSERT INTO ' . $this->nom_table3 . ' (titre, categorie, photo, prix, id_formateur, description) VALUES (?, ?, ?, ?, ?, ?)';
                $stmt = $this->conn->prepare($sql);
                $res = $stmt->execute($data);
                return $res;
            } catch (PDOException $e){
                return 0;
            }
        }

        function select_prenom($email) {
            try {
                $sql = "SELECT prenom FROM " . $this->nom_table1 . " WHERE `email` = ? ";
                $stmt = $this->conn->prepare($sql);
                if($stmt->execute([$email])) {
                    $res = $stmt->fetchColumn(); 
                    return $res !== false ? $res : null;
                }
                else return null;
            } catch (PDOException $e){
                return 0;
            }
        }

        function is_email_unique($email) {
            try{
                $sql = "SELECT email FROM " . $this->nom_table2 . " WHERE `email` = ? ";
                $stmt = $this->conn->prepare($sql);
                $res = $stmt->execute([$email]);
                if($stmt->rowCount() > 0)
                    return 0;
                else return 1;
                
            }catch(PDOExeption $e) {
                echo $e->getMessage();
            }
        }

        function is_title_unique($titre) {
            try{
                $sql = "SELECT titre FROM " . $this->nom_table3 . " WHERE `titre` = ? ";
                $stmt = $this->conn->prepare($sql);
                $res = $stmt->execute([$titre]);
                if($stmt->rowCount() > 0)
                    return 0;
                else return 1;
                
            }catch(PDOExeption $e) {
                echo $e->getMessage();
            }
        }

        function auth($email, $password, $role, $nom_table) {
            try{
                $sql = "SELECT * FROM " . $nom_table . " WHERE `email` = ? ";
                $stmt = $this->conn->prepare($sql);
                $res = $stmt->execute([$email]);
                if($stmt->rowCount() == 1) {
                    $user = $stmt->fetch();
                    $db_email = $user["email"];
                    $db_password = $user["password"];
                    $db_id = $user["id"];
                    $db_nom = $user["nom"];
                    $db_prenom = $user["prenom"];
                    $db_nbr_cours_suivi = $user["nbr_cours_suivi"];
                    if($db_email == $email && $nom_table == $role) {
                        if(password_verify($password, $db_password)) {
                            $this->email = $db_email;
                            $this->id = $db_id;
                            $this->nom = $db_nom;
                            $this->prenom = $db_prenom;
                            $this->nbr_cours_suivi = $db_nbr_cours_suivi;
                            return 1;   
                        } else return 0;
                    } else return 0;

                } else return 0;
                
            }catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        function get_user() {
            $data = array('id' => $this->id,
                          'nom' => $this->nom,
                          'prenom' => $this->prenom,
                          'email' => $this->email,
                          'role' => $this->role,
                          'nbr_cours_suivi' => $this->nbr_cours_suivi
                        );
            return $data;
        }
    }
?>