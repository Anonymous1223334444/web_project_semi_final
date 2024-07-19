<?php
// stripe listen --forward-to localhost://web_dev_3/pages/payment/store_data.php
// error_reporting(E_ALL);
// file_put_contents("webhook.log", "Connection failed: " . error_reporting(E_ALL) . "\n", FILE_APPEND);
// ini_set('display_errors', 1);
// file_put_contents("webhook.log", "Connection failed: " . ini_set('display_errors', 1) . "\n", FILE_APPEND);

// Include the Stripe PHP library (assuming you installed it via Composer)
require '../../vendor/autoload.php';
$host = "localhost";
$uName = "project";
$pass = "1223334444";
$dbName = "web_project";

// Create connection
$conn = new mysqli($host, $uName, $pass, $dbName);

// Check connection
if ($conn->connect_error) {
    // file_put_contents("webhook.log", "Connection failed: " . $conn->connect_error . "\n", FILE_APPEND);
    die("Connection failed: " . $conn->connect_error);
} /* else {
    file_put_contents("webhook.log", "Database connected successfully.\n", FILE_APPEND);
} */

\Stripe\Stripe::setApiKey('sk_test_51PIUGvP6AMZ4sEVHuUgiVJX0srBT1xlCsfnrjbeijRoScYuYtZUgPUXOE7gnSTgYEd7YECLJkMjUExXGKEW9bJmu002B57Ju0B');

// Retrieve the request's body and parse it as JSON
$input = @file_get_contents("php://input");
$event_json = json_decode($input);

// For security, retrieve the raw body and signature header
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$endpoint_secret = 'whsec_bd227b35811f6af675e3af4c94c2a592808cd8860f7befa59f2c37734615b2bc';

try {
    $event = \Stripe\Webhook::constructEvent(
        $input, $sig_header, $endpoint_secret
    );
} catch(\UnexpectedValueException $e) {
    // Invalid payload
    http_response_code(400);
    exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    http_response_code(400);
    exit();
}


// Handle the event
switch ($event->type) {
    case 'payment_intent.succeeded':
        $paymentIntent = $event->data->object; // contains a StripePaymentIntent

        $payment_id = $conn->real_escape_string($paymentIntent->id);
        $amount = $conn->real_escape_string($paymentIntent->amount);
        $currency = $conn->real_escape_string($paymentIntent->currency);
        $montant = $conn->real_escape_string($amount . " " . $currency);
        $status = $conn->real_escape_string($paymentIntent->status);

        $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentIntent->payment_method);

        $card_last4 = $conn->real_escape_string($paymentMethod->card->last4);
        $card_brand = $conn->real_escape_string($paymentMethod->card->brand);
        $card_exp_month = $conn->real_escape_string($paymentMethod->card->exp_month);
        $card_exp_year = $conn->real_escape_string($paymentMethod->card->exp_year);
        $date_exp = "$card_exp_month/$card_exp_year";
        $cardholder_name = $conn->real_escape_string($paymentMethod->billing_details->name);
        $email = $conn->real_escape_string($paymentMethod->billing_details->email);

        // file_put_contents("webhook.log", "Payment ID: " . $payment_id . "\n", FILE_APPEND);
        // file_put_contents("webhook.log", "Amount: " . $amount . "\n", FILE_APPEND);
        // file_put_contents("webhook.log", "Currency: " . $currency . "\n", FILE_APPEND);
        // file_put_contents("webhook.log", "Montant: " . $montant . "\n", FILE_APPEND);
        // file_put_contents("webhook.log", "Status: " . $status . "\n", FILE_APPEND);
        // file_put_contents("webhook.log", "Card_num: " . "...$card_last4" . "\n", FILE_APPEND);
        // file_put_contents("webhook.log", "Card Brand: " . $card_brand . "\n", FILE_APPEND);
        // file_put_contents("webhook.log", "Month exp: " . $card_exp_month . "\n", FILE_APPEND);
        // file_put_contents("webhook.log", "Year exp: " . $card_exp_year . "\n", FILE_APPEND);
        // file_put_contents("webhook.log", "date_exp: " . $date_exp . "\n", FILE_APPEND);
        // file_put_contents("webhook.log", "Cardholder_name: " . $cardholder_name . "\n", FILE_APPEND);
        // file_put_contents("webhook.log", "email: " . $email . "\n", FILE_APPEND);

        file_put_contents("webhook.csv", "$payment_id, $cardholder_name, ...$card_last4, $date_exp, hidden, $id_apprenant, $status, $montant, $email\n", FILE_APPEND);
        // file_put_contents("webhook.log", "SQL Query: " . $conn->query($sql) . "\n", FILE_APPEND);
        break;
    default:
        http_response_code(400);
        exit();
}


http_response_code(200);

?>
