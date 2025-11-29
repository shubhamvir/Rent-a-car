<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include 'db_connect.php'; 

// Get form data
$agency_name = $_POST["agency_name"];
$agency_username = $_POST["agency_username"];
$agency_password = $_POST["agency_password"];

// Hash the password for security
$hashedPassword = password_hash($agency_password, PASSWORD_DEFAULT);

// Insert query
$insert_query = "INSERT INTO Users (username, password, user_type, name) VALUES ('$agency_username', '$hashedPassword',
'agency', '$agency_name')";
if ($conn->query($insert_query) === TRUE) {
$_SESSION["registration_success"] = "Registration successful. Please login.";
header("Location: agency_login.php");
exit();
} else {
$_SESSION["registration_error"] = "Error occurred. Please try again later.";
header("Location: agency_register.php");
exit();
}

$conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Agency Registration</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include 'agency_navbar.php' ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Car Rental Agency Registration</h3>
                        <form action="agency_register.php" method="POST">

                            <div class="form-group">
                                <label for="agency_name">Agency Name</label>
                                <input type="text" class="form-control" id="agency_name" name="agency_name" required>
                            </div>

                            <div class="form-group">
                                <label for="agency_username">Username</label>
                                <input type="text" class="form-control" id="agency_username" name="agency_username"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="agency_password">Password</label>
                                <input type="password" class="form-control" id="agency_password" name="agency_password"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>