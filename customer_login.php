<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // database connection
    include 'db_connect.php';

    // Get form data
    $customer_username = $_POST["username"];
    $customer_password = $_POST["password"];

    // select query
    $retrieve_customer_query = "SELECT * FROM Users WHERE username='$customer_username' AND user_type='customer'";
    $result = $conn->query($retrieve_customer_query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($customer_password, $row["password"])) {
            // Login successful, set session variables and redirect to customer dashboard
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["user_type"] = $row["user_type"];
            header("Location: index.php");
            exit();
        } else {
            // Invalid password, redirect to login page with error message
            $_SESSION["login_error"] = "Invalid username or password.";
            header("Location: customer_login.php");
            exit();
        }
    } else {
        // User not found, redirect to login page with error message
        $_SESSION["login_error"] = "Invalid username or password.";
        header("Location: customer_login.php");
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
    <title>Customer Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
    .navbar {
        background-color: #008DDA;
    }

    .navbar-nav {
        margin: auto;
    }

    .nav-item .nav-link {
        color: white;
        font-size: 18px;
    }

    .buttons {
        margin: auto;
    }
    </style>

</head>

<body>

    <?php include 'customer_navbar.php' ?>



    <!-- Display success message if registration was successful -->
    <?php if(isset($_SESSION["registration_success"])): ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $_SESSION["registration_success"]; ?>
    </div>



    <?php unset($_SESSION["registration_success"]); // Clear the session variable ?>
    <?php endif; ?>

    <!-- Display error message if registration failed -->
    <?php if(isset($_SESSION["registration_error"])): ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $_SESSION["registration_error"]; ?>
    </div>
    <?php unset($_SESSION["registration_error"]); // Clear the session variable ?>
    <?php endif; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Customer Login</h3>
                        <form action="customer_login.php" method="POST">
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
                        <div class="text-center mt-3">
                            <a href="customer_register.php">Register</a> |
                            <!-- Link for registration -->
                            <a href="forgot_password.php">Forgot Password</a> <!-- Link for forgot password -->
                        </div>


                        <div class="container text-center mt-3 ">
                            <h5>Or</h5>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title text-center">Login as an Agency</h5>
                            <div class="text-center mt-3">
                                <a href="agency_login.php" class="btn btn-outline-primary">Login</a>
                                <!-- Link for agency login -->
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>