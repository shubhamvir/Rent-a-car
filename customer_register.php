<?php
require_once 'security.php';
require_once 'validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //  database connection  
    include 'db_connect.php';

    // Get and sanitize form data
    $customer_name = sanitize_input($_POST["customer_name"]);
    $customer_username = sanitize_input($_POST["customer_username"]);
    $customer_password = $_POST["customer_password"]; // Don't sanitize password

    // Validate inputs
    if (!validate_username($customer_username)) {
        $_SESSION["registration_error"] = "Invalid username format. Use 3-20 letters, numbers, or underscores.";
        header("Location: customer_register.php");
        exit();
    }
    
    if (!validate_password($customer_password)) {
        $_SESSION["registration_error"] = "Password must be at least 8 characters with uppercase, lowercase and number.";
        header("Location: customer_register.php");
        exit();
    }
    
    // Optional: Validate name
    if (empty($customer_name) || strlen($customer_name) > 100) {
        $_SESSION["registration_error"] = "Please enter a valid name (max 100 characters).";
        header("Location: customer_register.php");
        exit();
    }

    // Hash the password for security
    $hashedPassword = password_hash($customer_password, PASSWORD_DEFAULT);

    // Insert customer data into the database using prepared statement
    $stmt = $conn->prepare("INSERT INTO Users (username, password, user_type, name) VALUES (?, ?, 'customer', ?)");
    $stmt->bind_param("sss", $customer_username, $hashedPassword, $customer_name);
    
    if ($stmt->execute()) {
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
    $stmt->close();
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
        <!-- Display success/error messages -->
        <?php if(isset($_SESSION["registration_success"])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION["registration_success"]; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION["registration_success"]); ?>
        <?php endif; ?>
        
        <?php if(isset($_SESSION["registration_error"])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION["registration_error"]; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION["registration_error"]); ?>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Customer Registration</h3>
                        <form action="customer_register.php" method="POST" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="customer_name">Name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                <small class="form-text text-muted">Enter your full name</small>
                            </div>

                            <div class="form-group">
                                <label for="customer_username">Username</label>
                                <input type="text" class="form-control" id="customer_username" name="customer_username" required>
                                <small class="form-text text-muted">3-20 characters, letters, numbers, underscores only</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="customer_password">Password</label>
                                <input type="password" class="form-control" id="customer_password" name="customer_password" required>
                                <small class="form-text text-muted">Minimum 8 characters with uppercase, lowercase, and number</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">Register</button>

                            <div class="container text-center mt-3">
                                <h5>Or</h5>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title text-center">Register as an Agency</h5>
                                <div class="text-center mt-3">
                                    <a href="agency_register.php" class="btn btn-outline-primary">Register as Agency</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for client-side validation -->
    <script>
    function validateForm() {
        var password = document.getElementById("customer_password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        
        // Check password match
        if (password !== confirmPassword) {
            alert("Passwords do not match!");
            return false;
        }
        
        // Check password strength (optional client-side check)
        if (password.length < 8) {
            alert("Password must be at least 8 characters long!");
            return false;
        }
        
        return true;
    }
    </script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
