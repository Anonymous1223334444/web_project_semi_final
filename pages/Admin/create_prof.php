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

$nom = "";
$prenom = "";
$email = "";
$portofolio = "";
$password = "";
$bio = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $portofolio = $_POST['portofolio'];
    $bio = $_POST['bio'];

    if (isset($_FILES['pp']['name']) && !empty($_FILES['pp']['name'])) {
        $img_name = $_FILES['pp']['name'];
        $tmp_name = $_FILES['pp']['tmp_name'];
        $error = $_FILES['pp']['error'];

        if ($error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if (in_array($img_ex_to_lc, $allowed_exs)) {
                $new_img_name = uniqid($email, true) . '.' . $img_ex_to_lc;
                $img_upload_path = '../../public/uploads/form_profile/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                do {
                    if (empty($nom) || empty($prenom) || empty($email) || empty($portofolio) || empty($bio) || empty($password)) {
                        $errorMessage = "All fields are required";
                        break;
                    }
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO formateur (nom, prenom, email, portofolio, photo_profile, biographie, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssssss", $nom, $prenom, $email, $portofolio, $new_img_name, $bio, $password_hash);    
                    $result = $stmt->execute();

                    if (!$result) {
                        $errorMessage = "Invalid query: " . $stmt->error;
                        break;
                    }

                    $nom = "";
                    $prenom = "";
                    $email = "";
                    $portofolio = "";
                    $bio = "";
                    $password = ""; // Clear the password field

                    $successMessage = "Successfully added!";

                    header("Location: ../Home.php");
                    exit;
                } while (false);
            } else {
                $errorMessage = "Unsupported file format. Only jpg, jpeg, png files are allowed.";
            }
        } else {
            $errorMessage = "Error uploading the file.";
        }
    } else {
        $errorMessage = "Please upload a profile picture.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Add Instructor</h2>
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
        <form method="POST" enctype="multipart/form-data">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($nom) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Surname</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" value="<?= htmlspecialchars($prenom) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?= htmlspecialchars($email) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" value="<?= htmlspecialchars($password) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Portfolio</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="portofolio" value="<?= htmlspecialchars($portofolio) ?>">
                </div>
            </div>
            <div class="mb-3">
                <label for="pp" class="form-label">Profile Picture</label>
                <input class="form-control" type="file" id="pp" name="pp" accept="image/*">
            </div>
            <div class="row mb-3">
                <label for="bio" class="form-label">Biography</label>
                <textarea class="form-control" id="bio" name="bio" rows="3"><?= htmlspecialchars($bio) ?></textarea>
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="Admin.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
