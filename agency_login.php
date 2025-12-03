<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //  database connection  
    include 'db_connect.php';

    // Get form data
    $agency_username = $_POST["username"];
    $agency_password = $_POST["password"];



    //   data from the database
    //$retrieve_agency_query = "SELECT * FROM Users WHERE username='$agency_username' AND user_type='agency'";
    $stmt = $conn->prepare("SELECT * FROM Users WHERE username=? AND user_type='agency'");
$stmt->bind_param("s", $agency_username);
$stmt->execute();
$result = $stmt->get_result();
    $result = $conn->query($retrieve_agency_query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($agency_password, $row["password"])) {
            // Login successful, set session variables and redirect to agency dashboard
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["user_type"] = $row["user_type"];
            header("Location: agency_dashboard.php");
            exit();
        } else {
            // Invalid password, redirect to login page with error message
            $_SESSION["login_error"] = "Invalid username or password.";
            header("Location: agency_login.php");
            exit();
        }
    } else {
        // User not found, redirect to login page with error message
        $_SESSION["login_error"] = "Invalid username or password.";
        header("Location: agency_login.php");
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
    <title>Agency Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        margin-top: 50px;
    }
    </style>
</head>

<body>

    <?php include 'agency_navbar.php'; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Agency Login</h3>
                        <form action="agency_login.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
