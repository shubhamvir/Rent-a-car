<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
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
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Car Rental Agency</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="agency_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_cars.php">View Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_bookings.php">View Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div class="buttons d-flex">
                    <?php if(isset($_SESSION['username'])): ?>
                    <a href="logout.php"><button class="btn btn-outline-light me-2" type="button">Logout</button></a>
                    <?php else: ?>
                    <a href="agency_login.php"><button class="btn btn-outline-light me-2"
                            type="button">Login</button></a>
                    <a href="agency_register.php"><button class="btn btn-outline-light"
                            type="button">Register</button></a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </nav>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>