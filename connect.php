<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'gym');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Prepare SQL statement to insert data into database
    $stmt = $conn->prepare("INSERT INTO registration (name, email, message) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters and execute SQL statement
    $stmt->bind_param("sss", $name, $email, $message);
    if ($stmt->execute()) {
        echo "Registration successful";
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>
