<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroku";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch billing and guest data
$sql = "SELECT g.FullName, g.Email, b.Amount, b.PaymentStatus, b.BillingID, b.BookingID, b.BillingDate
        FROM billing b
        JOIN guests g ON b.GuestID = g.GuestID";

$result = $conn->query($sql);

$billings = [];
while ($row = $result->fetch_assoc()) {
    $billings[] = $row;
}

// Handle POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Handle transaction insertion
    if (isset($_POST['BillingID']) && isset($_POST['Amount']) && isset($_POST['PaymentMethod']) && isset($_POST['TransactionStatus'])) {

        $billingID = $_POST['BillingID'];
        $amount = $_POST['Amount'];
        $paymentMethod = $_POST['PaymentMethod'];
        $transactionStatus = $_POST['TransactionStatus'];
        $transactionDate = date("Y-m-d");

        // Start a transaction
        $conn->begin_transaction();

        try {
            // Insert into transactions
            $sql = "INSERT INTO transactions (BillingID, TransactionDate, Amount, PaymentMethod, TransactionStatus) 
                    VALUES (?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("isdss", $billingID, $transactionDate, $amount, $paymentMethod, $transactionStatus);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Error in preparing transaction insert statement: " . $conn->error);
            }

            // Update billing payment status to 'Paid'
            if ($transactionStatus === 'Paid') {
                $updateSql = "UPDATE billing SET PaymentStatus = 'Paid' WHERE BillingID = ?";
                if ($updateStmt = $conn->prepare($updateSql)) {
                    $updateStmt->bind_param("i", $billingID);
                    $updateStmt->execute();
                    $updateStmt->close();
                } else {
                    throw new Exception("Error in preparing billing update statement: " . $conn->error);
                }
            }

            // Commit transaction
            $conn->commit();
            header('Location: ../billing.php');
            exit();

        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }

    }

    // Handle billing deletion
    if (isset($_POST['delete'])) {
        $billingID = $_POST['delete'];

        // Start a transaction
        $conn->begin_transaction();

        try {
            // Delete from transactions first
            $sql = "DELETE FROM transactions WHERE BillingID = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $billingID);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Error in preparing transaction delete statement: " . $conn->error);
            }

            // Then delete from billing
            $sql = "DELETE FROM billing WHERE BillingID = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $billingID);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("Error in preparing billing delete statement: " . $conn->error);
            }

            // Commit transaction
            $conn->commit();
            header('Location: ../billing.php');
            exit();

        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    }
}

$conn->close();
?>
