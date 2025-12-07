<?php
require_once 'security.php'; // Add this line

//session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //  database connection  
    include 'db_connect.php';

    // Get form data
    $customer_name = $_POST["customer_name"];
    $customer_username = $_POST["customer_username"];
    $customer_password = $_POST["customer_password"];
 

    // Hash the password for security
    $hashedPassword = password_hash($customer_password, PASSWORD_DEFAULT);

    // Insert customer data into the database
    //$query = "INSERT INTO Users (username, password, user_type, name) VALUES ('$customer_username', '$hashedPassword', 'customer', '$customer_name')";
    $stmt = $conn->prepare("INSERT INTO Users (username, password, user_type, name) VALUES (?, ?, 'customer', ?)");
$stmt->bind_param("sss", $customer_username, $hashedPassword, $customer_name);
$stmt->execute();

    $result = $conn->query($query);
    if ($result === TRUE) {
        // Registration successful
        $_SESSION["registration_success"] = "Registration successful. Please login.";
        header("Location: customer_login.php");
        exit();
    } else {
        // Error occurred while inserting user data
        $_SESSION["registration_error"] = "Error occurred. Please try again later.";
        header("Location: customer_register.php");
        exit();
    }

    // Close connection
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="style.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include 'customer_navbar.php'; ?>
    <div class="container mt-5">


        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Customer Registration</h3>
                        <form action="customer_register.php" method="POST">

                            <div class="form-group">
                                <label for="customer_name">Name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="customer_username">Username</label>
                                <input type="text" class="form-control" id="customer_username" name="customer_username"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="customer_password">Password</label>
                                <input type="password" class="form-control" id="customer_password"
                                    name="customer_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>

                            <div class="container text-center mt-3 ">
                                <h5>Or</h5>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title text-center">Register as an Agency</h5>
                                <div class="text-center mt-3">
                                    <a href="agency_register.php" class="btn btn-outline-primary">Register</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
