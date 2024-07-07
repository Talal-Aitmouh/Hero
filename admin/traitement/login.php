<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroku";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Prepared statement to fetch user by email
    $sql = 'SELECT * FROM Staff WHERE Email = ?';

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);

        // Get the result
        $res = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

        // Debug output
        if (!$row) {
            echo "No user found with that email.";
        }

        // Verify the password
        if ($row && password_verify($password, $row['Password'])) {
            // Set session variables
            $_SESSION['StaffID'] = $row['StaffID'];
            $_SESSION['FullName'] = $row['FullName'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['Position'] = $row['Position'];

            // Redirect to the dashboard
            header("Location: ../index.php");
            exit();
        } else {
            // Redirect back to login page with error message
            header("Location: ../login/index.php?error=invalid_credentials");
            exit();
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
