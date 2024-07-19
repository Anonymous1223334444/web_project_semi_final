<?php
    $host = "localhost";
    $uName = "project";
    $pass = "1223334444";
    $dbName = "web_project";
    $table = "concepteur_pedagogique";

// Create connection
$conn = new mysqli($host, $uName, $pass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Path to your CSV file
$csvFile = '../../public/database/data/concepteur_pedagogique.csv';

// Open the file for reading
if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    // Get the first row to create the column headings
    $headers = fgetcsv($handle, 1000, ',');

    // Prepare the SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO $table (nom, prenom, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $prenom, $email, $hashed_password);

    // Loop through the CSV file and process each row
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        $id = $data[0];
        $nom = $data[1];
        $prenom = $data[2];
        $email = $data[3];
        $password = $data[4];
        
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
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
