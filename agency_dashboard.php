<?php
require_once 'security.php';
require_once 'auth_check.php';
require_agency(); // Add this line

// Rest of your code...
?>

// Your existing session_start() and other code

//session_start();



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agency Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="d-flex flex-column">
    <?php include 'agency_navbar.php' ?>

    <div class="container mt-4">
        <h1>Welcome to the Agency Dashboard</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cars Available for Rent</h5>
                        <p class="card-text">View and manage cars available for rent.</p>
                        <a href="view_cars.php" class="btn btn-primary">View Cars</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bookings</h5>
                        <p class="card-text">View and manage bookings made by customers.</p>
                        <a href="view_bookings.php" class="btn btn-primary">View Bookings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
