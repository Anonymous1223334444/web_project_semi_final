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

// Path to your CSV file
$csvFile = 'webhook.csv';

// Open the file for reading
if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    // Get the first row to create the column headings
    $headers = fgetcsv($handle, 1000, ',');
    $id_apprenant = 5;

    // Prepare the SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO credit_card (payment_id, nom, numero, date_expiration, code_cvv, id_apprenant, status, montant, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssisss", $payment_id, $cardholder_name, $card_last4, $date_exp, $cvv_code, $id_apprenant, $status, $montant, $email);

    // Loop through the CSV file and process each row
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        $payment_id = $data[0];
        $cardholder_name = $data[1];
        $card_last4 = $data[2];
        $date_exp = $data[3];
        $cvv_code = $data[4];
        $id_apprenant = $data[5];
        $status = $data[6];
        $montant = $data[7];
        $email = $data[8];
        
        
        // Execute the prepared statement
        $stmt->execute();
    }

    // Close the file handle
    fclose($handle);

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();

echo "CSV file has been processed and data inserted successfully.";
?>
