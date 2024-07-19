<?php
$host = "localhost";
$uName = "project";
$pass = "1223334444";
$dbName = "web_project";
$table = "apprenant";  // Assuming this is the correct table name

// Create connection
$conn = new mysqli($host, $uName, $pass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = "";
$nom = "";
$prenom = "";
$email = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: ../Home.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM $table WHERE id=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            header("location: ../Home.php");
            exit;
        }

        $nom = $row["nom"];
        $prenom = $row["prenom"];
        $email = $row["email"];
    } else {
        $errorMessage = "Error preparing statement: " . $conn->error;
    }
} else {
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];

    do {
        if (empty($id) || empty($nom) || empty($prenom) || empty($email)) {
            $errorMessage = "Vous devez remplir tous les champs";
            break;
        }

        $sql = "UPDATE $table SET nom=?, prenom=?, email=? WHERE id=?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssi", $nom, $prenom, $email, $id);
            $result = $stmt->execute();

            if (!$result) {
                $errorMessage = "Requête invalide: " . $stmt->error;
                break;
            }

            $successMessage = "Mise à jour effectuée";
            header("location: ../Home.php");
            exit;
        } else {
            $errorMessage = "Error preparing statement: " . $conn->error;
        }
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Mettre à jour le profile</h2>
        <?php
            if (!empty($errorMessage)) {
                echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>" . htmlspecialchars($errorMessage) . "</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            }
        ?>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?php echo htmlspecialchars($nom); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" value="<?php echo htmlspecialchars($prenom); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
                </div>
            </div>
            <?php
                if (!empty($successMessage)) {
                    echo "
                        <div class='row mb-3'>
                            <div class='offset-sm-3 col-sm-6'>
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>" . htmlspecialchars($successMessage) . "</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
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
