<?php
require_once 'security.php';
require_once 'validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include 'db_connect.php'; 

    // Get form data
    $agency_name = sanitize_input($_POST["agency_name"]);
    $agency_username = sanitize_input($_POST["agency_username"]);
    $agency_password = $_POST["agency_password"];

    // Validate inputs
    if (!validate_username($agency_username)) {
        $_SESSION["registration_error"] = "Invalid username format. Use 3-20 letters, numbers, or underscores.";
        header("Location: agency_register.php");
        exit();
    }
    
    if (!validate_password($agency_password)) {
        $_SESSION["registration_error"] = "Password must be at least 8 characters with uppercase, lowercase and number.";
        header("Location: agency_register.php");
        exit();
    }
    
    if (empty($agency_name) || strlen($agency_name) > 100) {
        $_SESSION["registration_error"] = "Please enter a valid agency name (max 100 characters).";
        header("Location: agency_register.php");
        exit();
    }

    // Hash the password for security
    $hashedPassword = password_hash($agency_password, PASSWORD_DEFAULT);

    // Insert query using prepared statement
    $stmt = $conn->prepare("INSERT INTO Users (username, password, user_type, name) VALUES (?, ?, 'agency', ?)");
    $stmt->bind_param("sss", $agency_username, $hashedPassword, $agency_name);
    
    if ($stmt->execute()) {
        $_SESSION["registration_success"] = "Registration successful. Please login.";
        header("Location: agency_login.php");
        exit();
    } else {
        $_SESSION["registration_error"] = "Error occurred. Please try again later.";
        header("Location: agency_register.php");
        exit();
    }

    $stmt->close();
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
                        <h3 class="card-title text-center mb-4">Car Rental Agency Registration</h3>
                        <form action="agency_register.php" method="POST" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="agency_name">Agency Name</label>
                                <input type="text" class="form-control" id="agency_name" name="agency_name" required>
                                <small class="form-text text-muted">Enter your agency's full name</small>
                            </div>

                            <div class="form-group">
                                <label for="agency_username">Username</label>
                                <input type="text" class="form-control" id="agency_username" name="agency_username" required>
                                <small class="form-text text-muted">3-20 characters, letters, numbers, underscores only</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="agency_password">Password</label>
                                <input type="password" class="form-control" id="agency_password" name="agency_password" required>
                                <small class="form-text text-muted">Minimum 8 characters with uppercase, lowercase, and number</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for client-side validation -->
    <script>
    function validateForm() {
        var password = document.getElementById("agency_password").value;
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
