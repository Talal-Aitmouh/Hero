<?php
session_start();
require '../config/db.php'; // Ensure this file sets up your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $email = $_POST['username'];  // Assuming 'username' is used for email
    $passportNumber = $_POST['password'];  // Use 'password' field for PassportNumber

    // Prepare and execute a query to check user credentials
    $sql = "SELECT * FROM guests WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $guest = $result->fetch_assoc();
        
        // Verify passport number
        if ($passportNumber === $guest['PassportNumber']) {
            // Set session variables
            $_SESSION['guest_id'] = $guest['GuestID'];
            $_SESSION['full_name'] = $guest['FullName'];

            // Redirect to client page
            header('Location: /Client.php');
            exit();
        } else {
            // Handle invalid credentials
            echo "Invalid email or passport number.";
        }
    } else {
        // Handle user not found
        echo "Invalid email or passport number.";
    }

    $stmt->close();
    $conn->close();
}
