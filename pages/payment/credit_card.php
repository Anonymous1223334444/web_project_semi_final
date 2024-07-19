<?php
require "../../vendor/autoload.php";

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

$titre = $_GET['titre'];
$prix = $_GET['prix'];
$categorie = $_GET['categorie'];
$description = $_GET['description'];
$nameFormateur = $_GET['nameFormateur'];
$photo = $_GET['photo'];

$stripe_secret_key = "sk_test_51PIUGvP6AMZ4sEVHuUgiVJX0srBT1xlCsfnrjbeijRoScYuYtZUgPUXOE7gnSTgYEd7YECLJkMjUExXGKEW9bJmu002B57Ju0B";
\Stripe\Stripe::setApiKey($stripe_secret_key);

session_start();

$queryString = "titre=$titre&prix=$prix&categorie=$categorie&description=$description&nameFormateur=$nameFormateur";
$success_url = "http://localhost/web_dev_3/pages/action/payment_success.php?{$queryString}&session_id={CHECKOUT_SESSION_ID}&course_title=" . urlencode($titre) . "&course_description=" . urlencode($description) . "&course_photo=" . urlencode($photo);
$cancel_url = "http://localhost/web_dev_3/pages/Home.php?course_title=" . urlencode($titre) . "&course_description=" . urlencode($description) . "&course_photo=" . urlencode($photo);

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        "payment_method_types" => ['card'],
        "mode" => "payment",
        "success_url" => $success_url,
        "cancel_url" => $cancel_url,
        "locale" => "fr",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "xaf",
                    "unit_amount" => $prix, // Assuming prix is in the main currency unit, multiply by 100 for cents
                    "product_data" => [
                        "name" => $titre,
                        "description" => $description,
                    ]
                ]
            ],
        ],
    ]);

    // Store the session ID in the user's session
    $_SESSION['CHECKOUT_SESSION_ID'] = $checkout_session->id;

    // Redirect to the Stripe Checkout page
    http_response_code(303);
    header("Location: " . $checkout_session->url);
    exit; // Exit after redirect
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

$conn->close();
?>
