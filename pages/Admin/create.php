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

    $nom="";
    $prenom="";
    $email="";
    $errorMessage="";
    $successMessage="";

    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];

        do {
            if (empty($nom) || empty($prenom) || empty($email)) {
                $errorMessage = "Tous les champs sont requis";
                break;
            }

            $sql = "INSERT INTO apprenant (nom, prenom, email) " . 
                    "VALUES ('$nom', '$prenom', '$email')";
            $result = $conn->query($sql);

            if (!$result) {
                $errorMessage = "Requête invalide: " . $conn->error;
                break;
            }

            $nom="";
            $prenom="";
            $email="";

            $successMessage = "Bien ajouté !";

            header("location: ../Home.php");
            exit;
        } while (false);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Ajouter un apprenant</h2>
        <?php
            if (!empty($errorMessage)) {
                echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$errorMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            }
        ?>
        <form method="POST">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?= $nom ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" value="<?= $prenom ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?= $email ?>">
                </div>
            </div>

            <?php
                if( !empty($successMessage) ) {
                    echo "
                        <div class='row mb-3'>
                            <div class='offset-sm-3 col-sm-6'>
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>$successMessage</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label></button>
                                </div>
                            </div>
                        </div>
                    ";
                }
            ?>


            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </div>

                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="Admin.php" role="button">Quitter</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>