<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'] ?? '';
    $number = $_POST['number'] ?? '';
    $email = $_POST['email'] ?? '';
    $membership_plan = $_POST['membership_plan'] ?? '';

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'gym');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Prepare SQL statement to insert data into database
    $stmt = $conn->prepare("INSERT INTO payments (name, number, email, membership_plan) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters and execute SQL statement
    $stmt->bind_param("ssss", $name, $number, $email, $membership_plan);
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